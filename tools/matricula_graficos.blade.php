@extends('layouts.mastertop')
@section('headsc')
  <link rel="stylesheet" href="css/graph.css">
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="http://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript" src="https://code.highcharts.com/modules/data.js"></script>
<!--<script type="text/javascript" src="js/graphs.js"></script>-->
@yield('graficojs')
@endsection

@section('contenttop')
@yield('cabeceragrafico')
    		<div class="col-sm-3 col-xm-12">
		<!--
			<div class="sidebar-module sidebar-module-inset">
				<form class="form-inline mt-2 mt-md-0" style="padding-bottom:10px">
          				<input class="form-control mr-sm-2" id="search" placeholder="Familia" type="text">
        			</form>
          		</div>
		-->
          		<div class="sidebar-module">
            			<ol class="list-unstyled">
              				<li><a href="mat_provincia" class="text-dark">Matrícula por ciclo y provincia</a></li>
					<hr>
              				<li><a href="mat_genero" class="text-dark">Matrícula por ciclo y género</a></li>
					<hr>
              				<li><a href="mat_genero_porcentaje" class="text-dark">Matrícula por ciclo y género</a><span style='font-size:10px'><i>En porcentaje</i></span></li>
					<hr>
            			</ol>
          		</div>

		</div>
  	</div>
      	<div class="row small ">	</div>
</div>


@endsection

