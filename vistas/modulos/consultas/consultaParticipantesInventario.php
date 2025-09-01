<?php

error_reporting(0);

require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/inventarios.controlador.php";
require_once "../../../modelos/inventarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
 
$id_inventario = $_POST['id_inventario'];           

$traerInventario = ControladorInventarios::ctrMostrarInventario($id_inventario);

$listaParticipantes = json_decode($traerInventario['participantes'], true);
$listaResponsables = json_decode($traerInventario['responsables'], true);


    echo '<table id="tablaParticipantesInventario" class="table table-bordered table-striped">
            <thead>
                  <tr class="head-footer-tabla">
                    <th>Participante</th>
                  </tr>
                  </thead>
                  <tbody>';
//var_dump($listaParticipantes);
        
    foreach ($listaParticipantes as $keyP => $valueP) {

        $traerUsuarioParticipante = ControladorUsuarios::ctrMostrarUsuario($valueP);

        //var_dump($valueP." --- ".$traerUsuarioParticipante['nombre']);
        echo'<tr>
                                                        <td>'.$traerUsuarioParticipante['nombre'].'
                                            </td>
                                            
                                            
                
            </tr>';
    }
echo '</tbody>
                  <tfoot>
                  <tr class="head-footer-tabla">
                    <th>Participante</th>
                  </tr>
                  </tfoot>
        </table><br><hr><br>';






    echo '<table id="tablaResponsablesInventario" class="table table-bordered table-striped">
            <thead>
                  <tr class="head-footer-tabla">
                    <th>Responsable</th>
                  </tr>
                  </thead>
                  <tbody>';

        
    foreach ($listaResponsables as $keyR => $valueR) {

        $traerUsuarioResponsable = ControladorUsuarios::ctrMostrarUsuario($valueR);
        
        echo'<tr>
                                                        <td>'.$traerUsuarioResponsable['nombre'].'
                                            </td>
                                            
                                            
                
            </tr>';
    }
echo '</tbody>
                  <tfoot>
                  <tr class="head-footer-tabla">
                    <th>Responsable</th>
                  </tr>
                  </tfoot>
        </table>';

        
        ?>