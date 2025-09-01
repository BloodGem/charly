<?php

  $indiceCrearDevolucionesCompras = array_search("Crear devoluciones de compras",$array,true);

                    if($indiceCrearDevolucionesCompras !== false){
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
                        <input onkeyup="buscarAhoraComprasDevoluciones($('#buscarComprasDevoluciones').val());" teclaEsc = "si" type="text" class="form-control" id="buscarComprasDevoluciones" name="buscarComprasDevoluciones" autofocus>
                      </div>
                    </div>
                  </center>
                  <br>
                  <div class="input-group">
                    <table class="table table-bordered table-striped listaProductosCompras">
                      <thead>
                        <tr>
                          <th>No. Compra</th>
                          <th>Proveedor</th>
                          <th style="text-align: right;">Total</th>
                          <th>Fecha</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody id="incrustarTablaComprasDevoluciones">
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
          <input type="hidden" class="form-control" name="listaProductosDevolucion" id="listaProductosDevolucion">

          <input type="hidden" class="form-control" name="idCompraDevolucionSeleccionada" id="idCompraDevolucionSeleccionada">

          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">
                <div class="form-group">
  
                      <div class="input-group">
                        <div class="input-group-append">
                          <span class="input-group-text">MOTIVO</span>
                        </div>
                        <div class="custom-file">
                        <select class="form-control select2" id="nuevoIdMotivoDevolucion" name="nuevoIdMotivoDevolucion" style="width: 100%;">
                          <option value="">--Selecciona--</option>
                          <?php

                          $motivos_devoluciones = ControladorOtros::ctrMostrarMotivosDevolucionesCompras();

                          foreach ($motivos_devoluciones as $key => $value) {

                            echo '<option value="'.$value["id_motivo_devolucion_compra"].'">'.$value["motivo_devolucion_compra"].'</option>';

                          }

                          ?>
                        </select>
                      </div>
                      </div>
                    
                </div>
              </div>



              <div class="col-md-3">
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
        $crearDevolucion = new ControladorDevolucionesCompras();
        $crearDevolucion -> ctrCrearDevolucionCompra();


    ?>

<br><br>
</section>

</div>











<?php
}
?>