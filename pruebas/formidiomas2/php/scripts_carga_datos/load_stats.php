<?php 
require_once('../clases/TOOLS.php');
$fcsv='';
$tabla="stats_centros";
$curso='2019';
$tool = new \TOOLS($fcsv);
//$res=$loadres->load_custom_tabla($fcsv,$tabla);
//$res=$loadres->update_centros($fcsv,$tabla);
//$res=$loadres->load_padron($fcsv,$tabla);

$res=$tool->genStatsMatriculaComarcas(";",$curso);
//$res=$tool->genStatsMatriculaCentros($tabla,";",$curso);
//$res=$tool->genStatsInmigracion(";",$curso);
print("CARGADOS $res REGISTROS");	
?>

