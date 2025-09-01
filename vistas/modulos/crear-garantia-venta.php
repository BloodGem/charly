<!-- Content Wrapper. Contains page content -->
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
                <div class="form-group">
                  <center>
                    <div class="col-sm-6">
                      <div class="input-group input-group-sm">
                        <span class="input-group-append">
                          <button type="button" class="btn btn-disabled btn-flat" tabindex="-1">Busqueda:</button>
                        </span>
                        <input onkeyup="buscarAhoraVentasGarantias($('#buscarVentasGarantias').val());" teclaEsc = "si" type="text" class="form-control" id="buscarVentasGarantias" name="buscarVentasGarantias" autofocus>
                      </div>
                    </div>
                  </center>
                  <br>
                  <div class="input-group">
                    <table class="table table-bordered table-striped listaProductosVentas">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Cliente</th>
                          <th style="text-align: right;">Total</th>
                          <th>Tipo venta</th>
                          <th>Fecha</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody id="incrustarTablaVentasGarantias">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <form method="post" role="form" id="formularioGarantia" name="formularioGarantia" class="formularioGarantia">

              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <div class="row">
                    <div class="col-4">
                      Descripción
                    </div>
                    <div class="col-2">
                      Clave
                    </div>
                    <div class="col-1">
                      A devolver
                    </div>
                    <div class="col-1">
                      Cantidad total devuelta
                    </div>
                    <div class="col-1">
                      Cantidad Vendida
                    </div>
                    
                    <div class="col-1">
                      Precio neto
                    </div>
                    <div class="col-1">
                      Importe a devolver
                    </div>
                    <div class="col-1">
                      Importe devolución
                    </div>
                  </div>
                </div>
                <div class="card-body nuevoProducto" id="a">
                  
                </div>
              </div>
          </div>
          <input type="hidden" class="form-control" name="listaProductosGarantia" id="listaProductosGarantia">

          <input type="hidden" class="form-control" name="idVentaGarantiaSeleccionada" id="idVentaGarantiaSeleccionada">

          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">

              <div class="col-lg-9 col-12">
                    <div class="form-group">
                        <label>Descripción falla</label>
                      <textarea class="form-control" id="nuevoIdMotivoGarantia" name="nuevoIdMotivoGarantia" rows="3" placeholder="">N/A</textarea>
                    </div>
                  </div>



              <div class="col-md-3">
                      <div class="input-group">
                        <div class="input-group-append">
                          <span class="input-group-text">Total devolución </span>
                        </div>

                        <input type="text" style="text-align: center;" class="form-control input-lg" id="nuevoTotalGarantia" name="nuevoTotalGarantia" total="" placeholder="00000" tabindex="-1" readonly required>

                        <input type="hidden" name="totalGarantia" id="totalGarantia">
                        <div class="input-group-append">
                          <span class="input-group-text">$</span>
                        </div>
                      </div>
                    </div>
              </div>
              </div>
            </div>
          </div>


          
          <div class="col-12">
            <center><input type="button" class="btn btn-info" id="btnConfirmarGarantia" value="GENERAR DEVOLUCIÓN"></center>
          </div>



  </form>
<?php 
        $crearGarantia = new ControladorGarantias();
        $crearGarantia -> ctrCrearGarantia();


    ?>

<br><br>
</section>

</div>











