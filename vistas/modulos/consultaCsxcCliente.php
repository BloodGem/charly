<?php 
require_once "conexion.php";
$id_cliente = $_POST["id_cliente"];



$consultaSeguimientoVenta = "SELECT ventas.id, ventas.total, ventas.saldo_actual, DATE_FORMAT(ventas.fecha_creacion,'%d-%m-%Y') as fecha FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE clientes.id_cliente = $id_cliente AND id_forma_pago = 'PPD' ORDER BY saldo_actual DESC LIMIT 50";

//var_dump($consultaSeguimientoVenta);


$rsSeguimientoVenta = $conexion->query($consultaSeguimientoVenta);  

 while($resultadoSeguimientoVenta = $rsSeguimientoVenta->fetch_array(MYSQLI_BOTH)){ 




    echo '<tr>';
    if ($resultadoSeguimientoVenta["saldo_actual"] == 0) {
       
       echo '<td><button class="btn-xs btn-default" accesskey="a" disabled>Agregar</button</td>';

    }else{

      echo '<td><button class="btn-xs btn-primary agregarVenta recuperarBoton" id_venta="'.$resultadoSeguimientoVenta["id"].'" accesskey="a">Agregar</button</td>';
      
    }
    echo '
    <td>
    '.$resultadoSeguimientoVenta["id"].'
    </td>
    <td style="text-align: right;">
    $'.number_format($resultadoSeguimientoVenta["total"], 2).'
    </td>
    <td style="text-align: right;">
    $'.number_format($resultadoSeguimientoVenta["saldo_actual"], 2).'
    </td>  
    <td>
    '.$resultadoSeguimientoVenta["fecha"].'
    </td>

    <td><div class="btn-group">';

        echo '<button class="btn btn-info btnVerSeguimientoVenta" id_venta="'.$resultadoSeguimientoVenta["id"].'" accesskey="2" tabindex="-1" data-toggle="modal" data-target="#modalVerSeguimientoVenta">Ver seguimiento</button>


        <button type="button" class="btn btn-success btnVerPartidasVenta" id_venta="'.$resultadoSeguimientoVenta["id"].'">Ver venta
            </button>'; 

    
    
    echo '</div></td>';

                    


 } ?>




                    
              