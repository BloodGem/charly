<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<?php

                    $id_compra = $_GET["id_compra"];

                    $compra = ControladorCompras::ctrMostrarCompra($id_compra);
                    //var_dump($compra);
                    if ($compra["estatus"] == 0) {
                      

                    $id_usuario = $compra["id_usuario_creador"];

                    $vendedor = ControladorUsuarios::ctrMostrarUsuario($id_usuario);

                    //var_dump($vendedor);

                    $id_proveedor = $compra["id_proveedor"];

                    $proveedor = ControladorProveedores::ctrMostrarProveedor($id_proveedor);

                    //var_dump($proveedor);

                ?>



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
                        <select class="form-control" id="nuevoIdProveedor" name="nuevoIdProveedor" style="width: 100%;" readonly>
                    <?php

                    echo '<option descuento="'.$proveedor["descuento"].'" value="'.$proveedor["id_proveedor"].'">'.$proveedor["nombre_comercial"].' - '.$proveedor["rfc"].'</option>';

                      /*$item = null;
                      $valor = null;

                      $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                      foreach ($proveedores as $key => $value) {

                        echo '<option id_sucursal="'.$_SESSION["id_sucursal"].'" 
                         descuento="'.$value["descuento"].'" value="'.$value["id_proveedor"].'">'.$value["nombre_comercial"].' - '.$value["rfc"].'</option>';

                      }*/

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
    <input onkeyup ="buscarAhoraProductosD($('#buscarProductosD').val());" type="search" class="form-control" style="font-weight: bold; font-size: 25px" id="buscarProductosD" name="buscarProductosD" teclaEsc="si" autocomplete="off" autofocus>
</div>
</center>
<br>
                    <div class="input-group" id="incrustarTablaProductos">
                        
                    </div>
                  </div>
                </div>
            </div>
        </div>



        <div class="col-md-12">
          <form method="post" role="form" class="formularioCompra">


                  <input type="hidden" class="form-control" id="nuevoIdVendedor" name="nuevoIdVendedor" value="<?php echo $vendedor['id']; ?>" readonly required>


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


                  <?php 

                  $listaProductos = json_decode($compra["productos"], true);

                foreach ($listaProductos as $key => $value) {

                  echo'<div class="row">
                              <div class="col-1">
                              <button type="button" class="btn btn-danger quitarProducto" id_producto="'.$value['id'].'" accesskey="q"><i class="fa fa-times"></i></button>
                              </div>
                              <div class="col-3">
                              <input type="text" class="form-control nuevaDescripcionProducto" id_producto="'.$value['id'].'" placeholder="" name="agregarProducto" value="'.$value['descripcion'].'" readonly>
                              </div>
                              <div class="col-2 ingresoCostoCompra">
                              <input type="number" class="form-control nuevoCostoCompra" style="text-align: right;" name="nuevoCostoCompra" value="'.$value['costoCompra'].'" step="any" required>
                              </div>
                              <div class="col-2 ingresoCantidad">
                              <input type="number" class="form-control nuevaCantidadProducto" style="text-align: right;" name="nuevaCantidadProducto" min="1" value="'.$value['cantidad'].'" stock="'.$value['cantidad'].'" step="1" required>
                              </div>
                              <div class="col-2 ingresoDescuento">
                              <input type="number" class="form-control nuevoDescuentoProducto" style="text-align: right;" name="nuevoDescuentoProducto" value="'.$value['descuento'].'" descuento="'.$value['descuento'].'" step="any">
                              </div>
                              <div class="col-2 ingresoPrecio">
                              <div class="input-group mb-3">
                              <input type="text" class="form-control nuevoPrecioProducto" style="text-align: right;" descuentoFamilia="10" precioOriginal="'.$value['costoCompra'].'" precioReal="'.$value['precio'].'" value="'.$value['total'].'" step="any" readonly>
                              <div class="input-group-append">
                              <span class="input-group-text">$</span>
                              </div>
                              </div>
                              </div>
                              </div>';
                }


                   ?>
                       
                
                 
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
                    <input type="text" class="form-control input-lg" id="nuevoTotalCompra" name="nuevoTotalCompra" total="" placeholder="00000" value="" readonly required>

                              <input type="hidden" name="totalCompra" id="totalCompra" value="">
                    <div class="input-group-append">
                        <span class="input-group-text">$</span>
                      </div>
                  </div>
                  </div></center>




                  <!--<br><br>

<center><div class="col-4">
<div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Tipo compra</span>
                      </div>
                      <div class="custom-file">
                        <select class="form-control" id="nuevoTipoCompra" name="nuevoTipoCompra">
                          <option value="NT">NOTA</option>
                          <option value="RM">REMISIÓN</option>
                          <option value="FC">FACTURA</option>
                        </select>
                        
                      </div>
                    </div>

                  </div>
                </center>-->
                <br><br>

<center>
  <div class="col-sm-6">
                    <div class="custom-control custom-checkbox">
                      <?php
                      if($compra["cambiar_precios"] == 1){
                        echo '<input class="custom-control-input" type="checkbox" id="cambiarPrecios" name="cambiarPrecios" value="1" checked>';
                      }else{
                        echo '<input class="custom-control-input" type="checkbox" id="cambiarPrecios" name="cambiarPrecios" value="1">';
                      }
                       ?>
                          <label for="cambiarPrecios" class="custom-control-label">Quiere cambiar los precios de compra de los productos?</label>
                        </div>
                  </div>
                </center>




                  </div>
                </div>
                </div>
            </div>




<input type="hidden" id="id_compra" name="id_compra" value="<?php echo $id_compra; ?>">


<div class="col-12">
        <center><input type="submit" class="btn btn-info" value="GUARDAR CAMBIOS" accesskey="1"></center>
    </div>



  </form>

<?php 
        $editarCompra = new ControladorCompras();
        $editarCompra -> ctrEditarCompra();

      }else{
        echo "<script>

          Swal.fire({
  icon: 'error',
  title: 'ESTA COMPRA YA HA SIDO CONFIRMADA O NO EXISTE',
  showConfirmButton: false,
  timer: 3000
}).then(function(result){
            
              window.location = 'lista-compras';

          });
        

        </script>";
      }


    ?>

</div>

</div>
</div>

