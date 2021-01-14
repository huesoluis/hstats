$( document ).ready(function() {
//FILTRO DE BUSQUEDA DE FILAS EN TABLAS
$('body').on('keyup', '#filtrotablas', function(e){
	console.log("FILTRO TABLAs ACTIVO");
  var expression = false;
	var value = $(this).val();
			if(value.length<=2){
			$(".fichacentro").each(function () {
				 $(this).show();
				 });
				 }
			if(value.length<3) return;

 var finder = "";
 if (value.indexOf("\"") > -1 && value.lastIndexOf("\"") > 0) {
					finder = value.substring(eval(value.indexOf("\"")) + 1, value.lastIndexOf("\""));
					expression = true;
			}
			$(this).children("td").each(function () {
					var title = $(this).text();
					if (expression) {
							if ($(this).text().toLowerCase().search(finder.toLowerCase()) == -1) {
									$(this).hide();
							} else {
									$(this).show();
							}
					} else {
							if (title.toLowerCase().indexOf(value.toLowerCase()) < 0) {
									$(this).hide();
							} else {
									$(this).show();
							}
					}
			});
	});
//FIN filtro centros
//FILTRO DE BUSQUEDA DE CENTROS
$('body').on('keyup', '.filtrocentros', function(e){
	console.log("FILTRO ACTIVO");
  var expression = false;
	var value = $(this).val();
			if(value.length<=2){
			$(".fichacentro").each(function () {
				 $(this).show();
				 });
				 }
			if(value.length<3) return;

 var finder = "";
 if (value.indexOf("\"") > -1 && value.lastIndexOf("\"") > 0) {
					finder = value.substring(eval(value.indexOf("\"")) + 1, value.lastIndexOf("\""));
					expression = true;
			}
			$(".fichacentro").each(function () {
					var title = $(this).text();
					if (expression) {
							if ($(this).text().toLowerCase().search(finder.toLowerCase()) == -1) {
									$(this).hide();
							} else {
									$(this).show();
							}
					} else {
							if (title.toLowerCase().indexOf(value.toLowerCase()) < 0) {
									$(this).hide();
							} else {
									$(this).show();
							}
					}
			});
	});
//FIN filtro centros
//FILTROS DE LISTADOS
$('body').on('click', '.botonfiltro_listados', function(e){
	var valor = $(this).text();
	console.log("PULSADO: "+valor);

	var estado = $(this).attr("estado");
	console.log("ESTADO: "+estado);

	//cambiamos estado
	if(estado.indexOf("ON")<0)
		$(this).attr("estado","ON");
	else
		$(this).attr("estado","OFF");

	//ocultamos todos
	$(".nivel1").parent().hide();

	//recorremos todos los botones de filtros, los q estén en ON se muestran el resto no
	$(".botonfiltro_listados").each(function (i,element) {
		var valorfiltro = $(this).text();
		var estadofiltro = $(element).attr("estado");
		console.log("estadofiltro");
		//si el estado del filtro esta en OFF recorremos los niveles y ocultamos el q corresponda
		if(estadofiltro.indexOf("ON")>=0)
		{
				var title = $(this).text();
			console.log("OOOON"+title+valorfiltro.length);
			console.log("OOOON"+valorfiltro+valorfiltro.length);
			$(".nivel1").each(function () {
				var title = $(this).text();
				if (title.toLowerCase().indexOf(valorfiltro.toLowerCase()) >= 0) 
				{
					$(this).parent().show();
				} 
			});
		}
/*
		else
		{
			$(".nivel1").each(function () {
				var title = $(this).text();
				if (title.toLowerCase().indexOf(valorfiltro.toLowerCase()) >= 0) 
				{
					$(this).parent().show();
				} 
			});
		}
*/
	});
	});
//FIN filtro centros

//Filtro de datos naturaleza de centros
$('body').on('click', '.botonfiltro_naturaleza', function(e){
	var valor = $(this).text();

	var estado = $(this).attr("estado");

	//cambiamos estado
	if(estado.indexOf("ON")<0)
		$(this).attr("estado","ON");
	else
		$(this).attr("estado","OFF");

	//ocultamos todos los centros por debajo del filtro
	var elcentros=$(this).parent().parent().nextAll(".fichacentro");
	elcentros.hide();
	$(".cajafiltro").hide();
	//recorremos todos los botones de filtros, los q estén en ON se muestran el resto no
	$(this).parent().children(".botonfiltro_naturaleza").each(function (i,element) {
		var valorfiltro = $(this).text();
		var estadofiltro = $(element).attr("estado");
		//si el estado del filtro esta en OFF recorremos los niveles y ocultamos el q corresponda
		if(estadofiltro.indexOf("ON")>=0)
		{
			var title = $(this).text();
			$(elcentros).each(function () 
			{
				var title = $(this).text();
				if (title.toLowerCase().indexOf(valorfiltro.toLowerCase()) >= 0) 
				{
					$(this).show();
				} 
			});
		}
	});
	});
//FIN filtro centros

//Filtro de características de centros
$('body').on('click', '.botonfiltro_carac', function(e){
	var valor = $(this).text();

	var estado = $(this).attr("estado");

	//cambiamos estado
	if(estado.indexOf("ON")<0)
		$(this).attr("estado","ON");
	else
		$(this).attr("estado","OFF");

	//ocultamos todos los centros por debajo del filtro
	var elcentros=$(this).parent().parent().nextAll(".fichacentro");
	elcentros.hide();
	//$(".cajanivel").hide();
	var vfiltros='';
	
	//recorremos todos los botones de filtros, los q estén en ON se muestran el resto no
	$(this).parent().children(".botonfiltro_carac").each(function (i,element) {
		var valorfiltro = $(this).text();
		var estadofiltro = $(element).attr("estado");
		//si el estado del filtro esta en OFF recorremos los niveles y ocultamos el q corresponda
		if(estadofiltro.indexOf("ON")>=0)
		{
			vfiltros=vfiltros+";1";
		}
		else			
			vfiltros=vfiltros+";0";
		});
		
		vfiltros=vfiltros.slice(1);
		$(elcentros).each(function () 
		{
			var filtros = $(this).children().eq(1).text();
			if(filtros.indexOf(vfiltros)!=-1)
			{
				console.log("iCOINMCIDENCIA: "+filtros);
				$(this).show();
			}
		});
	});

//Filtro de características de centros
$('body').on('click', '.botonfiltro_carac2', function(e){
	var valor = $(this).text();

	var estado = $(this).attr("estado");

	//cambiamos estado
	if(estado.indexOf("ON")<0)
		$(this).attr("estado","ON");
	else
		$(this).attr("estado","OFF");

	//ocultamos todos los centros por debajo del filtro
	var elcentros=$(this).parent().parent().nextAll(".fichacentro");
	elcentros.hide();
	//$(".cajanivel").hide();
	
	//recorremos todos los botones de filtros, los q estén en ON se muestran el resto no
	$(this).parent().children(".botonfiltro_carac").each(function (i,element) {
		var valorfiltro = $(this).text();
		var estadofiltro = $(element).attr("estado");
		//si el estado del filtro esta en OFF recorremos los niveles y ocultamos el q corresponda
		if(estadofiltro.indexOf("ON")>=0)
		{
			var title = $(this).text();
			$(elcentros).each(function () 
			{
				var filtros = $(this).children().eq(1).text();
				var comedor=filtros.split(";")[0];
				var transporte=filtros.split(";")[1];
				if(valorfiltro=='COMEDOR')
				{
					if(comedor==1)
					{
						$(this).show();
					}
					else
						$(this).hide();
				}
				if(valorfiltro=='TRANSPORTE')
				{
					if(transporte==1)
					{
						$(this).show();
					}
					else
						$(this).hide();
				}
			});
		}
	});
	});
//FIN filtro centros
});
