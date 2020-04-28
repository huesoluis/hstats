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
$chpn=1;
$listadoshtml.= '<ul>';
	foreach ($json as $ent)
	{
	if($chpn==1) $listadoshtml.=show_cabecera($ent)."<hr>";
	$chpn++;
	$listadoshtml.="<a class='toggle1 enlaces' data-type='titulo' data-toggle='collapse' data-target='#n1_$i' >";
		$listadoshtml.=	show_table($ent,1);
	$listadoshtml.="</a>";
	$i++;
	$sn=$i-1;
	$listadoshtml.="<div id='n1_$sn' class='collapse segundonivel'>";
				if(isset($ent['children']))
				{
					$chsn=1;
					
					foreach ($ent['children'] as $sbent)
					{
						if($chsn==1) $listadoshtml.=show_cabecera($sbent)."<hr>";
						$chsn++;
						$listadoshtml.="<a class='toggle1 enlaces' data-type='titulo' data-toggle='collapse' data-target='#n2_$j' >";
							$listadoshtml.=show_table($sbent,1);
						$listadoshtml.="</a>";
						$j++;
						
						//iniciio tercer nivel
						$tn=$j-1;
						$listadoshtml.="<div id='n2_$tn' class='collapse tercernivel'>";
								if(isset($sbent['children2']))
								{
								$chtn=1;
									foreach ($sbent['children2'] as $tbent)
									{
										if($chtn==1) $listadoshtml.=show_cabecera($tbent)."<hr>";
										$chtn++;
										$listadoshtml.="<a class='toggle1 enlaces' data-type='titulo' data-toggle='collapse' data-target='#n3_$k' >";
											$listadoshtml.=show_table($tbent,1);
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


function show_cabecera($ent)
{
	$keys=array_keys($ent);
	$thead='<table class="table table-borderless table-dar"><tbody>';
	$thead.='<tr>';
		foreach($keys as $key)
		{
			if($key!='children' and $key!='children2')
			{
				$thead.="<td><b>$key</b></td>";
			}
		}
	$thead.="</tr></tbody></table>";
return $thead;

}
function show_table($ent,$nelto=0)
{
	$tabla='';
	$tbody="<tbody>";
	global $i,$j,$k;
	$keys=array_keys($ent);
	$cabecera='<table class="table table-borderless table-dar">';
	$thead='<thead><tr>';
	$fila='<tr>';
	if($i==1 || $j==1 || $k==1)
	{
		foreach($keys as $key)
		{
			if($key!='children' and $key!='children2')
			{
				$thead.="<th><b>$key</b></th>";
				$fila.="<td>".$ent[$key]."</td>";
			}
		}
	$thead.="</tr></thead>";
	$tabla.=$cabecera;
	//$tabla.=$thead;
	//if($nelto==1) $tabla.=$thead;
	$tabla.=$tbody;
	$tabla.=$fila."</tr>";
	}
	else
	{
		foreach($keys as $key)
			if($key!='children' and $key!='children2')
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
