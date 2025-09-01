<?php
require_once "conexion.php";

$indiceReporteDeVentasPorVendedor = array_search("Reporte de devoluciones por vendedor",$array,true);

if($indiceReporteDeVentasPorVendedor !== false){
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <center><h1 style="font-size: 40px; font-weight: 900;">Devoluciones por Vendedor</h1></center>
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
                <div class="col-sm-2">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Rango de fecha</label>
                    <select class="form-control" name="no_rango" id="no_rango">
                      <option value="">--Selecciona--</option>
                      <option value="1">Hoy</option>
                      <option value="2">Ayer</option>
                      <option value="3">Semana actual</option>
                      <option value="4">Semana anterior</option>
                      <option value="5">Últimos 7 días</option>
                      <option value="6">Últimos 30 días</option>
                      <option value="7">Este mes</option>
                      <option value="8">Último mes</option>
                      <option value="9">Rango personlizado</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3" id="incrustarRangoFecha">

                </div>





                <div class="col-sm-4">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Vendedor</label>
                    <select class="form-control select2" id="id_vendedor" name="id_vendedor" style="width: 100%;">
                      <option value="">--Selecciona--</option>
                      <?php

                      $vendedores = ControladorVendedores::ctrMostrarVendedores();

                      foreach ($vendedores as $key => $value) {

                        echo '<option value="'.$value["id_vendedor"].'">'.$value["nombres"].'</option>';

                      }

                      ?>
                    </select>

                  </div>
                </div>





                <div class="col-sm-3">
                  <label>Acciones</label>
                  <div class="form-group">
                    <button class="btn-sm btn-success btnExportarPDFReporteDevolucionesVendedor">PDF</button>
                    
                    <button class="btn-sm btn-warning btnExportarEXCELReporteDevolucionesVendedor">EXCEL</button> 
                  </div>
                </div>

                



                <input type="hidden" name="id_sucursal" id="id_sucursal" value="<?php echo $traerSucursal['id_sucursal'] ?>">
                    <input type="hidden" name="nombre_sucursal" id="nombre_sucursal" value="<?php echo $traerSucursal['nombre'] ?>">







                <div class="col-12">
                  <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body" id="incrustarTablaReporteDevolucionesVendedor">

                    </div>
                    <!-- /.card-body -->
                  </div>

                  <!-- /.card -->
                </div>









                <div class="col-12">
                  <br><br><br><br><br><br>
                  <center>
                    <button class="btn-sm btn-success" id="btnExportarPDFReporteDevolucionesProductosVendedoresGenerales">PDF General</button>

                    <button class="btn-sm btn-warning" id="btnExportarEXCELReporteDevolucionesProductosVendedoresGenerales">EXCEL General</button>
                  </center>
                  <div class="card">
                    <!-- /.card-header -->
                    <!--<div class="card-body" id="incrustarTablaReporteVentasProductosVendedor">

                    </div>-->
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







