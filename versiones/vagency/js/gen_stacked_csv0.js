$( document ).ready(function() {

$('body').on('click', '#grafico_ei', function(e){
var vfile="./scripts/datos/datos_graficos/grafico_evo_con_pub_EI.csv";
//var vfile="/datos/websfp/desarrollo/hstats/versiones/vagency/scripts/datos/datos_graficos/csvprueba.csv"

show_grafico_evol(vfile,'grafico_ei_1');

});
});

function show_grafico_evol(vfile,selector)
{
$.get(vfile, function(csv) {
	console.log(vfile)
	console.log(csv)
	Highcharts.chart(selector, {
		 credits: {
        enabled: false
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'Alumnos en la ESO y Padrón'
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

// Radialize the colors
Highcharts.setOptions({
    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    })
});
}).fail(function(jqXHR, textStatus, errorThrown) {
    // alert( "error" );
    console.log("Error: ("+textStatus + errorThrown + ')');
    console.log(jqXHR.responseText);
  })

}
