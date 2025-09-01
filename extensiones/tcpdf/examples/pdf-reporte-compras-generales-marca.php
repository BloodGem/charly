<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();
require_once "../../../controladores/marcas.controlador.php";
require_once "../../../modelos/marcas.modelo.php";
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
date_default_timezone_set('America/Mexico_City');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    public $no_rango;

    public $rango_fecha;

    public $id_marca;

    public $id_sucursal;

    //Page header
    public function Header() {

        $no_rango = $_GET["no_rango"];

        $rango_fecha = $_GET["rango_fecha"];

        $id_marca = $_GET["id_marca"];

        $traerMarca = ControladorMarcas::ctrMostrarMarca($id_marca);


        $mes1 = substr( $rango_fecha, 0, 2 );
        $dia1 = substr( $rango_fecha, 3, 2 );
        $ano1 = substr( $rango_fecha, 6, 4 );
        $fecha1 = $dia1 ."-". $mes1 ."-". $ano1;

        $mes2 = substr( $rango_fecha, 13, 2 );
        $dia2 = substr( $rango_fecha, 16, 2 );
        $ano2 = substr( $rango_fecha, 19, 4 );
        $fecha2 = $dia2 ."-". $mes2 ."-". $ano2;


        


        switch ($no_rango) {
            case 1:
                $texto= "de hoy";
                $texto_rango_fecha_consulta = date('d-m-Y');
            break;
            case 2:
                $texto= "de ayer";
                $texto_rango_fecha_consulta = date('d-m-Y',strtotime("- 1 day"));
            break;
            case 3:
            if(date("D")=="Mon"){
                $lunes = date("d-m-Y");
            }else{
                $lunes = date("d-m-Y", strtotime('last Monday', time()));
            }


            $texto= " de esta semana";
            $texto_rango_fecha_consulta = "del ".$lunes." al ".date('d-m-Y', strtotime('this Sunday', time()));
            break;
            case 4:
            if(date("D")=="Mon"){
                $lunes = date("d-m-Y", strtotime('last Monday', time()));
            }else{
                $lunes = date("d-m-Y", strtotime('last Monday - 7 days', time()));
            }
            
            $texto= " de semana anterior";
            $texto_rango_fecha_consulta = "del ".$lunes." al ".date('Y-m-d', strtotime('last Sunday', time()));
            break;
            case 5:
                $texto= "de los últimos 7 días";
                $texto_rango_fecha_consulta = "del ".date('d-m-Y',strtotime("- 6 day"))." al ".date('d-m-Y');
            break;
            case 6:
                $texto= "de los últimos 30 días";
                $texto_rango_fecha_consulta = "del ".date('d-m-Y',strtotime("- 29 day"))." al ".date('d-m-Y');
            break;
            case 7:
                $texto= "de este mes";
                $texto_rango_fecha_consulta = "del ".date('01-m-Y')." al ".date('d-m-Y');
            break;
            case 8:
                $texto= "del mes anterior";
                $texto_rango_fecha_consulta = "del ".date("d-m-Y", strtotime("first day of previous month"))." al ".date("d-m-Y", strtotime("last day of previous month"));
            break;
            case 9:
                $texto= "";
                $texto_rango_fecha_consulta = "del ".$fecha1." al ".$fecha2;
            break;
    
}
                                   $compras = "Compras de la marca ".$traerMarca['marca']." ";

              

                $titulo = $compras.$texto;

        // Logo
        /*$path = dirname( __FILE__ );
        $img_file = $path.'/images/fondo_pdf.jpg';
        $this->Image($img_file, 50, 65, 190, 85, '', '', '', false, 300, '', false, false, 0);
        $logo = $path.'/images/logo.jpg';
        $this->Image($logo, 8, 2, 65, 25, '', '', '', false, 30, '', false, false, 0);*/

        // Set font
        $this->SetFont('helvetica', 'B', 15);
        
        // Title

        
        $this->SetY(10);
        $this->SetX(50);
        $this->Cell(0, 15, $titulo, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetY(17);
        $this->SetX(50);
        $this->Cell(0, 15, $texto_rango_fecha_consulta , 0, false, 'C', 0, '', 0, false, 'M', 'M');
        
                
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



    public function exportarPDFReporteComprasGeneralesMarca(){


require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/reportes-compras.controlador.php";
require_once "../../../modelos/reportes-compras.modelo.php";


//TRAEMOS LA INFORMACIÓN DE LA VENTA


$no_rango = $this->no_rango;

$rango_fecha = $this->rango_fecha;

$id_marca = $this->id_marca;

$id_sucursal = $this->id_sucursal;



switch ($no_rango) {

    case 1:

    $dia = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59';

    break;

    case 2:

    $dia = date("Y-m-d", strtotime("yesterday"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59';

    break;

    case 3:

    if(date("D")=="Mon"){
        $lunes = date("Y-m-d");
    }else{
        $lunes = date("Y-m-d", strtotime('last Monday', time()));
    }


    $dia1 = $lunes;
    $dia2 = date('Y-m-d', strtotime('this Sunday', time()));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';


    break;

    case 4:

    if(date("D")=="Mon"){
        $lunes = date("Y-m-d", strtotime('last Monday', time()));
    }else{
        $lunes = date("Y-m-d", strtotime('last Monday - 7 days', time()));
    }


    $dia1 = $lunes;
    $dia2 = date('Y-m-d', strtotime('last Sunday', time()));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';


    break;

    case 5:
    $dia1 = date("Y-m-d", strtotime("today - 6 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';

    
    break;

    case 6:
    $dia1 = date("Y-m-d", strtotime("today - 29 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';

    break;

    case 7:

    $dia1 = date("Y-m-d", strtotime("first day of this month"));
    $dia2 = date("Y-m-d", strtotime("last day of this month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';


    

    break;

    case 8:

    $dia1 = date("Y-m-d", strtotime("first day of last month"));
    $dia2 = date("Y-m-d", strtotime("last day of last month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59';

    break;

    case 9:

        $mes1 = substr( $rango_fecha, 0, 2 );
    $dia1 = substr( $rango_fecha, 3, 2 );
    $ano1 = substr( $rango_fecha, 6, 4 );
    $fecha1 = $ano1 ."-". $mes1 ."-". $dia1;

    $mes2 = substr( $rango_fecha, 13, 2 );
    $dia2 = substr( $rango_fecha, 16, 2 );
    $ano2 = substr( $rango_fecha, 19, 4 );
    $fecha2 = $ano2 ."-". $mes2 ."-". $dia2;

    $fecha1 = $fecha1 . ' 00:00:00';
    $fecha2 = $fecha2 . ' 23:59:59';

    break;
    
}
            

    $traerProveedores = ControladorReportesCompras::ctrSelectProveedoresReporteComprasMarca($fecha1, $fecha2, $id_marca, $id_sucursal);

                      

//echo $sql;


        




// create new PDF document
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


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


foreach ($traerProveedores as $keyP => $rowP) {

    
$traerPartidasCompra = ControladorReportesCompras::ctrReporteComprasMarca($fecha1, $fecha2, $id_marca, $id_sucursal, $rowP['id_proveedor']);
    

$bloque1 = <<<EOF



    <table style="border: none; font-size:12px;">


    
        <tr>
        
            <td style="background-color: #1BA64B; border: 1px solid black; width:1025px; text-align:center; font-weight:bold;">$rowP[nombre]</td>

            
            

        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');



$bloque2 = <<<EOF



    <table style="border: 1px solid black; font-size:11px;">


    
        <tr>
        
            <td style="border: 1px solid black; width:50px; font-weight:bold; text-align:center;">No<br>Compra</td>

            <td style="border: 1px solid black; width:70px; font-weight:bold; text-align:center;">Fecha</td>

            <td style="border: 1px solid black; width:60px; font-weight:bold; text-align:center;">Factura</td>

            <td style="border: 1px solid black; width:100px; font-weight:bold; text-align:center;">Clave</td>

            <td style="border: 1px solid black; width:420px; font-weight:bold; text-align:center;">Producto</td>

            <td style="border: 1px solid black; width:80px; font-weight:bold; text-align:center;">Marca</td>

            <td style="border: 1px solid black; width:65px; font-weight:bold; text-align:right;">Cantidad</td>

            <td style="border: 1px solid black; width:90px; font-weight:bold; text-align:right;">Precio U.</td>

            <td style="border: 1px solid black; width:90px; font-weight:bold; text-align:right;">Importe</td>

        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');


$total_compras_acumulado = 0;

foreach ($traerPartidasCompra as $key => $row) {

    $total_compras_acumulado = $total_compras_acumulado + $row['total'];

    $cantidad = number_format($row['cantidad'], 2);

    $precio_unitario = number_format($row['precio'], 2);

    $total = number_format($row['total'], 2);
        
        $bloque3 = <<<EOF



    <table style="border: 1px solid black; font-size:11px;">


    
        <tr>
        
            <td style="border: 1px solid black; width:50px; text-align:center;">$row[id_compra]</td>
            <td style="border: 1px solid black; width:70px; text-align:center;">$row[fecha_creacion]</td>
            <td style="border: 1px solid black; width:60px; text-align:center;">$row[no_factura]</td>
            <td style="border: 1px solid black; width:100px; text-align:center;">$row[clave_producto]</td>
            <td style="border: 1px solid black; width:420px; text-align:center;">$row[descripcion_corta]</td>
            <td style="border: 1px solid black; width:80px; text-align:center;">$row[marca]</td>
            <td style="border: 1px solid black; width:65px; text-align:right;">$cantidad</td>
            <td style="border: 1px solid black; width:90px; text-align:right;">$$precio_unitario</td>
            <td style="border: 1px solid black; width:90px; text-align:right;">$$total</td>

            

        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');
    }

    $total_compras_acumulado = number_format($total_compras_acumulado, 2);
    //$total_utilidad_acumulado_productos = number_format($total_utilidad_acumulado_productos, 2);

    $bloque4 = <<<EOF



    <table style="border: none; font-size:12px;">


    
        <tr>
        
            <td style="border: 1px solid black; width:1025px; text-align:right; font-weight:bold;">TOTAL: $$total_compras_acumulado</td>

            
            

        </tr>

        

    </table><br><br><br>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}



// ---------------------------------------------------------

//Close and output PDF document
/*if($id_usuario !== "0"){
    $pdf->Output('devoluciones de la '.$traerSucursal['nombre'].' '.date('d-m-Y').'.pdf', 'D');
}else{*/
    $pdf->Output('Compras en general de la marca '.date('d-m-Y').'.pdf', 'D'); 
//}


//============================================================+
// END OF FILE
//============================================================+



}
}






$compras_generales_marca = new MYPDF();
$compras_generales_marca -> no_rango = $_GET["no_rango"];
$compras_generales_marca -> id_marca = $_GET["id_marca"];
$compras_generales_marca -> id_sucursal = $_GET["id_sucursal"];
if(isset($_GET['rango_fecha'])){
    $compras_generales_marca -> rango_fecha = $_GET['rango_fecha'];
}
$compras_generales_marca -> exportarPDFReporteComprasGeneralesMarca();




