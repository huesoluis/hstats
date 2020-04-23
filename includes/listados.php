<p class="description" style="font-size:30px;">
<b>Ciclos formativos y centros</b>
</p>
<br>
<ul class="accordion1">
  
<?php 
$entidad = file_get_contents('datosjson/ciclos_centros.json');
$json = json_decode($entidad, true);
$i=1;
$j=1;
echo '<ul>';
foreach ($json as $ent)
{
echo "<a class='toggle1 enlaces' data-type='titulo' data-toggle='collapse' data-target='#n1_$i' >";
	show_table($ent);
echo "</a>";
$i++;
$sn=$i-1;
		echo "<div id='n1_$sn' class='collapse segundonivel'>";
			if(isset($ent['children']))
			{
			foreach ($ent['children'] as $sbent)
			{
				$keys=array_keys($sbent);
				echo "<a class='toggle1 enlaces' data-type='titulo' data-toggle='collapse' data-target='#n2_$j' >";
					print($sbent[$keys[0]]);
					print("<br>");
				echo "</a>";
				echo "<div id='n2_$j' class='collapse segundonivel'>";
					show_table($sbent);
					$j++;
				echo "</div>";
			}
			}

		echo "</div>";
break;
}


function show_table($ent)
{
	global $i,$j;
	$keys=array_keys($ent);
	$cabecera='<table class="table table-borderless table-dar"><thead><tr>';
	$fila='<tr>';
	if($i==1 || $j==1)
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
				$cabecera.="<th></th>";
				$fila.="<td>".$ent[$key]."</td>";
			}
	print($cabecera);
	print($fila."</tr>");
	}
	print("</tbody></table>");		
}

?>
</ul>
