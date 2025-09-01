<?php
//error_reporting(0);
session_start();

require_once "../../../modelos/conexion2.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";



$no_rango = $_POST['no_rango'];
$id_producto = $_POST['id_producto'];
$id_sucursal = $_POST['id_sucursal'];

if($no_rango == "" || $id_producto == "" || $id_sucursal == ""){
    return;
}


if(isset($_POST['rango_fecha'])){
    $rango_fecha = $_POST['rango_fecha'];
    $mes1 = substr( $rango_fecha, 0, 2 );
    $dia1 = substr( $rango_fecha, 3, 2 );
    $ano1 = substr( $rango_fecha, 6, 4 );
    $fecha1 = $ano1 ."-". $mes1 ."-". $dia1;

    $mes2 = substr( $rango_fecha, 13, 2 );
    $dia2 = substr( $rango_fecha, 16, 2 );
    $ano2 = substr( $rango_fecha, 19, 4 );
    $fecha2 = $ano2 ."-". $mes2 ."-". $dia2;

}



switch ($no_rango) {

    case 1:

    $dia = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59' ;

    //$fecha1 = date("Y/m/d", strtotime("today"));
    //$fecha2 = date("Y/m/d", strtotime("today"));





    $sql = "SELECT * FROM kardex_productos WHERE mo_fecha BETWEEN '$fecha1' AND '$fecha2' AND id_producto = $id_producto AND id_sucursal = $id_sucursal ORDER BY mo_fecha ASC";

    break;

    case 2:

    $dia = date("Y-m-d", strtotime("yesterday"));
    $fecha1 = $dia . ' 00:00:00';
    $fecha2 = $dia . ' 23:59:59' ;





    $sql = "SELECT * FROM kardex_productos WHERE mo_fecha BETWEEN '$fecha1' AND '$fecha2' AND id_producto = $id_producto AND id_sucursal = $id_sucursal ORDER BY mo_fecha ASC";
    break;
    case 3:

    if(date("D")=="Mon"){
        $lunes = date("Y-m-d");
    }else{
        $lunes = date("Y-m-d", strtotime('last Monday', time()));
    }


    $dia1 = $lunes;
    $dia2 = date('Y-m-d', strtotime('this Sunday', time()));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;


    $sql = "SELECT * FROM kardex_productos WHERE mo_fecha BETWEEN '$fecha1' AND '$fecha2' AND id_producto = $id_producto AND id_sucursal = $id_sucursal ORDER BY mo_fecha ASC";

    break;

    case 4:

    if(date("D")=="Mon"){
        $lunes = date("Y-m-d", strtotime('last Monday', time()));
    }else{
        $lunes = date("Y-m-d", strtotime('last Monday - 7 days', time()));
    }


    $dia1 = $lunes;
    $dia2 = date('Y-m-d', strtotime('last Sunday', time()));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    $sql = "SELECT * FROM kardex_productos WHERE mo_fecha BETWEEN '$fecha1' AND '$fecha2' AND id_producto = $id_producto AND id_sucursal = $id_sucursal ORDER BY mo_fecha ASC";

    break;

    case 5:
    $dia1 = date("Y-m-d", strtotime("today - 6 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    $sql = "SELECT * FROM kardex_productos WHERE mo_fecha BETWEEN '$fecha1' AND '$fecha2' AND id_producto = $id_producto AND id_sucursal = $id_sucursal ORDER BY mo_fecha ASC";
    break;

    case 6:
    $dia1 = date("Y-m-d", strtotime("today - 29 days"));
    $dia2 = date("Y-m-d", strtotime("today"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    $sql = "SELECT * FROM kardex_productos WHERE mo_fecha BETWEEN '$fecha1' AND '$fecha2' AND id_producto = $id_producto AND id_sucursal = $id_sucursal ORDER BY mo_fecha ASC";

    break;

    case 7:

    $dia1 = date("Y-m-d", strtotime("first day of this month"));
    $dia2 = date("Y-m-d", strtotime("last day of this month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;


    $sql = "SELECT * FROM kardex_productos WHERE mo_fecha BETWEEN '$fecha1' AND '$fecha2' AND id_producto = $id_producto AND id_sucursal = $id_sucursal ORDER BY mo_fecha ASC";

    break;

    case 8:

    $dia1 = date("Y-m-d", strtotime("first day of last month"));
    $dia2 = date("Y-m-d", strtotime("last day of last month"));
    $fecha1 = $dia1 . ' 00:00:00';
    $fecha2 = $dia2 . ' 23:59:59' ;

    $sql = "SELECT * FROM kardex_productos WHERE mo_fecha BETWEEN '$fecha1' AND '$fecha2' AND id_producto = $id_producto AND id_sucursal = $id_sucursal ORDER BY mo_fecha ASC";

    break;

    case 9:

    $fecha1 = $fecha1 . ' 00:00:00';
    $fecha2 = $fecha2 . ' 23:59:59' ;

    $sql = "SELECT * FROM kardex_productos WHERE mo_fecha BETWEEN '$fecha1' AND '$fecha2' AND id_producto = $id_producto AND id_sucursal = $id_sucursal ORDER BY mo_fecha ASC";


    break;
    
}


$rs = $conexion->query($sql);                         
    //Recogemos las claves enviadas



echo '<table id="tablaKardex" class="table table-bordered table-hover">
<thead>
<tr>
<th>Fecha</th>
<th>Concepto</th>
<th>Referencia</th>
<th>Producto</th>
<th>Cantidad</th>
<th>Existencias</th>
<th>Tipo</th>
</tr>
</thead>
<tbody>';



while($row = $rs->fetch_array(MYSQLI_BOTH)){

    $traerProducto= ControladorProductos::ctrMostrarProducto($row['id_producto']);

                        //$traerSucursal = ControladorSucursales::ctrMostrarSucursal($row['id_sucursal']);

    echo '<tr>
    <td>'.$row["mo_fecha"].'</td>
    <td>'.$row["mo_tipo"].'</td>
    <td>'.$row["mo_refer"].'</td>
    <td>'.$traerProducto["descripcion_corta"].'</td>
    <td>'.$row["mo_cant"].'</td>
    <td>'.$row["mo_existencias"].'</td>
    <td>'.$row["mo_entsal"].'</td>
    </tr>';
}


echo '</tbody>
<tfoot>
<tr>
<th>Fecha</th>
<th>Concepto</th>
<th>Referencia</th>
<th>Producto</th>
<th>Cantidad</th>
<th>Existencias</th>
<th>Tipo</th>
</tr>
</tfoot>
</table>';



















    


?>