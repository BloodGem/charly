<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!--CONTENIDO-->
<!-- Content Header (Page header) -->
<?php

$id_producto = $_GET["id_producto"];


$traerProducto = ControladorProductos::ctrMostrarProducto($id_producto);

$traerProductoES = controladorExistenciasSucursales::ctrMostrarProductoES($id_producto);

                    //$traerAutos = ControladorAutos::ctrMostrarAutos2();

?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>DUPLICACIÓN DE PRODUCTO</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="lista-productos" accesskey="l">Lista de productos</a></li>
                    <li class="breadcrumb-item active">Duplicación de producto</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<form method="post" enctype="multipart/form-data" class="formularioNuevoProducto" id="formularioNuevoProducto" name="formularioNuevoProducto">
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

                                <div class="col-lg-2 col-12"><div class="form-group">

                                    <label>Clave Producto 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="nuevaClaveProducto" name="nuevaClaveProducto" placeholder="" required autofocus>
                                </div>
                            </div>





                            <div class="col-lg-8 col-12">
                                <div class="form-group">
                                    <label>Descripción
                                        <big><code>*</code></big>
                                    </label>
                                    <textarea class="form-control" id="NuevaDescripcionCorta" name="nuevaDescripcionCorta" rows="2" placeholder="" required><?php echo $traerProducto['descripcion_corta']; ?></textarea>
                                </div>
                            </div>





                            <div class="col-lg-2 col-12">
                                <div class="form-group">
                                   <label>Marca</label>
                                   <div class="input-group">
                                    <select class="form-control select2" id="nuevoIdMarca" name="nuevoIdMarca">
                                        <?php

                                        $id_marca = $traerProducto["id_marca"];

                                        $traerMarca = ControladorMarcas::ctrMostrarMarca($id_marca);

                                        echo '<option value="'.$traerMarca["id_marca"].'">'.$traerMarca["marca"].'</option>';
                                        ?>
                                        <?php


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





                                <!--
                                
                                
                                

                                <div class="col-0">
                                    <input type="hidden" class="form-control" id="codigo" name="codigo" placeholder="codigo">
                                </div>-->

                                
                                
                                
                                

                            </div>





                            


                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>








                <!--<div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">DETALLES COMERCIALES</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">


                                <div class="col-4"></div>


                                <div class="col-4">
                                    <div class="form-group">
                                    <label>Precio compra
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="precio_compra" name="precio_compra" value="<?php //echo $traerProductoES['precio_compra']; ?>" readonly>
                                </div>
                            </div>


                            <div class="col-4"></div>


                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Precio 1
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="precio1" name="precio1" value="<?php //echo $traerProductoES['precio1']; ?>">
                                </div>
                            </div>





                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Utilidad 1
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="utilidad1" name="utilidad1" value="<?php //echo $traerProductoES['utilidad1']; ?>">
                                </div>
                            </div>





                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Precio 2
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="precio2" name="precio2" value="<?php //echo $traerProductoES['precio2']; ?>">
                                </div>
                            </div>





                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Utilidad 2
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="utilidad2" name="utilidad2" value="<?php //echo $traerProductoES['utilidad2']; ?>">
                                </div>
                            </div>





                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Precio 3
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="precio3" name="precio3" value="<?php //echo $traerProductoES['precio3']; ?>">
                                </div>
                            </div>





                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Utilidad 3
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="utilidad3" name="utilidad3" value="<?php //echo $traerProductoES['utilidad3']; ?>">
                                </div>
                            </div>




                            </div>

                        </div>
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
                                    <input type="text" class="form-control" value="<?php //echo $traerProductoES['stock']; ?>" readonly>
                                </div>
                            </div>





                            <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>Mínimo
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="nivel_minimo" name="nivel_minimo" value="<?php //echo $traerProductoES['nivel_minimo']; ?>">
                                </div>
                            </div>





                            <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>Medio
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="nivel_medio" name="nivel_medio" value="<?php //echo $traerProductoES['nivel_medio']; ?>" readonly>
                                </div>
                            </div>





                            <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>Máximo
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="nivel_maximo" name="nivel_maximo" value="<?php //echo $traerProductoES['nivel_maximo']; ?>">
                                </div>
                            </div>








                            </div>

                        </div>
                    </div>-->







                <div class="col-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Imágenes</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-lg-4 col-12">
                                    <label>Imagen 1</label>
                                    <input type="file" class="form-control" id="nuevaImagen1" name="nuevaImagen1" accept="image/*">

                                    <?php
                                    if($traerProducto['imagen1'] == "vistas/img/productos/none.png"){
                                        echo '<p style="color:red;">No tiene imagen</p>';
                                    }   
                                    else{
                                        echo '<p style="color:green;">Si tiene imagen</p>';
                                    }
                                    ?>
                                    <input type="hidden" class="form-control" id="actualImagen1" name="actualImagen1" value="<?php echo $traerProducto['imagen1']; ?>" accept="image/*">
                                </div>




                                <div class="col-lg-4 col-12">
                                    <label>Imagen 2</label>
                                    <input type="file" class="form-control" id="nuevaImagen2" name="nuevaImagen2" accept="image/*">

                                    <input type="hidden" class="form-control" id="actualImagen2" name="actualImagen2" value="<?php echo $traerProducto['imagen2']; ?>" accept="image/*">

                                    <?php
                                    if($traerProducto['imagen2'] == "vistas/img/productos/none.png"){
                                        echo '<p style="color:red;">No tiene imagen</p>';
                                    }   
                                    else{
                                        echo '<p style="color:green;">Si tiene imagen</p>';
                                    }
                                    ?>
                                </div>




                                <div class="col-lg-4 col-12">
                                    <label>Imagen 3</label>
                                    <input type="file" class="form-control" id="nuevaImagen3" name="nuevaImagen3" accept="image/*">
                                    <input type="hidden" class="form-control" id="actualImagen3" name="actualImagen3" value="<?php echo $traerProducto['imagen3']; ?>" accept="image/*">

                                    <?php
                                    if($traerProducto['imagen3'] == "vistas/img/productos/none.png"){
                                        echo '<p style="color:red;">No tiene imagen</p>';
                                    }   
                                    else{
                                        echo '<p style="color:green;">Si tiene imagen</p>';
                                    }
                                    ?>
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
                                            <input type="number" class="form-control" style="text-align: center;" id="nuevoMultiploEtiqueta" name="nuevoMultiploEtiqueta" value="<?php echo $traerProducto['multiplo_etiqueta']; ?>">
                                        </div>
                                    </center>
                                </div>                               


                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>



                <div class="col-12">
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
                                        <input type="text" class="form-control" id="nuevaClaveSat" name="nuevaClaveSat" value="<?php echo $traerProducto['clave_sat']; ?>" placeholder="" required>
                                    </div>




                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                        <label>Clave de unidad ante el SAT
                                            <big><code>*</code></big>
                                        </label>



                                        <select class="form-control" id="nuevoCveUnidad" name="nuevoCveUnidad" required>
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
                                        <input type="text" class="form-control" id="nuevaUnidad" name="nuevaUnidad" value="<?php echo $traerProducto['unidad']; ?>" placeholder="" required>
                                    </div>



                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>



                    </div>


                </div>






<!--/.col (right) -->
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</section>












<div class="col-12">
    <center><button type="button" class="btn btn-info btnConfirmarProducto" id="btnCrearProducto" accesskey="1">CREAR PRODUCTO</button></center>
</div>

<?php 
$crearProducto = new ControladorProductos();
$crearProducto -> ctrCrearProducto();

?>
</form>







</div>