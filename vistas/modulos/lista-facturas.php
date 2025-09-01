
<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> LISTA DE FACTURAS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">
                      <a href="crear-venta" accesskey="1">
                        <button class="btn btn-primary">Crear Venta</button>
                        </a>
                    </div>
                </div><!-- /.col -->
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
                        <input onkeyup="buscarAhoraFacturas($('#buscarFacturas').val());" type="text" class="form-control" id="buscarFacturas" name="buscarFacturas" autofocus>
                      </div>
                    </div>
    
</div>
</center>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                  <tr>
                    <th>No.</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Tipo venta</th>
                    <th>Fecha</th>
                  </tr>
                  </thead>
                  <tbody id="listaFacturas">
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Tipo venta</th>
                    <th>Fecha</th>
                  </tr>
                  </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>








<br>
</div>





<div class="modal fade" id="modalConvertirNotaFactura">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Facturar</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal"></div>
            <form method="post" name="formularioFacturar" id="formularioFacturar">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-3">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Fecha:</label>
                            <input type="text" id="nuevaFechaActual" name="nuevaFechaActual" class="form-control" readonly>
                            <input type="text" id="mostrarIdVenta" name="mostrarIdVenta" readonly>

                        </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Saldo actual:</label>
                        <input type="text" class="form-control" id="mostrarTotalVenta" name="mostrarTotalVenta" readonly>
                    </div>
                </div>
                <div class="col-sm-5">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Cliente:</label>
                    <input type="text" class="form-control" id="mostrarNombreCliente" name="mostrarNombreCliente" readonly>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label>Efectivo:</label>
                <input type="number" step="any" class="form-control" id="nuevoImporteEfectivo" name="nuevoImporteEfectivo">
            </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
            <label>Tarjeta débito:</label>
            <input type="number" class="form-control" id="nuevoImporteTarjetaDebito" name="nuevoImporteTarjetaDebito" value="0">
        </div>
    </div>

    <div class="col-sm-4">
      <div class="form-group">
        <label>Tarjeta Credito:</label>
        <input type="number" class="form-control" id="nuevoImporteTarjetaCredito" name="nuevoImporteTarjetaCredito" value="0">
    </div>
</div>

</div>
<br>
<center>


    <div class="col-sm-4">
      <div class="form-group">
        <label>Total importe:</label>
        <input type="number" class="form-control" id="nuevoImporteTotal" name="nuevoImporteTotal" readonly>
    </div>
</div>


<div class="col-sm-4">
  <div class="form-group">
    <label>Cambio:</label>
    <input type="number" class="form-control" id="nuevoCambioCobro" name="nuevoCambioCobro" readonly>
</div>
</div>


<div class="row" id="esFactura">
    <div class="col-sm-4" id="formaPago">
        
    </div>

    <div class="col-sm-4" id="cfdi">

    </div>

    <div class="col-sm-4" id="metodoPago">

    </div>

</div>




</center>


</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary"  onclick="verificarImporteTotalPago();">Registrar</button>

    <?php 
$cobroVenta = new ControladorVentas();
$cobroVenta -> ctrFacturar();


?>

</form>
</div>



</div>
</div>
</div>