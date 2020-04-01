<?php 
require_once('clases/CSVS.php');
require_once('datos_origen/dim_oferta.php');

$ficheroorigen='datos_origen/mat_alumnosfp2019.csv';
$rutafichero='datos_graficos/';

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
	$_POST['dim']=Array("centro");
}
	$listado = new \hstats\CSVS($ficheroorigen,$rutafichero,$_POST['dim'],$dim_matricula);
	$res=$listado->getDataGraficos();
	print($res);
?>

