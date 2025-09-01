<?php

error_reporting(0);

require_once "conexion.php";

$no_rango = $_GET['no_rango'];
$id_cliente = $_GET['id_cliente'];

if($no_rango == ""){
	return;
}

if(isset($_GET['rango_fecha'])){
        $rango_fecha = $_GET['rango_fecha'];
        $fecha1 = substr( $rango_fecha, 0, 10 );
        $fecha2 = substr( $rango_fecha, 13, 22 );
    }

    switch ($no_rango) {
    case 1:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, VENTAS.COBRO, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Format( VENTAS.FECHA,'Short Date') = Date() AND VENTAS.COBRADA = true AND VENTAS.IDCLIENTE = $id_cliente";
        break;
    case 2:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, VENTAS.COBRO, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Format( VENTAS.FECHA,'Short Date') = Date()-1 AND VENTAS.COBRADA = true AND VENTAS.IDCLIENTE = $id_cliente";
        break;
    case 3:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, VENTAS.COBRO, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DATEDIFF('d',VENTAS.FECHA,now())<=6 AND VENTAS.COBRADA = true AND VENTAS.IDCLIENTE = $id_cliente";
        break;
        case 4:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, VENTAS.COBRO, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DATEDIFF('d',VENTAS.FECHA,now())<=29 AND VENTAS.COBRADA = true AND VENTAS.IDCLIENTE = $id_cliente";
        break;
    case 5:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, VENTAS.COBRO, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Year(VENTAS.FECHA) = Year(Now()) AND Month(VENTAS.FECHA) = Month(Now()) AND VENTAS.COBRADA = true AND VENTAS.IDCLIENTE = $id_cliente";
        break;
    case 6:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, VENTAS.COBRO, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Year(VENTAS.FECHA)* 12 + DatePart('m', VENTAS.FECHA) = Year(Date())* 12 + DatePart('m', Date()) - 1 AND VENTAS.COBRADA = true AND VENTAS.IDCLIENTE = $id_cliente";
        break;

        case 7:
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, VENTAS.IDTIPO, VENTAS.COBRO, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DateValue(Format(VENTAS.FECHA,'dd/mm/yyyy')) BETWEEN #$fecha1# AND #$fecha2# AND VENTAS.COBRADA = true AND VENTAS.IDCLIENTE = $id_cliente";

        break;
    
}
        

        $stmt = odbc_exec( $con, $sql );



			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = 'ventas-cliente.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");


echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>ID VENTA</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TIPO VENTA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>SUCURSAL</td>
					</tr>");

/*$respuesta = odbc_fetch_array($stmt); 

var_dump($respuesta);*/

$total = 0;

while ( $row = odbc_fetch_array($stmt) ) { 

$cobro = number_format($row[COBRO],2);

$total = $total + $row[COBRO];

			//foreach ($respuesta as $row => $item){

			 echo"<tr>
			 			<td style='border:1px solid #eee;'>$row[IDVENTA]</td> 
			 			<td style='border:1px solid #eee;'>$row[FECHA]</td>
			 			<td style='border:1px solid #eee;'>$row[IDTIPO]</td>
			 			<td style='border:1px solid #eee;'>$$cobro</td>
			 			<td style='border:1px solid #eee;'>$row[NOMBRE]</td></tr>";


			}

			$total = number_format($total,2);

			echo '<tr><td colspan="4" style="font-weight:bold; border:1px solid #eee; text-align:right;">TOTAL</td>
			<td style="font-weight:bold; border:1px solid #eee;">$'.$total.'</td></tr>';



?>
  
</table>
