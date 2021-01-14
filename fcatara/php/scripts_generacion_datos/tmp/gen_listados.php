<?php 

#Establecemos charset
header('Content-Type: text/html; charset=UTF-8');

require_once('clases/CSVS.php');
require_once('datos_origen/dim_listados.php');

#directorio para cargar datos de campos válidos
$rutafichero='datos_listados/';

#tabla origen de datos
$tabla="sinee_matricula_centros_ensenanzas";

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
	$post=0;
	#zona de pruebas
	$_POST['dim']=Array("enseñanza","provincia","centro");
	$_POST['dim']=Array("enseñanza","tipocentro","centro");
	$_POST['dim']=Array("centro","tipocentro");
	$_POST['dim']=Array("tipocentro","centro");
	$_POST['dim']=Array("enseñanza","tipocentro","provincia");
}

#establcemos el tipo de consulta, si viene de enseñanzas o de otra seccion de la web
if(isset($_POST['tipoconsulta']))
	$origen=$_POST['tipoconsulta'];
else
	$origen='enseñanzas';


$dim_form=$_POST['dim'];

#añadimos el campo enseñanzas
#if($origen=='enseñanzas') array_unshift($dim_form,"enseñanza");

if(!$post)
{
print_r("RECIBIDO POST: ");
print_r($_POST['dim']);
print_r("POST FILTRADO: ");
print_r($dim_form);
}

print_r("DATOS PREFILTRADOS: ");
print_r($dim_form);
$dim_form=limpiaForm('listados',$dim_listados,$dim_form);

if($origen=='enseñanzas')
{
	$fjson=makeNombreFicheroDestinoListados($dim_form);

if (file_exists($fjson))
{	 
	require_once('gen_listadoshtml_pruebas.php');
}
else
{
	$listado = new \hstats\CSVS($rutafichero,$dim_form,$dim_listados,$tabla,"listados",$post);
	$res=$listado->genDataListados();
	require_once('gen_listadoshtml_pruebas.php');

}
}
elseif($origen=='tablas')
{
	$tabla = new \hstats\CSVS($rutafichero,$dim_form,$dim_listados,$tabla,"listados",$post);
	$restabla=$tabla->genTabla();
	print($restabla);
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
	return 'datos_listados/'.$f.'_'."listados.json";
	}
function limpiaForm($tipo='listados',$dim_campos,$dim_form){
	//claves disponibles
	$dimclaves=array_keys($dim_campos);
	print("CLAVES DISPONIBLES:");
	print_r($dimclaves);
	//limpiamos el array de campos de formulario y geenramos nombre para el fichero de salida
	$dim_form=array_unique($dim_form);
	foreach($dim_form as $key=>$df)
			{
			if(!in_array($df,$dimclaves))
						unset($dim_form[$key]);
			}
	if(sizeof($dim_form)==0){print("no claves"); return array("enseñanza","provincia","centro");}
	return $dim_form;
	}
?>

