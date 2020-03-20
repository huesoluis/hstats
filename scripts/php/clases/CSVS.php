<?php 

namespace hstats;
class CSVS {
  public $dimensiones; 
  public $dim_campos; 
  public $fichero_csv; 
  public $query; 
  public function __construct($fichero_csv='',$dimensiones='',$dim_campos=array()){
    	$this->fichero_csv = $fichero_csv;
    	$this->dimensiones = $dimensiones;
    	$this->dim_campos = $dim_campos;
	}
  public function makeQuery(){
	//detectar campos nominales, empiezan con g_ y puede marcan la separacion entre niveles
	//para ello el fichero original csv, debe marcar dichos campos. No importa el orden pero los campos restantes deben ser vinculados, es decir si un campo nominal es nombre_ciclo, el resto de campo sdel ciclo como codigo_cidclo, numero_horas etc... deben ir a continuación
	$pred='';
	$select='SELECT ';
	if(sizeof($this->dim_campos)==0 || sizeof($this->dimensiones)==0) return 0;

	$dimclaves=array_keys($this->dim_campos);
	//print_r($this->dimensiones);

	foreach($dimclaves as $d=>$v)
		{
		if(in_array($v,$this->dimensiones))
			{
			$select.=$this->dim_campos[$v][0].',';
			}
		}
	$select=trim($select,',').' FROM '.$this->fichero_csv.' ORDER BY ';
	foreach($dimclaves as $d=>$v)
		{
			print_r($v);
			print_r($this->dimensiones);
		if(in_array($v,$this->dimensiones))
			{
			$select.=$this->dim_campos[$v][0].',';
			}
		}
	$select=trim($select,',');
	
	$this->query=$select;
	print($select);
	return 1;
	}
  public function genCsv($fam='',$sql=''){
	$qquery="q -H -d ';' '".$this->query."'";
	$res=shell_exec ($qquery );
	print($res);
	return;
  }
  public function makeSelect($fam='',$sql=''){
   	return "select";
	}
   
}
 
?>
