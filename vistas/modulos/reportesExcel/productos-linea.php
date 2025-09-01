<?php

error_reporting(0);

require_once "conexion.php";

$linea = $_GET["linea"];
$clave_producto = $_GET["clave_producto"];
$no_rango = $_GET["no_rango"];
$id_sucursal = $_GET["id_sucursal"];

if($linea == "" || $clave_producto == "" || $no_rango == "" || $id_sucursal == ""){
        return;
    
    }
if(isset($_GET['rango_fecha'])){
        $rango_fecha = $_GET['rango_fecha'];
        $fecha1 = substr( $rango_fecha, 0, 10 );
        $fecha2 = substr( $rango_fecha, 13, 22 );
    }

    switch ($no_rango) {
    case 1:


            if($id_sucursal == 0){
                $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU,  ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Format( VENTAS.FECHA,'Short Date') = Date() AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True));";
                    
            }else{
                $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU,  ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Format( VENTAS.FECHA,'Short Date') = Date() AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True) AND ((VENTAS.IDSUCURSAL)=".$id_sucursal."));";


                }
        break;
    case 2:
    if($id_sucursal == 0){
                $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU,  ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Format( VENTAS.FECHA,'Short Date') = Date()-1 AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True));";
                    
            }else{
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU,  ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Format( VENTAS.FECHA,'Short Date') = Date()-1 AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True) AND ((VENTAS.IDSUCURSAL)=".$id_sucursal."));";
    }
        break;
    case 3:
    if($id_sucursal == 0){

    $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU, ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DATEDIFF('d',VENTAS.FECHA,now())<=6 AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True));";
                    
            }else{
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU,  ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DATEDIFF('d',VENTAS.FECHA,now())<=6 AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True) AND ((VENTAS.IDSUCURSAL)=".$id_sucursal."));";

    }

        break;
        case 4:
        if($id_sucursal == 0){

    $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU,  ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DATEDIFF('d',VENTAS.FECHA,now())<=29 AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True));";
                    
            }else{
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU,  ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DATEDIFF('d',VENTAS.FECHA,now())<=29 AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True) AND ((VENTAS.IDSUCURSAL)=".$id_sucursal."));";

    }
        break;
    case 5:
    if($id_sucursal == 0){

    $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU,  ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Year(VENTAS.FECHA) = Year(Now()) AND Month(VENTAS.FECHA) = Month(Now()) AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True));";
                    
            }else{
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU,  ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Year(VENTAS.FECHA) = Year(Now()) AND Month(VENTAS.FECHA) = Month(Now()) AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True) AND ((VENTAS.IDSUCURSAL)=".$id_sucursal."));";

    }
        break;
    case 6:
    if($id_sucursal == 0){

    $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU,  ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Year(VENTAS.FECHA)* 12 + DatePart('m', VENTAS.FECHA) = Year(Date())* 12 + DatePart('m', Date()) - 1 AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True));";
                    
            }else{
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU,  ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Year(VENTAS.FECHA)* 12 + DatePart('m', VENTAS.FECHA) = Year(Date())* 12 + DatePart('m', Date()) - 1 AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True) AND ((VENTAS.IDSUCURSAL)=".$id_sucursal."));";

    }
        break;

        case 7:
        if($id_sucursal == 0){

    $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU,  ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DateValue(Format(VENTAS.FECHA,'dd/mm/yyyy')) BETWEEN #$fecha1# AND #$fecha2# AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True));";
                    
            }else{
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU,  ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DateValue(Format(VENTAS.FECHA,'dd/mm/yyyy')) BETWEEN #$fecha1# AND #$fecha2# AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True) AND ((VENTAS.IDSUCURSAL)=".$id_sucursal."));";

}

        break;
    
}
        

        $stmt = odbc_exec( $con, $sql );



			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = 'ventas_productos_linea_sucursales.xls';

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
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRECIO U</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>SUCURSAL</td>
					</tr>");

/*$respuesta = odbc_fetch_array($stmt); 

var_dump($respuesta);*/

$total_absoluto = 0;

$cantidad_total = 0;

 while ($respuesta = odbc_fetch_array($stmt)) { 

    $total = $respuesta['CANTIDAD'] * $respuesta['PU'];
        
    $cantidad_total = $cantidad_total + $respuesta['CANTIDAD'];
    $total_absoluto = $total_absoluto + $total;

        $pu = number_format($respuesta['PU'], 2);
        $total = number_format($total, 2);

			//foreach ($respuesta as $row => $item){

			 echo"<tr>
			 			<td style='border:1px solid #eee;'>$respuesta[IDVENTA]</td> 
			 			<td style='border:1px solid #eee;'>$respuesta[FECHA]</td>
			 			<td style='border:1px solid #eee;'>$respuesta[CANTIDAD]</td>
			 			<td style='border:1px solid #eee;'>$$pu</td>
			 			<td style='border:1px solid #eee;'>$$total</td>
			 			<td style='border:1px solid #eee;'>$respuesta[NOMBRE]</td></tr>";


			}

			$total_formateado = number_format($total_absoluto,2);

			echo '<tr><td colspan="5" style="font-weight:bold; border:1px solid #eee; text-align:right;"></td>
			<td style="font-weight:bold; border:1px solid #eee; text-align:center;">TOTAL $'.$total_formateado.'</td></tr>';



?>
  
</table>
