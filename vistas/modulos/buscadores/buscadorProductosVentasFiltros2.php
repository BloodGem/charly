<?php 
//error_reporting(0);
session_start();

require_once "../../../modelos/conexion2.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";

function highlightWords($text, $word){
    $text = preg_replace('#'. preg_quote($word) .'#i', '<span style="background-color: #F9F902;">\0</span>', $text);
    return $text;
}

//require_once "conexion.php";

$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
                
$id_sucursal = $traerUsuario['id_sucursal'];

$id_grupo = $traerUsuario['id_grupo'];

$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);

$array = json_decode($respuesta2['permisos']);

$consultaProductos = "";

if(isset($_POST["buscarProductosD"])){
    $no_precio = $_POST["no_precio"];
    //$busquedaProductos = ucwords($_POST["buscarProductosD"]);
    $busquedaProductos = $_POST["buscarProductosD"];

    $no_letras = mb_strlen($busquedaProductos);

    //var_dump("producto a buscar: ".$busquedaProductos."<br>");

    //var_dump("Número de letras: ".$no_letras."<br>");

    if($no_letras >= 3){

        $generaFiltroProductos = "";


        if($busquedaProductos != "") {
            $porcionesProductos = explode(" ", $busquedaProductos);
            $contadorProductos = count($porcionesProductos); 

            for ($iProductos=0; $iProductos < $contadorProductos; $iProductos++) { 
                $generaFiltroProductos = $generaFiltroProductos."productos.descripcion_larga LIKE '%".$porcionesProductos[$iProductos]."%'";

                if ($iProductos < $contadorProductos-1) {
                    $generaFiltroProductos = $generaFiltroProductos." AND ";
                }

            }

            $generaFiltroProductos = $generaFiltroProductos." OR ";


            for ($iProductos=0; $iProductos < $contadorProductos; $iProductos++) { 
                $generaFiltroProductos = $generaFiltroProductos."productos.clave_producto LIKE '%".$porcionesProductos[$iProductos]."%'";

                if ($iProductos < $contadorProductos-1) {
                    $generaFiltroProductos = $generaFiltroProductos." AND ";
                }

            }

            $consultaProductosD = "SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.ubicacion, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, productos.descripcion_larga, productos.descripcion_corta, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto WHERE (".$generaFiltroProductos.") AND id_sucursal = ".$id_sucursal." AND productos.descontinuado = 0 ORDER BY descripcion_larga ASC LIMIT 50";

            $consultaProductosC = "SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, existencias_sucursales.ubicacion, productos.clave_producto, productos.imagen1, productos.imagen2, productos.imagen3, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, productos.descripcion_larga, productos.descripcion_corta, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto WHERE productos.clave_producto = '".$busquedaProductos."' AND id_sucursal = ".$id_sucursal." AND productos.descontinuado = 0 ORDER BY descripcion_larga ASC LIMIT 50";

            //echo $consultaProductosC;
        }
    }
}


//var_dump($consultaProductosD);

if($consultaProductosD !== "" && $consultaProductosC !== ""){

    echo'<table class="table table-bordered table-striped listaProductosVentas" style="font-size:13px; background-color: white;">
                <thead>
                    <tr>
                          <th>Código</th>
                          <th>Descripción</th>
                          <th>Stock</th>
                          <th>Precio</th>
                          <th style="width:5px">Imgs</th>
                    </tr>
                </thead>
                <tbody>';




$rsBuscadorProductos = $conexion->query($consultaProductosC);
$respuesta = $rsBuscadorProductos->fetch_array(MYSQLI_BOTH);

//var_dump($respuesta);

if($respuesta == null){
    $rsBuscadorProductos = "";
    $rsBuscadorProductos = $conexion->query($consultaProductosD);  
}else{
    $rsBuscadorProductos = $conexion->query($consultaProductosC);
}


$contador = 0;
while($resultadoProductos = $rsBuscadorProductos->fetch_array(MYSQLI_BOTH)){ 
$contador = $contador + 1;


$descripcion_larga = $resultadoProductos["descripcion_larga"];


    for ($iProductos=0; $iProductos < $contadorProductos; $iProductos++) {

        $texto = highlightWords($porcionesProductos[$iProductos], $porcionesProductos[$iProductos]);


            $descripcion_larga = str_replace($porcionesProductos[$iProductos], $texto, $descripcion_larga);
}

$clave_producto = $resultadoProductos["clave_producto"];

for ($iProductos=0; $iProductos < $contadorProductos; $iProductos++) {

        $texto = highlightWords($porcionesProductos[$iProductos], $porcionesProductos[$iProductos]);


            $clave_producto = str_replace($porcionesProductos[$iProductos], $texto, $clave_producto);
}

                


    echo '<tr class="contador'.$contador.'">
    
    <td>
    <div class="btn-group">
                <button class="btn-xs btn-primary agregarProducto recuperarBoton" id_producto="'.$resultadoProductos["id_producto"].'" contador="'.$contador.'"></button>
                </div>
    '.$clave_producto.'
    </td>

    <td>
    '.$descripcion_larga.'
    </td><td>';

          /*=============================================
            STOCK3
            =============================================*/ 

            if($resultadoProductos["stock"] <= $resultadoProductos["nivel_minimo"]){

                echo "<button class='btn btn-danger btn-sm' tabindex='-1'>".$resultadoProductos["stock"]."</button>";

            }else if($resultadoProductos["stock"] > $resultadoProductos["nivel_minimo"] && $resultadoProductos["stock"] <= $resultadoProductos["nivel_medio"]){

                echo "<button class='btn btn-warning btn-sm' tabindex='-1'>".$resultadoProductos["stock"]."</button>";

            }else{

                echo "<button class='btn btn-success btn-sm' tabindex='-1'>".$resultadoProductos["stock"]."</button>";

            }


            echo '</td>';

            if($no_precio == 1){
                    echo '</td>
                    <td>'.round($resultadoProductos["precio1"]).'</td>';
                    }elseif($no_precio == 2){

                    echo '
                    </td>
                    <td>'.$resultadoProductos["precio2"].'</td>';
                    
                    }elseif($no_precio == 3){

                    echo '
                    </td>
                    <td>'.$resultadoProductos["precio3"].'</td>';
                    
                    }else{
                        echo '
                    </td>
                    <td>'.round($resultadoProductos["precio1"]).'</td>';
                    }

            echo '<td class="imagenes"><a href="'.$resultadoProductos["imagen1"].'" class="imagen1 img"  data-toggle="lightbox" data-title="Imagen 1 - '.$resultadoProductos["clave_producto"].' " data-gallery="gallery" data-backdrop="static" tabindex="-1">
    <img src="'.$resultadoProductos["imagen1"].'" class="img-fluid mb-2" width="40px" />
    </a>
    <a href="'.$resultadoProductos["imagen2"].'" class="img" data-toggle="lightbox" data-title="Imgaen 2 - '.$resultadoProductos["clave_producto"].'" data-gallery="gallery" tabindex="-1">
    </a>
    </td>
    </tr>';

            


        }

        echo'</tbody><tfoot>
                </tfoot>
            </table>

           <br><br> 

           <input type="hidden" name="contadorFinal" id="contadorFinal" value="'.$contador.'">';

    }




 /*echo '<td>
                    <button class="btn-xs btn-primary agregarProducto recuperarBoton" id_producto="'.$resultado3["id_producto"].'">Agregar</button>
                    <button class="btn-xs btn-info verAutosProducto" id_producto="'.$resultado3["id_producto"].'" tabindex="-1" data-toggle="modal" data-target="#modalVerAutosProducto">Autos</button>
                    <button class="btn-xs btn-success btnSolicitarProducto" id_producto="'.$resultado3["id_producto"].'" tabindex="-1">Solicitar</button>
                    </td>';*/?>




                    
              