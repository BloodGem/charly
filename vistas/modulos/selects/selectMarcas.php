<?php
//error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/marcas.controlador.php";
require_once "../../../modelos/marcas.modelo.php";

$id_marca = $_POST['id_marca'];

$traerMarca = ControladorMarcas::ctrMostrarMarca($id_marca);
$traerMarcas = ControladorMarcas::ctrMostrarMarcas($id_marca);
                                        


echo '<div class="form-group">
                        <label>Marca</label>
        <select class="form-control select2 seleccionarMarca" id="seleccionarMarca" name="seleccionarMarca">';

        if($traerMarca !== false){
          echo '<option value="'.$traerMarca["id_marca"].'">'.$traerMarca["marca"].'</option>';
        }

        echo'<option value="">--Selecciona--</option>';
        
                            foreach ($traerMarcas as $key => $row) {
                              echo '<option value="'.$row["id_marca"].'">'.$row["marca"].'</option>';
                            }
                          
                        echo'</select></div>';



?>