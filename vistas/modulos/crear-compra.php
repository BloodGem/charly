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
              <div class="row">
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text">Proveedor</span>
                      </div>
                      <div class="custom-file">
                        <select class="form-control select2" id="nuevoIdProveedor" name="nuevoIdProveedor" style="width: 100%;">
                          <option value="">--Selecciona--</option>
                          <?php

                          $item = null;
                          $valor = null;

                          $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                          foreach ($proveedores as $key => $value) {

                            echo '<option descuento="'.$value["descuento"].'" value="'.$value["id_proveedor"].'">'.$value["nombre"].' - '.$value["rfc"].'</option>';

                          }

                          ?>
                        </select>
                      </div>
                    </div>


                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="input-group">
                    <label>Descuentos</label>
                    <input type="text" class="form-control-sm" style="width: 14%;" id="descuento1" name="descuento1" value="0">
                    <input type="text" class="form-control-sm" style="width: 14%;" id="descuento2" name="descuento2" value="0">
                    <input type="text" class="form-control-sm" style="width: 14%;" id="descuento3" name="descuento3" value="0">
                    <input type="text" class="form-control-sm" style="width: 14%;" id="descuento4" name="descuento4" value="0">
                    <input type="text" class="form-control-sm" style="width: 14%;" id="descuento5" name="descuento5" value="0">
                    <input type="text" class="form-control-sm" style="width: 14%; background-color: black; color: white;" id="nuevoDescuentoCompra" name="nuevoDescuentoCompra" value="0" readonly>
                  </div>
                </div>
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
                <div class="row">
                  <div class="col-lg-6 col-12">

                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input teclaEsc = "si" type="search" class="form-control" id="buscarProductosCompras" name="buscarProductosCompras" autofocus accesskey="b">
                      </div>
                    </div>

                  </div>
                  <div class="col-lg-6 col-12">
                    <center>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="verCatalogoCompleto" name="verCatalogoCompleto" value="1">
                        <label for="verCatalogoCompleto" class="custom-control-label">Catálogo Completo?</label>
                      </div>
                    </center>
                  </div>
                </div>
                <br>
                <div class="input-group">
                  <table class="table table-bordered table-striped listaProductosCompras">
                    <thead>
                      <tr>
                        <th style="width:5px">Imgs</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th style="text-align: right;">Stock</th>
                        <th style="text-align: right;">Precio</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody id="incrustarTablaProductosCompras"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>



        <div class="col-md-12">
          <form method="post" role="form" class="formularioCompra">

            <input type="hidden" class="form-control-sm" style="width: 14%;" id="nuevoDescuento1Compra" name="nuevoDescuento1Compra" value="0">
                    <input type="hidden" class="form-control-sm" style="width: 14%;" id="nuevoDescuento2Compra" name="nuevoDescuento2Compra" value="0">
                    <input type="hidden" class="form-control-sm" style="width: 14%;" id="nuevoDescuento3Compra" name="nuevoDescuento3Compra" value="0">
                    <input type="hidden" class="form-control-sm" style="width: 14%;" id="nuevoDescuento4Compra" name="nuevoDescuento4Compra" value="0">
                    <input type="hidden" class="form-control-sm" style="width: 14%;" id="nuevoDescuento5Compra" name="nuevoDescuento5Compra" value="0">

            <input type="hidden" class="form-control" id="nuevoIdVendedor" name="nuevoIdVendedor" value="<?php echo $_SESSION['id'] ?>" readonly required>


            <input type="hidden" class="form-control" id="nuevoIdProveedor2" name="nuevoIdProveedor2" readonly required>

            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-body">

                <table class="table table-hover text-nowrap" id="tablaProductosCompra" style="font-size:14px;">
                    
                <thead>
                    <tr style="background-color: #0583F2; color: white;">
                      <th width="3%">.</th>
                          <th width="15%">Clave</th>
                          <th width="20%">Descripción</th>
                          <th width="10%">Precio compra</th>
                          <th width="7%">Cantidad</th>
                          <th width="7%">Descuento</th>
                          <th width="10%">Precio U.</th>
                          <th width="15%">Total</th>
                    </tr>
                </thead>
                <tbody class="nuevoProducto" id="a">


                </tbody>
              </table>



              </div>
            </div>
          </div>
          <input type="hidden" class="form-control" name="listaProductos" id="listaProductos" readonly>
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
              </div>
              <div class="card-body">
                <div class="row">


                  <div class="col-lg-8 col-12">
                    <div class="form-group">
                        <label>Observaciones</label>
                      <textarea class="form-control" id="nuevasObservacionesCompra" name="nuevasObservacionesCompra" rows="3" placeholder="">N/A</textarea>
                    </div>
                  </div>





                  <div class="col-lg-2 col-12">
                    <div class="form-group">
                        <label>No. Factura</label>
                      
                      <input type="text" style="text-align: center;" class="form-control input-lg" id="nuevoNoFacturaCompra" name="nuevoNoFacturaCompra" total="" placeholder="00000">
                    </div>
                  </div>





                  <div class="col-lg-2 col-12">
                    <div class="form-group">
                        <label>Tipo Compra</label>
                        <select class="form-control" id="nuevoTipoCompra" name="nuevoTipoCompra">
                          <option value="0">--Selecciona--</option>
                          <option value="1">Factura</option>
                          <option value="2">Remisión</option>
                        </select>
                    </div>
                  </div>




                  






                </div>
                 
                <br><br>
                  
                    <div class="form-group">
                  <center><div class="col-lg-4 col-12">
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
                    <div class="col-lg-6 col-12">
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
