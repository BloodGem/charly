
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> LISTA DE VENTAS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">
                      <a href="crear-venta-filtros">
                        <button class="btn btn-primary" id="btnCrearNuevaVenta">Crear Venta</button>
                    </a>
                </div>
            </div><!-- /.col -->
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
            <input onkeyup="buscarAhoraVentas($('#buscarVentas').val());" teclaEsc = "si" type="text" class="form-control" style="font-weight: bold; font-size: 25px" id="buscarVentas" name="buscarVentas" autofocus>
        </div>
    </div>
    
</div>
</center>
<!-- /.card-header -->
<div class="card-body">
    <div id="incrustarTablaVentas"></div>

</div>
<!-- /.card-body -->
</div>








<br>
</div>





<!--<div class="modal fade" id="modalVerSeguimientoVenta">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Seguimiento venta</h4>

                    <button type="button" class="cerrarModal btn-lg btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal"></div>
                <div class="modal-body">


                    <div class="row">

                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Cliente:</label>
                            <input type="text" class="form-control" id="mostrarNombreCliente" name="mostrarNombreCliente" disabled >
                            <input type="hidden" id="mostrarIdCliente" name="mostrarIdCliente">
                        </div>
                    </div>

                    <div class="col-sm-2 venta">
                      <div class="form-group">
                        <label>Venta:</label>
                        <input type="number" step="any" class="form-control" id="mostrarIdVenta" name="mostrarIdVenta" readonly>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Adeudo inical:</label>
                        <input type="number" step="any" class="form-control" id="mostrarSaldoInicial" name="mostrarAdeudoInicial" disabled readonly>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Adeudo actual:</label>
                        <input type="number" step="any" class="form-control" id="mostrarSaldoActual" name="mostrarSaldoActual" readonly>
                      </div>
                    </div>

                    <div class="col-sm-1">
                        <div class="form-group">
                            <label></label>
                            <center><button class="btn btn-info btnCrearAbono" id_venta="" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalCrearAbono">Crear</button></center>
                      </div>
                    </div>

                  </div>



                    <hr>
                    <table class="table table-bordered table-striped">
            <thead>
                  <tr>
                    <th>Importe</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody id="listaSeguimiento">
                    
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Importe</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                  </tr>
                  </tfoot>
        </table>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalCrearAbono">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            
                <div class="modal-header">
                    <h4 class="modal-title">Crear abono</h4>

                    <button type="button" class="cerrarModal btn-lg btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal"></div>
                <form method="post" name="myForm" id="myForm">
                <div class="modal-body">

                    <div class="row">

                    <div class="col-sm-5">
                      <div class="form-group">
                        <label>Fecha:</label>
                        <input type="text" id="nuevaFechaActual" name="nuevaFechaActual" class="form-control" readonly>
                        <input type="text" id="nuevoIdVenta" name="nuevoIdVenta" readonly>
                        <input type="text" id="nuevoIdCliente" name="nuevoIdCliente" readonly>
                      </div>
                    </div>

                    <div class="col-sm-5">
                      <div class="form-group">
                        <label>Saldo actual:</label>
                        <input type="text" class="form-control" id="saldoActual" name="saldoActual" readonly>
                      </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Movimiento:</label>
                        <select class="form-control" id="nuevoIdFormaPagoCxc" name="nuevoIdFormaPagoCxc" required>
                            <option value="0">--Selecciona--</option>
                                        <?php

                                        /*$formas_pago = ControladorOtros::ctrMostrarFormasDePAgo();

                                        foreach ($formas_pago as $key => $value) {
                                            echo '<option value="'.$value["id_forma_pago"].'">'.$value["descripcion"].'</option>';
                                        }*/

                                        ?>
                                        
                                    </select>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Importe:</label>
                        <input type="number" step="any" class="form-control" id="nuevoImporte" name="nuevoImporte" required>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Documento:</label>
                        <input type="text" class="form-control" id="nuevoDocumento" name="nuevoDocumento">
                      </div>
                    </div>

                  </div>



                  <div class="row">

                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Observaciones:</label>
                        <br>
                        <textarea class="form-control" id="nuevaObservacion" name="nuevaObservacion"></textarea>
                      </div>

                    </div>

                </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="verificarImporte();">Registrar</button>
                </div>

                <?php 
                /*
        $crearCxc = new ControladorCsxc();
        $crearCxc -> ctrCrearCxc();
        */

    ?>

            </form>

        </div>
    </div>
</div>-->










<div class="modal fade" id="modalVerPartidasVenta" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Partidas de la venta</h4>
                <button type="button" class="cerrarModal btn-lg btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div id="incrustarTablaPartidasVenta">

              </div>
          </div>
          <div class="modal-footer justify-content-between">
          </div>z

      </div>
  </div>
</div>










<div class="modal fade" id="modalReimprimirTicketVenta">
    <!--PREFIJO DEL MODAL PARA EL FORM ES: CV = COBRO VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioReimprimirTicket">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres reimprimir este ticket de venta?</p>
                          <input type="hidden" id="reimprimir_ticket_venta" name="reimprimir_ticket_venta">
                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" id="btnNoReimprimirTicket">No</button>
                          <button type="submit" class="btn btn-primary btn-lg" id="btnReimprimirTicket">Si</button>

                      </div>


                  </div>


              </div>



              <?php 
              $reimprimir_ticket_venta = new ControladorVentas();
              $reimprimir_ticket_venta -> ctrReimprimirTicketVenta();


              ?>
          </form>

      </div>
  </div>
</div>










<div class="modal fade" id="modalReimprimirTicketVentaMostrador">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioReimprimirTicketVentaMostrador">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres reimprimir este ticket de venta?</p>
                          <small>Este ticket sale en mostrador</small>
                          <br><br>
                          <input type="hidden" id="reimprimir_ticket_venta_mostrador" name="reimprimir_ticket_venta_mostrador">
                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" id="btnNoReimprimirTicketVentaMostrador">No</button>
                          <button type="submit" class="btn btn-primary btn-lg" id="btnReimprimirTicketVentaMostrador">Si</button>

                      </div>


                  </div>


              </div>



              <?php 
              $reimprimir_ticket_venta_venta = new ControladorVentas();
              $reimprimir_ticket_venta_venta -> ctrReimprimirTicketVentaMostrador();


              ?>
          </form>

      </div>
  </div>
</div>










<div class="modal fade" id="modalReimprimirTicketVentaCaja">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioReimprimirTicketVentaCaja">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres reimprimir este ticket de venta?</p>
                          <small>Este ticket sale en caja</small>
                          <br><br>
                          <input type="hidden" id="reimprimir_ticket_venta_caja" name="reimprimir_ticket_venta_caja">
                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" id="btnNoReimprimirTicketVentaCaja">No</button>
                          <button type="submit" class="btn btn-primary btn-lg" id="btnReimprimirTicketVentaCaja">Si</button>

                      </div>


                  </div>


              </div>



              <?php 
              $reimprimir_ticket_venta_caja = new ControladorVentas();
              $reimprimir_ticket_venta_caja -> ctrReimprimirTicketVentaCaja();


              ?>
          </form>

      </div>
  </div>
</div>










<div class="modal fade" id="modalReenviarFacturaVenta">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioReenviarFacturaVenta">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres reenviar la factura al cliente?</p>
                          <br><br>
                          <input type="hidden" id="reenviar_factura_venta" name="reenviar_factura_venta">
                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" id="btnNoReenviarFacturaVenta">No</button>
                          <button type="submit" class="btn btn-primary btn-lg" id="btnReenviarFacturaVenta">Si</button>

                      </div>


                  </div>


              </div>




              <?php 
              $reenviar_fatura = new ControladorVentas();
              $reenviar_fatura -> ctrReenviarFacturaVenta2();


              ?>
          </form>

      </div>
  </div>
</div>









<div class="modal fade" id="modalTimbrarVenta">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioTimbrarVenta">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres timbrar esta venta?</p>

                          <br>

                          <input type="hidden" id="timbrarVenta" name="timbrarVenta">

                      </div>



                          <div class="col-lg-4 col-12">
                            <label>Método Pago</label>
                            <select class="form-control" name="nuevoIdMetodoPago" id="nuevoIdMetodoPago">
                                <option value="PUE">PAGO EN UNA SOLA EXHIBICIÓN</option>
                                <option value="PPD">PAGO EN PARCIALIDADES O DIFERIDO</option>
                            </select>
                        </div>

                        <div class="col-lg-4 col-12">
                            <label>CFDI</label>
                            <select class="form-control" name="nuevoIdCfdi" id="nuevoIdCfdi">
                                <option value="G03" selected>GASTOS EN GENERAL.</option>
                                <option value="G01">ADQUISICIÓN DE MERCANCÍAS.</option>
                                <option value="S01">SIN EFECTOS FISCALES. </option>
                            </select>
                        </div>

                        <div class="col-lg-4 col-12" id="formaPago">
                            <label>Forma de pago<big><code>*</code></big>:</label>
<select class="form-control" name="nuevoIdFormaPago" id="nuevoIdFormaPago">
<option value="01">EFECTIVO</option>
<option value="02">CHEQUE NOMINATIVO</option>
<option value="03">TRANSFERENCIA ELECTRONICA DE FONDOS</option>
<option value="04">TARJETA DE CREDITO</option>
<option value="05">MONEDERO ELECTRONICO</option>
<option value="06">DINERO ELECTRONICO</option>
<option value="08">VALES DE DESPENSA</option>
<option value="28">TARJETA DE DEBITO</option>
<option value="29">TARJETA DE SERVICIO</option>
</select>
                        </div>

                        <br><br><br><br>
                        <div class="col-sm-12 text-center">
                        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" id="btnNoTimbrarVenta">No</button>

                        <button type="submit" class="btn btn-primary btn-lg" id="btnTimbrarVenta">Si</button>
                    </div>

                    </div>




            </div>



            <?php 
            $timbrar_venta = new ControladorVentas();
            $timbrar_venta -> ctrTimbrarVenta();


            ?>
        </form>

    </div>
</div>
</div>










<div class="modal fade" id="modalCambiarDatosPagoVenta">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Cambiar Datos Pago</h4>

                <button type="button" class="cerrarModal btn-lg btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal"></div>
            <form method="post" name="formularioCDPV" id="formularioCDPV">
                <div class="modal-body">

                    <div class="row">

                        <input type="hidden" id="cambiarDatosPagoVenta" name="cambiarDatosPagoVenta" readonly tabindex="-1">


                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Total venta:</label>
                            <input type="text" class="form-control" id="mostrarTotalVentaCDPV" name="mostrarTotalVentaCDPV" readonly tabindex="-1">
                        </div>
                    </div>
                    <div class="col-lg-5 col-12">
                                <div class="form-group">
                                 <label>Cliente</label>
                                 <div class="input-group">
                                 <select class="form-control-sm select2" id="editarIdClienteCDPV" name="editarIdClienteCDPV" style="width: 100%;">
                        <?php
                          $item = null;
                          $valor = null;

                          $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                          foreach ($clientes as $key => $value) {

                            echo '<option value="'.$value["id_cliente"].'">'.$value["nombre"].' - '.$value["rfc"].'</option>';
                          }
                        ?>
                      </select>


                            </div>
                            </div>
                          </div>

            </div>
            <div class="row">
                <div class="col-lg-3 col-12">
                  <div class="form-group">
                    <label>Efectivo:</label>
                    <input type="number" min="0" step="any" class="form-control" id="editarImporteEfectivoCDPV" name="editarImporteEfectivoCDPV">
                </div>
            </div>

            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label>Tarjeta débito:</label>
                <input type="number" min="0" class="form-control" id="editarImporteTarjetaDebitoCDPV" name="editarImporteTarjetaDebitoCDPV" value="0">
            </div>
        </div>

        <div class="col-lg-3 col-12">
            <div class="form-group">
                <label>Tarjeta Credito:</label>
                <input type="number" min="0" class="form-control" id="editarImporteTarjetaCreditoCDPV" name="editarImporteTarjetaCreditoCDPV" value="0">
            </div>
        </div>

        <div class="col-lg-3 col-12">
            <div class="form-group">
                <label>Transferencia:</label>
                <input type="number" min="0" class="form-control" id="editarImporteTransferenciaCDPV" name="editarImporteTransferenciaCDPV" value="0">
            </div>
        </div>

    </div>
    <br>
    <center>


        <div class="col-lg-4 col-12">
          <div class="form-group">
            <label>Total importe:</label>
            <input type="number" style="text-align: center;" class="form-control" id="editarImporteTotalCDPV" name="editarImporteTotalCDPV" readonly tabindex="-1">
        </div>
    </div>


    <div class="col-lg-4 col-12">
      <div class="form-group">
        <label>Cambio:</label>
        <input type="number" style="text-align: center;" class="form-control" id="editarCambioCobroCDPV" name="editarCambioCobroCDPV" readonly tabindex="-1">
    </div>
</div>






</center>

</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="btnSubmitCDPV">Cambiar Datos</button>
</div>

<?php 
$guardarNuevosDatos = new ControladorVentas();
$guardarNuevosDatos -> ctrGuardarDatosCobro();


?>

</form>

</div>
</div>
</div>















<div class="modal fade" id="modalReenviarTicketWhatsapp">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioReenviarTicketWhatsapp">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres reenviar el ticket al cliente por Whatsapp?</p>
                          <br><br>
                          <input type="hidden" id="reenviar_ticket_whatsapp" name="reenviar_ticket_whatsapp">
                          <input type="hidden" id="envia_celular" name="envia_celular">
                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">No</button>
                          <button type="button" class="btn btn-primary btn-lg" id="btnSiReenviarTicketWhatsapp">Si</button>

                      </div>


                  </div>


              </div>




              <?php 
              $reenviar_ticket = new ControladorVentas();
              $reenviar_ticket -> ctrReenviarTicketWhatsapp();


              ?>
          </form>

      </div>
  </div>
</div>