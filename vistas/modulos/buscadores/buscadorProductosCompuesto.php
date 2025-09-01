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

$genera_filtro = "";

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




$consulta= "SELECT productos.id_producto, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, productos.descripcion_larga, productos.descripcion_corta, productos.id_marca FROM productos WHERE (".$genera_filtro.") AND productos.descontinuado = 0 ORDER BY productos.descripcion_corta ASC LIMIT 10";
}else{

    return;

    /*$consulta= "SELECT id_producto, stock, clave_producto, imagen1, imagen2, imagen, precio1, precio2, precio, descripcion_corta, nivel_minimo, nivel_medio, nivel_maximo FROM existencias_sucursales INNER JOIN productos ON id_producto = id_producto WHERE id_sucursal = ".$id_sucursal." LIMIT 10";*/
}



$buscardor = $conexion->query($consulta);

$contador = 0;

echo '<table class="table table-bordered table-striped">
                                          <thead>
                                            <tr>
                                              <th style="width:5px">Imgs</th>
                                              <th>Clave</th>
                                              <th>Descripción</th>
                                              <th>Acciones</th>
                                            </tr>
                                          </thead>
                                          <tbody>';
                                            
                                          

while($resultado = $buscardor->fetch_array(MYSQLI_BOTH)){ 


$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">

        <td><a href="'.$resultado["imagen1"].'" data-toggle="lightbox" data-title="Imagen 1" data-gallery="gallery" tabindex="-1" accesskey="i">
                            <img src="'.$resultado["imagen1"].'" class="img-fluid mb-2" alt="black sample" width="40px"/>
                        </a>
                        <a href="'.$resultado["imagen2"].'" data-toggle="lightbox" data-title="Imagen 2" data-gallery="gallery" tabindex="-1">
                        </a>
                        <a href="'.$resultado["imagen3"].'" data-toggle="lightbox" data-title="Imagen " data-gallery="gallery" tabindex="-1">
                        </a>
                        <a href="vistas/img/productos/atras.png" data-toggle="lightbox" data-title="Regresa se acabaron las imagenes" data-gallery="gallery" tabindex="-1">
                        </a>
                    </td>


                    <td>'.$resultado["clave_producto"].'</td>
                    <td style="font-size:90%;">'.$resultado["descripcion_corta"].'</td> 
                    <td class="botones"><div class="btn-group">
                    <button type="button" class="btn-xs btn-primary agregarProducto recuperarBoton guardaFoco'.$contador.'" contador = "'.$contador.'" id_producto="'.$resultado["id_producto"].'">Agregar</button>
                    </div></td>';


 } 





echo '<tfooter>
                                            <tr>
                                              <th style="width:5px">Imgs</th>
                                              <th>Clave</th>
                                              <th>Descripción</th>
                                              <th>Acciones</th>
                                            </tr>
                                          </tfooter>
                                          </table>';




 ?>




                    
              