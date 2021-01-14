$( document ).ready(function() {
	
	$('body').on('click', '#pct_porcentros', function(e){
		console.log("cargando grafico gssneral");
		carga_graficos_gen('centros');
	});
	$('body').on('click', '#pct_porcomarcas', function(e){
		console.log("cargando g general");
	//	$("#grafico_general_pct_1").remove();
		carga_graficos_gen('comarcas');
	});
	//$(".gbach").hide();
});

function carga_graficos_gen(tipo)
{
	var vfile1="scripts/datos/datos_graficos/grafico_gen_"+tipo+"_pct.csv";
	console.log("FICHERO GRAFICOS: "+vfile1);
	show_grafico_general(vfile1,'show_grafico_general');

}

function show_grafico_general(vfile,selector)
{
//console.log("FICHERO: "+vfile);
console.log("SELECTOR: "+selector);
$.get(vfile, function(csv) {
	console.log(vfile)
	console.log(selector)
	Highcharts.chart(selector, {
		 credits: {
        enabled: false
    },
    chart: {
        type: 'bar'
    },
    title: {
        text: ''
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Población'
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
    legend: {
        align: 'right',
        x: -30,
        verticalAlign: 'top',
        y: 25,
        floating: true,
        backgroundColor:
        Highcharts.defaultOptions.legend.backgroundColor || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: false
    },
    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true
            }
        }
    },
			data: {
			    csv: csv
			}
});

}).fail(function(jqXHR, textStatus, errorThrown) {
    // alert( "error" );
    console.log("Error: ("+textStatus + errorThrown + ')');
    console.log(jqXHR.responseText);
  })

}
function show_grafico_evol(vfile,selector)
{
$.get(vfile, function(csv) {
	console.log(vfile)
	console.log(selector)
	Highcharts.chart(selector, {
		 credits: {
        enabled: false
    },
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Población'
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
    legend: {
        align: 'right',
        x: -30,
        verticalAlign: 'top',
        y: 25,
        floating: true,
        backgroundColor:
        Highcharts.defaultOptions.legend.backgroundColor || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: false
    },
    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true
            }
        }
    },
			data: {
			    csv: csv
			}
});

}).fail(function(jqXHR, textStatus, errorThrown) {
    // alert( "error" );
    console.log("Error: ("+textStatus + errorThrown + ')');
    console.log(jqXHR.responseText);
  })

}
function carga_graficos_pruebas()
{
$('body').on('click', '#cambiarcsv', function(e){
	console.log("Cambiando datos de csv");
	chart.update({
		
    data: {
        //csvURL: 'https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/analytics.csv',
        csvURL: 'http://hstats.tk/pruebas/formidiomas2/dg2.csv',
        beforeParse: function (csv) {
            return csv.replace(/\n\n/g, '\n');
        }
    }
  })
})
const chart=Highcharts.chart('grafico_evolutivo1', {

    chart: {
        scrollablePlotArea: {
            minWidth: 700
        }
    },

    data: {
        //csvURL: 'https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/analytics.csv',
        csvURL: 'http://hstats.tk/pruebas/formidiomas2/dg1.csv',
        beforeParse: function (csv) {
            return csv.replace(/\n\n/g, '\n');
        }
    },

    title: {
        text: 'Daily sessions at www.highcharts.com'
    },

    subtitle: {
        text: 'Source: Google Analytics'
    },

    xAxis: {
        tickInterval: 7 * 24 * 3600 * 1000, // one week
        tickWidth: 0,
        gridLineWidth: 1,
        labels: {
            align: 'left',
            x: 3,
            y: -3
        }
    },

    yAxis: [{ // left y axis
        title: {
            text: null
        },
        labels: {
            align: 'left',
            x: 3,
            y: 16,
            format: '{value:.,0f}'
        },
        showFirstLabel: false
    }, { // right y axis
        linkedTo: 0,
        gridLineWidth: 0,
        opposite: true,
        title: {
            text: null
        },
        labels: {
            align: 'right',
            x: -3,
            y: 16,
            format: '{value:.,0f}'
        },
        showFirstLabel: false
    }],

    legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0
    },

    tooltip: {
        shared: true,
        crosshairs: true
    },

    plotOptions: {
        series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function (e) {
                        hs.htmlExpand(null, {
                            pageOrigin: {
                                x: e.pageX || e.clientX,
                                y: e.pageY || e.clientY
                            },
                            headingText: this.series.name,
                            maincontentText: Highcharts.dateFormat('%A, %b %e, %Y', this.x) + ':<br/> ' +
                                this.y + ' sessions',
                            width: 200
                        });
                    }
                }
            },
            marker: {
                lineWidth: 1
            }
        }
    },

    series: [{
        name: 'All sessions',
        lineWidth: 4,
        marker: {
            radius: 4
        }
    }, {
        name: 'New users'
    }]
});

}
