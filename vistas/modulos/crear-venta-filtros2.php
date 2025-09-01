<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <style type="text/css">
    

div:hover.rowProducto {
  background-color: gold;
}
  </style>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-7" aumdis_busqueda="7" id="divBusqueda">
            <!-- general form elements -->
            <div class="card card-primary divBusqueda" >
              <div class="card-header">
                <div class="row">
                    <div class="col-9">
                      Cliente

                    </div>
                    <div class="col-3" id="textoPrecio">
                      Precio: Público
                    </div>
                  </div>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-lg-4 col-12">
                    <div class="input-group input-group-sm">
                      <?php 
                      $publico_general = ControladorClientes::ctrMostrarCliente(1);
                          
                      ?>

                      <input class="form-control" style="font-size: 12px;" onchange="buscarAhoraCliente($('#rfcCliente').val());" type="search" id="rfcCliente" name="rfcCliente" autofocus value="">

                      <!--<input id="rfcC">-->

                      <?php 
                        $arrayClientes = array();
                        $clientes = ControladorClientes::ctrMostrarClientes2();
foreach ($clientes as $key => $value) {
      array_push($arrayClientes, $value['rfc']); // equipos


    }

    //var_dump($arrayClientes);
                      ?>
                      
                    </div>
                  </div>
                  <div class="col-lg-8 col-12">
                    <div class="input-group input-group-sm">
                      <?php 

                            echo '
                      <input type="text" class="form-control" style="font-size: 12px;" id="nombreCliente" name="nombreCliente" value="'.$publico_general["nombre"].'" readonly tabindex="-1">';
                          
                      ?>
                      
                    </div>
                  </div>
                  <hr>
                </div>
                <div class="form-group">
                  <center>
                      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Búsqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup ="buscarAhoraProductosD($('#buscarProductosD').val());" type="search" class="form-control" style="font-weight: bold; font-size: 25px" id="buscarProductosD" name="buscarProductosD" teclaEsc="si" accesskey="b" autocomplete="off">
                      </div>
                    </div>
                  </center>
                  <br>
                    
                </div>
                <div id="incrustarTablaProductos"></div>
              </div>
            </div>
          </div>
        <div class="col-md-5" aumdis_venta="5" id="divVenta">
          <!-- general form elements -->
          <div class="card card-primary divVenta" style="background-color: #E01200;">
            <div class="card-header">
              <div class="row">
                <div class="col-6"><center><button type="button" class="btn btn-block btn-success" id="aumentarEspacioDivVenta">+</button></center></div>
                <div class="col-6"><center><button type="button" class="btn btn-block btn-danger" id="disminuirEspacioDivVenta">-</button></center></div>
              </div>
            </div>
              <div class="card-body">
                <form method="post" role="form" id="formularioVenta" name="formularioVenta" class="formularioVenta">
                <div class="row">
                      <?php 
                      $publico_general = ControladorClientes::ctrMostrarCliente(1);

                            echo '<input type="hidden" id="nuevoIdCliente" name="nuevoIdCliente" no_precio="'.$publico_general["no_precio"].'" value="'.$publico_general["id_cliente"].'">
                            ';
                          
                      ?>
                  <div class="col-md-12">
                    
            


              <!--<input type="text" class="form-control" id="nuevoIdCliente2" name="nuevoIdCliente2" readonly required>
               general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <div class="row">
                    <div class="col-1">

                    </div>
                    <div class="col-2">
                      Clav
                    </div>
                    <div class="col-4">
                      Descripción
                    </div>
                    <div class="col-2">
                      Cant
                    </div>
                    <div class="col-2">
                      Total
                    </div>
                  </div>
                </div>
                <div class="card-body nuevoProducto" id="a">

                </div>
              </div>
          </div>
          <input type="hidden" class="form-control" name="listaProductos" id="listaProductos">
       
          <div class="col-md-12" >
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
              </div>
              <div class="card-body">
                <div class="form-group">
                  <div class="row">

                  <!--<div class="col-3">
                      <div class="input-group">
                          <span class="input-group-text">Pago con tarjeta</span>
                        

                        <input type="checkbox" class="form-control input-sm" id="pago_tarjeta" name="pago_tarjeta" value="false">

                      </div>
                    </div>--> 
                    
                    <div class="col-12" id="divTotalVenta">
                      
                      <div class="input-group justify-content-center">
                        <div class="input-group-append">
                          <h1>TOTAL: $</h1>
                        </div>

                        <h1 id="nuevoTotalVenta" name="nuevoTotalVenta" style="font-weight: bold;">0</h1>
                        <input type="hidden" name="totalVenta" id="totalVenta">
                        
                      </div>
                    
                    </div>


                    <br><br><br>

                    <div class="col-6">

                      <div class="row">
                        
                        <div class="col-6">
                          <label>Efectivo</label>
                        </div>
                        <div class="col-6">
                          <input type="radio" class="form-control" id="nuevoNoFormaPago" name="nuevoNoFormaPago" value="1" checked>
                        </div>
                      </div>
                      
                
                        
                    
                    </div>





                    <div class="col-6">

                      <div class="row">
                        
                        <div class="col-6">
                          <label>Tarjeta Debito</label>
                        </div>
                        <div class="col-6">
                          <input type="radio" class="form-control" id="nuevoNoFormaPago" name="nuevoNoFormaPago" value="2">
                        </div>
                      </div>
                      
                
                        
                    
                    </div>





                    <div class="col-6">

                      <div class="row">
                        
                        <div class="col-6">
                          <label>Tarjeta Credito</label>
                        </div>
                        <div class="col-6">
                          <input type="radio" class="form-control" id="nuevoNoFormaPago" name="nuevoNoFormaPago" value="3">
                        </div>
                      </div>
                      
                
                        
                    
                    </div>





                    <div class="col-6">

                      <div class="row">
                        
                        <div class="col-6">
                          <label>Transferencia</label>
                        </div>
                        <div class="col-6">
                          <input type="radio" class="form-control" id="nuevoNoFormaPago" name="nuevoNoFormaPago" value="4">
                        </div>
                      </div>
                      
                
                        
                    
                    </div>




                    <br><br><br>

                    <div class="col-12">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Tipo Venta:
              </span>
          </div>
           <select class="form-control" id="nuevoTipoVenta" name="nuevoTipoVenta" accesskey="t">
                              <?php 
                                if($tipo_venta_permitido == "NT"){
                                    echo '<option value="NT">NOTA</option>';
                                }elseif($tipo_venta_permitido == "RM"){
                                    echo '<option value="RM">REMISIÓN</option>';
                                }
                              ?>
                            
                            <option value="FC">FACTURA</option>
                          </select>
      </div>
  </div>
</div>



                    
                  </div>
                </div>
              </div>
            </div>
          </div>

          <input type="hidden" id="nuevoIdVendedor" name="nuevoIdVendedor">

          <input type="hidden" class="form-control" id="nuevoNombreClienteTicket" name="nuevoNombreClienteTicket" readonly>

          <div class="col-12">
            <center><input type="button" class="btn btn-info btnGenerarVenta" value="GENERAR VENTA"></center>
          </div>



  </form>

<?php 
        $crearVenta = new ControladorVentas();
        $crearVenta -> ctrCrearVenta();


    ?>

                </div>
              </div>
            </div>          
          </div>
          
          
<br><br>
</section>

</div>




<script type="text/javascript">
    /*$(document).ready(function () {

      var items = <?= json_encode($arrayClientes) ?>

      console.log(items);

      $("#rfcCliente").autocomplete({
        source: items
      });
    });*/
  </script>










