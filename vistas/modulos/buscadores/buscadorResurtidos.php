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


$busquedaResurtidos = $_POST["buscarResurtidos"];


if ($busquedaResurtidos != "") {
    $porcionesResurtidos = explode(" ", $busquedaResurtidos);
    $contadorResurtidos = count($porcionesResurtidos); 

    for ($iResurtidos=0; $iResurtidos < $contadorResurtidos; $iResurtidos++) { 
        $generaFiltroResurtidos = $generaFiltroResurtidos."resurtidos.id_resurtido LIKE '%".$porcionesResurtidos[$iResurtidos]."%'";

        if ($iResurtidos < $contadorResurtidos-1) {
            $generaFiltroResurtidos = $generaFiltroResurtidos." AND ";
        }

    }

    /*$generaFiltroResurtidos = $generaFiltroResurtidos." OR ";

    for ($iResurtidos=0; $iResurtidos < $contadorResurtidos; $iResurtidos++) { 
        $generaFiltroResurtidos = $generaFiltroResurtidos."proveedores.nombre LIKE '%".$porcionesResurtidos[$iResurtidos]."%'";

        if ($iResurtidos < $contadorResurtidos-1) {
            $generaFiltroResurtidos = $generaFiltroResurtidos." AND ";
        }

    }*/

    /*$generaFiltroResurtidos = $generaFiltroResurtidos." OR ";

    for ($iResurtidos=0; $iResurtidos < $contadorResurtidos; $iResurtidos++) { 
        $generaFiltroResurtidos = $generaFiltroResurtidos."DATE_FORMAT(fecha,'%d-%m-%Y') LIKE '%".$porcionesResurtidos[$iResurtidos]."%'";

        if ($iResurtidos < $contadorResurtidos-1) {
            $generaFiltroResurtidos = $generaFiltroResurtidos." AND ";
        }

    }*/

    $consultaResurtidos= "SELECT resurtidos.id_resurtido, resurtidos.id_compra, resurtidos.estatus, proveedores.nombre, DATE_FORMAT(resurtidos.fecha_creacion,'%d-%m-%Y') as fecha FROM resurtidos INNER JOIN proveedores ON resurtidos.id_proveedor = proveedores.id_proveedor WHERE ".$generaFiltroResurtidos." AND id_sucursal = $id_sucursal ORDER BY id_resurtido DESC LIMIT 50";

    //$consultaResurtidos= "SELECT * WHERE ".$generaFiltroResurtidos." ORDER BY id DESC LIMIT 50";


}else{

    $consultaResurtidos = "SELECT resurtidos.id_resurtido, resurtidos.id_compra, resurtidos.estatus, proveedores.nombre, DATE_FORMAT(resurtidos.fecha_creacion,'%d-%m-%Y') as fecha FROM resurtidos INNER JOIN proveedores ON resurtidos.id_proveedor = proveedores.id_proveedor WHERE id_sucursal = $id_sucursal ORDER BY  id_resurtido DESC LIMIT 50";

    //$consultaResurtidos = "SELECT * FROM resurtidos WHERE resurtidos.id_sucursal ORDER BY id DESC LIMIT 50";
}



$rsBuscadorResurtidos = $conexion->query($consultaResurtidos);

echo '<table class="table table-bordered table-striped">
                <thead>
                  <tr>
                  <th></th>
                    <th>No.</th>
                    <th>Proveedor</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';

$contador = 0;

while($resultadoResurtidos = $rsBuscadorResurtidos->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
    

    <td>
    '.$resultadoResurtidos["id_resurtido"].'
    </td>
    <td>
    '.$resultadoResurtidos["nombre"].'
    </td>
    </td>  
    <td>
    '.$resultadoResurtidos["fecha"].'
    </td>

    <td class="botones"><div class="btn-group">';


    $indiceConvertirResurtidosAComprasResurtidos = array_search("Convertir resurtidos a compras",$array,true);

    if($indiceConvertirResurtidosAComprasResurtidos == 0){
       
    }else if($indiceConvertirResurtidosAComprasResurtidos !== ""){

        if($resultadoResurtidos["estatus"] == 1){
            

            echo '<button class="btn btn-disabled" disabled>Convertida a la compra no.'.$resultadoResurtidos["id_compra"].'</button>';
        }else{

            echo '<button class="btn btn-info btnConvertirResurtidoACompra" id_resurtido="'.$resultadoResurtidos["id_resurtido"].'">Convertir a compra</button>';
            
        }

                }//PERMISO PARA CONVERTIR RESURTIDOS A COMPRAS

                echo'<button class="btn btn-primary btnVerPartidasResurtido" id_resurtido="'.$resultadoResurtidos["id_resurtido"].'">Ver resurtido</button>';





        $indiceExportarExcelResurtido = array_search("Exportar excel resurtido",$array,true);

        if($indiceExportarExcelResurtido !== false){
                            
                                echo '<button class="btn btn-success btnExportarEXCELResurtido" id_resurtido="'.$resultadoResurtidos["id_resurtido"].'">Excel</button>';

                                }
                

                


            } 




            echo '</div></td></tbody>
            <tfoot>
              <tr>
              <th></th>
                <th>No.</th>
                <th>Proveedor</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>';


            ?>




            
            