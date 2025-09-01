<?php

error_reporting(0);

require_once "conexion.php";

$no_rango = $_GET['no_rango'];
$id_proveedor = $_GET['id_proveedor'];

if($no_rango == "" || $id_proveedor == ""){
        return;
    
    }

if(isset($_GET['rango_fecha'])){
        $rango_fecha = $_GET['rango_fecha'];
        $fecha1 = substr( $rango_fecha, 0, 10 );
        $fecha2 = substr( $rango_fecha, 13, 22 );
    }

    if($id_proveedor !== "0"){
                    $sql_id_proveedor = " AND COMPRA.IDPROVEEDOR = ".$id_proveedor;
                }



    switch ($no_rango) {
    case 1:

                $sql = "SELECT COMPRA.*, VENDEDOR.VENDEDOR, PROVEED.NOMBRE
FROM (COMPRA INNER JOIN VENDEDOR ON COMPRA.IDVENDEDOR = VENDEDOR.IDVENDEDOR) INNER JOIN PROVEED ON COMPRA.IDPROVEEDOR = PROVEED.IDPROVEEDOR WHERE Format( F_EMISION,'Short Date') = Date()".$sql_id_proveedor."";
                

        break;
    case 2:
                $sql = "SELECT COMPRA.*, VENDEDOR.VENDEDOR, PROVEED.NOMBRE
FROM (COMPRA INNER JOIN VENDEDOR ON COMPRA.IDVENDEDOR = VENDEDOR.IDVENDEDOR) INNER JOIN PROVEED ON COMPRA.IDPROVEEDOR = PROVEED.IDPROVEEDOR WHERE Format( F_EMISION,'Short Date') = Date()-1".$sql_id_proveedor."";

        break;
    case 3:

    $sql = "SELECT COMPRA.*, VENDEDOR.VENDEDOR, PROVEED.NOMBRE
FROM (COMPRA INNER JOIN VENDEDOR ON COMPRA.IDVENDEDOR = VENDEDOR.IDVENDEDOR) INNER JOIN PROVEED ON COMPRA.IDPROVEEDOR = PROVEED.IDPROVEEDOR WHERE DATEDIFF('d',F_EMISION,now())<=6".$sql_id_proveedor."";


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



			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = 'compras.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");


echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>ID COMPRA</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PROVEEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>RESPONSABLE</td>
					</tr>");

/*$respuesta = odbc_fetch_array($stmt); 

var_dump($respuesta);*/

$total = 0;

while ( $row = odbc_fetch_array($stmt) ) { 

$total_brut = number_format($row[TOTAL_BRUT],2);

$total = $total + $row[TOTAL_BRUT];


$sql2 = "SELECT PARTCPA.IDCOMPRA, PARTCPA.CLAVE_ART, ARTICULO.DESCRIP, PARTCPA.CANTIDAD FROM ARTICULO INNER JOIN PARTCPA ON ARTICULO.CLAVE_ART = PARTCPA.CLAVE_ART
        WHERE (((PARTCPA.IDCOMPRA)=".$row[IDCOMPRA]."))";
            
        
        
    $rs2 = odbc_exec( $con, $sql2 );


			//foreach ($respuesta as $row => $item){

			 echo"<tr>
			 			<td style='border:1px solid #eee;'>$row[IDCOMPRA]</td> 
			 			<td style='border:1px solid #eee;'>$row[F_EMISION]</td>
			 			<td style='border:1px solid #eee;'>";

			 			while ( $row2 = odbc_fetch_array($rs2) ) { 
                            
                            echo $row2['CLAVE_ART'].' --- '.$row2['DESCRIP'].' --- Cantidad: '.number_format($row2['CANTIDAD'],0).'<br>';
                        }

			 			echo "</td>
			 			<td style='border:1px solid #eee;'>$$total_brut</td>
			 			<td style='border:1px solid #eee;'>$row[NOMBRE]</td>
			 			<td style='border:1px solid #eee;'>$row[VENDEDOR]</td></tr>";


			}

			$total = number_format($total,2);

			echo '<tr><td colspan="5" style="font-weight:bold; border:1px solid #eee; text-align:right;">TOTAL</td>
			<td style="font-weight:bold; border:1px solid #eee;">$'.$total.'</td></tr>';



?>
  
</table>





























































<?php

error_reporting(0);


class ComprasPDF{

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


    /*if($no_rango == "" || $id_proveedor == ""){
        return;
    
    }*/


    

    if($id_proveedor !== "0"){
                    $sql_id_proveedor = " AND COMPRA.IDPROVEEDOR = ".$id_proveedor;
                }




    switch ($no_rango) {
        case 1:

            $sql = "SELECT COMPRA.*, VENDEDOR.VENDEDOR, PROVEED.NOMBRE FROM (COMPRA INNER JOIN VENDEDOR ON COMPRA.IDVENDEDOR = VENDEDOR.IDVENDEDOR) INNER JOIN PROVEED ON COMPRA.IDPROVEEDOR = PROVEED.IDPROVEEDOR WHERE Format( F_EMISION,'Short Date') = Date()".$sql_id_proveedor."";
        break;
        case 2:
            $sql = "SELECT COMPRA.*, VENDEDOR.VENDEDOR, PROVEED.NOMBRE FROM (COMPRA INNER JOIN VENDEDOR ON COMPRA.IDVENDEDOR = VENDEDOR.IDVENDEDOR) INNER JOIN PROVEED ON COMPRA.IDPROVEEDOR = PROVEED.IDPROVEEDOR WHERE Format( F_EMISION,'Short Date') = Date()-1".$sql_id_proveedor."";
        break;
        case 3:

    $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DATEDIFF('d',VENTAS.FECHA,now())<=6".$sql_id_proveedor.$sql_tipo." AND VENTAS.COBRADA = true";


        break;
        case 4:

    $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DATEDIFF('d',VENTAS.FECHA,now())<=29".$sql_id_proveedor.$sql_tipo." AND VENTAS.COBRADA = true";
          
        break;
    case 5:
    

    $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Year(VENTAS.FECHA) = Year(Now()) AND Month(VENTAS.FECHA) = Month(Now())".$sql_id_proveedor.$sql_tipo." AND VENTAS.COBRADA = true";
            
        break;
    case 6:

    $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE Year(VENTAS.FECHA)* 12 + DatePart('m', VENTAS.FECHA) = Year(Date())* 12 + DatePart('m', Date()) - 1".$sql_id_proveedor.$sql_tipo." AND VENTAS.COBRADA = true";
             
        break;

        case 7:
        

    $sql = "SELECT VENTAS.*, SUCURSAL.NOMBRE FROM VENTAS INNER JOIN SUCURSAL ON VENTAS.IDSUCURSAL = SUCURSAL.IDSUCURSAL WHERE DateValue(Format(VENTAS.FECHA,'dd/mm/yyyy')) BETWEEN #$fecha1# AND #$fecha2#".$sql_id_proveedor.$sql_tipo." AND VENTAS.COBRADA = true";
           

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
            
            <td style="width:75px"><img src="images/logo.jpeg"></td>

    



            <td style="background-color:white; width:400px; text-align:center; color:black"><br><br><br>Compras</td>

        </tr>

    </table>


    <table style="font-size:10px;">
<tr>
<td style="width:85px; text-align:left" font-weight:bold;>ID</td>
<td style="width:65px; text-align:left" font-weight:bold;>Fecha</td>
<td style="width:65px; text-align:left" font-weight:bold;>Total</td>
<td style="width:100px; text-align:center" font-weight:bold;>Proveedor</td>
</tr>
</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------
$total = 0;
 while ($respuesta = odbc_fetch_array($stmt)) { 
$total_brut = number_format($respuesta['TOTAL_BRUT'], 2);
$total = $total + $respuesta['TOTAL_BRUT'];

$bloque2 = <<<EOF



    <table style="font-size:9px;">


    
        <tr>
        
            <td style="width:50px; text-align:center">

                $respuesta[IDCOMPRA]

            </td>

            <td style="width:100px; text-align:center">
            
                $respuesta[F_EMISION] 

            </td>
            <td style="width:55px; text-align:center">
            
                $total_brut

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

$pdf->Output('compras.pdf', 'D');

}

}

$compras = new ComprasPDF();
$compras -> no_rango = $_GET["no_rango"];
$compras -> id_proveedor = $_GET["id_proveedor"];
if(isset($_GET['rango_fecha'])){
    $compras -> rango_fecha = $_GET['rango_fecha'];
    
}
$compras -> exportarPDFCompras();




?>