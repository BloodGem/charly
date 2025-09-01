

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> LISTA DE MOTORES</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php



                        $indiceCrearMotor = array_search("Crear motores",$array,true);

if($indiceCrearMotor == 0){
   
}else if($indiceCrearMotor !== ""){

    ?>
                    <div class="breadcrumb float-sm-right">
                        <button class="btn btn-primary" id="btnCrearNuevaMotor" data-toggle="modal" data-target="#modalCrearMotor">Crear Motor</button>
                    </div>

                    <?php

                }

                ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

                        $indiceVerMotores = array_search("Ver motores",$array,true);

if($indiceVerMotores == 0){
   
}else if($indiceVerMotores !== ""){

    ?>
    
<center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraMotores($('#buscarMotores').val());" teclaEsc = "si" type="text" class="form-control" id="buscarMotores" name="buscarMotores" autofocus>
                      </div>
                    </div>
    
</div>
</center>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="incrustarTablaMotores"></div>
        
    </div>

    <?php

}

    ?>
    <!-- /.card-body -->
</div>








<br>
</div>

<div class="modal fade" id="modalCrearMotor" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearMotor">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Motor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">


                        <center>
                        <div class="col-6">
                            <label>Motor 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="nuevaMotor" name="nuevaMotor" min="1" placeholder="Motor" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                        </div>
                    </center>



                        
                    
                </div>
                <div class="modal-footer justify-content-center">
                    <input type="button" class="btn btn-primary" id="btnCrearMotor" value="Crear motor">
                </div>

                <?php 

                $crearMotor = new ControladorMotores();
                $crearMotor -> ctrCrearMotor();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="modalEditarMotor" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioEditarMotor">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Motor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">


                        <center>
                        <div class="col-6">
                            <label>Motor 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="editarMotor" name="editarMotor" min="1" placeholder="Motor" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                            <input type="hidden" id="motorActual" name="motorActual">
                        </div>
                    </center>
                    

                        <input type="hidden"  name="idMotorEM" id="idMotorEM" required readonly>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" id="btnEditarMotor">Guardar modificaciones</button>
                </div>

                <?php 

                $editarMotor = new ControladorMotores();
                $editarMotor -> ctrEditarMotor();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>

                <?php 

                $eliminarMotor = new ControladorMotores();
                $eliminarMotor -> ctrEliminarMotor();

                ?>
