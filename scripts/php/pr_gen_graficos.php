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
	$_RPOST['dim']=Array("","","");

	$_RPOST['dim'][0]=$_POST['d0'];
	$_RPOST['dim'][1]=$_POST['d1'];
	$_RPOST['dim'][2]=$_POST['d2'];
	$_RRPOST['dim']=$_RPOST['dim'];
	}
}
else
{
	#zona de pruebas
	$_POST['dim']=Array("centros", "ciclos","ciclos","Elige","provincias");
	$_RRPOST['dim']=Array("provincia","sexo","nombreciclo");
	$_RRPOST['dim']=Array("sexo","provincia","nombreciclo");
	$_RRPOST['dim']=Array("nombreciclo","sexo","provincia");
	//$_RRPOST['dim']=Array("provincia","sexo");
}

$listado = new \hstats\CSVS($ficheroorigen,$rutafichero,$_RRPOST['dim'],$dim_graficos,$tabla,"graficos");
$res=$listado->getDataGraficos();
print(PHP_EOL);
print($res);
print(PHP_EOL);
?>

