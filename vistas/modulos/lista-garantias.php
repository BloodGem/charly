<?php

    $indiceListaGarantias = array_search("Lista de garantias",$array,true);

    if($indiceListaGarantias !== false){

        ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> LISTA DE GARANTIAS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php

    $indiceCrearGarantiasVentas = array_search("Crear garantias de ventas",$array,true);

    if($indiceCrearGarantiasVentas !== false){

        ?>
                    <div class="breadcrumb float-sm-right">
                        <button class="btn btn-info" id="btnCrearNuevaGarantiaVenta">Crear Garantia Venta</button>

                        <?php

                    }

    $indiceCrearGarantiasCompras = array_search("Crear garantias de compras",$array,true);

    if($indiceCrearGarantiasCompras !== false){

        ?>

                        <button class="btn btn-primary" id="btnCrearNuevaGarantiaCompra">Crear Garantia Compra</button>
                        
                    </div>
                    <?php
                        }
                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

    $indiceVerGarantias = array_search("Ver garantias",$array,true);

    if($indiceVerGarantias !== false){

        ?>
    <center>
        <div class="col-sm-6">

          <div class="input-group">
            <div class="input-group-append">
                <span class="input-group-text">Busqueda:</span>
            </div>
            <div class="custom-file">
                <input onkeyup="buscarAhoraGarantias($('#buscarGarantias').val());" teclaEsc = "si" type="text" class="form-control" id="buscarGarantias" name="buscarGarantias" autofocus>
            </div>
        </div>

    </div>
</center>
<!-- /.card-header -->
<div class="card-body">
    <div id="incrustarTablaGarantias"></div>

</div>
<?php
}
?>
<!-- /.card-body -->
</div>








<br>
</div>









<?php


    if($indiceCrearGarantiasVentas !== false){

        ?>
<div class="modal fade" id="modalCrearGarantiaVenta" style="overflow-y: scroll;">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                    <h4 class="modal-title">Nueva Garantia de Venta</h4>
                </div>
            <form method="post" id="formularioCrearGarantiaVenta">

                <input type="hidden" class="form-control" id="nuevoIdProductoVentaSeleccionado" name="nuevoIdProductoVentaSeleccionado" readonly>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>No. Venta 
                                    <big><code>*</code></big>
                                </label>
                                <input type="text" class="form-control" id="nuevoIdVentaGarantia" name="nuevoIdVentaGarantia"  required>
                            </div>
                        </div>


                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                             <label>Clave Producto
                                <big><code>*</code></big>
                            </label>
                            <div class="input-group">
                             <input type="text" class="form-control" id="mostrarClaveProductoVentaSeleccionado" name="mostrarClaveProductoVentaSeleccionado" disabled required>
                             <div class="input-group-append">
                                <div class="input-group-input"><button type="button" id="btnVerPartidasVentaSeleccionada" class="btn-sm btn-info float-right">Ver partidas</button></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label>Precio ($)
                            <big><code>*</code></big>
                        </label>
                        <input type="text" class="form-control" id="nuevoPrecioNetoProductoVentaSeleccionado" name="nuevoPrecioNetoProductoVentaSeleccionado" readonly required>
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label>Cantidad
                            <big><code>*</code></big>
                        </label>
                        <input type="number" class="form-control" id="nuevaCantidadProductoVentaSeleccionado" name="nuevaCantidadProductoVentaSeleccionado"  required>
                    </div>
                </div>


                <div class="col-12">
                    <div class="form-group">
                        <label>Fecha probable de entrega al cliente
                            <big><code>*</code></big>
                        </label>
                        <input type="date" class="form-control" id="nuevaFechaProbable1" name="nuevaFechaProbable1"  required>
                    </div>
                </div>


                <div class="col-12">
                    <div class="form-group">
                        <label>Observaciones
                            <big><code>*</code></big>
                        </label>
                        <textarea class="form-control" id="nuevaDescripcionFalla1" name="nuevaDescripcionFalla1" rows="3" required></textarea>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label>Nombre del Cliente
                            <big><code>*</code></big>
                        </label>
                        <input type="text" class="form-control" id="nuevoNombreCliente" name="nuevoNombreCliente" required>
                    </div>
                </div>

            </div>


        </div>

<div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary" id="btnCrearGarantiaVenta">Crear garantia</button>
                </div>

        <?php 
$crear_garantia = new ControladorGarantias();
$crear_garantia -> ctrCrearGarantiaVenta();


?>
</form>

</div>

</div>
</div>









<div class="modal fade" id="modalPartidasVentaSeleccionada" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Partidas de la Venta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div id="incrustarTablaPartidasVentaSeleccionada">

              </div>
          </div>
          <div class="modal-footer justify-content-between">
          </div>

      </div>
  </div>
</div>

<?php 
} 
?>






<?php


    if($indiceCrearGarantiasCompras !== false){

        ?>
<div class="modal fade" id="modalCrearGarantiaCompra">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                    <h4 class="modal-title">Nueva Garantia de Compra</h4>
                </div>
            <form method="post" id="formularioCrearGarantiaCompra">

                <input type="hidden" class="form-control" id="nuevoIdProductoCompraSeleccionado" name="nuevoIdProductoCompraSeleccionado" readonly>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-12">
                    <div class="form-group">
                        <label>Proveedor
                            <big><code>*</code></big>
                        </label>
                        <input type="text" class="form-control" id="mostrarNombreProveedor" name="mostrarNombreProveedor" readonly>
                    </div>
                </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>No. Compra 
                                    <big><code>*</code></big>
                                </label>
                                <input type="text" class="form-control" id="nuevoIdCompraGarantia" name="nuevoIdCompraGarantia"  required>
                            </div>
                        </div>


                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                             <label>Clave Producto
                                <big><code>*</code></big>
                            </label>
                            <div class="input-group">
                             <input type="text" class="form-control" id="mostrarClaveProductoCompraSeleccionado" name="mostrarClaveProductoCompraSeleccionado" disabled required>
                             <div class="input-group-append">
                                <div class="input-group-input"><button type="button" id="btnVerPartidasCompraSeleccionada" class="btn-sm btn-info float-right">Ver partidas</button></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label>Precio ($)
                            <big><code>*</code></big>
                        </label>
                        <input type="text" class="form-control" id="nuevoPrecioNetoProductoCompraSeleccionado" name="nuevoPrecioNetoProductoCompraSeleccionado" readonly required>
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label>Cantidad
                            <big><code>*</code></big>
                        </label>
                        <input type="number" class="form-control" id="nuevaCantidadProductoCompraSeleccionado" name="nuevaCantidadProductoCompraSeleccionado"  required>
                    </div>
                </div>



                <div class="col-12">
                    <div class="form-group">
                        <label>Descripción de la falla</label>
                        <textarea class="form-control" id="nuevaDescripcionFalla1" name="nuevaDescripcionFalla1" rows="3" placeholder="">N/A</textarea>
                    </div>
                </div>

                

            </div>


        </div>

<div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary" id="btnCrearGarantiaCompra">Crear garantia</button>
                </div>

        <?php 
$crear_garantia = new ControladorGarantias();
$crear_garantia -> ctrCrearGarantiaCompra();


?>
</form>

</div>

</div>
</div>










<div class="modal fade" id="modalPartidasCompraSeleccionada" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Partidas de la Compra</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div id="incrustarTablaPartidasCompraSeleccionada">

              </div>
          </div>
          <div class="modal-footer justify-content-between">
          </div>

      </div>
  </div>
</div>

<?php 
} 
?>









<div class="modal fade" id="modalReimprimirTicketGarantia">
    <!--PREFIJO DEL MODAL PARA EL FORM ES: CV = COBRO VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioReimprimirTicket">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres reimprimir este ticket de devolución?</p>
                          <input type="hidden" id="reimprimir_ticket_garantia" name="reimprimir_ticket_garantia">
                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" id="btnNoReimprimirTicket">No</button>
                          <button type="submit" class="btn btn-primary btn-lg" id="btnReimprimirTicket">Si</button>

                      </div>


                  </div>


              </div>



              <?php 
/*$reimprimir_ticket_garantias = new ControladorGarantias();
$reimprimir_ticket_garantias -> ctrReimprimirTicketGarantia();*/


?>
</form>

</div>
</div>
</div>










<div class="modal fade" id="modalAutorizarGarantia" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Autorizar Garantia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" id="formularioAutorizarGarantia">
                <input type="hidden" class="form-control" id="autorizarGarantia" name="autorizarGarantia">
            <div class="modal-body">
                <div class="row">
              <div class="col-12">
                            <label>Quién autoriza?
                                <big><code>*</code></big>
                            </label>
                            <select class="form-control" id="quienAutoriza" name="quienAutoriza" required>
                                <option value="">--Selecciona--</option>
                                <option value="1">Proveedor</option>
                                <option value="2">Refaccionaria</option>
                            </select>
                        </div>
                    </div>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="submit" class="btn btn-primary" id="btnSubmitAutorizarGarantia">Autorizar</button>
          </div>

          <?php 
$crear_garantia = new ControladorGarantias();
$crear_garantia -> ctrAutorizarGarantia();


?>
</form>

      </div>
  </div>
</div>










<div class="modal fade" id="modalConfirmarGarantia" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmar Garantia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" id="formularioConfirmarGarantia">
                <input type="hidden" class="form-control" id="confirmarGarantia" name="confirmarGarantia">
                <input type="hidden" class="form-control" id="tipoCambio" name="tipoCambio">
            <div class="modal-body">
                <div class="row">
              <div class="col-lg-6 col-12">
                <center>
                <button type="button" class="btn-lg btn-info btnSubmitAutorizarGarantia" tipo_cambio="1">Cambio Físico</button>
            </center>
                        </div>

                        <div class="col-lg-6 col-12">
                            <center>
                <button type="button" class="btn-lg btn-primary btnSubmitAutorizarGarantia" tipo_cambio="2">En efectivo</button>
            </center>
                        </div>
                    </div>
          </div>

          <?php 
$crear_garantia = new ControladorGarantias();
$crear_garantia -> ctrConfirmarGarantia();


?>
</form>

      </div>
  </div>
</div>










<div class="modal fade" id="modalEditarGarantiaProveedor" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Envio de Productos al PROVEEDOR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="post" id="formularioEditarGarantiaProveedor">
                <input type="hidden" class="form-control" id="editarGarantiaProveedor" name="editarGarantiaProveedor">
            <div class="modal-body">
                <div class="row">
<div class="col-lg-6 col-12">
    <div class="form-group">
    <label>Fecha Envio</label>
    <input type="date" class="form-control" id="editarFechaEnvio" name="editarFechaEnvio">
                    </div>
                </div>


<div class="col-lg-6 col-12">
    <div class="form-group">
    <label>Fecha Regreso</label>
    <input type="date" class="form-control" id="editarFechaRegreso" name="editarFechaRegreso">
                    </div>
                </div>


<div class="col-12">
    <div class="form-group">
    <label>Valida Garantia</label>
    <select class="form-control" id="editarValidaGarantia" name="editarValidaGarantia">
                                <option value="">--Selecciona--</option>
                                <option value="1">Producto (Pieza)</option>
                                <option value="2">Efectivo (Dinero)</option>
                            </select>
                    </div>
                </div>



                <div class="col-12">
                    <div class="form-group">
                        <label>Observaciones
                        </label>
                        <textarea class="form-control" id="editarObservaciones" name="editarObservaciones" rows="3"></textarea>
                    </div>
                </div>




                <div class="col-lg-6 col-12">
                            <center>
                <button type="submit" class="btn-lg btn-primary">Guardar cambios</button>
            </center>
                        </div>


</div>
          </div>

          <?php 
$editar_envio_productos_proveedor = new ControladorGarantias();
$editar_envio_productos_proveedor -> ctrEditarGarantiaProveedor();


?>
      </form>


      </div>
  </div>
</div>










<div class="modal fade" id="modalConfirmar2Garantia" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <form method="post" id="formularioConfirmar2Garantia">
                <input type="hidden" class="form-control" id="confirmar2Garantia" name="confirmar2Garantia">
            <div class="modal-body">
                <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres confirmar la garantia?</p>

                          <br><br>

                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" id="btnNoConfirmar2Garantia">No</button>

                          <button type="submit" class="btn btn-primary btn-lg" id="btnConfirmar2Garantia">Si</button>

                    </div>


        </div>
          </div>

          <?php 
$crear_garantia = new ControladorGarantias();
$crear_garantia -> ctrConfirmar2Garantia();


?>
</form>

      </div>
  </div>
</div>











<div class="modal fade" id="modalInformacionGarantia" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">GARANTÍA</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div id="incrustarInformacionGarantia">

              </div>
          </div>
          <div class="modal-footer justify-content-between">
          </div>

      </div>
  </div>
</div>







<?php
    }
?>

