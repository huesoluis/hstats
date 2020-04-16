/*Consulta sin formato
Select 
cp.CODIGO_CERTIFICADO,cp.DENOMINACION,cprof.ID_NIVEL_CUALIFICACION,
cprof.CODIGO_CUALIFICACION, cprof.DENOMINACION,
uc.CODIGO_UNIDAD, uc.DENOMINACION,
mf.CODIGO_MODULO_FORM, mf.DENOMINACION

from INCUAL_CERTIFICADO_PROF cp, INCUAL_CUALIFICACION_PROF cprof, 
INCUAL_UNIDAD_COMPETENCIA uc, INCUAL_CUALIFICACION_UNIDAD cuun,   INCUAL_MODULO_FORMATIVO mf
where cp.CODIGO_CUALIFICACIONREF=cprof.CODIGO_CUALIFICACION
and uc.CODIGO_UNIDAD=cuun.CODIGO_UNIDAD_COMPETENCIA
and cuun.CODIGO_CUALIFICACION=cprof.CODIGO_CUALIFICACION
and mf.CODIGO_UNIDAD_COMPETENCIA=uc.CODIGO_UNIDAD
;

*/

use FPDATA_DB;
SELECT concat(
	'\"codigo\":','\"',cp.CODIGO_FAMILIA,'\"',
	'-n-',
	'\"codigo\":','\"',cp.CODIGO_CUALIFICACION,'\"',',\"den_cual\":',"\"", upper(replace(cp.DENOMINACION,'"','')),"\"",
	'-n-',
	'\"codigo\":','\"',uc.CODIGO_UNIDAD,'\"',',\"denominacion\":','\"',replace(uc.DENOMINACION,'"',''),'\"') 
FROM SIGAD_FAMILIA sf,INCUAL_CUALIFICACION_PROF cp, INCUAL_CUALIFICACION_UNIDAD cu, INCUAL_UNIDAD_COMPETENCIA uc
Where cp.CODIGO_CUALIFICACION=cu.CODIGO_CUALIFICACION
and uc.CODIGO_UNIDAD=cu.CODIGO_UNIDAD_COMPETENCIA
and sf.CODIGO_FAMILIA=cp.CODIGO_FAMILIA