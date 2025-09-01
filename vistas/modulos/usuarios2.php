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
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCrearUsuario">Crear Usuario</button>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <center>
    <div class="col-sm-6">
    <input onkeyup="buscar_ahora($('#buscar').val());" type="text" class="form-control" id="buscar" name="buscar" autofocus>
</div>
</center>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="tabla_de_usuarios" class="table table-bordered table-striped">
            <thead>
                <tr>
           <th>Nombre</th>
           <th>Usuario</th>
           <th>Perfil</th>
           <th>Estado</th>
           <th>Último login</th>
           <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="DataResult">

            </tbody>
            <tfoot>
                <tr>
           <th>Nombre</th>
           <th>Usuario</th>
           <th>Perfil</th>
           <th>Estado</th>
           <th>Último login</th>
           <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>








<br>
</div>

<div class="modal fade" id="modalCrearUsuario">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Crear usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-6">
                            <label>Nombre completo</label>
                            <input type="text" class="form-control" id="nuevoNombre" name="nuevoNombre" min="1" placeholder="Nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                        </div>
                        <div class="col-6">
                            <label>Usuario</label>
                            <input type="text" class="form-control" id="nuevoUsuario" name="nuevoUsuario" min="1" placeholder="Usuario" required>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="col-6">
                            <label>Contraseña</label>
                            <div class="input-group">
                                <button type="button" class="btn btn-primary" onClick="getPassword1()">Generar</button>
                                <input id="nuevoPassword" name="nuevoPassword" type="Password" Class="form-control" min="1" required>
                                <div class="input-group-append">
                                              
                                    <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword1()"> <span class="fa fa-eye-slash icon" accesskey="v"></span> </button>
                                </div>
                                           
                            </div>
                        </div>

                        <div class="col-6">
                            <label>Rol</label>
                            <select class="form-control" id="nuevoRol" name="nuevoRol" required>
                                <option value="">--Selecciona--</option>
                                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                <option value="VENTAS">VENTAS</option>
                                <option value="COMPRAS">COMPRAS</option>
                                <option value="ALMACEN">ALMACEN</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear usuario</button>
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
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Editar usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-6">
                            <label>Nombre completo</label>
                            <input type="text" class="form-control" id="editarNombre" name="editarNombre" min="1" placeholder="Nombre" value="" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                        </div>
                        <div class="col-6">
                            <label>Usuario</label>
                            <input type="text" class="form-control" id="editarUsuario" name="editarUsuario" min="1" placeholder="Usuario" value="" required readonly>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="col-6">
                            <label>Contraseña</label>
                            <div class="input-group">
                                <button type="button" class="btn btn-primary" onClick="getPassword()">Generar</button>
                                <input id="editarPassword" name="editarPassword" type="Password" Class="form-control" min="1" value="">
                                <input type="hidden" id="passwordActual" name="passwordActual" value="">
                                <div class="input-group-append">
                                              
                                    <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon" accesskey="v"></span> </button>
                                </div>
                                           
                            </div>
                        </div>

                        <div class="col-6">
                            <label>Rol</label>
                            <select class="form-control" name="editarRol" required>
                                <option value="" id="editarRol"></option>
                                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                <option value="VENTAS">VENTAS</option>
                                <option value="COMPRAS">COMPRAS</option>
                                <option value="ALMACEN">ALMACEN</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar modificaciones</button>
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




