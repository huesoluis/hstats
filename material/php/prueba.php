<?php

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  http_response_code(200);
          print_r($_POST);
	}

//conectamos base de datos con la clase correspondiente
//preparamos las consultas segun parametros
/*
Caso 1: no hay nada
	No se devuelve nada
Caso 2: 1 dimensión
	genera un fichero, por ejemplo mat_grado.csv para los grados seleccionados
	Si no se selecciona ninguno se muestran todos

Caso 3: 2 dimensiones
	

*/
//Se generan los ficheros correspondientes segun los parámetros de entrada
//Hay que generar un array con dichos ficheros  para representar con highcharts. Solo en el caso de 1, 2 o 3 dimensiones
//dicho array se pasa a una funcion para que dibuje los graficos 


?>
