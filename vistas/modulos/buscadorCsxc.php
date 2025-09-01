<?php 
error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../controladores/grupos.controlador.php";
require_once "../../modelos/grupos.modelo.php";
require_once "../../modelos/usuarios.modelo.php";
require_once "../../controladores/usuarios.controlador.php";

require_once "conexion.php";

$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
                
$id_sucursal = $traerUsuario['id_sucursal'];



$busquedaCsxc = $_POST["buscarCsxc"];


if ($busquedaCsxc != "") {
    $porcionesCsxc = explode(" ", $busquedaCsxc);
    $contadorCsxc = count($porcionesCsxc); 

    for ($iCsxc=0; $iCsxc < $contadorCsxc; $iCsxc++) { 
        $generaFiltroCsxc = $generaFiltroCsxc."clientes.nombre LIKE '%".$porcionesCsxc[$iCsxc]."%'";

        if ($iCsxc < $contadorCsxc-1) {
           $generaFiltroCsxc = $generaFiltroCsxc." AND ";
       }

   }




$consultaCsxc= "SELECT clientes.id_cliente, clientes.nombre, SUM(ventas.saldo_actual) as adeudo_total FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE (".$generaFiltroCsxc.") AND id_forma_pago = 'PPD' GROUP BY id_cliente DESC LIMIT 50";
}else{

    $consultaCsxc = "SELECT clientes.id_cliente, clientes.nombre, SUM(ventas.saldo_actual) as adeudo_total FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE id_forma_pago = 'PPD' GROUP BY id_cliente DESC LIMIT 50";
}



$rsBuscadorCsxc = $conexion->query($consultaCsxc);  

while($resultadoCsxc = $rsBuscadorCsxc->fetch_array(MYSQLI_BOTH)){ 


    

    echo '<tr>
    <td>
    '.$resultadoCsxc["id_cliente"].'
    </td>
    <td>
    '.$resultadoCsxc["nombre"].'
    </td>
    <td style="text-align: right;">
    $'.number_format($resultadoCsxc["adeudo_total"], 2).'
    </td>

    <td><div class="btn-group">';

    $respuesta2 = ControladorGrupos::ctrMostrarGrupo($traerUsuario['id_grupo']);

    $array = json_decode($respuesta2['permisos']);

    $indiceSeguimientoCsxc = array_search("Seguimiento de ventas",$array,true);

    if($indiceSeguimientoCsxc == 0){

        echo '-';
       
    }else if($indiceSeguimientoCsxc !== ""){

        echo '<button class="btn btn-info btnVerCsxcCliente" nombre="'.$resultadoCsxc["nombre"].'" adeudo_total="'.$resultadoCsxc["adeudo_total"].'" id_cliente="'.$resultadoCsxc["id_cliente"].'" accesskey="2" data-toggle="modal" data-target="#modalVerCsxcCliente">Ver</button>'; 

    }
    
    echo '</div></td>';

    


} ?>





