
<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"> LISTA DE VENTAS EN ESPERA</h1>
                </div>
                <div class="col-sm-3">
                    <form method="post" id="formularioCancelarVentas" name="formularioCancelarVentas">
                        <input type="hidden" value="1" name="borrarVentas" id="borrarVentas">
                        <button type="button" class = "btn btn-danger" id="btnCancelarVentas" name="btnCancelarVentas">Cancelar todas las ventas</button>
                        
                        <?php 
        $cancelarVentas = new ControladorVentas();
        $cancelarVentas -> ctrCancelarVentas();


    ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <table id="tablaVentasEspera" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Tipo de venta</th>
                    <th style="text-align: right;">Total</th>
                    <th>Vendedor</th>
                    <th>Acción</th>
                  </tr>
                  </thead>
                  <tbody>
                      
                      <?php
                      
                      $traerVentasEspera = ControladorVentas::ctrMostrarVentasEspera();
                    
                    foreach ($traerVentasEspera as $key => $value) {
                        
                        $traerPartidasVenta = ModeloPartvta::mdlMostrarPartidasVenta($value["id"]);

                        $traerVendedor = ControladorVendedores::ctrMostrarVendedor2($value['id_vendedor']);
                        
                        echo '
                        <tr>
                        <td>'.$value["id"].'</td>
                        <td>'.$value["fecha_creacion"].'</td>
                        <td>'.$value["tipo_venta"].'</td>
                        <td style="text-align: right;">$'.number_format($value["total"], 2).'</td>
                        <td>'.$traerVendedor["nombres"].'</td>
                        <td>
                        <div class="btn-group">
                            
                            <form method="post" id="formularioCancelarVenta'.$value["id"].'" name="formularioCancelarVenta'.$value["id"].'">
                                <input type="hidden" name="id_venta" id="id_venta" value="'.$value["id"].'">
                                <button type="button" class = "btn btn-info btnCancelarVenta2" id_venta = "'.$value["id"].'">Cancelar venta</button>

                                <button type="button" class="btn btn-success btnVerPartidasVenta" id_venta="'.$value["id"].'">Ver venta</button>
                            </td>';
                        
                        
                        
                        echo' </form></tr>';
                    }

                    $cancelarVenta = new ControladorVentas();
                        $cancelarVenta -> ctrCancelarVenta2();
                        
                    
                    ?>
                 
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Tipo de venta</th>
                    <th style="text-align: right;">Total</th>
                    <th>Vendedor</th>
                    <th>Acción</th>
                  </tr>
                  </tfoot>
                </table>
    </div>
    <!-- /.card-body -->
</div>








<br>
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