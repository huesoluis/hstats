<?php 

namespace hstats;
class CSVS {
  public $dim_data; 
  public $fichero_csv; 
  public $query; 
  public function __construct($fichero_csv='',$dim_data=''){
    	$this->fichero_csv = $fichero_csv;
    	$this->dim_data = $dim_data;
	}
  public function makeQuery(){
	//detectar campos nominales, empiezan con g_ y puede marcan la separacion entre niveles
	//para ello el fichero original csv, debe marcar dichos campos. No importa el orden pero los campos restantes deben ser vinculados, es decir si un campo nominal es nombre_ciclo, el resto de campo sdel ciclo como codigo_cidclo, numero_horas etc... deben ir a continuación
	$pred='';
	$select=$this->makeSelect();
	if(sizeof($this->dim_data)==0) return 0;
	$query="SELECT c8,c2,c1 FROM $this->fichero_csv ORDER BY ";
	foreach($this->dim_data as $d)
		{
		$pred.=$d.',';
		}
	$pred=trim($pred,',');
	$query="SELECT ".$pred." FROM ".$this->fichero_csv." ORDER BY ".$pred;
	$this->query=$query;
	return trim($query,',');
	}
  public function genCsv($fam='',$sql=''){
	$qquery="q -d ';' '".$this->query."'";
	$res=shell_exec ($qquery );
	print($res);
	return;
  }
  public function makeSelect($fam='',$sql=''){
   	return "select";
	}
   
}
 
?>
