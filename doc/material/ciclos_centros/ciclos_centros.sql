use FPDATA_DB;
SELECT concat(
	'\"codigo\":','\"',CODIGO_TITULO_ARAGON,'\"',
	',\"denominacion\":','\"',DENOMINACION_TITULO_ARAGON,'\"',
	',\"grado\":','\"',GRADO,' ','\"',
	'-n-',
	'\"codigo\":','\"',NOMBRECENTRO,'\"',
	',\"tipo\":','\"',TIPOCENTRO,'\"',
	',\"id\":','\"',IDDENOMCENTRO,'\"'
	',\"dir\":','\"',DIRECCION,'\"',
	',\"prov\":','\"',PROVINCIA,'\"',
	',\"loc\":','\"',LOCALIDAD,'\"',
	',\"tel\":','\"',TELEFONO1,'\"',
	',\"mail\":','\"',EMAIL,'\"'


	)
FROM GIR_CENTRO gc,GIR_OFERTA go,MEC_TITULO mt
Where gc.nombre=go.nombrecentro 
and go.CODIGO_CICLO_ARAGON=mt.CODIGO_TITULO_ARAGON
and curso=1
order by codigo_titulo_aragon,denominacion_titulo_aragon,grado


/*
select CODIGO_TITULO_ARAGON,DENOMINACION_TITULO_ARAGON,GRADO, NOMBRECENTRO from GIR_OFERTA go, GIR_CENTRO gc,MEC_TITULO mt where go.NOMBRECENTRO=gc.NOMBRE and mt.CODIGO_TITULO_ARAGON=go.CODIGO_CICLO_ARAGON order by CODIGO_TITULO_ARAGON, DENOMINACION_TITULO_ARAGON,GRADO\G
*/
