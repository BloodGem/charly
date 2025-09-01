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



$busqueda = $_POST["buscarProductos"];


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
$genera_filtro = $genera_filtro."multiclaves.multiclave LIKE '%".$porciones[$i]."%'";

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



$consulta= "SELECT existencias_sucursales.id_producto, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, productos.descripcion_larga, productos.descripcion_corta FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto LEFT JOIN multiclaves ON productos.id_producto = multiclaves.id_producto WHERE (".$genera_filtro.") AND id_sucursal = ".$id_sucursal." GROUP BY existencias_sucursales.id_producto, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, productos.descripcion_larga, productos.descripcion_corta ORDER BY productos.descripcion_corta ASC LIMIT 70";

}else{

	$consulta = "";

}

//var_dump($consulta);



$rsBuscador = $conexion->query($consulta);  

echo '<table class="table-sm table-bordered table-striped">
                <thead>
                    <tr>
                    <th></th>
                        <th style="width:5px">Imgs</th>
                        <th>Clave</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

$contador = 0;   

while($row = $rsBuscador->fetch_array(MYSQLI_BOTH)){ 

    $id_producto = $row['id_producto'];



$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
    <td><a href="'.$row["imagen1"].'" data-toggle="lightbox" data-title="Imagen 1" data-gallery="gallery">
    <img src="'.$row["imagen1"].'" class="img-fluid mb-2" width="40px" tabindex="-1"/>
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
    </td> 
    
           
    <td class="botones">
        <div class="btn-group">
            <button class="btn btn-primary btnSeleccionarProducto" id_producto="'.$row["id_producto"].'">Seleccionar</button>
        </div>
    </td>';

            


        } 

        echo '</tbody>

                <tfoot>
                    <tr>
                    <th></th>
                        <th style="width:5px">Imgs</th>
                        <th>Clave</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>';


            ?>




        
        