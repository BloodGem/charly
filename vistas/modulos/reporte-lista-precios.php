
<?php

$indiceReporteListaPrecios = array_search("Reporte lista de precios",$array,true);

if($indiceReporteListaPrecios !== false){

  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <center><h1 style="font-size: 40px; font-weight: 900;">Reporte Lista de Precios</h1></center>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          







        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">

         

          <!-- general form elements disabled -->
          <div class="card card-warning">
            <div class="card-header">
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">

                <div class="col-lg-2 col-12">
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

                <div class="col-lg-4 col-12">
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





                    <div class="col-lg-4 col-12">
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





                    <div class="col-lg-2 col-12">
                      <label></label>
                      <div class="form-group">
                        <center>
                          <button class="btn btn-primary" id="btnConsultarListaPrecios">Consultar</button>
                        </center>
                      </div>
                    </div>


              </div>












              <div class="col-12">
                <div class="card">
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div id="incrustarTablaReporteListaPrecios"></div>
                  </div>
                  <!-- /.card-body -->
                </div>

                <!-- /.card -->
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
<!-- /.content -->
</div>










<div class="modal fade" id="modalProductos1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
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
    <div class="modal-dialog modal-xl">
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










<?php } ?>