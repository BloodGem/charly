<?php

//error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


require_once "../../../controladores/cotizaciones.controlador.php";
require_once "../../../modelos/cotizaciones.modelo.php";
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../controladores/otros.controlador.php";
require_once "../../../modelos/otros.modelo.php";
require_once "../../../controladores/vendedores.controlador.php";
require_once "../../../modelos/vendedores.modelo.php";




// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {



    public $id_cotizacion;

    public $celular;



    //Page header
    public function Header() {



        $id_cotizacion = $_GET["id_cotizacion"];



        $traerCotizacion = ControladorCotizaciones::ctrMostrarCotizacion($id_cotizacion);

        $traerSucursal = ControladorSucursales::ctrMostrarSucursal($traerCotizacion['id_sucursal']);

        $traerCliente = ControladorClientes::ctrMostrarCliente($traerCotizacion['id_cliente']);

        $traerEstado = ControladorOtros::ctrMostrarEstados("id_estado", $traerSucursal['id_estado']);

        // Logo
        $path = dirname( __FILE__ );

        // set bacground image
        $img_file = $path.'/images/fondo_pdf.png';
        $this->Image($img_file, 10, 100, 190, 140, '', '', '', false, 300, '', false, false, 0);
        $logo = $path.'/images/logo.jpg';


        $this->Image($logo, 10, 4, 50, 30, '', '', '', false, 30, '', false, false, 0);

        
        
        // Set font
        $this->SetFont('helvetica', 'B', 15);
        
        // Title
        
        $this->html1 = '<table>
        
        <tr>
            

            <td style=" width:400px">
                <div style="font-size:10px; text-align:center; line-height:12px;">
                '.$traerSucursal['nombre'].
                '<br>'.$traerSucursal['rfc'].
                '<br>'.$traerSucursal['direccion'].' '.$traerSucursal['no_interior'].' '.$traerSucursal['no_exterior'].
                '<br>'.$traerSucursal['colonia'].
                '<br>'.$traerSucursal['ciudad'].
                '<br>'.$traerEstado['nomenclatura'].'</div>


            </td>

            
        </tr>

    </table>';








    $this->html2 = '<table>
        
        <tr>
            

            <td style=" width:180px">
                <div style="font-size:14px; color: red; text-align:center; line-height:12px;">
                No. cotizacion: '.$traerCotizacion['id_cotizacion'].'</div>


            </td>

            
        </tr>

    </table>';




    





    $this->html3 = '<table style="border: 1px solid #000000; border-color: #000000; color:#000000; font-size:10px; width:680px">
                    <tr>
                        <td colspan="4">Datos del cliente</td>
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
        $this->SetX(160);
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


        $this->SetY(-15);
        // Set font

        $this->Cell(50, 10, 'Creado el: '.date('d-m-Y').' a las: '.date('h:i:s',time() - 3610), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        // Page number
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');

        
    }



    public function exportarPDFTicketCotizacion(){



        $id_cotizacion = $this->id_cotizacion;

        $celular = $this->celular;

        $traerCotizacion = ControladorCotizaciones::ctrMostrarCotizacion($id_cotizacion);

        $traerVendedor = ControladorVendedores::ctrMostrarVendedor2($traerCotizacion['id_vendedor']);

        $traerCliente = ControladorClientes::ctrMostrarCliente($traerCotizacion['id_cliente']);


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

    <table style="font-size:12px;">

        <tr>
        <td style="border: 1px solid #000000;  width:60px; text-align:center;">Cantidad</td>
        <td style="border: 1px solid #000000;  width:80px; text-align:center;">Clave Producto</td>
        <td style="border: 1px solid #000000;  width:400px; text-align:left;">Descripción Producto</td>
        <td style="border: 1px solid #000000;  width:70px; text-align:center;">Precio</td>
        <td style="border: 1px solid #000000;  width:70px; text-align:right;">Total</td>
        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
$total_unitario = 0;

$partidas_cotizacion = json_decode($traerCotizacion["productos"], true);

foreach ($partidas_cotizacion as $key => $value) {

$cantidad = $value["cantidad"];

$traerProducto = ControladorProductos::ctrMostrarProducto($value['id']);

$precio_unitario = number_format($value["precio"], 2);

$total_cant_pu = number_format($value["total"], 2);





$bloque4 = <<<EOF

    <table style="font-size:10px; padding:5px 0px;">

        <tr>

                <td style="border: 1px solid #000000; color:#000000;  width:60px; text-align:center;">$cantidad</td>

                <td style="border: 1px solid #000000; color:#000000;  width:80px; text-align:center;">$traerProducto[clave_producto]</td>
            
            <td style="border: 1px solid #000000; color:#000000;  width:400px; text-align:left;">$traerProducto[descripcion_corta]</td>

            

            <td style="border: 1px solid #000000; color:#000000;  width:70px; text-align:center;">$$precio_unitario</td>

            <td style="border: 1px solid #000000; color:#000000;  width:70px; text-align:right;">$$total_cant_pu</td>


        </tr>

    </table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');



}



// ---------------------------------------------------------

$total_letras = ControladorOtros::number_words($traerCotizacion['total'],"pesos","con","centavos");

$total_cotizacion = number_format($traerCotizacion['total'], 2);
$bloque5 = <<<EOF

    <table style="border: 1px solid #000000; border-color: #000000; color:#000000; font-size:10px; padding:3px 0px;">

       
        
        <tr style="border: 1px solid #000000; border-color: #000000;">
   
                        <td style="background-color: #BDBDBD; width:100px;">Importe con letra:</td>
                        <td style="width:440px;">   $total_letras M.N.</td>
                        <td style="background-color: #BDBDBD; text-align:right; width:70px;">Total:</td>
                        <td style="text-align:right; width:70px;">$$total_cotizacion</td>
                    


        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');



// ---------------------------------------------------------

//Close and output PDF document
        /*$nombre_archivo = "T".$id_cotizacion
        $ruta = "Tickets/".$nombre_archivo;*/

        $pdf->Output(__DIR__  .  '/../../../recursos/cotizaciones/C-'.$id_cotizacion.'.pdf', 'F');


        $nombre_archivo = "C-".$id_cotizacion.".pdf";

        $ruta = "../../../recursos/cotizaciones/".$nombre_archivo; //ESTA ES LA RUTA ANTERIOR SI GUARDA PERO CO CON LOS PERMISOS NECESARIOS
        
        if(file_exists($ruta)){

            //http://localhost/guerrero/extensiones/tcpdf/examples/pdf-ticket-cotizacion.php?id_cotizacion=17&celular=4491806500
            $params=array(
'token' => 'jp523ak4ln983i1q',
'to' => '+52'.$celular,
'filename' => $nombre_archivo,
'document' => 'http://guerrero.dyndns.ws:6065/cotizaciones/'.$nombre_archivo,
'caption' => 'Hola, aquí tienes tu cotización, regrese pronto'
);
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.ultramsg.com/instance63120/messages/document",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => http_build_query($params),
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$respuestaAPI = substr( $response, 15, 14 );

if($respuestaAPI == '"message":"ok"'){

echo "<script>

                    alert('La cotización se ha mandado con éxito');

                            window.close();

                            

                            </script>";
}else{
    echo "<script>

                    alert('No se ha podido mandar la cotización');

                            window.close();

                            

                            </script>";
}



        }else{

            echo "<script languaje='javascript' type='text/javascript'>
            alert('No se creo PDF');
            window.close();
            </script>";

        }

        

        

            

//============================================================+
// END OF FILE
//============================================================+



    }
}





$pdf_ticket_cotizacion = new MYPDF();
$pdf_ticket_cotizacion -> id_cotizacion = $_GET["id_cotizacion"];
$pdf_ticket_cotizacion -> celular = $_GET["celular"];
$pdf_ticket_cotizacion -> exportarPDFTicketCotizacion();




