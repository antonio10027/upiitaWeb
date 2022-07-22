<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coropleta</title>

    <!-- CSS only -->
   <?php include("includes/estilos.php"); ?>
 <!--libreria jquery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- js para personalizar 
<script src="js/app.js"></script>-->
<!--bootstrap css CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!--css Date Picker 
<link rel="stylesheet" href="libs/css/bootstrap-datepicker.standalone.css">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</head>

<body>


    <div id="map" class="map">
        <!--  <button onclick="wms_layers()" type="button" id="wms_layers_btn" class="btn btn-success btn-sm">Capas Disponibles</button> -->
       
       
        <button onclick="show_hide_querypanel()" type="button" id="query_panel_btn" class="btn btn-success btn-sm">☰ Capas Disponibles</button>
        <div id="legend"></div>
       

    </div>
    <!--de acá para abajo está lo de coropelta--------------------------------------------------------------------------->
	<style>
.info { padding: 6px 8px; font: 14px/16px Arial, Helvetica, sans-serif; background: white; background: rgba(255,255,255,0.8); box-shadow: 0 0 15px rgba(0,0,0,0.2); border-radius: 5px; } .info h4 { margin: 0 0 5px; color: #777; }
.legend { text-align: left; line-height: 18px; color: #555; } .legend i { width: 18px; height: 18px; float: left; margin-right: 8px; opacity: 0.7; }</style>
    <script type="text/javascript">

	var map = L.map('map').setView([19.47178618,-99.15352590], 16);

	var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);

	// control that shows state info on hover
	var info = L.control();

	info.onAdd = function (map) {
		this._div = L.DomUtil.create('div', 'info');
		this.update();
		return this._div;
	};

	info.update = function (props) {
		this._div.innerHTML = '<h4>Nivel de contaminación</h4>' +  (props ?
			//'<b>' + props.o3_mean + '</b><br />' + props.density + ' people>' : 'Hover over a state');
			'<b>' + props.valor + '</b><br />' + '' + ' puntos ' : '');
	};

	info.addTo(map);


	// get color depending on population density value
	function getColor(d) {
		return d > 38 ? '#800026' :
			d > 36  ? '#BD0026' :
			d > 34  ? '#E31A1C' :
			d > 32  ? '#FC4E2A' :
			d > 30   ? '#FD8D3C' :
			d > 28   ? '#FEB24C' :
			d > 26   ? '#FED976' : '#FFEDA0';
	}

	function style(feature) {
		return {
			weight: 2,
			opacity: 1,
			color: 'white',
			dashArray: '3',
			fillOpacity: 0.7,
			fillColor: getColor(feature.properties.valor)
		};
	}

	function highlightFeature(e) {
		var layer = e.target;

		layer.setStyle({
			weight: 5,
			color: '#666',
			dashArray: '',
			fillOpacity: 0.7
		});

		if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
			layer.bringToFront();
		}

		info.update(layer.feature.properties);
	}

	var geojson;

	function resetHighlight(e) {
		geojson.resetStyle(e.target);
		info.update();
	}

	function zoomToFeature(e) {
		map.fitBounds(e.target.getBounds());
	}

	function onEachFeature(feature, layer) {
		layer.on({
			mouseover: highlightFeature,
			mouseout: resetHighlight,
			click: zoomToFeature
		});
	}

	/* global statesData */
	/* ORIGINAL
	geojson = L.geoJson(statesData, {
		style: style,
		onEachFeature: onEachFeature
	}).addTo(map); */

	//const api = "php/contaminantes.php";
	const api = "php/contaminantes.geojson";
	async function fetchData(url) {
		try {
			const response = await fetch(url);
			const data = await response.json();
			return data;
		} catch (err) {
			console.error(err);
		}
	};

	fetchData(api)
		.then(data => {
			L.geoJson(data, {
				style: style,
				onEachFeature: onEachFeature
			}).addTo(map);
	});

	map.attributionControl.addAttribution('Population data &copy; <a href="http://census.gov/">US Census Bureau</a>');


	var legend = L.control({position: 'bottomright'});

	legend.onAdd = function (map) {

		var div = L.DomUtil.create('div', 'info legend');
		var grades = [0, 26, 28, 30, 32, 34, 36, 38];
		var labels = [];
		var from, to;

		for (var i = 0; i < grades.length; i++) {
			from = grades[i];
			to = grades[i + 1];

			labels.push(
				'<i style="background:' + getColor(from + 1) + '"></i> ' +
				from + (to ? '&ndash;' + to : '+'));
		}

		div.innerHTML = labels.join('<br>');
		return div;
	};

	legend.addTo(map);

</script>
<!--de acá para arriba está lo de coropleta-------------------------------------------------------------------------------------->
    

<!-- se optó por meterl el div con id "wms_layers_window dentro del query_tab para que se pueda ocultar cuando sea
    necesario, para ajustar su tamaño es necesario mover la propiedad de style con width de 30% para que no bloquee la 
    pantalla completa a la hora de abrirlo. en elemento que está con clase modal dialog tambien cambiará de tamaño dado que 
    tiene un porcentaje de un ancho maximo en el archivo de style.css que está en la carpeta raiz"-->
    <div id="query_tab"name="Contaminante" method="POST" action="php/Filtrar.php">
       
        <div class="modal" id="wms_layers_window"  style="width: 30%;" >
         <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button  type="button" onclick="IraDashBoard()" id="irDashboard" class="btn btn-dark btn-sm">Regresar a UPIITAWEB</button>
            </div>

            <div class="tab-pane fade show active"  id="nav-home"  role="tabpanel"  aria-labelledby="nav-home-tab">
                <label for="layer"><b>Selecionar Contaminante</b></label>
                <select  class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Contaminante</option>
					<option value="pm10">PM10</option>
					<option value="pm25">PM25</option>
					<option value="co">CO</option>
					<option value="no2">NO2</option>
					<option value="03">O3</option>
					<option value="so2">SO2</option>
                </select>
                <br>
             <!--   <label for="attributes"><b>Seleccionar Alcaldía</b></label>
                <select id="attributes" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Alcaldía</option>
                </select>
                <br>
                <label for="operator"><b>Seleccionar Colonia</b></label>
                <select id="operator" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Colonia</option>
                </select>
                <br>
                
                <label for="Check-in">Fecha de Inicio</label>
                <div class="input-group date" id="datepickerInicio">
                        <input type="text" class="form-control">
                        <span class="input-group-append">
                            <span class="input-group-text bg-white">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>
                    </div>
                <br>
                <label for="Check-out">Fecha de Fin</label>
                <div class="input-group date" id="datepickerFin">
                        <input type="text" class="form-control">
                        <span class="input-group-append">
                            <span class="input-group-text bg-white">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>
                    </div>  -->

                <button  type="button" id="BTN-cargarCapa" type="submit"  class="btn btn-danger btn-sm">Cargar Capa</button>

            </div>
        </nav>
        <div class="modal-dialog modal-dialog-scrollable" id="movableDialog"  >
           
            
        </div>
       
        </div>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                
    
               
                
            </div>
        </div>

    </div>

    <div id="table_data"></div>
    
    <script src="map.js"></script>
    
</body>

</html>