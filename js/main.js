$( document ).ready(function() {

$('#fdim').submit(function(event) {
        var formData = {
	    'd0'		: $( "#d0 option:selected" ).text(),
	    'd1'		: $( "#d1 option:selected" ).text(),
	    'd2'		: $( "#d2 option:selected" ).text()
        };
	$.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'scripts/php/pr_gen_csvs.php', // the url where we want to POST
            data        : formData, // our data object
            //dataType    : 'json', // what type of data do we expect back from the server
            encode      : true,
	 			})
            .done(function(data) {
                // log data to the console so we can see
                console.log(data); 
            })
	 	.fail(function(request, status, error) {

		// show any errors
		// best to remove for production
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
