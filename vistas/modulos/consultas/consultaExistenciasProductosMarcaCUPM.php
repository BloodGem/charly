<?php
//error_reporting(0);
session_start();
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/existencias-sucursales.controlador.php";
require_once "../../../modelos/existencias-sucursales.modelo.php";


$id_usuario = $_SESSION['id'];
$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($id_usuario);
$id_sucursal = $traerUsuario['id_sucursal'];

$id_marca = $_POST['id_marca'];


if($id_marca == ""){
    return;
}

/*$sql = "SELECT existencias_sucursales.id_producto, existencias_sucursales.stock, productos.clave_producto, existencias_sucursales.precio1, existencias_sucursales.precio2, existencias_sucursales.precio3, productos.descripcion_larga, productos.descripcion_corta, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto WHERE productos.descontinuado = 0 AND productos.id_marca = $id_marca AND existencias_sucursales.id_sucursal = $id_sucursal";

echo $sql;*/

$traerProductos = ControladorExistenciasSucursales::ctrExistenciasProductosMarcaCUPM($id_marca, $id_sucursal);



echo '<table id="tablaProductosMarca" class="table-sm table-bordered table-hover">
<thead>
<tr>
<th style="text-align: center;">Clave</th>
<th style="text-align: center;">Producto</th>
<th style="text-align: right;">Precio Compra</th>
<th style="text-align: right;">Precio1</th>
<th style="text-align: right;">Utilidad1</th>
<th style="text-align: right;">Precio2</th>
<th style="text-align: right;">Utilidad2</th>
<th style="text-align: right;">Precio3</th>
<th style="text-align: right;">Utilidad3</th>
</tr>
</thead>
<tbody>';


foreach ($traerProductos as $key => $row) {


    echo '<tr>
    <td style="text-align: center;">'.$row["clave_producto"].'</td>
    <td style="text-align: center;">'.$row["descripcion_corta"].'</td>
    <td style="text-align: right;">$'.$row["precio_compra"].'</td>
    <td style="text-align: right;">$'.$row["precio1"].'</td>
    <td style="text-align: right;">'.$row["utilidad1"].'%</td>
    <td style="text-align: right;">$'.$row["precio2"].'</td>
    <td style="text-align: right;">'.$row["utilidad2"].'%</td>
    <td style="text-align: right;">$'.$row["precio3"].'</td>
    <td style="text-align: right;">'.$row["utilidad3"].'%</td>
    </tr>';
}


echo '</tbody>
<tfoot>
<tr>
<th style="text-align: center;">Clave</th>
<th style="text-align: center;">Producto</th>
<th style="text-align: right;">Precio Compra</th>
<th style="text-align: right;">Precio1</th>
<th style="text-align: right;">Utilidad1</th>
<th style="text-align: right;">Precio2</th>
<th style="text-align: right;">Utilidad2</th>
<th style="text-align: right;">Precio3</th>
<th style="text-align: right;">Utilidad3</th>
</tr>
</tfoot>
</table>';



















    


?>