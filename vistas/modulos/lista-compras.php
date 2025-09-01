


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!--CONTENIDO-->
    <div class="card">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> LISTA DE COMPRAS</h1>
                    </div><!-- /.col -->
                    
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

    $indiceVerCompras = array_search("Ver compras",$array,true);

    if($indiceVerCompras == 0){
     
    }else if($indiceVerCompras !== ""){

        ?>


        <center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraCompras($('#buscarCompras').val());" teclaEsc = "si" type="search" class="form-control" id="buscarCompras" name="buscarCompras" autocomplete="off" autofocus>
                      </div>
                    </div>
    
</div>
</center>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="incrustarTablaCompras"></div>
</div>
<?php

}

?>
<!-- /.card-body -->
</div>








<br>
</div>








<!--MODAL PARA VER LAS PARTIDAS DE UNA COMPRA-->
<div class="modal fade" id="modalVerPartidasCompra" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Partidas de la compra</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <div id="incrustarTablaPartidasCompra">
                  
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                </div>

        </div>
    </div>
</div>












<div class="modal fade" id="modalConfirmarCompra">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioConfirmarCompra">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres confirmar esta compra?</p>
                          <small>Si confirmas ya no habrá vuelta atrás</small>
                          <br><br>
                          <input type="hidden" id="confirmarCompra" name="confirmarCompra">
                          <input type="hidden" id="es_credito" name="es_credito">
                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" id="btnNoConfirmarCompra">No</button>
                          <button type="button" class="btn btn-primary btn-lg" id="btnSubmitConfirmarCompra">Si</button>

                    </div>


        </div>


</div>



<?php 
$confirmarCompra = new ControladorCompras();
$confirmarCompra -> ctrConfirmarCompra();


?>
</form>

</div>
</div>
</div>










<div class="modal fade" id="modalCancelarCompra">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioCancelarCompra">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres CANCELAR esta compra?</p>
                          <small>Si confirmas ya no habrá vuelta atrás</small>
                          <br><br>
                          <input type="hidden" id="cancelarCompra" name="cancelarCompra">
                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">No</button>
                          <button type="submit" class="btn btn-primary btn-lg">Si</button>

                    </div>


        </div>


</div>



<?php 
$cancelar_compra = new ControladorCompras();
$cancelar_compra -> ctrCancelarCompra();


?>
</form>

</div>
</div>
</div>










<!--<div class="modal fade" id="modalCrearCompraXML">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioCrearCompraXML" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                        
                        <div class="form-group">
                                <label>Inserta tu XML
                                </label>
                                <input type="file" class="form-control" id="xmlCrearCompra" name="xmlCrearCompra" accept=".xml">
                            </div>

                    </div>

                    <br>

                        <div class="col-sm-12 text-center">
                          <button type="button" class="btn btn-primary btn-lg" id="btnSubmitCrearCompraXML">Crear compra</button>

                    </div>


        </div>


</div>



<?php 
/*$crear_compra_xml = new ControladorCompras();
$crear_compra_xml -> ctrCrearCompraXML();*/


?>
</form>

</div>
</div>
</div>-->










<div class="modal fade" id="modalEditarExistenciasProducto" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="formularioEditarProducto" id="formularioEditarProducto" name="formularioEditarProducto">

                        <input type="hidden" id="id_producto" name="id_producto" class="form-control" required readonly>


                        <div class="row">
                  <div class="col-lg-6 col-12 form-group">
                    <label>Descripción</label>
                    <input type="text" id="mostrarDescripcionCortaProducto" name="mostrarDescripcionCortaProducto" class="form-control" readonly>
                  </div>
                  <div class="col-lg-3 col-6 form-group">
                    <label>Ubicación</label>
                    <input type="text" id="editarUbicacion" name="editarUbicacion" class="form-control" required>
                  </div>
                  <div class="col-lg-3 col-6 form-group">
                    <label>Precio de compra C/IVA</label>
                    <input type="number" id="mostrarPrecioCompraIva" name="mostrarPrecioCompraIva" class="form-control">
                    <input type="hidden" id="mostrarPrecioCompra" name="mostrarPrecioCompra" class="form-control">
                  </div>

                  <div class="col-lg-3 col-6 form-group">
                    <label>Existencias</label>
                    <input type="text" id="mostrarStock" name="mostrarStock" class="form-control" readonly>
                  </div>

                  <div class="col-lg-3 col-6 form-group">
                    <label>Existencias mínimas</label>
                    <input type="number" id="editarNivelMinimo" name="editarNivelMinimo" class="form-control">
                  </div>
                  <div class="col-lg-3 col-6 form-group">
                    <label>Existencias medias</label>
                    <input type="text" id="mostrarNivelMedio" name="mostrarNivelMedio" class="form-control" readonly>
                  </div>
                  <div class="col-lg-3 col-6 form-group">
                    <label>Existencias máximas</label>
                    <input type="number" id="editarNivelMaximo" name="editarNivelMaximo" class="form-control">
                  </div>

                  <div class="col-lg-6 col-12">
                    <div class="row">
                  <div class="col-6">
                                    <label>Precio 1 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="editarPrecio1" name="editarPrecio1" step="any" min="0.1" placeholder="" required>
                                </div>
                                <div class="col-6">
                                    <label>Utilidad 1 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="editarUtilidad1" name="editarUtilidad1" step="any" min="0.1" placeholder="" required>
                                </div>

                                <div class="col-6">
                                    <label>Precio 2 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="editarPrecio2" name="editarPrecio2" step="any" min="0.1" placeholder="" required>
                                </div>
                                <div class="col-6">
                                    <label>Utilidad 2 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="editarUtilidad2" name="editarUtilidad2" step="any" min="0.1" placeholder="" required>
                                </div>
                                <div class="col-6">
                                    <label>Precio 3 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="editarPrecio3" name="editarPrecio3" step="any" min="0.1" placeholder="" required>
                                </div>
                                <div class="col-6">
                                    <label>Utilidad 3 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="editarUtilidad3" name="editarUtilidad3" step="any" min="0.1" placeholder="" required>
                                </div>
                            </div>
                        </div><!--row parte de abajo-->

                        <div class="col-lg-6 col-12" id="incrustarDatosInformativosProductoSucursal">
                                
                            </div>
                </div>
</div>
<div class="modal-footer justify-content-center">
    <button type="button" class="btn btn-primary" id="btnSumbitEditarExistenciasProducto">Guardar modificaciones</button>
</div>

</form>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>