<?php 
#EL PRIMER CAMPO EN LOS EVOLUTIVOS, EJE X, SIEMMPRE ES EL AÑO
require_once('clases/CSVS.php');
require_once('datos_origen/dim_evolutivos.php');

$rutafichero='datos_evolutivos/';

$tabla='evolucion_bachillerato';
$post=0;
if(isset($_SERVER["REQUEST_METHOD"]))
{
$post=1;
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
	$_RRPOST['dim']=Array("centro","sexo");
	$_RRPOST['dim']=Array("ciclo","centro");
	$_RRPOST['dim']=Array("anio","naturaleza");
	$_RRPOST['dim']=Array("naturaleza","","");
}
$_RRPOST['dim']=Array("anio","","");
$listado = new \hstats\CSVS($rutafichero,$_RRPOST['dim'],$dim_evolutivos,$tabla,"evolutivos",$post,$camponumerico);
$res=$listado->getDataGraficos();
print("OK EVOLUTIVOS");
print($res);
?>

