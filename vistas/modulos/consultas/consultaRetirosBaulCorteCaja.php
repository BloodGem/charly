<?php 
//error_reporting(0);
session_start();
require_once "../../../modelos/conexion2.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";


$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
        
$id_sucursal = $traerUsuario['id_sucursal'];

$id_grupo = $traerUsuario['id_grupo'];

$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);

$array = json_decode($respuesta2['permisos']);

$id_corte_caja = $_POST["id_corte_caja"];



$consultaRetirosBaulCorteCaja = "SELECT * FROM retiros_baul WHERE id_corte_caja = $id_corte_caja AND estatus = 0";


$rsRetirosBaulCorteCaja = $conexion->query($consultaRetirosBaulCorteCaja);  

echo '<table class="table table-bordered table-responsive table-striped" id="tablaRetirosBaulCorteCaja">
            <thead>
                  <tr>
                  <th>Archivo</th>
                    <th>Importe</th>
                    <th>Observaciones</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>';

 while($row = $rsRetirosBaulCorteCaja->fetch_array(MYSQLI_BOTH)){ 


                    
                  

echo '<tr><td>';
                    if($row['archivo'] == 0){

            echo'.';

        }else{

            $extension = substr($row['ruta_archivo'], -3);
            
                if($extension == 'pdf' || $extension == 'PDF'){
                echo'<button class="btn-sm btn-primary btnMostrarPDF" value="recursos/retiros_cajas_baul/'.$row['ruta_archivo'].'">Ver</button>
                ';
            }else{
                echo'<a href="recursos/retiros_cajas_baul/'.$row['ruta_archivo'].'" data-toggle="lightbox" data-title="'.$row["id_retiro"].'" data-gallery="gallery" data-backdrop="static">
                <img src="recursos/retiros_cajas_baul/'.$row['ruta_archivo'].'" class="img-fluid mb-2" alt="'.$row["id_retiro"].'" width="40px"/>
                </a>';
            }
            
        }
                    
                    echo'</td><td>
                    '.$row["importe"].'
                    </td> 
                    <td>
                    '.$row["observaciones"].'
                    </td>
                    <td>
                    '.$row["fecha_creacion"].'
                    </td><td><div class="btn-group">';


                    $indiceEliminarRetiroBaulCorteCaja = array_search("Eliminar retiros baul core caja",$array,true);

                    if($indiceEliminarRetiroBaulCorteCaja !== false){

                      echo '<button class="btn btn-danger btnEliminarRetiroBaulCorteCaja" id_retiro_baul="'.$row["id_retiro_baul"].'" >Eliminar</button>';
                    }





                    $indiceReimprimirTicketRetiroBaulCorteCaja = array_search("Reimprimir ticket retiro baul corte caja",$array,true);

                    if($indiceReimprimirTicketRetiroBaulCorteCaja !== false){

                      echo '<button class="btn btn-info btnReimprimirTicketRetiroBaulCorteCaja" id_retiro_baul="'.$row["id_retiro_baul"].'" >Reimprimir</button>';
                    }

                    echo'</td></tr>';

                    


 } 



 echo '</tbody>
                  <tfoot>
                  <tr>
                  <th>Archivo</th>
                    <th>Importe</th>
                    <th>Observaciones</th>
                    <th>Tipo retiro</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                  </tr>
                  </tfoot>
        </table>';



        ?>




                    
              