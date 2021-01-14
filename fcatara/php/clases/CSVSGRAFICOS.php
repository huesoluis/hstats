<?php 
include '../config.php';
class CSVSGRAFICOS {
  public $dim_form; 
  public $dim_campos; 
  public $query; 
  public function __construct($ruta=''){

		$logfile='log/weblog'; 
		//$this->logfile=fopen($logfile,'a+');
		//fwrite($this->logfile,"pruebas");

		$this->tiposgraficos=array('padron_nalumnos'=>' curso_escolar,padron,nalumnos ','prc_padron'=>' curso_escolar,nalumnos_concertada/padron*100,nalumnos_publica/padron*100 ','con_pub'=>' curso_escolar, nalumnos_concertada,nalumnos_publica');

		$this->ruta=$ruta;
		
		$this->conexion = new \mysqli('localhost',DB_USER,DB_PASSWORD,DB_DB);
		
		if (!$this->conexion->set_charset("utf8")) {
			printf("Error loading character set utf8: %s\n", $mysqli->error);
					exit();
		}
		if ($this->conexion->connect_error) {
					die("Connection failed: " . $conn->connect_error);
		} 
	}
  public function genFicherosGraficosEvolutivos()
	{
		//para el caso de enseñanzas
			$sql="select t1.curso_escolar,t1.nalumnos as INFANTIL, t2.nalumnos as PRIMARIA, t3.nalumnos as ESO, t4.nalumnos as BACH from (select curso_escolar,nalumnos from stats_enseñanzas where cod_enseñanza_agrupada='EI') as t1 join (select curso_escolar, nalumnos from stats_enseñanzas where cod_enseñanza_agrupada='EP') as t2 on t1.curso_escolar=t2.curso_escolar  join (select curso_escolar,nalumnos from stats_enseñanzas where cod_enseñanza_agrupada='ESO') as t3 on t1.curso_escolar=t3.curso_escolar join (select curso_escolar, nalumnos from stats_enseñanzas where cod_enseñanza_agrupada='EP') as t4 on t4.curso_escolar=t1.curso_escolar ORDER BY curso_escolar asc ;";
			$res=$this->ejecutarConsultaToCsv($sql);
			//print($res);
			$this->genCsv('grafico_evolutivo_enseñanzas.csv',$res);
	return 1;
	}
  public function genFicherosGraficosEvolutivosComarcas()
	{
		$acomarcas=$this->getComarcas();
		foreach($acomarcas as $comarca)
		{
			$com=$comarca['comarca'];
			//para el caso de una comarca
			$sql="SELECT curso,nalumnos FROM stats_comarcas WHERE comarca='$com' order by curso asc ";
			$res=$this->ejecutarConsultaToCsv($sql,",");
			print($res);
			$this->genCsv('evolutivos/comarcas/grafico_evolutivo_comarca_'.$com.'.csv',$res);
		}
	return 1;
	}
  public function genFicherosGraficosGeneral()
	{
			$sql="SELECT nombrecentro,s.pctextranjeros FROM base_centros b, stats_centros s WHERE b.codcentro=s.codcentro AND pctextranjeros <100 and pctextranjeros>5 ORDER BY pctextranjeros desc";
			$res=$this->ejecutarConsultaToCsv($sql);
			//print($res);
			$this->genCsv('grafico_gen_centros_pct.csv',$res);
			$sql="SELECT nombrecomarca,s.pctextranjeros FROM  stats_comarcas s WHERE pctextranjeros <100 and pctextranjeros>5 ORDER BY pctextranjeros desc";
			$res=$this->ejecutarConsultaToCsv($sql,";");
			$this->genCsv('grafico_gen_comarcas_pct.csv',$res);
	return 1;
	}
  public function genFicherosGraficosComparaEnseñanzas()
	{
		$enseñanzas=$this->getEnseñanzas();
		//print_r($enseñanzas);exit();
		foreach($enseñanzas as $ens)
		{
			foreach($this->tiposgraficos as $tg=>$select)
			{	
			$enseñanza=$ens['cod_enseñanza_agrupada'];
			$sql="SELECT $select FROM enseñanzas WHERE cod_enseñanza_agrupada='".$enseñanza."' ORDER BY curso_escolar desc";
			//print($sql.PHP_EOL);
			$res=$this->ejecutarConsultaToCsv($sql);
			//print($res);
			$enseñanza=strtolower($enseñanza);
			$this->genCsv('grafico_evo_'.$tg.'_'.$enseñanza.'.csv',$res);
			}
		}
	return 1;
	}

  public function getComarcas()
	{
		$q="SELECT distinct(comarca) FROM base_centros";
		return $this->ejecutarConsulta($q);	
	}
  public function getEnseñanzas()
	{
		$q="SELECT distinct(cod_enseñanza_agrupada) FROM enseñanzas";
		return $this->ejecutarConsulta($q);	
	}

  public function ejecutarConsulta($q){
		$result= $this->conexion->query($q);
		if($result->num_rows > 0) 
		{
    		while($row = $result->fetch_assoc()) {
					$res[]=$row;
				}
			return $res;
		}
		else return 0;
	}
	public function ejecutarConsultaToCsv($q,$sep=";")
	{
		$i=1;
		$resq='';
		$cabecera='';
		print($q);
		$result= $this->conexion->query($q);
		if($result->num_rows > 0) 
		{
    	while($row = $result->fetch_assoc()) 
			{
				foreach($row as $k=>$v)
				{
						if($i==1)
						{
							$cabecera=implode($sep,array_keys($row));
    					$resq.=$cabecera;
    					$resq.="\n";
							$i=0;
						}
    						$resq.=$row[$k].$sep;
				}
    						$resq=substr($resq,0,-1);
    						$resq.="\n";
			}
		} else 
			{
				return 0;
			}
	return $resq;
	}
	public function generarFicherosOpciones()
	{
		//generamos ficheros para selccionar comarcas, municipios y zonas
		$i=1;
		$resq='';
		$cabecera='';
		$q="SELECT distinct(comarca) FROM base_centros";
		print($q);
		$result= $this->conexion->query($q);
		if($result->num_rows > 0) 
		{
    	while($row = $result->fetch_assoc()) 
			{
				foreach($row as $k=>$v)
    						$resq.="<option>".$row[$k]."</option>";
    		$resq.="\n";
			}
		} else 
			{
				return 0;
			}
		$ficherodestino='../../../includes/fopciones/listacomarcas.html';
		$fp = fopen($ficherodestino, 'w');
		fwrite($fp,$resq);
		fclose($fp);
		$q="SELECT distinct(zona) FROM base_centros";
		$result= $this->conexion->query($q);
		if($result->num_rows > 0) 
		{
    	while($row = $result->fetch_assoc()) 
			{
				foreach($row as $k=>$v)
    						$resq.="<option>".$row[$k]."</option>";
    		$resq.="\n";
			}
		} else 
			{
				return 0;
			}
		$ficherodestino='../../../includes/fopciones/listazonas.html';
		$fp = fopen($ficherodestino, 'w');
		fwrite($fp,$resq);
		fclose($fp);
		$q="SELECT distinct(municipio) FROM base_centros";
		$result= $this->conexion->query($q);
		if($result->num_rows > 0) 
		{
    	while($row = $result->fetch_assoc()) 
			{
				foreach($row as $k=>$v)
    						$resq.="<option>".$row[$k]."</option>";
    		$resq.="\n";
			}
		} else 
			{
				return 0;
			}
		$ficherodestino='../../../includes/fopciones/listamunicipios.html';
		$fp = fopen($ficherodestino, 'w');
		fwrite($fp,$resq);
		fclose($fp);
		
	return $resq;
	}
  public function genCsv($nombre,$res)
	{
		$ficherodestino=$this->ruta.'/'.$nombre;
		$fp = fopen($ficherodestino, 'w');
		fwrite($fp,$res);
		fclose($fp);
	return 1;
	}
  private function dbconnect() 
	{
  	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DB) or die ("<br/>No conexion servidor");
		$this->c=$conn;     
		mysqli_select_db($conn,DB_DB) or die ("<br/>No se puedo seleccionar la bases de datos");
		return $conn;
  }
			 
}
 
?>
