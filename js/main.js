$( document ).ready(function() {

//nada mas cargar el doc ocultamos la seccion de listados
$("[id*=fila]").hide();
$("#filatablas").show();
$("[class*='class_']").hide();

$(".class_tablas").show();
$("#tipoinfo").attr('value','tablas');

//ACCIONES MENU LATERAL
//$('body').on('click', '.menu_graficos, .menu_listados,.menu_tablas', function(e)
$('body').on('click', '.nav-link', function(e)
{
	var clase=$(this).attr("data-menu");
	var categoria=clase.replace('menu_','');
	var filamostrar="fila"+categoria;
	var seccionmostrar="class_"+categoria;
	
	$("[id*=fila]").hide();
	$("[class*='class_']").hide();
	
	$("#"+filamostrar).show();
	$("."+seccionmostrar).show();
	
	$("#tipoinfo").text(categoria.toUpperCase());
	$("#tipoinfo").attr('value',categoria);
	
	$(".clistados").show();
	$(".cgraficos").hide();
}
);

$('body').on('click', '#gmatricula', function(e)
{
	$("[id*=fila]").hide();
	$("#filagraficos").show();
	
	$("#tipoinfo").text("GRÁFICOS");
	$("#tipoinfo").attr('value','graficos');
	
	$("[class*='class_']").hide();
	$(".class_graficos").show();
}
);

//FUNCION PARA GENERAR LOS GRAFICOS/LISTADOS
$('#formgeneral').submit(function(event) {
        var formData_graficos = {
	    'd0'		: $( "#d0 option:selected" ).text(),
	    'd1'		: $( "#d1 option:selected" ).text(),
	    'd2'		: $( "#d2 option:selected" ).text()
        };
        var formData_listados = {
	    'd0'		: $( "#dl0 option:selected" ).text(),
	    'd1'		: $( "#dl1 option:selected" ).text(),
	    'd2'		: $( "#dl2 option:selected" ).text()
        };
        var formData_tablas = {
	    'd0'		: $( "#d20 option:selected" ).text(),
	    'd1'		: $( "#d21 option:selected" ).text(),
	    'd2'		: $( "#d22 option:selected" ).text()
        };
	
	//obtenemos el tipo de info en forma de graficos o listados
	var tipo= $("#tipoinfo").attr('value');
	var script="pr_gen_graficos.php";

	var path='';
	var fdata=formData_graficos;
	if(tipo=='listados')
		{
		script="pr_gen_listados.php";
		fdata=formData_listados;
		}
	else if(tipo=='tablas')
		{
		script="pr_gen_tablas.php";
		fdata=formData_tablas;
		}
	path='scripts/php/'+script;
	$.ajax({
            type        : 'POST',
            url         : path,
            data        : fdata,
            encode      : true,
	    contentType: "application/x-www-form-urlencoded;charset=utf-8",
		})
      .done(function(data) {
		console.log("tipo: "+tipo);
		if(tipo=='listados')
		{
		$("#big-list").empty();
		$("#big-list").append(data);
		return;		
		}
		else if(tipo=='tablas')
		{
		$("#big-tabla").empty();
		$("#big-tabla").append(data);
		return;		
		}
		else
		{
			console.log("GENERANDO GRAFICOS");
			console.log(data);
			var fcsv = "scripts/php/"+data;	
			adato=data.split(":");
			if(adato[0]!=3)
			{
				atitulo=adato[1].split("_");
				console.log("TITULO: "+atitulo);
				var titulo="alumnos por "+atitulo[2]+ "y "+atitulo[3];
				console.log("DIMENSION: "+adato);
				$(".smallgraph").remove();
				$("#zgraficos").show();
				show_graph(adato[1],'#big-gra',titulo);
			}
			else if(adato[0]==3)
			{
				console.log("DIMENSION: "+adato[0]);
				ficheros=adato[1].split("#");
				ficheros.shift();
				$("#graficos3").remove();
				$("#zgraficos").show();
				console.log("generando grafico principal: "+ficheros[1]);
				var nombregrafico=ficheros[0].split('_');
				nombregrafico=nombregrafico[4].replace('.csv','');
				show_graph(ficheros[0],'#big-gra',nombregrafico);
				ficheros.shift();
				$("#graficos3").remove();
				//graficos pequeños
				var html='';
				$('.big-gra').hide();
				console.log(ficheros.length);
				var nficheros=ficheros.length;
				for (k = 0,m=1; k < nficheros; k++,m++) 
				{
					console.log(k);
					p=k-1;
					if(k==0 || k%3==0) html +="<div class='row smallgraph' id='graficos3'>";
					html +="<div class='col-md-4'><div class='sma-gra' id='sma-gra"+k+"'></div></div>";
					if(m%3==0) html +="</div>";
				}

				if(ficheros.length<4 || ficheros.length%4!=0) html+='</div>';
				$(html).insertAfter($("#zgraficos"));
				//$("#zgraficos").hide();
			
				$('.sma-gra').each(function(i){
					var nombregrafico=ficheros[i].split('_');
					nombregrafico=nombregrafico[4].replace('.csv','');
					show_graph(ficheros[i],'#sma-gra'+i,nombregrafico);

					});
			}
		}
		})
	 	.fail(function(request, status, error) {
		console.log(error);
	    });
	        event.preventDefault();
});

var fdgrado='js/dimensiones/grados.json';
var fdprov='js/dimensiones/provincias.json';
var fdgenero='js/dimensiones/generos.json';
console.log(fdgenero);
var fichero="nofile";

//APARTADO GENERACION AUTOMATICA
$.ajax ({
    method : 'POST',
    url : 'scripts/ajax/mostrar_dim.php',
    data    : {},
    cache : false,
    processData: false,
    contentType: false,
    success : function ( data, textStatus, jqXHR ) {
			mostrarDatos(data.split(";"));
    },
    error : function ( jqXHR, textStatus, errorThrown ) {
        // do what ever in failure
    }
});

function mostrarDatos(data)
{
	daySelect = document.getElementById("dimensiones");
	for(d in data)
	{
		nOpcion = document.createElement("option");
		nOpcion.text =data[d];
		nOpcion.value =d;
		daySelect.appendChild(nOpcion);
	}
}

$("[id*=d]").change(function(e) {
var d=$(this).attr("id");
var ncol = d[d.length -1];
var nfil=$(this).find(":selected").val();

switch(nfil) 
{
  case "0":
	$("#fil"+ncol).empty();
	return;
  case "grado":	 
	campo="grado"; 
	fichero=fdgrado;
	break;
  case "provincia":	 
	campo="provincia"; 
	fichero=fdprov;
	break;
  case "genero":	
	campo="genero"; 
	fichero=fdgenero;
	break;
}	
$("#fil"+ncol).empty();
$.getJSON(fichero, function(data){
    for (var i = 0, len = data.length; i < len; i++) {
	contenido=' <div class="form-check"><input class="form-check-input" type="checkbox" value="'+data[i]+'" name="f'+ncol+i+'" id="defaultCheck1'+i+'"><label class="form-check-label" for="defaultCheck'+i+'">';
	contenido+=data[i];
	contenido+='</label></div>';

	$(".dd"+ncol).append(contenido);
    }
});

});


$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});

});
