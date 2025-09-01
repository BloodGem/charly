<?php
$indiceVerProductosExistenciasSucursales = array_search("Ver existencias sucursales",$array,true);

$indiceExportarListaPrecios = array_search("Exportar lista de precios",$array,true);

$clave_producto = $_GET['clave_producto'];

$id_sucursal = $traerUsuario['id_sucursal'];

echo '<input type="hidden" class="form-control" id="idSucursalLES" name="idSucursalLES" value="'.$id_sucursal.'">';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!--CONTENIDO-->
    <div class="card">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> LISTA DE PRODUCTOS</h1>
                    </div><!-- /.col -->
                    <?php
                        if($indiceExportarListaPrecios !== false){
                    ?>
                    <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">
                        <button type="btn" class="btn btn-primary" id="btnExportarEXCELListaPreciosSucursal">Lista de precios</button>
                    </div>
                </div>
                <?php
                }
                ?>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

    $indiceVerProductosExistenciasSucursales = array_search("Ver existencias sucursales",$array,true);

    if($indiceVerProductosExistenciasSucursales == 0){

    }else if($indiceVerProductosExistenciasSucursales !== ""){

        ?>



        <center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraProductosExistenciasSucursales($('#buscarProductosExistenciasSucursales').val());" type="search" teclaEsc = "si" class="form-control" id="buscarProductosExistenciasSucursales" name="buscarProductosExistenciasSucursales" value="<?php echo $clave_producto; ?>" autocomplete="off" autofocus>
                      </div>
                    </div>
    
</div>
</center>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="incrustarTablaProductosExistenciasSucursales"></div>
            
        </div>
        <?php

    }

    ?>
    <!-- /.card-body -->
</div>








<br>
</div>



<div class="modal fade" id="modalEditarProducto" data-backdrop="static" data-keyboard="false">
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
                    <label>Precio de Compra sin IVA</label>
                    <input type="text" id="mostrarPrecioCompra" name="mostrarPrecioCompra" class="form-control">
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
                                    <label>Precio 1 con IVA
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
                                    <label>Precio 2 con IVA
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
                                    <label>Precio 3 con IVA
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
    <button type="button" class="btn btn-primary" id="btnEditarProducto">Guardar modificaciones</button>
</div>

<?php 

$editarProducto = new ControladorExistenciasSucursales();
$editarProducto -> ctrEditarProductoES();

?>
</form>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>










<div class="modal fade" id="modalEditarUbicacionProductoEUPES" style="overflow-y: scroll;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cambiar Ubicación</h4>

                <button type="button" id="cerrar_modal_x" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal"></div>
            <div class="modal-body">


<form method="post" role="form" id="formularioEditarUbicacionProductoES" name="formularioEditarUbicacionProductoES" enctype="multipart/form-data">
    
<input type="hidden" id="mostrarIdProductoEUPES" name="mostrarIdProductoEUPES">

  <div class="row">

    <div class="col-12">
        <div class="form-group">
            <label>Ubicación actual</label>
            <input type="text" class="form-control" id="mostrarUbicacionActualProductoEUPES" name="mostrarUbicacionActualProductoEUPES" readonly>
        </div>
    </div>


    <div class="col-12">
        <div class="form-group">
            <label>Nueva Ubicación</label>
            <input type="text" class="form-control" id="nuevaUbicacionProductoEUPES" name="nuevaUbicacionProductoEUPES" onkeyup="convertir_mayusculas(this);" required>
        </div>
    </div>

  </div>


<hr>


</div>
<div class="modal-footer justify-content-between">
    <button type="button"  class="btn btn-default" id="cerrar_modal_boton" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="btnSubmitEUPES">Cambiar Ubicación</button>

</form>
</div>
</div>
</div>

</div>










<div class="modal fade" id="modalCambiarImagenProducto" style="overflow-y: scroll;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cambiar Imagen</h4>

                <button type="button" id="cerrar_modal_x" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal"></div>
            <div class="modal-body">


<form method="post" role="form" id="formularioCambiarImagenProducto" name="formularioCambiarImagenProducto" enctype="multipart/form-data">
    

  <div class="row">

    <div class="col-12">
        <div class="form-group">
            <label>Imagen</label>
            <input type="file" class="form-control" id="nuevaImagenProducto" name="nuevaImagenProducto" accept="image/*">
        </div>
    </div>

    <input type="hidden" class="form-control" id="cambiarImagenProducto" name="cambiarImagenProducto">

  </div>


<hr>


</div>
<div class="modal-footer justify-content-between">
    <button type="button"  class="btn btn-default" id="cerrar_modal_boton" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="btnSubirImagenProducto">Subir imagen</button>

</form>
</div>
</div>
</div>

</div>