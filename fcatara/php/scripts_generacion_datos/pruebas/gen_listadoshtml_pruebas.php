<?php 
$listadoshtml='<div>';

//obtenemos los datos del fichero de datos generado segun el form de la web
$fjson="../../datos/datos_listados/f_enseñanza_provincia_centro_listados.json";
$entidad = file_get_contents($fjson);
//$entidad= mb_convert_encoding($entidad, 'UTF-8',mb_detect_encoding($entidad, 'UTF-8, ISO-8859-1', true));
		
$json = json_decode($entidad, true);
$ipn=1;
$isn=1;
$itn=1;
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
		$listadoshtml.="<div id='n1_$ipn' class='cajanivel' style='display:none'>";
		if(isset($ent['children']))
		{
			$isn=1;
			foreach ($ent['children'] as $sbent)
			{
				if($isn==1)
				{
					//$listadoshtml.='<input type="text" class="form-control filtro" nivel="filtronivel2" id="idfn2"  placeholder="Introduce datos del registro a buscar">';
				}
				$listadoshtml.="<div class='row nivel2 listados cabecera2' data-type='titulo' target='n2_$ipn"."_"."$isn' >";
				$listadoshtml.=show_cabecera($sbent);
				$listadoshtml.="</div>";
				$listadoshtml.="<hr>";
						
				//inicio tercer nivel
				$listadoshtml.="<div id='n2_$ipn"."_"."$isn' class='cajanivel' style='display:none'>";
				if(isset($sbent['children2']))
				{
					$itn=1;
					foreach ($sbent['children2'] as $tbent)
					{
						if($itn==1)
						{
							$listadoshtml.='<input type="text" class="form-control filtrocentros" nivel="filtronivel3"   placeholder="Introduce centro a buscar">';
						}
						$centroid="n3_$isn"."_"."$itn";
						$listadoshtml.="<div class='row nivel3 listados fichacentro cabecera3' data-type='titulo' codcentro='".$tbent['ce.codcentro']."'  target='n3_$ipn"."_".$isn."_"."$itn' >";
						$listadoshtml.=show_cabecera($tbent);
						$listadoshtml.="</div>";
						$listadoshtml.="<div id='n3_$ipn"."_".$isn."_"."$itn'  style='display:none'>";
						//$res=genera_fichacentro($tbent,$centroid);
						$listadoshtml.="</hr></div>";
						//$listadoshtml.=include('../../includes/fichacentro.php');
						//$listadoshtml.="<hr>";
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
function show_cabecera($ent)
{
	$cabecera='';
	$keys=array_keys($ent);
	foreach($keys as $key)
	{
		if($key!='children' and $key!='children2')
		{
			$cabecera.="<div class='col-md-5 tcabecera'>  <b>".$ent[$key]."</b> </div> ";
		}
	}
return $cabecera."<div class='col-md-1 darrow'></div>";
}
function show_table($ent,$nelto=0)
{
}

?>
