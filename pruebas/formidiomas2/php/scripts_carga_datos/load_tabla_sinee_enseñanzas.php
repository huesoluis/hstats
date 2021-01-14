<?php 
require_once('clases/TOOLS.php');

$fcsv="datos_origen/fmatricula_centros_enseñanzas1.csv";
$tabla="sinee_matricula_centros_ensenanzas";

$loadres = new \TOOLS($fcsv);
$res=$loadres->load_tabla($fcsv,$tabla);
print("CARGADOS $res REGISTROS");	
?>

