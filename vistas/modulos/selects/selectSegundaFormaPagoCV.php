<?php
/*SELECT * FROM formas_pago WHERE formas_pago.id_forma_pago != 1 AND formas_pago.id_forma_pago != 2 AND formas_pago.id_forma_pago != 5 AND formas_pago.id_forma_pago != 6 AND formas_pago.id_forma_pago != 7 AND formas_pago.id_forma_pago != 9 AND formas_pago.id_forma_pago != 10*/

require_once "../../../controladores/formas-pago.controlador.php";
require_once "../../../modelos/formas-pago.modelo.php";

$id_forma_pago = $_POST['id_forma_pago'];


echo '<div class="col-sm-4" id="incrustarSelectSegundaFormaPagoCV">
<div class="form-group">
<label>SEGUNDA FORMA DE PAGO</label><select class="form-control" id="nuevoIdFormaPago2CV" name="nuevoIdFormaPago2CV">
<option value="">--Seleccione--</option>';


$formas_pago_restantes = ControladorFormasPago::ctrMostrarFormasPagoRestantesCV($id_forma_pago);

foreach ($formas_pago_restantes as $key => $value) {
	echo '<option value="'.$value["id_forma_pago"].'">'.$value["descripcion"].'</option>';
}

echo'</select></div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label>IMPORTE:</label>
<input type="number" class="form-control" id="nuevoImporte2CV" name="nuevoImporte2CV" value="0">
</div>
</div>';



?>




