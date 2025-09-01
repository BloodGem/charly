<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();


class comprasPDF{

public $no_rango;

public $rango_fecha;

public $id_proveedor;

public function exportarPDFCompras(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA


$no_rango = $this->no_rango;

$rango_fecha = $this->rango_fecha;

$id_proveedor = $this->id_proveedor;

$fecha1 = substr( $rango_fecha, 0, 10 );
$fecha2 = substr( $rango_fecha, 13, 22 );

require_once "conexion.php";


    if($id_proveedor !== "0"){
        $sql_id_proveedor = " AND COMPRA.IDPROVEEDOR = ".$id_proveedor;
    }



    switch ($no_rango) {
    case 1:

                $sql = "SELECT COMPRA.*, VENDEDOR.VENDEDOR, PROVEED.NOMBRE
FROM (COMPRA INNER JOIN VENDEDOR ON COMPRA.IDVENDEDOR = VENDEDOR.IDVENDEDOR) INNER JOIN PROVEED ON COMPRA.IDPROVEEDOR = PROVEED.IDPROVEEDOR WHERE Format( F_EMISION,'Short Date') = Date()".$sql_id_proveedor."";
                

        break;
    case 2:
$sql = "SELECT COMPRA.*, VENDEDOR.VENDEDOR, PROVEED.NOMBRE FROM (COMPRA INNER JOIN VENDEDOR ON COMPRA.IDVENDEDOR = VENDEDOR.IDVENDEDOR) INNER JOIN PROVEED ON COMPRA.IDPROVEEDOR = PROVEED.IDPROVEEDOR WHERE Format( F_EMISION,'Short Date') = Date()-1".$sql_id_proveedor."";
    

        break;
    case 3:

    $sql = "SELECT COMPRA.*, VENDEDOR.VENDEDOR, PROVEED.NOMBRE
FROM (COMPRA INNER JOIN VENDEDOR ON COMPRA.IDVENDEDOR = VENDEDOR.IDVENDEDOR) INNER JOIN PROVEED ON COMPRA.IDPROVEEDOR = PROVEED.IDPROVEEDOR WHERE DATEDIFF('d',F_EMISION,now())<=6".$sql_id_proveedor."";

    //var_dump($sql);
        break;
        case 4:

    $sql = "SELECT COMPRA.*, VENDEDOR.VENDEDOR, PROVEED.NOMBRE
FROM (COMPRA INNER JOIN VENDEDOR ON COMPRA.IDVENDEDOR = VENDEDOR.IDVENDEDOR) INNER JOIN PROVEED ON COMPRA.IDPROVEEDOR = PROVEED.IDPROVEEDOR WHERE DATEDIFF('d',F_EMISION,now())<=29".$sql_id_proveedor."";
          
        break;
    case 5:
    

    $sql = "SELECT COMPRA.*, VENDEDOR.VENDEDOR, PROVEED.NOMBRE
FROM (COMPRA INNER JOIN VENDEDOR ON COMPRA.IDVENDEDOR = VENDEDOR.IDVENDEDOR) INNER JOIN PROVEED ON COMPRA.IDPROVEEDOR = PROVEED.IDPROVEEDOR WHERE Year(F_EMISION) = Year(Now()) AND Month(F_EMISION) = Month(Now())".$sql_id_proveedor."";
            
        break;
    case 6:

    $sql = "SELECT COMPRA.*, VENDEDOR.VENDEDOR, PROVEED.NOMBRE
FROM (COMPRA INNER JOIN VENDEDOR ON COMPRA.IDVENDEDOR = VENDEDOR.IDVENDEDOR) INNER JOIN PROVEED ON COMPRA.IDPROVEEDOR = PROVEED.IDPROVEEDOR WHERE Year(F_EMISION)COMPRA.*, VENDEDOR.VENDEDOR 12 + DatePart('m', F_EMISION) = Year(Date())COMPRA.*, VENDEDOR.VENDEDOR 12 + DatePart('m', Date()) - 1".$sql_id_proveedor."";
             
        break;

        case 7:
        

    $sql = "SELECT COMPRA.*, VENDEDOR.VENDEDOR, PROVEED.NOMBRE
FROM (COMPRA INNER JOIN VENDEDOR ON COMPRA.IDVENDEDOR = VENDEDOR.IDVENDEDOR) INNER JOIN PROVEED ON COMPRA.IDPROVEEDOR = PROVEED.IDPROVEEDOR WHERE DateValue(Format(F_EMISION,'dd/mm/yyyy')) BETWEEN #$fecha1# AND #$fecha2#".$sql_id_proveedor."";
           

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
            

    



            <td style="background-color:white; width:575px; text-align:center; color:black"><br><br><br>COMPRAS</td>

        </tr>

    </table>


    <table style="font-size:10px;">
<tr>
<td style="width:30px; text-align:center" font-weight:bold;>ID</td>
<td style="width:100px; text-align:center" font-weight:bold;>Fecha</td>
<td style="width:200px; text-align:center" font-weight:bold;>Productos</td>
<td style="width:75px; text-align:center" font-weight:bold;>Total</td>
<td style="width:85px; text-align:center" font-weight:bold;>Proveedor</td>
</tr>
</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------
$total = 0;
 while ($respuesta = odbc_fetch_array($stmt)) { 

    //var_dump($respuesta);

$total_brut = number_format($respuesta['TOTAL_BRUT'], 2);
$total = $total + $respuesta['TOTAL_BRUT'];

$nombre = mb_convert_encoding($respuesta[NOMBRE], "UTF-8", "iso-8859-1");



$sql2 = "SELECT PARTCPA.IDCOMPRA, PARTCPA.CLAVE_ART, ARTICULO.DESCRIP, PARTCPA.CANTIDAD FROM ARTICULO INNER JOIN PARTCPA ON ARTICULO.CLAVE_ART = PARTCPA.CLAVE_ART
        WHERE (((PARTCPA.IDCOMPRA)=".$respuesta[IDCOMPRA]."))";
            
        
        
    $rs2 = odbc_exec( $con, $sql2 );

    $productos = "";
    while ( $row2 = odbc_fetch_array($rs2) ) { 

        $descripcion = mb_convert_encoding($row2[DESCRIP], "UTF-8", "iso-8859-1");

                            
                            $productos = $productos.$row2['CLAVE_ART'].' --- '.$descripcion.' --- Cantidad: '.number_format($row2['CANTIDAD'],0).'<br><br>';
                        }

                        //var_dump($productos);
                        

$bloque2 = <<<EOF



    <table style="font-size:9px;">


    
        <tr>
        
            <td style="width:30px; text-align:center">

                $respuesta[IDCOMPRA]

            </td>

            <td style="width:100px; text-align:center">
            
                $respuesta[F_EMISION] 

            </td>
            <td style="width:200px; text-align:left">
            
                $productos

            </td>
            <td style="width:70px; text-align:center">
            
                $$total_brut

            </td>
            <td style="width:200px; text-align:left">
            
                $nombre

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

        <td style="width:420px; text-align:right;">

            </td>
        
            <td style="width:55px; text-align:left; font-weight:bold;">

                TOTAL

            </td>

            <td style="width:100px; text-align:left; font-weight:bold;">
            
                $ $total_formateado

            </td>
        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('compras.pdf', 'D');

}

}

$compras = new comprasPDF();
$compras -> no_rango = $_GET["no_rango"];
$compras -> id_proveedor = $_GET["id_proveedor"];
if(isset($_GET['rango_fecha'])){
    $compras -> rango_fecha = $_GET['rango_fecha'];
    
}
$compras -> exportarPDFCompras();




?>