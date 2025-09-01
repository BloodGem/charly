


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!--CONTENIDO-->
    <div class="card">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> LISTA DE AJUSTE DE INVENTARIO</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <?php

                        $indiceCrearAjustesInventario = array_search("Crear ajustes de inventario",$array,true);

                        if($indiceCrearAjustesInventario == 0){
                         
                        }else if($indiceCrearAjustesInventario !== ""){

                            ?>
                            <div class="breadcrumb float-sm-right">
                              <a href="crear-ajuste-inventario" accesskey="1">
                                <button class="btn btn-primary" id="btnCrearNuevoAjusteInventario">Crear Ajuste de Inventario</button>
                            </a>
                        </div>
                        <?php

                    }

                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

    $indiceVerAjustesInventario = array_search("Ver ajustes de inventario",$array,true);

    if($indiceVerAjustesInventario == 0){
     
    }else if($indiceVerAjustesInventario !== ""){

        ?>


        <center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraAjustesInventario($('#buscarAjustesInventario').val());" teclaEsc = "si" type="search" class="form-control" id="buscarAjustesInventario" name="buscarAjustesInventario" autocomplete="off" autofocus>
                      </div>
                    </div>
    
</div>
</center>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="incrustarTablaAjustesInventario"></div>
</div>
<?php

}

?>
<!-- /.card-body -->
</div>








<br>
</div>








<!--MODAL PARA VER LAS PARTIDAS DE UNA COMPRA-->
<div class="modal fade" id="modalVerPartidasAjusteInventario" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Partidas del ajuste de inventario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <div id="incrustarTablaPartidasAjusteInventario">
                  
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                </div>

        </div>
    </div>
</div>