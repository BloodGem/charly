<?php 
require_once "conexion.php"; 
//include "conexionPruebas.php";
//SE ENLISTAN PERMISOS
$indiceListaInventarios = array_search("Lista de inventarios",$array,true);
$indiceCrearInventarios = array_search("Crear inventarios",$array,true);
$indiceDescargarPreviaInventarios = array_search("Descargar previa inventarios",$array,true);
$indiceConfirmarInventarios = array_search("Confirmar inventarios",$array,true);
$indiceVerMovimientosInventarios = array_search("Ver movimientos de inventarios",$array,true);
$indiceSubirArchivoInventarios = array_search("Subir archivo a inventarios",$array,true);
$indiceVerArchivoInventarios = array_search("Ver archivo inventarios",$array,true);
$indiceVerParticipantesInventarios = array_search("Ver participantes inventarios",$array,true);
$indiceSeguimientoInventarios = array_search("Seguimiento inventarios",$array,true);




                    if($indiceListaInventarios!== false){
                    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-11 col-12">
            <center><h1 style="font-size: 40px; font-weight: 900;">Lista de Inventarios</h1>
              
            </center>

          </div>
          <div class="col-sm-1 col-12">
            <?php 
                $verificar_inventario_abierto = ControladorInventarios::ctrVerificarInventarioAbierto();

                if($verificar_inventario_abierto[0] == 0){

                     if($indiceCrearInventarios !== false){

                    echo'<center><button class="btn btn-success" id="btnAgregarNuevoInventario">Crear inventario</button></center>';

                }
                }
            ?>
          </div>
        </div><!-- /.container-fluid -->
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablaInventarios" class="table table-bordered table-hover">
                  <thead>
                  <tr class="head-footer-tabla">
                    <th>Acción</th>
                    <th>No. inv</th>
                    <th>Sucursal</th>
                    <th>Creador</th>
                    <th>Fecha Cre</th>
                    <th>Fecha Conf</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $traerIventarios = ControladorInventarios::ctrMostrarInventarios();

        

    foreach ($traerIventarios as $key => $row) {

        $arrayParticipantes = json_decode($row['participantes']);
        $arrayResponsables = json_decode($row['responsables']);


        $traerUsuarioInventario = ControladorUsuarios::ctrMostrarUsuario($row['id_usuario_creador']);

        $traerSucursal = ControladorSucursales::ctrMostrarSucursal($row['id_sucursal']);


      echo '<tr><td><div class="btn-group">';

if($indiceSeguimientoInventarios !== false){
        echo '<button class="btn btn-info btnVerAnaquelesInventario" id_inventario="'.$row["id_inventario"].'">Ver</button>';
        }

      if($indiceVerParticipantesInventarios !== false){
        echo '<button class="btn btn-warning btnVerParticipantesInventario" id_inventario="'.$row["id_inventario"].'">Participantes</button>';
        }
      


      if($row['estatus'] == 0){


      if($indiceDescargarPreviaInventarios !== false){
        echo '<button type="button" class="btn btn-secondary btnDescargarPDFPreviaInventario" id_inventario="'.$row["id_inventario"].'">Previa</button>';
        }



        if($indiceConfirmarInventarios !== false){
        echo '<button type="button" class="btn btn-success btnConfirmarInventario" id_inventario="'.$row["id_inventario"].'">Confirmar</button>';
        }
      

        

      }else{
        if($indiceVerMovimientosInventarios !== false){
            echo'<button type="button" class="btn btn-danger btnVerMovimientosInventario" id_inventario="'.$row["id_inventario"].'">Ver movimientos</button>';
        }
        

        if($row['ruta_archivo'] == ""){

            if($indiceSubirArchivoInventarios !== false){
            echo'<button type="button" class="btn-sm btn-primary btnSubirArchivoInventario" id_inventario="'.$row["id_inventario"].'">Subir imagen</button>';
        }

            

        }else{

            if($indiceVerArchivoInventarios !== false){
            echo'<a href="'.$row["ruta_archivo"].'" data-toggle="lightbox" data-title="Finiquito Inventario" data-gallery="gallery" data-backdrop="static">
                <img src="'.$row["ruta_archivo"].'" class="img-fluid mb-2" alt="pago" width="40px"/>
                </a>';
        }

}
      }

      /*$indiceEntregaRequisiciones = array_search("Entrega de requisiciones",$array,true);
if($indiceEditarRequisiciones !== false){
                                        echo '<button class="btn-sm btn-warning btnEditarRequisicion" id_requisicion="'.$row["id_requisicion"].'">Editar</button>';
                                    }//PERMISO PARA EDITAR REQUISICIONES*/
      
      
      echo '
   
                                            </div></td>

                                             <td>
                                                        '.$row['id_inventario'].'
                                            </td>
                                            
                                            <td>
                                                        '.$traerSucursal['nombre_sucursal'].'
                                            </td>
                                            <td>
                                                        '.$traerUsuarioInventario['nombre'].'
                                            </td>
                                            <td>
                                              '.$row['fecha_creacion'].'
                                            </td>
                                            <td>
                                              '.$row['fecha_confirmacion'].'
                                            </td></tr>';
    }

    ?>
                 
                  </tbody>
                  <tfoot>
                  <tr class="head-footer-tabla">
                    <th>Acción</th>
                    <th>No. inv</th>
                    <th>Sucursal</th>
                    <th>Creador</th>
                    <th>Fecha Cre</th>
                    <th>Fecha Conf</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>










<div class="modal fade" id="modalCrearInventario">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearInventario">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Inventario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                    <input type="hidden" name="id_sucursal" id="id_sucursal" value="<?php echo $traerSucursal['id_sucursal'] ?>">
                       <div class="col-12">
                        <div id="incrustarSelectResponsablesInventarios"></div>
                </div>

                        <div class="col-12">
                          <div class="form-group">
                        <label>Participantes</label>
        <select class="duallistboxParticipantesInventarios" multiple="multiple" id="nuevosParticipantes" name="nuevosParticipantes[]">
        
                            <?php 

        $traerUsuarios = ControladorUsuarios::ctrMostrarUsuarios(null, null);
        foreach ($traerUsuarios as $keyU => $rowU) {
                              echo '<option value="'.$rowU["id"].'">'.$rowU["nombre"].'</option>';
                            }
                            ?>
                          
                        </select></div>
                </div>

                
                <!-- /.form-group -->
              
              <!-- /.col -->
            </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnCrearInventario">Crear inventario</button>
                </div>

                <?php 

                $crearInventario = new ControladorInventarios();
                $crearInventario -> ctrCrearInventario();

                ?>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>













  <div class="modal fade" id="modalVerAnaquelesInventario" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Anaqueles inventario</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal"></div>
                <div class="modal-body">


                    <div class="row">


                    <div class="col-lg-12 col-12">
                        
                    <div id="incrustarTablaAnaquelesInventario"></div>
                 
</div>
        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
        </div>
    </div>

</div>










<div class="modal fade" id="modalVerProductosAnaquel" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Productos del anaquel: <span class="font-weight-bold" id="textoAnaquel"></span></h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal"></div>
                <div class="modal-body">

                  <input type="hidden" name="id_inventario2" id="id_inventario2">
                   <input type="hidden" name="anaquel" id="anaquel">
                    <div class="row">


                    <div class="col-lg-12 col-12">
                        
                    <div id="incrustarTablaProductosAnaquel"></div>
                 
</div>
        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
        </div>
    </div>

</div>










<div class="modal fade" id="modalCantidadesProducto" style="overflow-y: scroll;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cantidades</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnCerrarModalCantidadesProducto"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal"></div>
                <div class="modal-body">


                    <div class="row">


                    <div class="col-12">
                      <label>Cantidad 1</label>
                      <div class="input-group">
                        
                        <input type="number" class="form-control" id="cantidad1" name="cantidad1" value="0">
                      </div>
                 
                    </div>
                    <div class="col-12">
                      <label>Cantidad 2</label>
                      <div class="input-group">
                        <input type="number" class="form-control" id="cantidad2" name="cantidad2" value="0">
                      </div>
                 
                    </div>
                    <div class="col-12">
                      <label>Cantidad 3</label>
                      <div class="input-group">
                        <input type="number" class="form-control" id="cantidad3" name="cantidad3" value="0">
                      </div>
                 
                    </div>
                    <div class="col-12">
                      <label>Cantidad 4</label>
                      <div class="input-group">
                        <input type="number" class="form-control" id="cantidad4" name="cantidad4" value="0">
                      </div>
                 
                    </div>
                    <div class="col-12">
                      <label>Cantidad 5</label>
                      <div class="input-group">
                        <input type="number" class="form-control" id="cantidad5" name="cantidad5" value="0">
                      </div>
                 
                    </div>

                    <hr>

                    <div class="col-12">
                      <label>TOTAL</label>
                      <div class="input-group">
                        
                        <input type="text" class="form-control" id="existenciasEncontradas" name="existenciasEncontradas" value="0" readonly>
                      </div>
                 
                    </div>
        </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-success" id="btnSubirCantidades">Subir</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
        </div>
    </div>

</div>










<div class="modal fade" id="modalVerParticipantesInventario" style="overflow-y: scroll;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Participantes / Responsables</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal">
                    
                </div>
                <div class="modal-body">
<!--<button type="button" class="btn btn-success" id="agregarNuevoParticipante">Agregar participante</button>-->
                    <div class="row">


                    <div class="col-lg-12 col-12">
                        
                    <div id="incrustarTablaParticipantesInventario"></div>
                 
</div>
        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
        </div>
    </div>

</div>










<div class="modal fade" id="modalSubirArchivoInventario">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            
                <div class="modal-header">
                    <h4 class="modal-title">Subir Archivo</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal"></div>
                <form method="post" enctype="multipart/form-data" name="formularioSubirArchivoInventario" id="formularioSubirArchivoInventario">

                <div class="modal-body">

<input type="hidden" class="form-control" id="mostrarIdInventario" name="mostrarIdInventario">
<div class="row">
                                        

                              <div class="col-sm-12">
                                <label>Subir archivo</label>
                                <input type="file" accept="" class="form-control" id="nuevoArchivoPagoInventario" name="nuevoArchivoPagoInventario">
                              </div>

                </div>


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnSubirArchivoInventario">Subir Archivo</button>
                </div>

                <?php

                $subirArchivoInventario = new ControladorInventarios();
                $subirArchivoInventario -> ctrSubirArchivoInventario();
              ?>
            </form>

        </div>
    </div>
</div>










<div class="modal fade" id="modalVerMovimientosInventario" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Movimientos hechos</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal"></div>
                <div class="modal-body">

                    <div class="row">


                    <div class="col-lg-12 col-12">
                        
                    <div id="incrustarTablaMovimientosInventario"></div>
                 
</div>
        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
        </div>
    </div>

</div>










<div class="modal fade" id="modalConfirmarInventario">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioConfirmarInventario">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                          <h1>ESTAS SEGUR@?</h1>
                          <p>Quieres confirmar este ajuste?</p>
                          <small>Si confirmas ya no habrá vuelta atrás</small>
                          <br><br>
                          <input type="hidden" id="confirmarInventario" name="confirmarInventario">
                          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" id="btnNoConfirmarInventario">No</button>
                          <button type="submit" class="btn btn-primary btn-lg" id="btnSiConfirmarInventario">Si</button>

                    </div>


        </div>


</div>



<?php 
$confirmarInventario = new ControladorInventarios();
$confirmarInventario -> ctrConfirmarInventario();


?>
</form>

</div>
</div>
</div>









<script>
      $(function () {
    $('.duallistboxParticipantesInventarios').bootstrapDualListbox({
      selectorMinimalHeight: '200',
      infoText:'Tiene {0} Participantes',
      infoTextEmpty : 'No hay Participantes',
      infoTextFiltered : '<span class="label label-warning">Buscar Participante</span> {0} from {1}',
    });
  })
</script>








<?php } ?>