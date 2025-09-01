<?php
require 'serverside.php';

$serverside = $_GET['serverside'];

$table_data->get($serverside,'id_producto',array('clave_producto', 'descripcion_corta'));

?>