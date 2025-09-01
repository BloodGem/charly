

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> LISTA DE FAMILIAS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php



                        $indiceCrearFamilia = array_search("Crear familias",$array,true);

if($indiceCrearFamilia == 0){
   
}else if($indiceCrearFamilia !== ""){

    ?>
                    <div class="breadcrumb float-sm-right">
                        <button class="btn btn-primary" id="btnCrearNuevaFamilia" data-toggle="modal" data-target="#modalCrearFamilia">Crear Familia</button>
                    </div>

                    <?php

                }

                ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

                        $indiceVerFamilias = array_search("Ver familias",$array,true);

if($indiceVerFamilias == 0){
   
}else if($indiceVerFamilias !== ""){

    ?>
    
<center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraFamilias($('#buscarFamilias').val());" teclaEsc = "si" type="text" class="form-control" id="buscarFamilias" name="buscarFamilias" autofocus>
                      </div>
                    </div>
    
</div>
</center>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="incrustarTablaFamilias"></div>
        
    </div>

    <?php

}

    ?>
    <!-- /.card-body -->
</div>








<br>
</div>

<div class="modal fade" id="modalCrearFamilia" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearFamilia">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Familia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">


                        <center>
                        <div class="col-6">
                            <label>Familia 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="nuevaFamilia" name="nuevaFamilia" min="1" placeholder="Familia" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                        </div>
                    </center>



                        
                    
                </div>
                <div class="modal-footer justify-content-center">
                    <input type="button" class="btn btn-primary" id="btnCrearFamilia" value="Crear familia">
                </div>

                <?php 

                $crearFamilia = new ControladorFamilias();
                $crearFamilia -> ctrCrearFamilia();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="modalEditarFamilia" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioEditarFamilia">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Familia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">


                        <center>
                        <div class="col-6">
                            <label>Familia 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="editarFamilia" name="editarFamilia" min="1" placeholder="Familia" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                            <input type="hidden" id="familiaActual" name="familiaActual">
                        </div>
                    </center>
                    

                        <input type="hidden"  name="id_familia" id="id_familia" required readonly>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" id="btnEditarFamilia">Guardar modificaciones</button>
                </div>

                <?php 

                $editarFamilia = new ControladorFamilias();
                $editarFamilia -> ctrEditarFamilia();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>

                <?php 

                $eliminarFamilia = new ControladorFamilias();
                $eliminarFamilia -> ctrEliminarFamilia();

                ?>
