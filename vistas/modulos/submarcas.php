

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> LISTA DE MARCAS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php



                        $indiceCrearSubsubmarca = array_search("Crear submarcas",$array,true);

if($indiceCrearSubsubmarca == 0){
   
}else if($indiceCrearSubsubmarca !== ""){

    ?>
                    <div class="breadcrumb float-sm-right">
                        <button class="btn btn-primary" id="btnCrearNuevaSubsubmarca" data-toggle="modal" data-target="#modalCrearSubsubmarca">Crear Subsubmarca</button>
                    </div>

                    <?php

                }

                ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

                        $indiceVerSubsubmarcas = array_search("Ver submarcas",$array,true);

if($indiceVerSubsubmarcas == 0){
   
}else if($indiceVerSubsubmarcas !== ""){

    ?>
    
<center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraSubsubmarcas($('#buscarSubsubmarcas').val());" teclaEsc = "si" type="text" class="form-control" id="buscarSubsubmarcas" name="buscarSubsubmarcas" autofocus>
                      </div>
                    </div>
    
</div>
</center>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="incrustarTablaSubsubmarcas"></div>
        
    </div>

    <?php

}

    ?>
    <!-- /.card-body -->
</div>








<br>
</div>

<div class="modal fade" id="modalCrearSubsubmarca" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearSubsubmarca">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Subsubmarca</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">


                        <center>
                        <div class="col-6">
                            <label>Subsubmarca 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="nuevaSubsubmarca" name="nuevaSubsubmarca" min="1" placeholder="Subsubmarca" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                        </div>
                    </center>



                        
                    
                </div>
                <div class="modal-footer justify-content-center">
                    <input type="button" class="btn btn-primary" id="btnCrearSubsubmarca" value="Crear submarca">
                </div>

                <?php 

                $crearSubsubmarca = new ControladorSubsubmarcas();
                $crearSubsubmarca -> ctrCrearSubsubmarca();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="modalEditarSubsubmarca" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioEditarSubsubmarca">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Subsubmarca</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">


                        <center>
                        <div class="col-6">
                            <label>Subsubmarca 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="editarSubsubmarca" name="editarSubsubmarca" min="1" placeholder="Subsubmarca" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                            <input type="hidden" id="submarcaActual" name="submarcaActual">
                        </div>
                    </center>
                    

                        <input type="hidden"  name="id_submarca" id="id_submarca" required readonly>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" id="btnEditarSubsubmarca">Guardar modificaciones</button>
                </div>

                <?php 

                $editarSubsubmarca = new ControladorSubsubmarcas();
                $editarSubsubmarca -> ctrEditarSubsubmarca();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>

                <?php 

                $eliminarSubsubmarca = new ControladorSubsubmarcas();
                $eliminarSubsubmarca -> ctrEliminarSubsubmarca();

                ?>
