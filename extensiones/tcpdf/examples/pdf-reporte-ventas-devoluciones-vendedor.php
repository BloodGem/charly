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

    public $id_sucursal;
    //Page header
    public function Header() {

        $no_rango = $_GET["no_rango"];

        $rango_fecha = $_GET["rango_fecha"];

        $id_sucursal = $_GET["id_sucursal"];


        $mes1 = substr( $rango_fecha, 0, 2 );
        $dia1 = substr( $rango_fecha, 3, 2 );
        $ano1 = substr( $rango_fecha, 6, 4 );
        $fecha1 = $dia1 ."-". $mes1 ."-". $ano1;

        $mes2 = substr( $rango_fecha, 13, 2 );
        $dia2 = substr( $rango_fecha, 16, 2 );
        $ano2 = substr( $rango_fecha, 19, 4 );
        $fecha2 = $dia2 ."-". $mes2 ."-". $ano2;


        


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
                                   $titulo = "Ventas/Devoluciones por vendedor";

        // Logo
        /*$path = dirname( __FILE__ );
        $img_file = $path.'/images/fondo_pdf.png';
        $this->Image($img_file, 50, 70, 190, 85, '', '', '', false, 300, '', false, false, 0);
        $logo = $path.'/images/logo.jpg';
        $this->Image($logo, 8, 2, 65, 25, '', '', '', false, 30, '', false, false, 0);*/

        // Set font
        $this->SetFont('helvetica', 'B', 15);
        
        // Title

        
        $this->SetY(7);
        $this->SetX(50);
        $this->Cell(0, 15, $titulo, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetY(14);
        $this->SetX(50);
        $this->Cell(0, 15, $texto, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetY(21);
        $this->SetX(50);
        $this->Cell(0, 15, $texto_rango_fecha_consulta , 0, false, 'C', 0, '', 0, false, 'M', 'M');
        
                
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



    public function exportarPDFReporteVentasDevolucionesVendedor(){


//require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/reportes-ventas.controlador.php";
require_once "../../../controladores/reportes-devoluciones.controlador.php";
require_once "../../../modelos/reportes-generales.modelo.php";


//TRAEMOS LA INFORMACIÓN DE LA VENTA


$no_rango = $this->no_rango;

$rango_fecha = $this->rango_fecha;

$id_sucursal = $this->id_sucursal;



    $mes1 = substr( $rango_fecha, 0, 2 );
    $dia1 = substr( $rango_fecha, 3, 2 );
    $ano1 = substr( $rango_fecha, 6, 4 );
    $fecha1 = $ano1 ."-". $mes1 ."-". $dia1;

    $mes2 = substr( $rango_fecha, 13, 2 );
    $dia2 = substr( $rango_fecha, 16, 2 );
    $ano2 = substr( $rango_fecha, 19, 4 );
    $fecha2 = $ano2 ."-". $mes2 ."-". $dia2;




            

    switch ($no_rango) {

    case 1:

    $dia = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59';

    break;

    case 2:

    $dia = date("Y-m-d", strtotime("yesterday"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59';

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
    $fecha2 = $dia2 . ' 23:59:59';


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
    $fecha2 = $dia2 . ' 23:59:59';


    break;

    case 5:
    $dia1 = date("Y-m-d", strtotime("today - 6 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';

    
    break;

    case 6:
    $dia1 = date("Y-m-d", strtotime("today - 29 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';

    break;

    case 7:

    $dia1 = date("Y-m-d", strtotime("first day of this month"));
    $dia2 = date("Y-m-d", strtotime("last day of this month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';


    

    break;

    case 8:

    $dia1 = date("Y-m-d", strtotime("first day of last month"));
    $dia2 = date("Y-m-d", strtotime("last day of last month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';

    break;

    case 9:

    $fecha1 = $fecha1 . ' 00:00:00';
    $fecha2 = $fecha2 . ' 23:59:59';

    break;
    
}
//echo $sql;


        
$traerVendedores = ControladorReportesVentas::ctrMostrarVendedores($fecha1, $fecha2, $id_sucursal);



// create new PDF document
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


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

$bloque1 = <<<EOF


    <table style=style="border: 1px solid black; font-size:12px;">
<tr>
<td style="border: 1px solid black; width:45px; text-align:center; font-weight:bold;">No.<br>Vendedor</td>
<td style="border: 1px solid black; width:350px; text-align:center; font-weight:bold;">Vendedor</td>
<td style="border: 1px solid black; width:90px; text-align:right; font-weight:bold;">Importe Bruto</td>
<td style="border: 1px solid black; width:90px; text-align:right; font-weight:bold;">Impuesto</td>
<td style="border: 1px solid black; width:90px; text-align:right; font-weight:bold;">Importe</td>
<td style="border: 1px solid black; width:90px; text-align:right; font-weight:bold;">Bruto Devol</td>
<td style="border: 1px solid black; width:90px; text-align:right; font-weight:bold;">Impuesto Devol</td>
<td style="border: 1px solid black; width:90px; text-align:right; font-weight:bold;">Importe Devol</td>
<td style="border: 1px solid black; width:90px; text-align:right; font-weight:bold;">Gran Total</td>


</tr>
</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------


foreach ($traerVendedores as $key => $row) {

    $id_vendedor = $row['id_vendedor'];

    //echo $id_vendedor;


    $traerVentasVendedor = ControladorReportesVentas::ctrReporteVentasVendedor($fecha1, $fecha2, $id_vendedor, $id_sucursal);

    $total_ventas = 0;
    foreach ($traerVentasVendedor as $key2 => $row2) {

        $bruto2 = $row2["total_ventas"]/1.16;
        $impuesto2 = $row2["total_ventas"] - $bruto2;
        $total_ventas = $row2["total_ventas"];

    }

    $traerDevolucionesVendedor = ControladorReportesDevoluciones::ctrReporteDevolucionesVendedor($fecha1, $fecha2, $id_vendedor, $id_sucursal);


    $total_devoluciones = 0;
    foreach ($traerDevolucionesVendedor as $key3 => $row3) {

        $bruto3 = $row3["total_devoluciones"]/1.16;
        $impuesto3 = $row3["total_devoluciones"] - $bruto3;
        $total_devoluciones = $row3["total_devoluciones"];

    }

    $gran_total = number_format(($total_ventas-$total_devoluciones), 2);

    $bruto2 = number_format($bruto2, 2);
    $impuesto2 = number_format($impuesto2, 2);
    $total_ventas = number_format($total_ventas, 2);

    $bruto3 = number_format($bruto3, 2);
    $impuesto3 = number_format($impuesto3, 2);
    $total_devoluciones = number_format($total_devoluciones, 2);


$bloque2 = <<<EOF



    <table style="font-size:11px;">


    
        <tr>
        
            <td style="border: 1px solid black; width:45px; text-align:center;">$id_vendedor</td>

            <td style="border: 1px solid black; width:350px; text-align:center;">$row[nombres]</td>

            <td style="border: 1px solid black; width:90px; text-align:right;">$$bruto2</td>

            <td style="border: 1px solid black; width:90px; text-align:right;">$$impuesto2</td>

            <td style="border: 1px solid black; width:90px; text-align:right;">$$total_ventas</td>

            <td style="border: 1px solid black; width:90px; text-align:right;">$$bruto3</td>

            <td style="border: 1px solid black; width:90px; text-align:right;">$$impuesto3</td>

            <td style="border: 1px solid black; width:90px; text-align:right;">$total_devoluciones</td>

            <td style="border: 1px solid black; width:90px; text-align:right;">$$gran_total</td>

            
            

        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');



}



// ---------------------------------------------------------

//Close and output PDF document
/*if($id_sucursal !== "0"){
    $pdf->Output('devoluciones de la '.$traerSucursal['nombre'].' '.date('d-m-Y').'.pdf', 'D');
}else{*/
    $pdf->Output('Ventas Devoluciones por vendedor.pdf', 'D'); 
//}


//============================================================+
// END OF FILE
//============================================================+



}
}






$ventas_devoluciones_vendedor = new MYPDF();
$ventas_devoluciones_vendedor -> no_rango = $_GET["no_rango"];
$ventas_devoluciones_vendedor -> id_sucursal = $_GET["id_sucursal"];
if(isset($_GET['rango_fecha'])){
    $ventas_devoluciones_vendedor -> rango_fecha = $_GET['rango_fecha'];
}
$ventas_devoluciones_vendedor -> exportarPDFReporteVentasDevolucionesVendedor();




