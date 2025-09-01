<?php
include "conexion.php";

$indiceReporteVentasProductoVendedor = array_search("Reporte de ventas por producto por vendedor",$array,true);

  if($indiceReporteVentasProductoVendedor !== false){
  ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <center><h1 style="font-size: 40px; font-weight: 900;">Reporte de ventas por producto por vendedor</h1></center>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          
          <div class="col-md-12">
            
            <!-- DONUT CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Búsqueda</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" id="btnCardBusqueda" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-4 col-12">

                    <div class="row">

                      <div class="col-12">
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-append">
                              <span class="input-group-text">Busqueda:</span>
                            </div>
                            <div class="custom-file">
                              <input onkeyup="buscarAhoraProductos($('#buscarProductos').val());" type="text" class="form-control" id="buscarProductos" name="buscarProductos" autofocus>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-12">

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

                      <div class="col-12" id="incrustarRangoFecha">
                        
                      </div>

                      <div class="col-12">
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

                      <input type="hidden" name="id_sucursal" id="id_sucursal" value="<?php echo $traerSucursal['id_sucursal'] ?>">

                      <div class="col-12 text-center">
                      <label>Acciones</label>
                      <div class="form-group">
                    <!--<button class="btn-sm btn-success btnExportarPDFReporteEspecificoProductos">PDF</button>-->
                    
                    <button class="btn-sm btn-warning btnExportarEXCELReporteVentasProductoVendedor">EXCEL</button> 
                  </div>
                </div>

                      <input type="hidden" id="id_producto">
                      <input type="hidden" id="clave_producto">
                      <input type="hidden" id="descripcion_producto">
                    </div>
                    
                  </div>

                  <div class="col-lg-8 col-12">

                    <div id="incrustarTablaProductos">
                      
                    </div>
                    
                  </div>

                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
          </div>










          <div class="col-md-12">
            
            <!-- DONUT CHART -->
            <div class="card card-info">
              <div class="card-header align-content-between">
                <h3 class="card-title">Especificaciones del producto:</h3>

                <strong><span id="textoProductoSeleccionado"></span></strong>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" id="btnCardEspecificaciones" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12" id="incrustarTablaReporteVentasProductoVendedor">
                  </div>


                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
          </div>
          <!-- /.col -->
        </div>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>










  <?php } ?>