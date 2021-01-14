$( document ).ready(function() {
$('body').on('click', '#mlateral', function(e){
$('#menulateral').toggle();
$('.ftopmlateral').toggle();
});
/////////////////////////////////////////////////////////////////////////////////////////////////

//FILTRO REGISTROS
$('body').on('keyup', '#filtropn ,#filtrosn', function(e){
	var expression = false;
        var value = $(this).val();
        var nivel = $(this).attr("nivel");
	console.log(nivel);
        if(value.length<=2){
            $("."+nivel).each(function () {
	    			$(this).show();
	    			});
	    			}
            if(value.length<3) return;

	    var finder = "";
	    if (value.indexOf("\"") > -1 && value.lastIndexOf("\"") > 0) {
                finder = value.substring(eval(value.indexOf("\"")) + 1, value.lastIndexOf("\""));
                expression = true;
            }
            $("."+nivel).each(function () {
                var title = $(this).text();
		console.log(title);
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
//FIN FILTRO REGISTROS

});
