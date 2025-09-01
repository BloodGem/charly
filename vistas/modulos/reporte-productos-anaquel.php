<?php
require_once "conexion.php";

$indiceReporteDeProductosPorAnaquel = array_search("Reporte de productos por anaquel",$array,true);

if($indiceReporteDeProductosPorAnaquel !== false){
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <center><h1 style="font-size: 40px; font-weight: 900;">Productos por Anaquel</h1></center>
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
                <div class="col-sm-6">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Anaquel</label>
                    <input type="text" class="form-control" style="font-size: 30px; height:50px;" id="anaquel" name="anaquel" autofocus>
                  </div>
                </div>

                <input type="hidden" name="id_sucursal" id="id_sucursal" value="<?php echo $traerSucursal['id_sucursal'] ?>">
                    <input type="hidden" name="nombre_sucursal" id="nombre_sucursal" value="<?php echo $traerSucursal['nombre'] ?>">





                <div class="col-sm-6">
                  <label>Acciones</label>
                  <div class="form-group">
                    <button class="btn-sm btn-success" id="btnExportarPDFReporteDeProductosPorAnaquel">PDF</button>
                    
                    <button class="btn-sm btn-warning" id="btnExportarEXCELReporteDeProductosPorAnaquel">EXCEL</button> 
                  </div>
                </div>

                











                <div class="col-12">
                  <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body" id="incrustarTablaReporteDeProductosPorAnaquel">

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







