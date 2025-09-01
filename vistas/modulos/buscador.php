<?php 
error_reporting(0);
session_start();

require_once "../../modelos/grupos.modelo.php";
require_once "../../controladores/grupos.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
require_once "../../controladores/usuarios.controlador.php";

require_once "conexion.php";

$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
$id_sucursal = $traerUsuario['id_sucursal'];

$id_grupo = $traerUsuario['id_grupo'];

$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);

$array = json_decode($respuesta2['permisos']);

$busqueda = $_POST["buscar"];

if ($busqueda != "") {
$porciones = explode(" ", $busqueda);
$contador = count($porciones); 

for ($i=0; $i < $contador; $i++) { 
$GENERA_FILTRO = $GENERA_FILTRO."nombre LIKE '%".$porciones[$i]."%'";

if ($i < $contador-1) {
	$GENERA_FILTRO = $GENERA_FILTRO." AND ";
}

}




$GENERA_FILTRO = $GENERA_FILTRO." OR ";

for ($i=0; $i < $contador; $i++) { 
$GENERA_FILTRO = $GENERA_FILTRO."usuario LIKE '%".$porciones[$i]."%'";

if ($i < $contador-1) {
    $GENERA_FILTRO = $GENERA_FILTRO." AND ";
}

}


$consulta= "SELECT * FROM usuarios INNER JOIN grupos ON usuarios.id_grupo = grupos.id_grupo WHERE (".$GENERA_FILTRO.") AND id_sucursal = $id_sucursal LIMIT 50";


    
}else{

	$consulta = "SELECT * FROM usuarios INNER JOIN grupos ON usuarios.id_grupo = grupos.id_grupo WHERE id_sucursal = $id_sucursal LIMIT 50";
	
	
}



$buscardor = $conexion->query($consulta);  


echo '<table class="table table-bordered table-striped" id="tablaUsuarios">
                <thead>
                    <tr>
                     <th>Nombre</th>
                     <th>Usuario</th>
                     <th>Grupo</th>
                     <th>Estado</th>
                     <th>Último login</th>
                     <th>Acciones</th>
                 </tr>
             </thead>
             <tbody>';

 while($resultado = $buscardor->fetch_array(MYSQLI_BOTH)){ 



echo '<tr>
                    <td>'.$resultado["nombre"].'</td>
                    <td>'.$resultado["usuario"].'</td>
                    <td>'.$resultado["nombre_grupo"].'</td>';

                    if ($resultado["estado"] != 0) {
                        echo '<td><button class="btn btn-success btn-xs btnActivar" id_usuario="'.$resultado["id"].'" estadoUsuario="0">ACTIVADO</button></td>';
                    }else{
                        echo '<td><button class="btn btn-danger btn-xs btnActivar" id_usuario="'.$resultado["id"].'" estadoUsuario="1">DESACTIVADO</button></td>';
                    }

                    

                    echo'<td>'.$resultado["ultimo_login"].'</td>
                    <td width="16%">
                        <div class="btn-group">
                        
                        
                         
                    <button type="button" class="btn btn-default btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      Da clic aquí
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">';
                    
                
    

                        

                        $indiceEditarUsuarios = array_search("Editar usuarios",$array,true);

if($indiceEditarUsuarios !== "" && $indiceEditarUsuarios !== 0){
    
    

                            echo'<div class="dropdown-item">
                            <button class="btn btn-warning btnEditarUsuario" id_usuario="'.$resultado["id"].'" accesskey="2" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalEditarUsuario">Editar</button>
                            </div>';
    
                        }

                        $indiceEliminarUsuarios = array_search("Eliminar usuarios",$array,true);

if($indiceEliminarUsuarios == 0){
   
}else if($indiceEliminarUsuarios !== ""){
                            
                                echo '<div class="dropdown-item">
                                <button class="btn btn-danger btnEliminarUsuario" id_usuario="'.$resultado["id"].'" accesskey="0"><i class="fa fa-times"></i> Eliminar</button>
                                </div>';

                            }

                                
                        echo '
                        </div>
                        </div>
                    </td>

                </tr>';


 }








 echo '</tbody>
             <tfoot>
                <tr>
                 <th>Nombre</th>
                 <th>Usuario</th>
                 <th>Grupo</th>
                 <th>Estado</th>
                 <th>Último login</th>
                 <th>Acciones</th>
             </tr>
         </tfoot>
     </table>';



?>