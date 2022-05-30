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
        <button onclick="wms_layers()" type="button" id="wms_layers_btn" class="btn btn-success btn-sm">Capas Disponibles</button>
        <button onclick="clear_all()" type="button" id="clear_btn" class="btn btn-warning btn-sm">Borrar</button>
        <button onclick="show_hide_querypanel()" type="button" id="query_panel_btn" class="btn btn-success btn-sm">☰ Capas Disponibles</button>
        <div id="legend"></div>
        <button onclick="show_hide_legend()" type="button" id="legend_btn" class="btn btn-success btn-sm">☰ Mostrar Leyenda</button>
        <button onclick="info()" type="button" id="info_btn" class="btn btn-success btn-sm">☰ Mostrar Información</button>


    </div>
    <div id="query_tab">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Seleccionar por Atributos</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <label for="layer"><b>Selecionar Capa</b></label>
                <select id="layer" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Seleccionar Capa</option>
                </select>
                <br>
                <label for="attributes"><b>Seleccionar Atributo</b></label>
                <select id="attributes" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Seleccionar Atributo</option>
                </select>
                <br>
                <label for="operator"><b>Seleccionar Operador</b></label>
                <select id="operator" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Seleccionar Operador</option>
                </select>
                <br>
                <label for="value">Valor</label>
                <input type="text" class="form-control form-select-sm" id="value" name="value">
                <br>
                <button onclick="query()" type="button" class="btn btn-danger btn-sm">Cargar Capa</button>

            </div>
        </div>

    </div>

    <div id="table_data"></div>
    <!-- Scrollable modal -->

    <div class="modal fade" id="wms_layers_window" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" id="movableDialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Available WMS Layers</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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




    <script src="map.js"></script>

</body>

</html>