<?php
include_once('./scripts/php/datos_origen/dim_oferta.php');
$keys=array_keys($dim_oferta);
?>
<div class="col-md-4">
<div class="input-group mb-3">
  <select class="custom-select" id="d0" >
    <option selected>Elige dato representar</option>
<?php
	foreach($keys as $d=>$v)
    		echo '<option value="'.$v.'">'.$v.'</option>';
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
    		echo '<option value="'.$v.'">'.$v.'</option>';
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
    		echo '<option value="'.$v.'">'.$v.'</option>';
?>
  </select>
</div>
</div>
