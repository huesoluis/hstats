<?php 
include '../config.php';
class CSVS {
  public $dim_form; 
  public $dim_campos; 
  public $query; 
  public function __construct($ruta='',$dim_form=array(),$dim_campos=array(),$tabla='',$tipo='graficos',$post=0,$cevolutivo=''){
	require_once("tablas.php");

	$this->fcsv='';
	$this->fjson='';
	$this->tmp='nofile';
	$this->tabla= $tabla;
	$this->post= $post;
	$logfile='log/weblog'; 
	$this->logfile=fopen($logfile,'a+');
	fwrite($this->logfile,"pruebas");
	#límite de registros en mysql
	$this->limit=100000;
	$this->tablahtml=$tablahtml;
	$this->c =$this->dbconnect(DB_HOST, DB_USER, DB_PASSWORD);
	$this->dim_form=$dim_form;
  $this->dim_campos = $dim_campos;
	//dimension, hasta 3 q es el máximo
	$this->dimension=sizeof($this->dim_form);
	
	if(!$this->post) 
	{	
		print_r("INICIANDO CSV, DIMESION: ");
		print_r($this->dimension);
	}

	$this->ruta=$ruta;
	if($cevolutivo=='') $cevolutivo='*';
	$this->cevolutivo=$cevolutivo;
	if($tipo=='listados')
		$this->nficherodestino=$this->makeNombreFicheroDestinoListados();
	elseif(($tipo=='graficos' or $tipo=='evolutivos') and $this->dimension<=2)
		$this->nficherodestino=$this->makeNombreFicheroDestino($tipo);
	elseif($tipo=='tablas')
		$this->nficherodestino=$this->makeNombreFicheroDestinoTablas($tipo);

	if($tipo=='evolutivos') $this->func="SUM";
	else $this->func="COUNT";
	$this->conexion = new \mysqli('localhost',DB_USER,DB_PASSWORD,DB_DB);
	
	if (!$this->conexion->set_charset("utf8")) {
		printf("Error loading character set utf8: %s\n", $mysqli->error);
	    	exit();
	}
	if ($this->conexion->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	} 
	}
  private function dbconnect() 
	{
    	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DB) or die ("<br/>No conexion servidor");
	$this->c=$conn;     
	mysqli_select_db($conn,DB_DB) or die ("<br/>No se puedo seleccionar la bases de datos");
	return $conn;
  	}

  public function quitarAcentos($s,$t=0){
		//Reemplazamos la A y a
		if($t==0)
		$cadena = str_replace(
		array('Á','á','É','é', 'Í','í','Ó','ó','Ú','ú','Ñ','ñ','.'),
		array('A', 'a', 'E', 'e', 'I', 'i', 'O', 'o', 'U','u','N','n',''),
		$s
		);
		elseif($t==1)
		$cadena = str_replace(
		array('Á','á','É','é', 'Í','í','Ó','ó','Ú','ú','Ñ','ñ'),
		array('A', 'a', 'E', 'e', 'I', 'i', 'O', 'o', 'U','u','N','n'),
		$s
		);
		$cadena = utf8_encode($cadena);	
		return $cadena;
	}
  public function genTabla1d($datos){
		//añadimos formulario para el filtro de datos, solo para el caso de q la primera dimension sea el centro
		$tabla='<input id="filtrotablas" class="form-control row" type="text" placeholder="Introduce valor a filtrar">';
		$tabla.='<table class="table table-striped">';
		$cabecera='';
		$cuerpo='';
		$cabecera='<thead><tr>';
		$cabecera.='<th>'.$this->dim_form[0].'</th>';
		$cabecera.='<th>Matrícula</th>';
		$cabecera.='</tr></thead>';
		$cuerpo.="<tbody>";
		foreach($datos as $fila)
		{
			$cuerpo.="<tr>";
			foreach($fila as $elto)
			{
				$cuerpo.="<td>$elto</td>";
			}
			$cuerpo.="</tr>";
		}
		$tabla.=$cabecera.$cuerpo."</table>";
		return $tabla;
	}
  public function genTabla2d($datos){
		$tabla='<input id="filtrotablas" class="form-control row" type="text" placeholder="Introduce el centro">';
		$tabla.='<table class="table table-striped">';
		$cabecera='';
		$cuerpo='';
		$cabecera='<thead><tr>';
		$cabecera.='<th>'.$this->dim_form[0].'</th>';
		$cabecera.='<th>'.$this->dim_form[1].'</th>';
		$cabecera.='<th>Matrícula</th>';
		$cabecera.='</tr></thead>';
		//Cuerpo de la tabla
		$cuerpo.="<tbody>";
		$nfila=0;
		$fila_nueva='';
		$elto_anterior='nuevo';
		$elto_nuevo='';
		foreach($datos as $fila)
		{
			$fila_anterior=$fila_nueva;
			$fila_nueva=$fila;
			$nfila++;
			$cuerpo.="<tr>";
			$neltos=0;
			foreach($fila as $elto)
			{
				$neltos++;
				if($neltos==1)
				{
					$elto_anterior=$elto_nuevo;
					$elto_nuevo=$elto;
					if($elto_anterior!=$elto_nuevo)
						$cuerpo.="<td>$elto</td>";
					else
						$cuerpo.="<td></td>";
				}
				else
					$cuerpo.="<td>$elto</td>";
			}
				$cuerpo.="</tr>";
		}
		$tabla.=$cabecera.$cuerpo."</table>";
		//print($tabla);exit();
		return $tabla;	
	}
  public function genTabla3d($datos,$vdim2,$vdim3){
		$tabla='<input id="filtrotablas" class="form-control row" type="text" placeholder="Introduce el centro">';
		$tabla='<table class="table table-striped">';
		$rowspan=sizeof($vdim2);
		$cabecera='';
		$cuerpo='';
		$cabecera='<thead><tr>';
		$cabecera.='<th>'.$this->dim_form[0].'</th>';
		$cabecera.='<th>'.$this->dim_form[1].'</th>';
	//construimos cabecera, como solo va la dimension 3 solo hay una fila
		foreach($vdim3 as $cab)
			$cabecera.='<th>'.$cab.'</th>';
		$cabecera.='</tr></thead>';
		//Cuerpo de la tabla
		$cuerpo.="<tbody>";
		$nfila=0;
		$fila_nueva='';
		$elto_anterior='nuevo';
		$elto_nuevo='';
		foreach($datos as $fila)
		{
			$fila_anterior=$fila_nueva;
			$fila_nueva=$fila;
			$nfila++;
			$cuerpo.="<tr>";
			$neltos=0;
			foreach($fila as $elto)
			{
				$neltos++;
				if($neltos==1)
				{
					$elto_anterior=$elto_nuevo;
					$elto_nuevo=$elto;
					if($elto_anterior!=$elto_nuevo)
						$cuerpo.="<td>$elto.</td>";
					else
						$cuerpo.="<td></td>";
				}
				else
					$cuerpo.="<td>$elto</td>";
			}
				$cuerpo.="</tr>";
		}
		$tabla.=$cabecera.$cuerpo."</table>";
		return $tabla;	
	
	}
  public function genTabla($t,$ad3=array(),$aresc=array()){
		$th='<table class="table table-striped"><thead><tr>';

		if($this->dimension==3)
		{
			$f=0;
			foreach($aresc as $t)
			{
			if($t=='') continue;
				$i=0;
				$array_datos=explode(PHP_EOL,$t);
				if($f==0){
						$th.='<th>'.$this->dim_form[2].'</th>';
						$cabecera=explode(';',$array_datos[0]);
						foreach($cabecera as $c)
							$th.='<th>'.$c.'</th>';
						$th.='</tr></thead>';
						$th.='<tbody>';
					}
				foreach($array_datos as $a)
				{
					$fdatos=explode(';',$a);
					if($fdatos[0]=='NODATA' or $fdatos[1]=='NODATA') continue;
					$i++;
					if($i==1 || strlen($a)==0) continue;
					//$fdatos=explode(';',$a);
					$th.='<tr>';	
					if($i==2) $th.='<td><b>'.$ad3[$f].'</b></td>';	
					else $th.='<td></td>';	
					//if($fdatos[0]=='NODATA' or $fdatos[1]=='NODATA') continue;
					foreach($fdatos as $fd)
						$th.='<td>'.$fd.'</td>';	
					$th.='</tr>';	
				}
			
				$f++;
			}
			$th.='</tbody><table>';
		}
		elseif($this->dimension<=2)
		{
			$array_datos=explode(PHP_EOL,$t);
			array_pop($array_datos);
			$i=0;	
			$cabecera=explode(';',$array_datos[0]);
			
			foreach($cabecera as $c)
				$th.='<th>'.$c.'</th>';
			$th.='</tr></thead>';
			$th.='<tbody>';
		
			foreach($array_datos as $a)
			{
				$i++;
				if($i==1) continue;
				$fdatos=explode(';',$a);
				if($fdatos[0]=='NODATA' or $fdatos[1]=='NODATA') continue;
				$th.='<tr>';	
				foreach($fdatos as $fd)
					$th.='<td>'.$fd.'</td>';	
				$th.='</tr>';	
			}
			 $th.='</tbody><table>';
		}
		return $th;

	}
  public function getDataTablas(){
		$resq='';
		$aresconsultas=array();
		$claves_dim3=array();
		$indicedim1=$this->dim_form[0];
		$valordim1=$this->dim_campos[$indicedim1];
		if($this->dimension==1)
		{
			
			$consulta=$this->makeQueryTablas1d($valordim1);
			$datostabla=$this->ejecutarConsulta($consulta);
			$tablahtml=$this->genTabla1d($datostabla);
		}
		elseif($this->dimension==2)
		{
			$indicedim2=$this->dim_form[1];
			$valordim2=$this->dim_campos[$indicedim2];
			$consulta=$this->makeQueryTablas2d();
			$datostabla=$this->ejecutarConsulta($consulta);
			$tablahtml=$this->genTabla2d($datostabla);
		}
		elseif($this->dimension==3)
		{
			$indicedim2=$this->dim_form[1];
			$indicedim3=$this->dim_form[2];
			$valordim2=$this->dim_campos[$indicedim2];
			$valordim3=$this->dim_campos[$indicedim3];
			$valores_dim2=$this->getClavesDim($valordim2,$this->limit);
			$valores_dim3=$this->getClavesDim($valordim3,$this->limit);
			$consulta=$this->makeQueryTablas3d($valores_dim2,$valores_dim3);
			$datostabla=$this->ejecutarConsulta($consulta);
			$tablahtml=$this->genTabla3d($datostabla,$valores_dim2,$valores_dim3);
		}
		$ftabla="/datos/websfp/desarrollo/hstats/versiones/vagency/scripts/datos/datos_tablas/$this->nficherodestino";
		if(!$this->post) print("ABRIENDO FICHERO DE TABLAS: ".$ftabla); 
		$fp = fopen($ftabla,'w');
		fwrite($fp,htmlentities($tablahtml));
		fclose($fp);
	return $tablahtml;
	}
  public function getDataGraficos(){
			//generamos la conslta
			if($this->dimension<=2)
				$consulta=$this->makeQueryGraficos2d($this->dimension);
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
			//$cjson=$this->genJson();
			$cjson_php=$this->genJsonPhp();
			//print("FICHEROi JSON: ");print($this->fjson);exit();
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
			//limpiamos el array de campos de formulario y generamos nombre para el fichero de salida
			$this->dim_form=array_unique($this->dim_form);
			foreach($this->dim_form as $key=>$df)
					{
					if(!in_array($df,$dimclaves))
								unset($this->dim_form[$key]);
					}
			if(sizeof($this->dim_form)==0) return 0;
			//reseteamos los indices
			$this->dim_form=array_values($this->dim_form);
			//para el caso de graficos evolutivos el primer valor siempre es el año
			if($tipo=='evolutivos') 
				{
				$neltos=count($this->dim_form);
				if(!in_array('anio',$this->dim_form)) array_unshift($this->dim_form,"anio");
				else
					if($this->dim_form[0]=='anio' and $neltos>1)
					{
						$tmp=$this->dim_form[1];
						$this->dim_form[0]=$tmp;
						$this->dim_form[1]='anio';
					}
				}
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
  public function makeNombreFicheroDestinoTablas(){
			$f='f';
			$i=0;
			foreach($this->dim_form as $fn)
				{
				$i++;
				$f.="_".$fn;
				}
			return $f.'_'."tablas.html";
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
				{
				return $f.'_'.$this->quitarAcentos(str_replace(' ','_',$dim3))."_$tipo";
				}
			else	return $f.'_'."$tipo";
	}
  public function getClavesDim($d){
			if(!$this->post) print("en getclaves $d".PHP_EOL);
			#$sql_mysql="SELECT distinct($d) FROM $this->tabla WHERE $d is not null LIMIT $this->limit";
			$sql_mysql="SELECT distinct($d) FROM $this->tabla and $d is not null LIMIT $this->limit";
			if(!$this->post) print("en getclaves $sql_mysql".PHP_EOL);
			$res=$this->ejecutarConsulta($sql_mysql);	
			foreach($res as $v)
				foreach($v as $sk=>$sv)
					$ares[]=$sv;			
			return $ares;
	}
  public function makeQueryTablas1d($vdim1){
		//creamos la consulta 
		$sql="SELECT $vdim1, IFNULL(SUM(se.nalumnos),0) AS numalumnos from $this->tabla GROUP BY $vdim1";
		$i=0;
		return $sql;
	}
  public function makeQueryTablas2d(){
		$i=0;
		//nombre dimension 1
		$dim1=$this->dim_form[0];
		$dim2=$this->dim_form[1];
		//valores dimension 1
		$valordim1=$this->dim_campos[$dim1];
		$valordim2=$this->dim_campos[$dim2];
		$inddim1=$this->dim_form[0];
		$valordim1=$this->dim_campos[$inddim1];
		$sql='SELECT '.$valordim1.','.$valordim2;
		$dim2=$this->dim_form[1];
		$sql.=", IFNULL(sum(se.nalumnos),0) as v".$i;
		$sql.=" FROM $this->tabla GROUP BY $valordim1,$valordim2";
		//print($sql);exit();
	return $sql;
	}
  public function makeQueryTablas3d($valores_dim2,$valores_dim3){
		//decidimos q dimensiones de las 3 serán verticales, de momento cogemos las dos primeras
		//$dim_verticales=getDimVerticales()
		$i=0;
		//nombre dimension 1
		$dim1=$this->dim_form[0];
		//valores dimension 1
		$valordim1=$this->dim_form[0];
		$valordim2=$this->dim_form[1];
		$inddim1=$this->dim_form[0];
		$inddim2=$this->dim_form[1];
		$inddim3=$this->dim_form[2];

		$valordim1=$this->dim_campos[$inddim1];
		$valordim2=$this->dim_campos[$inddim2];
		$valordim3=$this->dim_campos[$inddim3];
		
		$sql='SELECT '.$valordim1.','.$valordim2;
		//$dim2=$this->dim_form[1];
		//$dim3=$this->dim_form[2];
		foreach($valores_dim3 as $vd3)
		{
			$i++;
			$sql.=", sum(CASE WHEN (".$valordim3."='".$vd3."') THEN se.nalumnos ELSE 0 END) as v".$i;
		}
		$sql.=" FROM $this->tabla GROUP BY $valordim1,$valordim2";
	return $sql;
	}
  public function makeQueryTablas3d_old(){
			//si estamos en 3d haremos un grafico de 2d para cada valor de la última dimension
			$indicedim1=$this->dim_form[0];
			$valordim1=$this->dim_campos[$indicedim1];
			$claves_dim1=$this->getClavesDim($valordim1,$this->limit);

			$indicedim2=$this->dim_form[1];
			$valordim2=$this->dim_campos[$indicedim2];
			$claves_dim2=$this->getClavesDim($valordim2,$this->limit);

			$indicedim3=$this->dim_form[2];
			$valordim3=$this->dim_campos[$indicedim3];
			$claves_dim3=$this->getClavesDim($valordim3,$this->limit);
			if($this->post==0)
			{
				print("GENERANDO TABLAS: TAMAÑO DIMENSION 1: ");
				print(PHP_EOL);
				print($valordim1);
				print(sizeof($claves_dim1));
				print(PHP_EOL);
				print("GENERANDO TABLAS: TAMAÑO DIMENSION 2: ");
				print($valordim2);
				print(sizeof($claves_dim2));
				print(PHP_EOL);
				print("GENERANDO TABLAS: TAMAÑO DIMENSION 3: ");
				print($valordim3);
				print(sizeof($claves_dim3));
				print(PHP_EOL);
			}
			$asql=array();
			foreach($claves_dim3 as $cd)
				{
				$sql=$this->makeQueryGraficos2d(2,$cd,$valordim3,$cd);
				$asql[]=$sql;
				}
			return $asql;
	}	
  public function makeQueryGraficos3d(){
			//si estamos en 3d haremos un grafico de 2d para cada valor de la última dimension
			$indicedim3=$this->dim_form[2];
			$valordim3=$this->dim_campos[$indicedim3];
			$claves_dim3=$this->getClavesDim($valordim3,$this->limit);
			$csv='';
			foreach($claves_dim3 as $cd)
				{
				$sql=$this->makeQueryGraficos2d(2,$cd,$valordim3,$cd);
				$this->nficherodestino=$this->makeNombreFicheroDestino('graficos',2,$cd);
				$csvtmp=$this->genCsv('graficos');
				//si obtenemos una ruta de fcihero no vacia (pq no hay datos)
				if($csvtmp!='')	$csv.='#scripts/php/'.$csvtmp;
				}
			return $csv;
	}	
  public function makeQueryGraficos2d($d=1,$cd3='',$clave3d='',$valor3d=''){
			$pred='';
			//if($this->limpiaForm()==0) return '0';
			$this->makeNombreFicheroDestino('graficos',$d,$cd3);
			$i=0;
			if(sizeof($this->dim_campos)==0 || sizeof($this->dim_form)==0) return 0;
			//campos disponibles como dimensiones
			$dimclaves=array_keys($this->dim_campos);
	
			$dim1=$this->dim_campos[$this->dim_form[0]];
			$sql='';
			$nfil=0;
			if($d==1)
				{
				$sql="SELECT ";
				$sql.=$dim1." ,".$this->func."(".$this->cevolutivo.") nal ";
				$sql.="FROM $this->tabla";
				$sql.=" GROUP BY ".$dim1." ORDER BY nal desc";
			
				}
			if($d==2)
				{
				$whereppal='';
				$wheresec='';
				if($clave3d!='')
					{
					$whereppal=" WHERE $clave3d='$valor3d' ";
					$wheresec=" and $clave3d='$valor3d' ";
					}
				$indicedim2=$this->dim_form[1];
				$dim2=$this->dim_campos[$indicedim2];
				$claves_dim2=$this->getClavesDim($dim2,$this->limit);
				$nv=0;
				$nva=-1;
				$nc=0;
				//quitamos caracteres como el punto q luego pueden dar error
				$rendim1=str_replace('.','',$dim1);
				$select="SELECT IFNULL(t0.$dim1,'NODATA') AS '$rendim1',  ";
				//creamos la clausuala para ordenar la consulta
				foreach($claves_dim2 as $cd)
					{
					$rcd=preg_replace('/\s/', '', $cd);
					$rcd=preg_replace('/-/', '', $rcd);
					$rcd=str_replace('.', '', $rcd);
					//$rcd=$this->quitarAcentos($rcd);
					$nc++;
					$select.="IFNULL(t$nc.num,0) AS 'al$rcd',";
					}
				$select=trim($select,',');
				$sql="$select FROM (SELECT $dim1, IFNULL(".$this->func."(".$this->cevolutivo."),0) as num FROM $this->tabla $whereppal GROUP BY $dim1 LIMIT $this->limit) as t0 LEFT JOIN ";
				$ncampos=sizeof($claves_dim2);
				$n=0;
				foreach($claves_dim2 as $cd)
				{
					$n++;
					$sql.="(SELECT $dim1, IFNULL(".$this->func."(".$this->cevolutivo."),0) as num FROM $this->tabla WHERE $dim2='$cd' $wheresec  GROUP BY $dim1 LIMIT $this->limit) as t$n";
					$tmp=$n-1;
					$sql.=" ON t$n.$dim1=t0.$dim1 ";	
					if($n<$ncampos)
						$sql.=" LEFT JOIN ";
				}
				}
	//file_put_contents('csvtemp.txt', $sql);
	$this->query=$sql;
	return $sql;
	}
  public function makeQueryListados(){
			if(sizeof($this->dim_campos)==0 || sizeof($this->dim_form)==0) return 0;
			//para ello el fichero original csv, debe marcar dichos campos. No importa el orden pero los campos restantes deben ser vinculados, es decir si un campo nominal es nombre_ciclo, el resto de campo sdel ciclo como codigo_cidclo, numero_horas etc... deben ir a continuación
			$pred='';
			$this->limpiaForm();
			$this->makeNombreFicheroDestino();
			$i=$ndim=0;
			$select="SELECT CONCAT( ";
			$order=' ORDER BY ';
			$groupby='';
			//campos disponibles como dimensiones
			$dimclaves=array_keys($this->dim_campos);
			$orderense=' field(cod_enseñanza_agrupada,"INFANTIL","PRIMARIA","ESO","BACHILLERATO","BÁSICA","GRADO MEDIO","GRADO SUPERIOR","ARTÍSTICAS","IDIOMAS","ESPECIAL","ADULTOS","DEPORTIVAS") ';
			//obtenemos los campos informativos de cada campo principal
			foreach($this->dim_form as $v)
				{
				$ndim++;
				if($ndim==1) $dimorder=$v;
				if(in_array($v,$dimclaves))
					{
					if(sizeof($this->dim_campos[$v])>=1) 
						{
							$k=0;
							foreach($this->dim_campos[$v] as $k=>$c)
							{
							$groupby.=$c.",";
							if($k>0)
							{
								$select.="',\\\"$c\\\":'";
							}
							else
							{
								$select.="'\\\"$c\\\":'";
							}
							$select.=",'\\\"',";
							$select.="$c";
							$select.=",'\\\"',";
							if($c=='cod_enseñanza_agrupada')
								$order.="$orderense,";
							else
								$order.="$c,";
							$k++;
							}
						}	
					}
				$select.="'-n-',";
				}
			$order=trim($order,',');
			$select=substr($select,0,-7);
			//$select=$select.') FROM '.$this->tabla.' GROUP BY '.trim($groupby,",").' HAVING COUNT(*)>=1 /ORDER BY '.$order.' LIMIT '.$this->limit;
			//if($dimorder=='enseñanza') $norder=$order.' field(cod_enseñanza_agrupada,"INFANTIL","PRIMARIA","ESO","BACHILLERATO","BÁSICA","GRADO MEDIO","GRADO SUPERIOR","ARTÍSTICAS","IDIOMAS","ESPECIAL","ADULTOS","DEPORTIVAS"), '.$order;
			//$norder=' ORDER BY field(cod_enseñanza_agrupada,"INFANTIL","PRIMARIA","ESO","BACHILLERATO","BÁSICA","GRADO MEDIO","GRADO SUPERIOR","ARTÍSTICAS","IDIOMAS","ESPECIAL","ADULTOS","DEPORTIVAS"), '.$order;
			//else $norder=$order;
			$select=$select.') FROM '.$this->tabla.' GROUP BY '.trim($groupby,",").' HAVING COUNT(*)>=1 '.$order.'  LIMIT '.$this->limit;
			$this->query=$select;
			//print($select);exit();
			return 1;
	}
  public function ejecutarConsulta($q){
		if(!$this->post) print("EJECUTANDO CONSULTA: ".PHP_EOL);
		if(!$this->post) print($q.PHP_EOL);
		$result= $this->conexion->query($q);
		if($result->num_rows > 0) 
		{
    		while($row = $result->fetch_assoc()) {
					$res[]=$row;
				}
			return $res;
		}
		else
		{
			print("ERROR"); 
			print($result->error); 
			return 0;
		}
	}
  public function executeQuery($f,$q,$tipo='file',$origen='cl',$head='si'){
	//print($q);exit();
	if($tipo=='file')
		{
		$qquery='q -H -d ";" "'.$q.'" > '.$f;
		$qquery='q -H -d ";" "'.$q.'"';
		}
	else
		{
		if($origen=='cl') //si se ejecuta dese linea de comandos
			{
			$qquery='mysql -u'.DB_USER.' -p'.DB_PASSWORD.' '.DB_DB.' -N -e "'.$q.'"';
			$resq=shell_exec ($qquery );
			}
		elseif($origen=='con')
			{
			$resq='';
			$cabecera='';
			$i=1;
			$result= $this->conexion->query($q);
			if($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {
					foreach($row as $k=>$v)
					{
						if($i==1 and $head=='si')
						{
							$cabecera=implode(';',array_keys($row));
    							$resq.=$cabecera;
    							$resq.="\n";
							$i=0;
						}
    						$resq.=$row[$k].";";
					}
    						$resq=substr($resq,0,-1);
    						$resq.="\n";
				}
			} else {
				 if(!$this->post)  echo "0 results $q";
				}
			}
	
		}
	return $resq;
	}

  public function genCsv($tipo='graficos'){
		$rutafichero=$this->ruta.'/'.$this->nficherodestino;
		$resq='';
		if($tipo=='listados')
		{
			$resq=$this->executeQuery($this->tmp,$this->query,'sql','con','no');
			if(!$this->post) print(PHP_EOL."CREANDO CSV: ".PHP_EOL);
			if(!$this->post) print($this->fcsv.PHP_EOL);
			$ficherodestino=''.$this->fcsv;
			//$comando_comillas='sed "s/\'/\"/g" '.$this->tmp.'>'.$this->fcsv;
			$fp = fopen($ficherodestino, 'w');
			fwrite($fp,$resq);
			fclose($fp);
		}
		else{
			$rutafichero=$this->ruta.'/'.$this->nficherodestino.'.csv';
			$resq=$this->executeQuery($this->nficherodestino,$this->query,'sql','con');
			$cadd=preg_replace('/\t/',';',$resq);
			if(strlen($cadd)>1) 
			{
				$fp = fopen($rutafichero, 'w');
				fwrite($fp,$cadd);
				fclose($fp);
			}
			else $rutafichero='';
			}
		return $rutafichero;
  }
  public function makeUtf8(){
			$data = file_get_contents($this->fcsv);
			//$data = mb_convert_encoding($data, 'UTF-8', 'ANSI_X3.4-1968');
			file_put_contents('tmp/temporal', $data);
			
			}
  public function genFicheroJson2niveles($fcsv='',$fjson=''){
				$nl=0;
				$lf='';

				$fdestino = fopen($fjson, "w");
				$handle = fopen($fcsv, "r");
				while (($line = fgets($handle)) !== false) {
					$nl++;
					$line=str_replace("\n","",$line);
					$l2=$line;
					$l3=explode("-n-",$l2);

					$lactual=$l3[0];
					
					$children1=$l3[1];

					if($nl==1)
					{
						$lf="[{".$lactual;
						$lf.=",\"children1\":[{".$children1."}";
						$lant=$lactual;
						continue;
					}
					if($lactual==$lant)
					{
						$lf.=",{".$children1."}";
					}
					else
					{
						$lf.="]},{".$lactual.",\"children1\":[{".$children1."}";
					}
					$lant=$lactual;

				}
				fclose($handle);
				$lf.="]}]";
				$lf=str_replace('""','"',$lf);
				$res=fwrite($fdestino,$lf);
				fclose($fdestino);
	}
  public function genFicheroJson3niveles($fcsv='',$fjson=''){
		
				$nl=0;
				$lf='';
				//$fcsv=$argv[1];

				$fdestino = fopen($fjson, "w");
				$handle = fopen($fcsv, "r");
				while (($line = fgets($handle)) !== false) {
					$nl++;
					$line=str_replace("\n","",$line);
					$l2=$line;
					$l3=explode("-n-",$l2);

					$lactual=$l3[0];
					
					$children1=$l3[1];
					$children2=$l3[2];

					if($nl==1)
					{
						$lf="[{".$lactual;
						$lf.=",\"children1\":[{".$children1;
						$lant=$lactual;
						$lantchildren1=$children1;
						$lf.=",\"children2\":[{".$children2."}";
						continue;
					}
					if($lactual==$lant)
					{
						if($children1==$lantchildren1)
							$lf.=",{".$children2."}";
						else		
						{
							$lf.="]},{".$children1;
							$lf.=",\"children2\":[{".$children2."}";
						}
					}
					else
					{
						$lf.="]}]},{".$lactual.",\"children1\":[{".$children1;
						$lf.=",\"children2\":[{".$children2."}";
					}
					$lant=$lactual;
					$lantchildren1=$children1;
				}
				fclose($handle);
				$lf.="]}]}]";
				$res=fwrite($fdestino,$lf);
				fclose($fdestino);
		return;
	}
  public function genFicheroJson4niveles($fcsv='',$fjson=''){
				$nl=0;
				$lf='';
				$fdestino = fopen($fjson, "w");
				$handle = fopen($fcsv, "r");
				while (($line = fgets($handle)) !== false) {
					$nl++;
					$line=str_replace("\n","",$line);
					$l2=$line;
					$l3=explode("-n-",$l2);

					$lactual=$l3[0];
					
					$children1=$l3[1];
					$children2=$l3[2];
					$children3=$l3[3];

					if($nl==1)
					{
						$lf="[{".$lactual;
						$lf.=",\"children1\":[{".$children1;
						$lant=$lactual;
						$lantchildren1=$children1;
						$lantchildren2=$children2;
						$lf.=",\"children2\":[{".$children2;
						$lf.=",\"children3\":[{".$children3."}";
						continue;
					}
					if($lactual==$lant)
					{
						if($children1==$lantchildren1)
						{
							if($children2==$lantchildren2)
								$lf.=",{".$children3."}";
							else		
							{
								$lf.="]},{".$children2;
								$lf.=",\"children3\":[{".$children3."}";
							}
						}
						else		
						{
							$lf.="]}]},{".$children1;
							$lf.=",\"children2\":[{".$children2;
							$lf.=",\"children3\":[{".$children3."}";
						}
					}
					else
					{
						$lf.="]}]}]},{".$lactual.",\"children1\":[{".$children1;
						$lf.=",\"children2\":[{".$children2;
						$lf.=",\"children3\":[{".$children3."}";
					}
					$lant=$lactual;
					$lantchildren1=$children1;
					$lantchildren2=$children2;
				}
				fclose($handle);
				$lf.="]}]}]}]";
				fwrite($fdestino,$lf);
						
				fclose($fdestino);
		return;
	}
  public function genJsonPhp($fam='',$sql=''){
			$res='';
			$dirppal='';

			if($this->dimension==1)
				$pycom='gen_json_unnivel.py';
			elseif($this->dimension==2)
			{
				$pycom='gen_json_dosniveles.py';
				$res=$this->genFicheroJson2niveles($this->fcsv,$this->fjson);
			}
			elseif($this->dimension==3)
			{
				$pycom='gen_json_tresniveles.py';
				$res=$this->genFicheroJson3niveles($this->fcsv,$this->fjson);
			}
			elseif($this->dimension==4)
			{
				$pycom='gen_json_cuatroniveles.py';
				$res=$this->genFicheroJson4niveles($this->fcsv,$this->fjson);
			}
				return 1;
  }
  public function genJson($fam='',$sql=''){
			$res='';
			$dirppal='';
			//print("Generando json dimension: ".$this->dimension);exit();
			if($this->dimension==1)
				$pycom='gen_json_unnivel.py';
			elseif($this->dimension==2)
				$pycom='gen_json_dosniveles.py';
			elseif($this->dimension==3)
				$pycom='gen_json_tresniveles.py';
			elseif($this->dimension==4)
				$pycom='gen_json_cuatroniveles.py';

			//$comando_json="/usr/bin/python3 $com $dirppal$this->fcsv > $dirppal$this->fjson";
			if($this->post)
			{
				$comando_delutf8="rm -f  datos_listados/utf8.csv";
				$res0=shell_exec($comando_delutf8);
				$comando_utf8="iconv -t ascii//TRANSLIT -f utf8  $this->fcsv -o  datos_listados/utf8.csv";
				//$comando_utf8="iconv -c -f UTF-8 -t ISO-8859-1//TRANSLIT  $this->fcsv -o  datos_listados/utf8.csv";
				//$this->makeUtf8();
				chmod("datos_listados/utf8.csv", 0777);
				//$comando_utf8="cp  $this->fcsv  datos_listados/utf8.csv";
				$res1=shell_exec($comando_utf8);
				$comando_json="/usr/bin/python3 $pycom  datos_listados/utf8.csv > $dirppal$this->fjson";
				//$comando_json="sudo -u fpleaks /usr/bin/python3 $pycom $this->fcsv > $dirppal$this->fjson";
				//$comando_json="/usr/bin/python3 $pycom $this->fcsv > $dirppal$this->fjson";
				fwrite($this->logfile,$comando_json);
			}
			else
			{
				$comando_json="/usr/bin/python3 $pycom $this->fcsv > $dirppal$this->fjson";
			}
			try{
				$res=system($comando_json );
				//$res=shell_exec ($comando_json );
				//$res=exec ($comando_json );
				fwrite($this->logfile,"ejecutado comando\n");
			}
			catch (Exception $e) 
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				fwrite($this->logfile,"error".$e->getMessage());
			}
			//$comando_comprobacion="php comprobacion_json.php ".$this->fjson;
			//$rescjson=shell_exec ($comando_comprobacion );
			
			//if($rescjson)
				fclose($this->logfile);
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
