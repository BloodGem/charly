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

$id_grupo = $traerUsuario['id_grupo'];

$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);

$array = json_decode($respuesta2['permisos']);


$indiceActivarDesactivarProductos = array_search("Activar desactivar productos",$array,true);


$busquedaProductos = $_POST["buscarProductos"];


if ($busquedaProductos != "") {
	$porcionesProductos = explode(" ", $busquedaProductos);
    $contadorProductos = count($porcionesProductos); 

    for ($iProductos=0; $iProductos < $contadorProductos; $iProductos++) { 
        $generaFiltroProductos = $generaFiltroProductos."descripcion_larga LIKE '%".$porcionesProductos[$iProductos]."%'";

        if ($iProductos < $contadorProductos-1) {
           $generaFiltroProductos = $generaFiltroProductos." AND ";
       }

   }

   $generaFiltroProductos = $generaFiltroProductos." OR ";

   for ($iProductos=0; $iProductos < $contadorProductos; $iProductos++) { 
    $generaFiltroProductos = $generaFiltroProductos."clave_producto LIKE '%".$porcionesProductos[$iProductos]."%'";

    if ($iProductos < $contadorProductos-1) {
       $generaFiltroProductos = $generaFiltroProductos." AND ";
   }

}










$generaFiltroProductos = $generaFiltroProductos." OR ";

   for ($iProductos=0; $iProductos < $contadorProductos; $iProductos++) { 
    $generaFiltroProductos = $generaFiltroProductos."multiclaves.multiclave LIKE '%".$porcionesProductos[$iProductos]."%'";

    if ($iProductos < $contadorProductos-1) {
       $generaFiltroProductos = $generaFiltroProductos." AND ";
   }

}


$consultaProductos= "SELECT productos.id_producto, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, productos.descripcion_corta, productos.descripcion_larga, productos.multiplo, productos.descontinuado FROM productos LEFT JOIN multiclaves ON productos.id_producto = multiclaves.id_producto WHERE (".$generaFiltroProductos.") GROUP BY productos.id_producto, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, productos.descripcion_corta, productos.descripcion_larga, productos.multiplo ORDER BY productos.descripcion_corta ASC";

}else{

	$consultaProductos = "SELECT productos.id_producto, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, productos.descripcion_corta, productos.descripcion_larga, productos.multiplo, productos.descontinuado FROM productos ORDER BY productos.descripcion_corta ASC";
}


//var_dump($consultaProductos);



$rsBuscadorProductos = $conexion->query($consultaProductos);  

echo '<table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th style="width:5px">Imgs</th>
                        <th>Clave de producto</th>
                        <th>Descripción</th>
                        <th>Multiplo</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

$contador = 0;  

while($row = $rsBuscadorProductos->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
    <td><a href="'.$row["imagen1"].'" data-toggle="lightbox" data-title="Imagen 1" data-gallery="gallery">
    <img src="'.$row["imagen1"].'" class="img-fluid mb-2" width="40px"/>
    </a>
    <a href="'.$row["imagen2"].'" data-toggle="lightbox" data-title="Imagen 2" data-gallery="gallery" tabindex="-1">
    </a>
    <a href="'.$row["imagen3"].'" data-toggle="lightbox" data-title="Imagen 3" data-gallery="gallery" tabindex="-1">
    </a>
    <a href="vistas/img/productos/atras.png" data-toggle="lightbox" data-title="Regresa se acabaron las imagenes" data-gallery="gallery" tabindex="-1">
    </a>
    </td>

    <td>
    '.$row["clave_producto"].'
    </td>

    <td>
    '.$row["descripcion_corta"].'
    </td><td style="text-align: center;">';
            
            $indiceCambiarMultiploProductos = array_search("Cambiar multiplo productos",$array,true);

            if($indiceCambiarMultiploProductos !== false){
                echo '<a href="" class="aEditarMultiploProducto" id_producto="'.$row["id_producto"].'" clave_producto="'.$row["clave_producto"].'">'.$row["multiplo"].'</a>';
            }else{
                echo $row["multiplo"];
            }


            if($indiceActivarDesactivarProductos !== false){
                if($row["descontinuado"] == 0){
                    echo '<td><button class="btn btn-success btn-xs ActDesProducto" id_producto="'.$row["id_producto"].'" estadoProducto="1">ACTIVADO</button></td>';
                }else{
                    echo '<td><button class="btn btn-danger btn-xs ActDesProducto" id_producto="'.$row["id_producto"].'" estadoProducto="0">DESACTIVADO</button></td>';
                }
            }else{
               if($row["descontinuado"] == 0){
                echo 'NO';
                }else{
                    echo 'SI';
                } 
            }

            echo'</td><td class="botones"><div class="btn-group">';



            $indiceEditarProductos = array_search("Editar productos",$array,true);

            if($indiceEditarProductos !== false){

                echo '<button class="btn btn-warning btnEditarProducto" id_producto="'.$row["id_producto"].'" accesskey="2">Editar</button>';

            }

            $indiceDuplicarProductos = array_search("Editar productos",$array,true);

            if($indiceDuplicarProductos !== false){

                echo '<button class="btn btn-info btnDuplicarProducto" id_producto="'.$row["id_producto"].'">Duplicar</button>';

            }



            /*$indiceEliminarProductos = array_search("Eliminar productos",$array,true);

            if($indiceEliminarProductos == 0){
               
            }else if($indiceEliminarProductos !== ""){ 
                
                echo '<button class="btn btn-danger btnEliminarProducto" id_producto="'.$row["id_producto"].'" accesskey="0"><i class="fa fa-times"></i></button>';
            }*/





            $indiceVerMulticlavesProductos = array_search("Ver multiclaves productos",$array,true);

            if($indiceVerMulticlavesProductos !== false){ 
                
                echo '<button class="btn btn-danger btnVerMulticlavesProducto" id_producto="'.$row["id_producto"].'">Multiclaves</button>';
            }
            
            echo '</div></td>';

            


        } 





        echo '</tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th style="width:5px">Imgs</th>
                        <th>Clave de producto</th>
                        <th>Descripción</th>
                        <th>Multiplo</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>';


            ?>




        
        