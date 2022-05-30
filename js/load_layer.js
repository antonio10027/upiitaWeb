function load_layer(){

overlay.setPosition(undefined);
        closer.blur();

if(featureOverlay)
		{
		featureOverlay.getSource().clear();
		map.removeLayer(featureOverlay);
		
		//alert('karan');
		}

if (lineGraph)
	{
	lineGraph.destroy();
	}
if (barGraph)
	{
	barGraph.destroy();
	}
//alert('karan');
if(geojson)
		{
		geojson.getSource().clear();
		overlays.getLayers().remove(geojson);
		
		//alert('karan');
		}
	  
	  if(geojson_point)
		{
		geojson_point.getSource().clear();
		overlays.getLayers().remove(geojson_point);
		
		}
		
var start_date = document.getElementById("start_date").value;
var end_date = document.getElementById("end_date").value;
var param = document.getElementById("parameter");
value_param = param.options[param.selectedIndex].value;
//var selectedradio = $("input:radio[name=layer_radio]:checked").val();
//alert(start_date);
//alert(end_date);
//alert(selectedradio);


var url_max = "js/php_files/max_value_spatial.php";
          url_max += "?date1="+start_date;
		  url_max += "&date2="+end_date;
		  url_max += "&parameter="+value_param;
		// alert(url_max);
		  
		  
 var url_point = "js/php_files/geojson_layer_point_spatial.php";
          url_point += "?date1="+start_date;
		  url_point += "&date2="+end_date;
		  url_point += "&parameter="+value_param;
		//  alert(url_point);
		  
var url_poly = "js/php_files/geojson_layer_spatial.php";
          url_poly += "?date1="+start_date;
		  url_poly += "&date2="+end_date;
		  url_poly += "&parameter="+value_param;
		  
		//  alert(url_poly);
		  
		  $.getJSON(url_max, function(data) {
//alert('karan');
var max_value = data.maximum[0].max;
//alert(max_value);

var diff = max_value/7;
//alert(diff);

var i;
var k;
var color = [[254, 217, 118, 0.7], [254, 178, 76, 0.7], [253, 141, 60, 0.7], [252, 78, 42, 0.7], [227, 26, 28, 0.7], [189, 0, 38, 0.7], [128, 0, 38, 0.7] ];

getStyle1 = function (feature, resolution) {

for (i = 0; i < 7; i++) {

 if (feature.get([value_param]) > (i*diff) && feature.get([value_param]) <= ((i+1)*diff)) {
        return new ol.style.Style({
            fill: new ol.style.Fill({
                color: color[i] // semi-transparent red
            }),
			stroke: new ol.style.Stroke({
            color: 'white',
            lineDash: [2],
            width: 2
             })
        });
    }
//alert(i);
if (value_param == 'vaccinations' || value_param == 'tests'){
 $("#"+i).html(Math.round((i*diff)/1000000)+"M - "+Math.round(((i+1)*diff)/1000000)+"M");

}
else{
 $("#"+i).html(Math.round((i*diff)/1000)+"K - "+Math.round(((i+1)*diff)/1000)+"K");
}
 $("#legend_title").html('<b>Legend - COVID '+value_param+'</b>');
}
 if (feature.get([value_param]) == 0) {
        return new ol.style.Style({
            fill: new ol.style.Fill({
                color: [254, 217, 118, 0.7] // semi-transparent red
            }),
			stroke: new ol.style.Stroke({
            color: 'white',
            lineDash: [2],
            width: 2
             })
        });
    }
	 


};
var col = 'rgba(255, 255, 0, 0.6)';
var col1 = 'rgba(255, 0, 0, 0.6)';
getStyle2 = function (feature, resolution) {



var txt = new ol.style.Text({
	text: feature.get('country_name')+":"+feature.get([value_param]),
	offsetX: 20,
	offsetY: -15,
    font: '12px Calibri,sans-serif',
    fill: new ol.style.Fill({
      color: '#000'
    }),
    stroke: new ol.style.Stroke({
      color: '#fff',
      width: 3
    })
  });
  
  var fill = new ol.style.Fill({color: col});
  var stroke = new ol.style.Stroke({color: col1, width: 1});



for (i = 0; i < 7; i++) {

 if (feature.get([value_param]) > (i*diff) && feature.get([value_param]) <= ((i+1)*diff)) {
       return new ol.style.Style({
		 image: new ol.style.Circle({
		  radius: 5*(i+1),
		  fill: fill,
		  stroke: stroke
		}),
	//	text: txt
            
        });
    }
//alert(i);

}
 if (feature.get([value_param]) == 0) {
       return new ol.style.Style({
		 image: new ol.style.Circle({
		  radius: 0,
		  fill: fill,
		  stroke: stroke
			}),
			//text: txt
            
        });
    }

};



});
		  
geojson = new ol.layer.Vector({
	 title: 'COVID '+value_param+'('+start_date+' to '+end_date+')',
          source: new ol.source.Vector({
             url: url_poly,
          format: new ol.format.GeoJSON()
          }),
          style: function (feature, resolution) {
        return getStyle1(feature, resolution);
    }
        });
		
		geojson.getSource().on('addfeature', function(){
    map.getView().fit(
        geojson.getSource().getExtent(),
        { duration: 000, size: map.getSize() }
    );
 });
 overlays.getLayers().push(geojson);
		//map.addLayer(geojson);		
layerSwitcher.renderPanel();
geojson_point = new ol.layer.Vector({
	 title: 'COVID '+value_param+'('+start_date+' to '+end_date+')_circle',
          source: new ol.source.Vector({
             url: url_point,
          format: new ol.format.GeoJSON()
          }),
          style: function (feature, resolution) {
        return getStyle2(feature, resolution);
    }
        });
		
		geojson_point.getSource().on('addfeature', function(){
    map.getView().fit(
        geojson_point.getSource().getExtent(),
        { duration: 000, size: map.getSize() }
    );
 });
		
		overlays.getLayers().push(geojson_point);
		//map.addLayer(geojson_point);
		layerSwitcher.renderPanel();
		var url_cum_graph = "js/php_files/graph_world_cumulative.php";
          		  url_cum_graph += "?parameter="+value_param;
				   url_cum_graph += "&date1="+start_date;
		          url_cum_graph += "&date2="+end_date;
		
//alert(url_cum_graph);

	
		$.getJSON(url_cum_graph, function(data)  {
			//console.log(data);
			var date = [];
			var score = [];
			var score1 = [];
            var score2 = [];
			for(var i in data) {
				date.push(data[i].date);
				score.push(data[i][value_param]);
				//score1.push(data[i].production);
				//score2.push(data[i].yield);
				//alert(i);
			}

			var chartdata = {
				labels: date,
				datasets : [
					{
						label: 'COVID '+value_param,
						backgroundColor: 'rgba(255, 0, 0, 1)',
						borderColor: 'rgba(255, 0, 0, 1)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: score,
						fill: false
					
					}
				]
			};

			var ctx = $("#mycanvas1");
          // var ctx = document.getElementById('#mycanvas');
			 lineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata,
				options: {
				responsive: true,
				maintainAspectRatio: false,
				plugins: {
				title: {
					display: true,
					text: 'World Cumulative COVID '+value_param+'('+start_date+' to '+end_date+')'
				}
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				scales: {
					x: {
						display: true,
						title: {
							display: true,
							text: 'Date'
						}
					},
					y: {
						display: true,
						title: {
							display: true,
							text: 'COVID '+value_param
						},
							 ticks: {
                beginAtZero: true
                   }
					}
				}
			}
				
			});
		});


var url_daily_graph = "js/php_files/graph_world_daily.php";
          		  url_daily_graph += "?parameter="+value_param;
				   url_daily_graph += "&date1="+start_date;
		          url_daily_graph += "&date2="+end_date;

$.getJSON(url_daily_graph, function(data)  {
			//console.log(data);
			var date = [];
			var score = [];
			var score1 = [];
            var score2 = [];
			for(var i in data) {
				date.push(data[i].date);
				score.push(data[i][value_param]);
				//score1.push(data[i].production);
				//score2.push(data[i].yield);
				//alert(i);
			}

			var chartdata = {
				labels: date,
				datasets : [
					{
						label: 'COVID '+value_param,
						backgroundColor: 'rgba(255, 0, 0, 1)',
						borderColor: 'rgba(255, 0, 0, 1)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: score,
						fill: false
					
					}
				]
			};

			var ctx = $("#mycanvas2");
          // var ctx = document.getElementById('#mycanvas');
			 barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata,
				options: {
				responsive: true,
				maintainAspectRatio: false,
				plugins: {
				title: {
					display: true,
					text: 'World Daily COVID '+value_param+'('+start_date+' to '+end_date+')'
				}
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				scales: {
					x: {
						display: true,
						title: {
							display: true,
							text: 'Date'
						}
					},
					y: {
						display: true,
						title: {
							display: true,
							text: 'COVID '+value_param
						},
							 ticks: {
                beginAtZero: true
                   }
					}
				}
			}
				
			});
		});
	
// counter
var url_counter_world = "js/php_files/counter_world.php";
	url_counter_world += "?date1="+start_date;
	url_counter_world += "&date2="+end_date;
	
	
	$.getJSON(url_counter_world, function(data) {
		// console.log(data[0].deaths);
		//alert(data[0].cases);
      	$("#cases").html('Cases: '+data[0].cases);
     	$("#deaths").html('Deaths: '+data[0].deaths);
		//$("#tests").html('Tests: '+data[0].tests);
 		//$("#vaccinations").html('Vaccinations: '+data[0].vaccinations);
	});

	
	/*$(document).ready(function(){
	
	$.ajax({
		url: url_counter_world,
		method: "GET",
		success: function(data) {
			console.log(data[0].deaths);
		//alert(data[0].cases);
      $("#cases").html('Cases: '+data[0].cases);
     $("#deaths").html('Deaths: '+data[0].deaths);
 $("#tests").html('Tests: '+data[0].tests);
  $("#vaccinations").html('Vaccinations: '+data[0].vaccinations);
			
		},
		error: function(data) {
			console.log(data);
		}
	});
});*/


}