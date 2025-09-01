<div class="content-wrapper">

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
                    <div class="input-group">
                      <label>Proveedor</label>
                      <select class="form-control select2" id="seleccionaProveedorResurtido" name="seleccionaProveedorResurtido" style="width: 100%;" autofocus>
                        <?php

                          $proveedores = ControladorProveedores::ctrMostrarProveedores();

                          foreach ($proveedores as $key => $value) {

                            echo '<option value="'.$value["id_proveedor"].'">'.$value["nombre"].'</option>';
                          }
                        ?>
                      </select>
                    </div>
                  </div>


                  

                  <!--<div class="col-lg-2 col-12">
                    <center>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="verEnCeros" name="verEnCeros" value="1">
                        <label for="verEnCeros" class="custom-control-label">En ceros?</label>
                      </div>
                    </center>
                  </div>

                  <div class="col-lg-2 col-12">
                    <div class="input-group input-group-sm">
                      <center><button class="btn btn-info btn-sm btnListarResurtido">GENERAR</button></center>
                    </div>
                  </div>-->

                  <div class="col-lg-3 col-12">
                    <label>.</label>
                    <div class="input-group">
                        
                        <button class="btn btn-secondary" id="btnResurtidoAlfabetico">Todos los productos</button>
                    </div>
                  </div>

                  <div class="col-lg-3 col-12">
                    <label>.</label>
                    <div class="input-group">
                        <button class="btn btn-primary" id="btnResurtidoAlfabeticoProveedor">Productos del proveedor</button>
                    </div>
                  </div>

                </div>
              </div>
            </div>          
          </div>




          <div class="col-md-12">
            <form method="post" role="form" id="formularioResurtido" name="formularioResurtido" class="formularioResurtido">

              <input type="hidden" class="form-control" id="seleccionaProveedorResurtido2" name="seleccionaProveedorResurtido2" value="" readonly required>


              <div class="card card-primary">
                <div class="card-header">
                </div>
                <div class="card-body nuevoProducto" id="a">

                </div>
              </div>

          </div>

          
          <div class="col-12">
            <center><input type="button" class="btn btn-info" id="btnGenerarResurtido" value="GENERAR RESURTIDO"></center>
          </div>

          <?php 
        $crearResurtido = new ControladorResurtidos();
        $crearResurtido -> ctrCrearResurtido();


    ?>

  </form>






          <!--<div class="col-sm-12">
            <div class="card card-warning">
              <div class="card-header">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio">
                  <label for="customRadio2" class="custom-control-label">SELECCINE UN PROVEEDOR Y EL RANGO DE PRODUCTOS</label>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Proveedor</label>
                      <select class="form-control select2" id="seleccionaProveedor2" name="seleccionaProveedor2" style="width: 100%;" required>
                        <option value="">--Seleccione--</option>
                        <?php

                          /*$proveedores = ControladorProveedores::ctrMostrarProveedores();

                          foreach ($proveedores as $key => $value) {
                          echo '<option value="'.$value["id_proveedor"].'">'.$value["nombre"].'</option>';
                          }*/

                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label>Rango inicial</label>
                      <select class="form-control" id="rangoProductos1" name="rangoProductos1" style="width: 100%;" required>
                        <option value="">--Seleccione--</option>
                        <?php

                          /*$productos1 = ControladorProductos::ctrMostrarProductos();

                          foreach ($productos1 as $key => $value) {
                          echo '<option value="'.$value["id_producto"].'">'.$value["descripcion_corta"].'</option>';
                          }*/

                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label>Rango final</label>
                      <select class="form-control" id="rangoProductos2" name="rangoProductos2" style="width: 100%;" required>
                        <option value="">--Seleccione--</option>
                        <?php

                          /*$productos12 = ControladorProductos::ctrMostrarProductos();

                          foreach ($productos12 as $key2 => $value2) {
                          echo '<option value="'.$value2["id_producto"].'">'.$value2["descripcion_corta"].'</option>';
                          }*/

                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>.</label>
                      <center><button>GENERAR</button></center>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>-->

















        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>










<div class="modal fade" id="modalResurtidoAlfabetico" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearAuto">
                <div class="modal-header">
                    <h4 class="modal-title">Resurtido Alfabético</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" id="cerrarModalResurtidoAlfabetico">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">


                        <div class="col-12">
                            <div class="form-group">
                                 <label>Marca</label>
                                 <select class="form-control select2" id="id_marca" name="id_marca" style="width: 100%;">
                      <option value="0">EN GENERAL</option>
                      <?php

                      $traerMarcas = ControladorMarcas::ctrMostrarMarcas();

                      foreach ($traerMarcas as $key => $value) {

                        echo '<option value="'.$value["id_marca"].'">'.$value["marca"].'</option>';

                      }

                      ?>
                    </select>
                        </div>
                    </div>

                        <div class="col-12">
                            <div class="form-group">
                                 <label>Producto Inicial</label>
                                 <div class="input-group">
                            <input type="text" class="form-control" id="productoIncial" name="productoIncial" readonly>
                            <div class="input-group-append">
                                   <button type="button" class="btn btn-info" id="btnVerProductos1">Ver productos</button>
                                </div>
                              </div>
                        </div>
                    </div>





                    <div class="col-12">
                            <div class="form-group">
                                 <label>Producto Final</label>
                                 <div class="input-group">
                            <input type="text" class="form-control" id="productoFinal" name="productoFinal" readonly>
                            <div class="input-group-append">
                                   <button type="button" class="btn btn-primary" id="btnVerProductos2">Ver productos</button>
                                </div>
                              </div>
                        </div>
                    </div>





                            
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                   
                    <button type="button" class="btn btn-secondary" id="btnGenerarRA">Generar</button>
                </div>

            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>










<div class="modal fade" id="modalProductos1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Seleccione el Producto Inicial</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" id="cerrarModalProductos1">&times;</span></button>
                </div>
                <div class="modal-body" id="incrustarProductos1">
                     
                </div>
                <div class="modal-footer justify-content-center">
                   
                </div>

        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>









<div class="modal fade" id="modalProductos2" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Seleccione el Producto Final</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" id="cerrarModalProductos2">&times;</span></button>
                </div>
                <div class="modal-body" id="incrustarProductos2">
                     
                </div>
                <div class="modal-footer justify-content-center">
                   
                </div>

        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>





















<div class="modal fade" id="modalResurtidoAlfabeticoProveedor" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Proveedor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" id="cerrarModalResurtidoAlfabeticoProveedor">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-12">
                            <div class="form-group">
                                 <label>Producto Inicial</label>
                                 <div class="input-group">
                            <input type="text" class="form-control" id="productoInicialProveedor" name="productoInicialProveedor" readonly>
                            <div class="input-group-append">
                                   <button type="button" class="btn btn-info" id="btnVerProductosProveedor1">Ver productos</button>
                                </div>
                              </div>
                        </div>
                    </div>





                    <div class="col-12">
                            <div class="form-group">
                                 <label>Producto Final</label>
                                 <div class="input-group">
                            <input type="text" class="form-control" id="productoFinalProveedor" name="productoFinalProveedor" readonly>
                            <div class="input-group-append">
                                   <button type="button" class="btn btn-info" id="btnVerProductosProveedor2">Ver productos</button>
                                </div>
                              </div>
                        </div>
                    </div>





                            
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                   
                    <button type="button" class="btn btn-secondary" id="btnGenerarRAP">Generar</button>
                </div>

        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>










<div class="modal fade" id="modalProductosProveedor1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Seleccione el Producto Inicial</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" id="cerrarModalProductosProveedor1">&times;</span></button>
                </div>
                <div class="modal-body" id="incrustarProductosProveedor1">  
                </div>
                <div class="modal-footer justify-content-center">
                   
                </div>

        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>









<div class="modal fade" id="modalProductosProveedor2" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Seleccione el Producto Final</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" id="cerrarModalProductosProveedor2">&times;</span></button>
                </div>
                <div class="modal-body" id="incrustarProductosProveedor2">  
                </div>
                <div class="modal-footer justify-content-center">
                   
                </div>

        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>