<?php

                        $indiceListaProductosProveedores = array_search("Lista productos proveedores",$array,true);

                        if($indiceListaProductosProveedores !== false){

                            ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!--CONTENIDO-->
    <div class="card">
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <h1 class="m-0"> LISTA DE PRODUCTOS PROVEEDORES</h1>
                    </div><!-- /.col -->
                    <div class="col-lg-6 col-12">
                        <?php

                        $indiceAgregarProductosProveedores = array_search("Agregar productos proveedores",$array,true);

                        if($indiceAgregarProductosProveedores !== false){

                            ?>
                            <!--<div class="breadcrumb float-sm-right">
                                <button class="btn btn-primary">Agregar Productos</button>
                            
                        </div>-->

                        <?php

                    }

                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

    $indiceVerProductosProveedores = array_search("Ver productos proveedores",$array,true);

    if($indiceVerProductosProveedores !== false){

        ?>



       

        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-3">
</div>

 <div class="col-6">
      <div class="input-group">
       <select class="form-control select2" id="proveedorLPP" name="proveedorLPP" autofocus style="width: 100%;" teclaEsc="si">
        <option value="">--Selecciona--</option>
                    <?php

                      $proveedores = ControladorProveedores::ctrMostrarProveedores();

                      foreach ($proveedores as $key => $value) {

                        echo '<option value="'.$value["id_proveedor"].'">'.$value["nombre"].' - '.$value["rfc"].'</option>';

                      }

                    ?>
                  </select>
                    </div>

</div>
<div class="col-3">
</div>
</div>
<br>
<div id="incrustarTablaProductosProveedor">
            
        </div>
        </div>
        <?php

    }

    ?>
    <!-- /.card-body -->
</div>








<br>
</div>







<div class="modal fade" id="modalEditarClaveProductoProveedor" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearAuto">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Clave Producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                            <label>Clave Producto Original
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="mostrarClaveProductoOriginal" name="mostrarClaveProductoOriginal" min="1" placeholder="" readonly required autofocus>
                        </div>
                    </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                            <label>Clave Proveedor
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="mostrarClaveProductoProveedor" name="mostrarClaveProductoProveedor" min="1" placeholder="Introduzca la clave del proveedor aquí" required autofocus>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                   
                    <button type="button" class="btn btn-primary" id="btnEditarClaveProductoProveedor">Guardar Cambios
                    </button>
                </div>

            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>


<?php

}

?>