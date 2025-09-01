<?php

error_reporting(0);
session_start();
require_once "../../../modelos/conexion2.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/anaqueles-inventarios.controlador.php";
require_once "../../../modelos/anaqueles-inventarios.modelo.php";

//require_once "../consultaArchivo/conexion.php";//CORRECTO
$id_usuario = $_SESSION['id'];

$id_inventario = $_POST['id_inventario'];           


    $traeranAquelesInventarios = ControladorAnaquelesInventarios::ctrMostrarAnaquelesInventario($id_inventario);

    echo '<table id="tablaAnaquelesInventario" class="table table-bordered table-striped">
            <thead>
                  <tr class="head-footer-tabla">
                    <th>Acción</th>
                    <th>Anaquel</th>
                    <th>Responsable</th>
                  </tr>
                  </thead>
                  <tbody>';

        
    foreach ($traeranAquelesInventarios as $key => $row) {

        $id_anaquel_inventario = $row['id_anaquel_inventario'];

        $traerUsuario = Controladorusuarios::ctrMostrarUsuario($row['id_usuario_asignacion']);
    
        $anaquel = $row['anaquel'];

        
        echo'<tr>
                                            <td>';
        if($row['estatus'] == 0){

            echo '<button class="btn-sm btn-danger btnVerProductosAnaquel" id_anaquel_inventario="'.$id_anaquel_inventario.'">Ver Seguimiento</button>';

            echo '<button class="btn-sm btn-secondary btnAsignarAnaquelInventario" id_anaquel_inventario="'.$id_anaquel_inventario.'" id_inventario="'.$id_inventario.'">Asignar anaquel</button>';

        }else if($row['estatus'] == 1){

            echo '<button class="btn-sm btn-warning btnVerProductosAnaquel" id_anaquel_inventario="'.$id_anaquel_inventario.'">Ver seguimiento</button>';

            if($row['id_usuario_asignacion'] == $id_usuario){
                echo '<button class="btn-sm btn-secondary btnCerrarAnaquel" id_anaquel_inventario="'.$id_anaquel_inventario.'" id_inventario="'.$id_inventario.'">Cerrar anaquel</button>';
            }
            

        }else if($row['estatus'] == 2){

            echo '<button class="btn-sm btn-success btnVerProductosAnaquel" id_anaquel_inventario="'.$id_anaquel_inventario.'">Ver seguimiento</button>';

        }
                                                       
                                                    
                                           echo '</td>

                                            <td>
                                                        '.$row['anaquel'].'
                                            </td>
                                            <td>
                                                        '.$traerUsuario['nombre'].'
                                            </td>
                                            
                                            
                
            </tr>';
    }
echo '</tbody>
                  <tfoot>
                  <tr class="head-footer-tabla">
                    <th>Acción</th>
                    <th>Anaquel</th>
                    <th>Responsable</th>
                  </tr>
                  </tfoot>
        </table>';

        
        ?>