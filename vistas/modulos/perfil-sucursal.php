<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
<!--CONTENIDO-->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="col-sm-12">
            <center>
                <h1>PERFIL DE LA SUCURSAL</h1>
            </center>
        </div>
    </div><!-- /.container-fluid -->
</section>





<form action="" method="post" enctype="multipart/form-data">

<input type="hidden" id="id_sucursal" name="id_sucursal" value="<?php echo $traerUsuario['id_sucursal']; ?>">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">


                <div class="col-md-12">

                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">CERTIFICADOS</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-12">
                                    <label>.CER</label>
                                        <input id="editarCcerE" name="editarCcerE" type="file" Class="form-control" accept=".cer">
                                        <input type="hidden" id="actualCcerE" name="actualCcerE">

                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="col-12">
                                    <label>.KEY</label>
                                    <input id="editarCkeyE" name="editarCkeyE" type="file" Class="form-control" accept=".key">
                                    <input type="hidden" id="actualCkeyE" name="actualCkeyE">
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="col-12">
                                    <label>CLAVE</label>
                                    <div class="input-group">
                                        <input id="editarClaveE" name="editarClaveE" type="password" Class="form-control" >
                                        <input type="hidden" id="actualClaveE" name="actualClaveE">
                                        <div class="input-group-append">

                                            <button id="show" class="btn btn-primary" type="button" onclick="mostrar3()"> <span class="fa fa-eye-slash icon"></span> </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>



                <div class="col-md-6">

                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">SAT</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-6">
                                    <label>RFC</label>
                                    <input type="text" class="form-control" id="editarRfcE" name="editarRfcE" placeholder="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();"  autofocus>
                                </div>
                                <div class="col-6">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" id="editarNombreE" name="editarNombreE" placeholder="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();"  autofocus>
                                </div>
                                <div class="col-6">
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="editarEmailE" name="editarEmailE" placeholder="email" >
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="col-6">
                                    <label>Régimen fiscal</label>
                                    <select class="form-control" id="editarIdRegimenE" name="editarIdRegimenE">
                                        <option value="">--Selecciona--</option>
                                        <?php

                                        $columna = null;
                                        $valor = null;

                                        $regimenes = ControladorOtros::ctrMostrarRegimenes($columna,$valor);

                                        foreach ($regimenes as $key => $value) {
                                            echo '<option value="'.$value["id_regimen"].'">'.$value["regimen"].'</option>';
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>




                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Información adicional</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-6">
                                    <label>Teléfono / Celular</label>
                                    <input type="tel" class="form-control" id="editarTelefono1E" name="editarTelefono1E" minlength="10" maxlength="10" placeholder="telefono1">
                                </div>

                                <div class="col-6">
                                    <label>Teléfono / Celular adicional</label>
                                    <input type="tel" class="form-control" id="editarTelefono2E" name="editarTelefono2E" minlength="10" maxlength="10" placeholder="telefono2">
                                </div>

                                <div class="col-12">
                                    <label>Sitio web</label>
                                    <input type="text" class="form-control" id="editarSitioWebE" name="editarSitioWebE" placeholder="sitio_web">
                                </div>



                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>


                </div>







                <!--SECCIÓN ROJA-->
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Domicilio</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-6">
                                    <label>Calle</label>
                                    <input type="text" class="form-control" id="editarDireccionE" name="editarDireccionE" placeholder="direccion">
                                </div>
                                <div class="col-6">
                                    <label>No. interior</label>
                                    <input type="number" class="form-control" id="editarNoInteriorE" name="editarNoInteriorE" placeholder="no_interior">
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="col-6">
                                    <label>No. exterior</label>
                                    <input type="number" class="form-control" id="editarNoExteriorE" name="editarNoExteriorE" placeholder="no_exterior">
                                </div>
                                <div class="col-6">
                                    <label>Colonia</label>
                                    <input type="texto" class="form-control" id="editarColoniaE" name="editarColoniaE" placeholder="colonia">
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="col-6">
                                    <label>Código Postal</label>
                                    <input type="number" class="form-control" id="editarCodigoPostalE" name="editarCodigoPostalE" placeholder="codigo_postal">
                                </div>
                                <div class="col-6">
                                    <label>Ciudad</label>
                                    <input type="text" class="form-control" id="editarCiudadE" name="editarCiudadE" placeholder="ciudad">
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="col-6">
                                    <label>Estado</label>
                                    
                                    <select class="form-control" id="editarIdEstadoE" name="editarIdEstadoE">
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
                        <!-- /.card-body -->
                    </div>


                </div>



               




                <!--/.col (right) -->
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>


    <div class="col-12">
        <center><input type="submit" class="btn btn-info" value="GUARDAR MODIFICACIONES" accesskey="1"></center>
    </div>

<?php 

                $editarSucursal = new ControladorSucursales();
                $editarSucursal -> ctrEditarSucursal();

                ?>

</form>

<br>


<script type="text/javascript">
    function mostrar() {
        var cambio = document.getElementById("ccer");
        if (cambio.type == "password") {
            cambio.type = "text";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        } else {
            cambio.type = "password";
            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }

    }

    function mostrar2() {
        var cambio2 = document.getElementById("ckey");
        if (cambio2.type == "password") {
            cambio2.type = "text";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        } else {
            cambio2.type = "password";
            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    }

    function mostrar3() {

        var cambio3 = document.getElementById("clave");
        if (cambio3.type == "password") {
            cambio3.type = "text";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        } else {
            cambio3.type = "password";
            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }

    }

</script>

</div>
