<?php
require 'serverside.php';

$viewServersideRAP = $_GET['viewServersideRAP'];

$table_data->get($viewServersideRAP,'id_producto',array('clave_producto', 'descripcion_corta', 'precio_compra', 'stock', 'nivel_minimo', 'nivel_maximo', 'a_pedir'));

?>