<!DOCTYPE html>
<html lang="es">
<head>
  <title>Estadística Educativa</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/estedu.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script type="text/javascript" src="https://code.highcharts.com/modules/data.js"></script>
  
  <script src="js/main.js"></script>
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
			General
			<?php include "includes/menulateral_general.html"; ?>
			Listados
			<?php include "includes/menulateral_listados.html"; ?>
			Comparativas
			<?php include "includes/menulateral_comparativas.html"; ?>
			Evolutivas
			<?php include "includes/menulateral_evolutivas.html"; ?>
		</div>
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-9">
					<form id="flistados">
						<div class="row">
							<select id="dimensiones" name="dimensiones">
							</select> 
						</div>
					</form>
					<form id="fdim">
					<div class="row">
							<?php include "includes/dimensiones.php"; ?>
					        	<button type="submit" class="btn btn-success">GENERAR DATOS<span class="fa fa-arrow-right"></span></button>
					</div>
					<!--<div class="row">
						<?php include "includes/filtros.html"; ?>
                			</div>
					-->
					</form>
                	<div class="row">
                		<div class="col-md-12">
					<button class="btn btn-default" id="bgenlist">VER LISTADOS</button>
                    			<div class="row" id="zlistados">
						<div class="col-md-12">
							<div>lppal<div id="shiva">LISTADO DINAMICO</div></div>
						</div>
                			</div>
					<button class="btn btn-default" id="bgengra">VER GRAFICOS</button>
                    			<div class="row" id="zgraficos">
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


