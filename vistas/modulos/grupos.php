<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> LISTA DE GRUPOS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php

                        $indiceCrearGrupos = array_search("Crear grupos",$array,true);

if($indiceCrearGrupos == 0){
   
}else if($indiceCrearGrupos !== ""){

    ?>
                    <div class="breadcrumb float-sm-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCrearGrupo" accesskey="1">Crear Grupo</button>
                    </div>

                    <?php

                        }

    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

                        $indiceVerGrupos = array_search("Ver grupos",$array,true);

if($indiceVerGrupos == 0){
   
}else if($indiceVerGrupos !== ""){

    ?>
    

<center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraGrupos($('#buscarGrupos').val());" type="text" class="form-control" style="font-weight: bold; font-size: 25px" id="buscarGrupos" name="buscarGrupos" autofocus>
                      </div>
                    </div>
    
</div>
</center>


    <!-- /.card-header -->
    <div class="card-body" id="incrustarTablaGrupos">
        


            
    </div>

    <?php

}

    ?>
    <!-- /.card-body -->
</div>








<br>
</div>

<div class="modal fade" id="modalCrearGrupo">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearGrupo">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Grupo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">


<center>
                        <div class="col-6">
                            <label>Grupo 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="nuevoNombreGrupo" name="nuevoNombreGrupo" min="1" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                        </div>
                    </center>
<br>
                    <div class="row">
              <div class="col-12">
                
                <div class="form-group">
                  <select class="duallistbox" multiple="multiple" id="nuevosPermisos" name="nuevosPermisos[]">
                    <?php


                                        $estados = ControladorOtros::ctrMostrarPermisos();

                                        foreach ($estados as $key => $value) {
                                            echo '<option value="'.$value["nombre_permiso"].'">'.$value["nombre_permiso"].'</option>';
                                        }

                                        ?>
                  </select>
                </div>

                
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnCrearGrupo">Crear grupo</button>
                </div>

                <?php 

                $crearGrupo = new ControladorGrupos();
                $crearGrupo -> ctrCrearGrupo();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="modalEditarGrupo">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioEditarGrupo">

                <input type="hidden" name="id_grupo" id="id_grupo">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Grupo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">


<center>
                        <div class="col-6">
                            <label>Grupo 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="editarNombreGrupo" name="editarNombreGrupo" min="1" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                            <input type="hidden" id="actualNombreGrupo" name="actualNombreGrupo">
                        </div>
                    </center>
<br>
                    <div class="row">
              <div class="col-12">
                
                <select class="duallistbox" multiple="multiple" id="editarPermisos" name="editarPermisos[]" required>
                    <?php


                                        $estados = ControladorOtros::ctrMostrarPermisos();

                                        foreach ($estados as $key => $value) {
                                            echo '<option value="'.$value["nombre_permiso"].'">'.$value["nombre_permiso"].'</option>';
                                        }

                                        ?>
                  </select>

                  <!--<select class="select2" multiple="multiple" id="editarPermisos" name="editarPermisos[]" style="width: 100%;">
                    
                  </select>-->
                  <?php


                                        /*ESTE ES DEL SELECT2
                                        $estados = ControladorOtros::ctrMostrarPermisos();

                                        foreach ($estados as $key => $value) {
                                            echo '<option value="'.$value["nombre_permiso"].'">'.$value["nombre_permiso"].'</option>';
                                        }*/

                                        ?>

                
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnEditarGrupo">Guardar cambios</button>
                </div>

                <?php 

                $editarGrupo = new ControladorGrupos();
                $editarGrupo -> ctrEditarGrupo();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>

                <?php 

                $eliminarGrupo = new ControladorGrupos();
                $eliminarGrupo -> ctrEliminarGrupo();

                ?>





