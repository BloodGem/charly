<?php

error_reporting(0);
date_default_timezone_set('America/Mazatlan');
session_start();

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirNota{

public $id_venta;

public function traerImpresionNota(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$columnaVenta = "id";
$id_venta = $this->id_venta;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($columnaVenta, $id_venta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);
$total = number_format($respuestaVenta["total"],2);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$columnaCliente = "id_cliente";
$id_cliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($columnaCliente, $id_cliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$columnaVendedor = "id";
$id_vendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($columnaVendedor, $id_vendedor);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

    <table>
        
        <tr>
            
            <td style="width:100px"><img src="images/Aries.jpeg"></td>

            <td style="background-color:white; width:140px">
                
                <div style="font-size:8.5px; text-align:right; line-height:15px;">
                    
                    <br>
                    RFC: XXXXXXXXXXXXX

                    <br>
                    Dirección: Calle XXXXX

                </div>

            </td>

            <td style="background-color:white; width:140px">

                <div style="font-size:8.5px; text-align:right; line-height:15px;">
                    
                    <br>
                    Teléfono: 56-11-11-88-50
                    
                    <br>
                    soporte@emsystem.xyz

                </div>
                
            </td>
            <td style="background-color:white; width:120px">

                <div style="font-size:15px; text-align:center; line-height:15px; color:red">
                    <br><br>Venta NO.<br>$id_venta
                </div>
                
            </td>

        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

    <table>
        
        <tr>
            
            <td style="width:540px"><img src="images/back.jpg"></td>
        
        </tr>

    </table>

    <table style="font-size:10px; padding:5px 10px;">
    
        <tr>
        
            <td style="border: 1px solid #666; background-color:white; width:390px">

                Cliente: $respuestaCliente[nombre]

            </td>

            <td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
            
                Fecha: $fecha

            </td>

        </tr>

        <tr>
        
            <td style="border: 1px solid #666; background-color:white; width:540px">Vendedor: $respuestaVendedor[nombre]</td>

        </tr>

        <tr>
        
        <td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

    <table style="font-size:10px; padding:5px 10px;">

        <tr>
        
        <td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Producto</td>
        <td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
        <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
        <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>

        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

$valorUnitario = number_format($item['precio'], 2);

$precioTotal = number_format($item["total"], 2);

$bloque4 = <<<EOF

    <table style="font-size:10px; padding:5px 10px;">

        <tr>
            
            <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
                $item[descripcion]
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
                $item[cantidad]
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
                $valorUnitario
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
                $precioTotal
            </td>


        </tr>

    </table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque5 = <<<EOF

    <table style="font-size:10px; padding:5px 10px;">

        <tr>

            <td style="color:#333; background-color:white; width:340px; text-align:center"></td>

            <td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

            <td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

        </tr>
        
        
        <tr>
        
            <td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

            <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
                Total:
            </td>
            
            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
                $ $total
            </td>

        </tr>


    </table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('factura.pdf', 'D');

}

}

$notaVenta = new imprimirNota();
$notaVenta -> id_venta = $_GET["id_venta"];
$notaVenta -> traerImpresionNota();

?>