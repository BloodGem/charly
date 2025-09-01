<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> LISTA DE GASTOS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php

                        $indiceCrearGastos = array_search("Crear gastos",$array,true);

if($indiceCrearGastos == 0){
   
}else if($indiceCrearGastos !== ""){

    ?>

                    <div class="breadcrumb float-sm-right">
                        <button class="btn btn-primary" id="btnCrearNuevoGasto" data-toggle="modal" data-target="#modalCrearGasto">Crear Gasto</button>
                    </div>

                    <?php

                }

                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

                        $indiceVerGastos = array_search("Ver gastos",$array,true);

if($indiceVerGastos == 0){
   
}else if($indiceVerGastos !== ""){

    ?>


<center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraGastos($('#buscarGastos').val());" teclaEsc = "si" type="text" class="form-control" id="buscarGastos" name="buscarGastos" autofocus>
                      </div>
                    </div>
    
</div>
</center>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="incrustarTablaGastos"></div>
        
    </div>
    <?php 

}

    ?>
    <!-- /.card-body -->
</div>








<br>
</div>

<div class="modal fade" id="modalCrearGasto" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Crear  de Gasto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    
                            <div class="row">
                                
                                <div class="col-6">
                                    <label>Tipo de gasto 
                                        <big><code>*</code></big>
                                    </label>
                                    <select class="form-control" id="nuevoIdTipoGasto" name="nuevoIdTipoGasto" required autofocus>
                                        <option value="">--Selecciona--</option>
                                        <?php

                                        $columna = null;
                                        $valor = null;

                                        $regimenes = ControladorTiposGastos::ctrMostrarTiposGastos($columna,$valor);

                                        foreach ($regimenes as $key => $value) {
                                            echo '<option value="'.$value["id_tipo_gasto"].'">'.$value["tipo_gasto"].'</option>';
                                        }

                                        ?>
                                    </select>
                                </div>
                                
                                <div class="col-6">
                                    <label>Total 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="nuevoTotal" name="nuevoTotal" placeholder="Total" step="any" required>
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="col-6">
                                    <label>Archivo</label>
                                    <input type="file" class="form-control" id="nuevoArchivo" name="nuevoArchivo">
                                </div>
                                
                                <div class="col-6">
                                    <label>Comentario</label>
                                    <textarea onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nuevoComentario" name="nuevoComentario" placeholder="Comentarios"></textarea>
                                </div>

                            </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">Crear tipo de gasto</button>
                </div>

                <?php 

                $crearGasto = new ControladorGastos();
                $crearGasto -> ctrCrearGasto();

                ?>
             
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="modalEditarGasto" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Editar  de Gasto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    
                            <div class="row">
                                
                                <div class="col-6">
                                    <label>Tipo de gasto 
                                        <big><code>*</code></big>
                                    </label>
                                    <select class="form-control" id="editarIdTipoGasto" name="editarIdTipoGasto" required autofocus>
                                        <?php

                                        $columna = null;
                                        $valor = null;

                                        $regimenes = ControladorTiposGastos::ctrMostrarTiposGastos($columna,$valor);

                                        foreach ($regimenes as $key => $value) {
                                            echo '<option value="'.$value["id_tipo_gasto"].'">'.$value["tipo_gasto"].'</option>';
                                        }

                                        ?>
                                    </select>
                                </div>
                                
                                <div class="col-6">
                                    <label>Total 
                                        <big><code>*</code></big>
                                    </label>
                                    <input type="number" class="form-control" id="editarTotal" name="editarTotal" placeholder="Total" step="any" required>
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="col-6">
                                    <label>Archivo</label>
                                    <input type="file" class="form-control" id="nuevoArchivo" name="nuevoArchivo">
                                    <input type="hidden" id="editarArchivo" name="editarArchivo">
                                </div>
                                
                                <div class="col-6">
                                    <label>Comentario</label>
                                    <textarea onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="editarComentario" name="editarComentario" placeholder="Comentarios"></textarea> 
                                </div>

                            </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <input type="hidden" id="id_gasto" name="id_gasto">
                    <button type="submit" class="btn btn-primary">Guardar modificaciones</button>
                </div>
<?php 

                $editarGasto = new ControladorGastos();
                $editarGasto -> ctrEditarGasto();

                ?>
                
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>

               
<?php 

                $eliminarGasto = new ControladorGastos();
                $eliminarGasto -> ctrEliminarGasto();

                ?>