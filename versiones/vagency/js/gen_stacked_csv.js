$( document ).ready(function() {


	carga_graficos_evol('ei');
	carga_graficos_evol('ep');
	carga_graficos_evol('eso');
	carga_graficos_evol('bach');
	
 const chart=	carga_graficos_pruebas();

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

	$(".gei").hide();
	$(".gep").hide();
	$(".geso").hide();
	$(".gbach").hide();

	$('body').on('click', '#graficos_ei', function(e){
		$(".gei").toggle('slow');
	});
	$('body').on('click', '#graficos_ep', function(e){
		$(".gep").toggle('slow');
	});
	$('body').on('click', '#graficos_eso', function(e){
		$(".geso").toggle('slow');
	});
	$('body').on('click', '#graficos_bach', function(e){
		$(".gbach").toggle('slow');
	});
	$('body').on('click', '#grafico_evolutivo_enseñanzas', function(e){
		console.log("mostrando enseñanzas evolutivo");
		
	carga_graficos_evolutivos('enseñanzas');
		//$(".gbach").toggle('slow');
	});

	
});

function carga_graficos_evolutivos(ens)
{
	var vfile1="./scripts/datos/datos_graficos/grafico_evolutivo_"+ens+".csv";
	console.log("fichero de datos: "+vfile1);
	console.log("selector:  "+ens);
	show_grafico_evol(vfile1,'hijo_grafico_evolutivo_'+ens);
}
function carga_graficos_evol(ens)
{
	var vfile1="./scripts/datos/datos_graficos/grafico_evo_con_pub_"+ens+".csv";
	show_grafico_evol(vfile1,'grafico_'+ens+'_1');

	var vfile2="./scripts/datos/datos_graficos/grafico_evo_padron_nalumnos_"+ens+".csv";
	//show_grafico_evol(vfile2,'grafico_'+ens+'_2');

	var vfile3="./scripts/datos/datos_graficos/grafico_evo_prc_padron_"+ens+".csv";
	//show_grafico_evol(vfile3,'grafico_'+ens+'_3');
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
function carga_graficos_pruebas_old()
{
const chart=Highcharts.chart('grafico_evolutivo1', {

    chart: {
        scrollablePlotArea: {
            minWidth: 700
        }
    },

    data: {
        csvURL: 'http://hstats.tk/pruebas/formidiomas2/dg1.csv',
        //csvURL: 'pruebas/formidiomas2/dg2.csv',
        //csvURL: 'https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/analytics.csv',
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
return chart;
}
