<?php

echo '<input type="hidden" id="busquedaAnterior" name="busquedaAnterior" value="'.$_GET['busquedaAnterior'].'">';

?>
<div class="content-wrapper">

    <!--CONTENIDO-->
    <div class="card">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> LISTA DE PRODUCTOS</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <?php

                        $indiceCrearProductos = array_search("Crear productos",$array,true);

                        if($indiceCrearProductos == 0){

                        }else if($indiceCrearProductos !== ""){

                            ?>
                            <div class="breadcrumb float-sm-right">
                              <a href="crear-producto">
                                <button class="btn btn-primary" id="btnCrearNuevoProducto">Crear Producto</button>
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

    $indiceVerProductos = array_search("Ver productos",$array,true);

    if($indiceVerProductos == 0){

    }else if($indiceVerProductos !== ""){

        ?>



        <center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input teclaEsc = "si" type="text" class="form-control" id="buscarProductos" name="buscarProductos" autocomplete="off" autofocus>
                      </div>
                    </div>
    
</div>
</center>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="incrustarTablaProductos"></div>
            
            
        </div>
        <?php

    }

    ?>
    <!-- /.card-body -->
</div>








<br>
</div>










<div class="modal fade" id="modalMulticlavesProducto" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Multiclaves producto</h4>
                    <?php

                    $indiceCrearMulticlavesProductos = array_search("Crear multiclaves productos",$array,true);

                    if($indiceCrearMulticlavesProductos !== false){
                    echo'<button type="button" class="btn btn-info" id="btnAgregarMulticlave"><span aria-hidden="true">Agregar</span></button>';

                }

                    ?>
                </div>
                <div class="modal-body">

                    <div id="incrustarTablaMulticlavesProducto">
                  
                  </div>




                    
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>












<div class="modal fade" id="modalCrearMulticlaveProducto">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearMulticlaveProducto">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Multiclave</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Multiclave
                                    <big><code>*</code></big>
                                </label>
                                <input type="text" class="form-control" id="nuevaMulticlaveProducto" name="nuevaMulticlaveProducto" min="1" value="" autocomplete="new-text" required>
                            </div>
                        </div>





                        <div class="col-12">
                            <div class="form-group">
                                <label>Múltiplo de entrega
                                    <big><code>*</code></big>
                                </label>
                                <input type="text" class="form-control" id="nuevoMultiploEntregaclaveProducto" name="nuevoMultiploEntregaclaveProducto" min="1" value="" autocomplete="new-text" required>
                            </div>
                        </div>
                        
                        <input type="hidden" class="form-control" id="idProductoMutlticlaves" name="idProductoMutlticlaves">

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnSubmitCrearMulticlaveProducto">Crear multiclave</button>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>










<div class="modal fade" id="modalEditarMultiploProducto" style="overflow-y: scroll;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cambiar Múltiplo</h4>

                <button type="button" id="cerrar_modal_x" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal"></div>
            <div class="modal-body">


<form method="post" role="form" id="formularioEditarMultiploProducto" name="formularioEditarMultiploProducto" enctype="multipart/form-data">
    
<input type="hidden" id="mostrarIdProductoEMP" name="mostrarIdProductoEMP">

  <div class="row">

    <div class="col-12">
        <div class="form-group">
            <label>Múltiplo actual</label>
            <input type="text" class="form-control" id="mostrarMultiploProductoActual" name="mostrarMultiploProductoActual" readonly>
        </div>
    </div>


    <div class="col-12">
        <div class="form-group">
            <label>Nuevo Múltiplo</label>
            <input type="text" class="form-control" id="nuevoMultiploProducto" name="nuevoMultiploProducto" required>
        </div>
    </div>

  </div>


<hr>


</div>
<div class="modal-footer justify-content-between">
    <button type="button"  class="btn btn-default" id="cerrar_modal_boton" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="btnSubmitEMP">Cambiar Multiplo</button>

</form>
</div>
</div>
</div>

</div>







<?php 

/*$eliminarProducto = new ControladorProductos();
$eliminarProducto -> ctrEliminarProducto();*/

?>