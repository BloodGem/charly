<?php 
//error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../controladores/vendedores.controlador.php";
require_once "../../../modelos/vendedores.modelo.php";



//require_once "conexion.php";


$id_corte_caja = $_POST["id_corte_caja"];

//var_dump($id_resurtido);
    
$ventas_corte_caja = ModeloVentas::mdlMostrarVentasCorteCaja($id_corte_caja);

echo '<center><button class="btn-sm btn-warning" id="btnExportarEXCELVentasCorteCaja" id_corte_caja="'.$id_corte_caja.'">EXCEL</button></center>
<table class="table-sm table-responsive table-bordered table-hover" id="tablaVentasCorteCaja">
            <thead>
                  <tr>
                    <th>Id venta</th>
                    <th>Folio</th>
                    <th>Fecha</th>
                    <th>Tipo de venta</th>
                    <th style="text-align: right;">Total</th>
                    <th style="text-align: right;">Dinero</th>
                    <th style="text-align: right;">Efectivo</th>
                    <th style="text-align: right;">Débito</th>
                    <th style="text-align: right;">Crédito</th>
                    <th style="text-align: right;">Transferencia</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                  </tr>
                  </thead>
                  <tbody>';
                  
    $total_ventas_acumulado = 0;
    foreach ($ventas_corte_caja as $key => $row) {

      $traerCliente = ControladorClientes::ctrMostrarCliente($row['id_cliente']);

      $traerVendedor = ControladorVendedores::ctrMostrarVendedor2($row['id_vendedor']);


      $total_ventas_acumulado = $total_ventas_acumulado + $row["total"];

        echo '<tr>
    

    <td>
    '.$row["id"].'
    </td>
    <td>
    '.$row["folio"].'
    </td>
    <td>
    '.$row["fecha_creacion"].'
    </td>
    <td>'.$row["tipo_venta"].'</td>
    <td style="text-align: right;">$'.number_format($row["total"],2).'</td>
    <td style="text-align: right;">$'.number_format($row["dinero"],2).'</td>
    <td style="text-align: right;">$'.number_format($row["efectivo"],2).'</td>
    <td style="text-align: right;">$'.number_format($row["tarjeta_debito"],2).'</td>
    <td style="text-align: right;">$'.number_format($row["tarjeta_credito"],2).'</td>
    <td style="text-align: right;">$'.number_format($row["transferencia"],2).'</td>
    <td>'.$traerCliente["nombre"].'</td>
    <td>'.$traerVendedor["nombres"].'</td>';
    }


echo '</tbody>
                  <tfoot>
                  <tr>
                    <th>Id venta</th>
                    <th>Folio</th>
                    <th>Fecha</th>
                    <th>Tipo de venta</th>
                    <th style="text-align: right;">Total</th>
                    <th style="text-align: right;">Dinero</th>
                    <th style="text-align: right;">Efectivo</th>
                    <th style="text-align: right;">Débito</th>
                    <th style="text-align: right;">Crédito</th>
                    <th style="text-align: right;">Transferencia</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                  </tr>
                  </tfoot>
        </table>

        <br><br>

        <h1>Total ventas = $'.number_format($total_ventas_acumulado, 2).'</h1>';


