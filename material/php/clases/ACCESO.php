<?php 
 
class ACCESO {
  public $c; 
  private $csv_dir='';
  private $post='';
  public $dimension=0;
  public $f3=array();
  public function __construct($post)
	{
    	$this->c =$this->dbconnect(DB_HOST, DB_USER, DB_PASSWORD);
	mysqli_select_db($this->c,DB_DB);
	$this->c->set_charset("utf8");
	$this->post=$post;
	$this->dimension=$this->check_dimension(3);
	$this->dpos=$this->get_posicion($this->dimension);
	$this->dimension1='';
	$this->dimension2='';
	$this->dimension3='';
	$this->setdim($post);
	}
  public function setdim($post) 
	{
	if(isset($post['d1']) and $post['d1']!='0' and isset($post['d2']) and $post['d2']!='0' and isset($post['d3']) and $post['d3']!='0')
	{
	$this->dimension1=$post['d1'];
	$this->dimension2=$post['d2'];
	$this->dimension3=$post['d3'];
		
	return;
	}
	if(isset($post['d1']) and $post['d1']!='0')
	{
		$this->dimension1=$post['d1'];
		if(isset($post['d2']) and $post['d2']!='0')
			$this->dimension2=$post['d2'];
		elseif(isset($post['d3']) and $post['d3']!=0)
			$this->dimension2=$post['d3'];
	}
	elseif(isset($post['d2']) and $post['d2']!=0)
	{
		$this->dimension1=$post['d2'];
		if(isset($post['d3']) and $post['d3']!='0')
			$this->dimension2=$post['d3'];
	}
	else
		if(isset($post['d3']))	$this->dimension1=$post['d3'];
	} 
  public function procesar_post($p) {print_r($p);} 
  public function get_posicion($p) 
	{
	$adim=$this->get_dimensiones($this->post,'array');
	$pos=array();
		foreach($adim as $in=>$el)
			{
			if($el!='0') array_push($pos,$el);
			}
	return $pos;
	} 

  private function dbconnect() 
	{
    	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("<br/>No conexion servidor");
	$this->c=$conn;     
	mysqli_select_db($conn,DB_DB) or die ("<br/>No se puedo seleccionar la bases de datos");
	return $conn;
  	}
 
  public function check_dimension($dmax) 
	{
	$n=0;
	$at=$this->post;
	foreach($at as $k=>$el)
		{
		if(substr($k, 0, 1)=='d' and $el!='0') 
			{
			$n++;
			}
		}
	return $n;
	} 
  public function gen_csvs() 
	{
		$filtros3=array();
 		$fp = fopen('tmp.csv', 'w');
		$dim1=$this->dpos[0];
		$posicion=str_replace('d','',array_search($dim1,$this->post));
		$dim=$this->dimension;
		$cabecera=array('Matricula');
		#añadimos cabecera al fichero
		if($dim==1) array_push($cabecera,'NALUMNOS');
		elseif($dim==2)
		{
		$filtros2=$this->get_filtros($posicion+1,'array');
		foreach($filtros2 as $filtro2)
			array_push($cabecera,'NALUMNOS-'.$filtro2);
		}
		else
		{
		#hacemos un grafico para cada uno ded los valores de la d3
		$filtros3=$this->get_filtros(3,'array');
		#recogemos los filtros para nombrar los graficos
		$this->f3=$filtros3;
		
		$i=0;
		if(sizeof($filtros3)!=0)
		foreach($filtros3 as $filtro3)
			{
			$cabecera=array('Matricula');

 			$fp1 = fopen('tmp'.$i.'.csv', 'w');
			$filtros2=$this->get_filtros(2,'array');
			foreach($filtros2 as $filtro2)
				{
				array_push($cabecera,'NALUMNOS-'.$filtro2);
				}
				fputcsv($fp1, $cabecera);
				$sql=$this->gen_sql(2,$filtro3);
				//print(PHP_EOL.$sql." ".PHP_EOL);
				$res = mysqli_query($this->c,$sql);
					if (!$res=mysqli_query($this->c,$sql)) 
					{
					printf("Hay un Error: %s\n", mysqli_error($this->c));
					}
					else 
					{
					while ($row = mysqli_fetch_assoc($res))
					{
					fputcsv($fp1, $row);
					}
					}
			$i++;
			fclose($fp1);
			}
		}
		if($dim!=3)
		{
		fputcsv($fp, $cabecera);
	
		$sql=$this->gen_sql($this->dimension);
		$res = mysqli_query($this->c,$sql);
		if (!$res=mysqli_query($this->c,$sql)) {
			printf("Hay un Error: %s\n", mysqli_error($this->c));
		}
		else {
			while ($row = mysqli_fetch_assoc($res))
				{
				fputcsv($fp, $row);
				}
		}
		fclose($fp);
		}
	} 
  public function gen_sql($d,$f3='') 
	{
	if($d==0) return "No hay dimensiones";
	$dim1=$this->dpos[0];
	$posicion=str_replace('d','',array_search($dim1,$this->post));
	$sql='';
	$nfil=0;
	if($d==1)
		{
		//print("dim1");
		$filtros=$this->get_filtros($posicion,"string");
		if(strlen($filtros)=='') $nfil=1;
		$sql="SELECT ";
		$sql.=$dim1." ,count(*) nal ";
		$sql.="FROM GIR_MATRICULA ";
		if($nfil==0) $sql.="WHERE ".$dim1." in (".$filtros.") ";
		$sql.="GROUP BY ".$this->dpos[0];
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
	return $sql;
	} 
  public function gen_dim2() {print_r("dim2");} 
  public function gen_dim3() {print_r("dim3");} 
  public function get_d3values() {print_r("d3values");} 
  public function get_d2values() {print_r("d2values");} 
  public function get_dimensiones($d,$tipo) 
	{
	$sfiltro="";
	$afiltro=array();
	$keys=array_keys($this->post);
	$filtros = preg_grep("/^d/", $keys);
	
	if($tipo=='array')
		{
		foreach($filtros as $filtro) $afiltro[]=$this->post[$filtro];
		return $afiltro;
		}	
	else
		{
		foreach($filtros as $filtro) $sfiltro.="'".$this->post[$filtro]."',";
		$sfiltro=substr($sfiltro, 0, -1);
		return $sfiltro;
		}
	} 
  public function select($d) 
	{
	$sql="SELECT distinct (".$d.") FROM GIR_MATRICULA";
	$as=array();
	$res = mysqli_query($this->c,$sql);
	if(!$res=mysqli_query($this->c,$sql)) 
	{
	printf("Hay un Error: %s\n", mysqli_error($this->c));
	}
	else 
	{
	while ($row = mysqli_fetch_assoc($res))
	{
	array_push($as,$row[$d]);
	}
	}
	return $as;
	}
  public function get_filtros($d,$tipo) 
	{
	$sfiltro="";
	$dim1=$this->dpos[0];
	if(isset($this->dpos[1])) $dim2=$this->dpos[1];
	$afiltro=array();
	$keys=array_keys($this->post);
	$filtros = preg_grep("/^f".$d."/", $keys);
	if(sizeof($filtros)==0 and $d==2) 
		{
		return $this->select($dim2);
		}
	if(sizeof($filtros)==0 and $d==3) 
		{
		return $this->select($this->dimension3);
		}
	if($tipo=='array')
		{
		foreach($filtros as $filtro) $afiltro[]=$this->post[$filtro];
		return $afiltro;
		}	
	else
		{
		foreach($filtros as $filtro) $sfiltro.="'".$this->post[$filtro]."',";
		$sfiltro=substr($sfiltro, 0, -1);
		return $sfiltro;
		}
	} 
} 
?>
