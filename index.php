<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPIITAWEB</title>

    <!-- CSS only -->
   <?php include("includes/estilos.php"); ?>
 <!--libreria jquery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- js para personalizar -->
<script src="js/app.js"></script>
<!--bootstrap css CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!--css Date Picker-->
<link rel="stylesheet" href="libs/css/bootstrap-datepicker.standalone.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link href='css/leaflet.fullscreen.css' rel='stylesheet' />
  <script src='libs/fullscreen.min.js'></script>
</head>

<body>


    <div id="map" class="map">
        <!--  <button onclick="wms_layers()" type="button" id="wms_layers_btn" class="btn btn-success btn-sm">Capas Disponibles</button> -->
       
       
        <button onclick="show_hide_querypanel()" type="button" id="query_panel_btn" class="btn btn-success btn-sm">☰ Capas Disponibles</button>
        <div id="legend"></div>
        <button onclick="show_hide_legend()" type="button" id="legend_btn" class="btn btn-success btn-sm">☰ Mostrar Leyenda</button>
        <button onclick="info()" type="button" id="info_btn" class="btn btn-success btn-sm">☰ Mostrar Información</button>
        <button onclick="clear_all()" type="button" id="clear_btn" class="btn btn-warning btn-sm">Borrar</button>


    </div>
    <!-- se optó por meterl el div con id "wms_layers_window dentro del query_tab para que se pueda ocultar cuando sea
    necesario, para ajustar su tamaño es necesario mover la propiedad de style con width de 30% para que no bloquee la 
    pantalla completa a la hora de abrirlo. en elemento que está con clase modal dialog tambien cambiará de tamaño dado que 
    tiene un porcentaje de un ancho maximo en el archivo de style.css que está en la carpeta raiz"-->
    <div id="query_tab">
       
        <div class="modal" id="wms_layers_window" style="width: 30%;" >
         <nav>
            <!--<div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button  type="button" onclick="IraDashBoard()" id="irDashboard" class="btn btn-dark btn-sm">Ir a Coropleta</button>
            </div>-->
            <!--
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <label for="layer"><b>Selecionar Contaminante</b></label>
                <select id="layer" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Contaminante</option>
                </select>
                <br>
                <label for="attributes"><b>Seleccionar Alcaldía</b></label>
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
                    </div>

                <button onclick="query()" type="button" id="BTN-cargarCapa" class="btn btn-danger btn-sm">Cargar Capa</button>

            </div>-->
        </nav>
        <div class="modal-dialog modal-dialog-scrollable" id="movableDialog"  >
            <div class="modal-content" >
                
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Capas Disponibles</h5>
                </div>

                <div class="modal-body">
                    <table id="table_wms_layers" class="table table-hover">
                    </table>
                </div>

                <div class="modal-footer">
                   
                    <button onclick="add_layer()" type="button" id="add_map_btn" class="btn btn-primary btn-sm">Agregar capa al Mapa</button>
                </div>
            </div>
            
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