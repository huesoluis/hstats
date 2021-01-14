<?php 
#GENERADOR DATOS WEB PARA GRAFICOS
#Establecemos charset
#header('Content-Type: text/html; charset=UTF-8');
#directorio para cargar datos de campos válidos
require_once('../clases/CSVSGRAFICOS.php');
$ruta='../../datos/datos_graficos/';

#tabla origen de datos
$tabla="sinee_matricula_centros_ensenanzas";

$csv = new CSVSGRAFICOS($ruta);

//$restabla=$csv->genFicherosGraficosGeneral();
//$restabla=$csv->genFicherosGraficosEvolutivosComarcas();
//$restabla=$csv->genFicherosGraficosEvolutivos();
//$restabla=$csv->genFicherosGraficosComparaEnseñanzas();
$restabla=$csv->generarFicherosOpciones();
print($restabla);
?>

