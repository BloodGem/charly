
<div class="content-wrapper">
<br><br>
<div class="row">
    <div class="col-12">
        <div class="login-logo">
    <img src="vistas/img/perfil_empresa/logo.jpg" width="200px">

    <?php
        $traerCorteCaja = ControladorCajas::ctrMostrarCorteCaja($_SESSION['id_corte_caja']);

        $fecha_actual = date('d-m-Y');
        if($traerCorteCaja['fecha_creacion'] != null){
            $dateFechaCorteCaja = date_create($traerCorteCaja['fecha_creacion']);
            $fecha_corte_caja=date_format($dateFechaCorteCaja, 'd-m-Y');
        }else{
            $fecha_corte_caja = "";
        }
        

        echo '<input type="hidden" class="form-control" id="fecha_actual" value="'.$fecha_actual.'">';

        echo '<input type="hidden" class="form-control" id="fecha_corte_caja" value="'.$fecha_corte_caja.'">';
     ?>
    

  </div>
    </div>
    <br><br><br><br><br>
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6 col-12">
                            <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text" style="font-size: 20px; height:60px;">VENTA:</span>
                      </div>
                        <input type="number" class="form-control" style="font-size: 30px; height:60px;" id="buscarVentaCobro" name="buscarVentaCobro" placeholder="Introduzca aquí" required autofocus>

                        <!--<button class="btn btn-warning" data-toggle="modal" data-target="#modalResultadoBuscarVentaCobro">Ver</button>-->
                          
                    </div>
                            
                        <!--<center><button class="btn btn-info btnBuscarVentaCobro" accesskey="2" >Buscar Venta</button></center>-->
                    
                        
                    </div>

                    <div class="col-lg-3"></div>

                        <br><br><br><br><br>


                        <div class="col-lg-3"></div>
                        <div class="col-lg-6 col-12">
                            <div class="input-group">
                        <div class="input-group-append">
                             <?php

                        $indiceCrearDevoluciones = array_search("Crear devoluciones",$array,true);

                        if($indiceCrearDevoluciones !== false){
                            echo '<a href="crear-devolucion" target="_blank">
                            <button class="btn btn-danger" style="font-size: 20px; height:60px; background-color: #A6122D; color: white;">Devolución:</button>
                        </a>';
                            }else{
                                echo'<span class="input-group-text" style="font-size: 20px; height:60px; background-color: #A6122D; color: white;">Devolución:</span>';
                            }
                    ?>
                        
                      </div>
                        <input type="number" class="form-control" style="font-size: 30px; height:60px; background-color: #A6122D;" id="buscarDevolucion" name="buscarDevolucion" placeholder="Introduzca aquí" required autofocus>


                      

                        </div>

                        <!--<center><button class="btn btn-info btnBuscarDevolucion" accesskey="3" >Buscar Devolución</button></center>-->
                    </div>
                    <div class="col-lg-3"></div> 



                    <br><br><br><br><br>


                        <div class="col-lg-3"></div>
                        <div class="col-lg-6 col-12">
                            <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text" style="font-size: 20px; height:60px; background-color: #581973; color: white;" >Garantia:</span>
                      </div>
                        <input type="number" class="form-control" style="font-size: 30px; height:60px; background-color: #581973;" id="buscarGarantia" name="buscarGarantia" placeholder="Introduzca aquí" required autofocus>


                      

                        </div>

                        <!--<center><button class="btn btn-info btnBuscarDevolucion" accesskey="3" >Buscar Devolución</button></center>-->
                    </div>
                    <div class="col-lg-3"></div> 
                        
                </div>

    <br>
</div>









<div class="modal fade" id="modalResultadoBuscarVentaCobro">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Pago</h4>

                <button type="button" class="btn-lg btn-danger btnCerrarVentana" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal"></div>
            <form method="post" name="formularioCobro" id="formularioCobro">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-3">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Fecha:</label>
                            <input type="text" id="nuevaFechaActual" name="nuevaFechaActual" class="form-control" readonly tabindex="-1">
                            <input type="hidden" id="mostrarIdVenta" name="mostrarIdVenta" readonly tabindex="-1">

                        </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Total venta:</label>
                        <input type="text" class="form-control" id="mostrarTotalVenta" name="mostrarTotalVenta" readonly tabindex="-1">
                    </div>
                </div>
                <div class="col-sm-5">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Cliente:</label>
                    <input type="text" class="form-control" id="mostrarNombreCliente" name="mostrarNombreCliente" readonly tabindex="-1">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-2 col-12">
              <div class="form-group">
                <label>Efectivo:</label>
                <input type="number" min="0" step="any" class="form-control" id="nuevoImporteEfectivo" name="nuevoImporteEfectivo">
            </div>
        </div>

        <div class="col-lg-2 col-12">
          <div class="form-group">
            <label>Tarjeta débito:</label>
            <input type="number" min="0" class="form-control" id="nuevoImporteTarjetaDebito" name="nuevoImporteTarjetaDebito" value="0">
        </div>
    </div>

    <div class="col-lg-2 col-12">
        <div class="form-group">
            <label>Tarjeta Credito:</label>
            <input type="number" min="0" class="form-control" id="nuevoImporteTarjetaCredito" name="nuevoImporteTarjetaCredito" value="0">
        </div>
    </div>

    <div class="col-lg-2 col-12">
        <div class="form-group">
            <label>Transferencia:</label>
            <input type="number" min="0" class="form-control" id="nuevoImporteTransferencia" name="nuevoImporteTransferencia" value="0">
        </div>
    </div>

    <div class="col-lg-4 col-12">
        <div class="form-group">
            <label>Terminal Bancaria:</label>
            <select class="form-control" id="nuevaTerminalBancaria" name="nuevaTerminalBancaria" disabled>
                <option value="">N/A</option>
                <?php
                $traerTerminalesBancarias = ControladorTerminalesBancarias::ctrMostrarTerminalesBancariasSucursal();
                foreach ($traerTerminalesBancarias as $key => $row) {
                    echo '<option value="'.$row['id_terminal_bancaria'].'">'.$row['terminal_bancaria'].'</option>';
                }
                ?>
            </select>
        </div>
    </div>

</div>
<br>
<center>


    <div class="col-lg-4 col-12">
      <div class="form-group">
        <label>Total importe:</label>
        <input type="number" style="text-align: center;" class="form-control" id="nuevoImporteTotal" name="nuevoImporteTotal" readonly tabindex="-1">
    </div>
</div>


<div class="col-lg-4 col-12">
  <div class="form-group">
    <label>Cambio:</label>
    <input type="number" style="text-align: center;" class="form-control" id="nuevoCambioCobro" name="nuevoCambioCobro" readonly tabindex="-1">
</div>
</div>


<div class="row" id="esFactura">
    <div class="col-lg-4 col-12" id="formaPago">
        
    </div>

    <div class="col-lg-4 col-12" id="cfdi">

    </div>

    <div class="col-lg-4 col-12" id="metodoPago">

    </div>

</div>




</center>

</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default btnCerrarVentana" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary"  onclick="verificarImporteTotalPago();">Registrar</button>
</div>

<?php 
$cobroVenta = new ControladorVentas();
$cobroVenta -> ctrAplicarPago();


?>

</form>

</div>
</div>
</div>




















<div class="modal fade" id="modalRegistrarDevolucion">
    <!--RDCC = REGISTRAR DEVOLUCION CORTE CAJA-->
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Devolución</h4>

                <button type="button" class="btn-lg btn-danger btnCerrarVentana" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal"></div>
            <form method="post" name="formularioRDCC" id="formularioRDCC">
                <div class="modal-body">

                    <div class="row">

                       
                            <input type="hidden" id="mostrarIdDevolucionRDCC" name="mostrarIdDevolucionRDCC" readonly tabindex="-1">

                            <div class="col-12">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Cliente:</label>
                    <input type="text" class="form-control" id="mostrarNombreClienteDevolucion" name="mostrarNombreClienteDevolucion" readonly tabindex="-1">
                </div>
            </div>

                    <div class="col-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Total Devolución:</label>
                        <input type="text" class="form-control" id="mostrarTotalDevolucion" name="mostrarTotalDevolucion" readonly tabindex="-1">
                    </div>
                </div>
                

            <div class="col-12">
              <div class="form-group">
                <label>Efectivo:</label>
                <input type="number" step="any" class="form-control" id="nuevoImporteDevolucion" name="nuevoImporteDevolucion">
            </div>
        </div>




        <div class=" col-12">
          <div class="form-group">
            <label>Cambio:</label>
            <input type="number" style="text-align: center;" class="form-control" id="nuevoCambioDevolucion" name="nuevoCambioDevolucion" readonly tabindex="-1">
        </div>
        </div>

</div>


</center>

</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default btnCerrarVentana" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary"  id="btnRegistrarDevolucion">Registrar</button>
</div>

<?php 
$registrar_devolucion = new ControladorCajas();
$registrar_devolucion -> ctrRegistrarDevolucionCorteCaja();


?>

</form>

</div>
</div>
</div>




















<div class="modal fade" id="modalRegistrarGarantia">
    <!--RDCC = REGISTRAR DEVOLUCION CORTE CAJA-->
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Garantía</h4>

                <button type="button" class="btn-lg btn-danger btnCerrarVentana" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal"></div>
            <form method="post" name="formularioRGCC" id="formularioRGCC">
                <div class="modal-body">

                    <div class="row">

                       
                            <input type="hidden" id="mostrarIdGarantiaRGCC" name="mostrarIdGarantiaRGCC" readonly tabindex="-1">

                            <div class="col-12">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Cliente:</label>
                    <input type="text" class="form-control" style="font-size: 25px; height:60px; text-align: center;" id="mostrarNombreClienteGarantia" name="mostrarNombreClienteGarantia" readonly tabindex="-1">
                </div>
            </div>

                    <div class="col-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Total Garantía:</label>
                        <input type="text" class="form-control" style="font-size: 30px; height:60px; text-align: center;" id="mostrarTotalGarantia" name="mostrarTotalGarantia" readonly tabindex="-1">
                    </div>
                </div>


</div>


</center>

</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default btnCerrarVentana" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary"  id="btnRegistrarGarantia">Registrar</button>
</div>

<?php 
$registrar_garantia = new ControladorCajas();
$registrar_garantia -> ctrRegistrarGarantiaCorteCaja();


?>

</form>

</div>
</div>
</div>