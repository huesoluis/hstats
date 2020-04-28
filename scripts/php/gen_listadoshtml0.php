<?php 
$listadoshtml='';

$listadoshtml.='<p class="description" style="font-size:30px;">';

$listadoshtml.='<b>Ciclos formativos y centros</b></p><br><ul class="accordion1">';

//obtenemos los datos del fichero de datos generado segun el form de la web
$entidad = file_get_contents($fjson);
//$entidad = file_get_contents('datos_listados/f_ciclo_centro_pruebas.json');
$json = json_decode($entidad, true);
$i=1;
$j=1;
$k=1;
$listadoshtml.= '<ul>';
	foreach ($json as $ent)
	{
	$listadoshtml.="<a class='toggle1 enlaces' data-type='titulo' data-toggle='collapse' data-target='#n1_$i' >";
		$listadoshtml.=	show_table($ent);
	$listadoshtml.="</a>";
	$i++;
	$sn=$i-1;
	$listadoshtml.="<div id='n1_$sn' class='collapse segundonivel'>";
				if(isset($ent['children']))
				{
					foreach ($ent['children'] as $sbent)
					{
						$listadoshtml.="<a class='toggle1 enlaces' data-type='titulo' data-toggle='collapse' data-target='#n2_$j' >";
							$listadoshtml.=show_table($sbent,$j);
						$listadoshtml.="</a>";
						$j++;
						
						//iniciio tercer nivel
						$tn=$j-1;
						$listadoshtml.="<div id='n2_$tn' class='collapse tercernivel'>";
								if(isset($sbent['children2']))
								{
									foreach ($sbent['children2'] as $tbent)
									{
										$listadoshtml.="<a class='toggle1 enlaces' data-type='titulo' data-toggle='collapse' data-target='#n3_$k' >";
											$listadoshtml.=show_table($tbent);
										$listadoshtml.="</a>";
										$k++;
										//$tn=$k-1;
										//$listadoshtml.="<div id='n2_$tn' class='collapse tercernivel'>";
									}
								}
						$listadoshtml.="</div>";
						//fin tercer nivel
					}
				}
	$listadoshtml.="</div>";
	}
$listadoshtml.="</ul>";
print($listadoshtml);


function show_table($ent,$nelto=0)
{
	$tabla='';
	global $i,$j,$k;
	$keys=array_keys($ent);
	$cabecera='<table class="table table-borderless table-dar"><thead><tr>';
	$fila='<tr>';
	if($i==1 || $j==1 || $k==1)
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
	$tabla.=$cabecera;
	$tabla.=$fila."</tr>";
	}
	else
	{
		foreach($keys as $key)
			if($key!='children')
			{
				$cabecera.="<th></th>";
				$fila.="<td>".$ent[$key]."</td>";
			}
	$tabla.=$cabecera;
	$tabla.=$fila."</tr>";
	}
	$tabla.="</tbody></table>";	
return $tabla;	
}

?>
