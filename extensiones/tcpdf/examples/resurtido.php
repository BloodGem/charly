<?php

//error_reporting(0);
//date_default_timezone_set('America/Mazatlan');
session_start();



// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
date_default_timezone_set('America/Mexico_City');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    public $id_resurtido;

    //Page header
    public function Header() {


require_once "../../../controladores/resurtido.controlador.php";
require_once "../../../modelos/resurtido.modelo.php";
require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";

        $id_resurtido = $_GET['id_resurtido'];
        
        $traerResurtido = ControladorResurtidos::ctrMostrarResurtido($id_resurtido);

        $dateFecha = date_create($traerResurtido['fecha_creacion']);
        $fecha = date_format($dateFecha, 'd-m-Y');

        $traerProveedor = ControladorProveedores::ctrMostrarProveedor($traerResurtido['id_proveedor']);


        // Logo
        /*$path = dirname( __FILE__ );
        $img_file = $path.'/images/fondo_pdf.jpg';
        $this->Image($img_file, 10, 100, 190, 85, '', '', '', false, 300, '', false, false, 0);
        $logo = $path.'/images/logo.jpg';
        $this->Image($logo, 8, 2, 65, 25, '', '', '', false, 30, '', false, false, 0);*/

        // Set font
        $this->SetFont('helvetica', 'B', 15);
        
        // Title

        
        $this->SetY(7);
        $this->SetX(50);
        $this->Cell(0, 15, 'RESURTIDO NO.'.$id_resurtido, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetY(14);
        $this->SetX(50);
        $this->Cell(0, 15, $fecha, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetY(21);
        $this->SetX(50);
        $this->Cell(0, 15, 'Proveedor: '.$traerProveedor['nombre'], 0, false, 'C', 0, '', 0, false, 'M', 'M');
        

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



    public function exportarPDFResurtido(){

        require_once "../../../modelos/conexion2.php";

        require_once "../../../controladores/resurtido.controlador.php";
        require_once "../../../modelos/resurtido.modelo.php";
        require_once "../../../controladores/existencias-sucursales.controlador.php";
        require_once "../../../modelos/existencias-sucursales.modelo.php";


        $id_resurtido = $this->id_resurtido;

        $traerResurtido = ControladorResurtidos::ctrMostrarResurtido($id_resurtido);

        $productos = json_decode($traerResurtido["productos"], true);


    //echo $sql;

    //$rs = $conexion->query($sql);
        




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

        if($id_resurtido == "0"){
            $td_encabezado = '<td style="border: 1px solid black; width:150x; text-align:left; font-weight:bold;">Sucursal</td>';
        }

        $bloque1 = <<<EOF
        <table style=style="border: 1px solid black; font-size:12px;">
        <tr>
        <td style="border: 1px solid black; width:100px; text-align:left; font-weight:bold;">Clave Producto</td>
        <td style="border: 1px solid black; width:375px; text-align:left; font-weight:bold;">Descripción</td>
        <td style="border: 1px solid black; width:60px; text-align:left; font-weight:bold;">Cantidad</td>
        <td style="border: 1px solid black; width:52px; text-align:left; font-weight:bold;">Mínimo</td>
        <td style="border: 1px solid black; width:52px; text-align:right; font-weight:bold;">Máximo</td>
        <td style="border: 1px solid black; width:75px; text-align:right; font-weight:bold;">Existencias</td>
        </tr>
        </table>

        EOF;

        $pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------


        foreach ($productos as $key => $row) {



        $traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES2($row['id_producto'], $traerResurtido['id_sucursal']);


            $bloque2 = <<<EOF
            <table style="border: 1px solid black; font-size:11px;">
            <tr>
            <td style="border: 1px solid black; width:100px; text-align:left;">$traerProducto[clave_producto]</td>
            <td style="border: 1px solid black; width:375px; text-align:left;">$traerProducto[descripcion_corta]</td>
            <td style="border: 1px solid black; width:60px; text-align:center;">$row[a_pedir]</td>
            <td style="border: 1px solid black; width:52px; text-align:center;">$traerProducto[nivel_minimo]</td>
            <td style="border: 1px solid black; width:52px; text-align:center;">$traerProducto[nivel_maximo]</td>
            <td style="border: 1px solid black; width:75px; text-align:center;">$traerProducto[stock]</td>
            </tr>
            </table>

            EOF;

            $pdf->writeHTML($bloque2, false, false, false, false, '');

        }



// ---------------------------------------------------------



// ---------------------------------------------------------

//Close and output PDF document
        
            $pdf->Output('Resurtido no.'.$id_resurtido.' '.date('d-m-Y').'.pdf', 'D'); 
        


//============================================================+
// END OF FILE
//============================================================+



    }
}






$generarPDFResurtido = new MYPDF();
$generarPDFResurtido -> id_resurtido = $_GET["id_resurtido"];
$generarPDFResurtido -> exportarPDFResurtido();




