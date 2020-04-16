<?php 
require_once('clases/CSVS.php');
require_once('datos_origen/dim_graficos.php');

$ficheroorigen='datos_origen/mat_alumnosfp2019.csv';
$rutafichero='datos_graficos/';

$tabla='test';

if(isset($_SERVER["REQUEST_METHOD"]))
{
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
	http_response_code(200);
	}
}
else
{
	#zona de pruebas
	$_POST['dim']=Array("centros", "ciclos","ciclos","Elige","provincias");
	$_POST['dim']=Array("centro","nombreciclo");
}

$listado = new \hstats\CSVS($ficheroorigen,$rutafichero,$_POST['dim'],$dim_graficos,$tabla,"graficos");
$res=$listado->getDataGraficos();
print($res);
//print("RESULTADO GEN GRAFICOS: $res");
?>

