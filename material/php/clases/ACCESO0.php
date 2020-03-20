<?php 
 
class ACCESO {
  public $c; 
  private $csv_dir='';
  private $post='';
  public function __construct($post){
    	$this->csv_dir=$dir;
    	$this->c =$this->dbconnect(DB_HOST, DB_USER, DB_PASSWORD)
	mysqli_select_db($this->c,DB_DB);
	$this->c->set_charset("utf8");
	$this->post=$this->procesar_post($post);
	}
  public function procesar_post($p) {print_r($p);} 

  private function dbconnect() {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)
        or die ("<br/>Could not connect to MySQL server");
    $this->c=$conn;     
    mysqli_select_db($conn,DB_DB)
        or die ("<br/>Could not select the indicated database");
    return $conn;
  }
   
  public function querycsv($vc,$sql){
 	$csv='';
    $res = mysqli_query($vc,$sql);
    if ($res){
      if (strpos($sql,'SELECT') === false){
      print("hay res pero no select");
	  return true;
      }
    }
    else{
      if (strpos($sql,'SELECT') === false){
      print("NO hay res pero no select");
        return false;
      }
      else{
      print("NO hay".mysqli_error($vc));
        return null;
      }
    }
 	$csv_export = '';
	// query to get data from database
	$field = mysqli_num_fields($res);
for($i = 0; $i < $field; $i++) {
  $csv.= mysqli_field_name($sql,$i).';';
}
    return;        
  }  
  

public function query_consultas($vc,$sql,$familia,$names){
 	$fp = fopen('tmp.csv', 'w');
	$csv='';
	$csvnames;
	$sql=str_replace('parametro1',$familia,$sql);
	$res = mysqli_query($vc,$sql);
        if($res)
	{
        if(strpos($sql,'SELECT') === false)
		{
	      print("hay res pero no select");
		  return true;
      		}
    	}
    	else{
	      if (strpos($sql,'SELECT') === false){
	      print("NO hay res pero no select");
        	return false;
	      }
	      else{
	      print("NO hay".mysqli_error($vc));
        	return null;
	      }
	    }
	$results = array();
	if($names=='genero')   
		$csvnames=array('Matrícula','MUJERES','HOMBRES');
	else	$csvnames=array($names,$names,'% '.$names);
	fputcsv($fp, $csvnames);
	if(mysqli_num_rows($res)==0) 
	{
	return;
    	}
	else
	{
	while ($row = mysqli_fetch_assoc($res))
	{
	if($names=='genero')   
		$row['Grado']=TOOLS::trunc($row['Grado'],2);
	elseif($names=='ofertas'){
		$familia='ofertas';
	}
	fputcsv($fp, $row);
    	}
	}
	fclose($fp);
	$str=file_get_contents('tmp.csv');
	$str=str_replace('"', "",$str);
	//write the entire string
	$familia=trim($familia);
	$familia=str_replace(',','',$familia);
	$file=str_replace(" ", "_", $familia);
	if($file=='') return;
	print($this->csv_dir);
	file_put_contents($this->csv_dir.$file.'.csv', $str);
    return;        
  } 
public function query_csv($vc,$sql,$familia,$names){
 	$fp = fopen('tmp.csv', 'w');
	$csv='';
	$csvnames;
	$sql=str_replace('parametro1',$familia,$sql);
	$res = mysqli_query($vc,$sql);
        if($res)
	{
        if(strpos($sql,'SELECT') === false)
		{
	      print("hay res pero no select");
		  return true;
      		}
    	}
    	else{
	      if (strpos($sql,'SELECT') === false){
	      print("NO hay res pero no select");
        	return false;
	      }
	      else{
	      print("NO hay".mysqli_error($vc));
        	return null;
	      }
	    }
	$results = array();
	if($names=='genero')   
		$csvnames=array('Matrícula','MUJERES','HOMBRES');
	else	$csvnames=array($names,$names,'% '.$names);
	fputcsv($fp, $csvnames);
	if(mysqli_num_rows($res)==0) 
	{
	      print("NO hay resultados");
	return;
    	}
	else
	{
	while ($row = mysqli_fetch_assoc($res))
	{
	if($names=='genero')   
		$row['Grado']=TOOLS::trunc($row['Grado'],2);
	elseif($names=='ofertas'){
		$familia='ofertas';
	}
	fputcsv($fp, $row);
    	}
	}
	fclose($fp);
	$str=file_get_contents('tmp.csv');
	$str=str_replace('"', "",$str);
	//write the entire string
	$familia=trim($familia);
	$familia=str_replace(',','',$familia);
	$file=str_replace(" ", "_", $familia);
	if($file=='') return;
	print($this->csv_dir);
	file_put_contents($this->csv_dir.$file.'.csv', $str);
    return;        
  } 

 
  public function query($vc,$sql){
    echo $sql; 
    $res = mysqli_query($vc,$sql);
    if ($res){
      if (strpos($sql,'SELECT') === false){
      print("hay res pero no select");
	  return true;
      }
    }
    else{
      if (strpos($sql,'SELECT') === false){
      print("NO hay res pero no select");
        return false;
      }
      else{
      print("NO hay".mysqli_error($vc));
        return null;
      }
    }
 
    $results = array();
    while ($row = mysqli_fetch_array($res)){
 
      $result = new AccesoQueryResults($this->csv_dir);
 
      foreach ($row as $k=>$v){
        $result->$k = $v;
      }
 
      $results[] = $result;
    }
    return $results;        
  }
}
 
?>
