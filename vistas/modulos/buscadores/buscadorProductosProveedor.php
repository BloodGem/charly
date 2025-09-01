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

$id_proveedor = $_POST["id_proveedor"];


$sql= "SELECT productos.id_producto, productos.clave_producto, productos.imagen1, productos.imagen2, productos.descripcion_larga, productos.descripcion_corta, productos_proveedores.clave_prod_prov FROM productos INNER JOIN productos_proveedores ON productos.id_producto = productos_proveedores.id_producto WHERE productos_proveedores.id_proveedor = ".$id_proveedor." ORDER BY productos.descripcion_corta ASC";


$rs = $conexion->query($sql);

$contador = 0;



echo ' <table class="table table-bordered table-striped" id="tablaProductosProveedor">
                      <thead>
                        <tr>
                          <th style="width:5px">Imgs</th>
                          <th>Clave proveedor</th>
                          <th>Código</th>
                          <th>Descripción</th>
                          <th>Acciones</th>
                        </tr>
                      </thead><tbody>';

while($row = $rs->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">

        <td class="imagenes"><a href="'.$row["imagen1"].'" class="imagen1 img" data-toggle="lightbox" data-title="Imagen 1" data-gallery="gallery" tabindex="-1" accesskey="i">
                            <img src="'.$row["imagen1"].'" class="img-fluid mb-2" alt="black sample" width="40px"/>
                        </a>
                        <a href="'.$row["imagen2"].'" data-toggle="lightbox" data-title="Imagen 2" data-gallery="gallery" tabindex="-1">
                        </a>
                    </td>

                    
                    <td>'.$row["clave_prod_prov"].'</td>
                    <td>'.$row["clave_producto"].'</td>
                    <td style="font-size:90%;">'.$row["descripcion_corta"].'</td>

                    <td class="botones">
                        <div class="btn-group">
                            <button class="btn-xs btn-primary seleccionarProducto guardaFoco'.$contador.'" contador = "'.$contador.'" id_producto="'.$row["id_producto"].'">Cambiar clave</button>
                        </div>
                    </td>';


 } 






 echo '
                      </tbody>
                      <tfoot>
                        <tr>
                          <th style="width:5px">Imgs</th>
                          <th>Clave proveedor</th>
                          <th>Código</th>
                          <th>Descripción</th>
                          <th>Acciones</th>
                        </tr>
                      </tfoot></table>';
 ?>




                    
              