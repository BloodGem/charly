<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


require_once "../../../controladores/compras.controlador.php";
require_once "../../../modelos/compras.modelo.php";
require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
require_once "../../../controladores/existencias-sucursales.controlador.php";
require_once "../../../modelos/existencias-sucursales.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/otros.controlador.php";
require_once "../../../modelos/otros.modelo.php";


require_once "../../../modelos/partcom.modelo.php";


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {



    public $id_compra;




    //Page header
    public function Header() {



        $id_compra = $_GET["id_compra"];


        //, *.accdb
        /*$db = getcwd() . "\\..\\..\\..\\..\\..\\..\\..\\SISTEMA\\" . 'agromit.mdb';
    $dsn = "DRIVER={Microsoft Access Driver (*.mdb)};
    DBQ=$db";
    $con = odbc_connect( $dsn, '', '' );

        $sqlCompra2 = "SELECT * FROM COMPRA WHERE IDCOMPRA = ".$id_compra;
        $rsCompra2 = odbc_exec( $con, $sqlCompra2 );

        $traerCompra2 = odbc_fetch_array($rsCompra2);*/

        $traerCompra = ControladorCompras::ctrMostrarCompra($id_compra);

        $dateFecha = date_create($traerCompra['fecha_confirmacion']);
        $fecha_confirmacion=date_format($dateFecha, 'd/m/Y H:i:s a');

        $traerSucursal = ControladorSucursales::ctrMostrarSucursal($traerCompra['id_sucursal']);

        $traerProveedor = ControladorProveedores::ctrMostrarProveedor($traerCompra['id_proveedor']);

        $traerCapturista = ControladorUsuarios::ctrMostrarUsuario($traerCompra['id_usuario_creador']);


        // Logo
        $path = dirname( __FILE__ );

        // set bacground image
        $img_file = $path.'/images/fondo_pdf.jpg';
        $this->Image($img_file, 10, 100, 190, 70, '', '', '', false, 300, '', false, false, 0);
        $logo = $path.'/images/logo.jpg';


        $this->Image($logo, 8, 2, 65, 25, '', '', '', false, 30, '', false, false, 0);

        
        
        // Set font
        $this->SetFont('helvetica', 'B', 15);

        $this->SetY(7);
        $this->SetX(70);
        $this->html2 = '<table>
        
        <tr>
        <td style="font-size:13px; width:50px; text-align:rcenter;">
            </td>
        <td style="font-size:13px; width:200px; text-align:center;">

                COMPRA NO.'.$id_compra.'
                
            </td>
            <td style="font-size:13px; width:200px; text-align:rcenter;">

                '.$fecha_confirmacion.'
                
                
            </td>
            <td style="font-size:13px; width:50px; text-align:rcenter;">
            </td>

        </tr>

    </table>';
        $this->writeHTML($this->html2, true, false, true, false, '');
        $this->SetFont('helvetica', 'B', 9);
        
        // Title
        $this->SetY(14);
        $this->SetX(70);
        $this->html3 = '<table>
        
        <tr>
            <td style="font-size:13px; width:500px; text-align:center;">

                '.$traerProveedor['nombre'].'
                
                
            </td>

        </tr>

    </table>';
        $this->writeHTML($this->html3, true, false, true, false, '');
        $this->SetFont('helvetica', 'B', 9);


        


        $this->SetY(21);
        $this->SetX(70);
        $this->html4 = '<table>
        
        <tr>
            <td style="font-size:13px; width:500px; text-align:center;">

                Capturador: '.$traerCapturista['nombre'].'
                
                
            </td>

        </tr>

    </table>';
        $this->writeHTML($this->html4, true, false, true, false, '');
        $this->SetFont('helvetica', 'B', 9);
        //$this->Cell(0, 15, 'FOLIO: '.$traerCompra2['IDCOMPRA'], 0, false, 'C', 0, '', 0, false, 'M', 'M');



        $this->SetY(30);

        $this->html = '<p style="border-top:1px solid #000000; text-align:center;">
        </p>';
        $this->writeHTML($this->html, true, false, true, false, '');
    }

    // Page footer
    public function Footer() {

        $id_compra = $_GET["id_compra"];


        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font

        $this->Cell(50, 10, 'Creado el: '.date('d-m-Y').' a las: '.date('h:i:s',time() - 3610), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        // Page number
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');

        
    }



    public function exportarPDFCompra(){



        //require_once "conexion.php";

        $id_compra = $this->id_compra;



        $traerCompra = ControladorCompras::ctrMostrarCompra($id_compra);

        $partidas_compra = ModeloPartCom::mdlMostrarPartidasCompra($id_compra);

        $traerComprador = ControladorUsuarios::ctrMostrarUsuario($traerCompra['id_usuario_creador']);

        $traerProveedor = ControladorProveedores::ctrMostrarProveedor($traerCompra['id_proveedor']);


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

    <table style="font-size:11px; font-weight:bold;">

        <tr>
        <td style="border: 1px solid #000000;  width:90px; text-align:center;">Ubicación</td>
        <td style="border: 1px solid #000000;  width:55px; text-align:center;">Cant.</td>
        <td style="border: 1px solid #000000;  width:85px; text-align:center;">Clave Producto</td>
        <td style="border: 1px solid #000000;  width:285px; text-align:center;">Descripción Producto</td>
        <td style="border: 1px solid #000000;  width:65px; text-align:right;">Valor Unitario</td>
        <td style="border: 1px solid #000000;  width:55px; text-align:center;">Desc.</td>
        <td style="border: 1px solid #000000;  width:65px; text-align:right;">Importe</td>
        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
$total_unitario = 0;
foreach ($partidas_compra as $key => $value) {


$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES($value['id_producto']);

$precio_unitario = number_format(($value["precio"]/1.16), 2);

$total_unitario = $total_unitario + ($value["cantidad"] * ($value["precio"]/1.16));

$total_cant_pu = $value["cantidad"] * ($value["precio"]/1.16);

$total_cant_pu = number_format($total_cant_pu, 2);





$bloque4 = <<<EOF

    <table style="font-size:10px; padding:5px 0px;">

        <tr>
            <td style="border: 1px solid #000000; color:#000000;  width:90px; text-align:center;">$traerProducto[ubicacion]</td>
                <td style="border: 1px solid #000000; color:#000000;  width:55px; text-align:center;">$value[cantidad]</td>
                <td style="border: 1px solid #000000; color:#000000;  width:85px; text-align:center;">$traerProducto[clave_producto]</td>
            
            <td style="border: 1px solid #000000; color:#000000;  width:285px; text-align:center;">$traerProducto[descripcion_corta]</td>

            

            <td style="border: 1px solid #000000; color:#000000;  width:65px; text-align:right;">$$precio_unitario</td>
            <td style="border: 1px solid #000000; color:#000000;  width:55px; text-align:center;">$value[descuento]</td>

            <td style="border: 1px solid #000000; color:#000000;  width:65px; text-align:right;">$$total_cant_pu</td>


        </tr>

    </table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------
$total_iva = $traerCompra['total'] - $total_unitario;
$total_iva = number_format($total_iva,2);

$total_compra = number_format($traerCompra['total'],2);
$total_unitario = number_format($total_unitario ,2);

$total_letras = ControladorOtros::number_words($traerCompra['total'],"pesos","con","centavos");
$bloque5 = <<<EOF

    <table style="border: 1px solid #000000; border-color: #000000; color:#000000; font-size:11px; padding:3px 0px;">

       
        
        <tr style="padding:3px 0px;">
   
            <td style="border: 1px solid #666; border-color: #000000; color:#000000; width:515px; ">

                <table>
                    <tr>
                        <td style="background-color: #BDBDBD; width:100px;">Importe con letra:</td>
                        <td style="width:405px; border: 1px solid #000000; border-color: red;">$total_letras M.N.</td>
                    </tr>
                </table>


                
            </td>

           <td style="border: 1px solid #000000; border-color: #000000; color:#000000; width:185px;">

                <table>
                    <table style="border: 4px solid #FFFFFF;">
                    <tr>
                        <td style="background-color: #BDBDBD; text-align:right;">Subtotal:</td>
                        <td style="text-align:right; width:84px;">$$total_unitario</td>
                    </tr>
               </table>

                    <table style="border: 4px solid #FFFFFF;">
                    <tr>
                        <td style="background-color: #BDBDBD; text-align:right;">IVA 002 0.160000:</td>
                        <td style="text-align:right; width:84px;">$$total_iva</td>
                    </tr>
               </table>
<table style="border: 4px solid #FFFFFF;">
                    <tr>
                        <td style="background-color: #BDBDBD; text-align:right;">Total:</td>
                        <td style="text-align:right; width:84px;">$$total_compra</td>
                    </tr>

                </table>

               </table>
                
            </td>

        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');



// ---------------------------------------------------------

//Close and output PDF document
        /*$nombre_archivo = "T".$id_compra
        $ruta = "Tickets/".$nombre_archivo;*/

        $pdf->Output('C-'.$id_compra.'.pdf', 'd'); 

        

        
//============================================================+
// END OF FILE
//============================================================+



    }
}





$pdf_ticket_compra = new MYPDF();
$pdf_ticket_compra -> id_compra = $_GET["id_compra"];
$pdf_ticket_compra -> exportarPDFCompra();




