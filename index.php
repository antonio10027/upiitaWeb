<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web_GIS</title>

    <!-- CSS only -->
   <?php include("includes/estilos.php"); ?>
    
</head>

<body>


    <div id="map" class="map">
        <!--  <button onclick="wms_layers()" type="button" id="wms_layers_btn" class="btn btn-success btn-sm">Capas Disponibles</button> -->
       
        <button onclick="clear_all()" type="button" id="clear_btn" class="btn btn-warning btn-sm">Borrar</button>
        <button onclick="show_hide_querypanel()" type="button" id="query_panel_btn" class="btn btn-success btn-sm">☰ Capas Disponibles</button>
        <div id="legend"></div>
        <button onclick="show_hide_legend()" type="button" id="legend_btn" class="btn btn-success btn-sm">☰ Mostrar Leyenda</button>
        <button onclick="info()" type="button" id="info_btn" class="btn btn-success btn-sm">☰ Mostrar Información</button>


    </div>
    <!-- se optó por meterl el div con id "wms_layers_window dentro del query_tab para que se pueda ocultar cuando sea
    necesario, para ajustar su tamaño es necesario mover la propiedad de style con width de 30% para que no bloquee la 
    pantalla completa a la hora de abrirlo. en elemento que está con clase modal dialog tambien cambiará de tamaño dado que 
    tiene un porcentaje de un ancho maximo en el archivo de style.css que está en la carpeta raiz"-->
    <div id="query_tab">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
           
            </div>
        </nav>
        <div class="modal" id="wms_layers_window" style="width: 30%;" >
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
                    <button onclick="close_wms_window()" type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button onclick="add_layer()" type="button" id="add_map_btn" class="btn btn-primary btn-sm">Add Layer to Map</button>
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
    <!-- Scrollable modal -->





    <script src="map.js"></script>

</body>

</html>