<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorMuestras{


	/*=============================================
	MOSTRAR MuestraS
	=============================================*/

	static public function ctrMostrarMuestras(){

		$respuesta = ModeloMuestras::mdlMostrarMuestras();

		return $respuesta;

	}

	/*=============================================
	MOSTRAR MUESTRA
	=============================================*/

	static public function ctrMostrarMuestra($id_muestra){

		$respuesta = ModeloMuestras::mdlMostrarMuestra($id_muestra);

		return $respuesta;

	}


	/*=============================================
	CREAR Muestra
	=============================================*/

	static public function ctrIngrearMuestra($id_producto){

		if($id_producto != null){

			$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);
		    
		    $traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
	    
	        $id_usuario = $traerUsuario['id'];
				
		    $id_sucursal = $traerUsuario['id_sucursal'];

			$datos = array("id_usuario"=>$id_usuario,
				"id_producto"=>$id_producto,
				"id_sucursal"=>$id_sucursal);

			$respuesta = ModeloMuestras::mdlIngresarMuestra($datos);

			if($respuesta !== "error"){

				$id_muestra = $respuesta[0];

				$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);

				$fecha_hora_ticket = date('d-m-Y H:i:s a');

				$impresora = $traerComputadora['imp_garantias'];

				$conector = new WindowsPrintConnector($impresora);

				$printer = new Printer($conector);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				$logo = EscposImage::load("C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/ticket.png", false);

				$printer -> bitImage($logo);

				$printer -> feed(1);

				$printer -> setJustification(Printer::JUSTIFY_LEFT);

				$printer -> text("MUESTRA DE MERCANCIA muestra de mercancia MUESTRA DE MERCANCIA muestra de mercancia MUESTRA DE MERCANCIA muestra de mercancia");

				$printer -> feed(2);

				$printer -> text("Fecha y hora: ".$fecha_hora_ticket);

				$printer -> feed(2);

				$printer -> text("Atendido por: ".$traerUsuario['nombre']);

				$printer -> feed(1);

				$printer -> text("No. Muestra: ".$id_muestra);

				$printer -> feed(1);

				$printer -> text("===============================================");

				$printer -> feed(1);

				$printer -> text("Ubicación: ".$traerProducto['ubicacion']);

				$printer -> feed(1);

				$printer -> text("Descripción: ".$traerProducto['descripcion_corta']);

				$printer -> feed(4);

				$printer -> text("______________________   _______________________");

				$printer -> feed(1);

				$printer -> text("  Firma del Vendedor         Nombre Surtidor");

				$printer -> feed(4);

				$printer -> text("______________________   _______________________");

				$printer -> feed(1);

				$printer -> text("      Se acomodo                No. Venta");

				$printer -> feed(1);

				$printer -> text("    (REGRESO PZA)             (VENDIO PZA)");

				$printer -> feed(1);

				$printer -> cut();

				$printer -> close();


				

				return 1;

				}else{
					return 0;

						
				}

		}
	}//CREAR Muestra





}



