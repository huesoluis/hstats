<?php 
require_once('../clases/TOOLS.php');
$dirbase="../../datos/datos_entrada/datos_globales/";

//$fcsv="../../datos/datos_auxiliares/datos_globales/base_centros.csv";
$fcsv="../../datos/datos_auxiliares/datos_globales/matricula_total.csv";
$fcsv="../../datos/datos_auxiliares/datos_padron/ine_padronporedades.csv";
$fcsv="../../datos/datos_auxiliares/datos_globales/matricula_total2019.csv";
$fcsv="../../datos/datos_auxiliares/datos_globales/matricula_total2018.csv";
$fcsv="../../datos/datos_auxiliares/datos_globales/matricula_total2017.csv";
$fcsv="../../datos/datos_entrada/datos_globales/tiempos_escolares.csv";
$fcsv="../../datos/datos_entrada/datos_globales/servicios_complementarios.csv";
$fcsv="../../datos/datos_entrada/datos_globales/publicos_bilingues.csv";
$fcsv=$dirbase."centros_tel_correo.csv";
$fcsv="../../datos/datos_entrada/datos_globales/base_zonas_comarcas.csv";
$fcsv="../../datos/datos_entrada/datos_globales/extranjeros_centro.csv";
$tabla="base_centros";
$tabla="stats_centros";

$loadres = new \TOOLS($fcsv);
//$res=$loadres->load_custom_tabla($fcsv,$tabla);
$res=$loadres->updateStatsCentros($fcsv,$tabla,";");
//$res=$loadres->update_centros($fcsv,$tabla);
//$res=$loadres->load_padron($fcsv,$tabla);

#$res=$loadres->updateTablaTiemposescolares($fcsv,$tabla,";");
//$res=$loadres->updateTablaServicioscomp($fcsv,$tabla,";");
//$res=$loadres->updateBilingues($fcsv,$tabla,";");
//$res=$loadres->update_tabla($fcsv,$tabla,";");
print("CARGADOS $res REGISTROS");	
?>

