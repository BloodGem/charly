<?php 
error_reporting(0);
session_start();
require_once "../../../modelos/conexion2.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/otros.modelo.php";
require_once "../../../controladores/otros.controlador.php";


$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
$id_sucursal = $traerUsuario['id_sucursal'];

$id_grupo = $traerUsuario['id_grupo'];

$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);

$array = json_decode($respuesta2['permisos']);

$busquedaFacturasGlobales = $_POST["buscarFacturasGlobales"];


if ($busquedaFacturasGlobales != "") {


        

    /*$porcionesFacturasGlobales = explode(" ", $busquedaFacturasGlobales);
    $contadorFacturasGlobales = count($porcionesFacturasGlobales); 

    for ($iFacturasGlobales=0; $iFacturasGlobales < $contadorFacturasGlobales; $iFacturasGlobales++) { 
        $generaFiltroFacturasGlobales = $generaFiltroFacturasGlobales."id_factura_global LIKE '%".$porcionesFacturasGlobales[$iFacturasGlobales]."%'";

        if ($iFacturasGlobales < $contadorFacturasGlobales-1) {
           $generaFiltroFacturasGlobales = $generaFiltroFacturasGlobales." AND ";
       }

   }


   $generaFiltroFacturasGlobales = $generaFiltroFacturasGlobales." OR ";

for ($iFacturasGlobales=0; $iFacturasGlobales < $contadorFacturasGlobales; $iFacturasGlobales++) { 
    $generaFiltroFacturasGlobales = $generaFiltroFacturasGlobales."DATE_FORMAT(fecha_creacion,'%d-%m-%Y') LIKE '%".$porcionesFacturasGlobales[$iFacturasGlobales]."%'";

    if ($iFacturasGlobales < $contadorFacturasGlobales-1) {
       $generaFiltroFacturasGlobales = $generaFiltroFacturasGlobales." AND ";
   }

}*/




$consultaFacturasGlobales= "SELECT * FROM facturas_globales WHERE id_factura_global = $busquedaFacturasGlobales AND id_sucursal = $id_sucursal";


}else{

    $consultaFacturasGlobales= "SELECT * FROM facturas_globales WHERE id_sucursal = $id_sucursal ORDER BY id_factura_global DESC LIMIT 75";
}



$rsBuscadorFacturasGlobales = $conexion->query($consultaFacturasGlobales);

echo '<table class="table-sm table-bordered table-striped" id="tablaFacturasGlobales">
            <thead>
                  <tr>
                  <th></th>
                    <th>No.</th>
                    <th>UUID</th>
                    <th style="text-align: right;">Bruto</th>
                    <th style="text-align: right;">Impuesto</th>
                    <th style="text-align: right;">Total</th>
                    <th>Forma Pago</th>
                    <th>Fecha</th>
                    <th>Fecha Inicial</th>
                    <th>Fecha Final</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>';
                  

$contador = 0;

while($resultadoFacturasGlobales = $rsBuscadorFacturasGlobales->fetch_array(MYSQLI_BOTH)){ 


    $traerFormaPago = ControladorOtros::ctrMostrarFormaPago($resultadoFacturasGlobales['id_forma_pago']);

$contador = $contador + 1;


echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
    

    <td>
    '.$resultadoFacturasGlobales["id_factura_global"].'
    </td>
    <td>
    '.$resultadoFacturasGlobales["uuid"].'
    </td>
    <td style="text-align: right;">
    $'.number_format($resultadoFacturasGlobales["bruto"], 2).'
    </td>
    <td style="text-align: right;">
    $'.number_format($resultadoFacturasGlobales["impuesto"], 2).'
    </td>
    <td style="text-align: right;">
    $'.number_format($resultadoFacturasGlobales["total"], 2).'
    </td>
    <td>
    '.$traerFormaPago["descripcion"].'
    </td>
    <td>
    '.$resultadoFacturasGlobales["fecha_creacion"].'
    </td>
    <td>
    '.$resultadoFacturasGlobales["fecha_inicial"].'
    </td>
    <td>
    '.$resultadoFacturasGlobales["fecha_final"].'
    </td>

    <td>
        <div class="btn-group">';
        if($resultadoFacturasGlobales['facturado'] == 0 && $resultadoFacturasGlobales['uuid'] == ""){
            echo '<button class="btn-xs btn-dark btnTimbrarFacturaGlobal" id_factura_global="'.$resultadoFacturasGlobales["id_factura_global"].'">Facturar</button>';
        }else{
            echo '<button class="btn-xs btn-info btnDescargarPDFFacturaGlobal" id_factura_global="'.$resultadoFacturasGlobales["id_factura_global"].'">PDF</button>
        <button class="btn-xs btn-primary btnDescargarXMLFacturaGlobal" id_factura_global="'.$resultadoFacturasGlobales["id_factura_global"].'">XML</button>
        <button class="btn-xs btn-dark btnDescargarPDFVentasFacturaGlobal" id_factura_global="'.$resultadoFacturasGlobales["id_factura_global"].'">PDF Ventas</button>
        <button class="btn-xs btn-danger btnComprimirVentasFacturaGlobal" id_factura_global="'.$resultadoFacturasGlobales["id_factura_global"].'">Zip Ventas</button>';
        }
        


        echo'</div>
    </td>';
            
    

    


} 



echo '</tbody>
                  <tfoot>
                  <tr>
                  <th></th>
                    <th>No.</th>
                    <th>UUID</th>
                    <th style="text-align: right;">Bruto</th>
                    <th style="text-align: right;">Impuesto</th>
                    <th style="text-align: right;">Total</th>
                    <th>Forma Pago</th>
                    <th>Fecha</th>
                    <th>Fecha Inicial</th>
                    <th>Fecha Final</th>
                    <th>Acciones</th>
                  </tr>
                  </tfoot>
        </table>';



        ?>



