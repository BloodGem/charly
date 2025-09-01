<?php
$indiceCrearDevoluciones = array_search("Crear devoluciones",$array,true);

                        if($indiceCrearDevoluciones !== false){
?>
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
                        <input onkeyup="buscarAhoraVentasDevoluciones($('#buscarVentasDevoluciones').val());" teclaEsc = "si" type="text" class="form-control" id="buscarVentasDevoluciones" name="buscarVentasDevoluciones" autofocus>
                      </div>
                    </div>
                  </center>
                  <br>
                  <div class="input-group">
                    <table class="table table-bordered table-striped listaProductosVentas">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Folio</th>
                          <th>Cliente</th>
                          <th style="text-align: right;">Total</th>
                          <th>Tipo venta</th>
                          <th>Fecha</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody id="incrustarTablaVentasDevoluciones">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <form method="post" role="form" id="formularioDevolucion" name="formularioDevolucion" class="formularioDevolucion">

              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <div class="row">
                    <div class="col-12">
                      <center>
                        <div class="icheck-primary d-inline">
                        <input type="checkbox" id="devolverVentaEntera">
                        <label for="devolverVentaEntera">
                          Devolver todo
                        </label>
                      </div>
                      </center>
                    </div>
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
          <input type="hidden" class="form-control" name="listaProductosDevolucion" id="listaProductosDevolucion" readonly>

          <input type="hidden" class="form-control" name="idVentaDevolucionSeleccionada" id="idVentaDevolucionSeleccionada" readonly>

          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
              </div>
              <div class="card-body">
                <div class="row">

                  <div class="col-lg-4 col-12">
                <div class="form-group">
  
                      <div class="input-group">
                        <div class="input-group-append">
                          <span class="input-group-text">TIPO DEVOLUCIÓN</span>
                        </div>
                        <div class="custom-file">
                        <select class="form-control select2" id="nuevoTipoDevolucion" name="nuevoTipoDevolucion" style="width: 100%;">
                          <option value="">--Selecciona--</option>
                          <option value="1">Efectivo</option>
                          <option value="2">Físico</option>
                        </select>
                      </div>
                      </div>
                    
                </div>
              </div>




                  <div class="col-lg-4 col-12">
                <div class="form-group">
  
                      <div class="input-group">
                        <div class="input-group-append">
                          <span class="input-group-text">MOTIVO</span>
                        </div>
                        <div class="custom-file">
                        <select class="form-control select2" id="nuevoIdMotivoDevolucion" name="nuevoIdMotivoDevolucion" style="width: 100%;">
                          <option value="">--Selecciona--</option>
                          <?php

                          $motivos_devoluciones = ControladorOtros::ctrMostrarMotivosDevoluciones();

                          foreach ($motivos_devoluciones as $key => $value) {

                            echo '<option value="'.$value["id_motivo_devolucion"].'">'.$value["motivo_devolucion"].'</option>';

                          }

                          ?>
                        </select>
                      </div>
                      </div>
                    
                </div>
              </div>



              <div class="col-lg-4 col-12">
                      <div class="input-group">
                        <div class="input-group-append">
                          <span class="input-group-text">Total devolución </span>
                        </div>

                        <input type="text" style="text-align: center;" class="form-control input-lg" id="nuevoTotalDevolucion" name="nuevoTotalDevolucion" total="" placeholder="00000" tabindex="-1" readonly required>

                        <input type="hidden" name="totalDevolucion" id="totalDevolucion">
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
            <center><input type="button" class="btn btn-info" id="btnConfirmarDevolucion" value="GENERAR DEVOLUCIÓN"></center>
          </div>



  </form>
<?php 
        $crearDevolucion = new ControladorDevoluciones();
        $crearDevolucion -> ctrCrearDevolucion();


    ?>

<br><br>
</section>

</div>


<?php
}
?>








