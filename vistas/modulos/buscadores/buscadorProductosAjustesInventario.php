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

$busquedaProductosAjustesInventario = $_POST["buscarProductosAjustesInventario"];

if ($busquedaProductosAjustesInventario != "") {
	$porcionesProductosAjustesInventario = explode(" ", $busquedaProductosAjustesInventario);
$contadorProductosAjustesInventario = count($porcionesProductosAjustesInventario); 

for ($iProductosAjustesInventario=0; $iProductosAjustesInventario < $contadorProductosAjustesInventario; $iProductosAjustesInventario++) { 
$generaFiltroProductosAjustesInventario = $generaFiltroProductosAjustesInventario."productos.descripcion_larga LIKE '%".$porcionesProductosAjustesInventario[$iProductosAjustesInventario]."%'";

if ($iProductosAjustesInventario < $contadorProductosAjustesInventario-1) {
	$generaFiltroProductosAjustesInventario = $generaFiltroProductosAjustesInventario." AND ";
}

}

$generaFiltroProductosAjustesInventario = $generaFiltroProductosAjustesInventario." OR ";

for ($iProductosAjustesInventario=0; $iProductosAjustesInventario < $contadorProductosAjustesInventario; $iProductosAjustesInventario++) { 
$generaFiltroProductosAjustesInventario = $generaFiltroProductosAjustesInventario."productos.clave_producto LIKE '%".$porcionesProductosAjustesInventario[$iProductosAjustesInventario]."%'";

if ($iProductosAjustesInventario < $contadorProductosAjustesInventario-1) {
	$generaFiltroProductosAjustesInventario = $generaFiltroProductosAjustesInventario." AND ";
}

}




$generaFiltroProductosAjustesInventario = $generaFiltroProductosAjustesInventario." OR ";

for ($iProductosAjustesInventario=0; $iProductosAjustesInventario < $contadorProductosAjustesInventario; $iProductosAjustesInventario++) { 
$generaFiltroProductosAjustesInventario = $generaFiltroProductosAjustesInventario."multiclaves.multiclave LIKE '%".$porcionesProductosAjustesInventario[$iProductosAjustesInventario]."%'";

if ($iProductosAjustesInventario < $contadorProductosAjustesInventario-1) {
    $generaFiltroProductosAjustesInventario = $generaFiltroProductosAjustesInventario." AND ";
}

}

$consultaProductosAjustesInventario= "SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, productos.clave_producto, productos.descripcion_corta, productos.descripcion_larga, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, existencias_sucursales.precio_compra FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto LEFT JOIN multiclaves ON productos.id_producto = multiclaves.id_producto WHERE ".$generaFiltroProductosAjustesInventario." AND productos.descontinuado = 0 AND existencias_sucursales.id_sucursal = $id_sucursal GROUP BY existencias_sucursales.id_producto, existencias_sucursales.stock, productos.clave_producto, productos.descripcion_corta, productos.descripcion_larga, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, existencias_sucursales.precio_compra ORDER BY productos.descripcion_corta ASC";

}else{

    return;

	/*$consultaProductosAjustesInventario = "SELECT id_producto, stock, clave_producto, descripcion_corta, imagen1, imagen2, imagen3, precio1, precio2, precio3, descripcion_corta, nivel_minimo, nivel_medio, nivel_maximo, precio_compra FROM existencias_sucursales INNER JOIN productos ON id_producto = id_producto WHERE id_sucursal = ".$id_sucursal." LIMIT 10";*/
}


//echo $consultaProductosAjustesInventario;



$rsBuscadorProductosAjustesInventario = $conexion->query($consultaProductosAjustesInventario); 



            
$contador = 0;
 while($resultadoProductosAjustesInventario = $rsBuscadorProductosAjustesInventario->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">
                    <td><a href="'.$resultadoProductosAjustesInventario["imagen1"].'" data-toggle="lightbox" data-title="Imagen 1" data-gallery="gallery" tabindex="-1">
                            <img src="'.$resultadoProductosAjustesInventario["imagen1"].'" class="img-fluid mb-2" alt="black sample" width="40px"/>
                        </a>
                        <a href="'.$resultadoProductosAjustesInventario["imagen2"].'" data-toggle="lightbox" data-title="Imagen 2" data-gallery="gallery" tabindex="-1">
                        </a>
                        <a href="'.$resultadoProductosAjustesInventario["imagen3"].'" data-toggle="lightbox" data-title="Imagen 3" data-gallery="gallery" tabindex="-1">
                        </a>
                        <a href="vistas/img/productos/atras.png" data-toggle="lightbox" data-title="Regresa se acabaron las imagenes" data-gallery="gallery" tabindex="-1">
                        </a>
                    </td>

                    <td>
                    '.$resultadoProductosAjustesInventario["clave_producto"].'
                    </td>

                    <td>
                    '.$resultadoProductosAjustesInventario["descripcion_corta"].'
                    </td>
                    <td style="text-align: right;">';

                    /*=============================================
            STOCK3
            =============================================*/ 

            if($resultadoProductosAjustesInventario["stock"] <= $resultadoProductosAjustesInventario["nivel_minimo"]){

                echo "<button class='btn-sm btn-danger' tabindex='-1'>".$resultadoProductosAjustesInventario["stock"]."</button>";

            }else if($resultadoProductosAjustesInventario["stock"] > $resultadoProductosAjustesInventario["nivel_minimo"] && $resultadoProductosAjustesInventario["stock"] <= $resultadoProductosAjustesInventario["nivel_medio"]){

                echo "<button class='btn-sm btn-warning' tabindex='-1'>".$resultadoProductosAjustesInventario["stock"]."</button>";

            }else{

                echo "<button class='btn-sm btn-success' tabindex='-1'>".$resultadoProductosAjustesInventario["stock"]."</button>";

            }



                    echo '<td><button class="btn-xs btn-primary agregarProducto recuperarBoton guardaFoco'.$contador.'" contador = "'.$contador.'" id_producto="'.$resultadoProductosAjustesInventario["id_producto"].'">Agregar</button</td>';

                    


 } 



 ?>




                    
              