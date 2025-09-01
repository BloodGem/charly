<?php

                        $indiceCaja = array_search("Caja",$array,true);

if($indiceCaja == 0){
   
}else if($indiceCaja !== ""){

    ?>
<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> LISTA DE CORTES DE CAJA <?php echo $_SESSION['id_corte_caja']; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php

                        /*$indiceCrearCajas = array_search("Crear cajas",$array,true);

if($indiceCrearCajas == 0){
   
}else if($indiceCrearCajas !== ""){*/

    ?>
                    <div class="breadcrumb float-sm-right">
                        <button class="btn btn-primary" id="btnCrearCorte" id_usuario="<?php echo $_SESSION['id'] ?>">Crear corte</button>
                    </div>
                    <?php

                //}

    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

                        /*$indiceVerGrupos = array_search("Ver cajas",$array,true);

if($indiceVerGrupos == 0){
   
}else if($indiceVerGrupos !== ""){*/

    ?>
   



        <center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraCortesCaja($('#buscarCortesCaja').val());" teclaEsc = "si" type="search" class="form-control" id="buscarCortesCaja" name="buscarCortesCaja" autocomplete="off" autofocus>
                      </div>
                    </div>
    
</div>
</center>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="incrustarTablaCortesCaja"></div>
        
    </div>
    <?php

//}

    ?>
    <!-- /.card-body -->
</div>








<br>
</div>









<div class="modal fade" id="modalVerCorteCaja" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">CORTE</h4>
                <button type="button" class="btn-lg btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post">
             
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="input-group input-group-sm">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-disabled btn-flat" disabled>NO. CORTE</button>
                                </span>
                                <input type="number" id="mostrarIdCorteCaja" name="mostrarIdCorteCaja" class="form-control" readonly>
                                
                            </div>
                        </div>



                    <div class="col-sm-4">
                    <div class="input-group input-group-sm">
                        <span class="input-group-append">
                        <button type="button" class="btn btn-disabled btn-flat" disabled>APERTURA</button>
                      </span>
                      <input type="text" id="mostrarAperturaCorteCaja" name="mostrarAperturaCorteCaja" class="form-control" disabled>
                      
                    </div>
                  </div>


              <div class="col-sm-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-append">
                    <button type="button" class="btn btn-disabled btn-flat" disabled>FECHA</button>
                  </span>
                  <input type="text" id="mostrarFechaCorteCaja" name="mostrarFechaCorteCaja" class="form-control" disabled>
                  
                </div>
              </div>


              </div>


                <br>

              <div class="row">
                    <div class="col-sm-3">
                <div class="input-group input-group-sm">
                  <div class="input-group-append">
                        <span class="input-group-text">0.5 X</span>
                      </div>
                  <input type="number" step="any" id="cantidadCentavos" name="cantidadCentavos" min="0" class="form-control">
                  <input type="number" style="text-align: right;" step="any" id="totalCentavos" name="totalCentavos" class="form-control" readonly>
                  
                </div>
              </div>

              <div class="col-sm-3">
                <div class="input-group input-group-sm">
                  <div class="input-group-append">
                        <span class="input-group-text">1 X</span>
                      </div>
                  <input type="number" step="any" min="0" id="cantidadUnPeso" name="cantidadUnPeso" class="form-control">
                  <input type="number" style="text-align: right;" step="any" id="totalUnPeso" name="totalUnPeso" class="form-control" readonly>
                  
                </div>
              </div>



              <div class="col-sm-3">
                <div class="input-group input-group-sm">
                  <div class="input-group-append">
                        <span class="input-group-text">2 X</span>
                      </div>
                  <input type="number" step="any" min="0" id="cantidadDosPesos" name="cantidadDosPesos" class="form-control">
                  <input type="number" style="text-align: right;" step="any" id="totalDosPesos" name="totalDosPesos" class="form-control" readonly>
                  
                </div>
              </div>


              <div class="col-sm-3">
                <div class="input-group input-group-sm">
                  <div class="input-group-append">
                        <span class="input-group-text">5 X</span>
                      </div>
                  <input type="number" step="any" min="0" id="cantidadCincoPesos" name="cantidadCincoPesos" class="form-control">
                  <input type="number" style="text-align: right;" step="any" id="totalCincoPesos" name="totalCincoPesos" class="form-control" readonly>
                  
                </div>
              </div>


              
              </div>
              <br>
              <div class="row">
                    <div class="col-sm-3">
                <div class="input-group input-group-sm">
                  <div class="input-group-append">
                        <span class="input-group-text">10 X</span>
                      </div>
                  <input type="number" step="any" min="0" id="cantidadDiezPesos" name="cantidadDiezPesos" class="form-control">
                  <input type="number" style="text-align: right;" step="any" id="totalDiezPesos" name="totalDiezPesos" class="form-control" readonly>
                  
                </div>
              </div>

              <div class="col-sm-3">
                <div class="input-group input-group-sm">
                  <div class="input-group-append">
                        <span class="input-group-text">20 X</span>
                      </div>
                  <input type="number" step="any" min="0" id="cantidadVeintePesos" name="cantidadVeintePesos" class="form-control">
                  <input type="number" style="text-align: right;" step="any" id="totalVeintePesos" name="totalVeintePesos" class="form-control" readonly>
                  
                </div>
              </div>



              <div class="col-sm-3">
                <div class="input-group input-group-sm">
                  <div class="input-group-append">
                        <span class="input-group-text">50 X</span>
                      </div>
                  <input type="number" step="any" min="0" id="cantidadCincuentaPesos" name="cantidadCincuentaPesos" class="form-control">
                  <input type="number" style="text-align: right;" step="any" id="totalCincuentaPesos" name="totalCincuentaPesos" class="form-control" readonly>
                  
                </div>
              </div>


              <div class="col-sm-3">
                <div class="input-group input-group-sm">
                  <div class="input-group-append">
                        <span class="input-group-text">100 X</span>
                      </div>
                  <input type="number" step="any" min="0" id="cantidadCienPesos" name="cantidadCienPesos" class="form-control">
                  <input type="number" style="text-align: right;" step="any" id="totalCienPesos" name="totalCienPesos" class="form-control" readonly>
                  
                </div>
              </div>


              
              </div>



              <br>
              <div class="row">
                <div class="col-sm-3">
                    <div class="input-group input-group-sm">
                        <div class="input-group-append">
                            <span class="input-group-text">200 X</span>
                        </div>
                        <input type="number" step="any" min="0" id="cantidadDoscientosPesos" name="cantidadDoscientosPesos" class="form-control">
                        <input type="number" style="text-align: right;" step="any" id="totalDoscientosPesos" name="totalDoscientosPesos" class="form-control" readonly>
                    </div>
                </div>

              <div class="col-sm-3">
                <div class="input-group input-group-sm">
                  <div class="input-group-append">
                        <span class="input-group-text">500 X</span>
                      </div>
                  <input type="number" step="any" min="0" id="cantidadQuinientosPesos" name="cantidadQuinientosPesos" class="form-control">
                  <input type="number" style="text-align: right;" step="any" id="totalQuinientosPesos" name="totalQuinientosPesos" class="form-control" readonly>
                  
                </div>
              </div>



              <div class="col-sm-3">
                <div class="input-group input-group-sm">
                  <div class="input-group-append">
                        <span class="input-group-text">1000 X</span>
                      </div>
                  <input type="number" step="any" min="0" id="cantidadMilPesos" name="cantidadMilPesos" class="form-control">
                  <input type="number" style="text-align: right;" step="any" id="totalMilPesos" name="totalMilPesos" class="form-control" readonly>
                  
                </div>
              </div>


              <div class="col-sm-3">
                <div class="input-group input-group-sm">
                  <div class="input-group-append">
                        <span class="input-group-text">Total efectivo</span>
                      </div>
                  <input type="text" style="text-align: right;" step="any" id="totalEfectivo" name="totalEfectivo" class="form-control" readonly>
                  
                </div>
              </div>


              
              </div>





              <br>



              <div class="row">
                <div class="col-sm-4">
                    <div class="input-group input-group-sm">
                        <table class="table table-sm table-striped">
                            <thead>
                                <th>Forma de cobro</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>EFECTIVO</td>
                                    <td><div class="input-group input-group-sm">
                        <input type="text" style="text-align: right;" class="form-control" id="totalEfectivoVentas" name="totalEfectivoVentas" readonly>
                </div></td>
                                </tr>
                                <tr>
                                    <td>TARJETA DEBITO</td>
                                    <td><div class="input-group input-group-sm">
                        <input type="text" style="text-align: right;" class="form-control" id="totalTarjetaDebitoVentas" name="totalTarjetaDebitoVentas" readonly>

                </div></td>
                                </tr>
                                <!--<tr>
                                    <td>RETIROS DEBITO PERSONAL(+)</td>
                                    <td><div class="input-group input-group-sm">
                        <input type="text" style="text-align: right;" class="form-control" id="totalTarjetaDebitoRetiros" name="totalTarjetaDebitoRetiros" readonly>
                        
                </div></td>
                                </tr>-->


                                <input type="hidden" style="text-align: right;" class="form-control" id="totalTarjetaDebitoRetiros" name="totalTarjetaDebitoRetiros" readonly><!--se reemplazo por el comentario de arriba-->
                                <tr>
                                    <td>TARJETA CREDITO</td>
                                    <td><div class="input-group input-group-sm">
                        <input type="text" style="text-align: right;" class="form-control" id="totalTarjetaCreditoVentas" name="totalTarjetaCreditoVentas" readonly>
                </div></td>
                                </tr>
                                <tr>
                                    <td>TRANSFERENCIA</td>
                                    <td><div class="input-group input-group-sm">
                        <input type="text" style="text-align: right;" class="form-control" id="totalTransferenciaVentas" name="totalTransferenciaVentas" readonly>
                </div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-2"></div>

              <div class="col-sm-6">
                <div class="input-group input-group-sm">
                  <div class="input-group-append">
                        <span class="input-group-text">TOTAL DE VENTAS</span>
                      </div>
                  <input type="text" style="text-align: right;" step="any" id="totalVentasVCC" name="totalVentasVCC" class="form-control" readonly>
                  
                </div>
              <br>
                <div class="input-group input-group-sm">
                  <table class="table table-sm table-striped">
                            <thead>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>SALDO INICIAL +</td>
                                    <td><div class="input-group input-group-sm">
                        <input type="text" style="text-align: right;" class="form-control" id="mostrarAperturaVCC" name="mostrarAperturaVCC" readonly>
                </div></td>
                                </tr>
                                <tr>
                                    <td>EFECTIVO +</td>
                                    <td><div class="input-group input-group-sm">
                        <input type="text" style="text-align: right;" class="form-control" id="totalEfectivoVentasVCC" name="totalEfectivoVentasVCC" readonly>
                </div></td>
                                </tr>
                                <tr>
                                    <td>CASH -</td>
                                    <td><div class="input-group input-group-sm">
                        <input type="text" style="text-align: right;" class="form-control" id="totalRetirosVCC" name="totalRetirosVCC" readonly>
                </div></td>
                                </tr>
                                <!--<tr>
                                    <td>BAÚL -</td>
                                    <td><div class="input-group input-group-sm">
                        <input type="text" style="text-align: right;" class="form-control" id="totalRetirosBaulVCC" name="totalRetirosBaulVCC" readonly>
                </div></td>
                                </tr>-->
                                <input type="hidden" style="text-align: right;" class="form-control" id="totalRetirosBaulVCC" name="totalRetirosBaulVCC" readonly><!--se reemplazo por el comentario de arriba-->


                                <tr>
                                    <td>DEVOLUCIONES -</td>
                                    <td><div class="input-group input-group-sm">
                        <input type="text" style="text-align: right;" class="form-control" id="totalDevolucionesVCC" name="totalDevolucionesVCC" readonly>
                </div></td>
                                </tr>
                                <tr>
                                    <td>GARANTIAS -</td>
                                    <td><div class="input-group input-group-sm">
                        <input type="text" style="text-align: right;" class="form-control" id="totalGarantiasVCC" name="totalGarantiasVCC" readonly>
                </div></td>
                                </tr>
                                <tr>
                                    <td>TOTAL</td>
                                    <td><div class="input-group input-group-sm">
                        <input type="text" style="text-align: right;" class="form-control" id="totalCorteVCC" name="totalCorteVCC" readonly>
                </div></td>
                                </tr>

                                <?php

                        $indiceVerDiferenciaCorteCaja = array_search("Ver diferencia corte caja",$array,true);

if($indiceVerDiferenciaCorteCaja !== false){

    ?>
                                <tr>
                                    <td>DIFERENCIA</td>
                                    <td><div class="input-group input-group-sm">
                        <input type="text" style="text-align: right;" class="form-control" id="totalDiferenciaCC" name="totalDiferenciaCC" readonly>
                </div></td>
                                </tr>

                                <?php
                            }
                                ?>
                            </tbody>
                        </table>
                </div>
              </div>

              
              </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-info" id="btnRefrescarVerCorteCaja">Refrescar</button>
                <button type="submit" class="btn btn-primary" id="btnSubmitEditarCorteCaja">Guardar modificaciones</button>
                <?php 

                $editarCaja = new ControladorCajas();
                $editarCaja -> ctrEditarCorteCaja();

            ?>

        </form>
            </div>

            

            
        </div>
    </div>
</div>




















<div class="modal fade" id="modalVerRetirosCorteCaja" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Retiros del corte de caja</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal"></div>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-sm-2">
                            <div class="input-group input-group-sm">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-disabled btn-flat" disabled>NO. CORTE</button>
                                </span>
                                <input type="text" id="mostrarIdCorteCajaVRCC" name="mostrarIdCorteCajaVRCC" class="form-control" readonly>
                                
                            </div>
                        </div>

                        <div class="col-sm-1"></div>

                    <div class="col-sm-4">
                    <div class="input-group input-group-sm">
                        <span class="input-group-append">
                        <button type="button" class="btn btn-disabled btn-flat" disabled>EFECTIVO DISPONIBLE</button>
                      </span>
                      <input type="text" id="mostrarEfectivoDisponible" name="mostrarEfectivoDisponible" class="form-control" readonly>
                    </div>
                  </div>

                  <div class="col-sm-1"></div>


              <div class="col-sm-4">
                  <div class="form-group">
                            <center><button class="btn-sm btn-info btnCrearRetiroCorteCaja" id_corte_caja="" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalCrearRetiroCorteCaja">Crear retiro de efectivo</button></center>
                    </div>
              </div>


              </div>



                    <hr>


                  <div id="incrustarTablaRetirosCorteCaja"></div>


                  
                </div>
                <div class="modal-footer justify-content-between">
                </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalCrearRetiroCorteCaja" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
                <div class="modal-header">
                    <h4 class="modal-title">Crear gasto</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal"></div>
                <form method="post" enctype="multipart/form-data" name="myForm" id="myForm">
                <div class="modal-body">

                    <div class="row">

                    <div class="col-sm-5 col-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>No. corte caja:</label>
                        <input type="text" id="mostrarIdCorteCajaCRCC" name="mostrarIdCorteCajaCRCC" class="form-control" readonly>
                      </div>
                    </div>

                    <div class="col-sm-5 col-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Efectivo disponible:</label>
                        <input type="text" class="form-control" id="mostrarEfectivoDisponibleCRCC" name="mostrarEfectivoDisponibleCRCC" readonly required>
                        
                      </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Comprobante:</label>
                        <input type="file" class="form-control" id="nuevoArchivoCRCC" name="nuevoArchivoCRCC">
                      </div>
                    </div>


                </div>
                <div class="row">

                    <div class="col-sm-9 col-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Motivo:</label>
                        <br>
                        <textarea class="form-control" id="nuevaDescripcionCRCC" name="nuevaDescripcionCRCC" required></textarea>
                      </div>

                    </div>

 

                    <div class="col-sm-3 col-12">
                      <div class="form-group">
                        <label>Importe:</label>
                        <input type="number" step="any" class="form-control" id="nuevoImporteCRCC" name="nuevoImporteCRCC" required>
                      </div>
                    </div>



                    <!--<div class="col-12">
                          <center>
                            <div class="icheck-success d-inline">
                        <input type="checkbox" class="form-control" name="nuevoTipoRetiroCRCC" id="nuevoTipoRetiroCRCC" value="1">
                        
                        <label for="nuevoTipoRetiroCRCC">
                          ¿Es para empleado?
                        </label>
                      </div>
                      </center>
                        </div>-->



                  </div>


                </div>
                    
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-info" id="btnRefrescarEfectivoCRCC">Refrescar</button>
                    <button class="btn btn-primary" onclick="verificarImporteCRCC();">Registrar</button>
                </div>

                <?php 
        $crearRetiroCorteCaja = new ControladorCajas();
        $crearRetiroCorteCaja -> ctrCrearRetiroCorteCaja();

    ?>

            </form>

        </div>
    </div>
</div>











<div class="modal fade" id="modalVerRetirosBaulCorteCaja" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Retiros para Baúl del corte de caja</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal"></div>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-sm-2">
                            <div class="input-group input-group-sm">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-disabled btn-flat" disabled>NO. CORTE</button>
                                </span>
                                <input type="text" id="mostrarIdCorteCajaVRBCC" name="mostrarIdCorteCajaVRBCC" class="form-control" readonly>
                                
                            </div>
                        </div>

                        <div class="col-sm-1"></div>

                    <div class="col-sm-4">
                    <div class="input-group input-group-sm">
                        <span class="input-group-append">
                        <button type="button" class="btn btn-disabled btn-flat" disabled>EFECTIVO DISPONIBLE</button>
                      </span>
                      <input type="text" id="mostrarEfectivoDisponible2" name="mostrarEfectivoDisponible2" class="form-control" readonly>
                    </div>
                  </div>

                  <div class="col-sm-1"></div>


              <div class="col-sm-4">
                  <div class="form-group">
                            <center><button class="btn-sm btn-info btnCrearRetiroBaulCorteCaja" id_corte_caja="" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalCrearRetiroBaulCorteCaja">Crear retiro de efectivo para Baúl</button></center>
                    </div>
              </div>


              </div>



                    <hr>


                  <div id="incrustarTablaRetirosBaulCorteCaja"></div>


                  
                </div>
                <div class="modal-footer justify-content-between">
                </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalCrearRetiroBaulCorteCaja" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
                <div class="modal-header">
                    <h4 class="modal-title">Crear retiro para baúl</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal"></div>
                <form method="post" enctype="multipart/form-data" name="formularioCRBCC" id="formularioCRBCC">
                <div class="modal-body">

                    <div class="row">

                    <div class="col-sm-5 col-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>No. corte caja:</label>
                        <input type="text" id="mostrarIdCorteCajaCRBCC" name="mostrarIdCorteCajaCRBCC" class="form-control" readonly>
                      </div>
                    </div>

                    <div class="col-sm-5 col-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Efectivo disponible:</label>
                        <input type="text" class="form-control" id="mostrarEfectivoDisponibleCRBCC" name="mostrarEfectivoDisponibleCRBCC" readonly required>
                        
                      </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Comprobante:</label>
                        <input type="file" class="form-control" id="nuevoArchivoCRBCC" name="nuevoArchivoCRBCC">
                      </div>
                    </div>


                </div>
                <div class="row">


                    <div class="col-sm-9 col-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Observaciones:</label>
                        <br>
                        <textarea class="form-control" id="nuevaObservacionCRBCC" name="nuevaObservacionCRBCC" required></textarea>
                      </div>

                    </div>

 

                    <div class="col-sm-3 col-12">
                      <div class="form-group">
                        <label>Importe:</label>
                        <input type="number" step="any" class="form-control" id="nuevoImporteCRBCC" name="nuevoImporteCRBCC" required>
                      </div>
                    </div>





                  </div>


                </div>
                    
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-info" id="btnRefrescarEfectivoCRBCC">Refrescar</button>
                    <button class="btn btn-primary" onclick="verificarImporteCRBCC();">Registrar</button>
                </div>

                <?php 
        $crearRetiroBaulCorteCaja = new ControladorCajas();
        $crearRetiroBaulCorteCaja -> ctrCrearRetiroBaulCorteCaja();

    ?>

            </form>

        </div>
    </div>
</div>










<div class="modal fade" id="mostrarPDF">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            
                <div class="modal-header">

                    <h4 class="modal-title">PDF</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    
                </div>
                <div class="modal"></div>
                <div class="modal-body">
                  <div id="PDF"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>

 
        </div>
    </div>
</div>











<div class="modal fade" id="modalReimprimirTicketRetiroCorteCaja">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioReimprimirTicketRetiroCorteCaja">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres reimprimir este ticket de gasto?</p>
                          <small>Este ticket sale en caja</small>
                          <br><br>
                          <input type="hidden" id="reimprimir_ticket_retiro_corte_caja" name="reimprimir_ticket_retiro_corte_caja">
                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" id="btnNoReimprimirTicketRetiroCorteCaja">No</button>
                          <button type="submit" class="btn btn-primary btn-lg" id="btnReimprimirTicketRetiroCorteCaja">Si</button>

                    </div>


        </div>


</div>



<?php 
$reimprimir_ticket_retiro_corte_caja = new ControladorCajas();
$reimprimir_ticket_retiro_corte_caja -> ctrReimprimirTicketRetiroCorteCaja();


?>
</form>

</div>
</div>
</div>










<div class="modal fade" id="modalReimprimirTicketRetiroBaulCorteCaja">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioReimprimirTicketRetiroBaulCorteCaja">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres reimprimir este ticket de retiro para baúl?</p>
                          <small>Este ticket sale en caja</small>
                          <br><br>
                          <input type="hidden" id="reimprimir_ticket_retiro_baul_corte_caja" name="reimprimir_ticket_retiro_baul_corte_caja">
                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" id="btnNoReimprimirTicketRetiroBaulCorteCaja">No</button>
                          <button type="submit" class="btn btn-primary btn-lg" id="btnReimprimirTicketRetiroBaulCorteCaja">Si</button>

                    </div>


        </div>


</div>



<?php 
$reimprimir_ticket_retiro_baul_corte_caja = new ControladorCajas();
$reimprimir_ticket_retiro_baul_corte_caja -> ctrReimprimirTicketRetiroBaulCorteCaja();


?>
</form>

</div>
</div>
</div>











<div class="modal fade" id="modalReimprimirTicketCorteCaja">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioReimprimirTicketCorteCaja">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres reimprimir el corte de caja?</p>
                          <small>Este ticket sale en caja</small>
                          <br><br>
                          <input type="hidden" id="reimprimir_ticket_corte_caja" name="reimprimir_ticket_corte_caja">
                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" id="btnNoReimprimirTicketCorteCaja">No</button>
                          <button type="submit" class="btn btn-primary btn-lg" id="btnReimprimirTicketCorteCaja">Si</button>

                    </div>


        </div>


</div>



<?php 
$reimprimir_ticket_corte_caja = new ControladorCajas();
$reimprimir_ticket_corte_caja -> ctrReimprimirTicketCorteCaja();


?>
</form>

</div>
</div>
</div>










<div class="modal fade" id="modalVentasCorteCaja" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ventas del corte de caja</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <div id="incrustarTablaVentasCorteCaja">
                  
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                </div>

        </div>
    </div>
</div>










<div class="modal fade" id="modalDevolucionesCorteCaja" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Devoluciones del corte de caja</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <div id="incrustarTablaDevolucionesCorteCaja">
                  
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                </div>

        </div>
    </div>
</div>










<div class="modal fade" id="modalGarantiasCorteCaja" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Garantias del corte de caja</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <div id="incrustarTablaGarantiasCorteCaja">
                  
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