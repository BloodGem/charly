<?php

//error_reporting(0);
session_start();


require_once "../../../controladores/inventarios.controlador.php";
require_once "../../../modelos/inventarios.modelo.php";


require_once "../../../modelos/global.modelo.php";
 
$id_inventario = $_POST['id_inventario'];           


$crearVistaMovimientosInventario = ControladorInventarios::ctrCrearVistaMovimientosInventario($id_inventario);

if($crearVistaMovimientosInventario == "ok"){

    echo '<table id="tablaMovimientosInventario" class="table table-striped table-bordered table-condensed" style="width:100%">
                <thead class="text-center">
                <tr>
                    <th>Clave producto</th>
                    <th>Producto</th>
                    <th>Ubicación</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                </tr>
                </thead>
            </table>';

        }

        
        ?>