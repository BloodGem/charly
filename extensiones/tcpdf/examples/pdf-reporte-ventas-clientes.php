<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
date_default_timezone_set('America/Mexico_City');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    public $no_rango;

    public $rango_fecha;

    public $tipo;

    public $id_cliente;

    public $nombre_cliente;

    //Page header
    public function Header() {

        $no_rango = $_GET["no_rango"];

        $rango_fecha = $_GET["rango_fecha"];

        $tipo = $_GET["tipo"];

        $id_cliente = $_GET['id_cliente'];

        $nombre_cliente = $_GET['nombre_cliente'];

        $dia1 = substr( $rango_fecha, 3, 3 );

        $mes1 = substr( $rango_fecha, 0, 3 );

        $año1 = substr( $rango_fecha, 6, 4 );   

        $dia2 = substr( $rango_fecha, 16, 3 );
        $mes2 = substr( $rango_fecha, 13, 3);
        $año2 = substr( $rango_fecha, 19, 4 );

        $fecha1 = $dia1.$mes1.$año1;
        $fecha2 = $dia2.$mes2.$año2;

        $rfc = substr($nombre_cliente, 0, 13 );

        $nombre_cliente_extraido = substr( $nombre_cliente, 17);

        


        switch ($no_rango) {
            case 1:
                $texto= "de hoy";
                $texto_rango_fecha_consulta = date('d-m-Y');
            break;
            case 2:
                $texto= "de ayer";
                $texto_rango_fecha_consulta = date('d-m-Y',strtotime("- 1 day"));
            break;
            case 3:
            if(date("D")=="Mon"){
                $lunes = date("d-m-Y");
            }else{
                $lunes = date("d-m-Y", strtotime('last Monday', time()));
            }


            $texto= " de esta semana";
            $texto_rango_fecha_consulta = "del ".$lunes." al ".date('d-m-Y', strtotime('this Sunday', time()));
            break;
            case 4:
            if(date("D")=="Mon"){
                $lunes = date("d-m-Y", strtotime('last Monday', time()));
            }else{
                $lunes = date("d-m-Y", strtotime('last Monday - 7 days', time()));
            }
            
            $texto= " de semana anterior";
            $texto_rango_fecha_consulta = "del ".$lunes." al ".date('Y-m-d', strtotime('last Sunday', time()));
            break;
            case 5:
                $texto= "de los últimos 7 días";
                $texto_rango_fecha_consulta = "del ".date('d-m-Y',strtotime("- 6 day"))." al ".date('d-m-Y');
            break;
            case 6:
                $texto= "de los últimos 30 días";
                $texto_rango_fecha_consulta = "del ".date('d-m-Y',strtotime("- 29 day"))." al ".date('d-m-Y');
            break;
            case 7:
                $texto= "de este mes";
                $texto_rango_fecha_consulta = "del ".date('01-m-Y')." al ".date('d-m-Y');
            break;
            case 8:
                $texto= "del mes anterior";
                $texto_rango_fecha_consulta = "del ".date("d-m-Y", strtotime("first day of previous month"))." al ".date("d-m-Y", strtotime("last day of previous month"));
            break;
            case 9:
                $texto= "";
                $texto_rango_fecha_consulta = "del ".$fecha1." al ".$fecha2;
            break;
    
}
                if($id_cliente !== "0"){
                    $ventas = "Ventas ";
                    $nombre_cliente = "del cliente ".$rfc." ".$nombre_cliente_extraido;
                }else{
                    $ventas = "Ventas generales ";
                    $nombre_cliente = "";
                }


                /*if($tipo == "FN"){
                    $tipo_venta = "de tipo facturación ";
                }elseif($tipo == "NA"){
                    $tipo_venta = "de tipo nota ";
                }else{
                    $tipo_venta = "de tipo general ";
                }*/

                $titulo = $ventas.$texto;

        // Logo
        /*$path = dirname( __FILE__ );
        $logo = $path.'/images/logo.jpeg';
        $this->Image($logo, 5, 4, 20, 20, '', '', '', false, 30, '', false, false, 0);*/
        
        // Set font
        $this->SetFont('helvetica', 'B', 15);
        
        // Title

        if($id_cliente !== "0"){
                    $this->SetY(5);

        $this->Cell(0, 15, $titulo, 0, false, 'C', 0, '', 0, false, 'M', 'M');

        $this->SetY(12);
        
        $this->Cell(0, 15, $nombre_cliente , 0, false, 'C', 0, '', 0, false, 'M', 'M');

        $this->SetY(19);

        $this->Cell(0, 15, $texto_rango_fecha_consulta , 0, false, 'C', 0, '', 0, false, 'M', 'M');
        
                }else{
        $this->SetY(10);

        $this->Cell(0, 15, $titulo, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetY(17);

        $this->Cell(0, 15, $texto_rango_fecha_consulta , 0, false, 'C', 0, '', 0, false, 'M', 'M');
        
                }
        $this->SetY(25);
        $this->html = '<p style="border-top:1px solid #999; text-align:center;">
                            </p>';
            $this->writeHTML($this->html, true, false, true, false, '');
    }

    // Page footer
    public function Footer() {

        $this->SetY(-15);

        $this->html = '<p style="border-top:1px solid #999; text-align:center;">
                            </p>';
            $this->writeHTML($this->html, true, false, true, false, '');
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font

        $this->Cell(50, 10, 'Consultado el: '.date('d-m-Y').' a las: '.date('h:i:s',time() - 3610), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        // Page number
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');

        
    }



    public function exportarPDFVentasClientes(){

        require_once "conexion.php";

//TRAEMOS LA INFORMACIÓN DE LA VENTA


$no_rango = $this->no_rango;

$rango_fecha = $this->rango_fecha;

$tipo = $this->tipo;

$id_cliente = $this->id_cliente;

$nombre_cliente = $this->nombre_cliente;



$fecha1 = substr( $rango_fecha, 0, 10 );
$fecha2 = substr( $rango_fecha, 13, 22 );

$rfc = substr( $nombre_cliente, 0, 13 );

        $nombre_cliente_extraido = substr( $nombre_cliente, 17);



    


                /*if($tipo == "FN"){
                    $sql_tipo = " AND VENTAS.IDTIPO = 'FN'";
                }elseif($tipo == "NA"){
                    $sql_tipo = " AND VENTAS.IDTIPO = 'NA'";
                }*/

    
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
        

        $stmt = odbc_exec( $con, $sql );



// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------

// set font

// add a page
$pdf->AddPage();

/*if($id_cliente == "0"){
                    $td_encabezado = '<td style="border: 1px solid black; width:170x; text-align:center" font-weight:bold;>Cliente</td>';
                }*/

$bloque1 = <<<EOF


    <table style=style="border: 1px solid black; font-size:12px;">
<tr>
<td style="border: 1px solid black; width:60px; text-align:center; font-weight:bold;">ID venta</td>
<td style="border: 1px solid black; width:125px; text-align:center; font-weight:bold;">Fecha</td>
<td style="border: 1px solid black; width:65px; text-align:center; font-weight:bold;">Tipo venta</td>
<td style="border: 1px solid black; width:170x; text-align:center; font-weight:bold;">Sucursal</td>
<td style="border: 1px solid black; width:90px; text-align:right; font-weight:bold;">Total</td>

</tr>
</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------
$total_acumulado = 0;
 while ($respuesta = odbc_fetch_array($stmt)) { 

    /*if($id_cliente == "0"){
                    $td_cuerpo = '<td style="border: 1px solid black; width:170px; text-align:center">'.$respuesta[NOMBRE] .'</td>';
                }*/

$total = number_format($respuesta['TOTAL'], 2);
$total_acumulado = $total_acumulado + $respuesta['TOTAL'];
$bloque2 = <<<EOF



    <table style="border: 1px solid black; font-size:11px;">


    
        <tr>
        
            <td style="border: 1px solid black; width:60px; text-align:center;">$respuesta[IDVENTA]</td>

            <td style="border: 1px solid black; width:125px; text-align:center;">$respuesta[FECHA]</td>

            <td style="border: 1px solid black; width:65px; text-align:center;">$respuesta[IDTIPO]</td>

            <td style="border: 1px solid black; width:170px; text-align:center;">$respuesta[NOMBRE]</td>

            <td style="border: 1px solid black; width:90px; text-align:right;">$$total</td>
            

        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}

// ---------------------------------------------------------


$total_formateado = number_format($total_acumulado,2);

/*if($id_cliente !== "0"){
                    $td_texto_total = '<td style="border: 1px solid black; width:250px; text-align:right; font-weight:bold;">TOTAL:</td>';
                }else{
                    $td_texto_total = '<td style="border: 1px solid black; width:420px; text-align:right; font-weight:bold;">TOTAL:</td>';
                }*/


$bloque3 = <<<EOF



    <br><br><table style="font-size:12px;">


    
        <tr>

            <td style="border: 1px solid black; width:420px; text-align:right; font-weight:bold;">TOTAL:</td>

            <td style="border: 1px solid black; width:90px; text-align:right; font-weight:bold;">
            
                $ $total_formateado

            </td>
        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('ventas del cliente '.$rfc." ".$nombre_cliente_extraido." ".date('d-m-Y').'.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+



}
}






$ventas_sucursales = new MYPDF();
$ventas_sucursales -> no_rango = $_GET["no_rango"];
$ventas_sucursales -> id_cliente = $_GET["id_cliente"];
//$ventas_sucursales -> tipo = $_GET["tipo"];
$ventas_sucursales -> nombre_cliente = $_GET["nombre_cliente"];
if(isset($_GET['rango_fecha'])){
    $ventas_sucursales -> rango_fecha = $_GET['rango_fecha'];
}
$ventas_sucursales -> exportarPDFVentasClientes();




