<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary divCliente">
            <div class="card-header">
            </div>
              <center>
                <div class="row">




                  <!--<div class="col-lg-7 col-12">
                                <div class="form-group">
                                 <label>Cliente</label>
                                 <div class="input-group">
                                    <div class="col-lg-3 col-12">-->
                      <?php 
                      //$publico_general = ControladorClientes::ctrMostrarCliente(1);
                          
                      ?>
                      <!--<div class="input-group input-group-sm">
                      <input class="form-control form-control-sm" style="height:21px; width:100px;"  onchange="buscarAhoraCliente($('#rfcCliente').val());" type="search" id="rfcCliente" name="rfcCliente" autofocus value="">
                    </div>-->
                      

                      <?php 
                        /*$arrayClientes = array();
                        $clientes = ControladorClientes::ctrMostrarClientes2();
foreach ($clientes as $key => $value) {
      array_push($arrayClientes, $value['rfc']); // equipos


    }*/

    //var_dump($arrayClientes);
                      ?>
                      
                  <!--</div>
                  <div class="col-lg-5 col-12">
                    <div class="input-group input-group-sm">-->
                      <?php 

                            /*echo '
                      <input type="text" class="form-control form-control-sm" style="height:21px; width:100px;"  id="nombreCliente" name="nombreCliente" value="'.$publico_general["nombre"].'" readonly tabindex="-1">';*/
                          
                      ?>
                      <!--</div>
                    
                  </div>-->
                                  


<?php

                        /*$indiceCrearClientes = array_search("Crear clientes",$array,true);

if($indiceCrearClientes == 0){
   
}else if($indiceCrearClientes !== ""){

    
                    echo'<div class="input-group-append">
                                    <button type="button" id="btnCrearNuevoCliente" class="btn btn-xs btn-primary float-right" data-toggle="modal" data-target="#modalCrearClienteModulo"><i class="fa fa-user"></i>Crear</button>
                                </div>';
                    

                }



                $indiceEditarClientes = array_search("Editar clientes",$array,true);

if($indiceEditarClientes !== false){

    
                    echo'<div class="input-group-append"><button type="button" id="btnEditarCliente" class="btn btn-xs btn-warning float-right"><i class="fa fa-edit"></i>Editar</button>
                                </div>';
                    

                }*/



    ?>



                      
                                
                                







                            <!--</div>
                            </div>
                          </div>-->











                          <div class="col-lg-9 col-12">
                                <div class="form-group">
                                 <label>Cliente</label>
                                 <div class="input-group">
                                 <select class="form-control-sm select2" id="nuevoIdCliente" name="nuevoIdCliente" accesskey="c" style="width: 80%;">
                        <?php
                          $item = null;
                          $valor = null;

                          $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                          foreach ($clientes as $key => $value) {

                            echo '<option no_precio="'.$value["no_precio"].'" descuento="'.$value["descuento"].'" celular="'.$value["telefono1"].'" value="'.$value["id_cliente"].'">'.$value["nombre"].' - '.$value["rfc"].'</option>';
                          }
                        ?>
                      </select>


<?php

                        $indiceCrearClientes = array_search("Crear clientes",$array,true);

if($indiceCrearClientes == 0){
   
}else if($indiceCrearClientes !== ""){

    ?>
                    <div class="input-group-append">
                                    <div class="input-group-select"><button type="button" id="btnCrearNuevoCliente" class="btn-sm btn-primary float-right" data-toggle="modal" data-target="#modalCrearClienteModulo"><i class="fa fa-user"></i>Crear</button></div>
                                </div>
                    <?php

                }



                $indiceEditarClientes = array_search("Editar clientes",$array,true);

if($indiceEditarClientes !== false){

    ?>
                    <div class="input-group-append">
                                    <div class="input-group-select"><button type="button" id="btnEditarCliente" class="btn-sm btn-warning float-right"><i class="fa fa-edit"></i>Editar</button></div>
                                </div>
                    <?php

                }



    ?>



                      
                                
                                







                            </div>
                            </div>
                          </div>










                          <div class="col-lg-2 col-12">
          <div class="form-group">
            <label>Precio:</label>
            <div class="input-group input-group-sm">
           <input type="text" class="form-control form-control-sm" style="height:21px; width:100px;"  id="textoPrecio" value="Público" readonly>
      </div>
  </div>
</div>







                <input type="hidden" class="form-control form-control-sm" style="height:21px; width:100px;"  id="nuevoDescuentoVenta" name="nuevoDescuentoVenta" readonly>



                    <!--<div class="col-lg-2 col-12">
          <div class="form-group">
            <label>Descuento:</label>
            <div class="input-group input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text" style="height:20px; width:25px;">
                  <i class="fas fa-percent"></i>
              </span>
          </div>
           
      </div>
  </div>
</div>-->
          
              </div>
            </center>          
          </div>
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary divBusqueda" style="background-color: #F2D5BB;">
              <div class="card-header">
                <h2 class="pDivBusqueda" style="font-weight: bold;">Dínamica</h2>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <center>
                    <div class="col-sm-6">
                      <div class="input-group input-group-sm">
                        <span class="input-group-append">
                          <button type="button" class="btn btn-disabled btn-flat">Busqueda:</button>
                        </span>
                        <input teclaEsc = "si" type="search" class="form-control" id="buscar3" name="buscar3" autofocus autocomplete="off">

                         <!--<button type="button" class="btn-xs btn-dark" id="btnIncrustarCotizacion"></button>ESTO SE COMENTO-->
                      </div>
                    </div>
                  </center>
                  <br>
                  <div class="input-group">
                    <table class="table table-sm table-bordered table-striped listaProductosVentas" id="tablaBusquedaProductos">
                      <thead>
                        <tr>
                          <th>.</th>
                          <th>Código</th>
                          <th>Descripción</th>
                          <th>Ubicación</th>
                          <th>Marca</th>
                          <th style="text-align: right;">Stock</th>
                          <th style="text-align: right;">Precio</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody id="incrustarTablaProductos">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <form method="post" role="form" id="formularioVenta" name="formularioVenta" class="formularioVenta">

                <input type="hidden" class="form-control" id="comodin" name="comodin" value="0" readonly>

              <input type="hidden" class="form-control" id="nuevoIdVendedor" name="nuevoIdVendedor" readonly required>

              <input type="hidden" class="form-control" id="nuevoIdCliente2" name="nuevoIdCliente2" value="1" precio="1" readonly required>

              <input type="hidden" class="form-control" id="nuevoNombreClienteTicket" name="nuevoNombreClienteTicket" readonly>
              <!-- general form elements -->
              <div class="card card-primary divPartidas">
                <div class="card-body">
                    <table class="table table-hover text-nowrap" id="tablaProductosVenta" style="font-size:14px;">
                    
                <thead>
                    <tr style="background-color: #0583F2; color: white;">
                      <th width="2%">.</th>
                          <th width="12%">Clave</th>
                          <th width="50%">Descripción</th>
                          <th width="3%">Cantidad</th>
                          <th width="5%">Descuento</th>
                          <th width="8%">Precio</th>
                          <th width="8%">Total --- <strong style="font-size: 30px; color: yellow;" id="textoTotal"></strong></th>
                    </tr>
                </thead>
                <tbody class="nuevoProducto" id="a">


                </tbody>
              </table>
                </div>
              </div>
          </div>
          <input type="hidden" class="form-control" name="listaProductos" id="listaProductos">

              <input type="hidden" id="nuevoTipoVenta" name="nuevoTipoVenta" value="NT">
      
              <input type="hidden" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" tabindex="-1" readonly required>

              <input type="hidden" name="totalVenta" id="totalVenta">
                     

              <input type="hidden" id="nuevoNoFormaPago" name="nuevoNoFormaPago" value="">


              <input type="hidden" id="enviaCelular" name="enviaCelular" value="">
          
          <div class="col-12">
            <center><input type="button" class="btn btn-info" id="btnGenerarVenta" value="GENERAR VENTA"></center>
          </div>



  </form>

<?php 
        $crearVenta = new ControladorVentas();
        $crearVenta -> ctrCrearVenta();


    ?>
<br><br>
</section>

</div>













<div class="modal fade" id="modalVerDetallesProducto" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detalles del producto</h4>

                    <button type="button" class="cerrarModal btn-lg btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal"></div>
                <div class="modal-body">

                    <div class="row" id="incrustarDetallesProducto">
                        

                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                </div>
        </div>
    </div>
</div>







<div class="modal fade" id="modalCrearClienteModulo" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" class="formularioCrearCliente" id="formularioCrearCliente" name="formularioCrearCliente">
                <div class="modal-header">
                    <h4 class="modal-title">Crear cliente</h4>
                    <button type="button" class="cerrarModal btn-lg btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
        <form action="" method="post">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">

                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Datos fiscales</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>Nombre físcal 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="nuevoNombre" name="nuevoNombre" placeholder="" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                                </div>
                            </div>
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>RFC 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="nuevoRfc" name="nuevoRfc" minlength="13" maxlength="14" placeholder="" style="text-transform:uppercase;" required>
                                    <input type="hidden" id="rfcActual" name="rfcActual">
                                </div>
                            </div>
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>Email 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="email" class="form-control" id="nuevoEmail" name="nuevoEmail" placeholder="" required>
                                </div>
                            </div>

                            <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>Celular 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="phone" class="form-control" id="nuevoTelefono1" name="nuevoTelefono1" placeholder="" required>
                                </div>
                            </div>

                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                    <label>Régimen fiscal 
                                        <big><code>*</code></big>
                                    </label>
                                    <select class="form-control" id="nuevoIdRegimen" name="nuevoIdRegimen" required>
                                        <option value="">--Selecciona--</option>
                                        <?php

                                        $columna = null;
                                        $valor = null;

                                        $regimenes = ControladorOtros::ctrMostrarRegimenes($columna,$valor);

                                        foreach ($regimenes as $key => $value) {
                                            echo '<option value="'.$value["id_regimen"].'">'.$value["regimen"].'</option>';
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>





                            <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                    <label>Código Postal
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="nuevoCodigoPostal" name="nuevoCodigoPostal" minlength="5" maxlength="5"placeholder="" required>
                                </div>
                            </div>




                            <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                    <label>Lista precio
                                        <big><code>*</code></big>
                                    </label>
                                    <select class="form-control" id="nuevoNoPrecio" name="nuevoNoPrecio" readonly>
                                        <option value="1">1 --- Público</option>
                                    </select>
                                </div>
                            </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>


            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-info" id="btnCrearClienteModulo">CREAR CLIENTE</button>

                </div>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>






























<div class="modal fade" id="modalEditarCliente" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" class="formularioEditarCliente" id="formularioEditarCliente" name="formularioEditarCliente">
                <div class="modal-header">
                    <h4 class="modal-title">Editar cliente</h4>
                    <button type="button" class="cerrarModal btn-lg btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
        <form action="" method="post">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">

                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Datos fiscales</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>Nombre físcal 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="editarNombre" name="editarNombre" placeholder="" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                                </div>
                            </div>
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>RFC 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="editarRfc" name="editarRfc" minlength="13" maxlength="14" placeholder="" style="text-transform:uppercase;" required>
                                    <input type="hidden" id="rfcActual" name="rfcActual">
                                </div>
                            </div>
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>Email 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="email" class="form-control" id="editarEmail" name="editarEmail" placeholder="" required>
                                </div>
                            </div>

                            <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>Celular 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="phone" class="form-control" id="editarTelefono1" name="editarTelefono1" placeholder="" required>
                                </div>
                            </div>

                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                    <label>Régimen fiscal 
                                        <big><code>*</code></big>
                                    </label>
                                    <select class="form-control" id="editarIdRegimen" name="editarIdRegimen" required>
                                        <option value="">--Selecciona--</option>
                                        <?php

                                        $columna = null;
                                        $valor = null;

                                        $regimenes = ControladorOtros::ctrMostrarRegimenes($columna,$valor);

                                        foreach ($regimenes as $key => $value) {
                                            echo '<option value="'.$value["id_regimen"].'">'.$value["regimen"].'</option>';
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                    <label>Código Postal
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="editarCodigoPostal" name="editarCodigoPostal" minlength="5" maxlength="5"placeholder="" required>
                                </div>
                            </div>



                            <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                    <label>Lista precio
                                        <big><code>*</code></big>
                                    </label>
                                    <select class="form-control" id="editarNoPrecio" name="editarNoPrecio" readonly>
                                        
                                    </select>
                                </div>
                            </div>


                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>



                



                <input type="hidden" class="form-control" id="mostrarIdClienteECM" name="mostrarIdClienteECM" placeholder="" readonly>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-info" id="btnGuardarDatosCliente">EDITAR CLIENTE</button>

                </div>

            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>










<script type="text/javascript">
    $(document).ready(function () {
      var items = <?= json_encode($arrayClientes) ?>

      //console.log(items);

      $("#rfcCliente").autocomplete({
        source: items
      });
    });
  </script>