<?php 
require_once('clases/CSVS.php');
require_once('datos_origen/dim_listados.php');

$rutafichero='datos_listados/';

//Distinguimos si viene de un cliente web o estamos probando en local
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
	$_POST['dim']=Array("ciclo","centro");
	$_POST['dim']=Array("ciclo","Elige","ciclo", "centro","provincia");
	$_POST['dim']=Array("centro","ciclo");
	$_POST['dim']=Array("grado","centro","ciclo");
	$_POST['dim']=Array("grado","centro");
}
	$dim_form=limpiaForm('listados',$dim_listados,$_POST['dim']);
	$listado = new \hstats\CSVS($rutafichero,$_POST['dim'],$dim_listados,'ofertafp1920',"listados",$post);
	$resfile=$listado->genDataListados();
	
	//calculamos fichero de datos genrado para mostrar los datos
	$fjson=makeNombreFicheroDestinoListados($dim_form);
	//$fjson="datos_listados/f_ciclos_Centros_pruebas.json";
	print($fjson);
	//if($post==1)require_once('gen_listadoshtml.php');
	//mostramos el codigo html para listar los datos obtenidos
	//if($post)
		require_once('gen_listadoshtml.php');

function makeNombreFicheroDestinoListados($dim_form){
	$f='f';
	$i=0;
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
	//limpiamos el array de campos de formulario y geenramos nombre para el fichero de salida
	$dim_form=array_unique($dim_form);
	foreach($dim_form as $key=>$df)
			{
			if(!in_array($df,$dimclaves))
						unset($dim_form[$key]);
			}
	if(sizeof($dim_form)==0) return 0;
	return $dim_form;
	}
?>

