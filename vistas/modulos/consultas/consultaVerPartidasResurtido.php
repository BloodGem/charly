


<?php 
//error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/grupos.controlador.php";
require_once "../../../modelos/grupos.modelo.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../modelos/partres.modelo.php";

//require_once "conexion.php";


$id_resurtido = $_POST["id_resurtido"];

//var_dump($id_resurtido);
    
$partidas_resurtido = ModeloPartres::mdlMostrarPartidasResurtido($id_resurtido);

echo '<table class="table table-bordered table-striped" id="tablaPartidasResurtido">
            <thead>
                  <tr>
                    <th>Id producto</th>
                    <th>Clave producto</th>
                    <th>Descripción</th>
                    <th style="text-align: right;">A pedir</th>
                  </tr>
                  </thead>
                  <tbody>';
                  

    foreach ($partidas_resurtido as $key => $value) {

$traerProducto = ControladorProductos::ctrMostrarProducto($value["id_producto"]);

        echo '<tr>
    

    <td>
    '.$value["id_producto"].'
    </td>
    <td>
    '.$traerProducto["clave_producto"].'
    </td>
    <td>
    '.$traerProducto["descripcion_corta"].'
    </td>
    <td style="text-align: right;">
    '.$value["a_pedir"].'
    </td>';
    }


echo '</tbody>
                  <tfoot>
                  <tr>
                    <th>Id producto</th>
                    <th>Clave producto</th>
                    <th>Descripción</th>
                    <th style="text-align: right;">A pedir</th>
                  </tr>
                  </tfoot>
        </table>';


