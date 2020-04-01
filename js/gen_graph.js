function show_graph(vfile,vsel,nombre)
{
	var len=vfile.length;
	$.get(vfile, function(csv) {
		selector=vsel;
		    $(selector).highcharts({
			credits: {
				enabled: false
				},
			chart: 	{
				type: 'column'
				},
			data: {
			    csv: csv
			},
			title: {
					text: nombre
				},
			yAxis: {
				title: {
					text: 'Número de alumnos'
					}
				}
		    });
		});
}
                  
function show_big(selector,file,link)
{
	jQuery('html,body').animate({scrollTop:0},0);     
	$.get(file, function(csv) 
	{
	console.log("clickando");
		file = file.substring(0, file.length-4);
			$("#big").highcharts
			({
				credits: {enabled: true},
				chart: {type: 'bar'},
				data: {csv: csv},
				title: {
					text: link
				},
				yAxis: {
					title: {text: 'Número de alumnos'}
					}
		    });
	});
	   
}

