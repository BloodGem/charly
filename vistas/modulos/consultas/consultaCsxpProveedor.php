<?php 
require_once "../conexion.php";
$id_proveedor = $_POST["id_proveedor"];



$consultaSeguimientoCompra = "SELECT compras.id, compras.total, compras.saldo_actual, DATE_FORMAT(compras.fecha_creacion,'%d-%m-%Y') as fecha FROM compras INNER JOIN proveedores ON compras.id_proveedor = proveedores.id_proveedor WHERE proveedores.id_proveedor = $id_proveedor AND compras.estatus = 2 ORDER BY saldo_actual DESC LIMIT 50";

//var_dump($consultaSeguimientoCompra);


$rsSeguimientoCompra = $conexion->query($consultaSeguimientoCompra);

echo '<table class="table table-bordered table-striped listaCsxpProveedor" id="tablaCsxpProveedor">
    <thead>
      <tr>
        <th></th>
        <th>Id compra</th>
        <th style="text-align: right;">Saldo Inicial</th>
        <th style="text-align: right;">Saldo actual</th>
        <th>Fecha</th>
        <th>Acciones</th>
    </tr>
</thead>
<tbody>';


 while($resultadoSeguimientoCompra = $rsSeguimientoCompra->fetch_array(MYSQLI_BOTH)){ 




    echo '<tr>';
    if ($resultadoSeguimientoCompra["saldo_actual"] == 0) {
       
       echo '<td><button class="btn-xs btn-default" accesskey="a" disabled>Agregar</button</td>';

    }else{

      echo '<td><button class="btn-xs btn-primary agregarCompra recuperarBoton" id_compra="'.$resultadoSeguimientoCompra["id"].'" accesskey="a">Agregar</button</td>';
      
    }
    echo '
    <td>
    '.$resultadoSeguimientoCompra["id"].'
    </td>
    <td style="text-align: right;">
    $'.number_format($resultadoSeguimientoCompra["total"], 2).'
    </td>
    <td style="text-align: right;">
    $'.number_format($resultadoSeguimientoCompra["saldo_actual"], 2).'
    </td>  
    <td>
    '.$resultadoSeguimientoCompra["fecha"].'
    </td>

    <td><div class="btn-group">';

        echo '<button class="btn btn-info btnVerSeguimientoCompra" id_compra="'.$resultadoSeguimientoCompra["id"].'" accesskey="2" tabindex="-1" data-toggle="modal" data-target="#modalVerSeguimientoCompra">Ver seguimiento</button>


        <button type="button" class="btn btn-success btnVerPartidasCompra" id_compra="'.$resultadoSeguimientoCompra["id"].'">Ver compra
            </button>'; 

    
    
    echo '</div></td>';

                    


 } 


 echo '</tbody>
<tfoot>
  <tr>
    <th></th>
    <th>Id compra</th>
    <th style="text-align: right;">Saldo Inicial</th>
    <th style="text-align: right;">Saldo actual</th>
    <th>Fecha</th>
    <th>Acciones</th>
</tr>
</tfoot>
</table>'; 


?>




                    
              