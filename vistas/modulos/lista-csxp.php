<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!--CONTENIDO-->
    <div class="card">
        <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-lg-6 col-12">
                <h1 class="m-0"> LISTA DE CUENTAS X PAGAR</h1>
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
                <input onkeyup="buscarAhoraCsxp($('#buscarCsxp').val());" type="text" class="form-control" id="buscarCsxp" name="buscarCsxp" autofocus>
            </div>
        </div>

    </div>
</center>
<!-- /.card-header -->
<div class="card-body" id="incrustarTablaCsxp">
    
</div>
<!-- /.card-body -->
</div>








<br>
</div>





<div class="modal fade" id="modalVerCsxpProveedor" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seguimiento compra</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-text="true">&times;</span></button>
            </div>
            <div class="modal"></div>
            <div class="modal-body">


                <div class="row">

                    <div class="col-sm-6">

                        <div class="form-group">
                            <label>Proveedor:</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="fas fa-user"></i>
                              </span>
                          </div>

                          <input type="text" class="form-control" id="mostrarNombreProveedorC" name="mostrarNombreProveedorC" disabled >
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
  <div id="incrustarTablaComprasCsxp"></div>
<form method="post" role="form" id="formularioCsxp" name="formularioCsxp" class="formularioCsxp">
    <input type="hidden" id="mostrarIdProveedorC" name="mostrarIdProveedorC">






    <div class="card card-primary">
        <div class="card-header">
          <div class="row">
            <div class="col-1">
            </div>
            <div class="col-3">
              ID Compra
          </div>
          <div class="col-4">
              Cantidad a abonar
          </div>
          <div class="col-4">
              Deuda actual
          </div>
      </div>
  </div>
  <div class="nuevaCompra" id="a">



  </div>
</div>









<input type="hidden" name="listaCsxpCC" id="listaCsxpCC">
<input type="hidden" name="nuevoTotalImporteC" id="nuevoTotalImporteC">
<div class="row">

    <div class="col-lg-3 col-12"><h3>TOTAL A ABONAR: $</h3></div>
    <div class="col-lg-2 col-12"><h3 id="textoTotal"></h3></div>
</div>


<button type="button" class="btn btn-primary btnGenerarCxp">Registrar</button>

<?php 
$crearAbono = new ControladorCsxp();
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















<div class="modal fade" id="modalVerSeguimientoCompra" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seguimiento compra</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-text="true">&times;</span></button>
            </div>
            <div class="modal"></div>
            <div class="modal-body">




                <div class="row">

                    <div class="col-lg-5">


                        <div class="form-group">
                            <label>Proveedor:</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="fas fa-user"></i>
                              </span>
                          </div>

                          <input type="text" class="form-control" id="mostrarNombreProveedor" name="mostrarNombreProveedor" disabled >
                          <input type="hidden" id="mostrarIdProveedor" name="mostrarIdProveedor">
                      </div>
                  </div>
              </div>

              <div class="col-lg-1 compra">
                  <div class="form-group">
                    <label>Compra:</label>
                    <input type="number" class="form-control" id="mostrarIdCompra" name="mostrarIdCompra" readonly>
                </div>
            </div>

            <div class="col-lg-2">
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

        <div class="col-lg-2">
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



    <div class="col-lg-2">
          <div class="form-group">
                    <label>Total abonos:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-dollar-sign"></i>
                      </span>
                  </div>
                  <input type="text" class="form-control" id="mostrarTotalAbonos" name="mostrarTotalAbonos" readonly>
              </div>
          </div>

    </div>


</div>



<hr>
<div id="incrustarTablaPagosCompra"></div>

</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>
</div>
</div>
</div>










<div class="modal fade" id="modalVerPartidasCompra">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Partidas de la compra</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-text="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div id="incrustarTablaPartidasCompra">

              </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>

    </div>
</div>
</div>