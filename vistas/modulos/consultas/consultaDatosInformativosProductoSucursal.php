<?php
//error_reporting(0);
session_start();
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/existencias-sucursales.controlador.php";
require_once "../../../modelos/existencias-sucursales.modelo.php";
require_once "../../../controladores/compras.controlador.php";
require_once "../../../modelos/compras.modelo.php";
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
$id_sucursal = $traerUsuario['id_sucursal'];

$id_producto = $_POST['id_producto'];

$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);

$traerUltimaCompraProducto = ControladorCompras::ctrMostrarUltimaCompraProducto($id_producto, $id_sucursal);


    /*$dateFechaUCP = date_create($traerUltimaCompraProducto["fecha_confirmacion"]);
    $fecha_ultima_compra = date_format($dateFechaUCP, 'd-m-Y');*/


    $traerPenultimaCompraProducto = ControladorCompras::ctrMostrarPenultimaCompraProducto($id_producto, $id_sucursal);


    /*$traerUltimaVentaProducto = ControladorVentas::ctrMostrarUltimaVentaProducto($id_producto, $id_sucursal);

    $dateFechaUVP = date_create($traerUltimaVentaProducto["fecha_creacion"]);
    $fecha_ultima_venta = date_format($dateFechaUVP, 'd-m-Y');*/


    $traerVentasProducto = ControladorVentas::ctrMostrarSumaVentasProductoRangoFechas(7, $id_producto, $id_sucursal);


echo'<div class="row">
	<div class="col-12">
		<div class="form-group">
	        <label>Fecha última compra:</label>
	        <input type="text" class="form-control" value="'.$traerProducto['fecha_ult_compra'].'" disabled>
	    </div>
    </div>
    <div class="col-lg-6 col-12">
    	<div class="form-group">
	        <label>Costo última compra C/IVA: </label>
	        <input type="text" class="form-control" value="$'.number_format(($traerUltimaCompraProducto['precio_unitario']*1.16), 2).'" disabled>
        </div>
    </div>

    <div class="col-lg-6 col-12">
    	<div class="form-group">
	        <label>Costo anterior compra C/IVA: </label>
	        <input type="text" class="form-control" value="$'.number_format(($traerPenultimaCompraProducto['precio_unitario']*1.16), 2).'" disabled>
        </div>
    </div>



    <div class="col-12">
    	<div class="form-group">
	        <label>Fecha última venta: </label>
	        <input type="text" class="form-control" value="'.$traerProducto['fecha_ult_venta'].'" disabled>
        </div>
    </div>
    <div class="col-lg-6 col-12">
    	<div class="form-group">
	        <label>Cantidad vendida (mes): </label>
	        <input type="text" class="form-control" value="'.$traerVentasProducto['cantidad_vendida'].'" disabled>
        </div>
    </div>

    <div class="col-lg-6 col-12">
    	<div class="form-group">
	        <label>Total ventas (mes): </label>
	        <input type="text" class="form-control" value="$'.$traerVentasProducto['total_ventas'].'" disabled>
    	</div>    
    </div>
</div>';

?>