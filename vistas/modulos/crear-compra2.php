<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">





    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">


            <div class="col-md-12">
            <!-- general form elements -->
                <div class="card card-primary">
              <div class="card-header">
              </div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Proveedor</span>
                      </div>
                      <div class="custom-file">
                        <select class="form-control select2" id="nuevoIdProveedor" name="nuevoIdProveedor" autofocus style="width: 100%;">
                    <?php

                      $proveedores = ControladorProveedores::ctrMostrarProveedores();

                      foreach ($proveedores as $key => $value) {

                        echo '<option descuento="'.$value["descuento"].'" value="'.$value["id_proveedor"].'">'.$value["nombre_comercial"].' - '.$value["rfc"].'</option>';

                      }

                    ?>
                  </select>
                      </div>
                    </div>


                    <input type="hidden" id="nuevoDescuentoCompra" name="nuevoDescuentoCompra">

                  </div>
                </div>
                </div>


            </div>


             

        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
              </div>
                <div class="card-body">
                  <div class="form-group">
                    <center>
                      <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup ="buscarAhoraProductosD($('#buscarProductosD').val());" type="search" class="form-control" style="font-weight: bold; font-size: 25px" id="buscarProductosD" name="buscarProductosD" teclaEsc="si" autocomplete="off">
                      </div>
                    </div>
    
</div>
</center>
<br>
                    <div id="incrustarTablaProductos">
              
                    </div>
        
                </div>
            </div>
        </div>



        <div class="col-md-12">
          <form method="post" role="form" class="formularioCompra">


                  <input type="hidden" class="form-control" id="nuevoIdVendedor" name="nuevoIdVendedor" value="<?php echo $_SESSION['id'] ?>" readonly required>


                  <input type="hidden" class="form-control" id="nuevoIdProveedor2" name="nuevoIdProveedor2" readonly required>

            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <div class="row">
                              <div class="col-1">
                              </div>
                              <div class="col-3">
                                Descripción
                              </div>
                              <div class="col-2">
                                Precio compra
                              </div>
                              <div class="col-2">
                                Cantidad
                              </div>
                              <div class="col-2">
                                Descuento
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
<input type="hidden" name="listaProductos" id="listaProductos">
<div class="col-md-12">
            <!-- general form elements -->
                <div class="card card-primary">
              <div class="card-header">
              </div>
                <div class="card-body">
                  <div class="form-group">
                  <center><div class="col-4">
                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text">Total compra</span>
                      </div>
                    <input type="text" style="text-align: center;" class="form-control input-lg" id="nuevoTotalCompra" name="nuevoTotalCompra" total="" placeholder="00000" readonly required>

                              <input type="hidden" name="totalCompra" id="totalCompra">
                    <div class="input-group-append">
                        <span class="input-group-text">$</span>
                      </div>
                  </div>
                  </div></center>




<br><br>

<center>
  <div class="col-sm-6">
                    <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="cambiarPrecios" name="cambiarPrecios" value="1" checked>
                          <label for="cambiarPrecios" class="custom-control-label">Quiere cambiar los precios de compra de los productos?</label>
                        </div>
                  </div>
                </center>





                  </div>
                </div>
                </div>
            </div>




<div class="col-12">
        <center><input type="submit" class="btn btn-info" value="GENERAR COMPRA" accesskey="1"></center>
    </div>



  </form>

<?php 
        $crearCompra = new ControladorCompras();
        $crearCompra -> ctrCrearCompra();


    ?>

</div>


</div>
</div>
