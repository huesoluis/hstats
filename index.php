<!DOCTYPE html>
<html lang="es">
<head>
  <title>Estadística Educativa</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/estedu.css">
  <link rel="stylesheet" href="css/listados.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script type="text/javascript" src="https://code.highcharts.com/modules/data.js"></script>
  
  <script src="js/main.js"></script>
  <script src="js/tools.js"></script>
  <script src="js/server.js"></script>
  <script src="js/gen_graph.js"></script>
</head>
<body>

<div class="container-fluid">
	<h2>Página estadística educativa</h2>
	<div class="row">
		<div class="col-md-3">
		.col-3
		</div>
    		<div class="col-md-9">
			<?php include "includes/menufrontal.html"; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			GRÁFICOS
			<?php include "includes/menulateral_graficos.html"; ?>
			LISTADOS
			<?php include "includes/menulateral_listados.html"; ?>
			TABLAS
			<?php include "includes/menulateral_tablas.html"; ?>
			COMPARATIVAS
			<?php include "includes/menulateral_comparativas.html"; ?>
			EVOLUTIVAS
			<?php include "includes/menulateral_evolutivas.html"; ?>
		</div>
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-9">
					<form id="formgeneral">
					<div id="filagraficos" class="row">
							<?php include "includes/dimensiones_graficos.php"; ?>
					</div>
					<div id="filalistados" class="row">
							<?php include "includes/dimensiones_listados.php"; ?>
					</div>
					<div id="filatablas" class="row">
							<?php include "includes/dimensiones_tablas.php"; ?>
					</div>
					<div id="submit" class="row">
					        	<button type="submit" class="btn btn-success">GENERAR <span value="listados" id="tipoinfo">TABLAS</span><span class="fa fa-arrow-right"></span></button>
					</div>
					<!--<div class="row">
						<?php // include "includes/filtros.html"; ?>
                			</div>
					-->
					</form>
			<!--AREA VISUALIZACION DE DATOS-->
                	<div class="row">
                		<div class="col-md-12">
                    			<div class="row class_listados" id="slistados">
						<div class="col-md-12">
							<div id="lppal">lppal<div id="shiva">TOTAL ALUMNOS FP CURSO 2019: <span class="count">19509</span></div></div>
							<div id="big-list">
							</div>
						</div>
                			</div>
                    			<div class="row class_tablas" id="stablas">
						<div class="col-md-12">
							<div id="lppal">lppal<div id="shiva">TOTAL ALUMNOS FP CURSO 2019: <span class="count">19509</span></div></div>
							<div id="big-tabla">
							</div>
						</div>
                			</div>
					
                    			<div class="row class_graficos" id="zgraficos">
						<div class="col-md-12">
							<div id="gppal">gppal<div id="shiva">TOTAL ALUMNOS FP CURSO 2019: <span class="count">19509</span></div></div>
							<div id="big-gra"></div>
						</div>
                			</div>
                    		</div>
                	</div>
          	</div>
    		<div class="col-md-3">
			FILTROS
						<?php include "includes/filtros.html"; ?>
		</div>
         </div>
</div>

</body>
<script>
</script>
</html>


