<?php
$indiceListaTerminalesBancarias = array_search("Lista de terminales bancarias",$array,true);

if($indiceListaTerminalesBancarias !== false){

?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> LISTA DE TERMINALES BANCARIAS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php



                        $indiceCrearTerminalesBancarias = array_search("Crear terminales bancarias",$array,true);

if($indiceCrearTerminalesBancarias !== false){

    ?>
                    <div class="breadcrumb float-sm-right">
                        <button class="btn btn-primary" id="btnCrearNuevaTerminalBancaria" data-toggle="modal" data-target="#modalCrearTerminalBancaria">Crear Terminal Bancaria</button>
                    </div>

                    <?php

                }

                ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

$indiceVerTerminalesBancarias = array_search("Ver terminales bancarias",$array,true);

if($indiceVerTerminalesBancarias !== false){

    ?>
    
<center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraTerminalesBancarias($('#buscarTerminalesBancarias').val());" teclaEsc = "si" type="text" class="form-control" id="buscarTerminalesBancarias" name="buscarTerminalesBancarias" autofocus>
                      </div>
                    </div>
    
</div>
</center>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="incrustarTablaTerminalesBancarias"></div>
        
    </div>

    <?php

}

    ?>
    <!-- /.card-body -->
</div>








<br>
</div>

<div class="modal fade" id="modalCrearTerminalBancaria" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearTerminalBancaria">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Terminal Bancaria</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">


                        <center>
                        <div class="col-6">
                            <label>Terminal Bancaria 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="nuevaTerminalBancaria" name="nuevaTerminalBancaria" min="1" placeholder="Terminal Bancaria" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                        </div>
                    </center>



                        
                    
                </div>
                <div class="modal-footer justify-content-center">
                    <input type="button" class="btn btn-primary" id="btnCrearTerminalBancaria" value="Crear terminal bancaria">
                </div>

                <?php 

                $crearTerminalBancaria = new ControladorTerminalesBancarias();
                $crearTerminalBancaria -> ctrCrearTerminalBancaria();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="modalEditarTerminalBancaria" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioEditarTerminalBancaria">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Terminal Bancaria</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">


                        <center>
                        <div class="col-6">
                            <label>Terminal Bancaria 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="editarTerminalBancaria" name="editarTerminalBancaria" min="1" placeholder="Terminal Bancaria" onkeyup="javascript:this.value=this.value.toUpperCase();" required autofocus>
                            <input type="hidden" id="motorActual" name="motorActual">
                        </div>
                    </center>
                    

                        <input type="hidden"  name="idTerminalBancaria" id="idTerminalBancaria" required readonly>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" id="btnEditarTerminalBancaria">Guardar modificaciones</button>
                </div>

                <?php 

                $editarTerminalBancaria = new ControladorTerminalesBancarias();
                $editarTerminalBancaria -> ctrEditarTerminalBancaria();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>

<?php

}

?>