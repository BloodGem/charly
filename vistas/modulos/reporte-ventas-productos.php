
<?php

$indiceReporteVentasProductosProductos = array_search("Reporte de ventas por productos",$array,true);

if($indiceReporteVentasProductosProductos !== false){

  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <center><h1 style="font-size: 40px; font-weight: 900;">Reporte de Ventas por Productos</h1></center>
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

                <div class="col-lg-5 col-12">
                 <label>Fecha Inicial</label>
                 <div class="form-group">
                  <input type="date" class="form-control" style="font-size: 20px; height:40px;" id="fechaInicial" name="fechaInicial" autofocus>
                </div>
              </div>
              <div class="col-lg-5 col-12">
                <label>Fecha Final</label>
                <div class="form-group">
                  
                  <input type="date" class="form-control" style="font-size: 20px; height:40px;" id="fechaFinal" name="fechaFinal" autofocus>
                </div>
              </div>
              <input type="hidden" name="id_sucursal" id="id_sucursal" value="<?php echo $traerSucursal['id_sucursal'] ?>">





              <div class="col-sm-2">
                <center>
                  <label>Acciones</label>
                  <div class="form-group">
                    <!--<button class="btn-sm btn-success btnExportarPDFReporteVentasProductos">PDF</button>-->
                    
                    <button class="btn-sm btn-warning btnExportarEXCELReporteVentasProductos">EXCEL</button>
                  </center>
                </div>
              </div>












              <div class="col-12">
                <div class="card">
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div id="incrustarTablaReporteVentasProductos"></div>
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







