<?php
//error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";


    


echo '<div class="form-group">
                        <label>Casco
                        <big><code>*</code></big>
                        </label>
        <select class="form-control" id="idCasco" name="idCasco">
        <option value="">--Seleccione--</option>';
        
                            $columnaEsCasco = "es_casco";
                                        $valorEsCasco = 1;
                                        $cascos = ControladorProductos::ctrMostrarProductos2($columnaEsCasco, $valorEsCasco);

                                        foreach ($cascos as $keyCasco => $valueCasco) {
                                            echo '<option value="'.$valueCasco["id_producto"].'">'.$valueCasco["descripcion_corta"].'</option>';
                                        }
                          
                        echo'</select></div>';



?>