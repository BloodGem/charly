<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    public $no_rango;

    public $rango_fecha;

    public $id_sucursal;

    public $nombre_sucursal;
    //Page header
    public function Header() {

        $no_rango = $_GET["no_rango"];

        $rango_fecha = $_GET["rango_fecha"];

        $id_sucursal = $_GET['id_sucursal'];


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
            $texto_rango_fecha_consulta = "del ".$lunes." al ".date('d-m-Y', strtotime('last Sunday', time()));
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
                                   $ventas = "Ventas canceladas ";

              

                $titulo = $ventas.$texto;

        // Logo
        /*$path = dirname( __FILE__ );
        $img_file = $path.'/images/fondo_pdf.png';
        $this->Image($img_file, 10, 100, 190, 85, '', '', '', false, 300, '', false, false, 0);
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



    public function exportarPDFVentasCanceladas(){


require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/vendedores.controlador.php";
require_once "../../../modelos/vendedores.modelo.php";

//TRAEMOS LA INFORMACIÓN DE LA VENTA


$no_rango = $this->no_rango;

$rango_fecha = $this->rango_fecha;
$id_sucursal = $this->id_sucursal;

$nombre_sucursal = $this->nombre_sucursal;



    $mes1 = substr( $rango_fecha, 0, 2 );
    $dia1 = substr( $rango_fecha, 3, 2 );
    $ano1 = substr( $rango_fecha, 6, 4 );
    $fecha1 = $ano1 ."-". $mes1 ."-". $dia1;

    $mes2 = substr( $rango_fecha, 13, 2 );
    $dia2 = substr( $rango_fecha, 16, 2 );
    $ano2 = substr( $rango_fecha, 19, 4 );
    $fecha2 = $ano2 ."-". $mes2 ."-". $dia2;



    if($id_sucursal !== "0"){
                    $sql_id_sucursal = " AND ventas.id_sucursal = ".$id_sucursal;
                }else{
                    $sql_id_sucursal = "";
                }


            

    switch ($no_rango) {

    case 1:

    $dia = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59' ;

    //$fecha1 = date("Y/m/d", strtotime("today"));
    //$fecha2 = date("Y/m/d", strtotime("today"));





    $sql = "SELECT * FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.cancelada = 1 AND ventas.id_sucursal = $id_sucursal ORDER BY ventas.id DESC";

    break;

    case 2:

    $dia = date("Y-m-d", strtotime("yesterday"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59' ;





    $sql = "SELECT * FROM ventas WHERE Date(fecha_creacion) BETWEEN '$fecha1' AND '$fecha2' AND ventas.cancelada = 1 AND ventas.id_sucursal = $id_sucursal ORDER BY ventas.id DESC";
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


    $sql = "SELECT * FROM ventas WHERE Date(fecha_creacion) BETWEEN '$fecha1' AND '$fecha2' AND ventas.cancelada = 1 AND ventas.id_sucursal = $id_sucursal ORDER BY ventas.id DESC";

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

    $sql = "SELECT * FROM ventas WHERE Date(fecha_creacion) BETWEEN '$fecha1' AND '$fecha2' AND ventas.cancelada = 1 AND ventas.id_sucursal = $id_sucursal ORDER BY ventas.id DESC";

    break;

    case 5:
    $dia1 = date("Y-m-d", strtotime("today - 6 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    $sql = "SELECT * FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.cancelada = 1 AND ventas.id_sucursal = $id_sucursal ORDER BY ventas.id DESC";
    break;

    case 6:
    $dia1 = date("Y-m-d", strtotime("today - 29 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    $sql = "SELECT * FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.cancelada = 1 AND ventas.id_sucursal = $id_sucursal ORDER BY ventas.id DESC";

    break;

    case 7:

    $dia1 = date("Y-m-d", strtotime("first day of this month"));
    $dia2 = date("Y-m-d", strtotime("last day of this month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;


    $sql = "SELECT * FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.cancelada = 1 AND ventas.id_sucursal = $id_sucursal ORDER BY ventas.id DESC";

    break;

    case 8:

    $dia1 = date("Y-m-d", strtotime("first day of last month"));
    $dia2 = date("Y-m-d", strtotime("last day of last month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    $sql = "SELECT * FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.cancelada = 1 AND ventas.id_sucursal = $id_sucursal ORDER BY ventas.id DESC";

    break;

    case 9:

    $fecha1 = $fecha1 . ' 00:00:00';
    $fecha2 = $fecha2 . ' 23:59:59' ;

    $sql = "SELECT * FROM ventas WHERE fecha_creacion BETWEEN '$fecha1' AND '$fecha2' AND ventas.cancelada = 1 AND ventas.id_sucursal = $id_sucursal ORDER BY ventas.id DESC";


    break;
    
}

//echo $sql;

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

if($id_sucursal == "0"){
                    $td_encabezado = '<td style="border: 1px solid black; width:150x; text-align:center; font-weight:bold;">Sucursal</td>';
                }else{
                    $td_encabezado = '';
                }

$bloque1 = <<<EOF


    <table style=style="border: 1px solid black; font-size:12px;">
<tr>
<td style="border: 1px solid black; width:40px; text-align:center; font-weight:bold;">ID</td>
<td style="border: 1px solid black; width:60px; text-align:center; font-weight:bold;">Folios</td>
<td style="border: 1px solid black; width:125px; text-align:center; font-weight:bold;">Fecha</td>
<td style="border: 1px solid black; width:50px; text-align:center; font-weight:bold;">Tipo venta</td>
<td style="border: 1px solid black; width:90px; text-align:right; font-weight:bold;">Total</td>
<td style="border: 1px solid black; width:150px; text-align:center; font-weight:bold;">Cliente</td>
<td style="border: 1px solid black; width:150px; text-align:center; font-weight:bold;">Vendedor</td>
$td_encabezado


</tr>
</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$total_ventas_acumulado = 0;
//$total_utilidad_acumulado = 0;

while($row = $rs->fetch_array(MYSQLI_BOTH)){

    

    $id_venta = $row['id'];

    $total = number_format($row['total'], 2);

    $traerCliente = ControladorClientes::ctrMostrarCliente($row['id_cliente']);

    $traerVendedor = ControladorVendedores::ctrMostrarVendedor2($row['id_vendedor']);



    $traerSucursal = ControladorSucursales::ctrMostrarSucursal($row['id_sucursal']);


    $total_ventas_acumulado = $total_ventas_acumulado + $row['total'];


    if($id_sucursal == "0"){
                    $td_cuerpo = '<td style="border: 1px solid black; width:150px; text-align:center">'.$traerSucursal['nombre'] .'</td>';
                }else{
                    $td_cuerpo = '';
                }




    /*$sql2 = "SELECT productos.id_producto, productos.clave_producto, Sum(partvta.cantidad) AS cantidad_vendida, Sum(partvta.cantidad * partvta.precio_neto) AS total_ventas, Sum(partvta.cantidad*partvta.precio_compra) AS total_precio_compra, (Sum(partvta.cantidad * partvta.precio_neto)-Sum(partvta.cantidad*partvta.precio_compra)) AS total_utilidad FROM ventas INNER JOIN (partvta INNER JOIN productos ON partvta.id_producto = productos.id_producto) ON ventas.id = partvta.id_venta WHERE ventas.id = $id_venta GROUP BY productos.id_producto, productos.clave_producto";

        //echo $sql2;

        $rs2 = $conexion->query($sql2);  

$utilidad_venta = 0;

    while($row2 = $rs2->fetch_array(MYSQLI_BOTH)){  

        $utilidad_venta = $utilidad_venta + $row2['total_utilidad'];
    }

    $utilidad_venta = number_format($utilidad_venta, 2);

    $total_utilidad_acumulado = $total_utilidad_acumulado + $utilidad_venta;*/
$bloque2 = <<<EOF



    <table style="border: 1px solid black; font-size:11px;">


    
        <tr>
        
            <td style="border: 1px solid black; width:40px; text-align:center;">$row[id]</td>

            <td style="border: 1px solid black; width:60px; text-align:center;">$row[folio]</td>

            <td style="border: 1px solid black; width:125px; text-align:center;">$row[fecha_creacion]</td>

            <td style="border: 1px solid black; width:50px; text-align:center;">$row[tipo_venta]</td>
            
            <td style="border: 1px solid black; width:90px; text-align:right;">$$total</td>

            <td style="border: 1px solid black; width:150px; text-align:center;">$traerCliente[nombre]</td>

            <td style="border: 1px solid black; width:150px; text-align:center;">$traerVendedor[nombres]</td>

            $td_cuerpo

            
            

        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}



// ---------------------------------------------------------


$total_ventas_acumulado = number_format($total_ventas_acumulado,2);
//$total_utilidad_acumulado = number_format($total_utilidad_acumulado,2);

            


$bloque3 = <<<EOF

    <table style="font-size:12px;">


    
        <tr>

        <td style="border: 1px solid black; width:275px; text-align:right; font-weight:bold;">TOTAL:</td>

            <td style="border: 1px solid black; width:90px; text-align:right; font-weight:bold;">$$total_ventas_acumulado</td>
        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

//Close and output PDF document
/*if($id_sucursal !== "0"){
    $pdf->Output('ventas canceladas de la '.$traerSucursal['nombre'].' '.date('d-m-Y').'.pdf', 'D');
}else{*/
    $pdf->Output('ventas canceladas en general '.date('d-m-Y').'.pdf', 'D'); 
//}


//============================================================+
// END OF FILE
//============================================================+



}
}






$ventas_sucursales = new MYPDF();
$ventas_sucursales -> no_rango = $_GET["no_rango"];
$ventas_sucursales -> id_sucursal = $_GET["id_sucursal"];
if(isset($_GET['rango_fecha'])){
    $ventas_sucursales -> rango_fecha = $_GET['rango_fecha'];
}
$ventas_sucursales -> exportarPDFVentasCanceladas();




