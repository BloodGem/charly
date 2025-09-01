<?php

//error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');





// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {



    public $id_compra;




    //Page header
    public function Header() {

        require_once "../../../controladores/usuarios.controlador.php";
        require_once "../../../modelos/usuarios.modelo.php";
        require_once "../../../controladores/compras.controlador.php";
        require_once "../../../modelos/compras.modelo.php";
        require_once "../../../controladores/proveedores.controlador.php";
        require_once "../../../modelos/proveedores.modelo.php";
        require_once "../../../controladores/sucursales.controlador.php";
        require_once "../../../modelos/sucursales.modelo.php";

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

        $traerUsuarioCreador = ControladorUsuarios::ctrMostrarUsuario($traerCompra['id_usuario_creador']);


        // Logo
        $path = dirname( __FILE__ );

        // set bacground image
        $img_file = $path.'/images/fondo_pdf.jpg';
        $this->Image($img_file, 10, 100, 190, 70, '', '', '', false, 300, '', false, false, 0);
        $logo = $path.'/images/logo.jpg';


        $this->Image($logo, 8, 2, 65, 25, '', '', '', false, 30, '', false, false, 0);

        
        
        // Set font
        $this->SetFont('helvetica', 'B', 15);
        
      



    $this->html2 = '<table>
        
        <tr>
            

            <td style="border: none; color:#000000; width:600px">

                <table style="font-size:10px;">
                    
                    <tr>
                        <td style="text-align:right;">Fecha cofirmación:</td>
                        <td> '.$fecha_confirmacion
                        .'</td>
                    </tr>
                    <tr>
                        <td style="text-align:right;">No. Compra:</td>
                        <td> '.$id_compra.'</td>
                    </tr>
                    <tr>
                        <td style="text-align:right;">Proveedor:</td>
                        <td> '.$traerProveedor['nombre'].'</td>
                    </tr>
                    <tr>
                        <td style="text-align:right;">Usuario:</td>
                        <td> '.$traerUsuarioCreador['nombre'].'</td>
                    </tr>
                    <tr>
                        <td style="text-align:right;">Factura No.:</td>
                        <td> '.$traerCompra['no_factura'].'</td>
                    </tr>
                    <tr>
                        <td style="text-align:right;">Observaciones:</td>
                        <td> '.$traerCompra['observaciones'].'</td>
                    </tr>
                    
                </table>


                
            </td>

        </tr>

    </table>';





 
        $this->SetY(3);
        $this->SetX(50);
        $this->writeHTML($this->html2, true, false, true, false, '');
        $this->SetFont('helvetica', 'B', 9);
        //$this->Cell(0, 15, 'FACTURA: '.$traerCompra2['no_factura'], 0, false, 'C', 0, '', 0, false, 'M', 'M');


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


        require_once "../../../modelos/conexion2.php";




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

        $id_compra = $this->id_compra;



        $traerCompra = ControladorCompras::ctrMostrarCompra($id_compra);

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
        <td style="border: 1px solid #000000;  width:60px; text-align:center;">Ubicación</td>
        <td style="border: 1px solid #000000;  width:50px; text-align:center;">Stock Act.</td>
        <td style="border: 1px solid #000000;  width:50px; text-align:center;">Compra</td>
        <td style="border: 1px solid #000000;  width:50px; text-align:center;">Stock Nue.</td>
        <td style="border: 1px solid #000000;  width:75px; text-align:center;">Clave Producto</td>
        <td style="border: 1px solid #000000;  width:390px; text-align:center;">Descripción Producto</td>
        <td style="border: 1px solid #000000;  width:30px; text-align:right;"></td>
        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

$sql = "SELECT existencias_sucursales.*, partcom.cantidad, partcom.stock_actual FROM partcom INNER JOIN existencias_sucursales ON partcom.id_producto = existencias_sucursales.id_producto WHERE id_compra = $id_compra ORDER BY existencias_sucursales.ubicacion ASC";

$rs = $conexion->query($sql);

 while($row = $rs->fetch_array(MYSQLI_BOTH)){


$traerProducto = ControladorProductos::ctrMostrarProducto($row['id_producto']);

$existencias_actuales = $row['stock_actual'];
$nuevas_existencias = $row['stock_actual'] + $row['cantidad'];


$bloque4 = <<<EOF

    <table style="font-size:10px; padding:5px 0px;">

        <tr>
                <td style="border: 1px solid #000000; color:#000000;  width:60px; text-align:center;">$row[ubicacion]</td>
                <td style="border: 1px solid #000000; color:#000000;  width:50px; text-align:center;">$existencias_actuales</td>
                <td style="border: 1px solid #000000; color:#000000;  width:50px; text-align:center;">$row[cantidad]</td>
                <td style="border: 1px solid #000000; color:#000000;  width:50px; text-align:center;">$nuevas_existencias</td>
                <td style="border: 1px solid #000000; color:#000000;  width:75px; text-align:center;">$traerProducto[clave_producto]</td>
            
            <td style="border: 1px solid #000000; color:#000000;  width:390px; text-align:center;">$traerProducto[descripcion_corta]</td>

            <td style="border: 1px solid #000000; color:#000000;  width:30px; text-align:center;"></td>


        </tr>

    </table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque5 = <<<EOF

    <br><br><br><br>
    <table style="font-size:13px;">

        <tr>
        <td style="border-top: 1px solid #000000;  width:150px; text-align:center; font-weight:bold;">Fecha de acomodó</td>
        <td style="width:150px;"></td>
        <td style="border-top: 1px solid #000000;  width:300px; text-align:center; font-weight:bold;">Quien acomodó</td>
        </tr>
    </table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');










$bloque6 = <<<EOF

    <br><br><br><br>
    <table style="font-size:12px;">

        <tr>
        <td style="width:200px; text-align:center; font-weight:bold;">Material faltante:</td>
        <td style="width:25px;"></td>
        <td style="width:200px; text-align:center; font-weight:bold;">Material Sobrante:</td>
        <td style="width:25px;"></td>
        <td style="width:200px; text-align:center; font-weight:bold;">Notas (Mal Capturado, Mal Recibido, etc.)</td>
        </tr>
    </table>


EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');





$bloque6 = <<<EOF

    <br><br>
    <table style="font-size:12px;">

        <tr>
        <td style="border-top: 1px solid #000000; width:200px; text-align:center; font-weight:bold;"></td>
        <td style="width:25px;"></td>
        <td style="border-top: 1px solid #000000; width:200px; text-align:center; font-weight:bold;"></td>
        <td style="width:25px;"></td>
        <td style="border-top: 1px solid #000000; width:200px; text-align:center; font-weight:bold;"></td>
        </tr>
    </table>
    <br><br>
    <table style="font-size:12px;">

        <tr>
        <td style="border-top: 1px solid #000000; width:200px; text-align:center; font-weight:bold;"></td>
        <td style="width:25px;"></td>
        <td style="border-top: 1px solid #000000; width:200px; text-align:center; font-weight:bold;"></td>
        <td style="width:25px;"></td>
        <td style="border-top: 1px solid #000000; width:200px; text-align:center; font-weight:bold;"></td>
        </tr>
    </table>
    <br><br>
    <table style="font-size:12px;">

        <tr>
        <td style="border-top: 1px solid #000000; width:200px; text-align:center; font-weight:bold;"></td>
        <td style="width:25px;"></td>
        <td style="border-top: 1px solid #000000; width:200px; text-align:center; font-weight:bold;"></td>
        <td style="width:25px;"></td>
        <td style="border-top: 1px solid #000000; width:200px; text-align:center; font-weight:bold;"></td>
        </tr>
    </table>
    <br><br>
    <table style="font-size:12px;">

        <tr>
        <td style="border-top: 1px solid #000000; width:200px; text-align:center; font-weight:bold;"></td>
        <td style="width:25px;"></td>
        <td style="border-top: 1px solid #000000; width:200px; text-align:center; font-weight:bold;"></td>
        <td style="width:25px;"></td>
        <td style="border-top: 1px solid #000000; width:200px; text-align:center; font-weight:bold;"></td>
        </tr>
    </table>

EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');

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




