
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!--CONTENIDO-->
    <div class="card">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-lg-6 col-12">
                        <h1 class="m-0"> LISTA DE NOTAS</h1>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <center>
            <div class="col-sm-6">

              <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text">Busqueda:</span>
                </div>
                <div class="custom-file">
                    <input onkeyup="buscarAhoraNotas($('#buscarNotas').val());" teclaEsc = "si" type="text" class="form-control" id="buscarNotas" name="buscarNotas" autofocus>
                </div>
            </div>

        </div>
    </center>
    <!-- /.card-header -->
    <div class="card-body">
      <div id="incrustarTablaNotas"></div>
        
</div>
<!-- /.card-body -->
</div>








<br>
</div>





<div class="modal fade" id="modalConvertirNotaFactura" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Convertir nota a factura</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal"></div>
            <form method="post" name="formularioConvertirNotaFactura" id="formularioConvertirNotaFactura">

                <input type="hidden" id="mostrarIdVenta" name="mostrarIdVenta" readonly>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-lg-3 col-12">
                          <div class="form-group">
                            <label>Fecha:</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="fas fa-calendar"></i>
                              </span>
                          </div>
                          <input type="text" id="nuevaFechaActual" name="nuevaFechaActual" class="form-control" readonly>
                      </div>
                  </div>
              </div>


              <div class="col-lg-3 col-12">
                  <div class="form-group">
                    <label>Total venta:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-dollar-sign"></i>
                      </span>
                  </div>
                  <input type="text" class="form-control" id="mostrarTotalVenta" name="mostrarTotalVenta" readonly>
              </div>
          </div>
      </div>



      <div class="col-lg-6 col-12">
          <div class="form-group">
            <label>Cliente:</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-user"></i>
              </span>
          </div>
          <input type="text" class="form-control" id="mostrarNombreCliente" name="mostrarNombreCliente" readonly>
      </div>
  </div>
</div>
</div>
<div class="row">

    <div class="col-lg-3 col-12">
      <div class="form-group">
        <label>Efectivo:</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <i class="fas fa-dollar-sign"></i>
          </span>
      </div>
      <input type="text" class="form-control" id="mostrarImporteEfectivo" name="mostrarImporteEfectivo" readonly>
  </div>
</div>
</div>




<div class="col-lg-3 col-12">
  <div class="form-group">
    <label>Tarjeta Débito:</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <i class="fas fa-dollar-sign"></i>
      </span>
  </div>
  <input type="text" class="form-control" id="mostrarImporteTarjetaDebito" name="mostrarImporteTarjetaDebito" readonly>
</div>
</div>
</div>




<div class="col-lg-3 col-12">
  <div class="form-group">
    <label>Tarjeta Credito:</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <i class="fas fa-dollar-sign"></i>
      </span>
  </div>
  <input type="text" class="form-control" id="mostrarImporteTarjetaCredito" name="mostrarImporteTarjetaCredito" readonly>
</div>
</div>
</div>



<div class="col-lg-3 col-12">
  <div class="form-group">
    <label>Transferencia:</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <i class="fas fa-dollar-sign"></i>
      </span>
  </div>
  <input type="text" class="form-control" id="mostrarImporteTransferencia" name="mostrarImporteTransferencia" readonly>
</div>
</div>
</div>


</div>
<br>
<center>





    <div class="row" id="esFactura">
    <div class="col-lg-4 col-12" id="formaPago">
        
    </div>

    <div class="col-lg-4 col-12" id="cfdi">

    </div>

    <div class="col-lg-4 col-12" id="metodoPago">

    </div>

</div>

    


</center>


</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-primary btnConfirmarConvertirNotaFactura">Registrar</button>
</div>

<?php 
$convertirNotaFactura = new ControladorNotas();
$convertirNotaFactura -> ctrConvertirNotaFactura();


?>

</form>

</div>
</div>
</div>










<div class="modal fade" id="modalVerPartidasVenta" data-backdrop="static" data-keyboard="false">
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
        </div>

    </div>
</div>
</div>