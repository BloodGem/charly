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



$busqueda = $_POST["buscarProductos"];
$no_precio = $_POST["no_precio"];

if ($busqueda != "") {
    $porciones = explode(" ", $busqueda);
$contador = count($porciones); 

for ($i=0; $i < $contador; $i++) { 
$GENERA_FILTRO = $GENERA_FILTRO."productos.descripcion_larga LIKE '%".$porciones[$i]."%'";

if ($i < $contador-1) {
    $GENERA_FILTRO = $GENERA_FILTRO." AND ";
}

}

$GENERA_FILTRO = $GENERA_FILTRO." OR ";

for ($i=0; $i < $contador; $i++) { 
$GENERA_FILTRO = $GENERA_FILTRO."productos.clave_producto LIKE '%".$porciones[$i]."%'";

if ($i < $contador-1) {
    $GENERA_FILTRO = $GENERA_FILTRO." AND ";
}

}






$GENERA_FILTRO = $GENERA_FILTRO." OR ";

for ($i=0; $i < $contador; $i++) { 
$GENERA_FILTRO = $GENERA_FILTRO."multiclaves.multiclave LIKE '%".$porciones[$i]."%'";

if ($i < $contador-1) {
    $GENERA_FILTRO = $GENERA_FILTRO." AND ";
}

}


/*$GENERA_FILTRO = $GENERA_FILTRO." OR ";

for ($i=0; $i < $contador; $i++) { 
$GENERA_FILTRO = $GENERA_FILTRO."marca LIKE '%".$porciones[$i]."%'";

if ($i < $contador-1) {
    $GENERA_FILTRO = $GENERA_FILTRO." AND ";
}

}*/

$sql= "SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.ubicacion, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, productos.descripcion_larga, productos.descripcion_corta, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto LEFT JOIN multiclaves ON productos.id_producto = multiclaves.id_producto WHERE (".$GENERA_FILTRO.") AND descontinuado = 0 AND id_sucursal = $id_sucursal GROUP BY productos.id_producto, existencias_sucursales.stock, existencias_sucursales.ubicacion, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, productos.descripcion_larga, productos.descripcion_corta, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo ORDER BY productos.descripcion_corta ASC";
}else{

    /*$sql= "SELECT id_producto, stock, clave_producto, imagen1, imagen2, imagen3, precio1, precio2, precio3, descripcion_corta, nivel_minimo, nivel_medio, nivel_maximo FROM existencias_sucursales INNER JOIN productos ON id_producto = id_producto WHERE id_sucursal = ".$id_sucursal." LIMIT 10";*/
}

//echo $sql;


$rs = $conexion->query($sql);

$contador = 0;



echo ' <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th style="width:5px">Imgs</th>
                          <th>Código</th>
                          <th>Descripción</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>';

while($row = $rs->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">

        <td><a href="'.$row["imagen1"].'" data-toggle="lightbox" data-title="Imagen 1" data-gallery="gallery" tabindex="-1" accesskey="i">
                            <img src="'.$row["imagen1"].'" class="img-fluid mb-2" alt="black sample" width="40px"/>
                        </a>
                        <a href="'.$row["imagen2"].'" data-toggle="lightbox" data-title="Imagen 2" data-gallery="gallery" tabindex="-1">
                        </a>
                        <a href="'.$row["imagen3"].'" data-toggle="lightbox" data-title="Imagen 3" data-gallery="gallery" tabindex="-1">
                        </a>
                        <a href="vistas/img/productos/atras.png" data-toggle="lightbox" data-title="Regresa se acabaron las imagenes" data-gallery="gallery" tabindex="-1">
                        </a>
                    </td>


                    <td>'.$row["clave_producto"].'</td>
                    <td style="font-size:90%;">'.$row["descripcion_corta"].'</td>

                    <td class="botones">
                        <div class="btn-group">
                            <button class="btn-xs btn-primary seleccionarProducto guardaFoco'.$contador.'" contador = "'.$contador.'" id_producto="'.$row["id_producto"].'" descripcion="'.$row["descripcion_corta"].'" clave_producto="'.$row["clave_producto"].'">Seleccionar</button>
                        </div>
                    </td>';


 } ?>




                    
              