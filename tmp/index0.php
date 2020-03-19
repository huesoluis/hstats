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
			Menu lateral
			<?php include "includes/menulateral.html"; ?>
		</div>
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-9">
					<form id="fs">
					<div class="row">
						<?php include "includes/dimensiones.html"; ?>
					</div>
					<div class="row">
						<?php include "includes/filtros.html"; ?>
                			</div>
					</form>
                	<div class="row">
                		<div class="col-md-12">
                    			<div class="row" id="zgraficos">
						<div class="col-md-12">
							<button class="btn btn-default" id="bgengra">GENERAR GRAFICOS</button>
							<div id="gppal">gppal<div id="shiva">TOTAL ALUMNOS FP CURSO 2019: <span class="count">19509</span></div></div>
							<div id="big-gra"></div>
						</div>
                			</div>
                        		<div class="row">
                				<div class="col-md-4">
							<div class="sma-gra" id="sma-gra0"></div>
						</div>
                				<div class="col-md-4">
							<div class="sma-gra"  id="sma-gra1"></div>
						</div>
                				<div class="col-md-4">
							<div class="sma-gra"  id="sma-gra2"></div>
						</div>
					</div>
                    		</div>
                	</div>
          	</div>
    		<div class="col-md-3">
			.col-3
		</div>
         </div>
</div>

</body>
</html>

