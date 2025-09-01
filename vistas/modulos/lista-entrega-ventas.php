<?php
$indiceListaEntregaVentas = array_search("Lista entrega ventas",$array,true);

if($indiceListaEntregaVentas !== false){
                            ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!--CONTENIDO-->
    <div class="card">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> LISTA DE ENTREGA DE VENTAS</h1>
                    </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


        <center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraEntregaVentas($('#buscarEntregaVentas').val());" type="text" class="form-control" id="buscarEntregaVentas" name="buscarEntregaVentas" autofocus>
                      </div>
                    </div>
    
</div>
</center>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="incrustarTablaEntregaVentas"></div>
           
</div>

<!-- /.card-body -->
</div>








<br>
</div>



<?php

}

?>