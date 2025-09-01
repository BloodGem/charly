<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
//date_default_timezone_set('America/Mexico_City');

require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/marcas.controlador.php";
require_once "../../../modelos/marcas.modelo.php";
require_once "../../../controladores/reportes-ventas.controlador.php";
require_once "../../../modelos/reportes-generales.modelo.php";


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    public $no_rango;

    public $rango_fecha;

    public $id_vendedor;

    public $id_marca;

    public $id_sucursal;

    //Page header
    public function Header() {

        $no_rango = $_GET["no_rango"];

        $rango_fecha = $_GET["rango_fecha"];

        $id_vendedor = $_GET["id_vendedor"];

        $id_marca = $_GET["id_marca"];

        $id_sucursal = $_GET["id_sucursal"];


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

$traerMarca = ControladorMarcas::ctrMostrarMarca($id_marca);


                $tituloP1 = "Ventas de Productos de la Marca ".$traerMarca['marca'];
                $tituloP2 = "por Vendedores en general ";

              


        // Logo
        /*$path = dirname( __FILE__ );
        $img_file = $path.'/images/fondo_pdf.png';
        $this->Image($img_file, 10, 100, 190, 85, '', '', '', false, 300, '', false, false, 0);
        $logo = $path.'/images/logo.jpg';
        $this->Image($logo, 8, 2, 65, 25, '', '', '', false, 30, '', false, false, 0);*/

        // Set font
        $this->SetFont('helvetica', 'B', 15);
        
        // Title

        
        $this->SetY(5);
        $this->SetX(50);
        $this->Cell(0, 15, $tituloP1, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetY(12);
        $this->SetX(50);
        $this->Cell(0, 15, $tituloP2, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetY(19);
        $this->SetX(50);
        $this->Cell(0, 15, $texto, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetY(26);
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



    public function exportarPDFVentasMarcaVendedor(){





//TRAEMOS LA INFORMACIÓN DE LA VENTA


$no_rango = $this->no_rango;

$id_sucursal = $this->id_sucursal;

$id_vendedor = $this->id_vendedor;

$id_marca = $this->id_marca;

$rango_fecha = $this->rango_fecha;



    $mes1 = substr( $rango_fecha, 0, 2 );
    $dia1 = substr( $rango_fecha, 3, 2 );
    $ano1 = substr( $rango_fecha, 6, 4 );
    $fecha1 = $ano1 ."-". $mes1 ."-". $dia1;

    $mes2 = substr( $rango_fecha, 13, 2 );
    $dia2 = substr( $rango_fecha, 16, 2 );
    $ano2 = substr( $rango_fecha, 19, 4 );
    $fecha2 = $ano2 ."-". $mes2 ."-". $dia2;


    switch ($no_rango) {

    case 1:

    $dia = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59' ;

    //$fecha1 = date("Y/m/d", strtotime("today"));
    //$fecha2 = date("Y/m/d", strtotime("today"));


    break;

    case 2:

    $dia = date("Y-m-d", strtotime("yesterday"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59' ;


    
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
    $fecha2 = $dia2 . ' 23:59:59' ;


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
    $fecha2 = $dia2 . ' 23:59:59' ;


    break;

    case 5:
    $dia1 = date("Y-m-d", strtotime("today - 6 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    break;

    case 6:
    $dia1 = date("Y-m-d", strtotime("today - 29 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;


    break;

    case 7:

    $dia1 = date("Y-m-d", strtotime("first day of this month"));
    $dia2 = date("Y-m-d", strtotime("last day of this month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;


    break;

    case 8:

    $dia1 = date("Y-m-d", strtotime("first day of last month"));
    $dia2 = date("Y-m-d", strtotime("last day of last month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    break;

    case 9:

    $fecha1 = $fecha1 . ' 00:00:00';
    $fecha2 = $fecha2 . ' 23:59:59' ;

    break;
    
}
            

    $traerVendedores = ControladorReportesVentas::ctrSelectVendedoresReporteVentasMarcaVendedor($fecha1, $fecha2, $id_marca, $id_sucursal);

                      

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


foreach ($traerVendedores as $keyV => $rowV) {
    $id_vendedor = $rowV['id_vendedor'];

$traerVentasVendedor = ControladorReportesVentas::ctrReporteVentasMarcaVendedor($fecha1, $fecha2, $id_marca, $id_vendedor, $id_sucursal);  
    

$bloque1 = <<<EOF



    <table style="border: none; font-size:12px;">


    
        <tr>
        
            <td style="background-color: #1BA64B; border: 1px solid black; width:1020px; text-align:center; font-weight:bold;">$rowV[nombres]</td>

            
            

        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');



$bloque2 = <<<EOF



    <table style="border: 1px solid black; font-size:12px;">


    
        <tr>
        
            <td style="border: 1px solid black; width:60px; font-weight:bold; text-align:center;">IdVenta</td>

            <td style="border: 1px solid black; width:80px; font-weight:bold; text-align:center;">Folio</td>

            <td style="border: 1px solid black; width:120px; font-weight:bold; text-align:center;">Fecha</td>

            <td style="border: 1px solid black; width:120px; font-weight:bold; text-align:center;">Clave Producto</td>

            <td style="border: 1px solid black; width:400px; font-weight:bold; text-align:center;">Producto</td>

            <td style="border: 1px solid black; width:60px; font-weight:bold; text-align:right;">Cantidad</td>

            <td style="border: 1px solid black; width:90px; font-weight:bold; text-align:right;">Precio</td>

            <td style="border: 1px solid black; width:90px; font-weight:bold; text-align:right;">Total</td>

        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');


$total_ventas_acumulado = 0;

foreach ($traerVentasVendedor as $key => $row) {

    $id_venta = $row['id'];

    $total_ventas_acumulado = $total_ventas_acumulado + $row['total'];

    $total = number_format($row['total'], 2);

    $cantidad = number_format($row['cantidad'], 2);

    $precio_neto = number_format($row['precio_neto'], 2);

        
        $bloque3 = <<<EOF



    <table style="border: 1px solid black; font-size:12px;">


    
        <tr>
        
            <td style="border: 1px solid black; width:60px; text-align:center;">$id_venta</td>

            <td style="border: 1px solid black; width:80px; text-align:center;">$row[folio]</td>
            <td style="border: 1px solid black; width:120px; text-align:center;">$row[fecha_creacion]</td>
            <td style="border: 1px solid black; width:120px; text-align:center;">$row[clave_producto]</td>
            <td style="border: 1px solid black; width:400px; text-align:center;">$row[descripcion_corta]</td>
            <td style="border: 1px solid black; width:60px; text-align:right;">$cantidad</td>
            <td style="border: 1px solid black; width:90px; text-align:right;">$$precio_neto</td>
            <td style="border: 1px solid black; width:90px; text-align:right;">$$total</td>

            

        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');
    }

    $total_ventas_acumulado = number_format($total_ventas_acumulado, 2);
    //$total_utilidad_acumulado_productos = number_format($total_utilidad_acumulado_productos, 2);

    $bloque4 = <<<EOF



    <table style="border: none; font-size:12px;">


    
        <tr>
        
            <td style="border: 1px solid black; width:1020px; text-align:right; font-weight:bold;">TOTAL VENTAS: $$total_ventas_acumulado</td>

            
            

        </tr>

        

    </table><br><br><br>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}



// ---------------------------------------------------------

//Close and output PDF document
/*if($id_vendedor !== "0"){
    $pdf->Output('devoluciones de la '.$traerSucursal['nombre'].' '.date('d-m-Y').'.pdf', 'D');
}else{*/
    $pdf->Output('Ventas de Marca por Vendedor '.date('d-m-Y').'.pdf', 'D'); 
//}


//============================================================+
// END OF FILE
//============================================================+



}
}






$ventas_productos_vendedores = new MYPDF();
$ventas_productos_vendedores -> no_rango = $_GET["no_rango"];
$ventas_productos_vendedores -> id_sucursal = $_GET['id_sucursal'];
$ventas_productos_vendedores -> id_vendedor = $_GET['id_vendedor'];
$ventas_productos_vendedores -> id_marca = $_GET['id_marca'];
if(isset($_GET['rango_fecha'])){
    $ventas_productos_vendedores -> rango_fecha = $_GET['rango_fecha'];
}
$ventas_productos_vendedores -> exportarPDFVentasMarcaVendedor();




