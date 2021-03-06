<?php 
namespace hstats;
include 'config.php';
class CSVS {
  public $dim_form; 
  public $dim_campos; 
  public $ficheroorigen; 
  public $query; 
  public function __construct($ficheroorigen='',$ruta='',$dim_form=array(),$dim_campos=array(),$tabla='',$tipo='graficos'){
    	$this->c =$this->dbconnect(DB_HOST, DB_USER, DB_PASSWORD);
    	$this->ficheroorigen = $ficheroorigen;
	$this->dim_form=$dim_form;
    	$this->dim_campos = $dim_campos;
    	$this->limpiaForm();
	$this->dimension=sizeof($this->dim_form);
	$this->ruta=$ruta;
	$this->nficherodestino=$this->makeNombreFicheroDestino($tipo);
	//print_r($this->dim_form); exit();
	//print($this->nficherodestino);
	$this->fcsv='';
	$this->fjson='';
	$this->tmp='';
	$this->tabla= $tabla;
	
	}
  private function dbconnect() 
	{
    	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DB) or die ("<br/>No conexion servidor");
	$this->c=$conn;     
	mysqli_select_db($conn,DB_DB) or die ("<br/>No se puedo seleccionar la bases de datos");
	return $conn;
  	}
  public function getDataGraficos(){
		//generamos la conslta
		if($this->dimension<=2)
			$consulta=$this->makeQueryGraficos2d(2);
		else
		{
			$consulta=$this->makeQueryGraficos3d();
			if($consulta) return $this->dimension.':'.$consulta; 
		}
		if($consulta=='0') return 'FORMULARIO VACIO';	
		//creamos los ficheros de datos
		//print($consulta);exit();
		
		$csv=$this->genCsv('graficos');
		if(!$csv) return 0;
	return $this->dimension.':scripts/php/'.$csv;
	}
  public function genDataListados(){
			//generamos la conslta
			$consulta=$this->makeQueryListados();
			//creamos los ficheros de datos
			$this->tmp=$this->crearFichero($this->nficherodestino,'tmp');
			$this->fjson=$this->crearFichero($this->nficherodestino,'json');
			$this->fcsv=$this->crearFichero($this->nficherodestino,'txt');
			//generamos csv y json	
			$csv=$this->genCsv('listados');
			return;
			$cjson=$this->genJson();
	}
  public function crearFichero($f,$ext){
			$nf=$f;
			$f=$this->ruta.'/'.$f.'.'.$ext;
			if (file_exists($f)) {
				unlink($f);
			}
			$fp = fopen($f, 'w');
			fclose($fp);
			chmod($f,0777);
			return $f;
	}
  public function limpiaForm(){
			//claves disponibles
			$dimclaves=array_keys($this->dim_campos);
			//$dimclaves=$this->dim_campos;
			//limpiamos el array de campos de formulario y geenramos nombre para el fichero de salida
			$this->dim_form=array_unique($this->dim_form);
			foreach($this->dim_form as $key=>$df)
					{
					if(!in_array($df,$dimclaves))
								unset($this->dim_form[$key]);
					}
			if(sizeof($this->dim_form)==0) return 0;
			return 1;
	}
  public function makeNombreFicheroDestino($tipo='graficos',$d=2,$dim3=''){
			$f='f';
			$i=0;
			foreach($this->dim_form as $fn)
				{
				$i++;
				$f.="_".$fn;
				if($i==$d) break;
				}
			$this->nficherodestino=$f.'_'.$dim3."_$tipo";
		return $f.'_'.$dim3."_$tipo";
	}
  public function getClavesDim($d,$numero=3){
			//$sql_csv="SELECT distinct($d) FROM $this->ficheroorigen";
			$sql_mysql="SELECT distinct($d) FROM $this->tabla LIMIT $numero";
			$res=$this->executeQuery('datos_tmp/qtemp.sql',$sql_mysql,'mysql');				
			$ares=explode(PHP_EOL,$res);
			array_pop($ares);
			array_shift($ares);
			return $ares;
	}
  public function makeQueryGraficos3d(){
			//si estamos en 3d haremos un grafico de 2d para cada valor de la última dimension
			$indicedim3=$this->dim_form[2];
			$valordim3=$this->dim_campos[$indicedim3];
			$claves_dim3=$this->getClavesDim($valordim3,3);
			//print_r($claves_dim3);exit();
			$csv='';
			foreach($claves_dim3 as $cd)
				{
				$sql=$this->makeQueryGraficos2d(2,$cd,$indicedim3,$cd);
				$csv.='#scripts/php/'.$this->genCsv('graficos');
				}
			return $csv;
	}	
  public function makeQueryGraficos2d($d=1,$cd3='',$clave3d='',$valor3d=''){
			$pred='';
			if($this->limpiaForm()==0) return '0';
			$this->makeNombreFicheroDestino('graficos',$d,$cd3);
			$i=0;
			if(sizeof($this->dim_campos)==0 || sizeof($this->dim_form)==0) return 0;
			//numero de dimensiones
			//campos disponibles como dimensiones
			$dimclaves=array_keys($this->dim_campos);
	
			$dim1=$this->dim_form[0];
			$sql='';
			$nfil=0;
			if($d==1)
				{
				$sql="SELECT ";
				$sql.=$dim1." ,count(*) nal ";
				$sql.="FROM $this->tabla";
				$sql.=" GROUP BY ".$dim1." ORDER BY nal desc";
			
				}
			if($d==2)
				{ 
				$where='';
				if($clave3d!='')
					$where=" WHERE $clave3d='$valor3d' ";
				$indicedim2=$this->dim_form[1];
				$dim2=$this->dim_campos[$indicedim2];
				$claves_dim2=$this->getClavesDim($dim2,3);
				//print_r($claves_dim2);print($dim2);exit();
				$nv=0;
				$nva=-1;
				$nc=0;
				$select="SELECT t0.$dim1, ";
				//creamos la clausuala para ordenar la consulta
				//$order=" ORDER BY ";
				foreach($claves_dim2 as $cd)
					{
					$rcd=preg_replace('/\s/', '', $cd);
					$rcd=preg_replace('/-/', '', $rcd);
					$nc++;
					$select.="IFNULL(t$nc.num,0) as al$rcd,";
				//	$order.="al$rcd desc, ";
					}
				$select=trim($select,',');
				//$order=trim($order,', ');
				$sql="$select FROM (SELECT $dim1, IFNULL(COUNT(*),0) as num FROM $this->tabla $where GROUP BY $dim1 LIMIT 3) as t0 LEFT JOIN ";
				$ncampos=sizeof($claves_dim2);
				$n=0;
				foreach($claves_dim2 as $cd)
				{
					$n++;
					$sql.="(SELECT $dim1,IFNULL(COUNT(*),0) as num FROM $this->tabla WHERE $dim2='$cd'  GROUP BY $dim1 LIMIT 3) as t$n";
					$tmp=$n-1;
					$sql.=" ON t$n.$dim1=t0.$dim1 ";	
					if($n<$ncampos)
						$sql.=" LEFT JOIN ";
				}
				}
	$this->query=$sql;
	return $sql;
	}
  public function makeQueryListados(){
			//detectar campos nominales, empiezan con g_ y puede marcan la separacion entre niveles
			//para ello el fichero original csv, debe marcar dichos campos. No importa el orden pero los campos restantes deben ser vinculados, es decir si un campo nominal es nombre_ciclo, el resto de campo sdel ciclo como codigo_cidclo, numero_horas etc... deben ir a continuación
			$pred='';
			$this->limpiaForm();
			$this->makeNombreFicheroDestino();
			$i=0;
			$select="SELECT ";
			print("CONSTRUYENDO CONSULTA: ");
			print_r($this->dim_campos);
			print_r($this->dim_form);
			if(sizeof($this->dim_campos)==0 || sizeof($this->dim_form)==0) return 0;
			//campos disponibles como dimensiones
			print("dim campos: ");print_r($this->dim_campos);exit();
			$dimclaves=array_keys($this->dim_campos);
			foreach($this->dim_form as $v)
				{
				if($i>0)
					{
					$select=trim($select,"||','||");
					$select.="||'-n-'||";
					}
				$i++;
				if(in_array($v,$dimclaves))
					{
					if(sizeof($this->dim_campos[$v])>=1) 
						{
							print("dim campos: ");print_r($this->dim_campos[$v]);exit();
							foreach($this->dim_campos[$v] as $c)
								$select.="quote('$c')||':'||"."quote($c)||','||";
						}	
					}
				}
			$select=trim($select,"||','||");
			$select=trim($select,"||'-n-");
			
			$select=$select.' FROM '.$this->ficheroorigen.' ORDER BY ';
			foreach($this->dim_form as $v)
				{
				if(in_array($v,$dimclaves))
					{
					$select.=$this->dim_campos[$v][0].',';
					}
				}
			$select=trim($select,',');
			$this->query=$select;
			print_r($select);exit();
			return 1;
	}
  public function executeQuery($f,$q,$tipo='file'){
	if($tipo=='file')
		{
		$qquery='q -H -d ";" "'.$q.'" > '.$f;
		$qquery='q -H -d ";" "'.$q.'"';
		}
	else
		{
		$qquery='mysql -u'.DB_USER.' -p'.DB_PASSWORD.' '.DB_DB.' -e "'.$q.'"';
		//print(PHP_EOL."consulta completa en EXECUTE: $qquery".PHP_EOL);
	
		}
	$resq=shell_exec ($qquery );
	//print(PHP_EOL."Resultado en EXECUTE: $resq".PHP_EOL);
	//print("Saliendo de EXECUTE".PHP_EOL);
	return $resq;
	}

  public function genCsv($tipo='graficos'){
	$rutafichero=$this->ruta.'/'.$this->nficherodestino;
	$resq=1;
	print("consulta: ".$this->query);
	if($tipo=='listados')
	{
		$resq=$this->executeQuery($this->tmp,$this->query);
		$comando_comillas='sed "s/\'/\"/g" '.$this->tmp.'>'.$this->fcsv;
		$resq=shell_exec ($comando_comillas);
	}
	else{
		$rutafichero=$this->ruta.'/'.$this->nficherodestino.'.csv';
		//print("generando grafico en $rutafichero");
		//print(PHP_EOL."consulta en GENCSV: $this->query".PHP_EOL);
		$resq=$this->executeQuery($this->nficherodestino,$this->query,'mysql');
		$cadd=preg_replace('/\t/',';',$resq);
		$fp = fopen($rutafichero, 'w');
		//print("escribiendo en fichero resultado: $cadd");
		fwrite($fp,$cadd);
		fclose($fp);
		}
	if($resq)
		return $rutafichero;
	else return $resq;
  }
  public function genJson($fam='',$sql=''){
			$res='';
			$comando_utf8="iconv -f utf8 -t ascii//TRANSLIT  $this->fcsv -o  datos_listados/utf8.csv";
			
			$res1=shell_exec ($comando_utf8);
#$comando_json="python3 gen_json_dosniveles.py $this->fcsv > $this->fjson";
			$comando_json="python3 gen_json_dosniveles.py datos_listados/utf8.csv > $this->fjson";
			//$comando_json="/usr/bin/python3 gen_pruebas.py ".$this->fcsv.">".$this->fjson ;
			try{
				$res=shell_exec ($comando_json );
			}
			catch (Exception $e) 
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			//print_r($comando_json);print("Respuesta: ".$res);exit();
			$comando_comprobacion="php comprobacion_json.php ".$this->fjson;
			$rescjson=shell_exec ($comando_comprobacion );
			
			if($rescjson)
				return 1;
			else return 0;
  }
  public function makeView(){
			$salida='';
			$rutafichero=$this->ruta.'/'.$this->nficherodestino.'.json';
			return $rutafichero;
			$entidad = file_get_contents($rutafichero);
			$json = json_decode($entidad, true);
			foreach ($json as $ent)
				$salida.=$ent['nombrecentro'];
				return $ent['nombrecentro'];
			}
			 
}
 
?>
