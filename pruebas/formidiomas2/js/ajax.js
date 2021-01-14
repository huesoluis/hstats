$( document ).ready(function() {
/*
var path="ajax/getdata.php";

	$.ajax({
            type        : 'POST',
            url         : path,
            data        : {},
            encode      : true,
	    contentType: "application/x-www-form-urlencoded;charset=utf-8",
		})
    .done(function(data) {
			console.log("tipo: "+data);
		return;		
		})
*/
//FUNCION PARA ENVIO DE DATOS
$('body').on('click', '#enviar', function(e){
var vcodcentro=2222; //para pruebas
var vnalumnos = [];
var vfdata = [];
var path="ajax/storedata.php";
$('.nalumnos').each(function () {
		vnalumnos.push($(this).val());
});
$('.js-select2 option:selected').each(function () {
		vfdata.push($(this).text());
});
for (i = 0, len = vnalumnos.length; i < len; i++) {
console.log("probando "+ vnalumnos[i]);
if(!isNumeric(vnalumnos[i]) || vnalumnos[i].length<=0)
{ 
	alert("Debes introducir un número entero");
	return;
}

}  
	$.ajax({
            type        : 'POST',
            url         : path,
            data        : {fdata:vfdata,numalumnos:vnalumnos,codcentro:vcodcentro},
            encode      : true,
	    contentType: "application/x-www-form-urlencoded;charset=utf-8",
		})
    .done(function(data) {
			if(data.indexOf("OK"))
				alert("Datos guardados correctamente");
					console.log("tipo: "+data);
		return;		
		})
		
	return;
	})

})

function isNumeric(num){
  return !isNaN(num)
}
