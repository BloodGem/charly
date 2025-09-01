<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
<!--CONTENIDO-->
<!-- Content Header (Page header) -->
<?php

                    $id_producto = $_GET["id_producto"];

                    $busquedaAnterior = $_GET["busquedaAnterior"];

                    $traerProducto = ControladorProductos::ctrMostrarProducto($id_producto);

                    $id_sucursal = $traerUsuario['id_sucursal'];

                    $traerProductoES = controladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);
                    
                    echo '<input type="hidden" class="form-control" id="idSucursalEP" name="idSucursalEP" value="'.$id_sucursal.'">';

                ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>EDITAR PRODUCTO</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="lista-productos" accesskey="l">Lista de productos</a></li>
                    <li class="breadcrumb-item active">Editar producto</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<form action="" method="post" enctype="multipart/form-data" class="formularioEditarProducto" id="formularioEditarProducto" name="formularioEditarProducto">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">

                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">DETALLES DEL PRODUCTO</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                    <label>Clave Producto 
                                        <big><code>*</code></big>
                                    </label>
                                    <div class="input-group">
                                    <input type="text" class="form-control" id="editarClaveProducto" name="editarClaveProducto" placeholder="" value="<?php echo $traerProducto['clave_producto']; ?>" claveProductoActual = "<?php echo $traerProducto['clave_producto']; ?>" required autofocus>

                                    <div class="input-group-append">
                                    <button type="button" class="btn btn-sm btn-primary float-right" id="btnVerClavesProducto">+/-</button>
                                </div>
                                </div>

                                </div>
                            </div>





                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                    <label>Descripción
                                        <big><code>*</code></big>
                                    </label>
                                    <textarea class="form-control" id="editarDescripcionCorta" name="editarDescripcionCorta" rows="2" placeholder="" descripcionCortaActual = "<?php echo $traerProducto['descripcion_corta']; ?>" required><?php echo $traerProducto['descripcion_corta'];?></textarea>
                                </div>
                            </div>





                            <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                   <label>Marca</label>
                                   <div class="input-group">
                                    <select class="form-control select2" id="editarIdMarca" name="editarIdMarca">
                                        <?php

                                        $id_marca = $traerProducto["id_marca"];

                                        $traerMarca = ControladorMarcas::ctrMostrarMarca($id_marca);

                                        echo '<option value="'.$traerMarca["id_marca"].'">'.$traerMarca["marca"].'</option><option value="">--Seleccionar--</option>';


                                        $marcas = ControladorMarcas::ctrMostrarMarcas();

                                        foreach ($marcas as $key => $value) {
                                            echo '<option value="'.$value["id_marca"].'">'.$value["marca"].'</option>';
                                        }

                                        ?>
                                    </select>
                                    <div class="input-group-append">
                            <div class="input-group-select"><button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalCrearMarca" accesskey="1">+</button></div>
                        </div>
                                </div>
                                </div>
                            </div>






                            <div class="col-lg-2 col-12">
                                <center>
                                    <div class="form-group">
                                    <label>¿Es compuesto?
                                    </label>
                                    <br>
                                    <?php
                      if($traerProducto["es_compuesto"] == 1){
                        echo '<input type="checkbox" class="form-control" id="esProductoCompuesto" name="esProductoCompuesto" value="1" data-bootstrap-switch data-on-text="Si" data-off-text="No" data-off-color="dark" data-on-color="info" checked>';
                      }else{
                        echo '<input type="checkbox" class="form-control" id="esProductoCompuesto" name="esProductoCompuesto" value="1" data-bootstrap-switch data-on-text="Si" data-off-text="No" data-off-color="dark" data-on-color="info">';
                      }
                       ?>
                                    
                                </div>
                                </center>
                            </div>






                            <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                    <label>Ubicación
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="<?php echo $traerProductoES['ubicacion']; ?>">
                                </div>
                            </div>
                                

                                <!--
                                
                                
                                

                                <div class="col-0">
                                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="codigo">
                                </div>-->

                                
                                
                                
                                

                                





                            



                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>










                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">DETALLES COMERCIALES</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">


                                <div class="col-lg-2 col-12"></div>


                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                    <label>Precio de Compra sin IVA
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="precio_compra" name="precio_compra" value="<?php echo $traerProductoES['precio_compra']; ?>">
                                </div>
                            </div>


                            <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                    <label>
                                    </label>
                                    <button type="button" class="btn btn-sm btn-primary float-right" id="btnVerProveedoresProducto">Proveedores</button>
                                </div>
                            </div>


                            <div class="col-lg-2 col-12"></div>


                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Precio 1 con IVA
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="precio1" name="precio1" value="<?php echo $traerProductoES['precio1']; ?>">
                                </div>
                            </div>





                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Utilidad 1
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="utilidad1" name="utilidad1" value="<?php echo $traerProductoES['utilidad1']; ?>">
                                </div>
                            </div>





                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Precio 2 con IVA
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="precio2" name="precio2" value="<?php echo $traerProductoES['precio2']; ?>">
                                </div>
                            </div>





                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Utilidad 2
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="utilidad2" name="utilidad2" value="<?php echo $traerProductoES['utilidad2']; ?>">
                                </div>
                            </div>





                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Precio 3 con IVA
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="precio3" name="precio3" value="<?php echo $traerProductoES['precio3']; ?>">
                                </div>
                            </div>





                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Utilidad 3
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="utilidad3" name="utilidad3" value="<?php echo $traerProductoES['utilidad3']; ?>">
                                </div>
                            </div>




                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>











                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">EXISTENCIAS</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">


                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>Existencias actuales
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" value="<?php echo $traerProductoES['stock']; ?>" readonly>
                                </div>
                            </div>





                            <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>Mínimo
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="nivel_minimo" name="nivel_minimo" value="<?php echo $traerProductoES['nivel_minimo']; ?>">
                                </div>
                            </div>





                            <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>Medio
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="nivel_medio" name="nivel_medio" value="<?php echo $traerProductoES['nivel_medio']; ?>" readonly>
                                </div>
                            </div>





                            <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>Máximo
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="nivel_maximo" name="nivel_maximo" value="<?php echo $traerProductoES['nivel_maximo']; ?>">
                                </div>
                            </div>








                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>














                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">IMAGENES</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">


                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                    <label>Imagen 1</label>
                                    <input type="file" class="form-control" id="editarImagen1" name="editarImagen1" accept="image/*">

                                    <?php
                                        if($traerProducto['imagen1'] == "vistas/img/productos/none.png" || $traerProducto['imagen1'] == ""){

                                            echo '<input type="text" class="form-control" style="color:white; background-color: red;" id="actualImagen1" name="actualImagen1" value="'.$traerProducto['imagen1'].'" accept="image/*" readonly>';
                                        }   
                                        else{
                                            echo '<input type="text" class="form-control" style="color:white; background-color: green;" id="actualImagen1" name="actualImagen1" value="'.$traerProducto['imagen1'].'" accept="image/*" readonly>';
                                        }
                                     ?>
                                </div>
                            </div>
                                
                                
                                
                                
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                    <label>Imagen 2</label>
                                    <input type="file" class="form-control" id="editarImagen2" name="editarImagen2" accept="image/*">


                                    <?php
                                        if($traerProducto['imagen2'] == "vistas/img/productos/none.png" || $traerProducto['imagen2'] == ""){

                                            echo '<input type="text" class="form-control" style="color:white; background-color: red;" id="actualImagen2" name="actualImagen2" value="'.$traerProducto['imagen2'].'" accept="image/*" readonly>';
                                        }   
                                        else{
                                            echo '<input type="text" class="form-control" style="color:white; background-color: green;" id="actualImagen2" name="actualImagen2" value="'.$traerProducto['imagen2'].'" accept="image/*" readonly>';
                                        }
                                     ?>
                                </div>
                            </div>
                                
                                
                                
                                
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                    <label>Imagen 3</label>
                                    <input type="file" class="form-control" id="editarImagen3" name="editarImagen3" accept="image/*">
                                    

                                    <?php
                                        if($traerProducto['imagen3'] == "vistas/img/productos/none.png" || $traerProducto['imagen3'] == ""){

                                            echo '<input type="text" class="form-control" style="color:white; background-color: red;" id="actualImagen3" name="actualImagen3" value="'.$traerProducto['imagen3'].'" accept="image/*" readonly>';
                                        }   
                                        else{
                                            echo '<input type="text" class="form-control" style="color:white; background-color: green;" id="actualImagen3" name="actualImagen3" value="'.$traerProducto['imagen3'].'" accept="image/*" readonly>';
                                        }
                                     ?>
                                </div>
                            </div>





                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>



                </div>










                <div class="col-12">
                    

                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">ETIQUETAS</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                
                                <div class="col-lg-6 col-12">
                                <center>
                                    <div class="form-group">
                                    <label>¿Se imprime etiqueta?
                                    </label>
                                    <br>
                                    <?php
                      if($traerProducto["imprime_etiqueta"] == 1){
                        echo '<input type="checkbox" class="form-control" id="imprimeEtiqueta" name="imprimeEtiqueta" value="1" data-bootstrap-switch data-on-text="Si" data-off-text="No" data-off-color="danger" data-on-color="success" checked>';
                      }else{
                        echo '<input type="checkbox" class="form-control" id="imprimeEtiqueta" name="imprimeEtiqueta" value="1" data-bootstrap-switch data-on-text="Si" data-off-text="No" data-off-color="danger" data-on-color="success">';
                      }
                       ?>
                                    
                                </div>
                                </center>
                            </div>





                            <div class="col-lg-6 col-12">
                                <center>
                                    <div class="form-group">
                                    <label>Múltiplo
                                    </label>
                                    <br>
                                    <input type="number" class="form-control" style="text-align: center;" id="editarMultiploEtiqueta" name="editarMultiploEtiqueta" value="<?php echo $traerProducto['multiplo_etiqueta']; ?>">
                                </div>
                                </center>
                            </div>                              
                                
                                
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">DETALLES</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">



                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                    <label>Clave ante el SAT del producto 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="editarClaveSat" name="editarClaveSat" value="<?php echo $traerProducto['clave_sat']; ?>" claveSatActual = "<?php echo $traerProducto['clave_sat']; ?>" placeholder="" required>
                                </div>
                            </div>
                                
                                
                                
                                
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                    <label>Clave de unidad ante el SAT
                                        <big><code>*</code></big>
                                    </label>
                                    


                                    <select class="form-control" id="editarCveUnidad" name="editarCveUnidad" required>
                                        <option value="<?php echo $traerProducto['cve_unidad']; ?>"><?php echo $traerProducto['cve_unidad']; ?></option>
                                        <option value="H87">H87 --- Pieza</option>
                                        <option value="LTR">LTR --- LITRO</option>
                                        <option value="XKI">XKI --- KIT</option>
                                    </select>
                                </div>
                            </div>

                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                    <label>Unidad del producto 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="editarUnidad" name="editarUnidad" value="<?php echo $traerProducto['unidad']; ?>" unidadActual = "<?php echo $traerProducto['unidad']; ?>" placeholder="" required>
                                </div>
                            </div>

                                

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>


                

            <div class="col-12">
                    
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Productos compuesto</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="nuevoProductoCompuesto">
                                        
                                        <?php

                        $listaProductosCompuesto = json_decode($traerProducto['productos_compuesto'], true);

                        $array_productos_compuesto = "[";
                    foreach ($listaProductosCompuesto as $key2 => $value2) {

                        $traerProducto2 = ControladorProductos::ctrMostrarProducto($value2['id_producto']);

                        $array_productos_compuesto = $array_productos_compuesto."'".$value2['id_producto']."', ";

                        echo '<div class="row">
                <div class="col-lg-1 col-12">
                <button type="button" class="btn btn-xs btn-danger quitarProducto" id_producto="'.$value2['id_producto'].'"><i class="fa fa-times"></i></button>
                </div>
                <div class="col-lg-2 col-12">
                <input type="text" class="form-control form-control-sm nuevaClaveProducto" placeholder="" name="claveProducto" value="'.$traerProducto2['clave_producto'].'" tabindex="-1" readonly>
                </div>
                <div class="col-lg-7 col-12">
                <input type="text" class="form-control form-control-sm nuevaDescripcionProducto" id_producto="'.$value2['id_producto'].'" placeholder="" name="agregarProducto" value="'.$traerProducto2['descripcion_corta'].'" tabindex="-1" readonly>
                </div>
                <div class="col-lg-2 col-12">
                <input type="number" class="form-control form-control-sm nuevaCantidadProducto" value="'.$value2['cantidad'].'">
                </div>
                </div>
                <hr>';

                    }

                   $array_productos_compuesto = substr($array_productos_compuesto, 0, -2);

                    $array_productos_compuesto = $array_productos_compuesto."]";

                    ?>

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                      <center>
                                        <div class="col-sm-6">
                                          <div class="input-group input-group-sm">
                                            <span class="input-group-append">
                                              <button type="button" class="btn btn-disabled btn-flat">Busqueda:</button>
                                            </span>
                                            <input type="search" autocomplete="off" class="form-control" id="buscarProductos" name="buscarProductos">
                                          </div>
                                        </div>
                                      </center>
                                      <br>
                                      <div class="input-group" id="incrustarTablaProductos">
                                        
                                      </div>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>


                    <input type="hidden" class="form-control" name="listaProductosCompuesto" id="listaProductosCompuesto" numProductoCompuesto="0" arrayProductoCompuesto="<?php echo $array_productos_compuesto; ?>">

                </div>












                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
                        










                    <input type="hidden"  name="editarProducto" id="editarProducto" value="<?php echo $traerProducto['id_producto']; ?>" required readonly>



                    <input type="hidden"  name="busquedaAnterior" id="busquedaAnterior" value="<?php echo $busquedaAnterior; ?>" required readonly>





    <div class="col-12">
        <center><button type="button" class="btn btn-info btnConfirmarProducto" id="btnEditarProducto" accesskey="1">EDITAR PRODUCTO</button></center>
    </div>

    <?php 
        $editarProducto = new ControladorProductos();
        $editarProducto -> ctrEditarProducto();

    ?>
</form>







</div>










<div class="modal fade" id="modalCrearMarca">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearMarca">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Marca</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">


                        <center>
                        <div class="col-6">
                            <label>Marca 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="nuevaMarca" name="nuevaMarca" min="1" placeholder="Marca" required autofocus>
                        </div>
                    </center>



                        
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="button" class="btn btn-primary" id="btnCrearMarcaPE" value="Crear marca">
                </div>

            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>










<div class="modal fade" id="modalCrearFamilia">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearFamilia">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Familia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">


                        <center>
                        <div class="col-6">
                            <label>Familia 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="nuevaFamilia" name="nuevaFamilia" min="1" placeholder="Familia" required autofocus>
                        </div>
                    </center>



                        
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="button" class="btn btn-primary" id="btnCrearFamiliaPE" value="Crear familia">
                </div>

            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>










<div class="modal fade" id="modalEditarExistenciasProducto" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="formularioEditarProducto" id="formularioEditarProducto" name="formularioEditarProducto">

                        <input type="hidden" id="id_producto" name="id_producto" class="form-control" required readonly>


                        <div class="row">
                  <div class="col-lg-6 col-12 form-group">
                    <label>Descripción</label>
                    <input type="text" id="mostrarDescripcionCortaProducto" name="mostrarDescripcionCortaProducto" class="form-control" readonly>
                  </div>
                  <div class="col-lg-3 col-6 form-group">
                    <label>Ubicación</label>
                    <input type="text" id="editarUbicacion" name="editarUbicacion" class="form-control" required>
                  </div>
                  <div class="col-lg-3 col-6 form-group">
                    <label>Precio de compra</label>
                    <input type="text" id="mostrarPrecioCompra" name="mostrarPrecioCompra" class="form-control" readonly>
                  </div>

                  <div class="col-lg-3 col-6 form-group">
                    <label>Existencias</label>
                    <input type="text" id="mostrarStock" name="mostrarStock" class="form-control" readonly>
                  </div>

                  <div class="col-lg-3 col-6 form-group">
                    <label>Existencias mínimas</label>
                    <input type="number" id="editarNivelMinimo" name="editarNivelMinimo" class="form-control">
                  </div>
                  <div class="col-lg-3 col-6 form-group">
                    <label>Existencias medias</label>
                    <input type="text" id="mostrarNivelMedio" name="mostrarNivelMedio" class="form-control" readonly>
                  </div>
                  <div class="col-lg-3 col-6 form-group">
                    <label>Existencias máximas</label>
                    <input type="number" id="editarNivelMaximo" name="editarNivelMaximo" class="form-control">
                  </div>

                  <div class="col-6">
                                    <label>Precio 1 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="editarPrecio1" name="editarPrecio1" step="any" min="0.1" placeholder="" required>
                                </div>
                                <div class="col-6">
                                    <label>Utilidad 1 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="editarUtilidad1" name="editarUtilidad1" step="any" min="0.1" placeholder="" required>
                                </div>

                                <div class="col-6">
                                    <label>Precio 2 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="editarPrecio2" name="editarPrecio2" step="any" min="0.1" placeholder="" required>
                                </div>
                                <div class="col-6">
                                    <label>Utilidad 2 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="editarUtilidad2" name="editarUtilidad2" step="any" min="0.1" placeholder="" required>
                                </div>
                                <div class="col-6">
                                    <label>Precio 3 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="editarPrecio3" name="editarPrecio3" step="any" min="0.1" placeholder="" required>
                                </div>
                                <div class="col-6">
                                    <label>Utilidad 3 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="editarUtilidad3" name="editarUtilidad3" step="any" min="0.1" placeholder="" required>
                                </div>
                </div>
</div>
<div class="modal-footer justify-content-center">
    <button type="button" class="btn btn-primary" id="btnSumbitEditarExistenciasProducto">Guardar modificaciones</button>
</div>

</form>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>











<div class="modal fade" id="modalClavesProducto" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Claves producto</h4>
                    <button type="button" class="btn btn-info" id="btnAgregarMulticlave"><span aria-hidden="true">Agregar</span></button>
                </div>
                <div class="modal-body">

                    <div id="incrustarTablaMulticlavesProducto">
                  
                  </div>




                    
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>












<div class="modal fade" id="modalCrearMulticlaveProducto">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearMulticlaveProducto">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Multiclave</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Multiclave
                                    <big><code>*</code></big>
                                </label>
                                <input type="text" class="form-control" id="nuevaMulticlaveProducto" name="nuevaMulticlaveProducto" min="1" value="" autocomplete="new-text" required>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnSubmitCrearMulticlaveProducto">Crear multiclave</button>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>










<div class="modal fade" id="modalProveedoresProducto" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Proveedores Producto</h4>
                </div>
                <div class="modal-body">

                    <div id="incrustarTablaProveedoresProducto">
                  
                  </div>




                    
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>