<?php 
error_reporting(0);
require_once "conexion.php";



$busquedaProductosPedidos = $_POST["buscarProductosPedidos"];


if ($busquedaProductosPedidos != "") {
    $porcionesProductosPedidos = explode(" ", $busquedaProductosPedidos);
$contadorProductosPedidos = count($porcionesProductosPedidos); 

for ($iProductosPedidos=0; $iProductosPedidos < $contadorProductosPedidos; $iProductosPedidos++) { 
$generaFiltroProductosPedidos = $generaFiltroProductosPedidos."productos.descripcion_corta LIKE '%".$porcionesProductosPedidos[$iProductosPedidos]."%'";

if ($iProductosPedidos < $contadorProductosPedidos-1) {
    $generaFiltroProductosPedidos = $generaFiltroProductosPedidos." AND ";
}

}

$generaFiltroProductosPedidos = $generaFiltroProductosPedidos." OR ";

for ($iProductosPedidos=0; $iProductosPedidos < $contadorProductosPedidos; $iProductosPedidos++) { 
$generaFiltroProductosPedidos = $generaFiltroProductosPedidos."productos.clave_producto LIKE '%".$porcionesProductosPedidos[$iProductosPedidos]."%'";

if ($iProductosPedidos < $contadorProductosPedidos-1) {
    $generaFiltroProductosPedidos = $generaFiltroProductosPedidos." AND ";
}

}

$consultaProductosPedidos= "SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, productos.clave_producto, productos.descripcion_corta, productos.imagen1, productos.imagen2, productos.imagen3, productos.precio1, productos.precio2, productos.precio3, productos.descripcion_corta, productos.nivel_minimo, productos.nivel_medio, productos.nivel_maximo, productos.precio_compra FROM existencias_sucursales INNER JOIN productos ON existencias_sucursales.id_producto = productos.id_producto WHERE (".$generaFiltroProductosPedidos.") LIMIT 10";
}else{

    $consultaProductosPedidos = "SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, productos.clave_producto, productos.descripcion_corta, productos.imagen1, productos.imagen2, productos.imagen3, productos.precio1, productos.precio2, productos.precio3, productos.descripcion_corta, productos.nivel_minimo, productos.nivel_medio, productos.nivel_maximo, productos.precio_compra FROM existencias_sucursales INNER JOIN productos ON existencias_sucursales.id_producto = productos.id_producto LIMIT 10";
}



$rsBuscadorProductosPedidos = $conexion->query($consultaProductosPedidos);  

 while($resultadoProductosPedidos = $rsBuscadorProductosPedidos->fetch_array(MYSQLI_BOTH)){ 



echo '<tr>
                    <td><a href="'.$resultadoProductosPedidos["imagen1"].'" data-toggle="lightbox" data-title="Imagen 1" data-gallery="gallery">
                            <img src="'.$resultadoProductosPedidos["imagen1"].'" class="img-fluid mb-2" alt="black sample" width="40px"/>
                        </a>
                        <a href="'.$resultadoProductosPedidos["imagen2"].'" data-toggle="lightbox" data-title="Imagen 2" data-gallery="gallery">
                        </a>
                        <a href="'.$resultadoProductosPedidos["imagen3"].'" data-toggle="lightbox" data-title="Imagen 3" data-gallery="gallery">
                        </a>
                        <a href="vistas/img/productos/atras.png" data-toggle="lightbox" data-title="Regresa se acabaron las imagenes" data-gallery="gallery">
                        </a>
                    </td>

                    <td>
                    '.$resultadoProductosPedidos["clave_producto"].'
                    </td>

                    <td>
                    '.$resultadoProductosPedidos["descripcion_corta"].'
                    </td>
                    <td>';

                    /*=============================================
            STOCK3
            =============================================*/ 

            if($resultadoProductosPedidos["stock"] <= $resultadoProductosPedidos["nivel_minimo"]){

                echo "<button class='btn-sm btn-danger'>".$resultadoProductosPedidos["stock"]."</button>";

            }else if($resultadoProductosPedidos["stock"] > $resultadoProductosPedidos["nivel_minimo"] && $resultadoProductosPedidos["stock"] <= $resultadoProductosPedidos["nivel_medio"]){

                echo "<button class='btn-sm btn-warning'>".$resultadoProductosPedidos["stock"]."</button>";

            }else{

                echo "<button class='btn-sm btn-success'>".$resultadoProductosPedidos["stock"]."</button>";

            }



                    echo '<td>'.$resultadoProductosPedidos["precio_compra"].'</td>
                    </td>
                    <td><button class="btn-xs btn-primary agregarProducto recuperarBoton" id_producto="'.$resultadoProductosPedidos["id_producto"].'" accesskey="a">Agregar</button</td>';

                    


 } ?>




                    
              