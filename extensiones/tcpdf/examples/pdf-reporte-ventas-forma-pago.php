<?php

//error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
date_default_timezone_set('America/Mexico_City');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    public $no_rango;

    public $rango_fecha;

    public $forma_pago;

    public $nombre_forma_pago;

    public $id_sucursal;

    public $nombre_sucursal;

    //Page header
    public function Header() {

        $no_rango = $_GET["no_rango"];

        $rango_fecha = $_GET["rango_fecha"];

        $forma_pago = $_GET["forma_pago"];

        $nombre_forma_pago =  $_GET['nombre_forma_pago'];

        $id_sucursal = $_GET['id_sucursal'];

        $nombre_sucursal = $_GET['nombre_sucursal'];

        $dia1 = substr( $rango_fecha, 3, 3 );

        $mes1 = substr( $rango_fecha, 0, 3 );

        $año1 = substr( $rango_fecha, 6, 4 );   

        $dia2 = substr( $rango_fecha, 16, 3 );
        $mes2 = substr( $rango_fecha, 13, 3);
        $año2 = substr( $rango_fecha, 19, 4 );

        $fecha1 = $dia1.$mes1.$año1;
        $fecha2 = $dia2.$mes2.$año2;


        


        switch ($no_rango) {
            case 1:
                $texto= " de hoy ";
                $texto_rango_fecha_consulta = date('d-m-Y');
            break;
            case 2:
                $texto= " de ayer ";
                $texto_rango_fecha_consulta = date('d-m-Y',strtotime("- 1 day"));
            break;
            case 3:
            if(date("D")=="Mon"){
                $lunes = date("d-m-Y");
            }else{
                $lunes = date("d-m-Y", strtotime('last Monday', time()));
            }


            $texto= " de esta semana ";
            $texto_rango_fecha_consulta = "del ".$lunes." al ".date('d-m-Y', strtotime('this Sunday', time()));
            break;
            case 4:
            if(date("D")=="Mon"){
                $lunes = date("d-m-Y", strtotime('last Monday', time()));
            }else{
                $lunes = date("d-m-Y", strtotime('last Monday - 7 days', time()));
            }
            
            $texto= " de semana anterior ";
            $texto_rango_fecha_consulta = "del ".$lunes." al ".date('Y-m-d', strtotime('last Sunday', time()));
            break;
            case 5:
                $texto= " de los últimos 7 días ";
                $texto_rango_fecha_consulta = "del ".date('d-m-Y',strtotime("- 6 day"))." al ".date('d-m-Y');
            break;
            case 6:
                $texto= " de los últimos 30 días ";
                $texto_rango_fecha_consulta = "del ".date('d-m-Y',strtotime("- 29 day"))." al ".date('d-m-Y');
            break;
            case 7:
                $texto= " de este mes ";
                $texto_rango_fecha_consulta = "del ".date('01-m-Y')." al ".date('d-m-Y');
            break;
            case 8:
                $texto= " del mes anterior ";
                $texto_rango_fecha_consulta = "del ".date("d-m-Y", strtotime("first day of previous month"))." al ".date("d-m-Y", strtotime("last day of previous month"));
            break;
            case 9:
                $texto= "";
                $texto_rango_fecha_consulta = "del ".$fecha1." al ".$fecha2;
            break;
    
}
                /*if($id_sucursal !== "0"){
                    $ventas = "Ventas por forma de pago ";
                    $nombre_sucursal = "de la sucursal ".$nombre_sucursal;
                }else{*/
                    $ventas = "Ventas por forma de pago ";
                    $nombre_sucursal = "";
                //}


                
                $titulo = $ventas.$nombre_forma_pago.$texto;

        // Logo
        /*$path = dirname( __FILE__ );
        $img_file = $path.'/images/fondo_pdf.jpg';
        $this->Image($img_file, 10, 100, 190, 85, '', '', '', false, 300, '', false, false, 0);
        $logo = $path.'/images/logo.jpg';
        $this->Image($logo, 8, 2, 65, 25, '', '', '', false, 30, '', false, false, 0);*/

        // Set font
        $this->SetFont('helvetica', 'B', 15);
        
        // Title

        /*if($id_sucursal !== "0"){
                    $this->SetY(5);

        $this->Cell(0, 15, $titulo, 0, false, 'C', 0, '', 0, false, 'M', 'M');

        $this->SetY(12);
        
        $this->Cell(0, 15, $nombre_sucursal , 0, false, 'C', 0, '', 0, false, 'M', 'M');

        $this->SetY(19);

        $this->Cell(0, 15, $texto_rango_fecha_consulta , 0, false, 'C', 0, '', 0, false, 'M', 'M');
        
                }else{*/
        $this->SetY(10);
        $this->SetX(50);
        $this->Cell(0, 15, $titulo, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetY(17);
        $this->SetX(50);
        $this->Cell(0, 15, $texto_rango_fecha_consulta , 0, false, 'C', 0, '', 0, false, 'M', 'M');
        
                //}
        $this->SetY(30);
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



    public function exportarPDFReporteVentasFormaPago(){

        require_once "../../../modelos/conexion2.php";
        require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

//TRAEMOS LA INFORMACIÓN DE LA VENTA


$no_rango = $this->no_rango;

$rango_fecha = $this->rango_fecha;

$forma_pago = $this->forma_pago;

$nombre_forma_pago = $this->nombre_forma_pago;

$id_sucursal = $this->id_sucursal;

$nombre_sucursal = $this->nombre_sucursal;



$fecha1 = substr( $rango_fecha, 0, 10 );
$fecha2 = substr( $rango_fecha, 13, 22 );



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
$pdf->SetMargins(5, 35, 5);
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

/*if($id_sucursal == "0"){
                    $td_encabezado = '<td style="border: 1px solid black; width:110x; text-align:center; font-weight:bold;">Sucursal</td>';
                }else{
                    $td_encabezado = '';
                }*/

$bloque1 = <<<EOF


    <table style="border: 1px solid black; font-size:11px;">
<tr>
<td style="border: 1px solid black; width:35px; text-align:center; font-weight:bold;">IdVenta</td>
<td style="border: 1px solid black; width:35px; text-align:center; font-weight:bold;">Folio</td>
<td style="border: 1px solid black; width:95px; text-align:center; font-weight:bold;">Fecha</td>
<td style="border: 1px solid black; width:35px; text-align:center; font-weight:bold;">Tipo V</td>
<td style="border: 1px solid black; width:60px; text-align:right; font-weight:bold;">Total</td>
<td style="border: 1px solid black; width:55px; text-align:right; font-weight:bold;">Dinero</td>
<td style="border: 1px solid black; width:60px; text-align:right; font-weight:bold;">Efectivo</td>
<td style="border: 1px solid black; width:55px; text-align:right; font-weight:bold;">Tarjeta Débito</td>
<td style="border: 1px solid black; width:60px; text-align:right; font-weight:bold;">Tarjeta Crédito</td>
<td style="border: 1px solid black; width:60px; text-align:right; font-weight:bold;">Transferencia</td>
<td style="border: 1px solid black; width:120px; text-align:center; font-weight:bold;">Cliente</td>


</tr>
</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

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
             
        
        $total_venta = number_format($row['total'], 2);

       $dinero = number_format($row['dinero'], 2);

       $efectivo = number_format($row['efectivo'], 2);

       $tarjeta_debito = number_format($row['tarjeta_debito'], 2);

       $tarjeta_credito = number_format($row['tarjeta_credito'], 2);

       $transferencia = number_format($row['transferencia'], 2);

        $traerCliente = ControladorClientes::ctrMostrarCliente($row['id_cliente']);

$bloque2 = <<<EOF



    <table style="border: 1px solid black; font-size:9px;">


    
        <tr>
        
            <td style="border: 1px solid black; width:35px; text-align:center;">$row[id]</td>

            <td style="border: 1px solid black; width:35px; text-align:center;">$row[folio]</td>

            <td style="border: 1px solid black; width:95px; text-align:center;">$row[fecha_creacion]</td>

            <td style="border: 1px solid black; width:35px; text-align:center;">$row[tipo_venta]</td>

            <td style="border: 1px solid black; width:60px; text-align:right;">$$total_venta</td>

            <td style="border: 1px solid black; width:55px; text-align:right;">$$dinero</td>

            <td style="border: 1px solid black; width:60px; text-align:right;">$$efectivo</td>

            <td style="border: 1px solid black; width:55px; text-align:right;">$$tarjeta_debito</td>

            <td style="border: 1px solid black; width:60px; text-align:right;">$$tarjeta_credito</td>

            <td style="border: 1px solid black; width:60px; text-align:right;">$$transferencia</td>
            
            <td style="border: 1px solid black; width:120px; text-align:center;">
            
                $traerCliente[nombre] 

            </td>


            
            

        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}

// ---------------------------------------------------------
$total = number_format(($total_efectivo + $total_tarjeta_credito + $total_tarjeta_debito + $total_transferencia), 2);

$total_efectivo = number_format($total_efectivo, 2);
$total_tarjeta_credito = number_format($total_tarjeta_credito, 2);
$total_tarjeta_debito = number_format($total_tarjeta_debito, 2);
$total_transferencia = number_format($total_transferencia, 2);

$total_acumulado = number_format($total_acumulado, 2);


$bloque3 = <<<EOF

<br><br>
<table style="border: none; font-size:18px;  width:650px;">


                <tr><th style="border: none; text-align:center; font-weight:bold;">Ventas Total: $$total_acumulado</th></tr>

                </table>

    <br><br>

<table style="border: 1px solid black; font-size:13px;  width:400px;">

        <tr>
                        <th style="border: 1px solid black; text-align:center; font-weight:bold;">Forma Pago</th>
                        <th style="border: 1px solid black; text-align:right; font-weight:bold;">Total Formas Pago</th>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; text-align:center;">Efectivo</td>
                        <td style="border: 1px solid black; text-align:right;">$$total_efectivo</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; text-align:center;">Tarjeta Crédito</td>
                        <td style="border: 1px solid black; text-align:right;">$$total_tarjeta_credito</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; text-align:center;">Tarjeta Débito</td>
                        <td style="border: 1px solid black; text-align:right;">$$total_tarjeta_debito</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; text-align:center;">Transferencia</td>
                        <td style="border: 1px solid black; text-align:right;">$$total_transferencia</td>
                    </tr>
                    
                    <tr>
                        <td style="border: 1px solid black; text-align:center; font-weight:bold;">Total Formas Pago Acumulado</td>
                        <td style="border: 1px solid black; text-align:right; font-weight:bold;">$$total</td>
                    </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

//Close and output PDF document
//if($id_sucursal == "0"){
    $pdf->Output('ventas por forma de pago '.$nombre_forma_pago.' '.date('d-m-Y').'.pdf', 'D');
    
/*}else{
    $pdf->Output('ventas por metodo de pago '.$nombre_forma_pago.' de la '.$nombre_sucursal.' '.date('d-m-Y').'.pdf', 'D');
}*/


//============================================================+
// END OF FILE
//============================================================+



}
}






$reporte_ventas_forma_pago = new MYPDF();
$reporte_ventas_forma_pago -> no_rango = $_GET["no_rango"];
$reporte_ventas_forma_pago -> id_sucursal = $_GET["id_sucursal"];
$reporte_ventas_forma_pago -> forma_pago = $_GET["forma_pago"];
$reporte_ventas_forma_pago -> nombre_forma_pago = $_GET["nombre_forma_pago"];
$reporte_ventas_forma_pago -> nombre_sucursal = $_GET["nombre_sucursal"];
if(isset($_GET['rango_fecha'])){
    $reporte_ventas_forma_pago -> rango_fecha = $_GET['rango_fecha'];
}
$reporte_ventas_forma_pago -> exportarPDFReporteVentasFormaPago();




