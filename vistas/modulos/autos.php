<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> LISTA DE AUTOS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">
                        <button id="btnCrearNuevoAuto" class="btn btn-primary" data-toggle="modal" data-target="#modalCrearAuto">Crear Auto</button>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


<center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraAutos($('#buscarAutos').val());" teclaEsc = "si" type="text" class="form-control" id="buscarAutos" name="buscarAutos" autocomplete="off" autofocus>
                      </div>
                    </div>
    
</div>
</center>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="incrustarTablaAutos"></div>
    </div>
    <!-- /.card-body -->
</div>








<br>
</div>

<div class="modal fade" id="modalCrearAuto" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearAuto">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Auto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                            <label>Auto 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="nuevoAutoCA" name="nuevoAutoCA" min="1" placeholder="Auto" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                        </div>
                    </div>





                    <div class="col-lg-4 col-12">
                            <div class="form-group">
                            <label>Versión
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="nuevaVersionCA" name="nuevaVersionCA" min="1" placeholder="Vesión" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                        </div>
                    </div>





                    <div class="col-lg-4 col-12">
                                <div class="form-group">
                            <label>Motor
                                <big><code>*</code></big>
                            </label>
                            <select class="form-control select2" id="nuevoIdMotorCA" name="nuevoIdMotorCA" style="width: 100%;" required>
                                    <option value="">--Selecciona--</option>
                                    <?php


                                    $armadoras = ControladorMotores::ctrMostrarMotores();

                                    foreach ($armadoras as $key => $value) {
                                        echo '<option value="'.$value["id_motor"].'">'.$value["motor"].'</option>';
                                    }

                                    ?>
                                </select>
                        </div>
                        </div>






                            
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                   
                    <button type="button" class="btn btn-primary" id="btnCrearAuto">Crear auto</button>
                </div>

                <?php 

                $crearAuto = new ControladorAutos();
                $crearAuto -> ctrCrearAuto();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="modalEditarAuto" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioEditarAuto">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Auto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
<div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                            <label>Auto 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="editarAutoEA" name="editarAutoEA" min="1" placeholder="Auto" value="" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>

                            <input type="hidden" id="autoActualEA" name="autoActualEA">
                        </div>
                    </div>
    <div class="col-lg-4 col-12">
                            <div class="form-group">
                            <label>Versión
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="editarVersionEA" name="editarVersionEA" min="1" placeholder="Vesión" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                        </div>
                    </div>





                    <div class="col-lg-4 col-12">
                                <div class="form-group">
                            <label>Motor
                                <big><code>*</code></big>
                            </label>
                            <select class="form-control" id="editarIdMotorEA" name="editarIdMotorEA" style="width: 100%;" required>
                                    <option value="">--Selecciona--</option>
                                    <?php


                                    $armadoras = ControladorMotores::ctrMostrarMotores();

                                    foreach ($armadoras as $key => $value) {
                                        echo '<option value="'.$value["id_motor"].'">'.$value["motor"].'</option>';
                                    }

                                    ?>
                                </select>
                        </div>
                        </div>





                        <input type="hidden"  name="idAutoEA" id="idAutoEA" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" id="btnEditarAuto">Guardar modificaciones</button>
                </div>

                <?php 

                $editarAuto = new ControladorAutos();
                $editarAuto -> ctrEditarAuto();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>

                <?php 

                $eliminarAuto = new ControladorAutos();
                $eliminarAuto -> ctrEliminarAuto();

                ?>
