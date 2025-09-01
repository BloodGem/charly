<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();
 include 'conexion.php';


    $no_rango = $_POST['no_rango'];
    $id_cliente = $_POST['id_cliente'];

    if($no_rango == "" || $id_cliente == ""){
        return;
    }


    if(isset($_POST['rango_fecha'])){
        $rango_fecha = $_POST['rango_fecha'];
        $fecha1 = substr( $rango_fecha, 0, 10 );
        $fecha2 = substr( $rango_fecha, 13, 22 );
    }

    switch ($no_rango) {
    case 1:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, (VENTAS.BRUTO + VENTAS.IMPUESTO) AS TOTAL, SUCURSAL.NOMBRE, CLIENTES.NOMBRE AS NOMBRE_CLIENTE FROM (VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL) INNER JOIN CLIENTES ON VENTAS.IDCLIENTE = CLIENTES.IDCLIENTE WHERE Format( VENTAS.FECHA,'Short Date') = Date() AND VENTAS.COBRADA = true AND VENTAS.CANCELADA = false AND VENTAS.IDCLIENTE = $id_cliente";
        break;
    case 2:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, (VENTAS.BRUTO + VENTAS.IMPUESTO) AS TOTAL, SUCURSAL.NOMBRE, CLIENTES.NOMBRE AS NOMBRE_CLIENTE FROM (VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL) INNER JOIN CLIENTES ON VENTAS.IDCLIENTE = CLIENTES.IDCLIENTE WHERE Format( VENTAS.FECHA,'Short Date') = Date()-1 AND VENTAS.COBRADA = true AND VENTAS.CANCELADA = false AND VENTAS.IDCLIENTE = $id_cliente";
        break;
    case 3:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, (VENTAS.BRUTO + VENTAS.IMPUESTO) AS TOTAL, SUCURSAL.NOMBRE, CLIENTES.NOMBRE AS NOMBRE_CLIENTE FROM (VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL) INNER JOIN CLIENTES ON VENTAS.IDCLIENTE = CLIENTES.IDCLIENTE WHERE DATEDIFF('d',VENTAS.FECHA,now())<=6 AND VENTAS.COBRADA = true AND VENTAS.CANCELADA = false AND VENTAS.IDCLIENTE = $id_cliente";
        break;
        case 4:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, (VENTAS.BRUTO + VENTAS.IMPUESTO) AS TOTAL, SUCURSAL.NOMBRE, CLIENTES.NOMBRE AS NOMBRE_CLIENTE FROM (VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL) INNER JOIN CLIENTES ON VENTAS.IDCLIENTE = CLIENTES.IDCLIENTE WHERE DATEDIFF('d',VENTAS.FECHA,now())<=29 AND VENTAS.COBRADA = true AND VENTAS.CANCELADA = false AND VENTAS.IDCLIENTE = $id_cliente";
        break;
    case 5:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, (VENTAS.BRUTO + VENTAS.IMPUESTO) AS TOTAL, SUCURSAL.NOMBRE, CLIENTES.NOMBRE AS NOMBRE_CLIENTE FROM (VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL) INNER JOIN CLIENTES ON VENTAS.IDCLIENTE = CLIENTES.IDCLIENTE WHERE Year(VENTAS.FECHA) = Year(Now()) AND Month(VENTAS.FECHA) = Month(Now()) AND VENTAS.COBRADA = true AND VENTAS.CANCELADA = false AND VENTAS.IDCLIENTE = $id_cliente";
        break;
    case 6:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, (VENTAS.BRUTO + VENTAS.IMPUESTO) AS TOTAL, SUCURSAL.NOMBRE, CLIENTES.NOMBRE AS NOMBRE_CLIENTE FROM (VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL) INNER JOIN CLIENTES ON VENTAS.IDCLIENTE = CLIENTES.IDCLIENTE WHERE Year(VENTAS.FECHA)* 12 + DatePart('m', VENTAS.FECHA) = Year(Date())* 12 + DatePart('m', Date()) - 1 AND VENTAS.COBRADA = true AND VENTAS.CANCELADA = false AND VENTAS.IDCLIENTE = $id_cliente";
        break;

        case 7:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, (VENTAS.BRUTO + VENTAS.IMPUESTO) AS TOTAL, SUCURSAL.NOMBRE, CLIENTES.NOMBRE AS NOMBRE_CLIENTE FROM (VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL) INNER JOIN CLIENTES ON VENTAS.IDCLIENTE = CLIENTES.IDCLIENTE WHERE DateValue(Format(VENTAS.FECHA,'dd/mm/yyyy')) BETWEEN #$fecha1# AND #$fecha2# AND VENTAS.COBRADA = true AND VENTAS.CANCELADA = false AND VENTAS.IDCLIENTE = $id_cliente";

        break;
    
}

 
                                 
                                    
    //Recogemos las claves enviadas
    


echo '<table id="tablaVentasClientes" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th style="text-align: center;">Id</th>
                    <th style="text-align: center;">Fecha</th>
                    <th style="text-align: center;">Tipo de venta</th>
                    <th style="text-align: right;">Total</th>
                    <th style="text-align: center;">Sucursal</th>
                  </tr>
                  </thead>
                  <tbody>';





        
    $rs = odbc_exec( $con, $sql );

    $total_acumulado = 0;
        
    while ( $row = odbc_fetch_array($rs) ) { 

        $total = number_format($row['TOTAL'], 2);

        $total_acumulado = $total_acumulado + $row['TOTAL'];
        
        echo'<tr>
                                            <td style="text-align: center;">
                                                     '.$row['IDVENTA'].'   
                                            </td>
                                            </td>
                                            <td style="text-align: center;">
                                                        '.$row['FECHA'].'
                                            </td>
                                            <td style="text-align: center;">
                                                        '.$row['IDTIPO'].'
                                            </td>
                                            <td style="text-align: right;">
                                                        $'.$total.'
                                            </td>
                                            <td style="text-align: center;">
                                                        '.$row['NOMBRE'].'
                                                    
                                            </td>
                                            
                
            </tr>';
    }
                  
                 
                  echo '</tbody>
                  <tfoot>
                  <tr>
                    <th style="text-align: center;">Id</th>
                    <th style="text-align: center;">Fecha</th>
                    <th style="text-align: center;">Tipo de venta</th>
                    <th style="text-align: right;">Total</th>
                    <th style="text-align: center;">Sucursal</th>
                  </tr>
                  </tfoot>
                </table>
                <br><br>
                <center><h3>Total Ventas: $'.number_format($total_acumulado, 2).'</h3></center>';





        
            
            
    
        
       
        ?>