<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!--CONTENIDO-->
    <div class="card">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> LISTA DE PROVEEDORES</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <?php

                        $indiceCrearProveedores = array_search("Crear proveedores",$array,true);

                        if($indiceCrearProveedores == 0){
                         
                        }else if($indiceCrearProveedores !== ""){

                            ?>
                            <div class="breadcrumb float-sm-right">
                              <a href="crear-proveedor">
                                <button class="btn btn-primary" id="btnCrearNuevoProveedor">Crear Proveedor</button>
                            </a>
                        </div>

                        <?php

                    }

                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

    $indiceVerProveedores = array_search("Ver proveedores",$array,true);

    if($indiceVerProveedores == 0){
     
    }else if($indiceVerProveedores !== ""){

        ?>
      

        <center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraProveedores($('#buscarProveedores').val());" teclaEsc = "si" type="text" class="form-control" style="font-weight: bold; font-size: 25px" id="buscarProveedores" name="buscarProveedores" autocomplete="off" autofocus>
                      </div>
                    </div>
    
</div>
</center>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="incrustarTablaProveedores"></div>
            
        </div>

        <?php
    }

    ?>
    <!-- /.card-body -->
</div>









</div>



<div class="modal fade" id="modalEditarProveedor" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" class="formularioEditarProveedor" id="formularioEditarProveedor" name="formularioEditarProveedor">
                <div class="modal-header">
                    <h4 class="modal-title">Editar proveedor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <!-- Main content -->
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="card card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">Datos fiscales</h3>
                                            </div>
                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-lg-6 col-12"><div class="form-group">
                                                        <label>Nombre físcal 
                                                            <big><code>*</code></big>
                                                        </label>
                                                        <input type="text" class="form-control" id="editarNombre" name="editarNombre" placeholder="" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                                                    </div>
                                                </div>
                                                    <div class="col-lg-3 col-12"><div class="form-group">
                                                        <label>RFC 
                                                            <big><code>*</code></big>
                                                        </label>
                                                        <input type="text" class="form-control" id="editarRfc" name="editarRfc" minlength="13" maxlength="14" placeholder="" style="text-transform:uppercase;" required>
                                                        <input type="hidden" id="rfcActual" name="rfcActual">
                                                    </div>
                                                </div>
                                                    <div class="col-lg-3 col-12"><div class="form-group">
                                                        <label>Email 
                                                            <big><code>*</code></big>
                                                        </label>
                                                        <input type="email" class="form-control" id="editarEmail" name="editarEmail" placeholder="" required>
                                                    </div>
                                                </div>


                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>

                                    </div>



                                    <div class="col-md-12">

                                        <div class="card card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">Datos personales</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-lg-6 col-12"><div class="form-group">
                                                        <label>Nombre comercial 
                                                            <big><code>*</code></big>
                                                        </label>
                                                        <input type="text" class="form-control" id="editarNombreComercial" name="editarNombreComercial" placeholder="" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                                    </div>
                                                </div>
                                                    <div class="col-lg-3 col-12"><div class="form-group">
                                                        <label>Teléfono / Celular 
                                                            <big><code>*</code></big>
                                                        </label>
                                                        <input type="tel" class="form-control" id="editarTelefono1" name="editarTelefono1" minlength="10" maxlength="10" placeholder="" required>
                                                    </div>
                                                </div>
                                                    <div class="col-lg-3 col-12"><div class="form-group">
                                                        <label>Teléfono / Celular adicional</label>
                                                        <input type="tel" class="form-control" id="editarTelefono2" name="editarTelefono2" minlength="10" maxlength="10" placeholder="">
                                                    </div>
                                                </div>


                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>

                                    </div>



                                    <div class="col-md-12">

                                        <div class="card card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">Datos del domicilio</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">


                                                    <div class="col-lg-3 col-12"><div class="form-group">
                                                        <label>Dirección</label>
                                                        <input type="text" class="form-control" id="editarDireccion" name="editarDireccion" placeholder="" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                    <div class="col-lg-3 col-12"><div class="form-group">
                                                        <label>No. interior</label>
                                                        <input type="number" class="form-control" id="editarNoInterior" name="editarNoInterior" placeholder="">
                                                    </div>
                                                </div>
                                                    <div class="col-lg-3 col-12"><div class="form-group">
                                                        <label>No. exterior</label>
                                                        <input type="number" class="form-control" id="editarNoExterior" name="editarNoExterior" placeholder="">
                                                    </div>
                                                </div>
                                                    <div class="col-lg-3 col-12"><div class="form-group">
                                                        <label>Colonia</label>
                                                        <input type="texto" class="form-control" id="editarColonia" name="editarColonia" placeholder="" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                    
                                                    
                                                    
                                                    
                                                    <div class="col-lg-3 col-12"><div class="form-group">
                                                        <label>Código Postal
                                                            <big><code>*</code></big>
                                                        </label>
                                                        <input type="number" class="form-control" id="editarCodigoPostal" name="editarCodigoPostal" minlength="5" maxlength="5"placeholder="" required>
                                                    </div>
                                                </div>
                                                    <div class="col-lg-3 col-12"><div class="form-group">
                                                        <label>Ciudad</label>
                                                        <input type="text" class="form-control" id="editarCiudad" name="editarCiudad" placeholder="" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                    <div class="col-lg-3 col-12"><div class="form-group">
                                                        <label>Estado</label>
                                                        <select class="form-control" id="editarIdEstado" name="editarIdEstado">
                                                            <?php

                                                            $columna = null;
                                                            $valor = null;

                                                            $estados = ControladorOtros::ctrMostrarEstados($columna,$valor);

                                                            foreach ($estados as $key => $value) {
                                                                echo '<option value="'.$value["id_estado"].'">'.$value["nomenclatura"].' --- '.$value["estado"].'</option>';
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>

                                    </div>





                                    <div class="col-md-12">

                                        <div class="card card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">Adiciones</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-lg-3 col-12"><div class="form-group">
                                                        <label>Día revisión</label>
                                                        <input type="text" class="form-control" id="editarDiaRevpag" name="editarDiaRevpag" placeholder="" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                    </div>
                                                </div>
                                                    <div class="col-lg-3 col-12"><div class="form-group">
                                                        <label>Días de credito</label>
                                                        <input type="number" class="form-control" id="editarDiasCredito" name="editarDiasCredito" placeholder="">
                                                    </div>
                                                </div>
                                                    <div class="col-lg-3 col-12"><div class="form-group">
                                                        <label>Límite de credito</label>
                                                        <input type="number" class="form-control" id="editarLimiteCredito" name="editarLimiteCredito" placeholder="">
                                                    </div>
                                                </div>
                                                    <div class="col-lg-3 col-12"><div class="form-group">
                                                        <label>Descuento</label>
                                                        <input type="number" class="form-control" id="editarDescuento" name="editarDescuento" placeholder="">
                                                    </div>
                                                </div>


                                                    <input type="hidden" class="form-control" id="id_proveedor" name="id_proveedor" placeholder="">
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>

                                    </div>

                                    <!--/.col (right) -->
                                </div>
                                <!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </section>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-info" id="btnEditarProveedor">Guardar modificaciones</button>
                    </div>

                    <?php 

                    $editarProveedor = new ControladorProveedores();
                    $editarProveedor -> ctrEditarProveedor();

                    ?>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <?php 

    $eliminarProveedor = new ControladorProveedores();
    $eliminarProveedor -> ctrEliminarProveedor();

?>