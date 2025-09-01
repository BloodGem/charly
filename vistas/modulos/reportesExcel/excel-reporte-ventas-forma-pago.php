<?php

//error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

	$forma_pago = $_GET['forma_pago'];
    $nombre_forma_pago = $_GET['nombre_forma_pago'];
    $no_rango = $_GET['no_rango'];
    $id_sucursal = $_GET['id_sucursal'];
    $nombre_sucursal = $_GET['nombre_sucursal'];


    if($forma_pago == "" || $no_rango == "" || $id_sucursal == ""){
        return;
    
    }


    if(isset($_GET['rango_fecha'])){
        $rango_fecha = $_GET['rango_fecha'];
        $fecha1 = substr( $rango_fecha, 0, 10 );
        $fecha2 = substr( $rango_fecha, 13, 22 );
    }

    



    switch ($no_rango) {

    case 1:

    $dia = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59' ;
    

    break;

    case 2:

    $dia = date("Y-m-d", strtotime("yesterday"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59' ;

    break;
    case 3:

    if(date("D")=="Mon"){
        $lunes = date("Y-m-d");
    }else{
        $lunes = date("Y-m-d", strtotime('last Monday', time()));
    }


    $dia1 = $lunes;
    $dia2 = date('Y-m-d', strtotime('this Sunday', time()));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    break;

    case 4:

    if(date("D")=="Mon"){
        $lunes = date("Y-m-d", strtotime('last Monday', time()));
    }else{
        $lunes = date("Y-m-d", strtotime('last Monday - 7 days', time()));
    }


    $dia1 = $lunes;
    $dia2 = date('Y-m-d', strtotime('last Sunday', time()));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    break;

    case 5:
    $dia1 = date("Y-m-d", strtotime("today - 6 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;


    case 6:
    $dia1 = date("Y-m-d", strtotime("today - 29 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

 
    break;

    case 7:

    $dia1 = date("Y-m-d", strtotime("first day of this month"));
    $dia2 = date("Y-m-d", strtotime("last day of this month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    break;

    case 8:

    $dia1 = date("Y-m-d", strtotime("first day of last month"));
    $dia2 = date("Y-m-d", strtotime("last day of last month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    break;

    case 9:

    $fecha1 = $fecha1 . ' 00:00:00';
    $fecha2 = $fecha2 . ' 23:59:59' ;


    break;
    
}





if($id_sucursal !== "0"){
                    $sql_id_sucursal = " AND ventas.id_sucursal = $id_sucursal";
                }else{
                  $sql_id_sucursal = "";  
                }





if($forma_pago !== "0"){
    switch ($forma_pago) {

        case 1:
            $sql_forma_pago = " AND efectivo != 0";
        break;
        case 2:
            $sql_forma_pago = " AND tarjeta_debito != 0";
        break;
        case 3:
            $sql_forma_pago = " AND tarjeta_credito != 0";
        break;
        case 4:
            $sql_forma_pago = " AND transferencia != 0";
        break;
    }
        
    }else{
        $sql_forma_pago = "";
    }




$sql = "SELECT * FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.pagada = 1 AND ventas.cancelada = 0 $sql_id_sucursal $sql_forma_pago ORDER BY ventas.id DESC";



$rs = $conexion->query($sql);     
			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/
            //if($id_sucursal == "0"){
                $Name = 'ventas por metodo de pago '.$nombre_forma_pago.' '.date('d-m-Y').'.xls';
    
            /*}else{
                $Name = 'ventas por metodo de pago '.$nombre_forma_pago.' de la '.$nombre_sucursal.' '.date('d-m-Y').'.xls';
            }*/

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");


echo utf8_decode('<table border="0"> 


					<tr> 
					<td style="font-weight:bold; border:1px solid #000000;">Id Venta</td> 
                    <td style="font-weight:bold; border:1px solid #000000;">Folio</td> 
					<td style="font-weight:bold; border:1px solid #000000;">Fecha</td>
					<td style="font-weight:bold; border:1px solid #000000;">Tipo Venta</td>
					<td style="font-weight:bold; border:1px solid #000000;">Total</td>
					<td style="font-weight:bold; border:1px solid #000000;">Dinero</td>
					<td style="font-weight:bold; border:1px solid #000000;">Efectivo</td>
					<td style="font-weight:bold; border:1px solid #000000;">Tarjeta Débito</td>
					<td style="font-weight:bold; border:1px solid #000000;">Tarjeta Crédito</td>
					<td style="font-weight:bold; border:1px solid #000000;">Transferencia</td>
					<td style="font-weight:bold; border:1px solid #000000;">Cliente</td>
					</tr>');

$total_efectivo = 0;
    $total_tarjeta_credito = 0;
    $total_tarjeta_debito = 0;
    $total_transferencia = 0;

$total_acumulado = 0;
        
    while($row = $rs->fetch_array(MYSQLI_BOTH)){

        $total_acumulado = $total_acumulado + $row['total'];

        $total_efectivo = $total_efectivo + $row['efectivo'];
            
        $total_tarjeta_credito = $total_tarjeta_credito + $row['tarjeta_credito'];
       
        $total_tarjeta_debito = $total_tarjeta_debito + $row['tarjeta_debito'];

        $total_transferencia = $total_transferencia + $row['transferencia'];
             
       

        $traerCliente = ControladorClientes::ctrMostrarCliente($row['id_cliente']);

			 echo'<tr>
			 			<td style="border:1px solid #9B9B9B;">'.$row['id'].'</td> 
                        <td style="border:1px solid #9B9B9B;">'.$row['folio'].'</td>
			 			<td style="border:1px solid #9B9B9B;">'.$row['fecha_creacion'].'</td>
			 			<td style="border:1px solid #9B9B9B;">'.$row['tipo_venta'].'</td>
			 			<td style="border:1px solid #9B9B9B;">$'.number_format($row['total'], 2).'</td>
                        <td style="border:1px solid #9B9B9B;">$'.number_format($row['dinero'], 2).'</td>
                        <td style="border:1px solid #9B9B9B;">$'.number_format($row['efectivo'], 2).'</td>
                        <td style="border:1px solid #9B9B9B;">$'.number_format($row['tarjeta_debito'], 2).'</td>
                        <td style="border:1px solid #9B9B9B;">$'.number_format($row['tarjeta_credito'], 2).'</td>
                        <td style="border:1px solid #9B9B9B;">$'.number_format($row['transferencia'], 2).'</td>
			 			<td style="border:1px solid #9B9B9B;">'.$traerCliente['nombre'].'</td></tr>';


			}

			$total = number_format(($total_efectivo + $total_tarjeta_credito + $total_tarjeta_debito + $total_transferencia), 2);

$total_efectivo = number_format($total_efectivo, 2);
$total_tarjeta_credito = number_format($total_tarjeta_credito, 2);
$total_tarjeta_debito = number_format($total_tarjeta_debito, 2);
$total_transferencia = number_format($total_transferencia, 2);



			echo '
<br><br>
<table>


                <tr><td colspan = "4"></td>

                <td style="font-weight:bold; border:1px solid #000000;">TOTAL: $'.number_format($total_acumulado, 2).'</td> </tr>

                </table>

            <br><br>
			<table tyle="border: 1px solid black; font-size:13px;  width:400px;">

        <tr>
        <th></th>
                        <th style="font-weight:bold; border:1px solid #000000;">Forma Pago</th>
                        <th style="font-weight:bold; border:1px solid #000000; text-align:right;">Total Forma Pago</th>
                    </tr>
                    <tr>
                    <td></td>
                        <td style="border:1px solid #9B9B9B;">Efectivo</td>
                        <td style="border:1px solid #9B9B9B; text-align:right;">$'.$total_efectivo.'</td>
                    </tr>
                    <tr>
                    <td></td>
                        <td style="border:1px solid #9B9B9B;">Tarjeta credito</td>
                        <td style="border:1px solid #9B9B9B; text-align:right;">$'.$total_tarjeta_credito.'</td>
                    </tr>
                    <tr>
                    <td></td>
                        <td style="border:1px solid #9B9B9B;">Tarjeta debito</td>
                        <td style="border:1px solid #9B9B9B; text-align:right;">$'.$total_tarjeta_debito.'</td>
                    </tr>
                    <tr>
                    <td></td>
                        <td style="border:1px solid #9B9B9B;">Transferencia</td>
                        <td style="border:1px solid #9B9B9B; text-align:right;">$'.$total_transferencia.'</td>
                    </tr>
                    <tr>
                    <td></td>
                        <td style="font-weight:bold; border:1px solid #000000; text-align:left;">Total Formas Pago Acumulado</td>
                        <td style="font-weight:bold; border:1px solid #000000; text-align:right;">$'.$total.'</td>
                    </tr>

        

    </table>
			';




?>
  
</table>
