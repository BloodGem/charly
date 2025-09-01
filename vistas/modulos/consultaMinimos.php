<?php 
session_start();
//error_reporting(0);
//require_once "../../modelos/conexion.php";
require_once "../../modelos/usuarios.modelo.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/resurtido.modelo.php";
//require_once "conexion.php";

$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
$id_sucursal = $traerUsuario['id_sucursal'];
$id_proveedor = $_POST["id_proveedor"];
$en_ceros = $_POST['en_ceros'];

if($en_ceros == 1){
    
    $traerProductosMinimos = ModeloResurtidos::mdlMostrarProductosProveedorResurtidoEnCeros($id_proveedor, $id_sucursal);

}else{

    $traerProductosMinimos = ModeloResurtidos::mdlMostrarProductosProveedorResurtido($id_proveedor, $id_sucursal);
   
}


/*echo $consultaMinimos;*/

/*$rsConsultaMinimos = $conexion->query($consultaMinimos);  

if($rsConsultaMinimos->fetch_array(MYSQLI_BOTH) !== null){

 while($resultadoConsultaMinimos = $rsConsultaMinimos->fetch_array(MYSQLI_BOTH)){ */

$conteo = 0;

foreach ($traerProductosMinimos as $key2 => $row) {

    $conteo = $conteo + 1;

    $total = $row['a_pedir'] * $row['precio_compra'];

    


	echo'<div class="row">
    <div class="col-1">
     <button type="button" class="btn btn-sm btn-danger quitarProducto" accesskey="q" tabindex="-1"><i class="fa fa-times"></i></button>
    </div>
		<div class="col-2">
            <input type="text" class="form-control form-control-sm nuevaClaveProducto" name="clave_producto" clave_producto="'.$row['clave_producto'].'" value="'.$row['clave_producto'].'" tabindex="-1" readonly>
        </div>
                              
        <div class="col-4">
            <input type="text" class="form-control form-control-sm nuevaDescripcionProducto" id_producto="'.$row['id_producto'].'" placeholder="" name="agregarProducto" descripcion_corta="'.$row['descripcion_corta'].'" value="'.$row['descripcion_corta'].'" tabindex="-1" readonly required>
        </div>
        <div class="col-1">
            <input type="text" style="text-align:right;" class="form-control form-control-sm PrecioCompraActual" name="precioCompraActual" min="1" precioCompraActual="'.$row['precio_compra'].'" value="'.$row['precio_compra'].'" tabindex="-1" readonly required>
        </div>
        <div class="col-1">
            <input type="number" class="form-control form-control-sm stockActual" name="stockActual" min="1" stockActual="'.$row['stock'].'" value="'.$row['stock'].'" tabindex="-1" readonly required>
        </div>
        <div class="col-1">
            <input type="number" class="form-control form-control-sm nivelMinimo" name="nivelMinimo" min="1" nivelMinimo="'.$row['nivel_minimo'].'" value="'.$row['nivel_minimo'].'" tabindex="-1" readonly required>
        </div>
        <div class="col-1">
            <input type="number" class="form-control form-control-sm nivelMaximo" name="nivelMaximo" min="1" nivelMaximo="'.$row['nivel_maximo'].'" value="'.$row['nivel_maximo'].'" tabindex="-1" readonly required>
        </div>
        <div class="col-1 ingresoAPedir">
            <input type="number" class="form-control form-control-sm nuevoAPedir" name="nuevoAPedir" min="1" nuevoAPedir="'.$row['a_pedir'].'" value="'.$row['a_pedir'].'" required>
        </div>

        <div class="col-1 ingresoTotal">
        <input type="hidden" class="form-control form-control-sm parametrosResurtidoCompra" precioCompra="'.$row['precio_compra'].'" descuento="0" name="agregarProducto" total="'.$total.'" value="'.$total.'" readonly required>
        </div>
    </div>';

                    
}


if($conteo == 0){
    echo '<center><h1>No hay nada a surtir de este proveedor</h1></center>';
}

 /*} 

}else{

echo '<center><h1>No hay nada a surtir de este proveedor</h1></center>';
}*/?>




                    
              

