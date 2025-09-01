<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();
require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/reportes-ventas.controlador.php";
require_once "../../../modelos/reportes-ventas.modelo.php";
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
date_default_timezone_set('America/Mexico_City');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    public $fecha1;

    public $fecha2;

    public $id_sucursal;

    //Page header
    public function Header() {

        $fecha1 = $_GET["fecha1"];

        $fecha2 = $_GET["fecha2"];

        $id_sucursal = $_GET["id_sucursal"];

        // Logo
        /*$path = dirname( __FILE__ );
        $img_file = $path.'/images/fondo_pdf.png';
        $this->Image($img_file, 10, 100, 190, 85, '', '', '', false, 300, '', false, false, 0);
        $logo = $path.'/images/logo.jpg';
        $this->Image($logo, 8, 2, 65, 25, '', '', '', false, 30, '', false, false, 0);*/

        // Set font
        $this->SetFont('helvetica', 'B', 15);
        
        // Title

        
        $this->SetY(10);
        $this->SetX(50);
        $this->Cell(0, 15, 'Ventas por hora', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetY(17);
        $this->SetX(50);
        $this->Cell(0, 15, 'de '.$fecha1.' al '.$fecha2 , 0, false, 'C', 0, '', 0, false, 'M', 'M');
        
                
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



    public function exportarPDFReporteVentasHora(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$fecha1 = $this->fecha1;

$fecha2 = $this->fecha2;

$id_sucursal = $this->id_sucursal;

    $vendedores = ControladorReportesVentas::ctrMostrarVendedoresReportesVentas($fecha1, $fecha2, $id_sucursal);

                      

//echo $sql;


        




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



// ---------------------------------------------------------


foreach ($vendedores as $key => $value) {

    $id_vendedor = $value['id_vendedor'];

    $traerRegistros = ControladorReportesVentas::ctrMostrarDatosReporteVentasHoraVendedor($id_vendedor);
    

$bloque1 = <<<EOF



    <table style="border: none; font-size:12px;">


    
        <tr>
            <td style="border: none; width:142.5px;"></td>
            <td style="background-color: #1BA64B; border: 1px solid black; width:420px; text-align:center; font-weight:bold;">$value[nombres]</td>
            <td style="border: none; width:142.5px;"></td>
            
            

        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');



$bloque2 = <<<EOF



    <table style="font-size:12px;">


    
        <tr>

            <td style="border: none; width:142.5px;"></td>
        
            <td style="border: 1px solid black; width:100px; font-weight:bold; text-align:center;">Inicial</td>

            <td style="border: 1px solid black; width:100px; font-weight:bold; text-align:center;">Final</td>

            <td style="border: 1px solid black; width:100px; font-weight:bold; text-align:right;">No. Ventas</td>

            <td style="border: 1px solid black; width:120px; font-weight:bold; text-align:right;">Total Ventas</td>

            <td style="border: none; width:142.5px;"></td>

        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');


    $total_ventas_acumulado = 0;

    $cantidad_ventas_acumulado = 0;

foreach ($traerRegistros as $key2 => $row2) {

    $total_ventas = number_format($row2['total'], 2);

    //$total_utilidad = number_format($row['total_utilidad'], 2);

    $total_ventas_acumulado = $total_ventas_acumulado + $row2["total"];

    $cantidad_ventas_acumulado = $cantidad_ventas_acumulado + $row2["cantidad"];
    //$total_utilidad_acumulado_productos = $total_utilidad_acumulado_productos + $row["total_utilidad"];

        
        $bloque3 = <<<EOF



    <table style="font-size:12px;">


    
        <tr>

            <td style="border: none; width:142.5px;"></td>
        
            <td style="border: 1px solid black; width:100px; text-align:center;">$row2[inicio]</td>

            <td style="border: 1px solid black; width:100px; text-align:center;">$row2[final]</td>
            <td style="border: 1px solid black; width:100px; text-align:right;">$row2[cantidad]</td>
            <td style="border: 1px solid black; width:120px; text-align:right;">$$total_ventas</td>

            <td style="border: none; width:142.5px;"></td>

            

        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');
    }

    $total_ventas_acumulado = number_format($total_ventas_acumulado, 2);

    //$total_utilidad_acumulado_productos = number_format($total_utilidad_acumulado_productos, 2);

    $bloque4 = <<<EOF



    <table style="border: none; font-size:12px;">


    
        <tr>
            <td style="border: none; width:142.5px;"></td>
            <td style="border: none; width:200px;"></td>

            <td style="border: 1px solid black; width:100px; text-align:right; font-weight:bold;">$cantidad_ventas_acumulado</td>


            <td style="border: 1px solid black; width:120px; text-align:right; font-weight:bold;">$$total_ventas_acumulado</td>

           <td style="border: none; width:142.5px;"></td> 
            

        </tr>

        

    </table><br><br><br>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}



// ---------------------------------------------------------

//Close and output PDF document
/*if($id_vendedor !== "0"){
    $pdf->Output('devoluciones de la '.$traerSucursal['nombre'].' '.date('d-m-Y').'.pdf', 'D');
}else{*/
    $pdf->Output('Ventas por hora '.date('d-m-Y').'.pdf', 'D'); 
//}


//============================================================+
// END OF FILE
//============================================================+



}
}






$ventas_productos_hora = new MYPDF();
$ventas_productos_hora -> fecha1 = $_GET["fecha1"];
$ventas_productos_hora -> fecha2 = $_GET['fecha2'];
$ventas_productos_hora -> id_sucursal = $_GET['id_sucursal'];

$ventas_productos_hora -> exportarPDFReporteVentasHora();




