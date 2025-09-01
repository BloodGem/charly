<?php

$indiceListaFacturasGlobales = array_search("Lista facturas globales",$array,true);

if($indiceListaFacturasGlobales !== false){

    ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> LISTA DE FACTURAS GLOBALES</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">
                        <?php

                        $indiceCrearFacturasGlobales = array_search("crear facturas globales",$array,true);

                        if($indiceCrearFacturasGlobales !== false){

                            ?>
                            <button class="btn btn-primary" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalCrearFacturaGlobal">Crear Factura Global</button>

                            <?php
                        }
                        ?>
                        
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

    $indiceVerFacturasGlobales = array_search("Ver facturas globales",$array,true);

    if($indiceVerFacturasGlobales !== false){

        ?>
        <center>
            <div class="col-sm-6">

              <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text">Busqueda:</span>
                </div>
                <div class="custom-file">
                    <input onkeyup="buscarAhoraFacturasGlobales($('#buscarFacturasGlobales').val());" type="search" class="form-control" id="buscarFacturasGlobales" name="buscarFacturasGlobales" teclaEsc = "si" autocomplete="off" autofocus>
                </div>
            </div>
            
        </div>
    </center>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="incrustarTablaFacturasGlobales"></div>
    </div>
    <?php
}
?>
<!-- /.card-body -->
</div>








<br>
</div>



<?php

}
?>

<div class="modal fade" id="modalCrearFacturaGlobal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Facturar</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal"></div>
            <form method="post" name="formularioCrearFacturaGlobal" id="formularioCrearFacturaGlobal">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4 col-12">
                            <center>
                                <div class="form-group">
                                    <label>TOTAL<big><code>*</code></big>:</label>
                                    <div class="input-group">
                                        <input type="hidden" class="form-control" style="font-size: 30px; height:60px; font-weight:bold;" id="nuevoTotalFactuaGlobal" name="nuevoTotalFactuaGlobal">
                                        <div class="input-group-append">
                          <span class="input-group-text">$</span>
                        </div>
                                        <input type="text" class="form-control" style="font-size: 30px; height:60px; font-weight:bold;" id="mostrarTotalFactuaGlobal" name="mostrarTotalFactuaGlobal">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-sm btn-primary float-right" id="btnTraerTotalVentasRangoFecha">Consultar</button>
                                        </div>
                                    </div>
                                </div>
                            </center>
                        </div>
                        <div class="col-lg-4"></div>

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Fecha Inicial<big><code>*</code></big>:</label>
                                <input type="date" class="form-control" id="nuevaFechaInicial" name="nuevaFechaInicial">

                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Fecha Final<big><code>*</code></big>:</label>
                                <input type="date" class="form-control" id="nuevaFechaFinal" name="nuevaFechaFinal">
                            </div>
                        </div>


                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <label>Periodicidad<big><code>*</code></big>:</label>
                                <select class="form-control" id="nuevoIdPeriodo" name="nuevoIdPeriodo" required>
                                    <option value="">--Seleccione--</option>
                                    <?php

                                    $periodos = ControladorOtros::ctrMostrarPeriodosFG();

                                    foreach ($periodos as $keyPeriodosFG => $valuePeriodosFG) {
                                        echo '<option value="'.$valuePeriodosFG["id_periodo"].'">'.$valuePeriodosFG["periodo"].'</option>';

                                    }
                                    
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <label>Mes(es)<big><code>*</code></big>:</label>
                                <select class="form-control" id="nuevoIdRangoMes" name="nuevoIdRangoMes" required>
                                    <option value="">--Seleccione--</option>
                                    <?php

                                    $rango_meses = ControladorOtros::ctrMostrarRangoMesesFG();

                                    foreach ($rango_meses as $keyRangoMesesFG => $valueRangoMesesFG) {
                                        echo '<option value="'.$valueRangoMesesFG["id_rango_mes"].'">'.$valueRangoMesesFG["rango"].'</option>';

                                    }
                                    
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <label>Año<big><code>*</code></big>:</label>
                                <?php $year = date("Y");
                                echo '<input type="text" class="form-control" id="nuevoYear" name="nuevoYear" value="'.$year.'" required>'; ?>
                                
                            </div>
                        </div>




                    </div>






                    <div class="row" id="esFactura">
                        <div class="col-lg-4 col-12" id="formaPago">
                            <label>Forma de pago<big><code>*</code></big>:</label>
                            <select class="form-control" name="nuevoIdMetodoPagoFacturaGlobal" id="nuevoIdMetodoPagoFacturaGlobal">
                                <option value="PUE">PAGO EN UNA SOLA EXHIBICIÓN</option>
                            </select>
                        </div>

                        <div class="col-lg-4 col-12" id="cfdi">
                            <label>CFDI<big><code>*</code></big>:</label>
                            <select class="form-control" name="nuevoIdCfdiFacturaGlobal" id="nuevoIdCfdiFacturaGlobal">
                                <option value="S01">SIN EFECTOS FISCALES. </option>
                            </select>
                        </div>

                        <div class="col-lg-4 col-12" id="metodoPago">
                            <label>Método pago<big><code>*</code></big>:</label>
                            <select class="form-control" name="nuevoIdFormaPagoFacturaGlobal" id="nuevoIdFormaPagoFacturaGlobal">
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

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary"  id="btnCrearFacturaGlobal">Facturar</button>

                    <?php 
$crearFacturaGlobal = new ControladorFacturasGlobales();
$crearFacturaGlobal -> ctrCrearFacturaGlobal();


?>

</form>
</div>



</div>
</div>
</div>










<div class="modal fade" id="modalVerVentasFacturaGlobal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ventas de la factura global</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div id="incrustarTablaVentasFacturaGlobal">
                  
              </div>
          </div>
          <div class="modal-footer justify-content-between">
          </div>

      </div>
  </div>
</div>




















<div class="modal fade" id="modalTimbrarFacturaGlobal">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioTimbrarFacturaGlobal">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres timbrar la factura global no.<small id="small2IdFacturaGlobal"></small>?</p>
                          <br><br>
                          <input type="text" id="timbrarFacturaGlobal" name="timbrarFacturaGlobal">
                          <br>
                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">No</button>
                          <button type="submit" class="btn btn-primary btn-lg">Si</button>

                      </div>


                  </div>


              </div>



              <?php 
              $timbrar_factura_global = new ControladorFacturasGlobales();
              $timbrar_factura_global -> ctrTimbrarFacturaGlobal();


              ?>
          </form>

      </div>
  </div>
</div>




















<div class="modal fade" id="modalComprimirNotasFacturaGlobal">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioComprimirNotasFacturaGlobal">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres obtener las notas de la factura global no.<small id="smallIdFacturaGlobal"></small>?</p>
                          <br><br>
                          <input type="hidden" id="comprimirNotasFacturaGlobal" name="comprimirNotasFacturaGlobal">
                          <br>
                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">No</button>
                          <button type="submit" class="btn btn-primary btn-lg">Si</button>

                      </div>


                  </div>


              </div>



              <?php 
              $comprimir_notas_factura_global = new ControladorFacturasGlobales();
              $comprimir_notas_factura_global -> ctrComprimirNotasFacturaGlobal();


              ?>
          </form>

      </div>
  </div>
</div>