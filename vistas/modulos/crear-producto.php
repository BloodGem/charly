<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
<!--CONTENIDO-->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>CREAR NUEVO PRODUCTO</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="lista-productos" accesskey="l">Lista de productos</a></li>
                    <li class="breadcrumb-item active">Crear nuevo producto</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<form action="" method="post" enctype="multipart/form-data" class="formularioNuevoProducto" id="formularioNuevoProducto" name="formularioNuevoProducto">
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
                                    <input type="text" class="form-control" id="nuevaClaveProducto" name="nuevaClaveProducto" placeholder="" required autofocus>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                    <label>Descripción
                                        <big><code>*</code></big>
                                    </label>
                                    <textarea class="form-control" id="nuevaDescripcionCorta" name="nuevaDescripcionCorta" rows="2" placeholder="" required></textarea>
                                </div>
                            </div>


                            <div class="col-lg-2 col-12">
                            <div class="form-group">
                              <label>Marca</label>
                              <div class="input-group">
                                <select class="form-control select2" id="nuevoIdMarca" name="nuevoIdMarca">
                                    <option value="">--Selecciona--</option>
                                    <?php

                                    $marcas = ControladorMarcas::ctrMostrarMarcas();

                                    foreach ($marcas as $key => $valueMarca) {
                                        echo '<option value="'.$valueMarca["id_marca"].'">'.$valueMarca["marca"].'</option>';
                                    }

                                    ?>
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-select"><button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalCrearMarca">+</button></div>
                                </div>
                            </div>
                        </div>
                    </div>






                    <div class="col-lg-2 col-12">
                                <center>
                                    <div class="form-group">
                                    <label>¿Es producto compuesto?
                                    </label>
                                    <br>
                                    <input type="checkbox" class="form-control" id="esProductoCompuesto" name="esProductoCompuesto" value="1" data-bootstrap-switch data-on-text="Si" data-off-text="No" data-off-color="dark" data-on-color="info">
                                </div>
                                </center>
                            </div>




                        <!--<div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>Ubicación
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="ubicacion" name="ubicacion">
                                </div>
                            </div>-->
                                



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
                                    <input type="text" class="form-control" id="precio_compra" name="precio_compra">
                                </div>
                            </div>


                            <div class="col-4"></div>


                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Precio 1
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="precio1" name="precio1">
                                </div>
                            </div>





                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Utilidad 1
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="utilidad1" name="utilidad1">
                                </div>
                            </div>





                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Precio 2
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="precio2" name="precio2">
                                </div>
                            </div>





                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Utilidad 2
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="utilidad2" name="utilidad2">
                                </div>
                            </div>





                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Precio 3
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="precio3" name="precio3">
                                </div>
                            </div>





                            <div class="col-lg-2 col-6">
                                    <div class="form-group">
                                    <label>Utilidad 3
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="utilidad3" name="utilidad3">
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
                                    <input type="text" class="form-control" id="mostrarExistenciasActuales" name="mostrarExistenciasActuales">
                                </div>
                            </div>





                            <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>Mínimo
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="nivel_minimo" name="nivel_minimo">
                                </div>
                            </div>





                            <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>Medio
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="nivel_medio" name="nivel_medio">
                                </div>
                            </div>





                            <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                    <label>Máximo
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="nivel_maximo" name="nivel_maximo">
                                </div>
                            </div>








                            </div>

                        </div>
                    </div>-->















                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">IMÁGENES</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-lg-4 col-12">
                                    <label>Imagen 1</label>
                                    <input type="file" class="form-control" id="nuevaImagen1" name="nuevaImagen1" accept="image/*">
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="col-lg-4 col-12">
                                    <label>Imagen 2</label>
                                    <input type="file" class="form-control" id="nuevaImagen2" name="nuevaImagen2" accept="image/*">
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="col-lg-4 col-12">
                                    <label>Imagen 3</label>
                                    <input type="file" class="form-control" id="nuevaImagen3" name="nuevaImagen3" accept="image/*">
                                </div>





                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>


            

                </div>









                <!--SECCIÓN ROJA-->
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
                                    <input type="checkbox" class="form-control" id="imprimeEtiqueta" name="imprimeEtiqueta" value="1" data-bootstrap-switch data-on-text="Si" data-off-text="No" data-off-color="danger" data-on-color="success" checked>
                                </div>
                                </center>
                            </div>





                            <div class="col-lg-6 col-12">
                                <center>
                                    <div class="form-group">
                                    <label>Múltiplo
                                    </label>
                                    <br>
                                    <input type="number" class="form-control" style="text-align: center;" id="nuevoMultiploEtiqueta" name="nuevoMultiploEtiqueta" value="0">
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
                                    <input type="text" class="form-control" id="nuevaClaveSat" name="nuevaClaveSat" placeholder="" value="01010101" required>
                                </div>
                            </div>
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                    <label>Clave de unidad ante el SAT
                                        <big><code>*</code></big>
                                    </label>
                                    


                                    <select class="form-control" id="nuevoCveUnidad" name="nuevoCveUnidad" required>
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
                                    <input type="text" class="form-control" id="nuevaUnidad" name="nuevaUnidad" placeholder="" value="PZ" required>
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
                                    <div class="nuevoProductoCompuesto"></div>
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


                    <input type="hidden" class="form-control" name="listaProductosCompuesto" id="listaProductosCompuesto" numProductoCompuesto="0">

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
                    <input type="button" class="btn btn-primary" id="btnCrearMarca" value="Crear marca">
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
                    <input type="button" class="btn btn-primary" id="btnCrearFamilia" value="Crear familia">
                </div>

            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>