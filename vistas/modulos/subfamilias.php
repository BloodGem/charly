<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> LISTA DE SUBFAMILIAS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php



                        $indiceCrearFamilia = array_search("Crear subfamilias",$array,true);

if($indiceCrearFamilia !== false){

    ?>
                    <div class="breadcrumb float-sm-right">
                        <button id="btnCrearNuevoSubfamilia" class="btn btn-primary" data-toggle="modal" data-target="#modalCrearSubfamilia">Crear Subfamilia</button>
                    </div>
                    <?php
                }
                    ?>
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
                        <input onkeyup="buscarAhoraSubfamilias($('#buscarSubfamilias').val());" teclaEsc = "si" type="text" class="form-control" id="buscarSubfamilias" name="buscarSubfamilias" autocomplete="off" autofocus>
                      </div>
                    </div>
    
</div>
</center>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="incrustarTablaSubfamilias"></div>
    </div>
    <!-- /.card-body -->
</div>








<br>
</div>

<div class="modal fade" id="modalCrearSubfamilia" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearSubfamilia">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Subfamilia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                            <label>Subfamilia 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="nuevaSubfamiliaCS" name="nuevaSubfamiliaCS" min="1" placeholder="Subfamilia" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                        </div>
                    </div>





                    <div class="col-lg-6 col-12">
                                <div class="form-group">
                            <label>Familia
                                <big><code>*</code></big>
                            </label>
                            <select class="form-control select2" id="nuevoIdFamiliaCS" name="nuevoIdFamiliaCS" style="width: 100%;" required>
                                    <option value="">--Selecciona--</option>
                                    <?php


                                    $armadoras = ControladorFamilias::ctrMostrarFamilias();

                                    foreach ($armadoras as $key => $value) {
                                        echo '<option value="'.$value["id_familia"].'">'.$value["familia"].'</option>';
                                    }

                                    ?>
                                </select>
                        </div>
                        </div>






                            
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                   
                    <button type="button" class="btn btn-primary" id="btnCrearSubfamilia">Crear subfamilia</button>
                </div>

                <?php 

                $crearSubfamilia = new ControladorSubfamilias();
                $crearSubfamilia -> ctrCrearSubfamilia();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="modalEditarSubfamilia" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioEditarSubfamilia">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Subfamilia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
<div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                            <label>Subfamilia 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="editarSubfamiliaES" name="editarSubfamiliaES" min="1" placeholder="Subfamilia" value="" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>

                            <input type="hidden" id="subfamiliaActualES" name="subfamiliaActualES">
                        </div>
                    </div>




                    <div class="col-lg-6 col-12">
                                <div class="form-group">
                            <label>Familia
                                <big><code>*</code></big>
                            </label>
                            <select class="form-control select2" id="editarIdFamiliaES" name="editarIdFamiliaES" style="width: 100%;" required>
                                    <option value="">--Selecciona--</option>
                                    <?php


                                    $armadoras = ControladorFamilias::ctrMostrarFamilias();

                                    foreach ($armadoras as $key => $value) {
                                        echo '<option value="'.$value["id_familia"].'">'.$value["familia"].'</option>';
                                    }

                                    ?>
                                </select>
                        </div>
                        </div>





                        <input type="hidden"  name="idSubfamiliaES" id="idSubfamiliaES" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" id="btnEditarSubfamilia">Guardar modificaciones</button>
                </div>

                <?php 

                $editarSubfamilia = new ControladorSubfamilias();
                $editarSubfamilia -> ctrEditarSubfamilia();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>

                <?php 

                $eliminarSubfamilia = new ControladorSubfamilias();
                $eliminarSubfamilia -> ctrEliminarSubfamilia();

                ?>
