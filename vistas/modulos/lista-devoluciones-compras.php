<?php

                        $indiceListaDevolucionesCompras = array_search("Lista devoluciones de compras",$array,true);

                        if($indiceListaDevolucionesCompras !== false){

                            ?>
<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> LISTA DEVOLUCIONES DE COMPRAS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php

                        $indiceCrearDevolucionesCompras = array_search("Crear devoluciones de compras",$array,true);

                        if($indiceCrearDevolucionesCompras !== false){

                            ?>
                    <div class="breadcrumb float-sm-right">
                      <a href="crear-devolucion-compra">
                        <button class="btn btn-primary" id="btnCrearNuevaDevolucionCompra">Crear Devolución</button>
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

                        $indiceVerDevolucionesCompras = array_search("Ver devoluciones de compras",$array,true);

                        if($indiceVerDevolucionesCompras !== false){

                            ?>
<center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraDevolucionesCompras($('#buscarDevolucionesCompras').val());" teclaEsc = "si" type="text" class="form-control" id="buscarDevolucionesCompras" name="buscarDevolucionesCompras" autofocus>
                      </div>
                    </div>
    
</div>
</center>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="incrustarTablaDevolucionesCompras"></div>

    </div>

    <?php
}
    ?>
    <!-- /.card-body -->
</div>








<br>
</div>




<div class="modal fade" id="modalVerPartidasDevolucionCompra" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Partidas de la devolución de compra</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <div id="incrustarTablaPartidasDevolucionCompra">
                  
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                </div>

        </div>
    </div>
</div>











<div class="modal fade" id="modalReimprimirTicketDevolucionCompra">
    <!--PREFIJO DEL MODAL PARA EL FORM ES: CV = COBRO VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioReimprimirTicket">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres reimprimir este ticket de devolución de compra?</p>
                          <input type="hidden" id="reimprimir_ticket_devolucion_compra" name="reimprimir_ticket_devolucion_compra">
                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" id="btnNoReimprimirTicket">No</button>
                          <button type="submit" class="btn btn-primary btn-lg" id="btnReimprimirTicket">Si</button>

                    </div>


        </div>


</div>



<?php 
$reimprimir_ticket_devoluciones = new ControladorDevoluciones();
$reimprimir_ticket_devoluciones -> ctrReimprimirTicketDevolucion();


?>
</form>

</div>
</div>
</div>






<?php
}
?>