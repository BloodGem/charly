<?php
//error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/subfamilias.controlador.php";
require_once "../../../modelos/subfamilias.modelo.php";



$id_familia = $_POST['id_familia'];   

    
 
                        echo'
                        <div class="form-group">
                              <label>Subfamilia</label>
                              <div class="input-group">
                                <select class="form-control select2" id="nuevoIdSubfamilia" name="nuevoIdSubfamilia" style="width: 100%;">
                                <option value="">--Seleccionar--</option>';

                                $columnaIdFamilia = "id_familia";
                                    

                                    $subfamilias = ControladorSubfamilias::ctrMostrarSubfamiliasFiltro($columnaIdFamilia, $id_familia);



                                    foreach ($subfamilias as $key => $valueSubfamilia) {
                                        echo '<option value="'.$valueSubfamilia["id_subfamilia"].'">'.$valueSubfamilia["subfamilia"].'</option>';
                                    }

                                    
                                echo '</select>
                            </div>
                        </div>';



?>