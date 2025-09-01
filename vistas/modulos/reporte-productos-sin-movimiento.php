
<?php

$indiceReporteProductosSinMovimiento = array_search("Reporte de productos sin movimiento",$array,true);

if($indiceReporteProductosSinMovimiento !== false){

    ?>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <center><h1 style="font-size: 40px; font-weight: 900;">Reporte de Productos Sin Movimiento</h1></center>
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

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>no_meses</label>
                        <input type="number" class="form-control" id="no_meses" name="no_meses" value="0" min="1">
                      </div>
                    </div>
                    <div class="col-sm-4" id="incrustarRangoFecha">
                      
                    </div>





                    <input type="hidden" name="id_sucursal" id="id_sucursal" value="<?php echo $traerSucursal['id_sucursal'] ?>">





                    <div class="col-sm-4">
                      <center>
                      <label>Acciones</label>
                      <div class="form-group">
                    <button class="btn-sm btn-success btnExportarPDFReporteProductosSinMovimiento">PDF</button>
                    
                    <button class="btn-sm btn-warning btnExportarEXCELReporteProductosSinMovimiento">EXCEL</button>
                  </center>
                  </div>
                </div>












                    <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <center><image src="vistas/img/plantilla/cargando2.gif" style="display:none" id="cargando" ></center>
                <div id="incrustarTablaReporteProductosSinMovimiento"></div>
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


<?php } ?>







