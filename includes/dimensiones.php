<?php
include_once('./scripts/php/datos/dim_oferta.php');
$keys=array_keys($dim_oferta);
?>
<div class="col-md-4">
<div class="input-group mb-3">
  <select class="custom-select" name="dim[0]" id="d0">
    <option value="0" selected>Elige dato representar</option>
<?php
	foreach($keys as $d=>$v)
    		echo '<option value="'.$v.'">'.$v.'</option>';
?>
  </select>
</div>
</div>
<div class="col-md-4">
<div class="input-group mb-3">
  <select class="custom-select" name="dim[1]" id="d1">
    <option value="0" selected>Elige dato representar</option>
<?php
	foreach($keys as $d=>$v)
    		echo '<option value="'.$v.'">'.$v.'</option>';
?>
  </select>
</div>
</div>
<div class="col-md-4">
<div class="input-group mb-3">
  <select class="custom-select" name="dim[2]" id="d2">
    <option value="0" selected>Elige dato representar</option>
<?php
	foreach($keys as $d=>$v)
    		echo '<option value="'.$v.'">'.$v.'</option>';
?>
  </select>
</div>
</div>
