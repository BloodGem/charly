<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {


    //Page header
    public function Header() {

        // Logo
        /*$path = dirname( __FILE__ );
        $img_file = $path.'/images/fondo_pdf.jpg';
        $this->Image($img_file, 10, 100, 190, 85, '', '', '', false, 300, '', false, false, 0);
        $logo = $path.'/images/logo.jpg';
        $this->Image($logo, 8, 2, 65, 25, '', '', '', false, 30, '', false, false, 0);*/

        // Set font
        $this->SetFont('helvetica', 'B', 15);
        
        // Title

        
        $this->SetY(17);
        $this->SetX(50);
        $this->Cell(0, 15, "Valor de Inventario General", 0, false, 'C', 0, '', 0, false, 'M', 'M');
        
                
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



    public function exportarPDFReporteValorInventarioGeneral(){

        require_once "../../../modelos/conexion2.php";

        $sql = "SELECT productos.clave_producto, productos.descripcion_corta, SUM(existencias_sucursales.stock) AS existencias, existencias_sucursales.precio_compra, SUM(existencias_sucursales.stock * existencias_sucursales.precio_compra) AS SUMA FROM existencias_sucursales INNER JOIN productos ON existencias_sucursales.id_producto = productos.id_producto GROUP BY productos.clave_producto, productos.descripcion_corta, existencias_sucursales.precio_compra ORDER BY productos.descripcion_corta ASC";


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
$bloque1 = <<<EOF


    <table style=style="border: 1px solid black; font-size:12px;">
<tr>
<td style="border: 1px solid black; width:100px; text-align:center; font-weight:bold;">Clave</td>
<td style="border: 1px solid black; width:400px; text-align:center; font-weight:bold;">Descripción</td>
<td style="border: 1px solid black; width:55px; text-align:right; font-weight:bold;">Exist.</td>
<td style="border: 1px solid black; width:75px; text-align:right; font-weight:bold;">Costo</td>
<td style="border: 1px solid black; width:90px; text-align:right; font-weight:bold;">Valor s/IVA</td>


</tr>


</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------
$total_valor_inventario_general = 0;
 while ($row = $rs->fetch_array(MYSQLI_BOTH)) { 

    $en_venta = $row['precio_compra'];
    $suma = number_format($row['SUMA'], 2);
    $existencia = number_format($row['existencias'], 0);

    //AQUI EMPIEZA LA SUMATORIA DE LOS TOTALES
    $total_valor_inventario_general = $total_valor_inventario_general + $row['SUMA'];




$bloque2 = <<<EOF



    <table style="border: 1px solid black; font-size:11px;">


    
        <tr>
        
            <td style="border: 1px solid black; width:100px; text-align:center;">$row[clave_producto]</td>

            <td style="border: 1px solid black; width:400px; text-align:center;">$row[descripcion_corta]</td>
            <td style="border: 1px solid black; width:55px; text-align:right;">$existencia</td>
            <td style="border: 1px solid black; width:75px; text-align:right;">$$en_venta</td>
            <td style="border: 1px solid black; width:90px; text-align:right;">$$suma</td>
            
            

        </tr>

        

    </table>
    

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}


$total_valor_inventario_general = number_format($total_valor_inventario_general, 2);


$bloque3 = <<<EOF


<br><br><table style="font-size:25px;">


    
        <tr>

            <td style="border: none; width:600px; text-align:center; font-weight:bold;">
            
                VALOR DE INVENTARIO: $$total_valor_inventario_general

            </td>
        </tr>

        

    </table>



EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');




// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Valor de inventario general consultado el '.date('d-m-Y').'.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+



}
}






$exportar_valor_inventario_general = new MYPDF();
$exportar_valor_inventario_general -> exportarPDFReporteValorInventarioGeneral();




