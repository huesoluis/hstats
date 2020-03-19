            function get_files(){
                 $.ajax({
                           type: "POST",
                           url: "php/get_ofertas_familias.php",
                           cache: false,    
                           success: function(result){
                                    
                                    var res = result.split('/');
                                    show_graph(res);  
                                   
                                return result;
                               },
                      error: function(data) {
		console.log("error");
    }
                        });
            }

           function show_graph(data)
            {
		console.log(data);
                var len=data.length;
                $.each(data,function(i,gr){
                    
                    if(i==len-1 || gr=='') return false;
                $.get('csvs_ofertas_familias/'+gr, function(csv) {
		console.log('success bigiff'+len);
		gr = gr.substring(0, gr.length-4);
                    var cont='';
                    var selector='';
                    if(i!=0){
                        cont=' <div class="col-sm-4 col-xm-12"><div class="peq'+i+'"></div></div>';
                       $('.small').append(cont);
                    selector='.peq'+i;
                        }
                        else  
                            {
		console.log('success big');
                            selector='#big';

                            }
                   // add_clicks(selector,gr);
			    $(selector).highcharts({
                    		credits: {
        				enabled: false
    					},
			        chart: 	{
			        	type: 'column',
					events: {
	                			click: function(event) {
                    			console.log(gr);
	                    		fichero=gr.concat('.csv');	
                     			show_big(selector,fichero);
	                				}
	            				}
			        },
			        data: {
			            csv: csv
			        },
			        title: {
						text: gr
					},
				yAxis: {
					title: {
						text: 'Número de alumnos'
						}
					}
			    });
			});
                });
                             }
                
                  
              function add_clicks(sel,file)
            {
                    console.log(sel);
                  $(sel).click(function(){
                                   
                     show_big(sel,file);

    });
            }
        function show_big(selector,file){
		console.log("focus");
        jQuery('html,body').animate({scrollTop:0},0);     
	$.get('csvs_ofertas_familias/'+file, function(csv) {
		file = file.substring(0, file.length-4);
                 console.log(csv);
          $("#big").highcharts({
                    credits: {
        enabled: false
    },
			        chart: {
			        	type: 'column'
			        },
			        data: {
			            csv: csv
			        },
			        title: {
						text: file
					},
					yAxis: {
						title: {
							text: 'Número de alumnos'
						}
					}
			    });
            
            
            
        });
                   
	}

		$(document).ready(function() {
           get_files();
			
    $('#search').keyup(function () { 
        var valThis = $(this).val();
    
    $('#rsidebar>li>').each(function(){
     var text = $(this).text().toLowerCase();
     
        (text.indexOf(valThis) >= 0) ? $(this).show() : $(this).hide();         
   });
      
        
   });

			
		});
