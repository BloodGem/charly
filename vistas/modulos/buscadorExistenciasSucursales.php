<?php 
error_reporting(0);
session_start();

require_once "../../modelos/grupos.modelo.php";
require_once "../../controladores/grupos.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
require_once "../../controladores/usuarios.controlador.php";

require_once "conexion.php";

$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
$id_sucursal = $traerUsuario['id_sucursal'];

$id_grupo = $traerUsuario['id_grupo'];

$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);

$array = json_decode($respuesta2['permisos']);



$busquedaProductosExistenciasSucursales = $_POST["buscarProductosExistenciasSucursales"];


if ($busquedaProductosExistenciasSucursales != "") {
	$porcionesProductosExistenciasSucursales = explode(" ", $busquedaProductosExistenciasSucursales);
    $contadorProductosExistenciasSucursales = count($porcionesProductosExistenciasSucursales); 

    for ($iProductosExistenciasSucursales=0; $iProductosExistenciasSucursales < $contadorProductosExistenciasSucursales; $iProductosExistenciasSucursales++) { 
        $generaFiltroProductosExistenciasSucursales = $generaFiltroProductosExistenciasSucursales."productos.descripcion_larga LIKE '%".$porcionesProductosExistenciasSucursales[$iProductosExistenciasSucursales]."%'";

        if ($iProductosExistenciasSucursales < $contadorProductosExistenciasSucursales-1) {
           $generaFiltroProductosExistenciasSucursales = $generaFiltroProductosExistenciasSucursales." AND ";
       }

   }

   $generaFiltroProductosExistenciasSucursales = $generaFiltroProductosExistenciasSucursales." OR ";

   for ($iProductosExistenciasSucursales=0; $iProductosExistenciasSucursales < $contadorProductosExistenciasSucursales; $iProductosExistenciasSucursales++) { 
    $generaFiltroProductosExistenciasSucursales = $generaFiltroProductosExistenciasSucursales."productos.clave_producto LIKE '%".$porcionesProductosExistenciasSucursales[$iProductosExistenciasSucursales]."%'";

    if ($iProductosExistenciasSucursales < $contadorProductosExistenciasSucursales-1) {
       $generaFiltroProductosExistenciasSucursales = $generaFiltroProductosExistenciasSucursales." AND ";
   }

}

$generaFiltroProductosExistenciasSucursales = $generaFiltroProductosExistenciasSucursales." OR ";

for ($iProductosExistenciasSucursales=0; $iProductosExistenciasSucursales < $contadorProductosExistenciasSucursales; $iProductosExistenciasSucursales++) { 
    $generaFiltroProductosExistenciasSucursales = $generaFiltroProductosExistenciasSucursales."existencias_sucursales.ubicacion LIKE '%".$porcionesProductosExistenciasSucursales[$iProductosExistenciasSucursales]."%'";

    if ($iProductosExistenciasSucursales < $contadorProductosExistenciasSucursales-1) {
       $generaFiltroProductosExistenciasSucursales = $generaFiltroProductosExistenciasSucursales." AND ";
   }

}

$consultaProductosExistenciasSucursales= "SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.ubicacion, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, productos.descripcion_larga, productos.descripcion_corta, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto WHERE (".$generaFiltroProductosExistenciasSucursales.") AND id_sucursal = ".$id_sucursal." ORDER BY descripcion_corta ASC LIMIT 50";

}else{

	$consultaProductosExistenciasSucursales = "SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.ubicacion, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, productos.descripcion_larga, productos.descripcion_corta, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto WHERE id_sucursal = ".$id_sucursal." LIMIT 50";

}



$rsBuscadorProductosExistenciasSucursales = $conexion->query($consultaProductosExistenciasSucursales);  

while($resultadoProductosExistenciasSucursales = $rsBuscadorProductosExistenciasSucursales->fetch_array(MYSQLI_BOTH)){ 



    echo '<tr>
    <td><a href="'.$resultadoProductosExistenciasSucursales["imagen1"].'" data-toggle="lightbox" data-title="Imagen 1" data-gallery="gallery">
    <img src="'.$resultadoProductosExistenciasSucursales["imagen1"].'" class="img-fluid mb-2" width="40px" tabindex="-1"/>
    </a>
    <a href="'.$resultadoProductosExistenciasSucursales["imagen2"].'" data-toggle="lightbox" data-title="Imagen 2" data-gallery="gallery" tabindex="-1">
    </a>
    <a href="'.$resultadoProductosExistenciasSucursales["imagen3"].'" data-toggle="lightbox" data-title="Imagen 3" data-gallery="gallery" tabindex="-1">
    </a>
    <a href="vistas/img/productos/atras.png" data-toggle="lightbox" data-title="Regresa se acabaron las imagenes" data-gallery="gallery" tabindex="-1">
    </a>
    </td>

    <td>
    '.$resultadoProductosExistenciasSucursales["clave_producto"].'
    </td>

    <td>
    '.$resultadoProductosExistenciasSucursales["descripcion_corta"].'
    </td> 
    <td>';

          /*=============================================
            STOCK3
            =============================================*/ 

            if($resultadoProductosExistenciasSucursales["stock"] <= $resultadoProductosExistenciasSucursales["nivel_minimo"]){

                echo "<button class='btn btn-danger' tabindex='-1'>".$resultadoProductosExistenciasSucursales["stock"]."</button>";

            }else if($resultadoProductosExistenciasSucursales["stock"] > $resultadoProductosExistenciasSucursales["nivel_minimo"] && $resultadoProductosExistenciasSucursales["stock"] <= $resultadoProductosExistenciasSucursales["nivel_medio"]){

                echo "<button class='btn btn-warning' tabindex='-1'>".$resultadoProductosExistenciasSucursales["stock"]."</button>";

            }else{

                echo "<button class='btn btn-success' tabindex='-1'>".$resultadoProductosExistenciasSucursales["stock"]."</button>";

            }


            echo '</td><td>
            '.$resultadoProductosExistenciasSucursales["ubicacion"].'
            </td>
            <td><div class="btn-group">';

            $indiceEditarProductosExistenciasSucursales = array_search("Editar existencias sucursales",$array,true);

            if($indiceEditarProductosExistenciasSucursales == 0){
               
            }else if($indiceEditarProductosExistenciasSucursales !== ""){

                echo '<button class="btn btn-warning btnEditarProducto" id_producto="'.$resultadoProductosExistenciasSucursales["id_producto"].'" accesskey="2" data-toggle="modal" data-target="#modalEditarProducto">Editar</button>';

            }


            
            echo '</div></td>';

            


        } ?>




        
        