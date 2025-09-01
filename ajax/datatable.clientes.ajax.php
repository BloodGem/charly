<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";



class TablaClientes{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaClientes(){

		$columna = null;
		$valor = null;

		$clientes = ControladorClientes::ctrMostrarClientes($columna, $valor);

		

		$datosJson = '{
  "data": [';

  for($i = 0; $i < count($clientes); $i++){


		$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarCliente' id_cliente='".$clientes[$i]["id_cliente"]."' accesskey='2' data-toggle='modal' data-target='#modalEditarCliente'>Editar</button><button class='btn btn-danger btnEliminarCliente' id_cliente='".$clientes[$i]["id_cliente"]."' accesskey='0'><i class='fa fa-times'></i></button></div>";



	
			/*=============================================
 	 		ESTATUS
  			=============================================*/ 

  			if ($clientes[$i]["estatus"] != 0) {
                        $estatus = "<td><button class='btn btn-success btn-xs btnActivar' id_cliente='".$clientes[$i]["id_cliente"]."' estadoCliente='0'>ACTIVADO</button></td>";
                    }else{
                        $estatus = "<td><button class='btn btn-danger btn-xs btnActivar' id_cliente='".$clientes[$i]["id_cliente"]."' estadoCliente='1'>DESACTIVADO</button></td>";
                    }




  	$datosJson .='[
      "'.($i +1).'",
      "'.$clientes[$i]["nombre_comercial"].'",
      "'.$clientes[$i]["contacto"].'",
      "'.$clientes[$i]["email"].'",
      "'.$clientes[$i]["telefono1"].'",
      "'.$clientes[$i]["telefono2"].'",
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
$activarClientes = new TablaClientes();
$activarClientes -> mostrarTablaClientes();

