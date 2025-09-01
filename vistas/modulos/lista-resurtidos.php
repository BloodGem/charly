


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!--CONTENIDO-->
    <div class="card">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> LISTA DE RESURTIDOS</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <?php

                        $indiceCrearResurtidos = array_search("Crear resurtidos",$array,true);

                        if($indiceCrearResurtidos == 0){
                         
                        }else if($indiceCrearResurtidos !== ""){

                            ?>
                            <div class="breadcrumb float-sm-right">
                              <a href="resurtido">
                                <button class="btn btn-primary" id="btnCrearNuevoResurtido">Crear Resurtido</button>
                            </a>
                        </div>
                        <?php

                    }

                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php

    $indiceVerResurtidos = array_search("Ver resurtidos",$array,true);

    if($indiceVerResurtidos == 0){
     
    }else if($indiceVerResurtidos !== ""){

        ?>


        <center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraResurtidos($('#buscarResurtidos').val());" teclaEsc = "si" type="text" class="form-control" id="buscarResurtidos" name="buscarResurtidos" autofocus>
                      </div>
                    </div>
    
</div>
</center>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="incrustarTablaResurtidos"></div>
            
</div>
<?php

}

?>
<!-- /.card-body -->
</div>








<br>
</div>













<div class="modal fade" id="modalVerPartidasResurtido" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Partidas del resurtido</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <div id="incrustarTablaPartidasResurtido">
                  
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                </div>

        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>











<div class="modal fade" id="modalConvertirResurtidoACompra">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioConfirmarConversion">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>¿Quieres convertir el resurtido no.<span id="textoIdResurtido"></span> a compra?</p>
                          <small>Si confirmas ya no habrá vuelta atrás</small>
                          <br><br>
                          <input type="hidden" id="convertirResurtidoACompra" name="convertirResurtidoACompra">
                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" id="btnNoConfirmarConversion">No</button>
                          <button type="button" class="btn btn-primary btn-lg" id="btnSubmitConfirmarConversion">Si</button>

                    </div>


        </div>


</div>



<?php 
$convetir_resurtido_compra = new ControladorResurtidos();
$convetir_resurtido_compra -> ctrConvertirResurtidoACompra();


?>
</form>

</div>
</div>
</div>