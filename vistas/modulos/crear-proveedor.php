<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<!--CONTENIDO-->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>CREAR NUEVO PROVEEDOR</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="lista-proveedores">Lista de proveedores</a></li>
                    <li class="breadcrumb-item active">Crear nuevo proveedor</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<form method="post" enctype="multipart/form-data" class="formularioCrearProveedor" id="formularioCrearProveedor" name="formularioCrearProveedor">
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
                                    <input type="text" class="form-control" id="nuevoNombre" name="nuevoNombre" placeholder="" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                                </div>
                            </div>
                                <div class="col-lg-3 col-12"><div class="form-group">
                                    <label>RFC 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="nuevoRfc" name="nuevoRfc" minlength="13" maxlength="14" placeholder="" style="text-transform:uppercase;" required>
                                </div>
                            </div>
                                <div class="col-lg-3 col-12"><div class="form-group">
                                    <label>Email 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="email" class="form-control" id="nuevoEmail" name="nuevoEmail" placeholder="" required>
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
                                    <input type="text" class="form-control" id="nuevoNombreComercial" name="nuevoNombreComercial" placeholder="" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                            </div>
                                <div class="col-lg-3 col-12"><div class="form-group">
                                    <label>Teléfono / Celular 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="nuevoTelefono1" name="nuevoTelefono1" minlength="10" maxlength="10" placeholder="" required>
                                </div>
                            </div>
                                <div class="col-lg-3 col-12"><div class="form-group">
                                    <label>Teléfono / Celular adicional</label>
                                    <input type="number" class="form-control" id="nuevoTelefono2" name="nuevoTelefono2" minlength="10" maxlength="10" placeholder="">
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
                                    <input type="text" class="form-control" id="nuevaDireccion" name="nuevaDireccion" placeholder="" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                            </div>
                                <div class="col-lg-3 col-12"><div class="form-group">
                                    <label>No. interior</label>
                                    <input type="number" class="form-control" id="nuevoNoInterior" name="nuevoNoInterior" placeholder="">
                                </div>
                            </div>
                                <div class="col-lg-3 col-12"><div class="form-group">
                                    <label>No. exterior</label>
                                    <input type="number" class="form-control" id="nuevoNoExterior" name="nuevoNoExterior" placeholder="">
                                </div>
                            </div>
                                <div class="col-lg-3 col-12"><div class="form-group">
                                    <label>Colonia</label>
                                    <input type="texto" class="form-control" id="nuevaColonia" name="nuevaColonia" placeholder="" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                            </div>
                                
                                
                                
                                
                                <div class="col-lg-3 col-12"><div class="form-group">
                                    <label>Código Postal
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="nuevoCodigoPostal" name="nuevoCodigoPostal" minlength="5" maxlength="5"placeholder="" required>
                                </div>
                            </div>
                                <div class="col-lg-3 col-12"><div class="form-group">
                                    <label>Ciudad</label>
                                    <input type="text" class="form-control" id="nuevaCiudad" name="nuevaCiudad" placeholder="" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                            </div>
                                <div class="col-lg-3 col-12"><div class="form-group">
                                    <label>Estado</label>
                                    <select class="form-control" id="nuevoIdEstado" name="nuevoIdEstado">
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
                                    <input type="text" class="form-control" id="nuevoDiaRevpag" name="nuevoDiaRevpag" placeholder="" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                            </div>
                                <div class="col-lg-3 col-12"><div class="form-group">
                                    <label>Días de credito</label>
                                    <input type="number" class="form-control" id="nuevoDiasCredito" name="nuevoDiasCredito" placeholder="">
                                </div>
                            </div>
                                <div class="col-lg-3 col-12"><div class="form-group">
                                    <label>Límite de credito</label>
                                    <input type="number" class="form-control" id="nuevoLimiteCredito" name="nuevoLimiteCredito" placeholder="">
                                </div>
                            </div>
                                <div class="col-lg-3 col-12"><div class="form-group">
                                    <label>Descuento</label>
                                    <input type="number" class="form-control" id="nuevoDescuento" name="nuevoDescuento" placeholder="">
                                </div>
                                </div>   
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
    <div class="col-12">
        <center><button type="button" class="btn btn-info" id="btnCrearProveedor">CREAR PROVEEDOR</button></center>
    </div>

    <?php 
        $crearProveedor = new ControladorProveedores();
        $crearProveedor -> ctrCrearProveedor();

    ?>
 </form>
 
</div>
