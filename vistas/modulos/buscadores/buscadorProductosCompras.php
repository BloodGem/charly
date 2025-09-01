<?php 
error_reporting(0);
session_start();
require_once "../../../modelos/conexion2.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";

$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
$id_sucursal = $traerUsuario['id_sucursal'];

$ver_catalogo_completo = $_POST['ver_catalogo_completo'];


$busquedaProductosCompras = $_POST["buscarProductosCompras"];
$id_proveedor = $_POST["id_proveedor"];


if ($busquedaProductosCompras != "") {
	$porcionesProductosCompras = explode(" ", $busquedaProductosCompras);
$contadorProductosCompras = count($porcionesProductosCompras); 

for ($iProductosCompras=0; $iProductosCompras < $contadorProductosCompras; $iProductosCompras++) { 
$generaFiltroProductosCompras = $generaFiltroProductosCompras."productos.descripcion_larga LIKE '%".$porcionesProductosCompras[$iProductosCompras]."%'";

if ($iProductosCompras < $contadorProductosCompras-1) {
	$generaFiltroProductosCompras = $generaFiltroProductosCompras." AND ";
}

}


$generaFiltroProductosCompras = $generaFiltroProductosCompras." OR ";

for ($iProductosCompras=0; $iProductosCompras < $contadorProductosCompras; $iProductosCompras++) { 
$generaFiltroProductosCompras = $generaFiltroProductosCompras."multiclaves.multiclave LIKE '%".$porcionesProductosCompras[$iProductosCompras]."%'";

if ($iProductosCompras < $contadorProductosCompras-1) {
    $generaFiltroProductosCompras = $generaFiltroProductosCompras." AND ";
}

}


$generaFiltroProductosCompras = $generaFiltroProductosCompras." OR ";

for ($iProductosCompras=0; $iProductosCompras < $contadorProductosCompras; $iProductosCompras++) { 
$generaFiltroProductosCompras = $generaFiltroProductosCompras."productos.clave_producto LIKE '%".$porcionesProductosCompras[$iProductosCompras]."%'";

if ($iProductosCompras < $contadorProductosCompras-1) {
	$generaFiltroProductosCompras = $generaFiltroProductosCompras." AND ";
}

}

if($ver_catalogo_completo == 0){

    $consultaProductosCompras= "SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, productos.clave_producto, productos.descripcion_corta, productos.descripcion_larga, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, existencias_sucursales.precio_compra FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto INNER JOIN productos_proveedores ON existencias_sucursales.id_producto = productos_proveedores.id_producto LEFT JOIN multiclaves ON productos.id_producto = multiclaves.id_producto WHERE ".$generaFiltroProductosCompras." AND productos.descontinuado = 0 AND productos_proveedores.id_proveedor = $id_proveedor AND existencias_sucursales.id_sucursal = $id_sucursal GROUP BY existencias_sucursales.id_producto, existencias_sucursales.stock, productos.clave_producto, productos.descripcion_corta, productos.descripcion_larga, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, existencias_sucursales.precio_compra ORDER BY productos.descripcion_corta ASC";

} else{

    $consultaProductosCompras= "SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, productos.clave_producto, productos.descripcion_corta, productos.descripcion_larga, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, existencias_sucursales.precio_compra FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto LEFT JOIN multiclaves ON productos.id_producto = multiclaves.id_producto WHERE ".$generaFiltroProductosCompras." AND productos.descontinuado = 0 AND existencias_sucursales.id_sucursal = $id_sucursal GROUP BY existencias_sucursales.id_producto, existencias_sucursales.stock, productos.clave_producto, productos.descripcion_corta, productos.descripcion_larga, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, existencias_sucursales.precio_compra ORDER BY productos.descripcion_corta ASC";
} 



}else{

    return;

	//$consultaProductosCompras = "SELECT id_producto, stock, clave_producto, descripcion_corta, imagen1, imagen2, imagen3, precio1, precio2, precio3, descripcion_corta, nivel_minimo, nivel_medio, nivel_maximo, precio_compra FROM existencias_sucursales INNER JOIN productos ON id_producto = id_producto WHERE id_sucursal = ".$id_sucursal." LIMIT 10";
}


//echo $consultaProductosCompras;

$rsBuscadorProductosCompras = $conexion->query($consultaProductosCompras); 



            
$contador = 0;
 while($resultadoProductosCompras = $rsBuscadorProductosCompras->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">
                    <td><a href="'.$resultadoProductosCompras["imagen1"].'" data-toggle="lightbox" data-title="Imagen 1" data-gallery="gallery" tabindex="-1">
                            <img src="'.$resultadoProductosCompras["imagen1"].'" class="img-fluid mb-2" alt="black sample" width="40px"/>
                        </a>
                        <a href="'.$resultadoProductosCompras["imagen2"].'" data-toggle="lightbox" data-title="Imagen 2" data-gallery="gallery" tabindex="-1">
                        </a>
                        <a href="'.$resultadoProductosCompras["imagen3"].'" data-toggle="lightbox" data-title="Imagen 3" data-gallery="gallery" tabindex="-1">
                        </a>
                        <a href="vistas/img/productos/atras.png" data-toggle="lightbox" data-title="Regresa se acabaron las imagenes" data-gallery="gallery" tabindex="-1">
                        </a>
                    </td>

                    <td>
                    '.$resultadoProductosCompras["clave_producto"].'
                    </td>

                    <td>
                    '.$resultadoProductosCompras["descripcion_corta"].'
                    </td>
                    <td style="text-align: right;">';

                    /*=============================================
            STOCK3
            =============================================*/ 

            if($resultadoProductosCompras["stock"] <= $resultadoProductosCompras["nivel_minimo"]){

                echo "<button class='btn-sm btn-danger' tabindex='-1'>".$resultadoProductosCompras["stock"]."</button>";

            }else if($resultadoProductosCompras["stock"] > $resultadoProductosCompras["nivel_minimo"] && $resultadoProductosCompras["stock"] <= $resultadoProductosCompras["nivel_medio"]){

                echo "<button class='btn-sm btn-warning' tabindex='-1'>".$resultadoProductosCompras["stock"]."</button>";

            }else{

                echo "<button class='btn-sm btn-success' tabindex='-1'>".$resultadoProductosCompras["stock"]."</button>";

            }



                    echo '<td style="text-align: right;">$'.number_format($resultadoProductosCompras["precio_compra"], 2).'</td>
                    </td>
                    <td><button class="btn-xs btn-primary agregarProducto recuperarBoton guardaFoco'.$contador.'" contador = "'.$contador.'" id_producto="'.$resultadoProductosCompras["id_producto"].'">Agregar</button</td>';

                    


 } 



 ?>




                    
              