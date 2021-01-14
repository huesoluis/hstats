$( document ).ready(function() {
//FUNCION PARA ENVIO DE DATOS

$('#form').submit(function(event) {
	var fdata=$('#form').serialize();
	console.log("proc formulario");
	console.log(fdata);
	return;
	path='ajax/datoscentros.php';
	$.ajax({
            type        : 'POST',
            url         : path,
            data        : fdata,
            encode      : true,
	    contentType: "application/x-www-form-urlencoded;charset=utf-8",
		})
    .done(function(data) {
			console.log("tipo: "+data);
		return;		
		})
	})

})
