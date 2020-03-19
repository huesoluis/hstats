$( document ).ready(function() {

var fdgrado='js/dimensiones/grados.json';
var fdprov='js/dimensiones/provincias.json';
var fdgenero='js/dimensiones/generos.json';

var fichero="nofile";

$("[id*=dim]").change(function(e) {
var d=$(this).attr("id");
var ncol = d[d.length -1];
var nfil=$(this).find(":selected").val();

switch(nfil) 
{
  case "0":
	$("#fil"+ncol).empty();
	return;
  case "1":	 
	fichero=fdgrado;
	break;
  case "2":	 
	fichero=fdprov;
	break;
  case "3":	 
	fichero=fdgenero;
	break;
}	
$("#fil"+ncol).empty();
$.getJSON(fichero, function(data){
    for (var i = 0, len = data.length; i < len; i++) {
	$(".dd"+ncol).append(
		'<a class="dropdown-item" href="#">'
		+data[i]+
		'</a>');
    }
});
});

});
