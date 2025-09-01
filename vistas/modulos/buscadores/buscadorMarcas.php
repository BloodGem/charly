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



$busquedaMarcas = $_POST["buscarMarcas"];


if ($busquedaMarcas != "") {
	$porcionesMarcas = explode(" ", $busquedaMarcas);
$contadorMarcas = count($porcionesMarcas); 

for ($iMarcas=0; $iMarcas < $contadorMarcas; $iMarcas++) { 
$generaFiltroMarcas = $generaFiltroMarcas."marca LIKE '%".$porcionesMarcas[$iMarcas]."%'";

if ($iMarcas < $contadorMarcas-1) {
	$generaFiltroMarcas = $generaFiltroMarcas." AND ";
}

}

$consultaMarcas= "SELECT * FROM marcas WHERE ".$generaFiltroMarcas;
}else{

	$consultaMarcas = "SELECT * FROM marcas";
}



$rsBuscadorMarcas = $conexion->query($consultaMarcas);

echo '<table class="table table-sm table-bordered table-striped" id="tablaMarcas">
            <thead>
                <tr>
           <th>Marca</th>
           <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';




$contador = 0;

 while($resultadoMarcas = $rsBuscadorMarcas->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">
                    <td>'.$resultadoMarcas["marca"].'</td> 
                    <td class="botones"><div class="btn-group">';

                        $indiceEditarMarcas = array_search("Editar marcas",$array,true);

if($indiceEditarMarcas == 0){
   
}else if($indiceEditarMarcas !== ""){

    

                            echo'<button class="btn-sm btn-warning btnEditarMarca" id_marca="'.$resultadoMarcas["id_marca"].'" accesskey="2" data-toggle="modal" data-target="#modalEditarMarca">Editar</button>';

                            } 

                            $indiceEliminarMarcas = array_search("Eliminar marcas",$array,true);

if($indiceEliminarMarcas == 0){
   
}else if($indiceEliminarMarcas !== ""){
                            
                                echo '<button class="btn-sm btn-danger btnEliminarMarca" id_marca="'.$resultadoMarcas["id_marca"].'" accesskey="0"><i class="fa fa-times"></i></button>';

                                }
                            
                        echo'</div></td>';

                    


 } 





 echo '</tbody>
            <tfoot>
                <tr>
           <th>Marca</th>
           <th>Acciones</th>
                </tr>
            </tfoot>
        </table>';?>




                    
              