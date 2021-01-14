<?php 
	$codcentro=$_POST['codcentro'];
	$fichacentro='../../includes/fichas_centros/ficha_'.$codcentro.'.html';
	
	require_once($fichacentro);
//	print($fichacentro);
?>

