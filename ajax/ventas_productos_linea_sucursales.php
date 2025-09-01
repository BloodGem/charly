<?php

error_reporting(0);


class ventasProductosLineaSucursalesPDF{

public $linea;

public $clave_producto;

public $no_rango;

public $rango_fecha;

public $id_sucursal;

public function exportarPDFVentasProductosLineaSucursales(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$linea = $this->linea;

$clave_producto = $this->clave_producto;

$no_rango = $this->no_rango;

$rango_fecha = $this->rango_fecha;

$id_sucursal = $this->id_sucursal;

$fecha1 = substr( $rango_fecha, 0, 10 );
$fecha2 = substr( $rango_fecha, 13, 22 );

require_once "conexion.php";

switch ($no_rango) {
    case 1:


            if($id_sucursal == 0){
                $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU, ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Format( VENTAS.FECHA,'Short Date') = Date() AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True));";
                    
            }else{
                $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU, ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Format( VENTAS.FECHA,'Short Date') = Date() AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True) AND ((VENTAS.IDSUCURSAL)=".$id_sucursal."));";


                }
        break;
    case 2:
    if($id_sucursal == 0){
                $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU, ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Format( VENTAS.FECHA,'Short Date') = Date()-1 AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True));";
                    
            }else{
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU, ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Format( VENTAS.FECHA,'Short Date') = Date()-1 AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True) AND ((VENTAS.IDSUCURSAL)=".$id_sucursal."));";
    }
        break;
    case 3:
    if($id_sucursal == 0){

    $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU, ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DATEDIFF('d',VENTAS.FECHA,now())<=6 AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True));";
                    
            }else{
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU, ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DATEDIFF('d',VENTAS.FECHA,now())<=6 AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True) AND ((VENTAS.IDSUCURSAL)=".$id_sucursal."));";

    }

        break;
        case 4:
        if($id_sucursal == 0){

    $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU, ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DATEDIFF('d',VENTAS.FECHA,now())<=29 AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True));";
                    
            }else{
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU, ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DATEDIFF('d',VENTAS.FECHA,now())<=29 AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True) AND ((VENTAS.IDSUCURSAL)=".$id_sucursal."));";

    }
        break;
    case 5:
    if($id_sucursal == 0){

    $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU, ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Year(VENTAS.FECHA) = Year(Now()) AND Month(VENTAS.FECHA) = Month(Now()) AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True));";
                    
            }else{
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU, ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Year(VENTAS.FECHA) = Year(Now()) AND Month(VENTAS.FECHA) = Month(Now()) AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True) AND ((VENTAS.IDSUCURSAL)=".$id_sucursal."));";

    }
        break;
    case 6:
    if($id_sucursal == 0){

    $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU, ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Year(VENTAS.FECHA)* 12 + DatePart('m', VENTAS.FECHA) = Year(Date())* 12 + DatePart('m', Date()) - 1 AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True));";
                    
            }else{
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU, ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Year(VENTAS.FECHA)* 12 + DatePart('m', VENTAS.FECHA) = Year(Date())* 12 + DatePart('m', Date()) - 1 AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True) AND ((VENTAS.IDSUCURSAL)=".$id_sucursal."));";

    }
        break;

        case 7:
        if($id_sucursal == 0){

    $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU, ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DateValue(Format(VENTAS.FECHA,'dd/mm/yyyy')) BETWEEN #$fecha1# AND #$fecha2# AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True));";
                    
            }else{
        $sql = "SELECT VENTAS.IDVENTA, VENTAS.FECHA, SUCURSAL.NOMBRE, PARTVTA.CLAVE_ART, ARTICULO.DESCRIP, PARTVTA.CANTIDAD, PARTVTA.PU, ARTICULO.LINEA FROM (ARTICULO INNER JOIN (VENTAS INNER JOIN PARTVTA ON VENTAS.IDVENTA = PARTVTA.IDVENTA) ON ARTICULO.CLAVE_ART = PARTVTA.CLAVE_ART) INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DateValue(Format(VENTAS.FECHA,'dd/mm/yyyy')) BETWEEN #$fecha1# AND #$fecha2# AND (((PARTVTA.CLAVE_ART)='".$clave_producto."') AND ((ARTICULO.LINEA)='".$linea."') AND ((VENTAS.COBRADA)=True) AND ((VENTAS.IDSUCURSAL)=".$id_sucursal."));";

}

        break;
    
}
        

        $stmt = odbc_exec( $con, $sql );





//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

    <table>
        
        <tr>
            
            <td style="width:75px"><img src="images/logo.jpeg"></td>

    



            <td style="background-color:white; width:500px; text-align:center; color:black"><br><br><br>VENTAS PRODUCTOS POR LINEA</td>

        </tr>

    </table>


    <table style="font-size:10px;">
<tr>
<td style="width:50px; text-align:center" font-weight:bold;>ID venta</td>
<td style="width:100px; text-align:center" font-weight:bold;>Fecha</td>
<td style="width:55px; text-align:center" font-weight:bold;>Cantidad</td>
<td style="width:55px; text-align:center" font-weight:bold;>Precio U</td>
<td style="width:100px; text-align:center" font-weight:bold;>Total</td>
<td style="width:200px; text-align:center" font-weight:bold;>Sucursal</td>
</tr>
</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------
$total_absoluto = 0;

$cantidad_total = 0;
 while ($respuesta = odbc_fetch_array($stmt)) { 

    $total = $respuesta['CANTIDAD'] * $respuesta['PU'];
        
    $cantidad_total = $cantidad_total + $respuesta['CANTIDAD'];
    $total_absoluto = $total_absoluto + $total;

        $pu = number_format($respuesta['PU'], 2);
        $total = number_format($total, 2);
$bloque2 = <<<EOF



    <table style="font-size:9px;">


    
        <tr>
        
            <td style="width:50px; text-align:center">

                $respuesta[IDVENTA]

            </td>

            <td style="width:100px; text-align:center">
            
                $respuesta[FECHA] 

            </td>
            <td style="width:55px; text-align:center">
            
                $respuesta[CANTIDAD] 

            </td>
            <td style="width:55px; text-align:center">
            
                $pu

            </td>
            <td style="width:100px; text-align:center">
            
                $$total 

            </td>
            <td style="width:200px; text-align:center">
            
                $respuesta[NOMBRE]  

            </td>

        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}

// ---------------------------------------------------------


$total_formateado = number_format($total_absoluto,2);




$bloque3 = <<<EOF

    <br>

    <table style="font-size:10px;">


    
        <tr>

        <td style="width:360px; text-align:right;">

            </td>

            <td style="width:200px; text-align:center; font-weight:bold;">
            
                TOTAL = $$total_formateado

            </td>
        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('ventas_productos_linea_sucursales.pdf', 'D');

}

}

$ventas_productos_linea_sucursales = new ventasProductosLineaSucursalesPDF();
$ventas_productos_linea_sucursales -> linea = $_GET["linea"];
$ventas_productos_linea_sucursales -> clave_producto = $_GET["clave_producto"];
$ventas_productos_linea_sucursales -> no_rango = $_GET["no_rango"];
$ventas_productos_linea_sucursales -> id_sucursal = $_GET["id_sucursal"];
if(isset($_GET['rango_fecha'])){
    $ventas_productos_linea_sucursales -> rango_fecha = $_GET['rango_fecha'];
    
}
$ventas_productos_linea_sucursales -> exportarPDFVentasProductosLineaSucursales();




?>