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
$fichero='datos/oferta.csv';
$_POST['dim']=Array( "ciclos","centros","provincias");
$listado = new \hstats\CSVS($fichero,$_POST['dim'],$dim_oferta);
$res=$listado->makeQuery();
if($res)
	print_r($res);
else print("error");

$csv=$listado->genCsv();
}
?>

