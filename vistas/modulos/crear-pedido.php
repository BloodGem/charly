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
                    <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Cliente</span>
                      </div>
                      <div class="custom-file">
                        <select class="form-control select2" id="nuevoIdCliente" name="nuevoIdCliente" style="width: 100%;">
                    <?php

                      $item = null;
                      $valor = null;

                      $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                      foreach ($clientes as $key => $value) {

                        echo '<option no_precio="'.$value["no_precio"].'" descuento="'.$value["descuento"].'" value="'.$value["id_cliente"].'">'.$value["nombre_comercial"].' - '.$value["rfc"].'</option>';

                      }

                    ?>
                  </select>
                      </div>
                    </div>





                    <input type="text" id="nuevoDescuentoPedido" name="nuevoDescuentoPedido">

                  </div>
                </div>
                </div>


            </div>


             

        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
              </div>
                <div class="card-body">
                  <div class="form-group">
                    <center>
    <div class="col-sm-6">
    <input onkeyup="buscarProductosPedidos($('#buscarProductosPedidos').val());" type="text" class="form-control" id="buscarProductosPedidos" name="buscarProductosPedidos" autofocus>
</div>
</center>
<br>
                    <div class="input-group">
                        <table class="table table-bordered table-striped listaProductosPedidos">
            <thead>
                <tr>
            <th style="width:5px">Imgs</th>
           <th>Código</th>
           <th>Descripción</th>
           <th>Stock</th>
           <th>Precio</th>
           <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="listaProductosPedidos">

            </tbody>
            <tfoot>
                <tr>
            <th style="width:5px">Imgs</th>
           <th>Código</th>
           <th>Descripción</th>
           <th>Stock</th>
           <th>Precio</th>
           <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
                    </div>
                  </div>
                </div>
            </div>
        </div>



        <div class="col-md-12">
          <form method="post" role="form" class="formularioPedido">


                  <input type="text" class="form-control" id="nuevoIdVendedor" name="nuevoIdVendedor" value="<?php echo $_SESSION['id'] ?>" readonly required>


                  <input type="text" class="form-control" id="nuevoIdCliente2" name="nuevoIdCliente2" readonly required>

            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
              </div>
                <div class="card-body nuevoProducto" id="a">
                       
                
                 
                </div>
            </div>
        </div>
<input type="text" name="listaProductos" id="listaProductos">
<div class="col-md-12">
            <!-- general form elements -->
                <div class="card card-primary">
              <div class="card-header">
              </div>
                <div class="card-body">
                  <div class="form-group">
                  <center><div class="col-4">
                    <div class="input-group">
                    <input type="text" class="form-control input-lg" id="nuevoTotalPedido" name="nuevoTotalPedido" total="" placeholder="00000" readonly required>

                              <input type="hidden" name="totalPedido" id="totalPedido">
                    <div class="input-group-append">
                        <span class="input-group-text">$</span>
                      </div>
                  </div>
                  </div></center>

                  <br><br>

<center><div class="col-4">
<div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Tipo pedido</span>
                      </div>
                      <div class="custom-file">
                        <select class="form-control" id="nuevoTipoPedido" name="nuevoTipoPedido">
                          <option value="NT">NOTA</option>
                          <option value="RM">REMISIÓN</option>
                          <option value="FC">FACTURA</option>
                        </select>
                        
                      </div>
                    </div>

                  </div>
                </center>




                  </div>
                </div>
                </div>
            </div>





<div class="col-12">
        <center><input type="submit" class="btn btn-info" value="GENERAR PEDIDO" accesskey="1"></center>
    </div>



  </form>

<?php 
        $crearPedido = new ControladorPedidos();
        $crearPedido -> ctrCrearPedido();


    ?>

</div>


</div>








