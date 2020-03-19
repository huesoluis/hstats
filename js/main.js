$( document ).ready(function() {

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
