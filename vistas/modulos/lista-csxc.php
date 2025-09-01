<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!--CONTENIDO-->
    <div class="card">
        <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-lg-6 col-12">
                <h1 class="m-0"> LISTA DE CUENTAS X COBRAR</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

    <center>
        <div class="col-sm-6">

          <div class="input-group">
            <div class="input-group-append">
                <span class="input-group-text">Busqueda:</span>
            </div>
            <div class="custom-file">
                <input onkeyup="buscarAhoraCsxc($('#buscarCsxc').val());" type="text" class="form-control" id="buscarCsxc" name="buscarCsxc" autofocus>
            </div>
        </div>

    </div>
</center>
<!-- /.card-header -->
<div class="card-body">
    <table class="table table-bordered table-striped" id="tablaClientesDeuda">
        <thead>
          <tr>
            <th>Folio</th>
            <th>Cliente</th>
            <th style="text-align: right;">Adeudos</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody id="listaCsxc">
    </tbody>
    <tfoot>
      <tr>
        <th>Folio</th>
        <th>Cliente</th>
        <th style="text-align: right;">Adeudos</th>
        <th>Acciones</th>
    </tr>
</tfoot>
</table>
</div>
<!-- /.card-body -->
</div>








<br>
</div>





<div class="modal fade" id="modalVerCsxcCliente" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seguimiento venta</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal"></div>
            <div class="modal-body">


                <div class="row">

                    <div class="col-sm-6">

                        <div class="form-group">
                            <label>Cliente:</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="fas fa-user"></i>
                              </span>
                          </div>

                          <input type="text" class="form-control" id="mostrarNombreClienteC" name="mostrarNombreClienteC" disabled >
                      </div>
                  </div>
              </div>
              <div class="col-sm-5">
                  <div class="form-group">
                    <label>Total de adeudos:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-dollar-sign"></i>
                      </span>
                  </div>

                  <input type="text" class="form-control" id="mostrarAdeudoTotalC" name="mostrarAdeudoTotalC" readonly>
              </div>
          </div>
      </div>

  </div>


  <hr>
  <table class="table table-bordered table-striped listaCsxcCliente" id="tablaCsxcCliente">
    <thead>
      <tr>
        <th></th>
        <th>Id venta</th>
        <th style="text-align: right;">Saldo Inicial</th>
        <th style="text-align: right;">Saldo actual</th>
        <th>Fecha</th>
        <th>Acciones</th>
    </tr>
</thead>
<tbody id="listaFacturasCliente">

</tbody>
<tfoot>
  <tr>
    <th></th>
    <th>Id venta</th>
    <th style="text-align: right;">Saldo Inicial</th>
    <th style="text-align: right;">Saldo actual</th>
    <th>Fecha</th>
    <th>Acciones</th>
</tr>
</tfoot>
</table>
<form method="post" role="form" id="formularioCsxc" name="formularioCsxc" class="formularioCsxc">
    <input type="hidden" id="mostrarIdClienteC" name="mostrarIdClienteC">






    <div class="card card-primary">
        <div class="card-header">
          <div class="row">
            <div class="col-1">
            </div>
            <div class="col-3">
              ID Venta
          </div>
          <div class="col-4">
              Cantidad a abonar
          </div>
          <div class="col-4">
              Deuda actual
          </div>
      </div>
  </div>
  <div class="nuevaVenta" id="a">



  </div>
</div>









<input type="hidden" name="listaCsxcCC" id="listaCsxcCC">
<input type="hidden" name="nuevoTotalImporteC" id="nuevoTotalImporteC">
<div class="row">

    <div class="col-lg-3 col-12"><h3>TOTAL A ABONAR: $</h3></div>
    <div class="col-lg-2 col-12"><h3 id="textoTotal"></h3></div>
</div>


<button type="button" class="btn btn-primary btnGenerarCxc">Registrar</button>

<?php 
$crearAbono = new ControladorCsxc();
$crearAbono -> ctrCrearAbono();

?>
</form>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>
</div>
</div>

</div>















<div class="modal fade" id="modalVerSeguimientoVenta" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seguimiento venta</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal"></div>
            <div class="modal-body">




                <div class="row">

                    <div class="col-sm-6">


                        <div class="form-group">
                            <label>Cliente:</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="fas fa-user"></i>
                              </span>
                          </div>

                          <input type="text" class="form-control" id="mostrarNombreCliente" name="mostrarNombreCliente" disabled >
                          <input type="hidden" id="mostrarIdCliente" name="mostrarIdCliente">
                      </div>
                  </div>
              </div>

              <div class="col-sm-2 venta">
                  <div class="form-group">
                    <label>Venta:</label>
                    <input type="number" class="form-control" id="mostrarIdVenta" name="mostrarIdVenta" readonly>
                </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                    <label>Adeudo inical:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-dollar-sign"></i>
                      </span>
                  </div>
                  <input type="text" class="form-control" id="mostrarSaldoInicial" name="mostrarAdeudoInicial" disabled readonly>
              </div>
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
                    <label>Adeudo actual:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-dollar-sign"></i>
                      </span>
                  </div>
                  <input type="text" class="form-control" id="mostrarSaldoActual" name="mostrarSaldoActual" readonly>
              </div>
          </div>

    </div>


</div>



<hr>
<table class="table table-bordered table-striped" id="tablaPagosVenta">
    <thead>
      <tr>
        <th>Fecha</th>
        <th style="text-align: right;">Importe</th>

    </tr>
</thead>
<tbody id="listaSeguimiento">

</tbody>
<tfoot>
  <tr>
    <th>Fecha</th>
    <th style="text-align: right;">Importe</th>
</tr>
</tfoot>
</table>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>
</div>
</div>
</div>










<div class="modal fade" id="modalVerPartidasVenta">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Partidas de la venta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div id="incrustarTablaPartidasVenta">

              </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>

    </div>
</div>
</div>