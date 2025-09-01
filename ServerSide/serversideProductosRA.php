<?php
require 'serverside.php';

$viewServersideRA = $_GET['viewServersideRA'];

$table_data->get($viewServersideRA,'id_producto',array('clave_producto', 'descripcion_corta', 'precio_compra', 'stock', 'nivel_minimo', 'nivel_maximo', 'a_pedir'));

?>