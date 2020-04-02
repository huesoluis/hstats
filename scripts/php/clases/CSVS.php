<?php 
namespace hstats;
include 'config.php';
class CSVS {
  public $dim_form; 
  public $dim_campos; 
  public $ficheroorigen; 
  public $query; 
  public function __construct($ficheroorigen='',$ruta='',$dim_form='',$dim_campos=array(),$tabla='',$tipo='graficos'){
    	$this->c =$this->dbconnect(DB_HOST, DB_USER, DB_PASSWORD);
    	$this->ficheroorigen = $ficheroorigen;
    	$this->dim_form = $dim_form;
    	$this->dim_campos = $dim_campos;
	$this->ruta=$ruta;
	$this->nficherodestino="f".$this->makeNombreFicheroDestino($tipo);
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
			$consulta=$this->makeQueryGraficos();
			
			//creamos los ficheros de datos
			//$this->tmp=$this->crearFichero($this->nficherodestino,'tmp');
			//$this->fjson=$this->crearFichero($this->nficherodestino,'json');
			//$this->fcsv=$this->crearFichero($this->nficherodestino,'txt');
			//generamos csv y json	
			$csv=$this->genCsv('graficos');
		return $csv;
	}
  public function getDataListados(){
			//generamos la conslta
			$consulta=$this->makeQueryListados();
			//creamos los ficheros de datos
			$this->tmp=$this->crearFichero($this->nficherodestino,'tmp');
			$this->fjson=$this->crearFichero($this->nficherodestino,'json');
			$this->fcsv=$this->crearFichero($this->nficherodestino,'txt');
			//generamos csv y json	
			$csv=$this->genCsv('listados');
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
			$dimclaves=array_keys($this->dim_campos);
			//limpiamos el array de campos de formulario y geenramos nombre para el fichero de salida
			$this->dim_form=array_unique($this->dim_form);
			foreach($this->dim_form as $key=>$df)
					{
					if(!in_array($df,$dimclaves))
								unset($this->dim_form[$key]);
					}
			return;
	}
  public function makeNombreFicheroDestino($tipo='graficos'){
			$f='';
			foreach($this->dim_form as $fn)
				$f.="_".$fn;
			return $f."_graficos";
	}
  public function getClavesDim($d){
			$sql_csv="SELECT distinct($d) FROM $this->ficheroorigen";
			$sql_mysql="SELECT distinct($d) FROM $this->tabla";
			$res=$this->executeQuery('datos_tmp/qtemp.sql',$sql_mysql,'mysql');				
			$ares=explode(PHP_EOL,$res);
			array_pop($ares);
			array_shift($ares);
			return $ares;
	}
  public function makeQueryGraficos(){
			$pred='';
			$this->limpiaForm();
			$this->makeNombreFicheroDestino();
			$i=0;
			if(sizeof($this->dim_campos)==0 || sizeof($this->dim_form)==0) return 0;
			//numero de dimensiones
			$d=sizeof($this->dim_form);
			//campos disponibles como dimensiones
			$dimclaves=array_keys($this->dim_campos);
	
			$dim1=$this->dim_form[0];
			$sql='';
			$nfil=0;
			if($d==1)
				{
				$sql="SELECT ";
				$sql.=$dim1." ,count(*) nal ";
				$sql.="FROM $this->ficheroorigen ";
				$sql.="GROUP BY ".$dim1;
				}
			if($d==2)
				{
				$dim2=$this->dim_form[1];
				$claves_dim2=$this->getClavesDim($dim2);
				print("dim 2");
				$nv=0;
				$nva=-1;
				$nc=0;
				$select="SELECT t0.$dim1, ";
				foreach($claves_dim2 as $cd)
					{
					$nc++;
					$select.="t$nc.num as $cd,";
					}
				$select=trim($select,',');
				$sql="$select FROM (SELECT $dim1, COUNT(*) as num FROM $this->tabla GROUP BY $dim1) as t0 LEFT JOIN ";
				$ncampos=sizeof($claves_dim2);
				$n=0;
				foreach($claves_dim2 as $cd)
				{
					$n++;
					$sql.="(SELECT $dim1,COUNT(*) as num FROM $this->tabla WHERE $dim2='$cd'  GROUP BY $dim1) as t$n";
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
			if(sizeof($this->dim_campos)==0 || sizeof($this->dim_form)==0) return 0;
			//campos disponibles como dimensiones
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
					//$select.=$this->dim_campos[$v][0].',';
					if(sizeof($this->dim_campos[$v])>=1) 
						{
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
		}
	$resq=shell_exec ($qquery );
	return $resq;
	}

  public function genCsv($tipo='graficos'){
	$rutafichero=$this->ruta.'/'.$this->nficherodestino;
	$resc=1;
	if($tipo=='listados')
	{
		$resq=$executeQuery($this->tmp,$this->query);
		$comando_comillas='sed "s/\'/\"/g" '.$this->tmp.'>'.$this->fcsv;
		$resc=shell_exec ($comando_comillas);
	}
	else{
		$rutafichero=$this->ruta.'/'.$this->nficherodestino.'.csv';
		$resq=$this->executeQuery($this->nficherodestino,$this->query,'mysql');
		$cadd=preg_replace('/\t/',',',$resq);
		$fp = fopen($rutafichero, 'w');
		fwrite($fp,$cadd);
		fclose($fp);
		}
	if($resq)
		return 1;
	else return 0;
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
			print_r($comando_json);print("Respuesta: ".$res);exit();
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
