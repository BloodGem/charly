<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">





  <!-- Main content -->
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

                    <div class="input-group">
                      <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input teclaEsc = "si" type="text" class="form-control" id="buscarProductosAjustesInventario" name="buscarProductosAjustesInventario" autofocus accesskey="b">
                      </div>
                    </div>

                  </div>
                </center>
                <br>
                <div class="input-group">
                  <table class="table table-bordered table-striped listaProductosAjustesInventario">
                    <thead>
                      <tr>
                        <th style="width:5px">Imgs</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th style="text-align: right;">Stock</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody id="incrustarTablaProductosAjustesInventario"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>



        <div class="col-md-12">
          <form method="post" role="form" class="formularioAjusteInventario" id="formularioAjusteInventario">


            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <div class="row">
                  <div class="col-1">
                  </div>
                  <div class="col-3">
                    Clave
                  </div>
                  <div class="col-6">
                    Descripción
                  </div>
                  <div class="col-2">
                    Cantidad
                  </div>

                </div>
              </div>
              <div class="card-body nuevoProducto" id="a">



              </div>
            </div>
          </div>
          <input type="hidden" class="form-control" name="listaProductos" id="listaProductos">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <center><h4>¿Qué tipo de ajuste es?</h4></center>
              </div>
              <div class="card-body">


                  <br><br>

                  <center>
                    <!-- radio -->
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-6 col-12">
                      <div class="icheck-success">
                        <input type="radio" name="nuevoTipoAjuste" id="tipoAjusteEntrada" value="1">
                        <label for="tipoAjusteEntrada">
                          Entrada
                        </label>
                      </div>
                    </div>
                      <div class="col-lg-6 col-12">
                      <div class="icheck-danger">
                        <input type="radio" name="nuevoTipoAjuste" id="tipoAjusteSalida" value="0">
                        <label for="tipoAjusteSalida">
                          Salida
                        </label>
                      </div>
                    </div>
                    </div>
                    </div>
                  

                  </center>





              </div>
            </div>
          </div>




          <div class="col-12">
            <center><input type="button" class="btn btn-info" id="btnSubmitCrearAjusteInventario" value="GENERAR AJUSTE DE INVENTARIO" accesskey="1"></center>
          </div>



        </form>

        <?php 
        $crearAjusteInventario = new ControladorAjustesInventario();
        $crearAjusteInventario -> ctrCrearAjusteInventario();


        ?>

      </div>


    </div>
  </div>






