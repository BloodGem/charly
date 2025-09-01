<?php 
//error_reporting(0);
require_once "../conexion.php";

$id_compra = $_POST["id_compra"];



$consultaSeguimientoCompra = "SELECT * FROM cxp WHERE id_compra = $id_compra";




$rsSeguimientoCompra = $conexion->query($consultaSeguimientoCompra);  


echo '<table class="table table-bordered table-striped" id="tablaPagosCompra">
    <thead>
      <tr>
        <th>Fecha</th>
        <th style="text-align: right;">Importe</th>

    </tr>
</thead>
<tbody>';



 while($resultadoSeguimientoCompra = $rsSeguimientoCompra->fetch_array(MYSQLI_BOTH)){ 

$date = date_create($resultadoSeguimientoCompra["fecha_creacion"]);

echo '<tr>
                    <td>
                    '.date_format($date,"d/m/Y H:i:s").'
                    </td>
                    <td style="text-align: right;">
                    $'.number_format($resultadoSeguimientoCompra["importe"], 2).'
                    </td> 
</tr>';

                    


 } 


 echo '</tbody>
<tfoot>
  <tr>
    <th>Fecha</th>
    <th style="text-align: right;">Importe</th>
</tr>
</tfoot>
</table>';


?>




                    
              