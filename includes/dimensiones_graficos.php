<?php
include_once('./scripts/php/datos_origen/dim_graficos.php');
$keys=$dim_graficos;
?>
<div class="col-md-4" id="dimgraficos">
	<div class="input-group mb-3">
	  <select class="custom-select" id="d0" >
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
	  <select class="custom-select" id="d1" name="dim[]">
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
	  <select class="custom-select" id="d2"  name="dim[]">
	    <option value="0" selected>Elige dato representar</option>
	<?php
		foreach($keys as $d=>$v)
			echo '<option value="'.$d.'">'.$d.'</option>';
	?>
	  </select>
	</div>
</div>
