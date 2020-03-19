<?php 
// include configuration
require_once(dirname(__FILE__) . '/config.php');
//$_POST=array();
$_POST=Array
(
    "d1" =>0,
    "d2" => 0,
    "d3" => 0
);

    if (isset($_SERVER["REQUEST_METHOD"]))
	{
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
	http_response_code(200);
        print_r($_POST);
/*
$_POST=Array
(
    "d1" => "provincia",
    "d2" => "genero",
//    "dim3" => "grado2",
    "f10" => "ZARAGOZA",
    "f11" => "HUESCA",
    "f12" => "TERUEL",
    "f20" => "h"
);
*/
	}
	}
	$dal = new ACCESO($_POST);
 	$dim=$dal->check_dimension(3);
	if($dim==-1) {echo "NODATA";exit();}
	$csvs=$dal->gen_csvs($dim);
	
	

/*

$sql_base=
"
SELECT t1.cc as Grado, t1.nal/(t1.nal+t2.nal)*100 as '% Mujeres', t2.nal/(t1.nal+t2.nal)*100 as '% Hombres'
from
(SELECT count(*) as nal, grado cc,sf.FAMILIA familia from GIR_MATRICULA gm,GIR_CENTRO gc,SIGAD_FAMILIA sf,INCUAL_TITULO it where sf.CODIGO_FAMILIA=it.CODIGO_FAMILIA and gm.codigo_ciclo=it.CODIGO_TITULO_ARAGON and gm.cod_centro=gc.iddenomcentro  and sf.FAMILIA like '%parametro1%' and fecha='9042018' and sexo='M' group by grado,familia) as t1 
LEFT JOIN
(SELECT count(*) as nal, grado cc,sf.FAMILIA familia from GIR_MATRICULA gm,GIR_CENTRO gc,SIGAD_FAMILIA sf,INCUAL_TITULO it where sf.CODIGO_FAMILIA=it.CODIGO_FAMILIA and gm.codigo_ciclo=it.CODIGO_TITULO_ARAGON and gm.cod_centro=gc.iddenomcentro  and sf.FAMILIA like '%parametro1%' and fecha='9042018' and sexo='H' group by grado,familia) as t2 
ON t1.cc=t2.cc
";
//para 2 dimensiones se tienen dos subconsultas
//el select incluye el dim 1 y tantos campos como subconsultas, o como valores tiene la dimensión 2

$sql_2d=$dal->gen_dim2()

SELECT dim1,t1.nal,t2.nal,t3.nal
from
(SELECT count(*) nal,dim1   from GIR_MATRICULA where dim2=dim2v1 group by dim1) t1 
LEFT JOIN
(SELECT count(*) nal,dim1  from GIR_MATRICULA where dim2=dim2v2 group by dim1)  t2
ON t1.dim1=t2.dim2
LEFT JOIN
(SELECT count(*) nal,dim1  from GIR_MATRICULA where dim2=dim2v3 group by dim1)  t3;
ON t2.dim1=t3.dim2

$array_sql_3d=$dal->gen_dim3()

$valores_d3=$dal->get_d3values()
// para 3 dimensiones hay q genrar lo mismo pero iterando sobre la dim3 añadiendo el filtro
for i in vdim3
SELECT dim1,t1.nal,t2.nal,t3.nal
from
(SELECT count(*) nal,dim1   from GIR_MATRICULA where dim2=dim2v1 and dim3=vdim3 group by dim1) t1 
LEFT JOIN
(SELECT count(*) nal,dim1  from GIR_MATRICULA where dim2=dim2v2 and dim3=vdim3 group by dim1)  t2
ON t1.dim1=t2.dim2
LEFT JOIN
(SELECT count(*) nal,dim1  from GIR_MATRICULA where dim2=dim2v3 and dim3=vdim3 group by dim1)  t3;
ON t2.dim1=t3.dim2


$sql_base_matsexo=
"
SELECT t1.cc as 'Grado',t1.nal as 'MUJERES', t2.nal as 'HOMBRES'
from
(SELECT count(*) as nal, codigo_ciclo cc,sf.FAMILIA familia from GIR_MATRICULA gm,GIR_CENTRO gc,SIGAD_FAMILIA sf,INCUAL_TITULO it where sf.CODIGO_FAMILIA=it.CODIGO_FAMILIA and gm.codigo_ciclo=it.CODIGO_TITULO_ARAGON and gm.cod_centro=gc.iddenomcentro  and sf.FAMILIA like '%parametro1%' and fecha='9042018' and sexo='M' group by cc,familia) as t1 
LEFT JOIN
(SELECT count(*) as nal, codigo_ciclo cc ,sf.FAMILIA familia from GIR_MATRICULA gm,GIR_CENTRO gc,SIGAD_FAMILIA sf,INCUAL_TITULO it where sf.CODIGO_FAMILIA=it.CODIGO_FAMILIA and gm.codigo_ciclo=it.CODIGO_TITULO_ARAGON and gm.cod_centro=gc.iddenomcentro  and sf.FAMILIA like '%parametro1%' and fecha='9042018' and sexo='H' group by cc,familia) as t2 
ON t1.cc=t2.cc
";

$sql_base0=
"

SELECT t1.gz as 'Grado',t1.nal as 'Zaragoza', t2.nal as 'Huesca', t3.nal as 'Teruel'
from
(SELECT count(*) as nal, grado gz,sf.FAMILIA familia from GIR_MATRICULA gm,GIR_CENTRO gc,SIGAD_FAMILIA sf,INCUAL_TITULO it where sf.CODIGO_FAMILIA=it.CODIGO_FAMILIA and gm.codigo_ciclo=it.CODIGO_TITULO_ARAGON and gm.num_matriculados=gc.iddenomcentro and gc.provincia='Zaragoza' and sf.FAMILIA like '%parametro1%' group by grado,familia) as t1 
LEFT JOIN
(SELECT count(*) as nal, grado gh, sf.FAMILIA familia from GIR_MATRICULA gm,GIR_CENTRO gc,SIGAD_FAMILIA sf,INCUAL_TITULO it where sf.CODIGO_FAMILIA=it.CODIGO_FAMILIA and gm.codigo_ciclo=it.CODIGO_TITULO_ARAGON and gm.num_matriculados=gc.iddenomcentro and gc.provincia='Huesca' and sf.FAMILIA like '%parametro1%'group by grado,familia) as t2 
ON t1.gz=t2.gh 
LEFT JOIN
(SELECT count(*) as nal, grado gt, sf.FAMILIA familia from GIR_MATRICULA gm,GIR_CENTRO gc,SIGAD_FAMILIA sf,INCUAL_TITULO it where sf.CODIGO_FAMILIA=it.CODIGO_FAMILIA and gm.codigo_ciclo=it.CODIGO_TITULO_ARAGON and gm.num_matriculados=gc.iddenomcentro and gc.provincia='Teruel' and sf.FAMILIA like '%parametro1%'group by grado,familia) as t3
ON t1.gz=t3.gt


";




$dato='matricula';
$filtro='familia';


$csvs=new CSVS($filtro,$sql_base,$dal,$dato);
$sql_fam="SELECT FAMILIA from SIGAD_FAMILIA"; 
// cycle through the makes
//foreach ($makes as $make){
  $familias = $dal->query($dal->c,$sql_fam);
   // cycle through results
  foreach ($familias as $fam){
	//generamos un fichero csv con los datos de cada familia 
	$f=$fam->FAMILIA;
	//print($f);
	$csvs->gen_csv($f,$sql_base);
    	//break;
	}
*/

?>

