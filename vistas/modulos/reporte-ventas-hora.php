<?php
require_once "conexion.php";
require_once "controladores/reportes-ventas.controlador.php";
require_once "modelos/reportes-ventas.modelo.php";
$indiceReporteVentasHora = array_search("Reporte de ventas por hora",$array,true);

if($indiceReporteVentasHora !== false){
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <center><h1 style="font-size: 40px; font-weight: 900;">Rerpote Ventas por Hora</h1></center>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form method="post" enctype="multipart/form-data" id="formularioGenerarReporteVentasHora">
        <div class="row">

          <div class="col-lg-3"></div>

          <div class="col-lg-6 col-12">
            <div class="input-group">
              <div class="input-group-append">
                <span class="input-group-text" style="font-size: 20px; height:60px;">Fecha Inicial:</span>
              </div>
              <input type="date" class="form-control" style="font-size: 30px; height:60px;" id="fechaInicialRVH" name="fechaInicialRVH" autofocus>
            </div>
          </div>

          <div class="col-lg-3"></div>


          <br><br><br><br>


          <div class="col-lg-3"></div>

          <div class="col-lg-6 col-12">
            <div class="input-group">
              <div class="input-group-append">
                <span class="input-group-text" style="font-size: 20px; height:60px;">Fecha Final:</span>
              </div>
              <input type="date" class="form-control" style="font-size: 30px; height:60px;" id="fechaFinalRVH" name="fechaFinalRVH" autofocus>
            </div>
          </div>

          <div class="col-lg-3"></div>

        </div>

        <br><br>

        <input type="hidden" name="idSucursalRVH" id="idSucursalRVH" value="<?php echo $traerSucursal['id_sucursal'] ?>">

        <center><button type="button" class="btn-lg btn-info" id="btnGenerarReporteVentasHora">Generar Reporte</button></center>


        <?php

        $generar_reporte = new ControladorReportesVentas();
        $generar_reporte -> ctrCargarHoraReporteVentasHora();

        ?>
      </form>
        














      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>


<?php } ?>







