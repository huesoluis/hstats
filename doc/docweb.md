# DOCUMENTACIÓN

Toda la info mostrada se condiere bajo el directorio de versiones/vagency

## ESTRUCTURA DIRECTORIOS


Layout
	.
	├── css						ficheros de estilo
	├── datosjson			datos a usar en páginas
	├── doc						documentación: 
											fichero guion: 		cuestiones particulares y temas pendientes
											fichero docweb.md:	este documento
	├── includes			'chunks' de html/php para acelaerar la carga
	├── index.php			principal
	├── js						jscripts
	├── scripts				ficheros para carga y generacion de datos
	├── tmp						dir temporal
	└── tools					herramientas complementarioas

	
PAGINA 0:	PORTADA con menu incluyendo las cajas, es una SPA

FOTO+3 CAJAS= INFO ENSEÑANZAS, INFO CENTROS, DATOS MATRÍCULA, TERRITORIO (zona escolar, comarca, municipio)



Entidades/dimensiones FUERTES (llevan datos asociados):


CENTRO
	Direccion
	Correo
	Teléfono
	Web
	Enseñanzas q imparte
	Número profesores
	Tiempos escolares?
	Zona?											
	Tipo de Bachillerato		Mila
	Comedor si/no						Mila
	Bilingüe si/no					Mila


-------------------------------------------------------------------
PAGINA 1:	CAJA INFO ENSEÑANZAS
==========================================

	COMENTARIOS:
	En principio trabajamos curso 2019/2020
	Mostramos datos de forma jerárquica según dimensiones y filtros.
	Por ejemplo:
		
		"Listado de enseñanza -> centros "
		"Listado de enseñanza -> provincias -> centros "
		"Listado de enseñanza -> provincias -> localidades -> centros"
		"Listado de enseñanza -> provincias -> tipocentros -> centros "
		"Listado de enseñanza -> tipocentros -> provincias -> localidades -> centros"
		"Listado de enseñanza -> tipocentros -> localidades -> centros"
		"Listado de enseñanza -> tipocentros -> centros"

	
	
	MENU PPAL

	DATOS GENERALES

		DIMENSIONES
			
			enseñanza - FIJA - 
			centro 				
			tipo centro
			provincia
			municipio
			comarca
			
		DESPLEGABLE FILTROS - Se generan con jquery
		
		
			Filtros:
			
				principal:	se elige tipo de enseñanza. Necesario para mostrar los filtros sec. y las dimensiones
				
				
				Si es normal:
					secundarios:
									centro:			Solo se elige uno o todos
									género:			M, H
									provincia:		Z, H, T
									curso:			1, 2, 3, 4
									dirección (se introduce la dirección y aparecen las enseñanzas más ceranas)
										subfiltro:	distancia
									naturaleza:		públic, privado

				Si es FP:
				
					secundarios:
					
									género:						H, M
									provincia:					Z, H, T
									ciclos:						...
										subfiltro curso:		1, 2, 3
									dirección (se introduce la dirección y aparecen las enseñanzas más ceranas)
										subfiltro distancia:	filtro continuo entre 0 y 50km	
									naturaleza:					público, privado
									edad:						0-100años
									
									
									
		DATOS:
		
			Datos de los centros:	nombre, dirección, web
			Datos de los ciclos:	nombre, codigo, nota de corte (según centro y curso),

PAGINA 1:	CAJA INFO MATRICULA
==========================================

Dimensiones

	Verticales:

		Centro
		Enseñanza
		curso	
		comarca

	Horizontal:

		Provincia
		tipocentro
	
	Búsqueda avanzada

		Enseñanza
		Provincia
		TipoCentro
		Centro
		Comarca
		Municipio



## ESTRUCTURA DIRECTORIO SCRIPTS

scripts/
├── ajax
│   └── get_fichacentro.php
├── datos
│   ├── datos_entrada
│   │   ├── datos_catalanaragones
│   │   │   ├── Copia de Aragonés y catalán_Revisado catalán.xlsx
│   │   │   └── Copia de aragonés y  catalán.xlsx
│   │   ├── datos_fp
│   │   │   ├── datos_historicofct_csv
│   │   │   │   ├── listado_fcts_curso2017_18.csv
│   │   │   │   ├── listado_fcts_curso2018_19_16junio2020_pre.csv
│   │   │   │   ├── listado_fcts_curso2018_19.csv
│   │   │   │   ├── listado_fcts_curso2019_20.csv
│   │   │   │   ├── listado_seguimientosfcts_cursoantes2017.csv
│   │   │   │   ├── listado_seguimientosfcts_cursoantes2017_v2.csv
│   │   │   │   └── listado_seguimientosfcts_cursoantes2017_v3.csv
│   │   │   ├── mat_alumnosfp2019.csv
│   │   │   └── mat_alumnosfp2019_pruebas.csv
│   │   ├── datos_globales
│   │   │   ├── base_centros.csv
│   │   │   ├── base_enseñanzas_agrupadas.csv
│   │   │   ├── base_zonas_comarcas.csv
│   │   │   ├── centros_tel_correo.csv
│   │   │   ├── extranjeros_centro.csv
│   │   │   ├── matriculacompleta2017.csv
│   │   │   ├── matricula_total2017.csv
│   │   │   ├── matricula_total2018.csv
│   │   │   ├── matricula_total2019.csv
│   │   │   ├── matricula_total.csv
│   │   │   ├── publicos_bilingues.csv
│   │   │   ├── servicios_complementarios.csv
│   │   │   └── tiempos_escolares.csv
│   │   ├── datos_ministerio
│   │   │   ├── ResultadosAcademicos2018-19
│   │   │   │   ├── 1 - Resumen valores.xlsx
│   │   │   │   ├── 2 - Rég Gen valores.xlsx
│   │   │   │   ├── ResultadosEdu_Adultos_val.xlsx
│   │   │   │   └── ResultadosRE18-19_val.xlsx
│   │   │   └── ResultadosAcademicos2018-19.rar
│   │   └── datos_padron
│   │       ├── ine_padronporedades2018.csv
│   │       ├── ine_padronporedades2019.csv
│   │       ├── ine_padronporedades.csv
│   │       └── ine_padronporedades.txt
│   ├── datos_graficos
│   │   ├── csvprueba.csv
│   │   ├── evolutivos
│   │   │   └── comarcas
│   │   │       ├── grafico_evolutivo_comarca_Albarracín.csv
│   │   │       ├── grafico_evolutivo_comarca_Alto Gallego.csv
│   │   │       ├── grafico_evolutivo_comarca_Andorra - Sierra de Arcos.csv
│   │   │       ├── grafico_evolutivo_comarca_Aranda.csv
│   │   │       ├── grafico_evolutivo_comarca_Bajo Aragón.csv
│   │   │       ├── grafico_evolutivo_comarca_Bajo Cinca.csv
│   │   │       ├── grafico_evolutivo_comarca_Bajo Martín.csv
│   │   │       ├── grafico_evolutivo_comarca_Calatayud.csv
│   │   │       ├── grafico_evolutivo_comarca_Campo de Belchite.csv
│   │   │       ├── grafico_evolutivo_comarca_Campo de Borja.csv
│   │   │       ├── grafico_evolutivo_comarca_Campo de Cariñena.csv
│   │   │       ├── grafico_evolutivo_comarca_Campo de Daroca.csv
│   │   │       ├── grafico_evolutivo_comarca_Caspe.csv
│   │   │       ├── grafico_evolutivo_comarca_Cinca Medio.csv
│   │   │       ├── grafico_evolutivo_comarca_Cinco Villas.csv
│   │   │       ├── grafico_evolutivo_comarca_Cuencas mineras.csv
│   │   │       ├── grafico_evolutivo_comarca_Gúdar - Javalambre.csv
│   │   │       ├── grafico_evolutivo_comarca_Hoya de Huesca.csv
│   │   │       ├── grafico_evolutivo_comarca_Jacetania.csv
│   │   │       ├── grafico_evolutivo_comarca_Jiloca.csv
│   │   │       ├── grafico_evolutivo_comarca_La Litera.csv
│   │   │       ├── grafico_evolutivo_comarca_Maestrazgo.csv
│   │   │       ├── grafico_evolutivo_comarca_Matarraña.csv
│   │   │       ├── grafico_evolutivo_comarca_Monegros.csv
│   │   │       ├── grafico_evolutivo_comarca_No Comarca.csv
│   │   │       ├── grafico_evolutivo_comarca_Ribagorza.csv
│   │   │       ├── grafico_evolutivo_comarca_Ribera Alta del Ebro.csv
│   │   │       ├── grafico_evolutivo_comarca_Ribera Baja del Ebro.csv
│   │   │       ├── grafico_evolutivo_comarca_Sobrarbe.csv
│   │   │       ├── grafico_evolutivo_comarca_Somontano de Barbastro.csv
│   │   │       ├── grafico_evolutivo_comarca_Tarazona y el Moncayo.csv
│   │   │       ├── grafico_evolutivo_comarca_Teruel.csv
│   │   │       ├── grafico_evolutivo_comarca_Valdejalón.csv
│   │   │       └── grafico_evolutivo_comarca_Zaragoza.csv
│   │   ├── grafico_evo_con_pub_BACH
│   │   ├── grafico_evo_con_pub_bach.csv
│   │   ├── grafico_evo_con_pub_BACH.csv
│   │   ├── grafico_evo_con_pub_EI
│   │   ├── grafico_evo_con_pub_ei.csv
│   │   ├── grafico_evo_con_pub_EI.csv
│   │   ├── grafico_evo_con_pub_EP
│   │   ├── grafico_evo_con_pub_ep.csv
│   │   ├── grafico_evo_con_pub_EP.csv
│   │   ├── grafico_evo_con_pub_ESO
│   │   ├── grafico_evo_con_pub_eso.csv
│   │   ├── grafico_evo_con_pub_ESO.csv
│   │   ├── grafico_evolutivo_enseñanzas1.csv
│   │   ├── grafico_evolutivo_enseñanzas.csv
│   │   ├── grafico_evo_padron_nalumnos_BACH
│   │   ├── grafico_evo_padron_nalumnos_bach.csv
│   │   ├── grafico_evo_padron_nalumnos_BACH.csv
│   │   ├── grafico_evo_padron_nalumnos_EI
│   │   ├── grafico_evo_padron_nalumnos_ei.csv
│   │   ├── grafico_evo_padron_nalumnos_EI.csv
│   │   ├── grafico_evo_padron_nalumnos_EP
│   │   ├── grafico_evo_padron_nalumnos_ep.csv
│   │   ├── grafico_evo_padron_nalumnos_EP.csv
│   │   ├── grafico_evo_padron_nalumnos_ESO
│   │   ├── grafico_evo_padron_nalumnos_eso.csv
│   │   ├── grafico_evo_padron_nalumnos_ESO.csv
│   │   ├── grafico_evo_prc_padron_bach.csv
│   │   ├── grafico_evo_prc_padron_ei.csv
│   │   ├── grafico_evo_prc_padron_ep.csv
│   │   ├── grafico_evo_prc_padron_eso.csv
│   │   ├── grafico_gen_centros_pct.csv
│   │   └── grafico_gen_comarcas_pct.csv
│   ├── datos_listados
│   │   ├── f_enseñanza_centro_listados.csv
│   │   ├── f_enseñanza_centro_listados.json
│   │   ├── f_enseñanza_centro_listados.tmp
│   │   ├── f_enseñanza_provincia_centro_listados.csv
│   │   ├── f_enseñanza_provincia_centro_listados.json
│   │   ├── f_enseñanza_provincia_centro_listados.tmp
│   │   ├── f_naturaleza_enseñanza_centro_listados.csv
│   │   ├── f_naturaleza_enseñanza_centro_listados.json
│   │   ├── f_naturaleza_enseñanza_centro_listados.tmp
│   │   ├── f_naturaleza_provincia_enseñanza_centro_listados.csv
│   │   ├── f_naturaleza_provincia_enseñanza_centro_listados.json
│   │   └── f_naturaleza_provincia_enseñanza_centro_listados.tmp
│   └── datos_tablas
│       ├── f_comarca_naturaleza_enseñanza_tablas.html
│       ├── f_comarca_tablas.html
│       ├── f_enseñanza_naturaleza_tablas.html
│       ├── f_enseñanza_tablas.html
│       ├── f_localidad_naturaleza_enseñanza_tablas.html
│       ├── f_municipio_tablas.html
│       ├── f_naturaleza_enseñanza_tablas.html
│       ├── f_naturaleza_tablas.html
│       ├── f_provincia_enseñanza_naturaleza_tablas.html
│       ├── f_provincia_enseñanza_tablas.html
│       ├── f_provincia_naturaleza_enseñanza_tablas.html
│       ├── f_provincia_naturaleza_tablas.html
│       ├── f_provincia_tablas.html
│       └── f_zona_naturaleza_enseñanza_tablas.html
└── php
    ├── clases
    │   ├── ACCESO0.php
    │   ├── ACCESO.php
    │   ├── AJAXDATA.php
    │   ├── CSVS0.php
    │   ├── CSVSGRAFICOS.php
    │   ├── CSVS.php
    │   ├── tablas.php
    │   └── TOOLS.php
    ├── comprobacion_json.php
    ├── config_dim
    │   ├── brutos_csv
    │   │   ├── mat_alumnosfp2019.csv
    │   │   ├── oferta0.csv
    │   │   ├── oferta.csv
    │   │   └── oferta.json
    │   ├── dim_evolutivos.php
    │   ├── dim_graficos.php
    │   ├── dim_listados.php
    │   ├── dim_tablas.php
    │   ├── fmatricula_centros_enseñanzas1.csv
    │   └── fmatricula_centros_enseñanzas.csv
    ├── config.php
    ├── log
    │   └── weblog
    ├── scripts_carga_datos
    │   ├── cicosconcomas
    │   ├── load_datos.php
    │   ├── load_stats.php
    │   ├── load_tabla_sinee_enseñanzas.php
    │   ├── out
    │   ├── out2017
    │   ├── out2018
    │   └── out2019
    ├── scripts_generacion_datos
    │   ├── comprobacion_json.php
    │   ├── gen_datos_web_graficos.php
    │   ├── gen_datos_web_listadostablas.php
    │   ├── gen_fichacentro.php
    │   ├── gen_json_cuatroniveles.php
    │   ├── gen_json_cuatroniveles.py
    │   ├── gen_json_dosniveles.php
    │   ├── gen_json_dosniveles.py
    │   ├── gen_json_tresniveles.php
    │   ├── gen_json_tresniveles.py
    │   ├── gen_json_unnivel.php
    │   ├── gen_json_unnivel.py
    │   ├── gen_listadoshtml.php
    │   ├── log
    │   │   └── weblog
    │   └── tmp
    │       ├── gen_datosweb_listados_tablas.php
    │       ├── gen_datos_web_tablas.php
    │       ├── gen_listados0.php
    │       ├── gen_listadoshtml0.php
    │       ├── gen_listadoshtml.php
    │       ├── gen_listados.php
    │       ├── out
    │       ├── pruebas
    │       │   └── gen_listadoshtml_pruebas.php
    │       └── pruebas.txt
    └── tmp
        └── temporal

26 directories, 180 files
