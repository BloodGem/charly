
<?php

$indiceCambiarUtilidadesProductosMarca = array_search("Cambiar utilidades de productos por marca",$array,true);

if($indiceCambiarUtilidadesProductosMarca !== false){

  $id_marca = $_GET['id_marca'];

    ?>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <center><h1 style="font-size: 40px; font-weight: 900;">Cambio de utilidades por Marca</h1></center>
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




                    <div class="col-12">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Marca</label>
                    <input type="hidden" id="id_marca_get" value="<?php echo $id_marca; ?>">
                    <select class="form-control select2" id="id_marca" name="id_marca" style="width: 100%;">
                      <option value="">--Selecciona--</option>
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
                      <center>
                      <label>Acciones</label>
                      <div class="form-group">
                    <button class="btn-sm btn-success" id="btnCUPM">Cambiar utilidades</button>
                  </div>
                  </center>
                  </div>
                </div>












                    <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <div id="incrustarTablaProductosMarca"></div>
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










  <div class="modal fade" id="modalCUPM" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cambiar utilidades</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" id="formularioCUPM">

                        <input type="hidden" class="form-control" id="idMarcaCUPM" name="idMarcaCUPM">
                        <div class="row">
                                <div class="col-12">
                                    <label>Utilidad 1 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="utilidad1CUPM" name="utilidad1CUPM" step="any" min="0.1" placeholder="" required>
                                </div>

                                <div class="col-12">
                                    <label>Utilidad 2 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="utilidad2CUPM" name="utilidad2CUPM" step="any" min="0.1" placeholder="" required>
                                </div>


                                <div class="col-12">
                                    <label>Utilidad 3 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="utilidad3CUPM" name="utilidad3CUPM" step="any" min="0.1" placeholder="" required>
                                </div>
                </div>
</div>
<div class="modal-footer justify-content-center">
    <button type="button" class="btn btn-primary" id="btnSubmitCUPM">Hacer cambios</button>
</div>

<?php 

$editarProducto = new ControladorExistenciasSucursales();
$editarProducto -> ctrCambiarUtilidadesProductosMarca();

?>
</form>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>


<?php } ?>







