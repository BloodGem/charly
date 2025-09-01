<?php
require 'serverside.php';

$table_data->get("serverside_movimientos_inventario",'id_producto',array('clave_producto', 'descripcion_corta', 'ubicacion', 'mo_entsal', 'mo_cant'));

?>