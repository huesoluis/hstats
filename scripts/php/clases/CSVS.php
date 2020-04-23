<?php 
namespace hstats;
include 'config.php';
class CSVS {
  public $dim_form; 
  public $dim_campos; 
  public $ficheroorigen; 
  public $query; 
  public function __construct($ficheroorigen='',$ruta='',$dim_form=array(),$dim_campos=array(),$tabla='',$tipo='graficos',$post=0){
    	$this->c =$this->dbconnect(DB_HOST, DB_USER, DB_PASSWORD);
    	$this->ficheroorigen = $ficheroorigen;
	$this->dim_form=$dim_form;
    	$this->dim_campos = $dim_campos;
    	$this->limpiaForm();
	$this->dimension=sizeof($this->dim_form);
	$this->ruta=$ruta;
	if($tipo=='listados')
		$this->nficherodestino=$this->makeNombreFicheroDestinoListados();
	else
		$this->nficherodestino=$this->makeNombreFicheroDestino($tipo);

	//print($this->nficherodestino);
	$this->fcsv='';
	$this->fjson='';
	$this->tmp='';
	$this->tabla= $tabla;
	$this->post= $post;
	$this->conexion = new \mysqli('localhost',DB_USER,DB_PASSWORD,DB_DB);
	
	if (!$this->conexion->set_charset("utf8")) {
		printf("Error loading character set utf8: %s\n", $mysqli->error);
	    	exit();
	}
	if ($this->conexion->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	} 
	if(!$post)
		{
		print("CAMPOS DIPONIBLES: ");
		print_r($dim_campos);
		print("CAMPOS DE FORMULARIO: ");
		print_r($dim_form);
		print("DIMENSION: ");
		print_r($this->dimension);
		print("POST: ");
		print_r($this->post);
		}
	
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
			$this->fcsv=$this->crearFichero($this->nficherodestino,'csv');
			//generamos csv y json	
			$csv=$this->genCsv('listados');
			$cjson=$this->genJson();
			return $this->fjson;
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
  public function limpiaForm($tipo='graficos'){
			//claves disponibles
			$dimclaves=array_keys($this->dim_campos);
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
  public function makeNombreFicheroDestinoListados(){
			$f='f';
			$i=0;
			foreach($this->dim_form as $fn)
				{
				$i++;
				$f.="_".$fn;
				}
			return $f.'_'."listados";
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
			if($dim3!='')	
				return $f.'_'.$dim3."_$tipo";
			else	return $f.'_'."$tipo";
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
			$claves_dim3=$this->getClavesDim($valordim3,50);
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
				$claves_dim2=$this->getClavesDim($dim2,50);
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
				$sql="$select FROM (SELECT $dim1, IFNULL(COUNT(*),0) as num FROM $this->tabla $where GROUP BY $dim1 LIMIT 50) as t0 LEFT JOIN ";
				$ncampos=sizeof($claves_dim2);
				$n=0;
				foreach($claves_dim2 as $cd)
				{
					$n++;
					$sql.="(SELECT $dim1,IFNULL(COUNT(*),0) as num FROM $this->tabla WHERE $dim2='$cd'  GROUP BY $dim1 LIMIT 50) as t$n";
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
			if(sizeof($this->dim_campos)==0 || sizeof($this->dim_form)==0) return 0;
			//para ello el fichero original csv, debe marcar dichos campos. No importa el orden pero los campos restantes deben ser vinculados, es decir si un campo nominal es nombre_ciclo, el resto de campo sdel ciclo como codigo_cidclo, numero_horas etc... deben ir a continuación
			$pred='';
			$this->limpiaForm();
			$this->makeNombreFicheroDestino();
			$i=0;
			$select="SELECT CONCAT( ";
			$order='';
			//campos disponibles como dimensiones
			$dimclaves=array_keys($this->dim_campos);
			//obtenemos los campos informativos de cada campo principal
			foreach($this->dim_form as $v)
				{
				if(in_array($v,$dimclaves))
					{
					if(sizeof($this->dim_campos[$v])>=1) 
						{
							$k=0;
							foreach($this->dim_campos[$v] as $k=>$c)
							{
							if($k>0)
								$select.="',\\\"$c\\\":'";
							else
								$select.="'\\\"$c\\\":'";
								$select.=",'\\\"',";
								$select.="$c";
								$select.=",'\\\"',";
								$order.="$c,";
							$k++;
							}
						}	
					}
				$select.="'-n-',";
				}
			$order=trim($order,',');
			$select=substr($select,0,-7);
			$select=$select.') FROM '.$this->tabla.' ORDER BY '.$order.' LIMIT 50';
			/*
			foreach($this->dim_form as $v)
				{
				if(in_array($v,$dimclaves))
					{
					$select.=$this->dim_campos[$v][0].',';
					}
				}
			*/
			$this->query=$select;
			return 1;
	}
  public function executeQuery($f,$q,$tipo='file',$origen='cl'){
	if($tipo=='file')
		{
		$qquery='q -H -d ";" "'.$q.'" > '.$f;
		$qquery='q -H -d ";" "'.$q.'"';
		}
	else
		{
		if($origen=='cl')
			{
			$qquery='mysql -u'.DB_USER.' -p'.DB_PASSWORD.' '.DB_DB.' -N -e "'.$q.'"';
			print(PHP_EOL."consulta completa en EXECUTE: $qquery".PHP_EOL);
			$resq=shell_exec ($qquery );
			}
		elseif($origen=='con')
			{
			$resq='';
			$result= $this->conexion->query($q);
			if ($result->num_rows > 0) {
    				while($row = $result->fetch_assoc()) {
					foreach($row as $k=>$v)
					{
    						$resq.=$row[$k];
    						$resq.="\n";
					}
				}
			} else {
				    echo "0 results";
				}
			}
	
		}
	print($resq);
	return $resq;
	}

  public function genCsv($tipo='graficos'){
	$rutafichero=$this->ruta.'/'.$this->nficherodestino;
	$resq=1;
	//print("consulta: ".$this->query);
	if($tipo=='listados')
	{
		$resq=$this->executeQuery($this->tmp,$this->query,'sql','con');
		if(!$this->post) print(PHP_EOL."CREANDO CSV: ".PHP_EOL);
		if(!$this->post) print($this->fcsv.PHP_EOL);
		//print($this->query);
		$ficherodestino='/datos/websfp/desarrollo/hstats/scripts/php/'.$this->fcsv;
		//$comando_comillas='sed "s/\'/\"/g" '.$this->tmp.'>'.$this->fcsv;
		$fp = fopen($ficherodestino, 'w');
		fwrite($fp,$resq);
		fclose($fp);
		//$resq=shell_exec ($comando_comillas);
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
  public function makeUtf8(){
			$data = file_get_contents($this->fcsv);
			print($data);
			$data = mb_convert_encoding($data, 'UTF-8', 'ANSI_X3.4-1968');
			file_put_contents('temporal', $data);
			
			}
  public function genJson($fam='',$sql=''){
			$res='';
			$dirppal='/datos/websfp/desarrollo/hstats/scripts/php/';

			if($this->dimension==1)
				$pycom='/datos/websfp/desarrollo/hstats/scripts/php/gen_json_unnivel.py';
			elseif($this->dimension==2)
				$pycom='/datos/websfp/desarrollo/hstats/scripts/php/gen_json_dosniveles.py';
			elseif($this->dimension==3)
				$pycom='/datos/websfp/desarrollo/hstats/scripts/php/gen_json_tresniveles.py';

			//$comando_json="/usr/bin/python3 $com $dirppal$this->fcsv > $dirppal$this->fjson";
			if($this->post)
			{
				$comando_utf8="iconv -t ascii//TRANSLIT -f utf8  $this->fcsv -o  datos_listados/utf8.csv";
				$res1=shell_exec ($comando_utf8);
				$comando_json="/usr/bin/python3 $pycom  datos_listados/utf8.csv > $dirppal$this->fjson";
			}
			else
			{
				print("no post");
				$comando_json="/usr/bin/python3 $pycom $this->fcsv > $dirppal$this->fjson";
			}
			try{
				$res=shell_exec ($comando_json );
				//$res=exec ($comando_json );
			}
			catch (Exception $e) 
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			//$comando_comprobacion="php comprobacion_json.php ".$this->fjson;
			//$rescjson=shell_exec ($comando_comprobacion );
			
			//if($rescjson)
				return 1;
			//else return 0;
  }
  public function genJson_old($fam='',$sql=''){
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
