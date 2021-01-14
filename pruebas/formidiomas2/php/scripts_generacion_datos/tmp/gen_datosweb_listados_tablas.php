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
}
#establcemos el tipo de consulta, si viene de enseñanzas o de otra seccion de la web
if(isset($_POST['tipoconsulta']))
	$origen=$_POST['tipoconsulta'];
$dim_form=$_POST['dim'];

if($origen=='enseñanzas')
{
	$dim_form=limpiaForm($origen,$dim_listados,$dim_form,$dim_tablas);
	$fjson=makeNombreFicheroDestinoListados($dim_form);
	
	//si existe el fichero, lo cargamos directamente. Directorio: ../../datos/datos_listados/
	if (file_exists($fjson))
	{	 
		//print("FICHERO EXISTE $fjson");exit();
		require_once('gen_listadoshtml_pruebas.php');
	}
	else
	{
		$listado = new \CSVS($rutafichero,$dim_form,$dim_listados,$tabla,"listados",$post);
		$res=$listado->genDataListados();
		print($res);
		print("FICHERO FINAL:");print($fjson);
		require_once('gen_listadoshtml_pruebas.php');
	}
}
elseif($origen=='tablas')
{
	$dim_form=limpiaForm($origen,$dim_listados,$dim_form,$dim_tablas);
	if(!$post)
	{
		$dim_form=limpiaForm($origen,$dim_listados,$dim_form,$dim_tablas);
	}
	$tabla = new \hstats\CSVS($rutafichero,$dim_form,$dim_tablas,$tabla,"tablas",$post);
	$restabla=$tabla->getDataTablas();
	print($restabla);
}
elseif($origen=='listados_defecto')
{
	$fjson="../../datos/datos_listados/f_enseñanza_provincia_centro_listados.json";		
	require_once('gen_listadoshtml_pruebas.php');
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
function limpiaForm($origen,$dim_listados,$dim_form,$dim_tablas){
	//claves disponibles
	if($origen=='enseñanzas')
	{
		$dimclaves=array_keys($dim_listados);
		//array a devolver en caso de q no haya coincidencias, array por defecto
		$avacio=array("enseñanza","provincia","centro");
	}
	else
	{
		$dimclaves=array_keys($dim_tablas);
		$avacio=array("enseñanza","provincia","naturaleza");
	}
	//limpiamos el array de campos de formulario y generamos nombre para el fichero de salida
	$dim_form=array_unique($dim_form);
	foreach($dim_form as $key=>$df)
			{
			if(!in_array($df,$dimclaves))
						unset($dim_form[$key]);
			}
	if(sizeof($dim_form)==0){return $avacio;}
	return $dim_form;
	}
?>

