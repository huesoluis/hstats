<?php 
#GENERADOR DATOS WEB PARA LISTADOS Y TABLAS
#Establecemos charset
#header('Content-Type: text/html; charset=UTF-8');

require_once('../clases/CSVS.php');
require_once('../config_dim/dim_listados.php');
require_once('../config_dim/dim_tablas.php');

#directorio para cargar datos de campos válidos
$rutafichero='../../datos/datos_listados/';

#tabla origen de datos
$tabla="sinee_matricula_centros_ensenanzas se,base_centros ce WHERE se.codcentro=ce.codcentro ";
//$tabla="d_sinee_matricula_centros_ensenanzas";

#Distinguimos si viene de un cliente web o estamos probando en local
if(isset($_SERVER["REQUEST_METHOD"]))
{
	$post=1;
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
	http_response_code(200);
	foreach($_POST as $k=>$v)
		$_POST['dim'][]=$_POST[$k];
	}
}
else
{
	//ponemos el origen, solo para pruebas
	$origen='enseñanzas';
	$origen='tablas';
	$post=0;
	#zona de pruebas
	$_POST['dim']=Array("enseñanza","provincia","centro");
	$_POST['dim']=Array("enseñanza","tipocentro","centro");
	$_POST['dim']=Array("centro","tipocentro");
	$_POST['dim']=Array("tipocentro","centro");
	$_POST['dim']=Array("naturaleza","provincia","centro");
	$_POST['dim']=Array("enseñanza","provincia","centro");
	$_POST['dim']=Array("provincia","tipocentro","centro");
	$_POST['dim']=Array("enseñanza","provincia","centro");
	$_POST['dim']=Array("naturaleza","provincia");
	$_POST['dim']=Array();//array por defecto
	$_POST['dim']=Array("enseñanza","provincia","naturaleza");
}
#establcemos el tipo de consulta, si viene de enseñanzas o de otra seccion de la web
if(isset($_POST['tipoconsulta']))
	$origen=$_POST['tipoconsulta'];
$dim_form=$_POST['dim'];

if($origen=='enseñanzas')
{
	//limpiamos el formulario de entrada para quitar repetiudos etc..
	$dim_form=limpiaForm($origen,$dim_listados,$dim_form,$dim_tablas,$dim_tablas_horizontales);
	//añadimos siempre el campo enseñanzas y centro
	array_push($dim_form,'enseñanza');
	array_push($dim_form,'centro');
	//generamos el nombre del fichero de datos
	$fjson=makeNombreFicheroDestinoListados($dim_form);
	//print($fjson);exit();
	//si existe el fichero, lo cargamos directamente. Directorio: ../../datos/datos_listados/
	if (file_exists($fjson))
	{	 
		require_once('gen_listadoshtml.php');
	}
	else
	{
		$listado = new \CSVS($rutafichero,$dim_form,$dim_listados,$tabla,"listados",$post);
		$res=$listado->genDataListados();
		print($res);
		print("FICHERO FINAL:");print($fjson);
		require_once('gen_listadoshtml.php');
	}
}
elseif($origen=='tablas')
{
	$dim_form=limpiaForm($origen,$dim_listados,$dim_form,$dim_tablas,$dim_tablas_horizontales);
	$dim_form=reordenarFilas($dim_form,$dim_tablas_ordenfilas);
	//print_r($dim_form);exit();
	/*
	if(!$post)
	{
		$dim_form=limpiaForm($origen,$dim_listados,$dim_form,$dim_tablas);
	//	$dim_form=reordenarFilas($dim_form,$dim_tablas_ordenfilas);
	}
	*/
	$tabla = new \CSVS($rutafichero,$dim_form,$dim_tablas,$tabla,"tablas",$post);
	$restabla=$tabla->getDataTablas();
	print($restabla);
}
elseif($origen=='listados_defecto')
{
	$fjson="../../datos/datos_listados/f_enseñanza_provincia_centro_listados.json";		
	require_once('gen_listadoshtml_pruebas.php');
}
function reordenarFilas($df,$dfo){
	$ndf=array();
	foreach($dfo as $d)
		if(in_array($d,$df))
			array_push($ndf,$d);
	foreach($df as $d)
		if(!in_array($d,$dfo))
			array_push($ndf,$d);

	return $ndf;
}
function makeNombreFicheroDestinoListados($dim_form){
	$f='f';
	$i=0;
	if(!isset($dim_form)) return 'nofile';
	foreach($dim_form as $fn)
		{
		$i++;
		$f.="_".$fn;
		}
	return '../../datos/datos_listados/'.$f.'_'."listados.json";
	}
function limpiaForm($origen,$dim_listados,$dim_form,$dim_tablas,$dim_tablas_horizontales){
	$dim_form=array_unique($dim_form);
	//claves disponibles
	if($origen=='enseñanzas')
	{
		//limpiamos el array de campos de formulario y generamos nombre para el fichero de salida
		$dimclaves=array_keys($dim_listados);
		foreach($dim_form as $key=>$df)
				{
				if(!in_array($df,$dimclaves))
							unset($dim_form[$key]);
				}
		//array a devolver en caso de q no haya coincidencias, array por defecto
		$avacio=array("enseñanza","provincia","centro");
	}
	elseif($origen=='tablas')
	{
		$dim_form=array_reverse($dim_form);
		//limpiamos el array de campos de formulario y generamos nombre para el fichero de salida
		$dimclaves=array_keys($dim_tablas);
		foreach($dim_form as $key=>$df)
				{
				if(!in_array($df,$dimclaves))
							unset($dim_form[$key]);
				}
		//reindexamos
		$dim_form=array_values($dim_form);
		$avacio=array("enseñanza","provincia","naturaleza");
		//al menos debe haber dos dimensiones, si solo hay una y es horizontal añadimos la provincia
		//si no es horizontal, añadimos la naturaleza
		if(sizeof($dim_form)==1)
		{
			print("añadiendo campos".$dim_form[0]);
			print_r($dim_tablas_horizontales);
			if(in_array($dim_form[0],$dim_tablas_horizontales)) array_push($dim_form,'provincia');
			else array_push($dim_form,'naturaleza');
		}
	}
	if(sizeof($dim_form)==0){return $avacio;}
	//reindexamos indices
	$dim_form=array_values($dim_form);
	return $dim_form;
	}
?>

