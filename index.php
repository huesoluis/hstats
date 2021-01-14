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
  <script src="js/ejemplo_graph.js"></script>
</head>
<body>

<div class="container-fluid">
	<h2 id='mlateral'>Página estadística educativa</h2>
<?php include "includes/cabecera.html"; ?>
	<div class="row">
		<div class="col-md-3">
				<div class='ftopmlateral' data-toggle="collapse" data-target="#filtros" ><a>FILTROS</a></div>
					<div id="filtros" class="collapse">
						<label class="form-check-label">
									Centro
						</label>
						<input type="text" class="form-control form-rounded" placeholder="Introduce el centro">
						<label class="form-check-label">
									Enseñanzas
						</label>
						<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								<label class="form-check-label" for="defaultCheck1">
									Infantil
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
								<label class="form-check-label" for="defaultCheck2">
									Primaria
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
								<label class="form-check-label" for="defaultCheck2">
									Secundaria
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
								<label class="form-check-label" for="defaultCheck2">
									Bachillerato
								</label>
							</div>
					</div>
		</div>
    <div class="col-md-9">
					<div id="cards" class="row">
						<?php include "includes/cards_superior2.php"; ?>
					</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3" id="menulateral">
			<div class='topmlateral' >GRÁFICOS</div>
			<?php include "includes/menulateral_graficos.html"; ?>
			<div class='topmlateral' >LISTADOS</div>
			<?php include "includes/menulateral_listados.html"; ?>
			<div class='topmlateral' >TABLAS</div>
			<?php include "includes/menulateral_tablas.html"; ?>
			<div class='topmlateral' >COMPARATIVAS</div>
			<?php include "includes/menulateral_comparativas.html"; ?>
			<div class='topmlateral' >EVOLUTIVAS</div>
			<?php include "includes/menulateral_evolutivas.html"; ?>
		</div>
		<div class="col-md" >
			<div class="row">
				<div class="col-md-12 bcentral">
					<form id="formgeneral">
					<div id="filagraficos" class="row">
							<?php include "includes/dimensiones_graficos.php"; ?>
					</div>
					<div id="filaevolutivos" class="row">
							<?php include "includes/dimensiones_evolutivos.php"; ?>
					</div>
					<div id="filalistados" class="row">
							<?php include "includes/dimensiones_listados.php"; ?>
					</div>
					<div id="filatablas" class="row">
							<?php include "includes/dimensiones_tablas.php"; ?>
					</div>
					<div id="submit" class="row">
					        	<button type="submit" class="btn btn-success">GENERAR <span value="listados" id="tipoinfo">TABLAS</span></button>
					</div>
					<!--<div class="row">
                			</div>
					-->
					</form>
			</div>
			</div>
			<!--AREA VISUALIZACION DE DATOS-->

     	<div class="row">
				<div class="col-md-7">
					<div id="container1" style="height: 400px;"></div>
				</div>
				<div class="col-md-5">
					<div id="container2" style="height: 400px;"></div>
				</div>
			</div>
     	<div class="row">
    		<div class="col-md-12">
      		<div class="row class_listados" id="slistados" seccion="seccion_listados">
						<div class="col-md-12">
							<div id="big-list">
							</div>
						</div>
           	</div>
            <div class="row class_tablas" id="stablas" seccion="seccion_tablas">
							<div class="col-md-12">
								<div id="big-tabla">
								</div>
							</div>
            </div>
					
            <div class="row class_graficos" id="zgraficos" seccion="seccion_graficos">
							<div class="col-md-12">
								<div id="gppal">gppal<div id="shiva">TOTAL ALUMNOS FP CURSO 2019: <span class="count">19509</span></div></div>
								<div id="big-gra"></div>
							</div>
            </div>
            </div>
                	</div>
          	</div>
         </div>
</div>

</body>
<script>
</script>
</html>


