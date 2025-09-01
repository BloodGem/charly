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



$busqueda = $_POST["buscarTerminalesBancarias"];


if ($busqueda != "") {
	$porciones = explode(" ", $busqueda);
$contador = count($porciones); 

for ($i=0; $i < $contador; $i++) { 
$genera_filtro = $genera_filtro."terminal_bancaria LIKE '%".$porciones[$i]."%'";

if ($i < $contador-1) {
	$genera_filtro = $genera_filtro." AND ";
}

}

$consultaTerminalesBancarias= "SELECT * FROM terminales_bancarias WHERE ".$genera_filtro." LIMIT 50";
}else{

	$consultaTerminalesBancarias = "SELECT * FROM terminales_bancarias LIMIT 50";
}



$rsBuscadorTerminalesBancarias = $conexion->query($consultaTerminalesBancarias);

echo '<table class="table table-bordered table-striped">
            <thead>
                <tr>
                <th></th>
           <th>Terminal Bancaria</th>
           <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';




$contador = 0;

 while($resultadoTerminalesBancarias = $rsBuscadorTerminalesBancarias->fetch_array(MYSQLI_BOTH)){ 

$contador = $contador + 1;

echo '<tr class="contador'.$contador.'">
                    <td style="width : 0.1px; heigth : 0.1px"><button class="guardaFoco'.$contador.'" contador="'.$contador.'" type="button" readonly style="width : 0.1px; heigth : 0.1px"></button></td>
                    <td>'.$resultadoTerminalesBancarias["terminal_bancaria"].'</td> 
                    <td class="botones"><div class="btn-group">';

                        $indiceEditarTerminalesBancarias = array_search("Editar terminales bancarias",$array,true);

if($indiceEditarTerminalesBancarias !== false){

    

                            echo'<button class="btn btn-warning btnEditarTerminalBancaria" id_terminal_bancaria="'.$resultadoTerminalesBancarias["id_terminal_bancaria"].'">Editar</button>';

                            }
                            
                        echo'</div></td>';

                    


 } 





 echo '</tbody>
            <tfoot>
                <tr>
                <th></th>
           <th>Terminal Bancaria</th>
           <th>Acciones</th>
                </tr>
            </tfoot>
        </table>';?>




                    
              