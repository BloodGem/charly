<?php 
//error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../controladores/grupos.controlador.php";
require_once "../../modelos/grupos.modelo.php";
require_once "../../modelos/usuarios.modelo.php";
require_once "../../controladores/usuarios.controlador.php";

require_once "conexion.php";

$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
                
$id_sucursal = $traerUsuario['id_sucursal'];



$busquedaCsxp = $_POST["buscarCsxp"];


if ($busquedaCsxp != "") {
    $porcionesCsxp = explode(" ", $busquedaCsxp);
    $contadorCsxp = count($porcionesCsxp); 

    for ($iCsxp=0; $iCsxp < $contadorCsxp; $iCsxp++) { 
        $generaFiltroCsxp = $generaFiltroCsxp."proveedores.nombre LIKE '%".$porcionesCsxp[$iCsxp]."%'";

        if ($iCsxp < $contadorCsxp-1) {
           $generaFiltroCsxp = $generaFiltroCsxp." AND ";
       }

   }




$consultaCsxp= "SELECT proveedores.id_proveedor, proveedores.nombre, SUM(compras.saldo_actual) as adeudo_total FROM compras INNER JOIN proveedores ON compras.id_proveedor = proveedores.id_proveedor WHERE (".$generaFiltroCsxp.") AND compras.estatus = 2 GROUP BY id_proveedor DESC LIMIT 50";
}else{

    $consultaCsxp = "SELECT proveedores.id_proveedor, proveedores.nombre, SUM(compras.saldo_actual) as adeudo_total FROM compras INNER JOIN proveedores ON compras.id_proveedor = proveedores.id_proveedor WHERE compras.estatus = 2 GROUP BY id_proveedor DESC LIMIT 50";
}



$rsBuscadorCsxp = $conexion->query($consultaCsxp);  

echo '<table class="table table-bordered table-striped" id="tablaProveedoresDeuda">
        <thead>
          <tr>
            <th>Proveedor</th>
            <th style="text-align: right;">Adeudos</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>';
    

while($resultadoCsxp = $rsBuscadorCsxp->fetch_array(MYSQLI_BOTH)){ 


    

    echo '<tr>
    <td>
    '.$resultadoCsxp["nombre"].'
    </td>
    <td style="text-align: right;">
    $'.number_format($resultadoCsxp["adeudo_total"], 2).'
    </td>

    <td><div class="btn-group">';

    $respuesta2 = ControladorGrupos::ctrMostrarGrupo($traerUsuario['id_grupo']);

    $array = json_decode($respuesta2['permisos']);

    $indiceSeguimientoCsxp = array_search("Seguimiento de compras",$array,true);

    if($indiceSeguimientoCsxp == 0){

        echo '-';
       
    }else if($indiceSeguimientoCsxp !== ""){

        echo '<button class="btn btn-info btnVerCsxpProveedor" nombre="'.$resultadoCsxp["nombre"].'" adeudo_total="'.$resultadoCsxp["adeudo_total"].'" id_proveedor="'.$resultadoCsxp["id_proveedor"].'" accesskey="2" data-toggle="modal" data-target="#modalVerCsxpProveedor">Ver</button>'; 

    }
    
    echo '</div></td>';

    


} 


echo '<tfoot>
      <tr>
        <th>Folio</th>
        <th style="text-align: right;">Adeudos</th>
        <th>Acciones</th>
    </tr>
</tfoot>
</table>';

?>





