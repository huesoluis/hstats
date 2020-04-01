$( document ).ready(function() {

var formData = {
    'd0'		: $( "#d0 option:selected" ).text(),
    'd1'		: $( "#d1 option:selected" ).text(),
    'd2'		: $( "#d2 option:selected" ).text()
};

$('#bgengra').click(function() {
var vformdata = "ejs";
$.ajax({
  url: "scripts/php/pr_gen_csvs_graficos.php",
  type: "post",
  data: {formdata:vformdata}
}).done(function(data) {
if(data=="NO DATA"){console.log("no datos"); return 1; }
else
	{ 
	var adato = data.split(":");	
	var fcsv = adato[1];	
	if(adato[0]!=3)
	{
		console.log(data);
		$("#graficos3").remove();
		$("#zgraficos").show();
		show_graph(fcsv,'#big-gra');
	}
	else if(adato[1]==3) 
	{
		$("#graficos3").remove();
		var html='';
		var filtros = dimensiones.split(":");	
		$('.big-gra').hide();
		for (k = 1; k <= filtros.length; k++) 
		{
		p=k-1;
		if(k==1 || k%4==0) html +="<div class='row' id='graficos3'>";
		html +="<div class='col-md-4'><div class='sma-gra' id='sma-gra"+p+"'></div></div>";
		if(k%3==0) html +="</div>";
		}

		if(filtros.length<3 || filtros.length%3!=0) html+='</div>';
		$(html).insertAfter($("#zgraficos"));
		$("#zgraficos").hide();
		
		$('.sma-gra').each(function(i){show_graph(fcsv+i+'.csv','#sma-gra'+i,filtros[i]);console.log("dimm 3");});
	}
	}
}).fail(function(j,t,e){console.log("algo salio mal"+e)});
});

function addgraph(v,i)
{
var k=i+1;
if(k==1 || k%3==0) html +="<div class='row' id='graficos3'>";
html +="<div class='col-md-4'><div class='sma-gra' id='sma-gra"+i+"'></div></div>";
if(k%3==0) html +="</div>";
}

});
