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
	$this->nombrefichero="f";
	$this->fcsv='';
	$this->fjson='';
	}
  public function makeNombreFichero(){
	//limpiamos el array de campos de formulario y geenramos nombre para el fichero de salida
	$this->dim_form=array_unique($this->dim_form);
	if (($key = array_search('Elige', $this->dim_form)) !== false) {
    		unset($this->dim_form[$key]);
	}
	foreach($this->dim_form as $fn)
		$this->nombrefichero.="_".$fn;
	$this->nombrefichero.="";

	return;
	}
  public function makeQuery(){
	//detectar campos nominales, empiezan con g_ y puede marcan la separacion entre niveles
	//para ello el fichero original csv, debe marcar dichos campos. No importa el orden pero los campos restantes deben ser vinculados, es decir si un campo nominal es nombre_ciclo, el resto de campo sdel ciclo como codigo_cidclo, numero_horas etc... deben ir a continuación
	$pred='';
	$this->makeNombreFichero();
	$i=0;
	$select="SELECT ";
	if(sizeof($this->dim_campos)==0 || sizeof($this->dim_form)==0) return 0;
	//campos disponibles como dimensiones
	$dimclaves=array_keys($this->dim_campos);
	foreach($dimclaves as $d=>$v)
		{
		if($i>0)
			{
			$select=trim($select,"||','||");
			$select.="||'-n-'||";
			}
		$i++;
		if(in_array($v,$this->dim_form))
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
	
	$select=$select.' FROM '.$this->ficheroorigen.' ORDER BY ';
	foreach($dimclaves as $d=>$v)
		{
		if(in_array($v,$this->dim_form))
			{
			$select.=$this->dim_campos[$v][0].',';
			}
		}
	$select=trim($select,',');
	$this->query=$select;
	return 1;
	}
  public function genCsv($fam='',$sql=''){
	$rutafichero=$this->ruta.'/'.$this->nombrefichero;
	$qquery='q -H -d ";" "'.$this->query.'">'.$rutafichero.'.tmp';
	$comando_comillas='tr "\'" \'"\'< '.$rutafichero.'.tmp>'.$rutafichero.'.csv';
	$res=shell_exec ($qquery );
	$resc=shell_exec ($comando_comillas);
	$this->fcsv=$rutafichero.'.csv';
	$this->fjson=$rutafichero.'.json';
	if($resc)
		return 1;
	else return 0;
  }
  public function genJson($fam='',$sql=''){
	$comando_json="python3 gen_json_dosniveles.py ".$this->fcsv." > ".$this->fjson;
	print($comando_json);
	$res=shell_exec ($comando_json );
	$comando_comprobacion="php comprobacion_json.php ".$this->fjson;
	$rescjson=shell_exec ($comando_comprobacion );
	if($rescjson)
		return 1;
	else return 0;
  }
  public function makeSelect($fam='',$sql=''){
   	return "select";
	}
   
}
 
?>
