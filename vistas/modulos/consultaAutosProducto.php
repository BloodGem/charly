<?php 
error_reporting(0);
require_once "conexion.php";

$id_producto = $_POST["id_producto"];



$consultaAutosProducto = "SELECT * FROM productos WHERE id_producto = $id_producto";




$rsAutosProducto = $conexion->query($consultaAutosProducto);  

 $resultadoAutosProducto = $rsAutosProducto->fetch_array(MYSQLI_BOTH);



$listaAutosProducto = json_decode($resultadoAutosProducto['autos'], true);




foreach ($listaAutosProducto as $key => $value) {

    echo '<tr>
            <td>'.$value['nombre_auto'].'</td>

            <td>';

            if ($value['ano_inicial'] == $value['ano_final']) {
              echo $value['ano_inicial'];
            }else{
              echo $value['ano_inicial']." - ".$value['ano_final'];
              }

              echo '</td>
          </tr>';
}

                    


  ?>




                    
            