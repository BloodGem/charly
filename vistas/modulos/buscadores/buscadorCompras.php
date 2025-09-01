<?php 
error_reporting(0);
session_start();
require_once "../../../modelos/conexion2.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";


$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
$id_sucursal = $traerUsuario['id_sucursal'];

$id_grupo = $traerUsuario['id_grupo'];

$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);

$array = json_decode($respuesta2['permisos']);

$busquedaCompras = $_POST["buscarCompras"];


if ($busquedaCompras != "") {
    /*$porcionesCompras = explode(" ", $busquedaCompras);
    $contadorCompras = count($porcionesCompras); 

    for ($iCompras=0; $iCompras < $contadorCompras; $iCompras++) { 
        $generaFiltroCompras = $generaFiltroCompras."compras.id LIKE '%".$porcionesCompras[$iCompras]."%'";

        if ($iCompras < $contadorCompras-1) {
            $generaFiltroCompras = $generaFiltroCompras." AND ";
        }

    }


    $generaFiltroCompras = $generaFiltroCompras." OR ";

    for ($iCompras=0; $iCompras < $contadorCompras; $iCompras++) { 
        $generaFiltroCompras = $generaFiltroCompras."compras.no_factura LIKE '%".$porcionesCompras[$iCompras]."%'";

        if ($iCompras < $contadorCompras-1) {
            $generaFiltroCompras = $generaFiltroCompras." AND ";
        }

    }

    $generaFiltroCompras = $generaFiltroCompras." OR ";

    for ($iCompras=0; $iCompras < $contadorCompras; $iCompras++) { 
        $generaFiltroCompras = $generaFiltroCompras."proveedores.nombre LIKE '%".$porcionesCompras[$iCompras]."%'";

        if ($iCompras < $contadorCompras-1) {
            $generaFiltroCompras = $generaFiltroCompras." AND ";
        }

    }

    $generaFiltroCompras = $generaFiltroCompras." OR ";

    for ($iCompras=0; $iCompras < $contadorCompras; $iCompras++) { 
        $generaFiltroCompras = $generaFiltroCompras."DATE_FORMAT(compras.fecha_creacion,'%d-%m-%Y') LIKE '%".$porcionesCompras[$iCompras]."%'";

        if ($iCompras < $contadorCompras-1) {
            $generaFiltroCompras = $generaFiltroCompras." AND ";
        }

    }*/

    $consultaCompras= "SELECT compras.id, compras.total, compras.estatus, compras.no_factura, compras.tipo_compra, proveedores.nombre, DATE_FORMAT(compras.fecha_creacion,'%d-%m-%Y') as fecha FROM compras LEFT JOIN proveedores ON compras.id_proveedor = proveedores.id_proveedor WHERE compras.id = $busquedaCompras AND id_sucursal = $id_sucursal";


}else{

    $consultaCompras = "SELECT compras.id, compras.total, compras.estatus, compras.no_factura, compras.tipo_compra, proveedores.nombre, DATE_FORMAT(compras.fecha_creacion,'%d-%m-%Y') as fecha FROM compras LEFT JOIN proveedores ON compras.id_proveedor = proveedores.id_proveedor WHERE id_sucursal = $id_sucursal ORDER BY compras.id DESC LIMIT 50";

}

//echo $consultaCompras;

$rsBuscadorCompras = $conexion->query($consultaCompras);

echo '<table class="table-sm table-bordered table-striped" id="tablaCompras">
                <thead>
                  <tr>
                  <th></th>
                    <th>No.</th>
                    <th>Proveedor</th>
                    <th>Total</th>
                    <th>Tipo compra</th>
                    <th>No. factura</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';

$contador = 0;  

while($row = $rsBuscadorCompras->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
    

    <td>
    '.$row["id"].'
    </td>
    <td>
    '.$row["nombre"].'
    </td>
    <td style="text-align: right;">
    $'.number_format($row["total"], 2).'
    </td>
    <td>';
    if($row['tipo_compra'] == 1){
        echo 'Factura';
    }else if($row['tipo_compra'] == 1){
        echo 'Resmisión';
    }else{
        echo 'N/A';
    }
    echo '</td>
    <td>
    '.$row["no_factura"].'
    </td>  
    <td>
    '.$row["fecha"].'
    </td>';

    if($row["estatus"] == 0){

        echo'<td style="font-weight: bold; color: blue;">Revisión</td>';

    }else if($row["estatus"] == 1){

        echo'<td style="font-weight: bold; color: green;">Contado</td>';

    }else if($row["estatus"] == 2){

        echo'<td style="font-weight: bold; color: green;">Crédito</td>';

    }else if($row["estatus"] == 3){

        echo'<td style="font-weight: bold; color: red;">Cancelada</td>';

    }

    echo'<td class="botones"><div class="btn-group">';

    $indiceConfirmarCompras = array_search("Confirmar compras",$array,true);

    if($indiceConfirmarCompras !== false){

        if($row["estatus"] == 1 || $row["estatus"] == 2 || $row["estatus"] == 3){
            

            echo '';  
        }else{

            echo '<button class="btn-sm btn-info btnConfirmarCompra" id_compra="'.$row["id"].'">Confirmar</button>';
            
        }

                }//PERMISO PARA CONFIRMAR COMPRAS
                
           
                
                
                
                
                
    $indiceEditarCompras = array_search("Editar compras",$array,true);

    if($indiceEditarCompras !== false){

        if($row["estatus"] == 1 || $row["estatus"] == 2 || $row["estatus"] == 3){
            

            echo '';
        }else{

            echo '<button class="btn-sm btn-warning btnEditarCompra" id_compra="'.$row["id"].'">Editar</button>
                ';
        }

                }//PERMISO PARA EDITAR COMPRAS




                $indiceVerPartidasCompra = array_search("Ver partidas compra",$array,true);

    if($indiceVerPartidasCompra !== false){


            echo '<button class="btn-sm btn-success btnVerPartidasCompra" id_compra="'.$row["id"].'">Ver</button>';
        

                }//PERMISO PARA VER PARTIDAS DE UNA COMPRA








                $indiceCancelarCompras = array_search("Cancelar compras",$array,true);

                if($indiceCancelarCompras !== false){

        if($row["estatus"] == 0){
            

            echo '<button class="btn-sm btn-danger btnCancelarCompra" id_compra="'.$row["id"].'">Cancelar</button>';
        }

                }//PERMISO PARA VER PARTIDAS DE UNA COMPRA










                $indiceGenerarPDFCompraAdministracion = array_search("Generar PDF compra administracion",$array,true);

    if($indiceGenerarPDFCompraAdministracion !== false){

        if($row["estatus"] == 1 || $row["estatus"] == 2){
            

            echo '<button class="btn-sm btn-info btnGenerarPDFCompraAdministracion" id_compra="'.$row["id"].'">PDF Admin.
            </button>';
        }

                }//PERMISO PARA VER PARTIDAS DE UNA COMPRA







                $indiceGenerarPDFCompraAlmacen = array_search("Generar PDF compra almacen",$array,true);

                if($indiceGenerarPDFCompraAlmacen !== false){

        if($row["estatus"] == 1 || $row["estatus"] == 2){
            

            echo '<button class="btn-sm btn-primary btnGenerarPDFCompraAlmacen" id_compra="'.$row["id"].'">PDF Almac.
            </button>';
        }

                }//PERMISO PARA VER PARTIDAS DE UNA COMPRA
                
                
                

               echo '</div></td></tr>'; 


            } 



            echo '</tbody>
            <tfoot>
              <tr>
              <th></th>
                <th>No.</th>
                <th>Proveedor</th>
                <th>Total</th>
                <th>Tipo compra</th>
                <th>No. factura</th>
                <th>Fecha</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>';


    ?>




            
            