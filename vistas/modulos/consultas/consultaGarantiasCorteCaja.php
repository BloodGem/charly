<?php 
//error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/garantias.controlador.php";
require_once "../../../modelos/garantias.modelo.php";
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";


//require_once "conexion.php";


$id_corte_caja = $_POST["id_corte_caja"];

//var_dump($id_resurtido);
    
$traerGarantiasCorteCaja = ModeloGarantias::mdlMostrarGarantiasCorteCaja($id_corte_caja);

echo '<center><button class="btn-sm btn-warning" id="btnExportarEXCELGarantiasCorteCaja" id_corte_caja="'.$id_corte_caja.'">EXCEL</button></center>
<table class="table table-responsive table-bordered table-hover" id="tablaGarantiasCorteCaja">
            <thead>
                  <tr>
                    <th>Id Grantía</th>
<th>Fecha</th>
<th>Total</th>
<th>Cliente</th>
<th>IdVenta</th>
<th>Folio</th>
                  </tr>
                  </thead>
                  <tbody>';
                  
    $total_garantias_acumulado = 0;

foreach ($traerGarantiasCorteCaja as $key2 => $row) {

    $traerVenta = ControladorVentas::ctrMostrarVenta($row['id_venta']);

    $total_garantias_acumulado = $total_garantias_acumulado + $row['total'];



    echo '<tr>
    <td>'.$row["id_garantia"].'</td>
    <td>'.$row["fecha_asignacion"].'</td>
    <td>$'.number_format($row["total"],2).'</td>
    <td>'.$row["nombre_cliente"].'</td>
    <td>'.$row["id_venta"].'</td>
    <td>'.$traerVenta["folio"].'</td>
    </tr>';
    }


echo '</tbody>
                  <tfoot>
                  <tr>
                    <th>Id Grantía</th>
<th>Fecha</th>
<th>Total</th>
<th>Cliente</th>
<th>IdVenta</th>
<th>Folio</th>
                  </tr>
                  </tfoot>
        </table>

        <br><br>

        <h1>Total garantias = $'.number_format($total_garantias_acumulado, 2).'</h1>';


