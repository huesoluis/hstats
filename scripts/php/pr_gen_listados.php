<?php 
require_once('clases/CSVS.php');
require_once('datos_origen/dim_listados.php');

$ficheroorigen='';
$rutafichero='datos_listados/';

if(isset($_SERVER["REQUEST_METHOD"]))
{
	$post=1;
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
	http_response_code(200);
	foreach($_POST as $k=>$v)
		$_POST['dim'][]=$_POST[$k];
	}
print_r($_POST);
}
else
{
	$post=0;
	#zona de pruebas
	$_POST['dim']=Array("ciclo","centro");
	$_POST['dim']=Array("ciclo","centro");
	$_POST['dim']=Array("ciclo", "centro","provincia");
}
	$listado = new \hstats\CSVS($ficheroorigen,$rutafichero,$_POST['dim'],$dim_listados,'ofertafp1920',"listados",$post);
	$resfile=$listado->genDataListados();
	print($resfile);
//	require_once('gen_listadoshtml.php');
?>

