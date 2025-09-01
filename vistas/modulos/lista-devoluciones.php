<?php

                        $indiceVerDevoluciones = array_search("Ver devoluciones",$array,true);

                        if($indiceVerDevoluciones !== false){

                            ?>
<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

<!--CONTENIDO-->
<div class="card">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> LISTA DE DEVOLUCIONES</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php

                        $indiceCrearDevoluciones = array_search("Crear devoluciones",$array,true);

                        if($indiceCrearDevoluciones !== false){

                            ?>
                    <div class="breadcrumb float-sm-right">
                      <a href="crear-devolucion">
                        <button class="btn btn-primary" id="btnCrearNuevaDevolucion">Crear Devolucion</button>
                        </a>
                    </div>
                    <?php
                        }
                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<center>
    <div class="col-sm-6">

      <div class="input-group">
                        <div class="input-group-append">
                        <span class="input-group-text">Busqueda:</span>
                      </div>
                      <div class="custom-file">
                        <input onkeyup="buscarAhoraDevoluciones($('#buscarDevoluciones').val());" teclaEsc = "si" type="search" class="form-control" id="buscarDevoluciones" name="buscarDevoluciones" autocomplete="off" autofocus>
                      </div>
                    </div>
    
</div>
</center>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="incrustarTablaDevoluciones"></div>

    </div>
    <!-- /.card-body -->
</div>








<br>
</div>




<div class="modal fade" id="modalVerPartidasDevolucion" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Partidas de la devolución</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <div id="incrustarTablaPartidasDevolucion">
                  
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                </div>

        </div>
    </div>
</div>











<div class="modal fade" id="modalReimprimirTicketDevolucion">
    <!--PREFIJO DEL MODAL PARA EL FORM ES: CV = COBRO VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioReimprimirTicket">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres reimprimir este ticket de devolución?</p>
                          <input type="hidden" id="reimprimir_ticket_devolucion" name="reimprimir_ticket_devolucion">
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










<div class="modal fade" id="modalTimbrarDevolucion">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioTimbrarDevolucion">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres timbrar esta devolución?</p>
                          <small>Este ticket sale en surtido</small>

                          <br><br>

                          <input type="hidden" id="timbrarDevolucion" name="timbrarDevolucion">

                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" id="btnNoTimbrarDevolucion">No</button>

                          <button type="submit" class="btn btn-primary btn-lg" id="btnTimbrarDevolucion">Si</button>

                    </div>


        </div>


</div>



<?php 
$timbrar_devolucion = new ControladorDevoluciones();
$timbrar_devolucion -> ctrTimbrarDevolucion();


?>
</form>

</div>
</div>
</div>


<?php
}
?>