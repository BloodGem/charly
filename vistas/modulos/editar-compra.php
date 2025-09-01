<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <?php

  $id_compra = $_GET["id_compra"];

  $traerCompra = ControladorCompras::ctrMostrarCompra($id_compra);
                    //var_dump($traerCompra);
                    //
  $id_sucursal = $traerCompra['id_sucursal'];
  if ($traerCompra["estatus"] == 0) {


    $id_usuario = $traerCompra["id_usuario_creador"];

    $vendedor = ControladorUsuarios::ctrMostrarUsuario($id_usuario);

                    //var_dump($vendedor);

    $id_proveedor = $traerCompra["id_proveedor"];



    $proveedor = ControladorProveedores::ctrMostrarProveedor($id_proveedor);



    ?>

    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5>EDITANDO LA COMPRA <?php echo $id_compra; ?></h5>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="lista-compras" id="rutaListaCompras" accesskey="l">Lista de compras</a></li>
                    <li class="breadcrumb-item active">Compra <?php echo $id_compra; ?></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


    <div class="progress">
                  <div class="progress-bar bg-navy progress-bar-striped" id="barraProgresion" role="progressbar"
                       style="width: 0%">
                  </div>
                </div>
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
                <div class="row">
                  <div class="col-lg-5 col-12">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-append">
                          <span class="input-group-text">Proveedor</span>
                        </div>
                        <div class="custom-file">
                          <select class="form-control select2" id="nuevoIdProveedor" name="nuevoIdProveedor" style="width: 100%;" readonly>
                            <?php


                            if($traerCompra['id_proveedor'] !== "0"){
                              echo '<option descuento="'.$proveedor["descuento"].'" value="'.$proveedor["id_proveedor"].'">'.$proveedor["nombre"].' - '.$proveedor["rfc"].'</option>';
                            }else{

                              echo '<option value="">--Selecciona--</option>';

                              $item = null;
                              $valor = null;

                              $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                              foreach ($proveedores as $key => $value) {

                                echo '<option descuento="'.$value["descuento"].'" value="'.$value["id_proveedor"].'">'.$value["nombre"].' - '.$value["rfc"].'</option>';

                              }
                            } 





                            ?>
                          </select>
                        </div>
                      </div>



                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="input-group">
                      <label>Descuentos</label>
                      <input type="text" class="form-control-sm" style="width: 14%;" id="descuento1" name="descuento1" value="<?php echo $traerCompra['descuento1']; ?>">
                      <input type="text" class="form-control-sm" style="width: 14%;" id="descuento2" name="descuento2" value="<?php echo $traerCompra['descuento2']; ?>">
                      <input type="text" class="form-control-sm" style="width: 14%;" id="descuento3" name="descuento3" value="<?php echo $traerCompra['descuento3']; ?>">
                      <input type="text" class="form-control-sm" style="width: 14%;" id="descuento4" name="descuento4" value="<?php echo $traerCompra['descuento4']; ?>">
                      <input type="text" class="form-control-sm" style="width: 14%;" id="descuento5" name="descuento5" value="<?php echo $traerCompra['descuento5']; ?>">
                      <input type="text" class="form-control-sm" style="width: 14%; background-color: black; color: white;" id="nuevoDescuentoCompra" name="nuevoDescuentoCompra" value="<?php echo $traerCompra['descuento_general']; ?>" readonly>
                    </div>

                  </div>
                  <div class="col-lg-1 col-12">
                    <button class="btn-xs btn-dark" id="btnInsertarDecuento">Insertar Descuento</button>
                  </div>
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
                  <div class="row">
                    <div class="col-lg-6 col-12">

                      <div class="input-group">
                        <div class="input-group-append">
                          <span class="input-group-text">Busqueda:</span>
                        </div>
                        <div class="custom-file">
                          <input teclaEsc = "si" type="search" class="form-control" id="buscarProductosCompras" name="buscarProductosCompras" autofocus accesskey="b">
                        </div>
                      </div>

                    </div>
                    <div class="col-lg-6 col-12">
                      <center>
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="verCatalogoCompleto" name="verCatalogoCompleto" value="1">
                          <label for="verCatalogoCompleto" class="custom-control-label">Catálogo Completo?</label>
                        </div>
                      </center>
                    </div>
                  </div>
                  <br>
                  <div class="input-group">
                    <table class="table table-bordered table-striped listaProductosCompras">
                      <thead>
                        <tr>
                          <th style="width:5px">Imgs</th>
                          <th>Código</th>
                          <th>Descripción</th>
                          <th style="text-align: right;">Stock</th>
                          <th style="text-align: right;">Precio</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody id="incrustarTablaProductosCompras"></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>



          <div class="col-md-12">
            <form method="post" role="form" class="formularioCompra" id="formularioCompra" name="formularioCompra">


              <input type="hidden" class="form-control" id="nuevoIdVendedor" name="nuevoIdVendedor" value="<?php echo $vendedor['id']; ?>" readonly required>


              <input type="hidden" class="form-control-sm" style="width: 14%;" id="nuevoDescuento1Compra" name="nuevoDescuento1Compra" value="0">
              <input type="hidden" class="form-control-sm" style="width: 14%;" id="nuevoDescuento2Compra" name="nuevoDescuento2Compra" value="0">
              <input type="hidden" class="form-control-sm" style="width: 14%;" id="nuevoDescuento3Compra" name="nuevoDescuento3Compra" value="0">
              <input type="hidden" class="form-control-sm" style="width: 14%;" id="nuevoDescuento4Compra" name="nuevoDescuento4Compra" value="0">
              <input type="hidden" class="form-control-sm" style="width: 14%;" id="nuevoDescuento5Compra" name="nuevoDescuento5Compra" value="0">

              <input type="hidden" class="form-control-sm" style="width: 14%;" id="nuevoDescuentoGeneralCompra" name="nuevoDescuentoGeneralCompra" value="0">


              <input type="hidden" class="form-control" id="nuevoIdProveedor2" name="nuevoIdProveedor2" value="<?php echo $id_proveedor;?>" readonly required>

              <!-- general form elements -->
              <div class="card card-primary">

                <div class="card-body nuevoProducto" id="a">


                  <?php 

                  $traerPartidasCompra = ControladorPartCom::ctrMostrarPartidasCompra($id_compra);

                  //$listaProductos = json_decode($traerCompra["productos"], true);

                  //var_dump($listaProductos);
                  //
                  $contador = 0;

                  foreach ($traerPartidasCompra as $key => $value) {

                    $contador = $contador + 1;

                    $id_partcom = $value['id_partcom'];

                    $precio_unitario = $value['precio_unitario'];

                    $precio_neto = $value['precio'];

                    $precio_sin_iva = number_format(($value['precio'] / 1.16), 2, '.', '');


                    $descuento =  $value['descuento'];


                    $precio_unitario_descuento = $precio_unitario - ($precio_unitario * ($descuento / 100));

                    $precio_unitario_descuento = number_format($precio_unitario_descuento, 2);


                    $total = number_format(($value['cantidad'] * $precio_neto), 2, '.', '');

                    $id_producto = $value['id_producto'];

                    $traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);


echo '<div class="row" id="div'.$id_partcom.'">
  <div class="col-lg-6 col-12 divPrimeraParte">
    <div class="row rowPrimeraParte">
      <div class="col-lg-1 col-12 divQuitarProducto">
        <button type="button" class="btn btn-xs btn-danger quitarProducto" id_producto="'.$id_producto.'" id_partcom="'.$id_partcom.'" accesskey="q">
          <i class="fa fa-times"></i>
        </button>
      </div>';

      if($id_producto != 0){
      echo'<div class="col-lg-2 col-12 divClaveProducto">
        <label>Clave</label><p>'.$traerProducto['clave_producto'].'</p>
      </div>
      <div class="col-lg-6 col-12 divDescripcion">
        <label>Descripción</label><p>'.$traerProducto['descripcion_corta'].'</p>
      </div>';
      $traerMarca = ControladorMarcas::ctrMostrarMarca($traerProducto['id_marca']);
      echo'<div class="col-lg-3 col-12 divMarca">
        <div class="form-group">
          <label>Marca</label>
          <input type="text" class="form-control inputMarca" id_marca="'.$traerProducto['id_marca'].'" value="'.$traerMarca['marca'].'" readonly>
        </div>
      </div>';

                    }else{
                      echo'<div class="col-lg-2 col-12 divClaveProducto"><label>Clave</label><input type="text" class="form-control nuevaClave" value="'.$value['clave_xml'].'" readonly tabindex="-1"></div>

                      <div class="col-lg-9 col-12 divDescripcion"><button type="button" class="btn btn-primary nuevaDescripcionProducto btnLigarProducto" multiclave="'.$value['clave_xml'].'" id_partcom="'.$id_partcom.'">Ligar producto</button></div>';
                    }

      echo'<div class="col-lg-2 col-6 divPrecio1">
        <label>Precio 1</label>
        <input type="number" class="form-control precio1" value="'.$traerProducto['precio1'].'">
      </div>
      <div class="col-lg-2 col-6 divUtilidad1">
        <label>Utilidad 1</label>
        <input type="number" class="form-control utilidad1" value="'.$traerProducto['utilidad1'].'">
      </div>
      <div class="col-lg-2 col-6 divPrecio2">
        <label>Precio 2</label>
        <input type="number" class="form-control precio2" value="'.$traerProducto['precio2'].'">
      </div>
      <div class="col-lg-2 col-6 divUtilidad2">
        <label>Utilidad 2</label>
        <input type="number" class="form-control utilidad2" value="'.$traerProducto['utilidad2'].'">
      </div>
      <div class="col-lg-2 col-6 divPrecio3">
        <label>Precio 3</label>
        <input type="number" class="form-control precio3" value="'.$traerProducto['precio3'].'">
      </div>
      <div class="col-lg-2 col-6 divUtilidad3">
        <label>Utilidad 3</label>
        <input type="number" class="form-control utilidad3" value="'.$traerProducto['utilidad3'].'">
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-12 divSegundaParte">
    <div class="row rowSegundaParte">';
      if($id_producto != 0){
      echo'<div class="col-lg-6 col-12 divPrecioActual">
        <label>Último Precio Sin iva</label>
        <input type="number" class="form-control" value="'.$traerProducto['precio_compra'].'" disabled>
      </div>';
      }else{
      echo'<div class="col-lg-6 col-12 divPrecioActual"></div>';
      }
      echo'<div class="col-lg-6 col-12 divPrecioCompra">
        <label>Precio factura sin iva</label>
        <input type="number" class="form-control nuevoCostoCompra" name="nuevoCostoCompra" value="'.$precio_unitario.'" step="any" required>
      </div>
      <div class="col-lg-3 col-6 divCantidad">
        <label>Cantidad</label>
        <input type="number" class="form-control nuevaCantidadProducto" id="nuevaCantidadProducto'.$contador.'" name="nuevaCantidadProducto'.$contador.'" onkeydown="numerosSinDecimales()" min="1" value="'.$value['cantidad'].'" step="1" required>
      </div>
      <div class="col-lg-3 col-6 divDescuento">
        <label>Descuento</label>
        <input type="number" class="form-control nuevoDescuentoProducto" name="nuevoDescuentoProducto" value="'.$descuento.'" descuento="'.$descuento.'" step="any">
      </div>
      <div class="col-lg-3 col-6 divPrecioUnitario">
        <label>Precio Unitario con iva</label>
        <input type="number" class="form-control nuevoPrecioProductoSinIva" value="'.$precio_neto.'" readonly tabindex="-1">
      </div>
      <div class="col-lg-3 col-6 divTotalProducto">
        <label>Total</label>
        <input type="text" class="form-control nuevoPrecioProducto" precioOriginal="'.$precio_unitario.'" precioReal="'.$precio_neto.'" value="'.$total.'" readonly tabindex="-1">
      </div>
    </div>
  </div>
</div>
<hr id="hr'.$id_partcom.'" style="height:1px;border:none;color:#333;background-color:#333;">';

                  }


                  ?>


                </div>
              </div>
            </div>
            <input type="hidden" class="form-control" name="listaProductos" id="listaProductos" contador="<?php echo $contador; ?>" readonly>
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                </div>
                <div class="card-body">


                  <div class="row">


                    <div class="col-lg-8 col-12">
                      <div class="form-group">
                        <label>Observaciones</label>
                        <textarea class="form-control" id="editarObservacionesCompra" name="editarObservacionesCompra" rows="3" placeholder=""><?php echo $traerCompra['observaciones']; ?></textarea>
                      </div>
                    </div>











                    <div class="col-lg-2 col-12">
                      <div class="form-group">
                        <label>Tipo Compra</label>
                        <select class="form-control" id="editarTipoCompra" name="editarTipoCompra">
                          <?php
                          if($traerCompra['tipo_compra'] == 0){
                            echo '<option value="">--Selecciona--</option>';
                          }else if($traerCompra['tipo_compra'] == 1){
                            echo '<option value="1">Factura</option>';
                          }else if($traerCompra['tipo_compra'] == 2){
                            echo '<option value="2">Remisión</option>';
                          }
                          ?>
                          <option value="">--Selecciona--</option>
                          <option value="1">Factura</option>
                          <option value="2">Remisión</option>
                        </select>
                      </div>
                    </div>





                    <div class="col-lg-2 col-12">
                      <div class="form-group">
                        <label>No. Factura</label>

                        <input type="text" style="text-align: center;" class="form-control input-lg" id="editarNoFacturaCompra" name="editarNoFacturaCompra" total="" placeholder="00000" value="<?php echo $traerCompra['no_factura']; ?>">
                      </div>
                    </div>

















                  </div>

                  <br><br>

                  <div class="form-group">
                    <center><div class="col-4">
                      <div class="input-group">
                        <div class="input-group-append">
                          <span class="input-group-text">Total compra</span>
                        </div>
                        <input type="text" style="text-align: center;" class="form-control input-lg" id="nuevoTotalCompra" name="nuevoTotalCompra" total="" placeholder="00000" value="" readonly required>
                        <div class="input-group-append">
                          <span class="input-group-text">$</span>
                        </div>
                      </div>

                      <input type="hidden" name="totalCompra" id="totalCompra" value="">
                    </div></center>




                  <!--<br><br>

<center><div class="col-4">
<div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Tipo compra</span>
                      </div>
                      <div class="custom-file">
                        <select class="form-control" id="nuevoTipoCompra" name="nuevoTipoCompra">
                          <option value="NT">NOTA</option>
                          <option value="RM">REMISIÓN</option>
                          <option value="FC">FACTURA</option>
                        </select>
                        
                      </div>
                    </div>

                  </div>
                </center>-->
                <br><br>






              </div>
            </div>
          </div>
        </div>




        <input type="hidden" id="id_compra" name="id_compra" value="<?php echo $id_compra; ?>">

        <input type="hidden" id="cambiar_precios" name="cambiar_precios" value="<?php echo $traerCompra['cambiar_precios']; ?>">

        <input type="hidden" id="id_sucursal" name="id_sucursal" value="<?php echo $id_sucursal; ?>">


        <div class="col-12">
          <center><input type="button" class="btn btn-info" id="btnSubmitGuardarCompra" value="GUARDAR CAMBIOS" accesskey="1"></center>
        </div>

        <?php 
        $editarCompra = new ControladorCompras();
        $editarCompra -> ctrEditarCompra();

        ?>

      </form>

      <?php 
    }else{
      echo "<script>

      Swal.fire({
        icon: 'error',
        title: 'ESTA COMPRA YA HA SIDO CONFIRMADA O NO EXISTE',
        showConfirmButton: false,
        timer: 3000
        }).then(function(result){

          window.location = 'lista-compras';

          });


          </script>";
        }


        ?>

      </div>

    </div>
  </div>










  <div class="modal fade" id="modalProductos" data-backdrop="static">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Selecciona un producto a ligar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col-12">

              <div class="input-group">
                <div class="input-group-append">
                  <span class="input-group-text">Busqueda:</span>
                </div>
                <div class="custom-file">

                  <input type="hidden" class="form-control" id="nuevaMulticlave" readonly tabindex="-1">

                  <input type="search" class="form-control" id="buscarProductos" name="buscarProductos">
                </div>
              </div>

            </div>
          </div>

          <div class="col-12" id="incrustarTablaProductos">

          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
      </div>

    </div>
  </div>
</div>