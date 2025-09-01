<?php 
//error_reporting(0);
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

$busqueda = $_POST["buscarGarantias"];

$genera_filtro = "";

if ($busqueda != "") {
    $porciones = explode(" ", $busqueda);
    $contador = count($porciones); 

    for ($i=0; $i < $contador; $i++) { 
        $genera_filtro = $genera_filtro."garantias.id_garantia LIKE '%".$porciones[$i]."%'";

        if ($i < $contador-1) {
            $genera_filtro = $genera_filtro." AND ";
        }

    }

    $genera_filtro = $genera_filtro." OR ";

    for ($i=0; $i < $contador; $i++) { 
        $genera_filtro = $genera_filtro."garantias.nombre_cliente LIKE '%".$porciones[$i]."%'";

        if ($i < $contador-1) {
            $genera_filtro = $genera_filtro." AND ";
        }

    }


    $genera_filtro = $genera_filtro." OR ";

    for ($i=0; $i < $contador; $i++) { 
        $genera_filtro = $genera_filtro."productos.descripcion_corta LIKE '%".$porciones[$i]."%'";

        if ($i < $contador-1) {
            $genera_filtro = $genera_filtro." AND ";
        }

    }

    

    $sql= "SELECT garantias.id_garantia, garantias.fecha_creacion, garantias.id_proveedor, garantias.autorizada, garantias.confirmada1, garantias.confirmada2, productos.clave_producto, productos.descripcion_corta, garantias.id_cliente, garantias.nombre_cliente FROM garantias INNER JOIN productos ON garantias.id_producto = productos.id_producto WHERE ".$genera_filtro." AND garantias.id_sucursal = $id_sucursal ORDER BY id_garantia DESC LIMIT 50";


}else{

    $sql = "SELECT garantias.id_garantia, garantias.fecha_creacion, garantias.id_proveedor, garantias.autorizada, garantias.confirmada1, garantias.confirmada2, productos.clave_producto, productos.descripcion_corta, garantias.id_cliente, garantias.nombre_cliente FROM garantias INNER JOIN productos ON garantias.id_producto = productos.id_producto WHERE garantias.id_sucursal = $id_sucursal ORDER BY id_garantia DESC LIMIT 50";

}


//echo $sql;


$rs = $conexion->query($sql);

echo '<table class="table table-bordered table-striped">
                <thead>
                  <tr>
                  <th></th>
                    <th>No.</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Clave prod</th>
                    <th>Descripción prod</th>
                    <th>Cliente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';

$contador = 0;  

while($row = $rs->fetch_array(MYSQLI_BOTH)){ 

    if($row['id_proveedor'] == 0){
        
        $nombre_cliente = $row['nombre_cliente'];

        
    }else{
        $nombre_cliente = "Refaccionaria Garcia";
    }

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
    

    <td>
    '.$row["id_garantia"].'
    </td>
    <td>
    '.$row["fecha_creacion"].'
    </td>
    <td>
    '.$row["id_proveedor"].'
    </td>
    <td>
    '.$row["clave_producto"].'
    </td>
    <td>
    '.$row["descripcion_corta"].'
    </td>
    <td>
    '.$nombre_cliente.'
    </td>

    <td class="botones"><div class="btn-group">';





    $indiceVerInformacionGarantias = array_search("Ver informacion garantias",$array,true);

    if($indiceVerInformacionGarantias !== false){

            

           echo '<button class="btn btn-primary btnVerInformacionGarantia" id_garantia="'.$row["id_garantia"].'">Ver garantia</button>'; 
        

    }






    $indiceAutorizarGarantias = array_search("Autorizar garantias",$array,true);

    if($indiceAutorizarGarantias !== false){

        if($row["id_proveedor"] == 0 && $row["autorizada"] == 0){
            

           echo '<button class="btn btn-info btnAutorizarGarantia" id_garantia="'.$row["id_garantia"].'">Autorizar garantia</button>'; 
        }

    }



    $indiceConfirmarGarantias = array_search("Confirmar garantias",$array,true);

    if($indiceConfirmarGarantias !== false){

        if($row["id_proveedor"] == 0 && $row["autorizada"] == 1 && $row["confirmada1"] == 0){
            

           echo '<button class="btn btn-primary btnConfirmarGarantia" id_garantia="'.$row["id_garantia"].'">Confirmar garantia</button>'; 
        }

            

                }//PERMISO PARA CONFIRMAR COMPRAS











                $indiceEditarGarantias = array_search("Editar garantias",$array,true);

    if($indiceEditarGarantias !== false){

        if($row["confirmada2"] == 0){
            

           echo '<button class="btn btn-secondary btnEditarGarantiaProveedor" id_garantia="'.$row["id_garantia"].'">Envio de Productos</button>'; 
        }

            

                }//PERMISO PARA CONFIRMAR COMPRAS






                if($indiceConfirmarGarantias !== false){

        if($row["confirmada2"] == 0){
            

           echo '<button class="btn btn-secondary btnConfirmar2Garantia" id_garantia="'.$row["id_garantia"].'">Confirmar Proveedor</button>'; 
        }

            

                }//PERMISO PARA CONFIRMAR COMPRAS
                
           
                
                
                

               echo '</div></td></tr>'; 


            } 



            echo '</tbody>
            <tfoot>
              <tr>
              <th></th>
                    <th>No.</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Clave prod</th>
                    <th>Descripción prod</th>
                    <th>Cliente</th>
                    <th>Acciones</th>
            </tr>
        </tfoot>
    </table>';


    ?>




            
            