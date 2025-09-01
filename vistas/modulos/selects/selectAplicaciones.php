<?php
//error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/pag.controlador.php";
require_once "../../../modelos/pag.modelo.php";



$id_producto_apl = $_POST['id_producto_apl'];   

    


echo '<div class="form-group">
                        <label>Aplicación
                        <big><code>*</code></big>
                        </label>
        <select class="form-control" id="idAplicacion" name="idAplicacion">
        <option value="">--Seleccione--</option>';
        
                            $aplicaciones = ControladorPAG::ctrMostrarAplicacionesPAG($id_producto_apl);

                                        foreach ($aplicaciones as $keyAplicaciones => $valueAplicaciones) {
                                            echo '<option value="'.$valueAplicaciones["id_aplicacion"].'">'.$valueAplicaciones["aplicacion"].'</option>';
                                        }
                          
                        echo'</select></div>';



?>