<div class="content-wrapper">

    <?php

    $traerClientes = ControladorClientes::ctrMostrarClientes(null, null);

        

                
    foreach ($traerClientes as $key => $row) {

        $id_cliente = $row['id_cliente'];

        

        $pattern = '0123456789abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ.-_*/=[]{}#@&()?¿';
        $password = "";
    $max = strlen($pattern)-1;
    for($i = 0; $i < 12; $i++){
        $password .= substr($pattern, mt_rand(0,$max), 1);
    }




            $respuesta = ControladorClientes::ctrActualizarCliente("password", $password, $id_cliente, 1);

            var_dump($respuesta);
    }

    /*require_once "conexion.php"; 

        $sql = "SELECT * FROM ventas WHERE fecha_creacion BETWEEN '2025-07-08 00:00:00' AND '2025-07-30 23:59:59' AND ventas.pagada = 1 AND ventas.cancelada = 0 AND ventas.tipo_venta = 'NT' AND ventas.id_sucursal = 1 ORDER BY ventas.id DESC";


        $rs = $conexion->query($sql);
while($row = $rs->fetch_array(MYSQLI_BOTH)){
$id_venta = $row['id'];

echo '<script>window.open("extensiones/tcpdf/examples/pdf-ticket-venta.php?id_venta='.$id_venta.'", "_blank");</script>';

}*/

     ?>

<!--<button class="btn btn-primary" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalComprimirNotasFacturaGlobal">Quiero comprimir</button>
</div>





<div class="modal fade" id="modalComprimirNotasFacturaGlobal">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioComprimirNotasFacturaGlobal">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres obtener las notas de esta factura global?</p>
                          <br><br>
                          <input type="hidden" id="comprimirNotasFacturaGlobal" name="comprimirNotasFacturaGlobal" value="2">
                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">No</button>
                          <button type="submit" class="btn btn-primary btn-lg">Si</button>

                      </div>


                  </div>


              </div>



              <?php 
              /*$comprimir_notas_factura_global = new ControladorFacturasGlobales();
              $comprimir_notas_factura_global -> ctrComprimirNotasFacturaGlobal();*/


              ?>
          </form>

      </div>
  </div>-->
</div>