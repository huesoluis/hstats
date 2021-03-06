function show_graph(vfile,vsel,nombre)
{
	console.log("generando graph SELECTOR: "+vsel);
	console.log("generando graph FICHERO: "+vfile);
	var len=vfile.length;
	console.log(vfile);
	$.get(vfile, function(csv) {
		selector=vsel;
		    $(selector).highcharts({
			credits: {
				enabled: false
				},
			chart: 	{
				zoomType: 'x',
				type: 'column',
				scrollablePlotArea: {
            minWidth: 700,
            scrollPositionX: 1
        }
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
					},
        	stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: ( // theme
                    Highcharts.defaultOptions.title.style &&
                    Highcharts.defaultOptions.title.style.color
                ) || 'gray'
            }
        	}
				},

    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true
            }
        }
    }
		    });
		}).fail(function(jqXHR, textStatus, errorThrown) {
    // alert( "error" );
    console.log("Error: ("+textStatus + errorThrown + ')');
  })
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
				chart: {type: 'column'},
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

