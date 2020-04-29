<?php
//si el formualrio es para graficos
include_once('./scripts/php/datos_origen/dim_tablas.php');
//$keys=array_keys($dim_graficos);
$keys=$dim_tablas;
?>
<div class="col-md-4" id="dimlistados">
	<div class="input-group mb-3">
	  <select class="custom-select" id="d20" >
	    <option selected>Elige dato representar</option>
	<?php
		foreach($keys as $d=>$v)
			echo '<option value="'.$d.'">'.$d.'</option>';
	?>
	  </select>
	</div>
	</div>
	<div class="col-md-4">
	<div class="input-group mb-3">
	  <select class="custom-select" id="d21" name="dim[]">
	    <option value="0" selected>Elige dato representar</option>
	<?php
		foreach($keys as $d=>$v)
			echo '<option value="'.$d.'">'.$d.'</option>';
	?>
	  </select>
	</div>
	</div>
	<div class="col-md-4">
	<div class="input-group mb-3">
	  <select class="custom-select" id="d22"  name="dim[]">
	    <option value="0" selected>Elige dato representar</option>
	<?php
		foreach($keys as $d=>$v)
			echo '<option value="'.$d.'">'.$d.'</option>';
	?>
	  </select>
	</div>
</div>
