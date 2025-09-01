<?php

error_reporting(0);


class ventasTipoPDF{

public $no_rango;

public $tipo;

public $rango_fecha;

public $id_sucursal;

public function exportarPDFVentasTipo(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA


$no_rango = $this->no_rango;

$tipo = $this->tipo;

$rango_fecha = $this->rango_fecha;

$id_sucursal = $this->id_sucursal;

$fecha1 = substr( $rango_fecha, 0, 10 );
$fecha2 = substr( $rango_fecha, 13, 22 );

require_once "conexion.php";


    if($tipo == "" || $no_rango == "" || $id_sucursal == ""){
        return;
    
    }


    

    if($id_sucursal !== "0"){
                    $sql_id_sucursal = " AND SUCURSAL.IDSUCURSAL = ".$id_sucursal;
                }


                if($tipo == "FN"){
                    $sql_tipo = " AND VENTAS.IDTIPO = 'FN'";
                }elseif($tipo == "NA"){
                    $sql_tipo = " AND VENTAS.IDTIPO = 'NA'";
                }

    switch ($no_rango) {
    case 1:

                $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Format( VENTAS.FECHA,'Short Date') = Date()".$sql_id_sucursal.$sql_tipo." AND VENTAS.COBRADA = true";
                

        break;
    case 2:
                $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Format( VENTAS.FECHA,'Short Date') = Date()-1".$sql_id_sucursal.$sql_tipo." AND VENTAS.COBRADA = true";
        break;
    case 3:

    $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DATEDIFF('d',VENTAS.FECHA,now())<=6".$sql_id_sucursal.$sql_tipo." AND VENTAS.COBRADA = true";


        break;
        case 4:

    $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DATEDIFF('d',VENTAS.FECHA,now())<=29".$sql_id_sucursal.$sql_tipo." AND VENTAS.COBRADA = true";
          
        break;
    case 5:
    

    $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Year(VENTAS.FECHA) = Year(Now()) AND Month(VENTAS.FECHA) = Month(Now())".$sql_id_sucursal.$sql_tipo." AND VENTAS.COBRADA = true";
            
        break;
    case 6:

    $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Year(VENTAS.FECHA)* 12 + DatePart('m', VENTAS.FECHA) = Year(Date())* 12 + DatePart('m', Date()) - 1".$sql_id_sucursal.$sql_tipo." AND VENTAS.COBRADA = true";
             
        break;

        case 7:
        

    $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DateValue(Format(VENTAS.FECHA,'dd/mm/yyyy')) BETWEEN #$fecha1# AND #$fecha2#".$sql_id_sucursal.$sql_tipo." AND VENTAS.COBRADA = true";
           

        break;
    
}
        

        $stmt = odbc_exec( $con, $sql );





//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

    <table>
        
        <tr>
            


            <td style="background-color:white; width:475px; text-align:center; color:black"><br><br><br>VENTAS POR TIPO</td>

        </tr>

    </table>


    <table style="font-size:10px;">
<tr>
<td style="width:85px; text-align:left" font-weight:bold;>ID venta</td>
<td style="width:65px; text-align:left" font-weight:bold;>Fecha</td>
<td style="width:70px; text-align:left" font-weight:bold;>Tipo venta</td>
<td style="width:65px; text-align:left" font-weight:bold;>Total</td>
<td style="width:100px; text-align:center" font-weight:bold;>Sucursal</td>
</tr>
</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------
$total = 0;
 while ($respuesta = odbc_fetch_array($stmt)) { 
$cobro = number_format($respuesta['COBRO'], 2);
$total = $total + $respuesta['COBRO'];

$bloque2 = <<<EOF



    <table style="font-size:9px;">


    
        <tr>
        
            <td style="width:50px; text-align:center">

                $respuesta[IDVENTA]

            </td>

            <td style="width:100px; text-align:center">
            
                $respuesta[FECHA] 

            </td>
            <td style="width:55px; text-align:center">
            
                $respuesta[IDTIPO] 

            </td>
            <td style="width:55px; text-align:center">
            
                $cobro

            </td>
            <td style="width:150px; text-align:center">
            
                $respuesta[NOMBRE]  

            </td>

        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}


// ---------------------------------------------------------


$total_formateado = number_format($total,2);




$bloque3 = <<<EOF



    <table style="font-size:10px;">


    
        <tr>

        <td style="width:210px; text-align:right;">

            </td>
        
            <td style="width:95px; text-align:left; font-weight:bold;">

                TOTAL

            </td>

            <td style="width:150px; text-align:left; font-weight:bold;">
            
                $ $total_formateado

            </td>
        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('ventas-tipo.pdf', 'D');

}

}

$ventas_tipo = new ventasTipoPDF();
$ventas_tipo -> no_rango = $_GET["no_rango"];
$ventas_tipo -> tipo = $_GET["tipo"];
$ventas_tipo -> id_sucursal = $_GET["id_sucursal"];
if(isset($_GET['rango_fecha'])){
    $ventas_tipo -> rango_fecha = $_GET['rango_fecha'];
    
}
$ventas_tipo -> exportarPDFVentasTipo();




?>