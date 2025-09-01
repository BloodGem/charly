<?php


class ControladorExistenciasSucursales{
		/*=============================================
	CREAR FAMILIA
	=============================================*/

	static public function ctrMostrarProductoES($id_producto){
	    
	    $traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
		$id_sucursal = $traerUsuario['id_sucursal'];

		$respuesta = ModeloExistenciasSucursales::mdlMostrarProductoES($id_producto, $id_sucursal);

		return $respuesta;

	}

	static public function ctrMostrarProductoES2($id_producto, $id_sucursal){
		$respuesta = ModeloExistenciasSucursales::mdlMostrarProductoES($id_producto, $id_sucursal);

		return $respuesta;

	}





	static public function ctrMostrarProductoESFiltro($columna, $valor, $id_sucursal){

		$respuesta = ModeloExistenciasSucursales::mdlMostrarProductoESFiltro($columna, $valor, $id_sucursal);

		return $respuesta;

	}


	static public function ctrMostrarProductoESMulticlave($multiclave, $id_sucursal){
		$respuesta = ModeloExistenciasSucursales::mdlMostrarProductoESMulticlave($multiclave, $id_sucursal);

		return $respuesta;

	}
	
	/*=============================================
	CREAR FAMILIA
	=============================================*/

	static public function ctrMostrarProductoESVenta($id_producto){
	    
	    /*$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
		$id_sucursal = $traerUsuario['id_sucursal'];*/
		
		$id_sucursal = 1;

		$respuesta = ModeloExistenciasSucursales::mdlMostrarProductoESVenta($id_producto, $id_sucursal);

		return $respuesta;
}

	static public function ctrEditarProductoES(){

		if(isset($_POST["id_producto"])){
		    
		$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);


				
		$id_sucursal = $traerUsuario['id_sucursal'];
		    

		$datos = array("id_producto" => $_POST["id_producto"],
		                "id_sucursal" => $id_sucursal,
		                "ubicacion" => $_POST["editarUbicacion"],
					    "precio1" => $_POST["editarPrecio1"],
						"utilidad1" => $_POST["editarUtilidad1"],
						"precio2" => $_POST["editarPrecio2"],
						"utilidad2" => $_POST["editarUtilidad2"],
						"precio3" => $_POST["editarPrecio3"],
						"utilidad3" => $_POST["editarUtilidad3"],
						"nivel_minimo" => $_POST["editarNivelMinimo"],
						"nivel_medio" => $_POST["mostrarNivelMedio"],
						"nivel_maximo" => $_POST["editarNivelMaximo"],
						"id_usuario_ult_mod" => $_SESSION['id']);

		$respuesta = ModeloExistenciasSucursales::mdlEditarProductoExistenciaSucursal($datos);

		if($respuesta == "ok"){
			echo "<script>

						Swal.fire({
  						icon: 'success',
  						title: 'El producto se ha modificado con exito',
  						showConfirmButton: false,
  						timer: 2000
						}).then(function(result){
						window.location = 'lista-existencias-sucursales';
						});
					</script>";
				}else{
					echo "<script>

						Swal.fire({
  						icon: 'error',
  						showConfirmButton: false,
  						timer: 2000
						});
					</script>";
				}
			}

	}











	static public function ctrEditarExistenciasProductoModulo($datos){

		

		$respuesta = ModeloExistenciasSucursales::mdlEditarProductoExistenciaSucursal($datos);

		if($respuesta == "ok"){
			return 1;
				}else{
					return 0;
				}
			

	}











	static public function ctrExistenciasProductosMarcaCUPM($id_marca, $id_sucursal){

	$respuesta = ModeloExistenciasSucursales::mdlExistenciasProductosMarcaCUPM($id_marca, $id_sucursal);

	return $respuesta;

}










static public function ctrCambiarUtilidadesProductosMarca(){

		if(isset($_POST["idMarcaCUPM"])){

			$id_marca = $_POST["idMarcaCUPM"];

			$id_usuario = $_SESSION['id'];

			$traerUsuario = ControladorUsuarios::ctrMostrarusuario($id_usuario);

			$id_sucursal = $traerUsuario['id_sucursal'];

			$traerProductos = ControladorExistenciasSucursales::ctrExistenciasProductosMarcaCUPM($id_marca, $id_sucursal);

			$utilidad1 = $_POST['utilidad1CUPM'];
			$utilidad2 = $_POST['utilidad2CUPM'];
			$utilidad3 = $_POST['utilidad3CUPM'];

			$correctos = 0;
			$erroneos = 0;
			foreach ($traerProductos as $key => $row) {

				$id_producto = $row['id_producto'];

				$precio1 = round($row['precio_compra']*(1+($utilidad1/100))*1.16, 0);

				$precio2 = round($row['precio_compra']*(1+($utilidad2/100))*1.16, 0);

				$precio3 = round($row['precio_compra']*(1+($utilidad3/100))*1.16, 0);

				$datos = array("id_producto" => $id_producto,
					           "precio1" => $precio1,
					           "utilidad1" => $utilidad1,
					           "precio2" => $precio2,
					           "utilidad2" => $utilidad2,
					           "precio3" => $precio3,
					           "utilidad3" => $utilidad3,
					           "id_sucursal" => $id_sucursal,
					       		"id_usuario_ult_mod" => $id_usuario);


				$respuesta = ControladorExistenciasSucursales::ctrCambiarUtilidadesProducto($datos);

				var_dump($respuesta);

				if($respuesta == "ok"){
					$correctos = $correctos + 1;
				}else{
					$erroneos = $erroneos + 1;
				}

			}

			echo "<script>

					Swal.fire({
						icon: 'success',
						title: 'Se han aplicado movimientos',
						text: 'Correctos: ".$correctos." --- Erroneos: ".$erroneos."',
						showConfirmButton: true
						}).then(function(result){
							window.location = 'index.php?ruta=cambiar-utilidades-productos-marca&id_marca=".$id_marca."';
							});

							</script>";
		}
	}










	static public function ctrCambiarUtilidadesProducto($datos){

		$respuesta = ModeloExistenciasSucursales::mdlCambiarUtilidadesProducto($datos);

		return $respuesta;

	}










	static public function ctrCrearProductoES($id_producto){
		    
			$traerSucursales = ModeloSucursales::mdlMostrarSucursales();

			foreach ($traerSucursales as $key => $value) {

				$datos = array("id_producto" => $id_producto,
		                "id_sucursal" => $value['id_sucursal'],
		                "id_usuario_creador" => $_SESSION['id']);
				    
				$respuesta = ModeloExistenciasSucursales::mdlCrearProductoES($datos);

				/*if($respuesta == "ok"){

					$traerProducto = ModeloProductos::mdlMostrarProducto($id_producto);
					echo "<script>
                				$(document).Toasts('create', {
                                class: 'bg-success',
                                title: 'Producto agregado correctamente',
                                body: 'A la sucursal ".$value['nombre']." se le ha agregado el producto: ".$traerProducto['descripcion_corta']."'
                                })
                			</script>";
				}else{
					echo "<script>
                				$(document).Toasts('create', {
                                class: 'bg-error',
                                title: 'Error, Producto negado',
                                body: 'A la sucursal ".$value['nombre']." no se le ha agregado el producto: ".$traerProducto['descripcion_corta']." comunicate con soporte'
                                })
                			</script>";
				}*/

			}
	}
	
	
	
	
	
	
	
	
	

static public function ctrActualizarProductoES($columna, $valor, $id_producto){

	$id_usuario_ult_mod = $_SESSION['id'];

	$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);

	$id_sucursal = $traerUsuario['id_sucursal'];

	$respuesta = ModeloExistenciasSucursales::mdlActualizarProductoES($columna, $valor, $id_producto, $id_sucursal, $id_usuario_ult_mod);

	if($respuesta == "ok"){
		return 1;
	}else{
		return 0;
	}

}










static public function ctrActualizarProductoES2($columna, $valor, $id_producto, $id_sucursal, $id_usuario_ult_mod){

	$respuesta = ModeloExistenciasSucursales::mdlActualizarProductoES($columna, $valor, $id_producto, $id_sucursal, $id_usuario_ult_mod);

	if($respuesta == "ok"){
		return 1;
	}else{
		return 0;
	}

}










static public function ctrMostrarProductosSucursal($id_sucursal){

	$respuesta = ModeloExistenciasSucursales::mdlMostrarProductosSucursal($id_sucursal);

	return $respuesta;

}









static public function ctrMostrarAnaquelesSucursal($id_sucursal){

	$respuesta = ModeloExistenciasSucursales::mdlMostrarAnaquelesSucursal($id_sucursal);

	return $respuesta;

}










static public function ctrVerificarExistenciasPorductosVenta($productos){

		$id_usuario = $_SESSION['id'];

		$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($id_usuario);

		$id_sucursal = $traerUsuario['id_sucursal'];

		$listaProductos = json_decode($productos, true);

			$data1 = [];
			$data2 = [];
			$data3 = [];
			$data4 = [];

		foreach ($listaProductos as $key => $value) {

			$id_producto = $value["id"];

			$traerProductoES = ModeloExistenciasSucursales::mdlMostrarProductoES($id_producto, $id_sucursal);

			

			if($value['cantidad'] > $traerProductoES['stock']){
				
				array_push($data1, $id_producto);
				array_push($data2, $traerProductoES['clave_producto']);
				array_push($data3, $value['cantidad']);
				array_push($data4, $traerProductoES['stock']);
			}

			 

		}

		return array($data1, $data2, $data3, $data4);
	}










	static public function ctrVerificarExistenciasProductosCotizacion($productos){

		$id_usuario = $_SESSION['id'];

		$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($id_usuario);

		$id_sucursal = $traerUsuario['id_sucursal'];

		$listaProductos = json_decode($productos, true);

			$data1 = [];
			$data2 = [];
			$data3 = [];
			$data4 = [];

		foreach ($listaProductos as $key => $value) {

			$id_producto = $value["id"];

			$traerProductoES = ModeloExistenciasSucursales::mdlMostrarProductoES($id_producto, $id_sucursal);

			

			if($value['cantidad'] > $traerProductoES['stock']){
				
				array_push($data1, $id_producto);
				array_push($data2, $traerProductoES['clave_producto']);
				array_push($data3, $value['cantidad']);
				array_push($data4, $traerProductoES['stock']);
			}

			 

		}

		return array($data1, $data2, $data3, $data4);
	}










	static public function ctrActualizarProductosMasivamente(){

		if(isset($_FILES["archivoCSVExistenciasProductos"])){
			$archivo = $_FILES["archivoCSVExistenciasProductos"]["name"];
			$tempname1 = $_FILES["archivoCSVExistenciasProductos"]["tmp_name"];    
			$folder1 = "recursos/csv_masivos/".$archivo;
			if(move_uploaded_file($tempname1, $folder1)){

				$ruta_archivo = "recursos/csv_masivos/".$archivo;

				if(($archivoCsv = fopen($ruta_archivo, "r")) !== false){

					$con = 0;

					while (($datos = fgetcsv($archivoCsv, ",")) == true) {


		   				$columna = "productos.clave_producto";

		   				$clave_producto = $datos[0];
		   				$descripcion_corta = $datos[1];
		   				$clave_sat = $datos[2];
		   				$precio_compra = $datos[4];
		   				$utilidad1 = $datos[5];
		   				$precio1 = $datos[6];
		   				$utilidad2 = $datos[7];
		   				$precio2 = $datos[8];
		   				$utilidad3 = $datos[9];
		   				$precio3 = $datos[10];
		   				$marca = $datos[11];
		   				
		   				$traerMarca = ControladorMarcas::ctrMostrarMarcaFiltro("marca", $marca);

		   				

		   				$traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoESFiltro($columna, $clave_producto, 1);

		   				if($traerProducto !== false){

		   					if($traerMarca !== false){
		   						$id_marca = $traerMarca['id_marca'];
		   						$descripcion_larga = $descripcion_corta . "\n" . "Marca:" . $traerMarca["marca"];
		   					}else{
		   						$id_marca = 0;
		   						$descripcion_larga = $descripcion_corta;
		   					}

		   					//var_dump("clave: ".$clave_producto." se actualiza a ul1:".$utilidad1.", ul2:".$utilidad2.", ul3:".$utilidad3."\n");

		   					$id_producto = $traerProducto['id_producto'];

		   				/*$datos = array("id_producto" => $id_producto,
		                "id_sucursal" => 1,
		                "utilidad1" => $utilidad1,
						"utilidad2" => $utilidad2,
						"utilidad3" => $utilidad3);

		   				$actualizarPrecioProducto = ModeloExistenciasSucursales::mdlActualizarProductosMasivamente($datos);

		   				var_dump($actualizarPrecioProducto."\n");*/

		   				

		   				ControladorProductos::ctrActualizarProducto("id_marca", $id_marca, $id_producto);

		   				ControladorProductos::ctrActualizarProducto("descripcion_larga", $descripcion_larga, $id_producto);

		   				ControladorProductos::ctrActualizarProducto("descripcion_corta", $descripcion_corta, $id_producto);

		   				ControladorExistenciasSucursales::ctrActualizarProductoES2("precio_compra", $precio_compra, $id_producto, 1, 1);

		   				
		   			}/*else{

		   				var_dump("clave: ".$clave_producto." se crea ---> ul1:".$utilidad1.", ul2:".$utilidad2.", ul3:".$utilidad3."\n");

						$descripcion_larga = $descripcion_corta . "\n" . "Marca: " . $traerMarca["marca"];

		   				$datos = array("clave_producto" => $clave_producto,
							   "clave_sat" => $clave_sat,
							   "cve_unidad" => "H87",
							   "unidad" => "PZA",
							   "descripcion_larga" => $descripcion_larga,
							   "descripcion_corta" => $descripcion_corta,
							   "id_marca" => $id_marca,
								"imagen1" => "vistas/img/productos/none.png",
								"imagen2" => "vistas/img/productos/none.png",
								"imagen3" => "vistas/img/productos/none.png",
								"imprime_etiqueta" => 1,
								"multiplo_etiqueta" => 1,
					           "id_usuario_creador" => $_SESSION['id']);

		   				var_dump($datos);
					

				$respuesta = ModeloProductos::mdlCrearProducto($datos);

				var_dump($respuesta."\n");
				if ($respuesta !== "error") {


					$id_producto = $respuesta[0];

					$traerSucursales = ModeloSucursales::mdlMostrarSucursales();

			foreach ($traerSucursales as $key => $value) {

				$datosES = array("id_producto" => $id_producto,
		                "id_sucursal" => $value['id_sucursal'],
		                "precio1" => $precio1,
		                "utilidad1" => $utilidad1,
		                "precio2" => $precio2,
		                "utilidad2" => $utilidad2,
		                "precio3" => $precio3,
		                "utilidad3" => $utilidad3,
		                "id_usuario_creador" => $_SESSION['id']);
				    
				$respuesta = ModeloExistenciasSucursales::mdlCrearProductoESMasivo($datosES);


			}



					
				}
		   			}*/
	   				}

	   				/*echo '<script>
					window.open("vistas/modulos/botonesDescarga/csvProductos.php", "_blank");
					</script>';*/

					echo "<script>

						Swal.fire({
  						icon: 'success',
  						title: 'Los precios se han cambiado',
  						showConfirmButton: true
						});
					</script>";

	   			}
	   		}
		}		
	}









}