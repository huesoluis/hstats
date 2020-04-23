$( document ).ready(function() {

//nada mas cargar el doc ocultamos la seccion de listados
$("#filagraficos").hide();
$(".cgraficos").hide();

$('body').on('click', '#lcentros', function(e)
{
	$("#filalistados").show();
	$("#filagraficos").hide();
	
	$("#tipoinfo").text("LISTADOS");
	$("#tipoinfo").attr('value','listados');
	
	$(".clistados").show();
	$(".cgraficos").hide();
}
);
$('body').on('click', '#gmatricula', function(e)
{
	$("#filalistados").hide();
	$("#filagraficos").show();
	
	$("#tipoinfo").text("GRÁFICOS");
	$("#tipoinfo").attr('value','graficos');
	
	$(".clistados").hide();
	$(".cgraficos").show();
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
	path='scripts/php/'+script;
	console.log("RUTA: "+path);
	$.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : path, // the url where we want to POST
            data        : fdata, // our data object
            encode      : true,
	    contentType: "application/x-www-form-urlencoded;charset=utf-8",
				})
            .done(function(data) {
		console.log(data);	
		$("#big-list").append(data);
		return;		
		console.log("TIPO: "+tipo+" SCRIPT: "+script);
		var fcsv = "scripts/php/"+data;	
		adato=data.split(":");
		if(adato[0]!=3)
		{
			$("#graficos3").remove();
			$("#zgraficos").show();
			show_graph(adato[1],'#big-gra');
		}
		else if(adato[0]==3)
		{
			console.log("DIMENSION: "+adato[0]);
			console.log("FICHEROS: "+adato[1]);
			ficheros=adato[1].split("#");
			ficheros.shift();
			console.log("ARRAY FICHEROS: "+ficheros);
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
				if(k==0 || k%4==0) html +="<div class='row' id='graficos3'>";
				html +="<div class='col-md-4'><div class='sma-gra' id='sma-gra"+k+"'></div></div>";
				if(m%4==0) html +="</div>";
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
