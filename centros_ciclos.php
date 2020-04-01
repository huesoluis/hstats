<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<p class="description" style="font-size:30px;">
<b>Ciclos formativos y centros</b>
</p>
<br>
<ul class="accordion1">
  
<?php 
$entidad = file_get_contents('scripts/php/datos_listados/f_centros_ciclos.json');
$json = json_decode($entidad, true);
$i=0;
echo '<ul>';
foreach ($json as $ent)
{
$i++;
$keys=array_keys($ent);
$cabecera='';
?>
<li class="dencuali" data-type="dencuali">
	<a class="toggle1 enlaces" data-type="titulo" data-toggle="collapse" data-target="#n1<?php echo $i;?>" >
		<?php
			 foreach($keys as $key)
				if($key!='children')
					$cabecera.="<b>$key:</b>$ent[$key]-";
			print(trim($cabecera,'-'));
		?>
	</a>
		<div id="n1<?php echo $i;?>" class="collapse">
			<?php 
			if(sizeof($ent["children"])>=1)
				{
					$hijo=0;
					foreach ($ent['children'] as $sbent)
					{
					if(sizeof($sbent["children"])>=1)
						print("hay mas hijos");
					else
						{
						$keys=array_keys($sbent);
						print("<div class='hijo' style='padding-left:30px'>");
							print("<a data-toggle='collapse' data-target='#h$hijo'><b>".$sbent[$keys[0]]."</b></a>");
								print("<div id='h$hijo' class='collapse' style='padding-left:30px'>");
									$hijo++;
									foreach($sbent as $k=>$val)
										{
										print_r($k);
										print(" : ");
										print_r($val);
										print("<br>");
										}
								print("</div>");
						print("</div>");
						}
					}
				}




			 ?>
<!--
$arr = json_decode('[{"var1":"9","var2":"16","var3":"16"},{"var1":"8","var2":"15","var3":"15"}]');

foreach($arr as $item) { //foreach element in $arr
    $uses = $item['var1']; //etc
}

	  <p>
			@foreach ($ent['children'] as $ech)
			{{ $ech['codigo'] }}
			<br>
			{{ $ech['tipo'] }}
			{{ $ech['id'] }}
			{{ $ech['dir'] }}
			{{ $ech['prov'] }}
			{{ $ech['loc'] }}
			{{ $ech['tel'] }}
			{{ $ech['mail'] }}
			<br>
			
			@endforeach 
	  </p>
-->    
    		</div>
  </li>
<?php }?>
</ul>
</body>
