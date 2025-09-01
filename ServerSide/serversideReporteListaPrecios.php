<?php
require 'serverside.php';

$viewServersideReporteListaPrecios = $_GET['viewServersideReporteListaPrecios'];

$table_data->get($viewServersideReporteListaPrecios,'id_producto',array('clave_producto', 'descripcion_corta', 'stock', 'ubicacion', 'precio1'));

?>