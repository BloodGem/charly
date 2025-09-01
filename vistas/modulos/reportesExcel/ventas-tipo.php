<?php

error_reporting(0);

require_once "conexion.php";


    $tipo = $_GET['tipo'];
    $no_rango = $_GET['no_rango'];
    $id_sucursal = $_GET['id_sucursal'];


    if($tipo == "" || $no_rango == "" || $id_sucursal == ""){
        return;
    
    }


    if(isset($_GET['rango_fecha'])){
        $rango_fecha = $_GET['rango_fecha'];
        $fecha1 = substr( $rango_fecha, 0, 10 );
        $fecha2 = substr( $rango_fecha, 13, 22 );
    }

    if($id_sucursal !== "0"){
                    $sql_id_sucursal = " AND SUCURSAL.IDSUCURSAL = ".$id_sucursal;
                }


                if($tipo == "FN"){
                    $sql_tipo = " AND VENTAS.IDTIPO = 'FN'";
                }elseif($tipo == "NA"){
                    $sql_tipo = " AND VENTAS.IDTIPO = 'NA'";
                }

    switch ($no_rango) {
    case 1:

                $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Format( VENTAS.FECHA,'Short Date') = Date()".$sql_id_sucursal.$sql_tipo." AND VENTAS.COBRADA = true";
                

        break;
    case 2:
                $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Format( VENTAS.FECHA,'Short Date') = Date()-1".$sql_id_sucursal.$sql_tipo." AND VENTAS.COBRADA = true";
        break;
    case 3:

    $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DATEDIFF('d',VENTAS.FECHA,now())<=6".$sql_id_sucursal.$sql_tipo." AND VENTAS.COBRADA = true";


        break;
        case 4:

    $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DATEDIFF('d',VENTAS.FECHA,now())<=29".$sql_id_sucursal.$sql_tipo." AND VENTAS.COBRADA = true";
          
        break;
    case 5:
    

    $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Year(VENTAS.FECHA) = Year(Now()) AND Month(VENTAS.FECHA) = Month(Now())".$sql_id_sucursal.$sql_tipo." AND VENTAS.COBRADA = true";
            
        break;
    case 6:

    $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Year(VENTAS.FECHA)* 12 + DatePart('m', VENTAS.FECHA) = Year(Date())* 12 + DatePart('m', Date()) - 1".$sql_id_sucursal.$sql_tipo." AND VENTAS.COBRADA = true";
             
        break;

        case 7:
        

    $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DateValue(Format(VENTAS.FECHA,'dd/mm/yyyy')) BETWEEN #$fecha1# AND #$fecha2#".$sql_id_sucursal.$sql_tipo." AND VENTAS.COBRADA = true";
           

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
					<td style='font-weight:bold; border:1px solid #eee;'>TIPO VENTA</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>SUCURSAL</td>
					</tr>");

/*$respuesta = odbc_fetch_array($stmt); 

var_dump($respuesta);*/

$total = 0;


 while ($respuesta = odbc_fetch_array($stmt)) { 

    $cobro = number_format($respuesta[COBRO],2);

    $total = $total + $respuesta[COBRO];


			//foreach ($respuesta as $row => $item){

			 echo"<tr>
			 			<td style='border:1px solid #eee;'>$respuesta[IDVENTA]</td> 
			 			<td style='border:1px solid #eee;'>$respuesta[FECHA]</td>
			 			<td style='border:1px solid #eee;'>$respuesta[IDTIPO]</td>
                        <td style='border:1px solid #eee;'>$cobro</td>
			 			<td style='border:1px solid #eee;'>$respuesta[NOMBRE]</td></tr>";




			}

$total = number_format($total,2);

            echo '<tr><td colspan="4" style="font-weight:bold; border:1px solid #eee; text-align:right;">TOTAL</td>
            <td style="font-weight:bold; border:1px solid #eee;">$'.$total.'</td></tr>';


?>
  
</table>
