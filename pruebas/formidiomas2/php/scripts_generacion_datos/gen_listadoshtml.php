<?php 
require_once('../../../includes/filtros.php');
$listadoshtml='<div>';
//obtenemos los datos del fichero de datos generado segun el form de la web asi como el número de niveles
$entidad = file_get_contents($fjson);

//el número d eniveles, el últio siempre es el centro
$niveles=$num_niveles;

$json = json_decode($entidad, true);
$ipn=1;
$isn=1;
$itn=1;
$icn=1;
$chpn=1;
foreach ($json as $ent)
{
		$listadoshtml.="<div class='caja_datos'>";
		if($ipn==1){
				//$listadoshtml.='<input type="text" class="form-control filtro" nivel="filtronivel1" id="idfn1"  placeholder="Introduce datos de la enseñanza a buscar">';
					 }
		$chpn++;
		$keys=array_keys($ent);
		$listadoshtml.="<div class='row nivel1 listados cabecera1' data-type='titulo' target='n1_$ipn' valor='".$ent[$keys[0]]."'>";
		$listadoshtml.=show_cabecera($ent);
		$listadoshtml.="</div>";
		$listadoshtml.="<hr>";
		//INICIO SEGUNDO NIVEL
		$listadoshtml.="<div id='n1_$ipn' class='cajanivel' style='display:none'>";
		if(isset($ent['children1']))
		{
			$isn=1;
			foreach ($ent['children1'] as $sbent)
			{
				if($isn==1 and $niveles==2)
				{
					$listadoshtml.=$filtrocentros;	
					$listadoshtml.='<input type="text" class="form-control filtrocentros" nivel="filtronivel2"   placeholder="Filtro centros">';
				}
				if($niveles==2)
					$listadoshtml.="<div class='row nivel2 listados fichacentro' data-type='titulo' codcentro='".$sbent['ce.codcentro']."'  target='n2_$ipn"."_"."$isn'>";
				else
					$listadoshtml.="<div class='row nivel2 listados cabecera2' data-type='titulo' target='n2_$ipn"."_"."$isn' >";
				
				$listadoshtml.=show_cabecera($sbent,"nivel2");
				$listadoshtml.="</div>";
				$listadoshtml.="</hr>";
						
				//INICIO TERCER NIVEL
				$listadoshtml.="<div id='n2_$ipn"."_"."$isn' class='cajanivel' style='display:none'>";
				if(isset($sbent['children2']))
				{
					$itn=1;
					foreach ($sbent['children2'] as $tbent)
					{
						if($itn==1 and $niveles==3)
						{
							$listadoshtml.='<input type="text" class="form-control filtrocentros" nivel="filtronivel3"   placeholder="Filtro centros">';
						}
						if($niveles==3)
							$listadoshtml.="<div class='row nivel3 listados fichacentro' data-type='titulo' codcentro='".$tbent['ce.codcentro']."'  target='n3_$ipn"."_".$isn."_"."$itn' >";
						else
							$listadoshtml.="<div class='row nivel3 listados cabecera3' data-type='titulo' target='n3_$ipn"."_".$isn."_"."$itn' >";

						$listadoshtml.=show_cabecera($tbent,"nivel3");
						$listadoshtml.="</div>";
						$listadoshtml.="</hr>";

						//INICIO CUARTO NIVEL
						$listadoshtml.="<div id='n3_$ipn"."_"."$isn"."_"."$itn' class='cajanivel' style='display:none'>";
						if(isset($tbent['children3']))
						{
							$icn=1;
							foreach ($tbent['children3'] as $cbent)
							{
								if($icn==1)
								{
									$listadoshtml.='<input type="text" class="form-control filtrocentros" nivel="filtronivel4"   placeholder="Filtro centros">';
								}
								$listadoshtml.="<div class='row nivel4 listados fichacentro cabecera4' data-type='titulo' codcentro='".$cbent['ce.codcentro']."'  target='n4_$ipn"."_".$isn."_"."$itn"."_"."$icn' >";
								$listadoshtml.=show_cabecera($cbent,"nivel4");
								$listadoshtml.="</div>";
								$listadoshtml.="<div id='n4_$ipn"."_".$isn."_".$itn."_".$icn."' style='display:none'>";
								$listadoshtml.="</hr>";
								$listadoshtml.="</div>";
								$icn++;
							}
						}
						$listadoshtml.="</div>";
						$itn++;
					}
				}
				$listadoshtml.="</div>";
				$isn++;
			}
		}
	$listadoshtml.="</div>";
	$ipn++;
	$listadoshtml.="</div>";
	}
$listadoshtml.="</ul>";
print($listadoshtml);


function genera_fichacentro($ent,$id)
{
//include('../../includes/fichacentro.php');
//$fichacentro='<script> tuscentrosmap = new google.maps.Map(document.getElementById("mapcentro3_1_2"), {zoom: 14,center: uluru,  });</script>';
$file = fopen("../../includes/fichas_centros/fichaejemplo.html","w");
fwrite($file,"Hello World. Testing!");
fclose($file);
return 1;
}
function show_cabecera($ent,$nivel="nonivel")
{
	$cabecera='';
	$keys=array_keys($ent);
	foreach($keys as $key)
	{
		if($key!='filtros' and $key!='children1' and $key!='children2' and $key!='children3')
		{
			$cabecera.="<div class='col-md-3 tcabecera'>  <b>".$ent[$key]."</b> </div> ";
		}
		if($key=='filtros')
			$cabecera.="<div class='col-md-3 tcabecera' hidden>  <b>".$ent[$key]."</b> </div> ";

	}
return $cabecera."<div class='col-md-1 darrow'></div>";
}

?>
