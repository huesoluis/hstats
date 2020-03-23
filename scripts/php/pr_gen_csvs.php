<?php 
// include configuration
//require_once(dirname(__FILE__) . '/config.php');

require_once('clases/CSVS.php');
require_once('datos/dim_oferta.php');

if(isset($_SERVER["REQUEST_METHOD"]))
{
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
	http_response_code(200);
	print_r($_POST);
	exit();
	$dal = new ACCESO($_POST);
	if($dal->dimension==0) {echo "NO DATA";exit();}
	else $csvs=$dal->gen_csvs();
	
	$salida='';
	foreach($dal->f3 as $f)
		$salida.=$f.":";
	$salida=substr($salida, 0, -1);
	print($salida);
	print("DIM");	
	print($dal->dimension);	
	}
}
else
{
	#zona de pruebas
	$ficheroorigen='datos/oferta.csv';
	$rutafichero='datos_listados/';
	$_POST['dim']=Array("centros", "ciclos","ciclos","Elige","provincias");
	$listado = new \hstats\CSVS($ficheroorigen,$rutafichero,$_POST['dim'],$dim_oferta);
	$res=$listado->makeQuery();
	print_r("ok haciendo query");
	if($res)
		print_r("ok");
	else print("error");

	$csv=$listado->genCsv();
	$cjson=$listado->genJson();
	if($cjson==1) print("TODO OK");
}
?>

