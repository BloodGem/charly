<?php 
error_reporting(0);
session_start();
require_once "../../../modelos/conexion2.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/marcas.modelo.php";
require_once "../../../controladores/marcas.controlador.php";


$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
                
$id_sucursal = $traerUsuario['id_sucursal'];



$busqueda3 = $_POST["buscar3"];
$no_precio = $_POST["no_precio"];
$comodin = $_POST["comodin"];

if($comodin == 1){

    $consulta3= "SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.ubicacion, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, productos.descripcion_larga, productos.descripcion_corta, productos.id_marca, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, productos.es_compuesto FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto LEFT JOIN multiclaves ON productos.id_producto = multiclaves.id_producto WHERE productos.clave_producto LIKE '$busqueda3%' AND descontinuado = 0 AND id_sucursal = $id_sucursal GROUP BY existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.ubicacion, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, productos.descripcion_larga, productos.descripcion_corta, productos.id_marca, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo ORDER BY productos.clave_producto ASC";

}//SI EL COMODIN VIENE ACTIVO


//SI EL COMODIN VIENE DESACTIVADO
else{

if ($busqueda3 != "") {
    $porciones3 = explode(" ", $busqueda3);
$contador3 = count($porciones3); 

for ($i3=0; $i3 < $contador3; $i3++) { 
$GENERA_FILTRO3 = $GENERA_FILTRO3."productos.clave_producto LIKE '%".$porciones3[$i3]."%'";

if ($i3 < $contador3-1) {
    $GENERA_FILTRO3 = $GENERA_FILTRO3." AND ";
}

}



$GENERA_FILTRO3 = $GENERA_FILTRO3." OR ";



for ($i3=0; $i3 < $contador3; $i3++) { 
$GENERA_FILTRO3 = $GENERA_FILTRO3."productos.descripcion_larga LIKE '%".$porciones3[$i3]."%'";

if ($i3 < $contador3-1) {
    $GENERA_FILTRO3 = $GENERA_FILTRO3." AND ";
}

}



$GENERA_FILTRO3 = $GENERA_FILTRO3." OR ";

for ($i3=0; $i3 < $contador3; $i3++) { 
$GENERA_FILTRO3 = $GENERA_FILTRO3."multiclaves.multiclave LIKE '%".$porciones3[$i3]."%'";

if ($i3 < $contador3-1) {
    $GENERA_FILTRO3 = $GENERA_FILTRO3." AND ";
}

}


/*$GENERA_FILTRO3 = $GENERA_FILTRO3." OR ";

for ($i3=0; $i3 < $contador3; $i3++) { 
$GENERA_FILTRO3 = $GENERA_FILTRO3."marca LIKE '%".$porciones3[$i3]."%'";

if ($i3 < $contador3-1) {
    $GENERA_FILTRO3 = $GENERA_FILTRO3." AND ";
}

}*/

/*$consulta3= "SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.ubicacion, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, productos.descripcion_larga, productos.descripcion_corta, productos.id_marca, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto WHERE (".$GENERA_FILTRO3.") AND descontinuado = 0 and id_sucursal = $id_sucursal ORDER BY descripcion_larga ASC ";*/



$consulta3= "SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.ubicacion, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, productos.descripcion_larga, productos.descripcion_corta, productos.id_marca, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, productos.es_compuesto FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto LEFT JOIN multiclaves ON productos.id_producto = multiclaves.id_producto WHERE (".$GENERA_FILTRO3.") AND descontinuado = 0 AND id_sucursal = $id_sucursal GROUP BY existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.ubicacion, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, productos.descripcion_larga, productos.descripcion_corta, productos.id_marca, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo ORDER BY productos.descripcion_corta ASC";
}else{

    /*$consulta3= "SELECT id_producto, stock, clave_producto, imagen1, imagen2, imagen3, precio1, precio2, precio3, descripcion_corta, nivel_minimo, nivel_medio, nivel_maximo FROM existencias_sucursales INNER JOIN productos ON id_producto = id_producto WHERE id_sucursal = ".$id_sucursal." LIMIT 10";*/
}

}//SI EL COMODIN VIENE DESACTIVADO


/*if($_SESSION['id'] == 1){
    echo $consulta3;
}*/


$buscardor3 = $conexion->query($consulta3);

$contador = 0;

while($resultado3 = $buscardor3->fetch_array(MYSQLI_BOTH)){ 

 $traerMarca = ControladorMarcas::ctrMostrarMarca($resultado3['id_marca']);

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">

        <td class="imagenes"><a href="'.$resultado3["imagen1"].'" class="imagen1 img" data-toggle="lightbox" data-title="Imagen 1" data-gallery="gallery" tabindex="-1" accesskey="i">
                            <button class="btn btn-xs btn-success"></button>
                        </a>
                        <a href="'.$resultado3["imagen2"].'" class="img" data-toggle="lightbox" data-title="Imagen 2" data-gallery="gallery" tabindex="-1">
                        </a>
                        <a href="'.$resultado3["imagen3"].'" class="img" data-toggle="lightbox" data-title="Imagen 3" data-gallery="gallery" tabindex="-1">
                        </a>
                    </td>

                    
                    <td>'.$resultado3["clave_producto"].'</td>
                    <td style="font-size:90%;">'.$resultado3["descripcion_corta"].'</td>
                    <td>'.$resultado3["ubicacion"].'</td>
                    <td style="font-size:90%;">'.$traerMarca["marca"].'</td> 
                    <td><center>';


                    /*=============================================
            STOCK3
            =============================================*/ 
            if($resultado3["es_compuesto"] == 0){
                if($resultado3["stock"] <= $resultado3["nivel_minimo"]){

                    echo "<button class='btn-xs btn-danger' tabindex='-1' disabled>".$resultado3["stock"]."</button>";

                }else if($resultado3["stock"] > $resultado3["nivel_minimo"] && $resultado3["stock"] <= $resultado3["nivel_medio"]){

                    echo "<button class='btn-xs btn-warning' tabindex='-1' disabled>".$resultado3["stock"]."</button>";

                }else{

                    echo "<button class='btn-xs btn-success' tabindex='-1' disabled>".$resultado3["stock"]."</button>";

                }
            }else{
                echo "<button class='btn-xs btn-success' tabindex='-1' disabled>Compuesto</button>";
            }

            echo '</center></td>';

                    if($no_precio == 1){
                    echo '<td style="text-align: right;">$'.$resultado3["precio1"].'</td>';
                    }elseif($no_precio == 2){

                    echo '<td style="text-align: right;">$'.$resultado3["precio2"].'</td>';
                    
                    }elseif($no_precio == 3){

                    echo '<td style="text-align: right;">$'.$resultado3["precio3"].'</td>';
                    
                    }else{
                        echo '<td style="text-align: right;">$'.$resultado3["precio1"].'</td>';
                    }

                    

                    echo '<td class="botones"><div class="btn-group">
                    <button class="btn-xs btn-primary agregarProducto recuperarBoton guardaFoco'.$contador.'" contador = "'.$contador.'" id_producto="'.$resultado3["id_producto"].'"><small>Agregar</small></button>
                    
                    </div></td>';

/*

<button class="btn-xs btn-success btnSolicitarProducto" id_producto="'.$resultado3["id_producto"].'" tabindex="-1"><small>Solicitar</small></button>


                    <button class="btn-xs btn-info verDetallesProducto" id_producto="'.$resultado3["id_producto"].'" tabindex="-1"><small>Ver detalles</small></button>*/

 } 

echo'<input type="hidden" name="contadorFinal" id="contadorFinal" value="'.$contador.'">';

 ?>




                    
              