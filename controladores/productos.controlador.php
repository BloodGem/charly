<?php

class ControladorProductos{

	

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProductos($columna, $valor){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarProductos($columna, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProductos2(){

		$respuesta = ModeloProductos::mdlMostrarProductos2();

		return $respuesta;

	}

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProducto($valor){

		$respuesta = ModeloProductos::mdlMostrarProducto($valor);

		return $respuesta;

	}







	static public function ctrMostrarMulticlaveProducto2($id_producto, $multiclave){

		$respuesta = ModeloProductos::mdlMostrarMulticlaveProducto2($id_producto, $multiclave);

		return $respuesta;

	}







	static public function ctrMostrarMulticlaveProducto($id_multiclave){

		$respuesta = ModeloProductos::mdlMostrarMulticlaveProducto($id_multiclave);

		return $respuesta;

	}






	static public function ctrMostrarMulticlaveProducto3($multiclave){

		$respuesta = ModeloProductos::mdlMostrarMulticlaveProducto3($multiclave);

		return $respuesta;

	}




	static public function ctrMostrarMulticlavesProducto($id_producto){

		$respuesta = ModeloProductos::mdlMostrarMulticlavesProducto($id_producto);

		return $respuesta;

	}



	static public function ctrCrearMulticlaveProducto($id_producto, $multiclave, $multiplo_entrega){

		$traerMulticlave = ControladorProductos::ctrMostrarMulticlaveProducto2($id_producto, $multiclave, $multiplo_entrega);

		if($traerMulticlave == false){

			$datos = array("id_producto" => $id_producto,
							   "multiclave" => $multiclave,
							   "multiplo_entrega" => $multiplo_entrega,
							   "id_usuario_creador" => $_SESSION['id']);

			$respuesta = ModeloProductos::mdlCrearMulticlaveProducto($datos);

			return $respuesta;
		}else{
			return 2;
		}

		

	}





	static public function ctrEliminarMulticlaveProducto($id_multiclave){

		$respuesta = ModeloProductos::mdlEliminarMulticlaveProducto($id_multiclave);

			return $respuesta;
	}










	static public function ctrMostrarProveedoresProducto($id_producto){

		$respuesta = ModeloProductos::mdlMostrarProveedoresProducto($id_producto);

		return $respuesta;

	}









	static public function ctrMostrarProductoProveedor($clave_producto, $id_proveedor){

		$respuesta = ModeloProductos::mdlMostrarProductoProveedor($clave_producto, $id_proveedor);

		return $respuesta;

	}





	static public function ctrMostrarProductoProveedor2($id_producto, $id_proveedor){

		$respuesta = ModeloProductos::mdlMostrarProductoProveedor2($id_producto, $id_proveedor);

		return $respuesta;

	}












	static public function ctrCrearProductoProveedor($datos){

		$respuesta = ModeloProductos::mdlCrearProductoProveedor($datos);

		return $respuesta;

	}






	static public function ctrActualizarProductoProveedor($columna, $valor, $id_producto, $id_proveedor){

			$respuesta = ModeloProductos::mdlActualizarProductoProveedor($columna, $valor, $id_producto, $id_proveedor);

			return $respuesta;		
		


	}









	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearProducto(){

		if(isset($_POST["nuevaClaveProducto"])){



			//$array1 = $_POST['nuevosAutosProducto'];

				

				//$autos = json_encode($array1);


				$imagen1 = $_FILES["nuevaImagen1"]["name"];
			   	if ($imagen1 !== '') {

    				$tempname1 = $_FILES["nuevaImagen1"]["tmp_name"];    
    				$folder1 = "vistas/img/productos/".$imagen1;
   					move_uploaded_file($tempname1, $folder1);
   					$imagen1_db = "vistas/img/productos/".$imagen1;

			   	}else{
			   		$imagen1_db = "vistas/img/productos/none.png";
			   	}

				$imagen2 = $_FILES["nuevaImagen2"]["name"];
			   	if ($imagen2 !== '') {
			   		
    				$tempname2 = $_FILES["nuevaImagen2"]["tmp_name"];    
    				$folder2 = "vistas/img/productos/".$imagen2;
   					move_uploaded_file($tempname2, $folder2);
   					$imagen2_db = "vistas/img/productos/".$imagen2;
			   		
			   	}else{
			   		$imagen2_db = "vistas/img/productos/none.png";
			   	}

				$imagen3 = $_FILES["nuevaImagen3"]["name"];
			   	if ($imagen3 !== '') {

    				$tempname3 = $_FILES["nuevaImagen3"]["tmp_name"];    
    				$folder3 = "vistas/img/productos/".$imagen3;
   					move_uploaded_file($tempname3, $folder3);
   					$imagen3_db = "vistas/img/productos/".$imagen3;

			   	}else{
			   		$imagen3_db = "vistas/img/productos/none.png";
			   	}


				



				//$lista_autos_producto = json_decode($_POST["listaAutosProducto"], true);

				$descripcion_larga = "";

				/*foreach ($lista_autos_producto as $key => $value) {
				    
				    $traerAuto = ModeloAutos::mdlMostrarAuto($value['id_auto']);

				    $traerMotor = ModeloMotores::mdlMostrarMotor($traerAuto['id_motor']);


				    $anos_auto = "";

				    foreach (range($value['ano_inicial'], $value['ano_final']) as $ano) {
					    $anos_auto = $anos_auto . ', '.$ano;
					}


					$descripcion_larga = $descripcion_larga . " " .$traerAuto['auto'] . " " .$traerAuto['submarca'] . " " . $traerMotor['motor'] . " " . $anos_auto . "\n";

				}*/
				$descripcion_larga = $_POST["nuevaDescripcionCorta"] . "\n" . $descripcion_larga;

				if($_POST["nuevoIdMarca"] !== ""){
					$traerMarca = ControladorMarcas::ctrMostrarMarca($_POST["nuevoIdMarca"]);
					$descripcion_larga = $descripcion_larga . "Marca: " . $traerMarca["marca"] . "\n";
				}

				/*if($_POST["nuevoMotor"] !== ""){
					$descripcion_larga = $descripcion_larga . "Motor: " . $_POST["nuevoMotor"] . "\n";
				}
				if($_POST["nuevaViscosidad"] !== ""){
					$descripcion_larga = $descripcion_larga . "Viscosidad: " . $_POST["nuevaViscosidad"] . "\n";
				}

				if($_POST["nuevaApl"] !== ""){
					$descripcion_larga = $descripcion_larga . "Apl: " . $_POST["nuevaApl"] . "\n";
				}
				if($_POST["nuevaPresentacion"] !== ""){
					$descripcion_larga = $descripcion_larga . "Presentacion: " . $_POST["nuevaPresentacion"] . "\n";
				}

				if($_POST["nuevasMedidas"] !== ""){
					$descripcion_larga = $descripcion_larga . "Medidas: " . $_POST["nuevasMedidas"] . "\n";
				}
				if($_POST["nuevoColor"] !== ""){
					$descripcion_larga = $descripcion_larga . "Color: " . $_POST["nuevoColor"] . "\n";
				}

				if($_POST["nuevoNumeroCanales"] !== "" && $_POST["nuevoNumeroCanales"] !== "0"){
					$descripcion_larga = $descripcion_larga . "No.canales: " . $_POST["nuevoNumeroCanales"] . "\n";
				}
				if($_POST["nuevoNumeroBirlos"] !== "" && $_POST["nuevoNumeroBirlos"] !== "0"){
					$descripcion_larga = $descripcion_larga . "No.Birlos: " . $_POST["nuevoNumeroBirlos"] . "\n";
				}

				if($_POST["nuevosDientes"] !== "" && $_POST["nuevosDientes"] !== "0"){
					$descripcion_larga = $descripcion_larga . "Dientes: " . $_POST["nuevosDientes"] . "\n";
				}


				if($_POST["nuevosAdicionales"] !== ""){
					$descripcion_larga = $descripcion_larga . "Adicionales: " . $_POST["nuevosAdicionales"] . "\n";
				}*/





				if($_POST["imprimeEtiqueta"] == 1){

					$imprimeEtiqueta = 1;

				}else{
					$imprimeEtiqueta = 0;
				}



				if($_POST["esProductoCompuesto"] == 1){

					$esProductoCompuesto = 1;

				}else{
					$esProductoCompuesto = 0;
				}


				$datos = array("clave_producto" => $_POST["nuevaClaveProducto"],
							   "clave_sat" => $_POST["nuevaClaveSat"],
							   "cve_unidad" => $_POST["nuevoCveUnidad"],
							   "unidad" => $_POST["nuevaUnidad"],
							   "descripcion_larga" => $descripcion_larga,
							   "descripcion_corta" => $_POST["nuevaDescripcionCorta"],
							   "id_marca" => $_POST["nuevoIdMarca"],
							   /*"motor" => $_POST["nuevoMotor"],
							   "viscosidad" => $_POST["nuevaViscosidad"],
							   "apl" => $_POST["nuevaApl"],
							   "presentacion" => $_POST["nuevaPresentacion"],
							   "medidas" => $_POST["nuevasMedidas"],
							   "color" => $_POST["nuevoColor"],
							   "no_canales" => $_POST["nuevoNumeroCanales"],
							   "no_birlos" => $_POST["nuevoNumeroBirlos"],
							   "dientes" => $_POST["nuevosDientes"],
							   "adicionales" => $_POST["nuevosAdicionales"],*/
								"imagen1" => $imagen1_db,
								"imagen2" => $imagen2_db,
								"imagen3" => $imagen3_db,
								/*"autos" => $_POST["listaAutosProducto"],
								"id_familia" => $_POST["nuevoIdFamilia"],
								"id_subfamilia" => $_POST["nuevoIdSubfamilia"],*/
								"imprime_etiqueta" => $imprimeEtiqueta,
								"multiplo_etiqueta" => $_POST["nuevoMultiploEtiqueta"],
								"es_compuesto" => $esProductoCompuesto,
								"productos_compuesto" => $_POST["listaProductosCompuesto"],
								/*"id_proveedor1" => $_POST["nuevoIdProveedor1"],
								"id_proveedor2" => $_POST["nuevoIdProveedor2"],
								"id_proveedor3" => $_POST["nuevoIdProveedor3"],
								"descontinuado" => $_POST["nuevoDescontinuado"],*/
					           "id_usuario_creador" => $_SESSION['id']);
					

				$respuesta = ModeloProductos::mdlCrearProducto($datos);


				if ($respuesta !== "error") {

					echo "<script>

						Swal.fire({
  						icon: 'success',
  						title: 'El producto ha sido creado con exito',
  						showConfirmButton: true
						}).then(function(result){
						window.location = 'index.php?ruta=lista-existencias-sucursales&clave_producto=".$_POST["nuevaClaveProducto"]."';
						});
					</script>";


					$id_producto = $respuesta[0];

					$traerSucursales = ModeloSucursales::mdlMostrarSucursales();

			foreach ($traerSucursales as $key => $value) {

				$datosES = array("id_producto" => $id_producto,
		                "id_sucursal" => $value['id_sucursal'],
		                "id_usuario_creador" => $_SESSION['id']);
				    
				$respuesta = ModeloExistenciasSucursales::mdlCrearProductoES($datosES);

				if($respuesta == "ok"){

					echo "<script>
                				$(document).Toasts('create', {
                                class: 'bg-success',
                                title: 'Producto agregado correctamente',
                                body: 'Sucursal ".$value['nombre']."'
                                })
                			</script>";
				}else{
					echo "<script>
                				$(document).Toasts('create', {
                                class: 'bg-error',
                                title: 'Error, Producto negado',
                                body: 'Sucursal ".$value['nombre']."'
                                })
                			</script>";
				}

			}



					
				}else{
					echo "<script>

						Swal.fire({
  						icon: 'error',
  						title: 'Error!!!',
  						showConfirmButton: false,
  						timer: 2000
						});
					</script>";
				}

				
			

		}

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarProducto(){

		if(isset($_POST["editarClaveProducto"])){

			$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($_SESSION['id']);

			$id_sucursal = $traerUsuario['id_sucursal'];

			$id_producto = $_POST["editarProducto"];

			$busquedaAnterior = $_POST['busquedaAnterior'];

			//$array1 = $_POST['nuevoAutosProducto'];


				//$autos = json_encode($array1);

			   	
			   	$imagen1 = $_FILES["editarImagen1"]["name"];
			   	
			   	if ($imagen1 !== '') {

    				$tempname1 = $_FILES["editarImagen1"]["tmp_name"];    
    				$folder1 = "vistas/img/productos/".$imagen1;
   					move_uploaded_file($tempname1, $folder1);
   					$imagen1_db = "vistas/img/productos/".$imagen1;

			   	}else{
			   		$imagen1_db = $_POST['actualImagen1'];
			   	}


				$imagen2 = $_FILES["editarImagen2"]["name"];

			   	if ($imagen2 !== '') {

			   		
    				$tempname2 = $_FILES["editarImagen2"]["tmp_name"];    
    				$folder2 = "vistas/img/productos/".$imagen2;
   					move_uploaded_file($tempname2, $folder2);
   					$imagen2_db = "vistas/img/productos/".$imagen2;
			   		
			   	}else{
			   		$imagen2_db = $_POST['actualImagen2'];
			   	}



			   	$imagen3 = $_FILES["editarImagen3"]["name"];

			   	if ($imagen3 !== '') {

			   		
    				$tempname3 = $_FILES["editarImagen3"]["tmp_name"];    
    				$folder3 = "vistas/img/productos/".$imagen3;
   					move_uploaded_file($tempname3, $folder3);
   					$imagen3_db = "vistas/img/productos/".$imagen3;

			   	}else{
			   		$imagen3_db = $_POST['actualImagen3'];
			   	}

$nivel_medio = round(($_POST["editarNivelMaximo"] - $_POST["editarNivelMinimo"])/1.5);


				//$lista_autos_producto = json_decode($_POST["listaAutosProducto"], true);

				$descripcion_larga = "";

				/*foreach ($lista_autos_producto as $key => $value) {
				    
				    $traerAuto = ModeloAutos::mdlMostrarAuto($value['id_auto']);

				    $traerMotor = ModeloMotores::mdlMostrarMotor($traerAuto['id_motor']);


				    $anos_auto = "";

				    foreach (range($value['ano_inicial'], $value['ano_final']) as $ano) {
					    $anos_auto = $anos_auto . ', '.$ano;
					}


					$descripcion_larga = $descripcion_larga . " " .$traerAuto['auto'] . " " .$traerAuto['submarca'] . " " . $traerMotor['motor'] . " " . $anos_auto . "\n";

				}*/
				$descripcion_larga = $_POST["editarDescripcionCorta"] . "\n" . $descripcion_larga;

				if($_POST["editarIdMarca"] !== ""){
					$traerMarca = ControladorMarcas::ctrMostrarMarca($_POST["editarIdMarca"]);
					$descripcion_larga = $descripcion_larga . "Marca: " . $traerMarca["marca"] . "\n";
				}

				/*if($_POST["editarMotor"] !== ""){
					$descripcion_larga = $descripcion_larga . "Motor: " . $_POST["editarMotor"] . "\n";
				}
				if($_POST["editarViscosidad"] !== ""){
					$descripcion_larga = $descripcion_larga . "Viscosidad: " . $_POST["editarViscosidad"] . "\n";
				}

				if($_POST["editarApl"] !== ""){
					$descripcion_larga = $descripcion_larga . "Apl: " . $_POST["editarApl"] . "\n";
				}
				if($_POST["editarPresentacion"] !== ""){
					$descripcion_larga = $descripcion_larga . "Presentacion: " . $_POST["editarPresentacion"] . "\n";
				}

				if($_POST["editarsMedidas"] !== ""){
					$descripcion_larga = $descripcion_larga . "Medidas: " . $_POST["editarsMedidas"] . "\n";
				}
				if($_POST["editarColor"] !== ""){
					$descripcion_larga = $descripcion_larga . "Color: " . $_POST["editarColor"] . "\n";
				}

				if($_POST["editarNumeroCanales"] !== "" && $_POST["editarNumeroCanales"] !== "0"){
					$descripcion_larga = $descripcion_larga . "No.canales: " . $_POST["editarNumeroCanales"] . "\n";
				}
				if($_POST["editarNumeroBirlos"] !== "" && $_POST["editarNumeroBirlos"] !== "0"){
					$descripcion_larga = $descripcion_larga . "No.Birlos: " . $_POST["editarNumeroBirlos"] . "\n";
				}

				if($_POST["editarDientes"] !== "" && $_POST["editarDientes"] !== "0"){
					$descripcion_larga = $descripcion_larga . "Dientes: " . $_POST["editarDientes"] . "\n";
				}





				if($_POST["editarAdicionales"] !== ""){
					$descripcion_larga = $descripcion_larga . "Adicionales: " . $_POST["editarAdicionales"] . "\n";
				}*/





				if($_POST["imprimeEtiqueta"] == 1){

					$imprimeEtiqueta = 1;

				}else{
					$imprimeEtiqueta = 0;
				}




				if($_POST["esProductoCompuesto"] == 1){

					$esProductoCompuesto = 1;

				}else{
					$esProductoCompuesto = 0;
				}





				$datos = array("id_producto" => $id_producto,
							   "clave_producto" => $_POST["editarClaveProducto"],
							   "clave_sat" => $_POST["editarClaveSat"],
							   "cve_unidad" => $_POST["editarCveUnidad"],
							   "unidad" => $_POST["editarUnidad"],
							   "descripcion_larga" => $descripcion_larga,
							   "descripcion_corta" => $_POST["editarDescripcionCorta"],
							   "id_marca" => $_POST["editarIdMarca"],
							   /*"motor" => $_POST["editarMotor"],
							   "viscosidad" => $_POST["editarViscosidad"],
							   "apl" => $_POST["editarApl"],
							   "presentacion" => $_POST["editarPresentacion"],
							   "medidas" => $_POST["editarsMedidas"],
							   "color" => $_POST["editarColor"],
							   "no_canales" => $_POST["editarNumeroCanales"],
							   "no_birlos" => $_POST["editarNumeroBirlos"],
							   "dientes" => $_POST["editarDientes"],
							   "adicionales" => $_POST["editarAdicionales"],*/
								"imagen1" => $imagen1_db,
								"imagen2" => $imagen2_db,
								"imagen3" => $imagen3_db,
								/*"autos" => $_POST["listaAutosProducto"],
								"id_familia" => $_POST["editarIdFamilia"],
								"id_subfamilia" => $_POST["editarIdSubfamilia"],*/
								"imprime_etiqueta" => $imprimeEtiqueta,
								"multiplo_etiqueta" => $_POST["editarMultiploEtiqueta"],
								"es_compuesto" => $esProductoCompuesto,
								"productos_compuesto" => $_POST["listaProductosCompuesto"],
								/*"id_proveedor1" => $_POST["editarIdProveedor1"],
								"id_proveedor2" => $_POST["editarIdProveedor2"],
								"id_proveedor3" => $_POST["editarIdProveedor3"],
								"descontinuado" => $_POST["editarDescontinuado"],*/
							   "id_usuario_ult_mod" => $_SESSION['id']);

				/*var_dump($datos);

				return;*/

				$respuesta = ModeloProductos::mdlEditarProducto($datos);

				if($respuesta == "ok"){


					$datos = array("id_producto" => $id_producto,
                    "id_sucursal" => $id_sucursal,
                    "ubicacion" => $_POST["ubicacion"],
		            "precio1" => $_POST["precio1"],
		            "utilidad1" => $_POST["utilidad1"],
		            "precio2" => $_POST["precio2"],
		            "utilidad2" => $_POST["utilidad2"],
		            "precio3" => $_POST["precio3"],
		            "utilidad3" => $_POST["utilidad3"],
		            "nivel_minimo" => $_POST["nivel_minimo"],
		            "nivel_medio" => $_POST["nivel_medio"],
		            "nivel_maximo" => $_POST["nivel_maximo"],
		            "id_usuario_ult_mod" => $_SESSION['id']);

					$respuesta = ModeloExistenciasSucursales::mdlEditarProductoExistenciaSucursal($datos);




					echo "<script>

					Swal.fire({
  icon: 'success',
  title: 'El producto ha sido editado con exito',
  showConfirmButton: false,
  timer: 2000
}).then(function(result){
						
							window.location = 'index.php?ruta=lista-productos&busquedaAnterior=".$busquedaAnterior."';

					});
				

				</script>";

				}


			

		}

	}
	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarProducto(){

		if(isset($_GET["id_producto"])){

			
			$datos = $_GET["id_producto"];

			

			$respuesta = ModeloProductos::mdlEliminarProducto($datos);

			if($respuesta == "ok"){

				echo "<script>
									Swal.fire({
									icon: 'success',
									title: 'El producto ha sido eliminado con exito',
									showConfirmButton: false,
									timer: 2000
									}).then(function(result){
											window.location = 'lista-productos';
										});
								</script>";

			}		
		}


	}










static public function ctrActualizarProducto($columna, $valor, $id_producto){

	$id_usuario_ult_mod = $_SESSION['id'];

	$respuesta = ModeloProductos::mdlActualizarProducto($columna, $valor, $id_producto, $id_usuario_ult_mod);

	if($respuesta == "ok"){
		return 1;
	}else{
		return 0;
	}

}










static public function ctrSubirImagenProducto($no_imagen, $imagen, $id_producto){

	$columna = "imagen".$no_imagen;

	$respuesta = ControladorProductos::ctrActualizarProducto($columna, $imagen, $id_producto);

	return $respuesta;
}




/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/
	/*static public function ctrActualizarProducto($columna, $valor, $id_producto, $id_usuario_ult_mod){

			$respuesta = ModeloProductos::mdlActualizarProducto($columna, $valor, $id_producto, $id_usuario_ult_mod);

			if($respuesta == "ok"){

				echo "<script>
									Swal.fire({
									icon: 'success',
									title: 'El producto ha sido actualizado con exito',
									showConfirmButton: false,
									timer: 2000
									});
								</script>";

			}

			return $respuesta;		
		


	}*/










	/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/
	/*static public function ctrSolicitarProducto($id_producto, $id_usuario){

		$traerProduto = ModeloProductos::mdlMostrarProducto($id_producto);

		$nuevoStock = $traerProduto['stock'] - 1;

		$columna = "stock";

		$respuesta = ModeloProductos::mdlActualizarProducto($columna, $nuevoStock, $id_producto);

		if($respuesta == "ok"){


			$tipo_log = "solicitud";

			$log_producto = ModeloProductos::mdlLogProductos($tipo_log, $id_producto, $id_usuario);


		}

			return $respuesta;		
		

	}*/



}