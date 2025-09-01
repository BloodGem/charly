<?php

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";



class TablaProveedores{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProveedores(){

		$columna = null;
		$valor = null;

		$proveedores = ControladorProveedores::ctrMostrarProveedores($columna, $valor);

		

		$datosJson = '{
  "data": [';

  for($i = 0; $i < count($proveedores); $i++){


		$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProveedor' id_proveedor='".$proveedores[$i]["id_proveedor"]."' accesskey='2' data-toggle='modal' data-target='#modalEditarProveedor'>Editar</button><button class='btn btn-danger btnEliminarProveedor' id_proveedor='".$proveedores[$i]["id_proveedor"]."' accesskey='0'><i class='fa fa-times'></i></button></div>";



	
			/*=============================================
 	 		ESTATUS
  			=============================================*/ 

  			if ($proveedores[$i]["estatus"] != 0) {
                        $estatus = "<td><button class='btn btn-success btn-xs btnActivar' id_proveedor='".$proveedores[$i]["id_proveedor"]."' estadoProveedor='0'>ACTIVADO</button></td>";
                    }else{
                        $estatus = "<td><button class='btn btn-danger btn-xs btnActivar' id_proveedor='".$proveedores[$i]["id_proveedor"]."' estadoProveedor='1'>DESACTIVADO</button></td>";
                    }




  	$datosJson .='[
      "'.($i +1).'",
      "'.$proveedores[$i]["nombre_comercial"].'",
      "'.$proveedores[$i]["contacto"].'",
      "'.$proveedores[$i]["email"].'",
      "'.$proveedores[$i]["telefono1"].'",
      "'.$proveedores[$i]["telefono2"].'",
      "'.$estatus.'",
      "'.$botones.'"
    ],';

  }

  $datosJson = substr($datosJson, 0, -1);
   
  $datosJson .=']

}';

echo $datosJson;

return;		

		


	}



}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProveedores = new TablaProveedores();
$activarProveedores -> mostrarTablaProveedores();

