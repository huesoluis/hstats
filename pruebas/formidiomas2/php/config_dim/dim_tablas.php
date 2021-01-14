<?php
//campos disponibles para la generacion de tablas de datos, los indices son los campos q aparecen en el formulario, los valores son los campos de la base de datos equivalentes
$dim_tablas=array('ciclo'=>'codmodalidad','centro'=>'nombre_centro','sexo'=>'sexo','provincia'=>'provincia','enseñanza'=>'cod_enseñanza_agrupada','naturaleza'=>'naturaleza','localidad'=>'municipio','comarca'=>'comarca','zona'=>'zona');

//campos de las tablas q solo pueden aparecer en vertical, en la columna de la tabla ya q de otro modo ocuparían demasiado espacio
//el orden es importante, determina el orden en la tabla, no es lo mismo naturaleza->centro q al revés q no tendría sentido
$dim_tablas_horizontales=array('naturaleza','provincia','enseñanza');
$dim_tablas_ordenfilas=array('provincia','comarca','localidad','zona');
?>
