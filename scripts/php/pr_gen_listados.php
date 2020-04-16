<?php 
// include configuration
//require_once(dirname(__FILE__) . '/config.php');

require_once('clases/CSVS.php');
require_once('datos_origen/dim_listados.php');

$ficheroorigen='';
$rutafichero='datos_listados/';

if(isset($_SERVER["REQUEST_METHOD"]))
{
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
	http_response_code(200);
	foreach($_POST as $k=>$v)
		$_POST['dim'][]=$_POST[$k];
	}
}
else
{
	#zona de pruebas
	$_POST['dim']=Array("centros", "ciclos","ciclos","Elige","provincias");
	$_POST['dim']=Array("ciclo","centro");
}
	$listado = new \hstats\CSVS($ficheroorigen,$rutafichero,$_POST['dim'],$dim_listados,'test',"listados");
	$res=$listado->genDataListados();
	//$datos=$listado->makeView();
	print("OK");
	//print("DATOS: ".$datos);
	//if($cjson==1) print(PHP_EOL."TODO OK");
?>

