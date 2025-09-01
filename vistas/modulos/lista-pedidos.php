
<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> LISTA DE PEDIDOS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">
                      <a href="crear-pedido" accesskey="1">
                        <button class="btn btn-primary">Crear Pedido</button>
                        </a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <center>
    <div class="col-sm-6">
    <input onkeyup="buscarAhoraPedidos($('#buscarPedidos').val());" type="text" class="form-control" id="buscarPedidos" name="buscarPedidos" autofocus>
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
                    <th>Tipo pedido</th>
                    <th>Fecha</th>
                  </tr>
                  </thead>
                  <tbody id="listaPedidos">
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Tipo pedido</th>
                    <th>Fecha</th>
                  </tr>
                  </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>








<br>
</div>





<div class="modal fade" id="modalVerSeguimientoPedido">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Seguimiento pedido</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal"></div>
                <div class="modal-body">


                    <div class="row">

                    <div class="col-sm-5">
                      <!-- text input -->
                        <div class="form-group">
                            <label>Cliente:</label>
                            <input type="text" class="form-control" id="mostrarNombreCliente" name="mostrarNombreCliente" disabled >
                            <input type="hidden" id="mostrarIdCliente" name="mostrarIdCliente">
                        </div>
                    </div>

                    <div class="col-sm-2 pedido">
                      <div class="form-group">
                        <label>Pedido:</label>
                        <input type="number" step="any" class="form-control" id="mostrarIdPedido" name="mostrarIdPedido" readonly>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Adeudo inical:</label>
                        <input type="number" step="any" class="form-control" id="mostrarSaldoInicial" name="mostrarAdeudoInicial" disabled readonly>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Adeudo actual:</label>
                        <input type="number" step="any" class="form-control" id="mostrarSaldoActual" name="mostrarSaldoActual" readonly>
                      </div>
                    </div>

                    <div class="col-sm-1">
                        <div class="form-group">
                            <label></label>
                            <center><button class="btn btn-info btnCrearAbono" id_pedido="" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalCrearAbono">Crear</button></center>
                      </div>
                    </div>

                  </div>



                    <hr>
                    <table class="table table-bordered table-striped">
            <thead>
                  <tr>
                    <th>Importe</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody id="listaSeguimiento">
                    
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Importe</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
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



<div class="modal fade" id="modalCrearAbono">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            
                <div class="modal-header">
                    <h4 class="modal-title">Crear abono</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal"></div>
                <form method="post" name="myForm" id="myForm">
                <div class="modal-body">

                    <div class="row">

                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Fecha:</label>
                        <input type="text" id="nuevaFechaActual" name="nuevaFechaActual" class="form-control" readonly>
                        <input type="text" id="nuevoIdPedido" name="nuevoIdPedido" readonly>
                        <input type="text" id="nuevoIdCliente" name="nuevoIdCliente" readonly>
                      </div>
                    </div>

                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Saldo actual:</label>
                        <input type="text" class="form-control" id="saldoActual" name="saldoActual" readonly>
                      </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Movimiento:</label>
                        <select class="form-control" id="nuevoIdFormaPagoCxc" name="nuevoIdFormaPagoCxc" required>
                            <option value="0">--Selecciona--</option>
                                        <?php

                                        $formas_pago = ControladorOtros::ctrMostrarFormasDePAgo();

                                        foreach ($formas_pago as $key => $value) {
                                            echo '<option value="'.$value["id_forma_pago"].'">'.$value["descripcion"].'</option>';
                                        }

                                        ?>
                                        
                                    </select>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Importe:</label>
                        <input type="number" step="any" class="form-control" id="nuevoImporte" name="nuevoImporte" required>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Documento:</label>
                        <input type="text" class="form-control" id="nuevoDocumento" name="nuevoDocumento">
                      </div>
                    </div>

                  </div>



                  <div class="row">

                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Observaciones:</label>
                        <br>
                        <textarea class="form-control" id="nuevaObservacion" name="nuevaObservacion"></textarea>
                      </div>

                    </div>

                </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="verificarImporte();">Registrar</button>
                </div>

                <?php 
        $crearCxc = new ControladorCsxc();
        $crearCxc -> ctrCrearCxc();

    ?>

            </form>

        </div>
    </div>
</div>


