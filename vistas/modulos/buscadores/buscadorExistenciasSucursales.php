<?php 
error_reporting(0);
session_start();
require_once "../../../modelos/conexion2.php";
require_once "../../../controladores/compras.controlador.php";
require_once "../../../modelos/compras.modelo.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";



$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
$id_sucursal = $traerUsuario['id_sucursal'];

$id_grupo = $traerUsuario['id_grupo'];

$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);

$array = json_decode($respuesta2['permisos']);



$busqueda = $_POST["buscarProductosExistenciasSucursales"];


if ($busqueda != "") {
	$porciones = explode(" ", $busqueda);
    $contador = count($porciones); 

    for ($i=0; $i < $contador; $i++) { 
        $genera_filtro = $genera_filtro."productos.descripcion_larga LIKE '%".$porciones[$i]."%'";

        if ($i < $contador-1) {
           $genera_filtro = $genera_filtro." AND ";
       }

   }

   $genera_filtro = $genera_filtro." OR ";

   for ($i=0; $i < $contador; $i++) { 
    $genera_filtro = $genera_filtro."productos.clave_producto LIKE '%".$porciones[$i]."%'";

    if ($i < $contador-1) {
       $genera_filtro = $genera_filtro." AND ";
   }

}

$genera_filtro = $genera_filtro." OR ";

for ($i=0; $i < $contador; $i++) { 
    $genera_filtro = $genera_filtro."existencias_sucursales.ubicacion LIKE '%".$porciones[$i]."%'";

    if ($i < $contador-1) {
       $genera_filtro = $genera_filtro." AND ";
   }

}

$consultaProductosExistenciasSucursales= "SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.en_garantia, existencias_sucursales.ubicacion, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, productos.descripcion_larga, productos.descripcion_corta, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, existencias_sucursales.fecha_ult_venta, existencias_sucursales.fecha_ult_compra, marcas.marca FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto LEFT JOIN marcas ON productos.id_marca = marcas.id_marca WHERE (".$genera_filtro.") AND id_sucursal = ".$id_sucursal." ORDER BY descripcion_corta ASC LIMIT 70";

}else{

	$consultaProductosExistenciasSucursales = "SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.en_garantia, existencias_sucursales.ubicacion, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, productos.descripcion_larga, productos.descripcion_corta, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, existencias_sucursales.fecha_ult_venta, existencias_sucursales.fecha_ult_compra, marcas.marca FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto LEFT JOIN marcas ON productos.id_marca = marcas.id_marca WHERE id_sucursal = ".$id_sucursal." ORDER BY descripcion_corta ASC LIMIT 70";

}
    

/*if($_SESSION['id'] == 1){
    echo $consultaProductosExistenciasSucursales; 
}*/




$rsBuscadorProductosExistenciasSucursales = $conexion->query($consultaProductosExistenciasSucursales);  

echo '<table class="table-sm table-bordered table-striped">
                <thead>
                    <tr>
                    <th></th>
                        <th style="width:5px">Imgs</th>
                        <th>Clave</th>
                        <th>Descripción</th>
                        <th>Marca</th>
                        <th>Exist.</th>
                        <th>En garantía</th>
                        <th>Ubicación</th>
                        <th>Mínimo</th>
                        <th>Máximo</th>
                        <th>Cat. Vendida</th>
                        <th>Últ. compra</th>
                        <th>Últ. venta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

$contador = 0;   

while($row = $rsBuscadorProductosExistenciasSucursales->fetch_array(MYSQLI_BOTH)){ 

    $id_producto = $row['id_producto'];


    /*$traerUltimaCompraProducto = ControladorCompras::ctrMostrarUltimaCompraProducto($id_producto, $id_sucursal);

    $dateFechaUCP = date_create($traerUltimaCompraProducto["fecha_confirmacion"]);
    $fecha_ultima_compra = date_format($dateFechaUCP, 'd-m-Y');


    $traerUltimaVentaProducto = ControladorVentas::ctrMostrarUltimaVentaProducto($id_producto, $id_sucursal);

    $dateFechaUVP = date_create($traerUltimaVentaProducto["fecha_creacion"]);
    $fecha_ultima_venta = date_format($dateFechaUVP, 'd-m-Y');*/

    $traerVentasProducto = ControladorVentas::ctrMostrarSumaVentasProductoRangoFechas(7, $id_producto, $id_sucursal);


$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
    <td class="imagenes">
        <a href="'.$row["imagen1"].'" class="imagen1 img" no_imagen="1" id_producto="'.$row["id_producto"].'" contador="'.$contador.'" data-toggle="lightbox" data-title="Imagen 1" data-gallery="gallery">
            <img src="'.$row["imagen1"].'" class="img-fluid mb-2" width="40px" tabindex="-1"/>
        </a>

        <a href="'.$row["imagen2"].'" class="imagen2 img" no_imagen="2" id_producto="'.$row["id_producto"].'" contador="'.$contador.'" data-toggle="lightbox" data-title="Imagen 2" data-gallery="gallery" tabindex="-1">
        </a>

        <a href="'.$row["imagen3"].'" class="imagen3 img" no_imagen="3" id_producto="'.$row["id_producto"].'" contador="'.$contador.'" data-toggle="lightbox" data-title="Imagen 3" data-gallery="gallery" tabindex="-1">
        </a>

    </td>

    <td>
    '.$row["clave_producto"].'
    </td>

    <td>
    '.$row["descripcion_corta"].'
    </td> 

    <td>
    '.$row["marca"].'
    </td> 

    <td>';

          /*=============================================
            STOCK3
            =============================================*/ 

            if($row["stock"] <= $row["nivel_minimo"]){

                echo "<button class='btn btn-danger' tabindex='-1'>".$row["stock"]."</button>";

            }else if($row["stock"] > $row["nivel_minimo"] && $row["stock"] <= $row["nivel_medio"]){

                echo "<button class='btn btn-warning' tabindex='-1'>".$row["stock"]."</button>";

            }else{

                echo "<button class='btn btn-success' tabindex='-1'>".$row["stock"]."</button>";

            }


            echo "</td>
            <td>".$row["en_garantia"]."</td>
            <td>";

            $indiceEditarUbicacionProductos = array_search("Editar ubicacion productos",$array,true);

            if($indiceEditarUbicacionProductos !== false){

                if($row["ubicacion"] == ""){
                    echo '<a href="" class="aEditarUbicacionProductoEUPES" id_producto="'.$row["id_producto"].'" clave_producto="'.$row["clave_producto"].'">Sin ubicación</a>';
                }else{
                    echo '<a href="" class="aEditarUbicacionProductoEUPES" id_producto="'.$row["id_producto"].'" clave_producto="'.$row["clave_producto"].'">'.$row["ubicacion"].'</a>';
                }
                


            }else{
                echo $row["ubicacion"];
            }
            
            echo ' </td>
            <td>'.$row["nivel_minimo"].'</td>
            <td>'.$row["nivel_maximo"].'</td>
            <td>'.$traerVentasProducto["cantidad_vendida"].'</td>
            <td>'.$row["fecha_ult_compra"].'</td>
            <td>'.$row["fecha_ult_venta"].'</td>
           
            <td class="botones"><div class="btn-group">';

            $indiceEditarProductosExistenciasSucursales = array_search("Editar existencias sucursales",$array,true);

            if($indiceEditarProductosExistenciasSucursales == 0){
               
            }else if($indiceEditarProductosExistenciasSucursales !== ""){

                echo '<button class="btn btn-warning btnEditarProducto" id_producto="'.$row["id_producto"].'" data-toggle="modal" data-target="#modalEditarProducto">Editar</button>';

            }


            
            echo '</div></td>';

            


        } 

        echo '</tbody>

                <tfoot>
                    <tr>
                    <th></th>
                        <th style="width:5px">Imgs</th>
                        <th>Clave</th>
                        <th>Descripción</th>
                        <th>Marca</th>
                        <th>Exist.</th>
                        <th>En garantía</th>
                        <th>Ubicación</th>
                        <th>Mínimo</th>
                        <th>Máximo</th>
                        <th>Cat. Vendida</th>
                        <th>Últ. compra</th>
                        <th>Últ. venta</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>';


            ?>




        
        