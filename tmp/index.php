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
        <script src="js/mapas.js" crossorigin="anonymous"></script>
        <script src="js/filtros.js" crossorigin="anonymous"></script>
        <script src="js/gen_stacked_csv.js" crossorigin="anonymous"></script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDORxJ68R5GU5pNKhO0fT_icSShE9c94Ic&callback=initMap"
      defer
    ></script>

        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
				<link href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet"/>				
				<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
				<link href='https://fonts.googleapis.com/css?family=Hepta Slab' rel='stylesheet'>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
				<link href="css/custom.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top"><p>DATOS EDUCACIÓN ARAGÓN</p></a>
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
								<hr class="hrportada">
            </div>
        </header>
        <!-- Menu-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Consultas</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-book fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">INFORMACIÓN POR ENSEÑANZAS</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-building fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">INFORMACIÓN POR CENTROS</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-database fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">ESTADÍSTICA MATRÍCULA</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Enseñanzas Grid-->
        <section class="page-section" id="ensenanzas">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Enseñanzas</h2>
                    <h3 class="section-subheading text-muted">Datos ordenados por tipo de enseñanza</h3>
											<button id="id_boton_mostrarlistado_personalizado" class="btn btn-info" style="padding-bottom:10px">
													MOSTRAR LISTADO PERSONALIZADO
											</button><br>
                </div>
                <div id="id_formulario_enseñanzas" class="row text-center" style="display:none">
                    <div class="col-md-12 tdimensiones">
        										<!-- Inicio formulario dimensiones-->
															<form class="contact100-form validate-form">
															  <input type="hidden" id="tipoconsulta" name="tipoconsulta" value="enseñanzas"> 
																<div id="filatablas" class="row" style="">
																	<div class="col-md-4 filadim" id="dimlistados">
																		<div class="input-group mb-3">
																			<select class="custom-select" id="dlistados1">
																				<option selected="">Elige dato representar</option>
																					<option value="tipocentro">Naturaleza (público/privado)</option>
																					<option value="provincia">Provincia</option>
																					<option value="localidad">Localidad</option>
																			</select>
																		</div>
																	</div>
																	<div class="col-md-4">
																		<div class="input-group mb-3">
																			<select class="custom-select" id="dlistados2" name="dim[]">
																				<option value="0" selected="">Elige dato representar</option>
																				<option value="tipocentro">Naturaleza (público/privado)</option>
																				<option value="provincia">Provincia</option>
																				<option value="localidad">Localidad</option></select>
																		</div>
																	</div>
																<div class="col-md-4">
																	<div class="input-group mb-3">
																		<select class="custom-select" id="dlistados3" name="dim[]">
																			<option value="0" selected="">Elige dato representar</option>
																			<option value="tipocentro">Naturaleza (público/privado)</option>
																			<option value="provincia">Provincia</option>
																			<option value="localidad">Localidad</option></select>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-3">
																</div>
																<div class="col-md-6">
																	<a id="ver_filtros" class="btn btn-primary text-uppercase boton_filtro" role="button">Ver Filtros</a>
																</div>
															</div>
															<div class="row" id="fila_filtros">
																<div class="col-md-4 caja_filtro">
																	<p><b>Enseñanzas</b></p></br>
																	<div class="row">
																		<div class="col-md-6" style="text-align:center">
																			<div class="btn botonfiltro_listados" estado="OFF">Otros Programas Formativos de FP</div>
																			<div class="btn botonfiltro_listados" estado="OFF">Otros Programas Formativos de FP - EE</div>
																			<div class="btn botonfiltro_listados" estado="OFF">Enseñanzas no regladas de la Música LOGSE</div>
																			<div class="btn botonfiltro_listados" estado="OFF">E. Infantil - Primer Ciclo</div>
																			<div class="btn botonfiltro_listados" estado="OFF" >E. Infantil _ Segundo Ciclo</div>
																		</div>
																		<div class="col-md-6" style="text-align:center">
																			<div class="btn botonfiltro_listados" estado="OFF">E. Primaria</div>
																			<div class="btn botonfiltro_listados" estado="OFF">E.S.O.</div>
																			<div class="btn botonfiltro_listados" estado="OFF">Educación Especial</div>
																		</div>
																	</div>
																</div>
																<div class="col-md-2 caja_filtro ftipo_centro" style="text-align:center">
																	<p><b>Tipo Centro</b></p><br>
																	<div class="btn botonfiltro_listados" estado="OFF">Público</div>
																	<div class="btn botonfiltro_listados" estado="OFF">Concertado</div>
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
												MOSTRAR LISTADO ENSEÑANZAS
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
                <div id="graficos_ei" class="caja_graficos">GRÁFICOS INFANTIL<hr>
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
        <!-- Team-->
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
																				<option selected>Campos disponibles</option>
																				<option value="centro">Centro</option>
																				<option value="naturaleza">Tipo Centro</option>
																				<option value="provincia">Provincia</option>
																				<option value="localidad">Localidad</option>
																				<option value="enseñanza">Enseñanza</option>
																			</select>
																		</div>
																	</div>
																	<div class="col-md-4">
																		<div class="input-group mb-3">
																			<select class="custom-select" id="dtablas2" name="dim[]">
																				<option value="Campos disponibles" selected>Campos disponibles</option>
																				<option value="centro">Centro</option>
																				<option value="naturaleza">Tipo Centro</option>
																				<option value="provincia">Provincia</option>
																				<option value="localidad">Localidad</option>
																				<option value="enseñanza">Enseñanza</option>
																			</select>
																		</div>
																	</div>
																<div class="col-md-4">
																	<div class="input-group mb-3">
																		<select class="custom-select" id="dtablas3" name="dim[]">
																			<option value="Campos disponibles" selected>Campos disponibles</option>
																			<option value="centro">Centro</option>
																			<option value="naturaleza">Tipo Centro</option>
																			<option value="provincia">Provincia</option>
																			<option value="localidad">Localidad</option></select>
																			<option value="enseñanza">Enseñanza</option>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-3">
																</div>
																<div class="col-md-6">
																	<a id="ver_filtros_tablas" class="btn btn-primary text-uppercase boton_filtro" role="button">Ver Filtros</a>
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
																	<p><b>Tipo Centro</b></p><br>
																	<div class="btn botonfiltro">Público</div>
																	<div class="btn botonfiltro">Concertado</div>
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
        <!-- Team-->
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/equipo.jpg" alt="" />
                            <h4>Los Pelavaras</h4>
                            <p class="text-muted">4 G</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/2.jpg" alt="" />
                            <h4>Larry Parker</h4>
                            <p class="text-muted">Lead Marketer</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/3.jpg" alt="" />
                            <h4>Diana Petersen</h4>
                            <p class="text-muted">Lead Developer</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center"><p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p></div>
                </div>
            </div>
        </section>
        <!-- Contact-->
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
