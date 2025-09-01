<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<?php

                    $id_ajuste_inventario = $_GET["id_ajuste_inventario"];

                    $traerAjusteInventario = ControladorAjustesInventario::ctrMostrarAjusteInventario($id_ajuste_inventario);
                    //var_dump($traerAjusteInventario);
                    if ($traerAjusteInventario["estatus"] == 0) {
                      

                    $id_usuario = $traerAjusteInventario["id_usuario_creador"];

                    $vendedor = ControladorUsuarios::ctrMostrarUsuario($id_usuario);

                    //var_dump($vendedor);



                ?>



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
          <form method="post" role="form" class="formularioAjusteInventario" id="formularioEditarAjusteInventario">




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


                  <?php 

                  $listaProductos = json_decode($traerAjusteInventario["productos"], true);
                  $contador = 0;
                foreach ($listaProductos as $key => $value) {

                  $contador = $contador + 1;

                  $traerProducto = ControladorProductos::ctrMostrarProducto($value['id_producto']);

                  echo'<div class="row">
                              <div class="col-1">
                              <button type="button" class="btn btn-danger quitarProducto" id_producto="'.$value['id_producto'].'" accesskey="q"><i class="fa fa-times"></i></button>
                              </div>
                              <div class="col-3">
                              <input type="text" class="form-control nuevaClaveProducto" value="'.$traerProducto['clave_producto'].'" readonly tabindex="-1">
                              </div>
                              <div class="col-6">
                              <input type="text" class="form-control nuevaDescripcionProducto" id_producto="'.$value['id_producto'].'" placeholder="" name="agregarProducto" value="'.$traerProducto['descripcion_corta'].'" readonly tabindex="-1">
                              </div>
                              <div class="col-2 ingresoCantidad">
                              <input type="number" style="text-align: right;" class="form-control nuevaCantidadProducto" id="nuevaCantidadProducto'.$contador.'" name="nuevaCantidadProducto'.$contador.'" min="1" value="'.$value['cantidad'].'" step="1" required>
                              </div>
                              
                              </div>';
                }


                   ?>
                       
                
                 
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



                         <?php
                      if($traerAjusteInventario["tipo_ajuste"] == 1){

                        echo '<div class="col-lg-6 col-12">
                      <div class="icheck-success">
                        <input type="radio" name="nuevoTipoAjuste" id="tipoAjusteEntrada" value="1" checked>
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
                    </div>';

                      }else{

                        echo '<div class="col-lg-6 col-12">
                      <div class="icheck-success">
                        <input type="radio" name="nuevoTipoAjuste" id="tipoAjusteEntrada" value="1">
                        <label for="tipoAjusteEntrada">
                          Entrada
                        </label>
                      </div>
                    </div>
                      <div class="col-lg-6 col-12">
                      <div class="icheck-danger">
                        <input type="radio" name="nuevoTipoAjuste" id="tipoAjusteSalida" value="0" checked>
                        <label for="tipoAjusteSalida">
                          Salida
                        </label>
                      </div>
                    </div>';

                      }
                       ?>




                        
                    </div>
                    </div>
                  

                  </center>





              </div>
            </div>
          </div>


<input type="hidden" id="id_ajuste_inventario" name="id_ajuste_inventario" value="<?php echo $id_ajuste_inventario; ?>">


<div class="col-12">
        <center><input type="button" class="btn btn-info" id="btnSubmitEditarAjusteInventario" value="GUARDAR CAMBIOS" accesskey="1"></center>
    </div>



  </form>

<?php 
        $editarAjusteInventario = new ControladorAjustesInventario();
        $editarAjusteInventario -> ctrEditarAjusteInventario();

      }else{
        echo "<script>

          Swal.fire({
  icon: 'error',
  title: 'ESTA AJUSTE YA HA SIDO CONFIRMADO O NO EXISTE',
  showConfirmButton: true
}).then(function(result){
            
              window.location = 'lista-ajustes-inventario';

          });
        

        </script>";
      }


    ?>

</div>

</div>
</div>

