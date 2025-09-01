


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!--CONTENIDO-->
    <div class="card">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> LISTA DE USUARIOS</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <div class="breadcrumb float-sm-right">
                            <?php

                            $indice = array_search("Crear usuarios",$array,true);

                            if($indice == 0){
                             
                            }else if($indice !== ""){
                                echo '<button class="btn btn-primary" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalCrearUsuario" id="btnCrearNuevoUsuario" accesskey="1">Crear Usuario</button>';
                            }

                            ?>
                            


                            
                        </div>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <?php


        $indiceVerUsuarios = array_search("Ver usuarios",$array,true);

        if($indiceVerUsuarios == 0){
         
        }else if($indiceVerUsuarios !== ""){
            ?>



            <center>
                <div class="col-sm-6">

                  <div class="input-group">
                    <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                    </div>
                    <div class="custom-file">
                        <input onkeyup="buscar_ahora($('#buscar').val());" type="text" class="form-control" style="font-weight: bold; font-size: 25px" id="buscar" name="buscar"  autofocus>
                    </div>
                </div>
                
            </div>
        </center>
        <!-- /.card-header -->
        <div class="card-body" id="incrustarTablaUsuarios">
            

             
 </div>
 <?php 

}

?>
<!-- /.card-body -->
</div>









</div>

<div class="modal fade" id="modalCrearUsuario">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearUsuario">
                <div class="modal-header">
                    <h4 class="modal-title">Crear usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Nombre completo 
                                    <big><code>*</code></big>
                                </label>
                                <input type="text" class="form-control" id="nuevoNombre" name="nuevoNombre" min="1" placeholder="Nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Usuario 
                                    <big><code>*</code></big>
                                </label>
                                <input type="text" class="form-control" id="nuevoUsuario" name="nuevoUsuario" min="1" placeholder="Usuario" value="" autocomplete="new-text" required>
                            </div>
                        </div>
                        
                        
                        
                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <label>Contraseña 
                                    <big><code>*</code></big>
                                </label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-primary" onClick="getPassword1()">Generar</button>
                                    <input id="nuevoPassword" name="nuevoPassword" type="Password" Class="form-control" min="1" autocomplete="off" required>
                                    <div class="input-group-append">
                                      
                                        <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword1()"> <span class="fa fa-eye-slash icon"></span> </button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <label>Código 
                                <big><code>*</code></big>
                            </label>
                            <div class="input-group">
                                <button type="button" class="btn btn-primary" onClick=" generaCodigo()">Generar</button>
                                <input id="nuevoCodigo" name="nuevoCodigo" type="Password" Class="form-control" autocomplete="off" required>
                                <div class="input-group-append">
                                              
                                    <button id="mostrarCodigo" class="btn btn-primary" type="button"> <span class="fa fa-eye-slash icon"></span> </button>
                                </div>
                                           
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <label>Rol 
                                    <big><code>*</code></big>
                                </label>
                                <select class="form-control" id="nuevoIdGrupo" name="nuevoIdGrupo" required>
                                    <option value="">--Selecciona--</option>
                                    <?php


                                    $grupos = ControladorGrupos::ctrMostrarGrupos();

                                    foreach ($grupos as $key => $value) {
                                        echo '<option value="'.$value["id_grupo"].'">'.$value["nombre_grupo"].'</option>';
                                    }

                                    ?>
                                </select>
                            </div>
                            
                        </div>
                        
                        
                        
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnCrearUsuario">Crear usuario</button>
                </div>

                <?php 

                $crearUsuario = new ControladorUsuarios();
                $crearUsuario -> ctrCrearUsuario();

                ?>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="modalEditarUsuario">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioEditarUsuario">
                <input type="hidden" Class="form-control" id="idUsuario" name="idUsuario" value="">
                <div class="modal-header">
                    <h4 class="modal-title">Editar usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Nombre completo 
                                    <big><code>*</code></big>
                                </label>
                                <input type="text" class="form-control" id="editarNombre" name="editarNombre" min="1" placeholder="Nombre" value="" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                            </div></div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label>Usuario 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="text" class="form-control" id="editarUsuario" name="editarUsuario" min="1" placeholder="Usuario" autocomplete="new-text"  value="" required>
                                </div></div>
                                
                                
                                
                                
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                        <label>Cambiar Contraseña</label>
                                        <div class="input-group">
                                            <button type="button" class="btn btn-primary" onClick="getPassword()">Generar</button>
                                            <input id="editarPassword" name="editarPassword" type="Password" Class="form-control" min="1" value="" autocomplete="off">
                                            <div class="input-group-append">
                                              
                                                <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                                            </div>
                                            
                                        </div></div>

                                        <input type="hidden" Class="form-control" id="passwordActual" name="passwordActual" value="">
                                    </div>





                                    <div class="col-lg-4 col-12">
                            <label>Código 
                                <big><code>*</code></big>
                            </label>
                            <div class="input-group">
                                <button type="button" class="btn btn-primary" onClick=" generaCodigo2()">Generar</button>
                                <input id="editarCodigo" name="editarCodigo" type="Password" Class="form-control" autocomplete="off" required>
                                <div class="input-group-append">
                                              
                                    <button id="mostrarCodigo2" class="btn btn-primary" type="button"> <span class="fa fa-eye-slash icon"></span> </button>
                                </div>
                                           
                            </div>
                        </div>








                                    <div class="col-lg-4 col-12">
                                        <div class="form-group">
                                            <label>Rol 
                                                <big><code>*</code></big>
                                            </label>
                                            <select class="form-control" id="editarIdGrupo" name="editarIdGrupo" required>
                                                <option value="">--Selecciona--</option>
                                                <?php


                                                $grupos = ControladorGrupos::ctrMostrarGrupos();

                                                foreach ($grupos as $key => $value) {
                                                    echo '<option value="'.$value["id_grupo"].'">'.$value["nombre_grupo"].'</option>';
                                                }

                                                ?>
                                            </select>
                                        </div></div>
                                        
                                        
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary" id="btnEditarUsuario">Guardar modificaciones</button>
                                    </div>

                                    <?php 

                                    $editarUsuario = new ControladorUsuarios();
                                    $editarUsuario -> ctrEditarUsuario();

                                    ?>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    <?php 

                    $eliminarUsuario = new ControladorUsuarios();
                    $eliminarUsuario -> ctrEliminarUsuario();

                    ?>


