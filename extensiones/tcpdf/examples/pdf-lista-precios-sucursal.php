<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
//date_default_timezone_set('America/Mexico_City');
//require_once "../../../modelos/conexion.php";


require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    public function Header() {

        // Logo
        $path = dirname( __FILE__ );
       $img_file = $path.'/images/fondo_pdf.png';
        $this->Image($img_file, 10, 100, 190, 120, '', '', '', false, 300, '', false, false, 0);
        $logo = $path.'/images/logo.jpg';


        $this->Image($logo, 8, 5, 45, 25, '', '', '', false, 30, '', false, false, 0);

        // Set font
        $this->SetFont('helvetica', 'B', 15);
        
        // Title

        
        $this->SetY(15);
        $this->SetX(50);
        $this->Cell(0, 15, 'Lista de precios', 0, false, 'C', 0, '', 0, false, 'M', 'M');

        $this->SetY(30);
        $this->html = '<p style="border-top:1px solid #999; ">
                            </p>';
            $this->writeHTML($this->html, true, false, true, false, '');



        $this->html1 = '<table style=style="border: 1px solid black; font-size:12px;">
<tr>
<td style="border: 1px solid black; width:80px; font-weight:bold;">Clave</td>
<td style="border: 1px solid black; width:325px; font-weight:bold;">Producto</td>
<td style="border: 1px solid black; width:50px; font-weight:bold;">Ubicación</td>
<td style="border: 1px solid black; width:65px; font-weight:bold; text-align: right;">Exist.</td>
<td style="border: 1px solid black; width:65px; font-weight:bold; text-align: right;">Precio<br>Público</td>
<td style="border: 1px solid black; width:65px; font-weight:bold; text-align: right;">Precio<br>Mayoreo</td>
<td style="border: 1px solid black; width:65px; font-weight:bold; text-align: right;">Precio<br>Especial</td>
</tr>
</table>';
$this->SetY(35);
        $this->SetX(5);
        $this->writeHTML($this->html1, true, false, true, false, '');
    }

    // Page footer
    public function Footer() {

        $this->SetY(-15);

        $this->html = '<p style="border-top:1px solid #999; ">
                            </p>';
            $this->writeHTML($this->html, true, false, true, false, '');
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font

        $this->Cell(50, 10, 'Consultado el: '.date('d-m-Y').' a las: '.date('h:i:s',time() - 3610), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        // Page number
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');

        
    }



    public function exportarPDFListaPrecios(){

require_once "../../../modelos/conexion2.php";

            
$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($_SESSION['id']);
        
$id_sucursal = $traerUsuario['id_sucursal'];



$sql = "SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.ubicacion, productos.clave_producto, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, productos.descripcion_corta FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto WHERE id_sucursal = $id_sucursal AND productos.descontinuado = 0 ORDER BY descripcion_corta ASC";

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
$pdf->SetMargins(5, 43.5, 5);
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

while ($row = $rs->fetch_array(MYSQLI_BOTH)) { 

$bloque2 = <<<EOF



    <table style="border: 1px solid black; font-size:11px;">


    
        <tr>
        
            <td style="border: 1px solid black; width:80px;">$row[clave_producto]</td>

            <td style="border: 1px solid black; width:325px;">$row[descripcion_corta]</td>

            <td style="border: 1px solid black; width:50px;">$row[ubicacion]</td>

            <td style="border: 1px solid black; width:65px; text-align: right;">$row[stock]</td>

            <td style="border: 1px solid black; width:65px; text-align: right;">$$row[precio1]</td>  

            <td style="border: 1px solid black; width:65px; text-align: right;">$$row[precio2]</td>  

            <td style="border: 1px solid black; width:65px; text-align: right;">$$row[precio3]</td>  
            

        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}



// ---------------------------------------------------------

//Close and output PDF document

    $pdf->Output('Lista de precios.pdf', 'D');



//============================================================+
// END OF FILE
//============================================================+



}
}






$lista_precios = new MYPDF();
$lista_precios -> exportarPDFListaPrecios();




