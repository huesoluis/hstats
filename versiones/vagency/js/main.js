$(document).ready(function(){ 
//FUNCIONES PARA MAPAS
//==========================================================================================


//FUNCIONES CLICK
//==========================================================================================

$('body').on('click', '#buscacentros', function(e){
  const uluru = { lat: 41.6575155, lng: -0.9160625 };
  const almozara = { lat: 41.6641227, lng: -0.9031237 };
  // The marker, positioned at Uluru
  const marker = new google.maps.Marker({
    position: uluru,
    map: tuscentrosmap,
  });
  const marker1 = new google.maps.Marker({
    position: almozara,
    map: tuscentrosmap,
  });

});

$('body').on('click', '.cabecera1', function(e){
	var target=$(this).attr('target');
	$("#"+target).toggle('slow');

});

$('body').on('click', '.cabecera2', function(e){
	var target=$(this).attr('target');
	$("#"+target).toggle('slow');

});
$('body').on('click', '.cabecera3', function(e){
	var target=$(this).attr('target');
	$("#"+target).toggle('slow');

});

$('body').on('click', '#id_boton_mostrarlistado_personalizado', function(e){
	$("#id_mostrar_listado").empty();
	$("#id_mostrar_listado_defecto").empty();
	$("#id_formulario_enseñanzas").toggle('slow');

});

//MOSTRAS DATOS O FICHA DEL CENTRO
$('body').on('click', '.fichacentro', function(e){
	var vtarget=$(this).attr("target");
	var vcodcentro=$(this).attr("codcentro");
		console.log("mostrando centro...");
		console.log($(this).next("div").children().length);
		console.log($(this).next("div").attr("class"));
	var estadohoja=$(this).next(".cajanivel").attr("style");
		if($(this).next(".cajanivel").children().length>=1)
		{
			console.log("existen datos"+estadohoja);
			//si el estado es oculto lo mostramos y viceversa
			if(estadohoja.indexOf("none")!=-1)
			{
				console.log("ocultando");
				$("#"+vtarget).show('slow');
			}
			else
				$("#"+vtarget).hide('slow');
			return;
		}	
	$.ajax({
            type        : 'POST',
            url         : 'scripts/ajax/get_fichacentro.php',
            data        : {target:vtarget,codcentro:vcodcentro},
            encode      : true,
	     contentType			: "application/x-www-form-urlencoded;charset=utf-8",
		})
      .done(function(data) {
			console.log("Añadiendo datos...");
			$("#"+vtarget).append(data);
			$("#"+vtarget).show('slow');
		return;		
		})
	 	.fail(function(request, status, error) {
			console.log(error);
	    });
});


$('.fila_filtros').hide();

$('body').on('click', '.boton_filtro', function(e){
console.log("boton filtro pulsado");
$(this).parent().parent().next().toggle();

});

$('body').on('click', '.botonfiltro_listados,.botonfiltro_naturaleza,.botonfiltro_carac', function(e){

$(this).toggleClass('bactive');

});

$('body').on('click', '.cabecera1', function(e){
	var target=$(this).find('.col-md-1').first();
	target.toggleClass('uarrow darrow');
});
$('body').on('click', '#interior_graficos_evolutivos', function(e){
	e.preventDefault();
	e.stopPropagation();
	console.log("click caja interior: "+$(this).attr("id"));
	if( $("#hijo_grafico_evolutivo_enseñanzas").children().length>0)
		 $("#hijo_grafico_evolutivo_enseñanzas").toggle();
	else
		carga_graficos_evolutivos('enseñanzas');
});
$('body').on('click', '#evolutivo_comarcas', function(e){
	e.preventDefault();
	e.stopPropagation();
		 $("#opcionescomarcas").toggle();
});

$('body').on('click', '.caja_graficos', function(e){
	e.stopPropagation();
	var idtarget=$(this).attr("target");
	console.log("click caja graficos: "+$(this).attr("id"));
	console.log(idtarget);
	$("#"+idtarget).toggle("slow");
});

$('body').on('change', '#elige_comparativos', function(e){
	e.stopPropagation();
	var idtarget=$(this).attr("target");
	console.log("Eligiendo comparativos:  "+$(this).find(":selected").text());
	var enseñanza=$(this).find(":selected").text();
	if(enseñanza.indexOf("Pública")!=-1)
	{
		$('#grafico_ep_1').empty();
		var vfep="./scripts/datos/datos_graficos/grafico_evo_con_pub_ep.csv";
		show_grafico_evol(vfep,'grafico_ep_1');
		$('#grafico_eso_1').empty();
		var vfep="./scripts/datos/datos_graficos/grafico_evo_con_pub_eso.csv";
		show_grafico_evol(vfep,'grafico_eso_1');
		$('#grafico_bach_1').empty();
		var vfep="./scripts/datos/datos_graficos/grafico_evo_con_pub_bach.csv";
		show_grafico_evol(vfep,'grafico_bach_1');
	}
	else if(enseñanza.indexOf("Padrón")!=-1)
	{
		$('#grafico_ep_1').empty();
		var vfile="./scripts/datos/datos_graficos/grafico_evo_padron_nalumnos_ep.csv";
		show_grafico_evol(vfile,'grafico_ep_1');
		$('#grafico_ep_1').prev().prev('div').text("Padrón - Matrícula");
		
		$('#grafico_eso_1').empty();
		var vfile="./scripts/datos/datos_graficos/grafico_evo_padron_nalumnos_eso.csv";
		show_grafico_evol(vfile,'grafico_eso_1');
		$('#grafico_eso_1').prev().prev('div').text("Padrón - Matrícula");
		
		var vfile="./scripts/datos/datos_graficos/grafico_evo_padron_nalumnos_bach.csv";
		show_grafico_evol(vfile,'grafico_bach_1');
		console.log("Elto mod: "+$('#grafico_bach_1').prev().prev('div').text());
		$('#grafico_bach_1').prev().prev('div').text("Padrón - Matrícula");
	}
	else if(enseñanza.indexOf("Ratio")!=-1)
	{
		$('#grafico_ep_1').empty();
		var vfile="./scripts/datos/datos_graficos/grafico_evo_prc_padron_ep.csv";
		show_grafico_evol(vfile,'grafico_ep_1');
		$('#grafico_ep_1').prev().prev('div').text("Ratio pública/privada - Padrón");
		
		$('#grafico_eso_1').empty();
		var vfile="./scripts/datos/datos_graficos/grafico_evo_prc_padron_eso.csv";
		show_grafico_evol(vfile,'grafico_eso_1');
		$('#grafico_eso_1').prev().prev('div').text("Ratio pública/privada - Padrón");
		
		$('#grafico_bach_1').empty();
		var vfile="./scripts/datos/datos_graficos/grafico_evo_prc_padron_bach.csv";
		show_grafico_evol(vfile,'grafico_bach_1');
		$('#grafico_bach_1').prev().prev('div').text("Ratio pública/privada - Padrón");
	}
});


//FUNCION PARA GENERAR LOS GRAFICOS/LISTADOS/TABLAS
//==========================================================================================
//listado por defecto
$('body').on('click', '#id_boton_genlistado_defecto', function(e){
	$.ajax({
            type        : 'POST',
            url         : 'scripts/php/scripts_generacion_datos/gen_datos_web_listadostablas.php',
            data        : {tipoconsulta:'listados_defecto'},
            encode      : true,
	     contentType			: "application/x-www-form-urlencoded;charset=utf-8",
		})
      .done(function(data) {
		if($("#id_mostrar_listado_defecto").children().length>0)
			$("#id_mostrar_listado_defecto").toggle();
		else
			$("#id_mostrar_listado_defecto").append(data);
		return;		
		})
	 	.fail(function(request, status, error) {
			console.log(error);
			console.log(request);
	    });
});
$('#id_boton_genlistado_personalizado').click(function(event) 
{
	var script='scripts/php/scripts_generacion_datos/gen_datos_web_listadostablas.php';
	var tipo='listados';
	var fdata = 
	{
		'd1'		: $( "#dlistados1 option:selected" ).val(),
		'd2'		: $( "#dlistados2 option:selected" ).val(),
		'd3'		: $( "#dlistados3 option:selected" ).val(),
		'tipoconsulta'	: $("#tipoconsulta").val()
	};
$.ajax(
{
	type        : 'POST',
	url         : script,
	data        : fdata,
	contentType			: "application/x-www-form-urlencoded;charset=utf-8",
})
.done(function(data) 
{
	if(tipo=='listados')
	{
		if($("#id_mostrar_listado_personalizado").children().length>0)
			$("#id_mostrar_listado_personalizado").empty();
		else
			$("#id_mostrar_listado_personalizado").append(data);
	return;		
	}
})
.fail(function(request, status, error) 
{
	console.log(error);
});
		event.preventDefault();
});

$('#boton_gentablas').click(function(event) 
{
var script="gen_datos_web_listadostablas.php";
var path='scripts/php/scripts_generacion_datos/'+script;
var tipo='tablas';
var fdata = {
	'd1'		: $( "#dtablas1 option:selected" ).val(),
	'd2'		: $( "#dtablas2 option:selected" ).val(),
	'd3'		: $( "#dtablas3 option:selected" ).val(),
	'tipoconsulta'	: $("#tipoconsulta_tablas").val()
        };
$.ajax({
            type        : 'POST',
            url         : path,
            data        : fdata
		})
    .done(function(data) 
		{
			$("#mostrar_tabla").empty();
			$("#mostrar_tabla").append(data);
			return;		
		})
	 	.fail(function(request, status, error) {
		console.log(error);
	    });
	        event.preventDefault();
});
});
