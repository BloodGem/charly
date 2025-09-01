<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!--CONTENIDO-->
    <div class="card">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> LISTA DE VENDEDORES</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <div class="breadcrumb float-sm-right">
                        <?php

                        $indiceCrearVendedores = array_search("Crear vendedores",$array,true);

                        if($indiceCrearVendedores == 0){
                         
                        }else if($indiceCrearVendedores !== ""){

                            
                            
                              echo '<button class="btn btn-primary" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalCrearVendedor" accesskey="1">Crear Vendedor</button>';
                       

                        

                    }

                    ?>
                     </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

    $indiceVerVendedores = array_search("Ver vendedores",$array,true);

    if($indiceVerVendedores == 0){
     
    }else if($indiceVerVendedores !== ""){

        ?>
      
<div class="card-body">
            <div class="row">
                <div class="col-3">
</div>

 <div class="col-6">
      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Búsqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraVendedores($('#buscarVendedores').val());" type="search" class="form-control" style="font-weight: bold; font-size: 25px" id="buscarVendedores" name="buscarVendedores" autofocus accesskey="b">
                      </div>
                    </div>

</div>
<div class="col-3">
</div>
</div>
<br>
<div id="incrustarTablaVendedores">
            
        </div>
        </div>

        <?php
    }

    ?>
    <!-- /.card-body -->
</div>





<br>
</div>

<div class="modal fade" id="modalCrearVendedor">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearVendedor">
                <div class="modal-header">
                    <h4 class="modal-title">Crear vendedor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <label>Nombres 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="nuevosNombres" name="nuevosNombres" min="1" placeholder="Nombres" required autofocus autocomplete="off">
                        </div>
                        <div class="col-lg-3 col-12">
                            <label>Apellido Paterno 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="nuevoApellidoP" name="nuevoApellidoP" min="1" placeholder="Vendedor" autocomplete="off" required>
                        </div>
                        <div class="col-lg-3 col-12">
                            <label>Apellido Materno 
                                <big><code>*</code></big>
                            </label>
                            <input type="text" class="form-control" id="nuevoApellidoM" name="nuevoApellidoM" min="1" placeholder="Vendedor" autocomplete="off" required>
                        </div>
                        <div class="col-lg-6 col-12">
                            <label>Código 
                                <big><code>*</code></big>
                            </label>
                            <div class="input-group">
                                <input id="nuevoCodigo" name="nuevoCodigo" type="Password" Class="form-control" autocomplete="off" required>
                                <div class="input-group-append">
                                              
                                    <button id="mostrarCodigo" class="btn btn-primary" type="button"> <span class="fa fa-eye-slash icon" accesskey="v"></span> </button>
                                </div>
                                           
                            </div>
                        </div>
                        

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnCrearVendedor">Crear vendedor</button>
                </div>

                <?php 

                $crearVendedor = new ControladorVendedores();
                $crearVendedor -> ctrCrearVendedor();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>



