<?php

//error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();





// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


require_once "../../../controladores/facturas-globales.controlador.php";
require_once "../../../modelos/facturas-globales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../controladores/otros.controlador.php";
require_once "../../../modelos/otros.modelo.php";



// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {



    public $id_factura_global;




    //Page header
    public function Header() {



        $id_factura_global = $_GET["id_factura_global"];


        //, *.accdb
        /*$db = getcwd() . "\\..\\..\\..\\..\\..\\..\\..\\SISTEMA\\" . 'agromit.mdb';
    $dsn = "DRIVER={Microsoft Access Driver (*.mdb)};
    DBQ=$db";
    $con = odbc_connect( $dsn, '', '' );

        $sqlCompra2 = "SELECT * FROM COMPRA WHERE IDCOMPRA = ".$id_factura_global;
        $rsCompra2 = odbc_exec( $con, $sqlCompra2 );

        $traerCompra2 = odbc_fetch_array($rsCompra2);*/

        $traerFacturaGlobal = ControladorFacturasGlobales::ctrMostrarFacturaGlobal($id_factura_global);

        $traerSucursal = ControladorSucursales::ctrMostrarSucursal($traerFacturaGlobal['id_sucursal']);

        $traerCliente = ControladorClientes::ctrMostrarCliente(1);


        // Logo
        $path = dirname( __FILE__ );

        // set bacground image
        $img_file = $path.'/images/fondo_pdf.png';
        $this->Image($img_file, 10, 100, 190, 120, '', '', '', false, 300, '', false, false, 0);
        $logo = $path.'/images/logo.jpg';


        $this->Image($logo, 8, 5, 45, 25, '', '', '', false, 30, '', false, false, 0);

        
        
        // Set font
        $this->SetFont('helvetica', 'B', 15);
        
        // Title
        
        $this->html1 = '<table>
        
        <tr>
            

            <td style=" width:160px">
                <div style="font-size:10px; text-align:center; line-height:12px;">
                '.$traerSucursal['nombre'].
                '<br>'.$traerSucursal['rfc'].
                '<br>'.$traerSucursal['direccion'].' '.$traerSucursal['no_interior'].' '.$traerSucursal['no_exterior'].
                '<br>'.$traerSucursal['colonia'].
                '<br>'.$traerSucursal['ciudad'].'</div>


            </td>

            
        </tr>

    </table>';




    $this->html2 = '<table>
        
        <tr>
            

            <td style="border: 1px solid #000000; border-color: #000000; color:#000000; width:325px">

                <table style="font-size:10px;">
                    <tr>
                        <td colspan="4">Factura CFDI 4.0</td>
                    </tr>
                    <tr>
                        <td>Folio</td>
                        <td>'.$id_factura_global.'</td>
                        <td>Tipo de comprobante</td>
                        <td>I - ingreso</td>
                    </tr>
                    <tr>
                        <td colspan="4">Folio Físcal</td>
                    </tr>
                    <tr>
                        <td colspan="4">'.$traerFacturaGlobal['uuid'].'</td>
                    </tr>
                    <tr>
                        <td colspan="2">Fecha y hora de expedición:</td>
                        <td colspan="2">'.$traerFacturaGlobal['fecha_creacion'].'</td>
                    </tr>
                    <tr>
                        <td colspan="2">Fecha y hora de certificación:</td>
                        <td colspan="2">'.$traerFacturaGlobal['fecha_timbrado'].'</td>
                    </tr>
                    <tr>
                        <td colspan="2">Lugar de expedición:</td>
                        <td colspan="2">'.$traerSucursal['codigo_postal'].'</td>
                    </tr>
                    <tr>
                        <td colspan="2">No. serie del emisor:</td>
                        <td colspan="2">'.$traerFacturaGlobal['certnumber'].'</td>
                    </tr>
                    <tr>
                        <td colspan="2">Uso del CFDI:</td>
                        <td colspan="2">'.$traerFacturaGlobal['id_cfdi'].'</td>
                    </tr>
                    <tr>
                        <td colspan="2">No. serie certificado SAT:</td>
                        <td colspan="2">'.$traerFacturaGlobal['no_certificado_sat'].'</td>
                    </tr>
                    <tr>
                        <td colspan="2">Moneda:</td>
                        <td colspan="2">MXN Peso Mexicano</td>
                    </tr>
                    <tr>
                        <td colspan="2">Tipo de cambio:</td>
                        <td colspan="2">1.000000</td>
                    </tr>
                    
                </table>


                
            </td>

        </tr>

    </table>';





    $this->html3 = '<table style="border: 1px solid #000000; border-color: #000000; color:#000000; font-size:10px; width:350px">
                    <tr>
                        <td colspan="4">Datos del receptor</td>
                    </tr>
                    <tr>
                        <td>R.F.C.</td>
                        <td>'.$traerCliente['rfc'].'</td>
                        <td>C.P.</td>
                        <td>'.$traerCliente['codigo_postal'].'</td>
                    </tr>
                    <tr>
                        <td colspan="1">Cliente:</td>
                        <td colspan="3">'.$traerCliente['nombre'].'</td>
                    </tr>
                    <tr>
                        <td colspan="1">Regimen:</td>
                        <td colspan="3">'.$traerCliente['id_regimen'].'</td>
                    </tr>
                    <tr>
                        <td colspan="1">Email:</td>
                        <td colspan="3">'.$traerCliente['email'].'</td>
                    </tr>
                    
                </table>';
        $this->SetY(0);
        $this->SetX(60);
        $this->writeHTML($this->html1, true, false, true, false, '');
        $this->SetY(7);
        $this->SetX(110);
        $this->writeHTML($this->html2, true, false, true, false, '');
        $this->SetY(35);
        $this->SetX(10);
        $this->writeHTML($this->html3, true, false, true, false, '');
        $this->SetFont('helvetica', 'B', 9);
        //$this->Cell(0, 15, 'FOLIO: '.$traerCompra2['IDCOMPRA'], 0, false, 'C', 0, '', 0, false, 'M', 'M');

        $this->SetY(17);
        $this->SetFont('helvetica', 'B', 15);
        $this->Cell(0, 15, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 9);
        
        //$this->Cell(0, 15, 'ID DE NOTA: '.$traerCompra2['id_nota_entrada'], 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetY(22);
        $this->SetFont('helvetica', 'B', 15);
        $this->Cell(0, 15, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 9);
        //$this->Cell(0, 15, 'FACTURA: '.$traerCompra2['no_factura'], 0, false, 'C', 0, '', 0, false, 'M', 'M');


        /*$this->SetY(30);

        $this->html = '<p style="border-top:1px solid #000000; text-align:center;">
        </p>';
        $this->writeHTML($this->html, true, false, true, false, '');*/
    }

    // Page footer
    public function Footer() {

        $id_factura_global = $_GET["id_factura_global"];

$traerFacturaGlobal = ControladorFacturasGlobales::ctrMostrarFacturaGlobal($id_factura_global);

$traerCliente = ControladorClientes::ctrMostrarCliente(1);

$traerMetodoPago = ControladorOtros::ctrMostrarMetodoPago($traerFacturaGlobal['id_metodo_pago']);//es alreves

$traerFormaPago = ControladorOtros::ctrMostrarFormaPago($traerFacturaGlobal['id_forma_pago']);//es alreves

$traerCFDI = ControladorOtros::ctrMostrarCFDI($traerFacturaGlobal['id_cfdi']);    

    $this->html1 = '<table style="color:#000000; font-size:9px; padding:2px 0px;">
            
            <tr>
                <td rowspan="6" style="width:155px;"><img src="../../../SDK2/timbrados/globales/FG-'.$id_factura_global.'.png"></td>
                <td style="width:540px; background-color: #BDBDBD">Sello Digital del Emisor</td>
            </tr>
            <tr>
                <td style="width:540px;">'.$traerFacturaGlobal['sello'].'</td>
            </tr>
            
            
            <tr>
                <td style="width:540px; background-color: #BDBDBD">Sello Digital del SAT</td>
            </tr>
            <tr>
                <td style="width:540px;">'.$traerFacturaGlobal['sello_sat'].'</td>
            </tr>
            
            
            <tr>
                <td style="width:540px; background-color: #BDBDBD">Cadena Original del Complemento de Certificación digital del SAT</td>
            </tr>
            <tr>
                <td style="width:540px;">'.$traerFacturaGlobal['cadena_timbre'].'</td>
            </tr>
            
    </table>';


    $this->html2 = '<table style="color:#000000; font-size:9px; padding:3px 0px;">
            
            <tr>
                <td style="background-color: #BDBDBD; width:90px;">Método de Pago:</td>
                <td style="width:210px;">  '.$traerFacturaGlobal['id_metodo_pago'].' '.$traerMetodoPago['descripcion'].'</td>
                <td style="background-color: #BDBDBD; width:90px;">Forma de Pago:</td>
                <td style="width:210px;">  '.$traerFacturaGlobal['id_forma_pago'].' '.$traerFormaPago['descripcion'].'</td>
            </tr>
    </table>';

    $this->html3 = '<table style="color:#000000; font-size:9px; padding:3px 0px;">
            
            <tr>
                <td style="background-color: #BDBDBD; width:90px;">Relación CFDI:</td>
                <td style="width:210px;">  '.$traerFacturaGlobal['id_cfdi'].' '.$traerCFDI['descripcion'].'</td>
                <td style="background-color: #BDBDBD; width:90px;">UUID Relacionado:</td>
                <td style="width:210px;"></td>
            </tr>
            
    </table>';
        $this->SetY(-85);
        $this->SetX(5);
        $this->writeHTML($this->html1, true, false, true, false, '');

        $this->SetY(-25);
        $this->SetX(48);
$this->writeHTML($this->html2, true, false, true, false, '');

$this->SetY(-19);
        $this->SetX(48);
$this->writeHTML($this->html3, true, false, true, false, '');
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font

        $this->Cell(50, 10, 'Creado el: '.date('d-m-Y').' a las: '.date('h:i:s',time() - 3610), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        // Page number
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');

        
    }



    public function exportarPDFFactura(){



        //require_once "conexion.php";

        $id_factura_global = $this->id_factura_global;



        $traerFacturaGlobal = ControladorFacturasGlobales::ctrMostrarFacturaGlobal($id_factura_global);

        $traerCliente = ControladorClientes::ctrMostrarCliente(1);

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
        $pdf->SetMargins(10, 55, 2);
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

    <table style="font-size:8px;">

        <tr>
        <td style="border: 1px solid #000000;  width:40px; text-align:center;">Cantidad</td>
        <td style="border: 1px solid #000000;  width:40px; text-align:center;">Cve Unidad</td>
        <td style="border: 1px solid #000000;  width:40px; text-align:center;">Unidad</td>
        <td style="border: 1px solid #000000;  width:50px; text-align:center;">Clave Producto</td>
        <td style="border: 1px solid #000000;  width:70px; text-align:left;">Clave</td>
        <td style="border: 1px solid #000000;  width:320px; text-align:left;">Descripción Producto</td>
        <td style="border: 1px solid #000000;  width:60px; text-align:right;">Valor Unitario</td>
        <td style="border: 1px solid #000000;  width:60px; text-align:right;">Importe</td>
        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------


$precio_unitario = number_format($traerFacturaGlobal["bruto"], 2);


$total_cant_pu = $precio_unitario;





$bloque4 = <<<EOF

    <table style="font-size:9px; padding:5px 0px;">

        <tr>

                <td style="border: 1px solid #000000; color:#000000;  width:40px; text-align:center;">1</td>
                <td style="border: 1px solid #000000; color:#000000;  width:40px; text-align:center;">H87</td>
                <td style="border: 1px solid #000000; color:#000000;  width:40px; text-align:center;">VTA</td>
                <td style="border: 1px solid #000000; color:#000000;  width:50px; text-align:center;">01010101</td>
                <td style="border: 1px solid #000000; color:#000000;  width:70px; text-align:left;">VTAVTA</td>
            
            <td style="border: 1px solid #000000; color:#000000;  width:320px; text-align:left;">VENTA</td>

            

            <td style="border: 1px solid #000000; color:#000000;  width:60px; text-align:right;">$$precio_unitario</td>

            <td style="border: 1px solid #000000; color:#000000;  width:60px; text-align:right;">$$total_cant_pu</td>


        </tr>

    </table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');





// ---------------------------------------------------------


$total_venta = number_format($traerFacturaGlobal['total'], 2);

$total_iva = number_format($traerFacturaGlobal['impuesto'], 2);

$subtotal = number_format($traerFacturaGlobal['bruto'],2);

$total_venta_formateado = number_format($traerFacturaGlobal['total'], 2, '.', '');

$total_letras = ControladorOtros::number_words($total_venta_formateado,"pesos","con","centavos");

$bloque5 = <<<EOF

    <table style="border: 1px solid #000000; border-color: #000000; color:#000000; font-size:10px; padding:3px 0px;">

       
        
        <tr style="padding:3px 0px;">
   
            <td style="border: 1px solid #666; border-color: #000000; color:#000000; width:480px; ">

                <table>
                    <tr>
                        <td style="background-color: #BDBDBD; width:100px;">Importe con letra:</td>
                        <td style="width:380px;"> $total_letras M.N.</td>
                    </tr>
                </table>


                
            </td>

           <td style="border: 1px solid #000000; border-color: #000000; color:#000000; width:200px;">

                <table>
                    <table style="border: 4px solid #FFFFFF;">
                    <tr>
                        <td style="background-color: #BDBDBD; text-align:right;">Subtotal:</td>
                        <td style="text-align:right; width:92px;">$$subtotal</td>
                    </tr>
               </table>

                    <table style="border: 4px solid #FFFFFF;">
                    <tr>
                        <td style="background-color: #BDBDBD; text-align:right;">IVA 16%:</td>
                        <td style="text-align:right; width:92px;">$$total_iva</td>
                    </tr>
               </table>
<table style="border: 4px solid #FFFFFF;">
                    <tr>
                        <td style="background-color: #BDBDBD; text-align:right;">Total:</td>
                        <td style="text-align:right; width:92px;">$$total_venta</td>
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
        /*$nombre_archivo = "T".$id_factura_global
        $ruta = "Tickets/".$nombre_archivo;*/

       

    $pdf->Output(__DIR__  .  '/../../../SDK2/timbrados/globales/FG-'.$id_factura_global.'.pdf', 'F');


    $pdf->Output(__DIR__  .  '/../../../SDK2/timbrados/globales/FG-'.$id_factura_global.'.pdf', 'D');



        
        


    }
}



$ruta1 = "../../../SDK2/timbrados/globales/FG-".$_GET["id_factura_global"].".pdf";

if(file_exists($ruta1)){

    $filepath = "FG-".$_GET["id_factura_global"].".pdf";

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

        $pdf_ticket_venta = new MYPDF();
$pdf_ticket_venta -> id_factura_global = $_GET["id_factura_global"];
$pdf_ticket_venta -> exportarPDFFactura();

    }






