<!DOCTYPE html>
<html lang="es">
<?php include('includes/head1.php');?>
<body>

<div id="acontainer1"  class="container-fluid">
<?php include "includes/cabecera.html"; ?>
</div>
<div id="acontainer2" class="container-fluid" style="width:75%">
	<div class="row">
		<div class="col-md" >
			<div class="row">
				<div class="col-md-12 bcentral">
					<form id="formgeneral">
						<div id="formdatos">
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
						</div>
						<div id="submit">
							<button id="bverdatos" type="submit" class="btn btn-success">GENERAR <span value="listados" id="tipoinfo">TABLAS</span></button>
						</div>
					</form>
				</div>
			</div>
			<!--AREA VISUALIZACION DE DATOS-->

     	<div class="row">
				FILA PRUEBAS
			</div>
     	<div class="row">
				<div class="fieq4h-0 sc-1jawzah-1 sc-1jawzah-3 bnFGib"><div class="sc-1mty1jv-0 joAjNb"><div class="sc-1mty1jv-1 lawUDu"><span class="sc-1ryi78w-0 gCzMgE sc-16b9dsl-1 kUAhZx u3ufsr-0 fGQJzg sc-1mty1jv-2 dtichT" opacity="1">$13,422.98</span><a data-e2e="goToPriceChart" href="prices" class="sc-1r996ns-0 gzrtQD sc-1tbyx6t-1 kXxRxe iklhnl-0 sc-1mty1jv-5 ijYffm" opacity="1">Price<svg viewBox="0 0 448 512" class="sc-1pmbxjh-0 cComos sc-1mty1jv-6 hQCYRH" height="8px" selectable="0" width="8px"><path d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></a></div><div class="sc-1mty1jv-7 jMA-DAc"></div><div class="sc-1mty1jv-1 lawUDu"><span class="sc-1ryi78w-0 iroZrZ sc-16b9dsl-1 kUAhZx u3ufsr-0 sc-1mty1jv-3 ggDVqR" opacity="1">91.455 EH/s</span><a data-e2e="goToHashRateChart" href="charts/hash-rate" class="sc-1r996ns-0 gzrtQD sc-1tbyx6t-1 kXxRxe iklhnl-0 sc-1mty1jv-5 ijYffm" opacity="1">Estimated Hash Rate<svg viewBox="0 0 448 512" class="sc-1pmbxjh-0 cComos sc-1mty1jv-6 hQCYRH" height="8px" selectable="0" width="8px"><path d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></a></div><div class="sc-1mty1jv-7 jMA-DAc"></div><div class="sc-1mty1jv-1 lawUDu"><span class="sc-1ryi78w-0 iroZrZ sc-16b9dsl-1 kUAhZx u3ufsr-0 sc-1mty1jv-3 ggDVqR" opacity="1">228,342</span><a data-e2e="goToNumTxChart" href="charts/n-transactions" class="sc-1r996ns-0 gzrtQD sc-1tbyx6t-1 kXxRxe iklhnl-0 sc-1mty1jv-5 ijYffm" opacity="1">Transactions (24hrs)<svg viewBox="0 0 448 512" class="sc-1pmbxjh-0 cComos sc-1mty1jv-6 hQCYRH" height="8px" selectable="0" width="8px"><path d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></a></div><div class="sc-1mty1jv-7 jMA-DAc"></div><div class="sc-1mty1jv-1 lawUDu"><span class="sc-1ryi78w-0 iroZrZ sc-16b9dsl-1 kUAhZx u3ufsr-0 sc-1mty1jv-3 ggDVqR" opacity="1">2.269m BTC</span><a data-e2e="goToTxVolume" href="charts/output-volume" class="sc-1r996ns-0 gzrtQD sc-1tbyx6t-1 kXxRxe iklhnl-0 sc-1mty1jv-5 ijYffm" opacity="1">Transaction Volume<svg viewBox="0 0 448 512" class="sc-1pmbxjh-0 cComos sc-1mty1jv-6 hQCYRH" height="8px" selectable="0" width="8px"><path d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></a></div><div class="sc-1mty1jv-7 jMA-DAc"></div><div class="sc-1mty1jv-1 lawUDu"><span class="sc-1ryi78w-0 iroZrZ sc-16b9dsl-1 kUAhZx u3ufsr-0 sc-1mty1jv-3 ggDVqR" opacity="1">154,700 BTC</span><a data-e2e="goToEstimatedTxVolume" href="charts/estimated-transaction-volume" class="sc-1r996ns-0 gzrtQD sc-1tbyx6t-1 kXxRxe iklhnl-0 sc-1mty1jv-5 ijYffm" opacity="1">Transaction Volume (Est)<svg viewBox="0 0 448 512" class="sc-1pmbxjh-0 cComos sc-1mty1jv-6 hQCYRH" height="8px" selectable="0" width="8px"><path d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></a></div></div></div>
			</div>
     	<div class="row">
				<div class="col-md-7">
				</div>
				<div class="col-md-5">
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


