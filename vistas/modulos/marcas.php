

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



                        $indiceCrearMarca = array_search("Crear marcas",$array,true);

if($indiceCrearMarca == 0){
   
}else if($indiceCrearMarca !== ""){

    ?>
                    <div class="breadcrumb float-sm-right">
                        <button class="btn btn-primary" id="btnCrearNuevaMarca" data-toggle="modal" data-target="#modalCrearMarca">Crear Marca</button>
                    </div>

                    <?php

                }

                ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

                        $indiceVerMarcas = array_search("Ver marcas",$array,true);

if($indiceVerMarcas == 0){
   
}else if($indiceVerMarcas !== ""){

    ?>
    
<center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraMarcas($('#buscarMarcas').val());" teclaEsc = "si" type="search" class="form-control" id="buscarMarcas" name="buscarMarcas" autocomplete="off" autofocus>
                      </div>
                    </div>
    
</div>
</center>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="incrustarTablaMarcas"></div>
        
    </div>

    <?php

}

    ?>
    <!-- /.card-body -->
</div>








<br>
</div>

<div class="modal fade" id="modalCrearMarca" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearMarca">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Marca</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">


                        <center>
                        <div class="col-6">
                            <label>Marca 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="nuevaMarca" name="nuevaMarca" min="1" placeholder="Marca" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                        </div>
                    </center>



                        
                    
                </div>
                <div class="modal-footer justify-content-center">
                    <input type="button" class="btn btn-primary" id="btnCrearMarca" value="Crear marca">
                </div>

                <?php 

                $crearMarca = new ControladorMarcas();
                $crearMarca -> ctrCrearMarca();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="modalEditarMarca" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioEditarMarca">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Marca</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">


                        <center>
                        <div class="col-6">
                            <label>Marca 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="editarMarca" name="editarMarca" min="1" placeholder="Marca" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                            <input type="hidden" id="marcaActual" name="marcaActual">
                        </div>
                    </center>
                    

                        <input type="hidden"  name="id_marca" id="id_marca" required readonly>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" id="btnEditarMarca">Guardar modificaciones</button>
                </div>

                <?php 

                $editarMarca = new ControladorMarcas();
                $editarMarca -> ctrEditarMarca();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>

                <?php 

                $eliminarMarca = new ControladorMarcas();
                $eliminarMarca -> ctrEliminarMarca();

                ?>
