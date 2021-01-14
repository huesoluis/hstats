<?php 
	require_once('../clases/AJAXDATA.php');
	$dirdestino="../../../includes/fichas_centros/";

	$ajaxdata = new \AJAXDATA();
	$centros=$ajaxdata->getCentros();
	foreach($centros as $codcentro)
		{
			$ccentro=$codcentro['codcentro'];
			$datoscentro=$ajaxdata->getCentroStats($ccentro);
			$f=$ajaxdata->genFichaCentro($dirdestino.'ficha_'.$ccentro.'.html',$datoscentro,$ccentro);
		}
?>

