<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> LISTA DE LOS TIPOS DE GASTOS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php

                        $indiceCrearTiposGastos = array_search("Crear tipos de gastos",$array,true);

if($indiceCrearTiposGastos == 0){
   
}else if($indiceCrearTiposGastos !== ""){

    ?>
                    <div class="breadcrumb float-sm-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCrearTipoGasto" id="btnCrearNuevoTipoGasto">Crear Tipo de Gasto</button>
                    </div>
                    <?php

                        }

    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

                        $indiceVerTiposGastos = array_search("Ver tipos de gastos",$array,true);

if($indiceVerTiposGastos == 0){
   
}else if($indiceVerTiposGastos !== ""){

    ?>
    

<center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraTiposGastos($('#buscarTiposGastos').val());" teclaesc = "si" type="text" class="form-control" id="buscarTiposGastos" name="buscarTiposGastos" autofocus>
                      </div>
                    </div>
    
</div>
</center>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="incrustarTablaTiposGastos"></div>
        
    </div>
    <?php

                       }

    ?>
    <!-- /.card-body -->
</div>








<br>
</div>

<div class="modal fade" id="modalCrearTipoGasto" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" class="formularioCrearTipoGasto" id="formularioCrearTipoGasto" name="formularioCrearTipoGasto">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Tipo de Gasto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">


<center>
                        <div class="col-6">
                            <label>Tipo de Gasto 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="nuevoTipoGasto" name="nuevoTipoGasto" min="1" placeholder="Tipo de Gasto" onkeyup="javascript:this.value=this.value.toUpperCase();" required astofocus>
                        </div>
                    </center>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-info" id="btnCrearTipoGasto" accesskey="1">Crear tipo de gasto</button>
                </div>

                <?php 

                $crearTipoGasto = new ControladorTiposGastos();
                $crearTipoGasto -> ctrCrearTipoGasto();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="modalEditarTipoGasto" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" class="formularioEditarTipoGasto" id="formularioEditarTipoGasto" name="formularioEditarTipoGasto">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Tipo de Gasto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
<center>
                        <div class="col-6">
                            <label>Tipo de Gasto 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="editarTipoGasto" name="editarTipoGasto" min="1" placeholder="Tipo de Gasto" value="" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                        </div>

                        <input type="hidden"  name="id_tipo_gasto" id="id_tipo_gasto" required>

                    </center>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-info" id="btnEditarTipoGasto" accesskey="2">Guardar modificaciones</button>
                    

                </div>

                <?php 

                $editarTipoGasto = new ControladorTiposGastos();
                $editarTipoGasto -> ctrEditarTipoGasto();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>

                <?php 

                $eliminarTipoGasto = new ControladorTiposGastos();
                $eliminarTipoGasto -> ctrEliminarTipoGasto();

                ?>
