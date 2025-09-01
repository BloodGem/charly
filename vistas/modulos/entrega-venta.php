<?php
$indiceEntregarVentas = array_search("Entregar ventas",$array,true);

if($indiceEntregarVentas !== false){
?>

        <div class="content-wrapper">

          

<?php

                    $id_venta = $_GET["id_venta"];

                    $venta = ControladorVentas::ctrMostrarVenta($id_venta);
                    //var_dump($venta);
                    if ($venta["pagada"] == 1 && $venta["entregada"] == 0 && $venta["cancelada"] == 0) {
                      

                    /*$id_usuario = $venta["id_usuario"];

                    $vendedor = ControladorUsuarios::ctrMostrarUsuario($id_usuario);

                    //var_dump($vendedor);

                    $id_proveedor = $venta["id_proveedor"];

                    $proveedor = ControladorProveedores::ctrMostrarProveedor($id_proveedor);*/

                    //var_dump($proveedor);

                ?>



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <input type="hidden" class="form-control" id="imp_devoluciones" name="imp_devoluciones" value="<?php echo $traerComputadora['imp_devoluciones'];?>">

            <div class="col-md-12">
            <!-- general form elements -->
                <div class="card card-primary">
              <div class="card-header">
              </div>
                <div class="card-body">

                    <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input type="search" class="form-control" id="escaneador" name="escaneador" placeholder="Escanee aquí" autofocus>

                      </div>
                    </div>
                </div>
                </div>


            </div>





        <div class="col-md-12">
          <form method="post" role="form" id="formularioEntregarVenta">

            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <div class="row">
                  <div class="col-1">
                                .
                              </div>
                              <div class="col-7">
                                Descripción
                              </div>
                              <div class="col-2">
                                Cant entregada
                              </div>
                              <div class="col-2">
                                <center>Cant a entregar</center>
                              </div>
                 
                </div>
              </div>
                <div class="card-body nuevoProducto" id="a">


                  <?php 

                  $partidasVenta = ModeloVentas::mdlMostrarPartidasVenta($id_venta);

                foreach ($partidasVenta as $key => $value) {

                    $id_producto = $value['id_producto'];

                    $traerProducto = ControladorProductos::ctrMostrarProducto($id_producto);

                    $cantidad_entregar = $value['cantidad'] - $value['cant_dev'];

                  echo'<div class="row" id="Partvta'.$value['id_partvta'].'">
                    <div class="col-1">
                              <button type="button" class="btn btn-primary btn-sm btnDevolverProductoEntrega" id_partvta="'.$value['id_partvta'].'">Devolución</button>
                              </div>
                              <div class="col-7">
                              <p>'.$traerProducto['descripcion_corta'].'</p>
                              </div>
                              <div class="col-2 ingresoCantidadEntregar">';

                              if($cantidad_entregar == 0){


                                echo '<input type="text" class="form-control" style="font-weight: bold; background-color: green; color: white;" nuevaCantidad" id="'.$value['id_producto'].'" min="1" value="0" cantidad_entregar="'.$cantidad_entregar.'" step="1" required readonly>';

                              }else{

                                echo '<input type="text" class="form-control nuevaCantidad" id="'.$value['id_producto'].'" min="1" value="0" cantidad_entregar="'.$cantidad_entregar.'" step="1" required readonly>';

                              }

                              echo '</div>
                              <div class="col-2 muestraCantidad">
                              <center><p class="textoCantidadDisponible">'.$cantidad_entregar.'</p></center>
                              </div>
                              </div>
                              <hr style="height: 1px; background-color: black;">';
                }


                   ?>
                       
                
                 
                </div>
            </div>
        </div>
<input type="hidden" name="listaEstatus" id="listaEstatus">





<input type="hidden" id="id_venta" name="id_venta" value="<?php echo $id_venta; ?>">


<div class="col-12">
        <center><button type="button" class="btn btn-info" id="btnConfirmarEntregarVenta">Entregar Venta</button></center>
    </div>
<?php 
        $entregarVenta = new ControladorVentas();
        $entregarVenta -> ctrEntregarVenta();

        ?>


  </form>


  <?php
      }else{
        echo "<script>

          Swal.fire({
  icon: 'error',
  title: 'ESTA VENTA YA HA SIDO ENTREGADA O NO EXISTE O HA SIDO CANCELADA O AUN NO HA SIDO PAGADA',
  showConfirmButton: true
}).then(function(result){
            
              window.location = 'lista-entrega-ventas';

          });
        

        </script>";
      }


    ?>

</div>

</div>
</div>











<div class="modal fade" id="modalDevolverProductoEntrega" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">

        <div class="modal-content">

          <input type="hidden" class="form-control" id="mostrarIdVentaDevolucionProductoEntrega" name="mostrarIdVentaDevolucionProductoEntrega" readonly>
                <div class="modal-header">
                    <h4 class="modal-title" id="textoProductoDevolucionEntrega">Devolución del producto : </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <div class="row">

                    <input type="hidden" id="id_partvta_devolucion_entrega" name="id_partvta_devolucion_entrega">

                    <div class="col-lg-6 col-6">
                      <div class="form-group">
                        <label>Cantidad a devolver</label>
                        <input type="number" class="form-control" id="cantidad_devolver" name="cantidad_devolver">
                        
                      </div>
                    </div>


                    <div class="col-lg-6 col-6">
                      <div class="form-group">
                        <center><label>Cantidad disponible</label>
                        <p id="texto_cantidad_disponible_devolver"></p></center>
                        
                      </div>
                    </div>

                    
                    <div class="col-12">
                      <div class="form-group">
                        <label>Motivo de la devolución</label>
                        <select class="form-control select2" id="nuevoIdMotivoDevolucionProductoEntrega" name="nuevoIdMotivoDevolucionProductoEntrega" style="width: 100%;">
                          <option value="">--Selecciona--</option>
                          <?php

                          $motivos_devoluciones = ControladorOtros::ctrMostrarMotivosDevoluciones();

                          foreach ($motivos_devoluciones as $key => $value) {

                            echo '<option value="'.$value["id_motivo_devolucion"].'">'.$value["motivo_devolucion"].'</option>';

                          }

                          ?>
                        </select>
                        
                      </div>
                    </div>


                  </div>
                  <input type="hidden" class="form-control" id="listaDevolucionProductoEntrega" name="listaDevolucionProductoEntrega">
                </div>
                <div class="modal-footer justify-content-center">
                  <button type="button" class="btn btn-success" id="btnDevolverProductoEntrega">Registrar</button>
                </div>
        </div>
    </div>
</div>

<?php

}

?>