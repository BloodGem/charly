<?php
//error_reporting(0);
session_start();
//require_once "../../modelos/conexion.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

$id_sucursal = $_POST['id_sucursal'];

$traerResponsables = ControladorUsuarios::ctrMostrarUsuariosSucursal($id_sucursal);

                                        


echo '<div class="form-group">
                        <label>Responsables</label>
        <select class="duallistboxResponsablesInventario" multiple="multiple" id="nuevosResponsablesInventario" name="nuevosResponsablesInventario[]">
        <option value="">--Selecciona--</option>';
        
                            foreach ($traerResponsables as $key => $row) {
                              echo '<option value="'.$row["id"].'">'.$row["nombre"].'</option>';
                            }
                          
                        echo'</select></div>';



?>