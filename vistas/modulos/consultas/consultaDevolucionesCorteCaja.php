<?php 
error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/devoluciones.controlador.php";
require_once "../../../modelos/devoluciones.modelo.php";
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";


//require_once "conexion.php";


$id_corte_caja = $_POST["id_corte_caja"];

//var_dump($id_resurtido);
    
$traerDevolucionesCorteCaja = ModeloDevoluciones::mdlMostrarDevolucionesCorteCaja($id_corte_caja);

echo '<center><button class="btn-sm btn-warning" id="btnExportarEXCELDevolucionesCorteCaja" id_corte_caja="'.$id_corte_caja.'">EXCEL</button></center>
<table class="table table-responsive table-bordered table-hover" id="tablaDevolucionesCorteCaja">
            <thead>
                  <tr>
                    <th>IdDevol.</th>
<th>Fecha</th>
<th>Total</th>
<th>Cliente</th>
<th>IdVenta</th>
<th>Folio</th>
                  </tr>
                  </thead>
                  <tbody>';
                  
    $total_devoluciones_acumulado = 0;

foreach ($traerDevolucionesCorteCaja as $key2 => $row) {

    $traerVenta = ControladorVentas::ctrMostrarVenta($row['id_venta']);

    $traerCliente = ControladorClientes::ctrMostrarCliente($row['id_cliente']);


    $total_devoluciones_acumulado = $total_devoluciones_acumulado + $row['total'];



    echo '<tr>
    <td>'.$row["id_devolucion"].'</td>
    <td>'.$row["fecha_creacion"].'</td>
    <td>$'.number_format($row["total"],2).'</td>
    <td>'.$traerCliente["nombre"].'</td>
    <td>'.$row["id_venta"].'</td>
    <td>'.$traerVenta["folio"].'</td>
    </tr>';
    }


echo '</tbody>
                  <tfoot>
                  <tr>
                    <th>IdDevol.</th>
<th>Fecha</th>
<th>Total</th>
<th>Cliente</th>
<th>IdVenta</th>
<th>Folio</th>
                  </tr>
                  </tfoot>
        </table>

        <br><br>

        <h1>Total devoluciones = $'.number_format($total_devoluciones_acumulado, 2).'</h1>';


