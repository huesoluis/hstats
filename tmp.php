
<p class="description" style="font-size:30px;">
<b>Ciclos formativos y centros</b>
</p>
<br>
<ul class="accordion1">
  
<?php 
$entidad = file_get_contents('datosjson/ciclos_centros.json');
$json = json_decode($entidad, true);
$i=0;
echo '<ul>';
foreach ($json as $ent)
{
	$i++;
	$keys=array_keys($ent);
	$cabecera='<table class="table"><thead><tr>';
	$cabecera1='<tr><table class="table1"><thead><tr>';
	?>
	<li class="dencuali" data-type="dencuali">
			<?php
				$fila='<tr>';
				if($i==1)
				{
					foreach($keys as $key)
					{
						if($key!='children')
						{
							$cabecera.="<th><b>$key</b></th>";
							$fila.="<td>".$ent[$key]."</td>";
						}
					}
				$cabecera.="</tr></thead><tbody>";
				print($cabecera);
				print($fila."</tr>");
				}
				else{
					foreach($keys as $key)
						if($key!='children')
						{
							$fila.="<td>".$ent[$key]."</td>";
						}
					print($fila."</tr>");
				}
			?>
	</li>
	<?php
}
show_table();

function show_table($ent,$i=0)
{
	$i++;
	$keys=array_keys($ent);
	$cabecera='<table class="table"><thead><tr>';
	echo '<li class="dencuali" data-type="dencuali">'
	$fila='<tr>';
	if($i==1)
	{
		foreach($keys as $key)
		{
			if($key!='children')
			{
				$cabecera.="<th><b>$key</b></th>";
				$fila.="<td>".$ent[$key]."</td>";
			}
		}
	$cabecera.="</tr></thead><tbody>";
	print($cabecera);
	print($fila."</tr>");
	}
	else
	{
		foreach($keys as $key)
			if($key!='children')
			{
				$fila.="<td>".$ent[$key]."</td>";
			}
		print($fila."</tr>");
	}
	echo '</li>';
print("</tbody></table>");		

}

?>
</ul>
