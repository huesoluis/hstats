<?php 
// include configuration
require_once(dirname(__FILE__) . '/config.php');

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
$_POST=Array
(
    "d1" => "genero",
    "d2" => "grado",
    "d3" => "provincia",
    "f10" => "h",
//    "f12" => "TERUEL",
//    "f13" => "ZARAGOZA",
//    "f21" => "gmedio",
    "f30" => "h",
    "f31" => "m"
);
	print_r($_POST);
	$dal = new ACCESO($_POST);
	if($dal->dimension==0) {echo "NO DATA";exit();}
	else $csvs=$dal->gen_csvs();
	print_r($dal->f3);
	print(":");	
	print($dal->dimension);	
}
?>

