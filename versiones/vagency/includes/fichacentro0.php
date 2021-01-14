<?php
$fichacentro="
	<div class='row hoja'>
		<div class='card col-md-6'>
			<p class='card-text'>Centro de Educacón Secundaria y Formación Profesional</p>
			<p class='card-text'><small class='text-muted'>1200 alumnos</small></p>
			<img class='card-img-top' src='assets/img/shimg.jpg' alt='imagen sh'>
			<div class='card-body'>
				<h5 class='card-title'></h5>
			</div>
		</div>
		<div class='card col-md-6'>
			<div class='card-body'>
				<h5 class='card-title'>Ubicación</h5>
				<p class='card-text'><small class='text-muted'>A 27 minutos de tu ubicación actual</small></p>
			</div>
			<div class='card-img-top' id='mapcentro$id'  style='width:100%;height:400px;' ></div>
		</div>
	</div>
<script>
var mapProp= {
  center:new google.maps.LatLng(51.508742,-0.120850),
  zoom:5,
};
var map = new google.maps.Map(document.getElementById('mapcentro$id'),mapProp);
</script>
   
";
?>
