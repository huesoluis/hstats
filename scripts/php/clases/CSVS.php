<?php 

namespace hstats;
class CSVS {
  public $dim_form; 
  public $dim_campos; 
  public $ficheroorigen; 
  public $query; 
  public function __construct($ficheroorigen='',$ruta='',$dim_form='',$dim_campos=array()){
    	$this->ficheroorigen = $ficheroorigen;
    	$this->dim_form = $dim_form;
    	$this->dim_campos = $dim_campos;
	$this->ruta=$ruta;
	$this->nficherodestino="f";
	$this->fcsv='';
	$this->fjson='';
	$this->tmp='';
	}
  public function getDataGraficos(){
			//generamos la conslta
			$consulta=$this->makeQueryGraficos();
			//creamos los ficheros de datos
			$this->tmp=$this->crearFichero($this->nficherodestino,'tmp');
			$this->fjson=$this->crearFichero($this->nficherodestino,'json');
			$this->fcsv=$this->crearFichero($this->nficherodestino,'txt');
			//generamos csv y json	
			$csv=$this->genCsv('grficos');
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
  public function makeNombreFicheroDestino(){
			foreach($this->dim_form as $fn)
				$this->nficherodestino.="_".$fn;
			return;
	}
  public function makeQueryGraficos(){
			//detectar campos nominales, empiezan con g_ y puede marcan la separacion entre niveles
			//para ello el fichero original csv, debe marcar dichos campos. No importa el orden pero los campos restantes deben ser vinculados, es decir si un campo nominal es nombre_ciclo, el resto de campo sdel ciclo como codigo_cidclo, numero_horas etc... deben ir a continuación
			$pred='';
			$this->limpiaForm();
			$this->makeNombreFicheroDestino();
			$i=0;
			$select="SELECT ";
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
		//if($nfil==0) $sql.="WHERE ".$dim1." in (".$filtros.") ";
		$sql.="GROUP BY ".$dim1;
		}
	if($d==2)
		{
		//print("dim2");
		$dim2=$this->dimension2;
		$sfiltros1=$this->get_filtros($posicion,'string');
		$filtros2=$this->get_filtros($posicion+1,'array');
		$sf1=strlen($sfiltros1);	
		$sf2=sizeof($filtros2);	
		$nv=0;
		$nva=-1;
		$on=0;
		$sqlinicial="SELECT t1.".$dim1;
		foreach($filtros2 as $filtro2)
			{
			$nv++;
			$nva++;
			$sql.="(SELECT ";
			$sql.=$dim1." ,count(*) nal ";
			$sql.="FROM GIR_MATRICULA ";
			if($sf1!=0)
				{ 
				$sql.="WHERE ".$dim1." in (".$sfiltros1.") ";
				$sql.=" and ".$dim2." in ('".$filtro2."') ";
				}
			else
				{
				$sql.=" WHERE ".$dim2." in ('".$filtro2."') ";
				}
			if($f3!='') $sql.=" and ".$this->dimension3." in ('".$f3."')";
			$sql.=" GROUP BY ".$dim1.") as t".$nv;
			$sqlinicial.=",t".$nv.".nal as  nal".$filtro2;
			if( $on==1){ $sql.=" ON t".$nv.".".$dim1."=t".$nva.".".$dim1;$on=0;}
			if( $on==0 and $nv<$sf2){ $sql.=" LEFT JOIN ";$on=1;}
			}
		$sql=$sqlinicial." FROM ".$sql;
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
			//print_r($this->nficherodestino);exit();
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
			//print_r($this->query);exit();
			return 1;
	}
  public function genCsv($tipo='graficos'){
	$rutafichero=$this->ruta.'/'.$this->nficherodestino;
	$resc=1;
	if($tipo=='listados')
	{
		$qquery='q -H -d ";" "'.$this->query.'">'.$this->tmp;
		$resq=shell_exec ($qquery );
		print($qquery);
		$comando_comillas='sed "s/\'/\"/g" '.$this->tmp.'>'.$this->fcsv;
		$resc=shell_exec ($comando_comillas);
	}
	else{
		$qquery='q -H -d ";" "'.$this->query.'">'.$this->fcsv;
		$resq=shell_exec ($qquery );
		print($qquery);
		}
	if($resc and $resq)
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
