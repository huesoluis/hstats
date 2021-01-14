<?php 
require_once('../clases/TOOLS.php');

//$fcsv="../../datos/datos_auxiliares/datos_globales/base_centros.csv";
$fcsv="../datos/datos_centros_catarag2.csv";
$tabla="centros";

$loadres = new \TOOLS($fcsv);
$res=$loadres->load_tabla($fcsv,$tabla,";");
print("CARGADOS $res REGISTROS");	
?>

