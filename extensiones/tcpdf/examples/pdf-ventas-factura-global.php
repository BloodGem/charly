<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once('tcpdf_include.php');

require_once "../../../controladores/facturas-globales.controlador.php";
require_once "../../../modelos/facturas-globales.modelo.php";


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {



    public $id_factura_global;




    //Page header
    public function Header() {



        $id_factura_global = $_GET["id_factura_global"];

        $traerFacturaGlobal = ControladorFacturasGlobales::ctrMostrarFacturaGlobal($id_factura_global);
        // Logo
        $path = dirname( __FILE__ );

        // set bacground image
        $img_file = $path.'/images/fondo_pdf.png';
        $this->Image($img_file, 5, 100, 200, 120, '', '', '', false, 300, '', false, false, 0);
        $logo = $path.'/images/logo.jpg';


        $this->Image($logo, 8, 2, 50, 25, '', '', '', false, 30, '', false, false, 0);

        
        
        // Set font
        $this->SetFont('helvetica', 'B', 15);

        $this->writeHTML($this->html2, true, false, true, false, '');
        $this->SetFont('helvetica', 'B', 9);
        
        // Title
        $this->SetY(14);
        $this->SetX(70);
        $this->html3 = '<table>
        
        <tr>
            <td style="font-size:13px; width:500px; text-align:center;">

                FACTURA GLOBAL: '.$id_factura_global.'
                
            </td>

        </tr>

    </table>';
        $this->writeHTML($this->html3, true, false, true, false, '');
        $this->SetFont('helvetica', 'B', 9);


        

        $this->SetFont('helvetica', 'B', 9);
        //$this->Cell(0, 15, 'FOLIO: '.$traerFacturaGlobal2['IDCOMPRA'], 0, false, 'C', 0, '', 0, false, 'M', 'M');



        $this->SetY(30);

        $this->html = '<p style="border-top:1px solid #000000; text-align:center;">
        </p>';
        $this->writeHTML($this->html, true, false, true, false, '');
    }

    // Page footer
    public function Footer() {

        $id_factura_global = $_GET["id_factura_global"];


        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font

        $this->Cell(50, 10, 'Creado el: '.date('d-m-Y').' a las: '.date('h:i:s',time() - 3610), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        // Page number
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');

        
    }



    public function exportarPDFFacturaGlobal(){



        //require_once "conexion.php";

        $id_factura_global = $this->id_factura_global;



        $traerFacturaGlobal = ControladorFacturasGlobales::ctrMostrarFacturaGlobal($id_factura_global);

        $ventas_factura_global = ControladorFacturasGlobales::ctrMostrarVentasFacturaGlobal($id_factura_global);


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
        $pdf->SetMargins(10, 35, 2);
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
//padding:5px 10px;
$bloque3 = <<<EOF

    <table style="font-size:14px; font-weight:bold;">

        <tr>
        <td style="border: 1px solid #000000; width:50px; text-align:center;">Venta</td>
        <td style="border: 1px solid #000000; width:100px; text-align:center;">Folio</td>
        <td style="border: 1px solid #000000; width:200px; text-align:left;">Fecha</td>
        <td style="border: 1px solid #000000; width:100px; text-align:right;">Total Venta</td>
        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
$total_acumulado_ventas = 0;
foreach ($ventas_factura_global as $key => $value) {

$dateFecha = date_create($value['fecha_creacion']);
$fecha_venta = date_format($dateFecha, 'd/m/Y H:i:s a');

$total_acumulado_ventas = $total_acumulado_ventas + $value['total'];

$total_venta = number_format($value['total'], 2);





$bloque4 = <<<EOF

    <table style="font-size:12px;">

        <tr>
            <td style="border: 1px solid #000000; color:#000000;  width:50px; text-align:center;">$value[id]</td>
                <td style="border: 1px solid #000000; color:#000000;  width:100px; text-align:center;">$value[folio]</td>
                <td style="border: 1px solid #000000; color:#000000;  width:200px; text-align:left;">$fecha_venta</td>
            
            <td style="border: 1px solid #000000; color:#000000;  width:100px; text-align:right;">$$total_venta</td>

            

        </tr>

    </table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$total_acumulado_ventas = number_format($total_acumulado_ventas ,2);

$bloque5 = <<<EOF

    <table style="font-weight:bold; font-size:12px;">

       
        
        <tr>
   
                        <td style="text-align:right; width:350px;">Total:</td>
                        <td style="border: 1px solid #000000; text-align:right; width:100px;">$$total_acumulado_ventas</td>
                   
                

        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');




        $pdf->Output(__DIR__  .  '/../../../SDK2/timbrados/globales/VENTAS-FG-'.$id_factura_global.'.pdf', 'F');


        $pdf->Output(__DIR__  .  '/../../../SDK2/timbrados/globales/VENTAS-FG-'.$id_factura_global.'.pdf', 'D');

        
//============================================================+
// END OF FILE
//============================================================+



    }
}



$ruta1 = "../../../SDK2/timbrados/globales/VENTAS-FG-".$_GET["id_factura_global"].".pdf";

if(file_exists($ruta1)){

    $filepath = "VENTAS-FG-".$_GET["id_factura_global"].".pdf";

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('../../../SDK2/timbrados/globales/'.$filepath));
        readfile('../../../SDK2/timbrados/globales/'.$filepath);

        echo "<script languaje='javascript' type='text/javascript'>
            window.close();
            </script>";
    }else{

        $pdf_factura_global = new MYPDF();
        $pdf_factura_global -> id_factura_global = $_GET["id_factura_global"];
        $pdf_factura_global -> exportarPDFFacturaGlobal();

    }






