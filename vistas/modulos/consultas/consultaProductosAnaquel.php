<?php
error_reporting(0);

session_start();

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";

require_once "../../../controladores/inventarios.controlador.php";
require_once "../../../modelos/inventarios.modelo.php";

require_once "../../../controladores/anaqueles-inventarios.controlador.php";
require_once "../../../modelos/anaqueles-inventarios.modelo.php";

require_once "../../../controladores/partidas-inventarios.controlador.php";
require_once "../../../modelos/partidas-inventarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

$id_usuario = $_SESSION['id'];
$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($id_usuario);
$id_grupo = $traerUsuario['id_grupo'];
$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);
$array = json_decode($respuesta2['permisos']);


$indiceCambiarCantidadesEncontradasDePartidasDeInventarios = array_search("Cambiar cantidades encontradas en partidas de inventarios",$array,true);





$indiceVerExistenciasActualesProductosAI = array_search("Ver existencias actuales productos anaqueles inventarios",$array,true);




$id_anaquel_inventario = $_POST['id_anaquel_inventario'];
$traerAnaquelInventario = ControladorAnaquelesInventarios::ctrMostrarAnaquelInventario($id_anaquel_inventario);   

$id_inventario = $traerAnaquelInventario['id_inventario'];
$anaquel = $traerAnaquelInventario['anaquel'];

$traerInventario = ControladorInventarios::ctrMostrarInventario($traerAnaquelInventario['id_inventario']);

$traerProductosAnaquelInventario = ControladorPartidasInventarios::ctrMostrarProductosAnaquelInventario($id_inventario, $anaquel);


echo '<table id="tablaProductosAnaquel" class="table table-bordered table-striped">
<thead>
<tr class="head-footer-tabla"><th>Acción</th>
<th>Ubicación</th>
<th>Clave</th>
<th>Producto</th>';
if($indiceVerExistenciasActualesProductosAI !== false){
echo'<th>Exis act</th>';
}
echo'<th>Exis enc</th>
<th>Fecha</th>
<th>Responsable del cambio</th>
</tr>
</thead>
<tbody>';


foreach ($traerProductosAnaquelInventario as $key => $row) {

    $traerProducto = ControladorProductos::ctrMostrarProducto($row['id_producto']);


    $traerUsuarioActualizacion = ControladorUsuarios::ctrMostrarUsuario($row['id_usuario_ult_mod']);

    if($row['id_usuario_ult_mod'] == 0){
        echo '<tr>';
    }else{
        echo '<tr style="background-color: #6AF068;">'; 
    }


        /*echo "Estatus inventario: ".$row['ESTATUS_INVENTARIO']."<br>";
        echo "Estatus anaquel: ".$row['ESTATUS_ANAQUEL']."<br>";
        echo "Estatus partida: ".$row['estatus']."<br>";*/

        echo'<td><div class="btn-group">';
        if($row['estatus'] == 1 && $traerInventario['estatus'] == 0){

            if($indiceCambiarCantidadesEncontradasDePartidasDeInventarios !== false){

                if($row['existencias_encontradas'] == 0){
                    echo '<button class="btn-sm btn-danger btnIngresarCantidad" id_anaquel_inventario="'.$id_anaquel_inventario.'" id_partida_inventario="'.$row['id_partida_inventario'].'">Cambiar Cant.</button>';
                }else{
                    echo '<button class="btn-sm btn-success btnIngresarCantidad" id_anaquel_inventario="'.$id_anaquel_inventario.'" id_partida_inventario="'.$row['id_partida_inventario'].'">Cambiar Cant.</button>';
                }

            }

            echo '<button class="btn btn-sm btn-disabled btn-danger" disabled>Anaquel Cerrado</button>';
            
        }else if($row['estatus'] == 2 && $traerInventario['estatus'] == 1){
            echo '<button class="btn btn-sm btn-disabled btn-danger" disabled>Inventario confirmado</button>';
            
        }else if($row['estatus'] == 0 && $traerAnaquelInventario['estatus'] == 1 && $traerInventario['estatus'] == 0){

            if($traerAnaquelInventario['id_usuario_asignacion'] == $id_usuario){
                if($row['existencias_encontradas'] == 0){
                    echo '<button class="btn-sm btn-danger btnIngresarCantidad" id_anaquel_inventario="'.$id_anaquel_inventario.'" id_partida_inventario="'.$row['id_partida_inventario'].'">Cambiar Cant.</button>';
                }else{
                    echo '<button class="btn-sm btn-success btnIngresarCantidad" id_anaquel_inventario="'.$id_anaquel_inventario.'" id_partida_inventario="'.$row['id_partida_inventario'].'">Cambiar Cant.</button>';
                }


            }


        }
        echo '</div></td>

        <td>
        '.$row['ubicacion_actual'].'
        </td>
        
        <td>
        '.$traerProducto['clave_producto'].'         

        </td>

        <td>
        '.$traerProducto['descripcion_corta'].'
        </td>';


        
        if($indiceVerExistenciasActualesProductosAI !== false){
            if($row['existencias_actuales'] !== $row['existencias_encontradas']){
                echo'<td style="background-color: #F0EA2B;">'.$row['existencias_actuales'].'</td>';
            }else{
                echo'<td>'.$row['existencias_actuales'].'</td>';
            }

        }



        if($row['existencias_encontradas'] == 0){
            echo'<td style="background-color: #F03E44;">'.$row['existencias_encontradas'].'</td>';
        }else{
            echo'<td>'.$row['existencias_encontradas'].'</td>';
        }
        echo'
        <td>
        '.$row['fecha_ult_mod'].'
        </td>';
        if($row['id_usuario_ult_mod'] == null){
            echo '<td></td>';
        }else{
           echo ' <td>
           '.$traerUsuarioActualizacion['nombre'].'
           </td>'; 
       }





       echo '</tr>';
   }
   echo '</tbody>
   <tfoot>
   <tr class="head-footer-tabla">
   <th>Acción</th>
   <th>Ubicación</th>
   <th>Clave</th>
   <th>Producto</th>';
if($indiceVerExistenciasActualesProductosAI !== false){
echo'<th>Exis act</th>';
}
echo'<th>Exis enc</th>
   <th>Fecha</th>
   <th>Responsable del cambio</th>
   </tr>
   </tfoot>
   </table>';


?>