<!--MOSTRAMOS GRAFICOS/LISTADOS/TABLAS ESTATICOS-->
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Estadística Educativa</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/estedu.css">
  <link rel="stylesheet" href="css/listados.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script type="text/javascript" src="https://code.highcharts.com/modules/data.js"></script>
  
  <script src="js/main.js"></script>
  <script src="js/tools.js"></script>
  <script src="js/server.js"></script>
  <script src="js/gen_graph.js"></script>
  <script src="js/ejemplo_graph2.js"></script>
</head>
<body>

<div class="container-fluid">
<?php include "includes/cabecera.html"; ?>
	<h2 id='mlateral'>Página estadística educativa</h2>
	<div class="row">
						<label class="form-check-label">
									Centro
						</label>
						<input type="text" class="form-control form-rounded" placeholder="Introduce el centro">
	</div>
  <div class="col-md-9">
					<div id="cards" class="row">
						<?php include "includes/cards_superior2.php"; ?>
					</div>
	</div>
	<div class="row" style="margin-left: 0px!important">
		<div class="col-md" >
			<!--AREA VISUALIZACION DE DATOS-->
     	<div class="row" style="margin-left: 0px!important">
				<div class="col-md-7">
					<div id="container1" style="height: 400px;"></div>
				</div>
				<div class="col-md-5">
					<div id="container2" style="height: 400px;"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-left: 0px!important">
		<div class="col-md" >
			<!--AREA VISUALIZACION DE DATOS-->
     	<div class="row" style="margin-left: 0px!important">
				<div class="col-md-7">
					<div id="container3" style="height: 400px;"></div>
				</div>
				<div class="col-md-5">
					<div id="container4" style="height: 400px;"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-left: 0px!important">
		<div class="col-md" >
			<!--AREA VISUALIZACION DE DATOS-->
     	<div class="row" style="margin-left: 0px!important">
				<div class="col-md-7">
					<div id="container5" style="height: 400px;"></div>
				</div>
				<div class="col-md-5">
					<div id="container6" style="height: 400px;"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-left: 0px!important">
		<div class="col-md" >
			<!--AREA VISUALIZACION DE DATOS-->
     	<div class="row" style="margin-left: 0px!important">
				<div class="col-md-7">
					<div id="container7" style="height: 400px;"></div>
				</div>
				<div class="col-md-5">
					<div id="container8" style="height: 400px;"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-left: 0px!important">
		<div class="col-md" >
			<!--AREA VISUALIZACION DE DATOS-->
     	<div class="row" style="margin-left: 0px!important">
				<div class="col-md-7">
					<div id="container9" style="height: 400px;"></div>
				</div>
				<div class="col-md-5">
					<div id="container10" style="height: 400px;"></div>
				</div>
			</div>
		</div>
</div>
	<div class="row" style="margin-left: 0px!important">
		<div class="col-md" >
			<!--AREA VISUALIZACION DE DATOS-->
     	<div class="row" style="margin-left: 0px!important">
				<div class="col-md-7">
					<div id="container11" style="height: 400px;"></div>
				</div>
				<div class="col-md-5">
					<div id="container12" style="height: 400px;"></div>
				</div>
			</div>
		</div>
</div>

</body>
<script>
</script>
</html>


