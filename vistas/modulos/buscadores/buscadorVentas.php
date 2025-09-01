<?php 
error_reporting(0);
session_start();
require_once "../../../modelos/conexion2.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../controladores/cajas.controlador.php";
require_once "../../../modelos/cajas.modelo.php";
require_once "../../../controladores/vendedores.controlador.php";
require_once "../../../modelos/vendedores.modelo.php";

$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
$id_sucursal = $traerUsuario['id_sucursal'];

$id_grupo = $traerUsuario['id_grupo'];

$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);

$array = json_decode($respuesta2['permisos']);

$busquedaVentas = $_POST["buscarVentas"];


if ($busquedaVentas != "") {


        

    /*$porcionesVentas = explode(" ", $busquedaVentas);
    $contadorVentas = count($porcionesVentas); 

    for ($iVentas=0; $iVentas < $contadorVentas; $iVentas++) { 
        $generaFiltroVentas = $generaFiltroVentas."ventas.id LIKE '%".$porcionesVentas[$iVentas]."%'";

        if ($iVentas < $contadorVentas-1) {
           $generaFiltroVentas = $generaFiltroVentas." AND ";
       }

   }




$generaFiltroVentas = $generaFiltroVentas." OR ";

for ($iVentas=0; $iVentas < $contadorVentas; $iVentas++) { 
    $generaFiltroVentas = $generaFiltroVentas."ventas.folio LIKE '%".$porcionesVentas[$iVentas]."%'";

    if ($iVentas < $contadorVentas-1) {
       $generaFiltroVentas = $generaFiltroVentas." AND ";
   }
}



$generaFiltroVentas = $generaFiltroVentas." OR ";

for ($iVentas=0; $iVentas < $contadorVentas; $iVentas++) { 
    $generaFiltroVentas = $generaFiltroVentas."clientes.nombre LIKE '%".$porcionesVentas[$iVentas]."%'";

    if ($iVentas < $contadorVentas-1) {
       $generaFiltroVentas = $generaFiltroVentas." AND ";
   }

}


$consultaVentas= "SELECT ventas.id, ventas.folio, ventas.id_cliente, clientes.nombre, ventas.celular, ventas.total, ventas.saldo_actual, ventas.tipo_venta, ventas.pagada, ventas.entregada, ventas.cancelada, ventas.facturado, ventas.enviada, ventas.uuid, DATE_FORMAT(ventas.fecha_creacion,'%d-%m-%Y') as fecha, ventas.id_vendedor, ventas.id_corte_caja FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE (".$generaFiltroVentas.") AND id_sucursal = $id_sucursal ORDER BY id DESC LIMIT 75";*/


$consultaVentas= "SELECT ventas.id, ventas.folio, ventas.id_cliente, clientes.nombre, ventas.celular, ventas.total, ventas.saldo_actual, ventas.tipo_venta, ventas.pagada, ventas.entregada, ventas.cancelada, ventas.facturado, ventas.enviada, ventas.uuid, DATE_FORMAT(ventas.fecha_creacion,'%d-%m-%Y') as fecha, ventas.id_vendedor, ventas.id_corte_caja FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE id_sucursal = $id_sucursal AND (ventas.id = '$busquedaVentas' OR ventas.folio = '$busquedaVentas')";


}else{

$consultaVentas = "SELECT ventas.id, ventas.folio, ventas.id_cliente, clientes.nombre, ventas.celular, ventas.total, ventas.saldo_actual, ventas.tipo_venta, ventas.pagada, ventas.entregada, ventas.cancelada, ventas.facturado, ventas.enviada, ventas.uuid, DATE_FORMAT(ventas.fecha_creacion,'%d-%m-%Y') as fecha, ventas.id_vendedor, ventas.id_corte_caja FROM ventas INNER JOIN clientes ON ventas.id_cliente = clientes.id_cliente WHERE id_sucursal = $id_sucursal ORDER BY id DESC LIMIT 75";
}

//echo $consultaVentas;

$rsBuscadorVentas = $conexion->query($consultaVentas);

echo '<table class="table-sm table-bordered table-striped" id="tablaVentas">
            <thead>
                  <tr>
                  <th></th>
                    <th>No.</th>
                    <th>Folio</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Cobrador</th>
                    <th style="text-align: right;">Total</th>
                    <th>Tipo venta</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>';
                  

$contador = 0;

while($resultadoVentas = $rsBuscadorVentas->fetch_array(MYSQLI_BOTH)){ 

    $traerVendedor = ControladorVendedores::ctrMostrarVendedor2($resultadoVentas['id_vendedor']);

    if($resultadoVentas['id_corte_caja'] != 0){
        $traerCaja = ControladorCajas::ctrMostrarCaja($resultadoVentas['id_corte_caja']);
    

        $traerCajero = ControladorUsuarios::ctrMostrarUsuario($traerCaja['id_usuario_creador']);

        $cobrador = $traerCajero["nombre"];

    }else{
        $cobrador = "N/A";
    }


$contador = $contador + 1;


echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
    

    <td>
    '.$resultadoVentas["id"].'
    </td>
    <td>
    '.$resultadoVentas["folio"].'
    </td>
    <td>
    '.$resultadoVentas["nombre"].'
    </td>
    <td>
    '.$traerVendedor["nombres"].'
    </td>
    <td>
    '.$cobrador.'
    </td>
    <td style="text-align: right;">
    $'.number_format($resultadoVentas["total"], 2).'
    </td>
    <td>
    '.$resultadoVentas["tipo_venta"].'
    </td>  
    <td>
    '.$resultadoVentas["fecha"].'
    </td>';
    if($resultadoVentas["cancelada"] == 1){
        echo '<td style="color: red; font-weight:bold;">Cancelada</td>';
}else{
   if($resultadoVentas["pagada"] == 0 && $resultadoVentas["facturado"] == 0){

        echo '<td style="color: #D69016; font-weight:bold;">En espera</td>';

    }else if($resultadoVentas["pagada"] == 1 && $resultadoVentas["facturado"] == 1){

        if($resultadoVentas['entregada'] == 1){
            echo '<td style="color: green; font-weight:bold;">Pagada,  facturada y entregada</td>';
        }else{
            echo '<td style="color: green; font-weight:bold;">Pagada y facturada<br><span style="color: red; font-weight:bold;">Sin entregar</span></td>';
        }
        
    }else if($resultadoVentas["pagada"] == 1 && $resultadoVentas["facturado"] == 0){
        if($resultadoVentas['entregada'] == 1){
            echo '<td style="color: green; font-weight:bold;">Pagada y entregada</td>';
        }else{
            echo '<td style="color: green; font-weight:bold;">Pagada<br><span style="color: red; font-weight:bold;">Sin entregar</span></td>'; 
        }
        
    }
}

    echo '<td class="botones">
        <div class="btn-group">';

            echo'<button class="btn-xs btn-success btnVerPartidasVenta" id_venta="'.$resultadoVentas["id"].'">Ver venta
            </button>';

            $indiceReimprimirTicketVentas = array_search("Reimprimir ticket ventas",$array,true);

if($indiceReimprimirTicketVentas !== false){

    if($resultadoVentas["pagada"] == 1 && $resultadoVentas["cancelada"] == 0){
                            
                                echo '<button class="btn-xs btn-warning btnReimprimirTicket" id_venta="'.$resultadoVentas["id"].'">Reimprimir Cliente.</button>';

                            }

                                }

    if($resultadoVentas["pagada"] == 1 && $resultadoVentas["cancelada"] == 0){
                            
                                echo '<button class="btn-xs btnReenviarTicketWhatsapp" style="background-color: #075e54; color: white;" id_venta="'.$resultadoVentas["id"].'" celular="'.$resultadoVentas["celular"].'">Ticket<ion-icon name="logo-whatsapp"></ion-icon></button>';

                            }


    $indiceReimprimirTicketVentasMostrador = array_search("Reimprimir ticket ventas mostrador",$array,true);

if($indiceReimprimirTicketVentasMostrador !== false){
                            
                                echo '<button class="btn-xs btn-info btnReimprimirTicketVentaMostrador" id_venta="'.$resultadoVentas["id"].'">Reimprimir Mostrador.</button>';

                                }





    $indiceReimprimirTicketVentasCaja = array_search("Reimprimir ticket ventas caja",$array,true);

if($indiceReimprimirTicketVentasCaja !== false){

                            
        echo '<button class="btn-xs btn-primary btnReimprimirTicketVentaCaja" id_venta="'.$resultadoVentas["id"].'">Reimprimir Almacén.</button>';
                            

                                }





                                 $indiceTimbrarVentas = array_search("Timbrar ventas",$array,true);

if($indiceTimbrarVentas !== false){

    if($resultadoVentas["tipo_venta"] == "FC" && $resultadoVentas["facturado"] == 0 && $resultadoVentas["uuid"] == "" && $resultadoVentas["pagada"] == 1 && $resultadoVentas["cancelada"] == 0){
        echo '<button class="btn-xs btn-dark btnTimbrarVenta" id_venta="'.$resultadoVentas["id"].'">Timbrar.</button>';
    }



    if($resultadoVentas["id_cliente"] != 1 && $resultadoVentas["tipo_venta"] == "NT" && $resultadoVentas["facturado"] == 0 && $resultadoVentas["uuid"] == "" && $resultadoVentas["pagada"] == 1 && $resultadoVentas["cancelada"] == 0){
        echo '<button class="btn-xs btn-dark btnTimbrarVenta" id_venta="'.$resultadoVentas["id"].'">Timbrar...</button>';
    }
                            
                                

                                }





                                $indiceReenviarFacturasVentas = array_search("Reenviar facturas de ventas",$array,true);

if($indiceReenviarFacturasVentas !== false){

    if($resultadoVentas["tipo_venta"] == "FC" && $resultadoVentas["facturado"] == 1 && $resultadoVentas["uuid"] !== "" && $resultadoVentas["pagada"] == 1 && $resultadoVentas["cancelada"] == 0 && $resultadoVentas["enviada"] == 0){
        echo '<button class="btn-xs btn-danger parpadeo btnReenviarFacturaVenta" id_venta="'.$resultadoVentas["id"].'">Reenviar.</button>';
    }else if($resultadoVentas["tipo_venta"] == "FC" && $resultadoVentas["facturado"] == 1 && $resultadoVentas["uuid"] !== "" && $resultadoVentas["pagada"] == 1 && $resultadoVentas["cancelada"] == 0 && $resultadoVentas["enviada"] == 1){
        echo '<button class="btn-xs btn-danger btnReenviarFacturaVenta" id_venta="'.$resultadoVentas["id"].'">Reenviar.</button>';
    }
                            
                                

                                }





    $indiceCambiarDatosPagoVentas = array_search("Cambiar datos de pago de ventas",$array,true);

if($indiceCambiarDatosPagoVentas !== false){

        echo '<button class="btn-xs btn-default btnCambiarDatosPagoVenta" id_venta="'.$resultadoVentas["id"].'">Cambiar Datos.</button>';
    
                            
                                }


        echo'</div>
    </td>';
            
    

    


} 



echo '</tbody>
                  <tfoot>
                  <tr>
                  <th></th>
                    <th>No.</th>
                    <th>Folio</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Cobrador</th>
                    <th style="text-align: right;">Total</th>
                    <th>Tipo venta</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                  </tr>
                  </tfoot>
        </table>';



        ?>



