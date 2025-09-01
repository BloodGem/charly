<?php

//error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


require_once "../../../controladores/devoluciones-compras.controlador.php";
require_once "../../../modelos/devoluciones-compras.modelo.php";
require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/compras.controlador.php";
require_once "../../../modelos/compras.modelo.php";
require_once "../../../controladores/otros.controlador.php";
require_once "../../../modelos/otros.modelo.php";
require_once "../../../controladores/partdevcom.controlador.php";
require_once "../../../modelos/partdevcom.modelo.php";


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {



    public $id_devolucion_compra;




    //Page header
    public function Header() {



        $id_devolucion_compra = $_GET["id_devolucion_compra"];


        //, *.accdb
        /*$db = getcwd() . "\\..\\..\\..\\..\\..\\..\\..\\SISTEMA\\" . 'agromit.mdb';
    $dsn = "DRIVER={Microsoft Access Driver (*.mdb)};
    DBQ=$db";
    $con = odbc_connect( $dsn, '', '' );

        $sqlCompra2 = "SELECT * FROM COMPRA WHERE IDCOMPRA = ".$id_devolucion_compra;
        $rsCompra2 = odbc_exec( $con, $sqlCompra2 );

        $traerCompra2 = odbc_fetch_array($rsCompra2);*/

        $traerDevolucionCompra = ControladorDevolucionesCompras::ctrMostrarDevolucionCompra($id_devolucion_compra);

        $traerCompra = ControladorCompras::ctrMostrarCompra($traerDevolucionCompra['id_compra']);

        $traerSucursal = ControladorSucursales::ctrMostrarSucursal($traerDevolucionCompra['id_sucursal']);

        $traerCliente = ControladorProveedores::ctrMostrarProveedor($traerDevolucionCompra['id_proveedor']);


        // Logo
        $path = dirname( __FILE__ );

        // set bacground image
        /*$img_file = $path.'/images/fondo_pdf.jpg';
        $this->Image($img_file, 10, 100, 190, 85, '', '', '', false, 300, '', false, false, 0);
        $logo = $path.'/images/logo.jpg';


        $this->Image($logo, 8, 2, 65, 25, '', '', '', false, 30, '', false, false, 0);*/

        
        
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



    $this->html2 = '<table style="border: 1px solid #000000; font-size:12px;">
        
        <tr>
            <td style="border: 1px solid #000000; text-align:center; width:180px;">
            Folio:
            </td>
            </tr>

            <tr>
            <td style="color: red; width:90px; text-align:center;">
            N°
            </td>
            <td style="color: red; width:90px; text-align:center;">
            '.$id_devolucion_compra.'
            </td>
            </tr>
            <tr>
            <td style="border: 1px solid #000000; width:180px;">
            Fecha: '.$traerDevolucionCompra['fecha_creacion'].'
            </td>
            </tr>


    </table>




    <table style="border: none;">
<tr>
            <td style="font-size:16px; text-align:left; width:200px;">
                Aviso de Devolución


            </td>

            
        </tr>

    </table>';


        $this->SetY(0);
        $this->SetX(80);
        $this->writeHTML($this->html1, true, false, true, false, '');
        $this->SetY(8);
        $this->SetX(150);
        $this->writeHTML($this->html2, true, false, true, false, '');
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

       
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font

        $this->Cell(50, 10, 'Creado el: '.date('d-m-Y').' a las: '.date('h:i:s',time() - 3610), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        // Page number
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');

        
    }



    public function exportarPDFDevolucionCompra(){

        //require_once "conexion.php";

        $id_devolucion_compra = $this->id_devolucion_compra;

        $traerDevolucionCompra = ControladorDevolucionesCompras::ctrMostrarDevolucionCompra($id_devolucion_compra);

        $traerPartidasDevolucionCompra = ControladorPartDevCom::ctrMostrarPartidasDevolucionCompra($id_devolucion_compra);



        $traerCompra = ControladorCompras::ctrMostrarCompra($traerDevolucionCompra['id_compra']);

        $traerSucursal = ControladorSucursales::ctrMostrarSucursal($traerDevolucionCompra['id_sucursal']);

        $traerProveedor = ControladorProveedores::ctrMostrarProveedor($traerDevolucionCompra['id_proveedor']);


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
//padding:5px 10px;
        $bloque1 = <<<EOF

        <table style="border: 1px solid #000000; font-size:11px;">

        <tr>
        <td style="border: 1px solid #000000;  width:720px; text-align:center;">
        <br><br>
    <table style="border: none; font-size:10px;">

        <tr>
        <td style="border: none;  width:60px; text-align:left;">Proveedor:</td>

        <td style="border-bottom: 1px solid black;  width:620px; text-align:center;">$traerProveedor[nombre]</td>
        </tr>
        <br>
        <tr>
        <td style="border: none;  width:55px; text-align:center;">Entrega:</td>

        <td style="border-bottom: 1px solid black;  width:200px; text-align:center;"></td>

        <td style="border: none;  width:55px; text-align:center;">Recibe:</td>

        <td style="border-bottom: 1px solid black;  width:200px; text-align:center;"></td>

        <td style="border: none;  width:70px; text-align:center;">N° Captura:</td>

        <td style="border-bottom: 1px solid black;  width:120px; text-align:center;"></td>
        
        </tr>


    </table>
<br><br>
    </td>
        
        </tr>

    </table><br><br>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');







if($traerDevolucionCompra['id_motivo_devolucion_compra'] !==  0){

    $traerMotivoDevolucionCompra = ControladorOtros::ctrMostrarMotivoDevolucionCompra($traerDevolucionCompra['id_motivo_devolucion_compra']);
    $motivo = $traerMotivoDevolucionCompra['motivo_devolucion_compra'];
}else{
    $motivo = "XXX";
}


$bloque2 = <<<EOF

        <table style="border: 1px solid #000000; font-size:11px;">

        <tr>
        <td style="border: 1px solid #000000;  width:720px; text-align:center;">
        <br><br>
    <table style="border: none; font-size:10px;">

        <tr>
        <td style="border: none;  width:60px; text-align:left;">Motivo:</td>

        <td style="border-bottom: 1px solid black;  width:620px; text-align:center;">$motivo</td>
        </tr>
        <br>
        <tr>
        <td style="border: none;  width:70px; text-align:center;">El material:</td>

        <td style="border: none;  width:60px;"></td>

        <td style="border: 1px solid #000000;  width:20px;"></td>

        <td style="border: none;  width:200px; text-align:left;">Se entregó al repartidor</td>

        <td style="border: none;  width:40px;"></td>

        <td style="border: 1px solid #000000;  width:20px;"></td>

        <td style="border: none;  width:200px; text-align:left;">Falta por entregar</td>
        
        </tr>


    </table>
<br><br>
    </td>
        
        </tr>

    </table><br><br>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');









$bloque3 = <<<EOF

    <table style="font-size:10px;">

        <tr>
        <td style="border: 1px solid #000000; width:45px; text-align:center;">PIEZAS</td>

        <td style="border: 1px solid #000000; width:300px; text-align:center;">DESCRIPCIÓN</td>

        <td style="border: 1px solid #000000; width:85px; text-align:center;">CODIGO</td>

        <td style="border: 1px solid #000000; width:200px; text-align:center;">OBSERVACIÓN</td>
        
        <td style="border: 1px solid #000000; width:90px; text-align:right;">IMPORTE</td>
        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

foreach ($traerPartidasDevolucionCompra as $key => $value) {


$traerProducto = ControladorProductos::ctrMostrarProducto($value['id_producto']);

$total = number_format($value["total"], 2);




$bloque4 = <<<EOF

    <table style="font-size:9px; padding:5px 0px;">

        <tr>

                <td style="border: 1px solid #000000; color:#000000;  width:45px; text-align:center;">$value[cantidad]</td>

                <td style="border: 1px solid #000000; color:#000000;  width:300px; text-align:center;">$traerProducto[descripcion_corta]</td>

                 <td style="border: 1px solid #000000; color:#000000;  width:85px; text-align:center;">$traerProducto[clave_producto]</td>

                 <td style="border: 1px solid #000000; color:#000000;  width:200px;"></td>
            
            <td style="border: 1px solid #000000; color:#000000;  width:90px; text-align:right;">$$total</td>


        </tr>

    </table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque5 = <<<EOF

    <table style="border: 1px solid #000000; border-color: #000000; color:#000000; font-size:10px; padding:3px 0px;">

       
        
        <tr>
   
            <td style="border: 1px solid #666; border-color: #000000; color:#000000; width:320px; ">

                <table>
                    <tr>
                    <br>
                        <td style="width:30px;">Pagó:</td>
                        <td style="border-bottom: 1px solid black; width:280px;"></td>
                    </tr>
                </table>
                <br>
                
            </td>

           <td style="border: 1px solid #666; border-color: #000000; color:#000000; width:200px; ">

                <table>
                    <tr>
                    <br>
                        <td style="width:95px;">Fecha de respuesta:</td>
                        <td style="border-bottom: 1px solid black;"></td>
                    </tr>
                </table>

                <br>
            </td>

            <td style="border: 1px solid #666; border-color: #000000; color:#000000; width:200px; ">

                <table>
                    <tr>
                    <br>
                        <td style="width:50px;">Total desc:</td>
                        <td style="border-bottom: 1px solid black; width:140px;"></td>
                    </tr>
                </table>

                <br>
                
            </td>

        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');



// ---------------------------------------------------------

//Close and output PDF document
        /*$nombre_archivo = "T".$id_devolucion_compra
        $ruta = "Tickets/".$nombre_archivo;*/

        $pdf->Output('Devolucion de compra no.'.$id_devolucion_compra.'.pdf', 'D');



        

            

//============================================================+
// END OF FILE
//============================================================+



    }
}





$pdf_devolucion_compra = new MYPDF();
$pdf_devolucion_compra -> id_devolucion_compra = $_GET["id_devolucion_compra"];
$pdf_devolucion_compra -> exportarPDFDevolucionCompra();




