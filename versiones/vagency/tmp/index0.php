<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Web pruebas estadística educativa</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- plugins js-->
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
				<script src="https://code.highcharts.com/highcharts.js"></script>
				<script src="https://code.highcharts.com/modules/exporting.js"></script>
				<script type="text/javascript" src="https://code.highcharts.com/modules/data.js"></script>
				<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        
        <script src="js/main.js" crossorigin="anonymous"></script>
       <!-- <script src="js/mapas.js" crossorigin="anonymous"></script>-->
        <script src="js/filtros.js" crossorigin="anonymous"></script>
        <script src="js/gen_stacked_csv.js" crossorigin="anonymous"></script>
        <script src="js/gen_general_csv.js" crossorigin="anonymous"></script>
        <script src="js/gen_evolutivos.js" crossorigin="anonymous"></script>
				<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDORxJ68R5GU5pNKhO0fT_icSShE9c94Ic&callback=initMap"   defer></script>

        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
				<link href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet"/>				
				<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
				<link href='https://fonts.googleapis.com/css?family=Hepta Slab' rel='stylesheet'>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/font-awesome.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
				<link href="css/custom.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top"><p>INICIO</p></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ml-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#ensenanzas">Enseñanzas</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#centros">Centros</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#matricula">Matrícula</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#team">EQUIPO</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#territorio">Territorio</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#graficos">Gráficos</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-heading"> Estadística Educativa Aragón</div>
                <div class=""> Datos correspodientes al curso 2019/2020</div>
								<hr class="hrportada">
        <!-- Menu-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-book fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3"><a href="#ensenanzas">INFORMACIÓN POR ENSEÑANZAS</a></h4>
                        <p class="text-muted">Estadísticas de enseñanzas y centros por provincia, comarca, zona y municipio</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-database fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3"><a href="#matricula">ESTADÍSTICA MATRÍCULA</a></h4>
                        <p class="text-muted">Datos tabulados de matrícula (u otros parámetros) en diferentes ámbitos, provincial, comarcal...y enseñanzas </p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-chart-bar fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3"><a href="#graficos">GRÁFICOS</a></h4>
                        <p class="text-muted">Gráficos de matrícula (u otros parámetros) diferenciados en Generales (mostrando el valor para diferentes provincias por ejemplo), Comparativos (comparando diferentes aspectos, p.ej. pública/concertada) y Evolutivos (evoluión del párámetro por años)</p>
                    </div>
                </div>
            </div>
        </section>
            </div>
        </header>
        <!-- Enseñanzas Grid-->
        <section class="page-section" id="ensenanzas">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Enseñanzas</h2>
                    <h3 class="section-subheading text-muted">Datos ordenados por tipo de enseñanza</h3>
											<button id="id_boton_mostrarlistado_personalizado" class="btn btn-info" style="padding-bottom:10px">
													LISTADO PERSONALIZADO
											</button><br>
                </div>
                <div id="id_formulario_enseñanzas" class="row text-center" style="display:none">
                    <div class="col-md-12 tdimensiones">
        										<!-- Inicio formulario dimensiones-->
															<form class="contact100-form validate-form">
															  <input type="hidden" id="tipoconsulta" name="tipoconsulta" value="enseñanzas"> 
																<div id="filatablas" class="row" style="">
																	<div class="col-md-6 filadim" id="dimlistados">
																		<div class="input-group mb-3">
																			<select class="custom-select" id="dlistados1">
																				<option selected="">Elige dato representar</option>
																					<option value="naturaleza">Naturaleza (público/privado)</option>
																					<option value="provincia">Provincia</option>
																					<option value="municipio">Municipio</option>
																			</select>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<div class="input-group mb-3">
																			<select class="custom-select" id="dlistados2" name="dim[]">
																				<option value="0" selected="">Elige dato representar</option>
																				<option value="naturaleza">Naturaleza (público/privado)</option>
																				<option value="provincia">Provincia</option>
																				<option value="municipio">Municipio</option></select>
																		</div>
																	</div>
																</div>
														</form>
															<button id="id_boton_genlistado_personalizado" class="btn btn-info" style="margin:10px">
																	GENERAR LISTADO
															</button>
													<!-- Fin formulario dimensiones-->
										</div>
                </div>
                <div id="id_mostrar_listado_personalizado"></div>
                <div id="id_listado_defecto" class="text-center">
										<button id="id_boton_genlistado_defecto" class="btn btn-info">
												LISTADO ENSEÑANZAS->PROVINCIAS->CENTROS
										</button>
								</div>
                <div id="id_mostrar_listado_defecto"></div>
           </div>
        </section>
        <!-- Gráficos Grid-->
        <section class="page-section bg-light" id="graficos">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Gráficos</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
								<!--INICIO GRAFICOS GENERAL-->
                <div id="graficos_general" class="caja_graficos" target="caja_graficos_general">
									<p>GRÁFICOS GENERAL</p>
								</div>
								<div id="caja_graficos_general" class="" style="display:none">
									<div class="form-group">
										<label for="exampleFormControlSelect1">Elige parámetro</label>
										<select class="form-control" id="exampleFormControlSelect1">
											<option>Matrícula ordinaria</option>
											<option>Ratio matricula inmigrantes</option>
											<option>Ratio matrícula pública/privada</option>
											<option>Número de profesores</option>
											<option>Número de centros</option>
										</select>
									</div>
									<div id="grafico_inmigracion_centros" class="gg row">
											<div class="col-lg-12 col-sm-6 mb-4">
													<div class="portfolio-item">
														<div>Grafico porcentaje inmigración</div><hr>
															<button id="pct_porcentros" class="boton_filtro_graficos">Por centros</button>
															<button id="pct_porcomarcas" class="boton_filtro_graficos">Por comarca</button>
															<div id="show_grafico_general">
															</div>
													</div>
											</div>
									</div>
                </div>
								<!--FIN GRAFICOS GENERAL-->
								<!--INICIO GRAFICOS COMPARATIVOS-->
                <div id="graficos_comparativos" class="caja_graficos" target="interior_graficos_comparativos">GRÁFICOS COMPARATIVOS
                	<div id="interior_graficos_comparativos" class="caja_graficos" style="display:none">
										<div class="form-group">
											<label for="exampleFormControlSelect1">Elige parámetro</label>
											<select class="form-control" id="elige_comparativos">
												<option>Pública - Concertada</option>
												<option>Padrón - Matrícula</option>
												<option>Ratio pública/privada y padrón</option>
											</select>
										</div>
										<div id="graficos_ei" class="caja_graficos_comparativos" style="display:none">GRÁFICOS INFANTIL<hr>
											<div id="grafico_evo_con_pub_ei" class="gei row">
													<div class="col-lg-12 col-sm-6 mb-4">
															<div class="portfolio-item">
																<div>Matrícula Pública - Matrícula Concertada</div><hr>
																	<div id="grafico_ei_1">
																	</div>
															</div>
													</div>
											</div>
											<div class="gei row">
													<div id="grafico_evo_padron_nalumnos_ei" class="col-lg-6 col-sm-6 mb-4">
															<div class="portfolio-item">
																<div>Padrón - Matrícula</div><hr>
																	<div id="grafico_ei_2">
																	</div>
															</div>
													</div>
													<div class="col-lg-6 col-sm-6 mb-4">
															<div class="portfolio-item">
																<div>% Pública - Concertada resp. padrón</div><hr>
																	<div id="grafico_ei_3">
																	</div>
															</div>
													</div>
											</div>
										</div>
										<div id="graficos_ep" class="caja_graficos">GRÁFICOS PRIMARIA<hr>
											<div id="grafico_evo_con_pub_ep" class="gep row">
													<div class="col-lg-12 col-sm-6 mb-4">
															<div class="portfolio-item">
																<div>Matrícula Pública - Matrícula Concertada</div><hr>
																	<div id="grafico_ep_1">
																	</div>
															</div>
													</div>
											</div>
											<div class="gep row">
													<div id="grafico_evo_padron_nalumnos_ep" class="col-lg-6 col-sm-6 mb-4">
															<div class="portfolio-item">
																<div>Padrón - Matrícula</div><hr>
																	<div id="grafico_ep_2">
																	</div>
															</div>
													</div>
													<div class="col-lg-6 col-sm-6 mb-4">
															<div class="portfolio-item">
																<div>% Pública - Concertada resp. padrón</div><hr>
																	<div id="grafico_ep_3">
																	</div>
															</div>
													</div>
											</div>
										</div>
										<div id="graficos_eso" class="caja_graficos">GRÁFICOS ESO<hr>
											<div id="grafico_evo_con_pub_eso" class="geso row">
													<div class="col-lg-12 col-sm-6 mb-4">
															<div class="portfolio-item">
																<div>Pública-Concertada</div><hr>
																	<div id="grafico_eso_1">
																	</div>
															</div>
													</div>
											</div>
											<div class="geso row">
													<div id="grafico_evo_padron_nalumnos_eso" class="col-lg-6 col-sm-6 mb-4">
															<div class="portfolio-item">
																<div>Padrón - Matrícula</div><hr>
																	<div id="grafico_eso_2">
																	</div>
															</div>
													</div>
													<div class="col-lg-6 col-sm-6 mb-4">
															<div class="portfolio-item">
																<div>% Pública - Concertada resp. padrón</div><hr>
																	<div id="grafico_eso_3">
																	</div>
															</div>
													</div>
											</div>
										</div>
										<div id="graficos_bach" class="caja_graficos">GRÁFICOS BACHILLERATO<hr>
											<div id="grafico_evo_con_pub_bach" class="gbach row">
													<div class="col-lg-12 col-sm-6 mb-4">
															<div class="portfolio-item">
																<div>Pública-Concertada</div><hr>
																	<div id="grafico_bach_1">
																	</div>
															</div>
													</div>
											</div>
											<div class="gbach row">
													<div id="grafico_evo_padron_nalumnos_eso" class="col-lg-6 col-sm-6 mb-4">
															<div class="portfolio-item">
																<div>Padrón - Matrícula</div><hr>
																	<div id="grafico_bach_2">
																	</div>
															</div>
													</div>
													<div class="col-lg-6 col-sm-6 mb-4">
															<div class="portfolio-item">
																<div>% Pública - Concertada resp. padrón</div><hr>
																	<div id="grafico_bach_3">
																	</div>
															</div>
													</div>
											</div>
										</div>
									</div>
								</div>
								<!--FIN GRAFICOS COMPARATIVOS-->
								<!--INICIO GRAFICOS EVOLUTIVOS-->
                <div id="graficos_evolutivos" class="caja_graficos" target="caja_graficos_evolutivos">
                	<p>GRÁFICOS EVOLUTIVOS</p>
								</div>
								<div id="caja_graficos_evolutivos" style="display:none">
									<!--<button id="cambiarcsv">Change CSV</button>-->
									<div id="grafico_evolutivo_enseñanzas" class="evolutivos row">
										<div class="col-lg-12 col-sm-6 mb-4">
											<div class="portfolio-item">
												<div id="interior_graficos_evolutivos" class="subcaja_graficos">Por enseñanzas<hr>
													<div id="hijo_grafico_evolutivo_enseñanzas">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div id="grafico_evolutivo_comarca" class="evolutivos row">
										<div class="col-lg-12 col-sm-6 mb-4">
											<div class="portfolio-item">
												<div id="evolutivo_comarcas" class="subcaja_graficos">Por Comarcas<hr></div>
													<div id="opcionescomarcas" class="form-group" style="display:none">
														<div  class="form-group">
															<label for="exampleFormControlSelect1">Selecciona Comarca</label>
															<select class="form-control" id="selcomarca">
																<?php include('includes/fopciones/listacomarcas.html');?>	
															</select>
														</div>
														<div id="show_grafico_evolutivo_comarca">
														</div>
													</div>
	
												<div id="evolutivo_zonas" class="subcaja_graficos">Por Zonas<hr>
													<div class="form-group">
														<label for="exampleFormControlSelect1">Selecciona Zona</label>
														<select class="form-control" id="selzona">
															<?php include('includes/fopciones/listazonas.html');?>	
														</select>
													</div>
												<div id="show_grafico_evolutivo_zona">
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--FIN GRAFICOS EVOLUTIVOS-->
            </div>
        </section>
        <!-- About-->
        <section class="page-section" id="centros">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Centros</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <ul class="timeline">
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/1.jpg" alt="" /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2009-2011</h4>
                                <h4 class="subheading">Our Humble Beginnings</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/2.jpg" alt="" /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>March 2011</h4>
                                <h4 class="subheading">An Agency is Born</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/3.jpg" alt="" /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>December 2012</h4>
                                <h4 class="subheading">Transition to Full Service</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/4.jpg" alt="" /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>July 2014</h4>
                                <h4 class="subheading">Phase Two Expansion</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                Be Part
                                <br />
                                Of Our
                                <br />
                                Story!
                            </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <!-- Tablas-->
        <section class="page-section bg-light" id="matricula">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Matrícula</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <div class="row text-center">
                    <div class="col-md-12 tdimensiones">
        										<!-- Inicio formulario dimensiones tablas-->
															<form class="contact100-form validate-form">
															  <input type="hidden" id="tipoconsulta_tablas" name="tipoconsulta" value="tablas"> 
																<div id="filatablas" class="row" style="">
																	<div class="col-md-4" >
																		<div class="input-group mb-3">
																			<select class="custom-select" id="dtablas1">
																				<option selected>Columnas disponibles</option>
																				<option value="naturaleza">Naturaleza (público/privado)</option>
																				<option value="provincia">Provincia</option>
																				<option value="enseñanza">Enseñanza</option>
																			</select>
																		</div>
																	</div>
																	<div class="col-md-4">
																		<div class="input-group mb-3">
																			<select class="custom-select" id="dtablas2" name="dim[]">
																				<option value="Campos disponibles" selected>Filas disponibles</option>
																				<option value="naturaleza">Naturaleza (público/privado)</option>
																				<option value="enseñanza">Enseñanza</option>
																				<option value="provincia">Provincia</option>
																				<option value="comarca">Comarca</option>
																				<option value="municipio">Municipio</option>
																				<option value="zona">Zona</option>
																			</select>
																		</div>
																	</div>
																	<div class="col-md-4">
																		<div class="input-group mb-3">
																			<select class="custom-select" id="dtablas3" name="dim[]">
																				<option value="Campos disponibles" selected>Filas disponibles</option>
																				<option value="naturaleza">Naturaleza (público/privado)</option>
																				<option value="enseñanza">Enseñanza</option>
																				<option value="provincia">Provincia</option>
																				<option value="comarca">Comarca</option>
																				<option value="municipio">Municipio</option>
																				<option value="zona">Zona</option>
																			</select>
																		</div>
																	</div>
																</div><!--fin fila tablas-->
															<div class="row">
																<div class="col-md-3">
																</div>
																<div class="col-md-6">
																	<!--<a id="ver_filtros_tablas" class="btn btn-primary text-uppercase boton_filtro" role="button">Ver Filtros</a>-->
																</div>
															</div>
															<div class="row" id="fila_filtros_tablas">
																<div class="col-md-4 caja_filtro">
																	<p opacity="1"><b>Enseñanzas</b><br></p>
																	<div class="row">
																		<div class="col-md-6" style="text-align:center">
																			<div class="btn botonfiltro">Primaria</div>
																			<div class="btn botonfiltro">Secundaria</div>
																			<div class="btn botonfiltro">Bachillerato</div>
																			<div class="btn botonfiltro">FP</div>
																		</div>
																		<div class="col-md-6" style="text-align:center">
																			<div class="btn botonfiltro">Primaria</div>
																			<div class="btn botonfiltro">Secundaria</div>
																			<div class="btn botonfiltro">Bachillerato</div>
																			<div class="btn botonfiltro">FP</div>
																		</div>
																	</div>
																</div>
																<div class="col-md-2 caja_filtro" style="text-align:center">
																	<p><b>Naturaleza (público/privado)</b></p><br>
																	<div class="btn botonfiltro_datoscentros">Público</div>
																	<div class="btn botonfiltro_datoscentros">Concertado</div>
																</div>
															</div>
													</form>
															<button id="boton_gentablas" class="btn btn-info">
																	GENERAR TABLAS
															</button>
													<!-- Fin formulario dimensiones tablas-->
										</div>
                </div>
                <div id="mostrar_tabla" class="row">
                </div>
                <div id="mostrar_tabla_pruebas" class="row">
									<?php #include('scripts/php/out');?>
                </div>
               </div>
            </div>
        </section>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Contact Us</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <form id="contactForm" name="sentMessage" novalidate="novalidate">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" id="name" type="text" placeholder="Your Name *" required="required" data-validation-required-message="Please enter your name." />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address." />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group mb-md-0">
                                <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" required="required" data-validation-required-message="Please enter your phone number." />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <textarea class="form-control" id="message" placeholder="Your Message *" required="required" data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div id="success"></div>
                        <button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">Send Message</button>
                    </div>
                </form>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-left">Copyright © Your Website 2020</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-right">
                        <a class="mr-3" href="#!">Privacy Policy</a>
                        <a href="#!">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Portfolio Modals-->
        <!-- Modal 1-->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/01-full.jpg" alt="" />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>Date: January 2020</li>
                                        <li>Client: Threads</li>
                                        <li>Category: Illustration</li>
                                    </ul>
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 2-->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/02-full.jpg" alt="" />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>Date: January 2020</li>
                                        <li>Client: Explore</li>
                                        <li>Category: Graphic Design</li>
                                    </ul>
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 3-->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/03-full.jpg" alt="" />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>Date: January 2020</li>
                                        <li>Client: Finish</li>
                                        <li>Category: Identity</li>
                                    </ul>
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 4-->
        <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/04-full.jpg" alt="" />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>Date: January 2020</li>
                                        <li>Client: Lines</li>
                                        <li>Category: Branding</li>
                                    </ul>
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 5-->
        <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/05-full.jpg" alt="" />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>Date: January 2020</li>
                                        <li>Client: Southwest</li>
                                        <li>Category: Website Design</li>
                                    </ul>
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 6-->
        <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/06-full.jpg" alt="" />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>Date: January 2020</li>
                                        <li>Client: Window</li>
                                        <li>Category: Photography</li>
                                    </ul>
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Contact form JS-->
        <script src="assets/mail/jqBootstrapValidation.js"></script>
        <script src="assets/mail/contact_me.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
