<?php 
error_reporting(0);
require_once "conexion.php";

$id_venta3 = $_POST["id_venta3"];



$consultaSeguimientoVenta = "SELECT * FROM cxc WHERE id_venta = $id_venta3";




$rsSeguimientoVenta = $conexion->query($consultaSeguimientoVenta);  

 while($resultadoSeguimientoVenta = $rsSeguimientoVenta->fetch_array(MYSQLI_BOTH)){ 



echo '<tr>
                    <td>
                    '.$resultadoSeguimientoVenta["fecha_creacion"].'
                    </td>
                    <td style="text-align: right;">
                    $'.number_format($resultadoSeguimientoVenta["importe"], 2).'
                    </td> 
</tr>';

                    


 } ?>




                    
              