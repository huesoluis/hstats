<?php
$dim=array("c1","c2");
$file = fopen("../datos/mat_alumnosfp2019.csv","r");
$dim=fgets($file);
fclose($file);

print_r($dim);

?>
