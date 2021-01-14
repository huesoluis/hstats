<?php
include_once('./scripts/php/datos_origen/dim_evolutivos.php');
$keys=$dim_evolutivos;
?>
<div class="col-md-4" id="dimevolutivos">
	<div class="input-group mb-3">
	  <select class="custom-select" id="d30" >
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
	  <select class="custom-select" id="d31" name="dim[]">
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
	  <select class="custom-select" id="d32"  name="dim[]">
	    <option value="0" selected>Elige dato representar</option>
	<?php
		foreach($keys as $d=>$v)
			echo '<option value="'.$d.'">'.$d.'</option>';
	?>
	  </select>
	</div>
</div>
