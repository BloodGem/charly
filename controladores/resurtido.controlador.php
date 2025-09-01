<?php


class ControladorResurtidos{


	/*=============================================
	MOSTRAR COMPRAS
	=============================================*/

	static public function ctrMostrarResurtidos(){

		$respuesta = ModeloResurtidos::mdlMostrarResurtidos();

		return $respuesta;

	}

	/*=============================================
	MOSTRAR COMPRA CLIENTE
	=============================================*/

	static public function ctrMostrarResurtido($id_resurtido){

		$respuesta = ModeloResurtidos::mdlMostrarResurtido($id_resurtido);

		return $respuesta;

	}











	static public function ctrMostrarPartidasResurtido($id_resurtido){

		$respuesta = ModeloResurtidos::mdlMostrarPartidasResurtido($id_resurtido);

		return $respuesta;

	}










	static public function ctrGuardaDatosPartidaResurtido($id_partres, $a_pedir){

		//$total = number_format(($cantidad * $precio), 2, '.', '');

		$datos = array(
		"id_partres"=>$id_partres,
		"a_pedir"=>$a_pedir);

		$respuesta = ModeloPartres::mdlGuardaDatosPartidaResurtido($datos);

		return $respuesta;

	}










	static public function ctrEliminarPartidaResurtido($id_partres){

			if($id_partres !== "" && $id_partres !== null){

			$respuesta = ModeloPartres::mdlEliminarPartidaResurtido($id_partres);

			return $respuesta;

		}
	}











	static public function ctrCrearVistaProductos($id_marca){

		$id_usuario = $_SESSION['id'];

		$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($id_usuario);

		$id_sucursal = $traerUsuario['id_sucursal'];

		$sqlDrop = "DROP VIEW serverside_productos_".$id_sucursal."_".$id_usuario;

		if($id_marca !== "0"){
		    $sql_id_marca = " AND productos.id_marca = '".$id_marca."'";
		}else{
		    $sql_id_marca = "";
		}

		$sqlView = "CREATE VIEW serverside_productos_".$id_sucursal."_".$id_usuario." AS SELECT existencias_sucursales.id_producto, productos.clave_producto, productos.descripcion_corta, productos.descripcion_larga FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto WHERE productos.descontinuado = 0 AND existencias_sucursales.id_sucursal = $id_sucursal".$sql_id_marca." ORDER BY productos.descripcion_larga ASC";

		$respuesta = ModeloResurtidos::mdlEliminarCrearVista($sqlDrop, $sqlView);

		return $respuesta;

	}










	static public function ctrCrearVistaProductosAlfabeticos($producto_inicial, $producto_final, $id_marca, $id_sucursal){

		$id_usuario = $_SESSION['id'];

		if($id_marca !== "0"){
		    $sql_id_marca = " AND productos.id_marca = '".$id_marca."'";
		}else{
		    $sql_id_marca = "";
		}

		$sqlDrop = "DROP VIEW resurtido_alfabetico_".$id_sucursal."_".$id_usuario;

		$sqlView = "CREATE VIEW resurtido_alfabetico_".$id_sucursal."_".$id_usuario." AS SELECT existencias_sucursales.id_producto, productos.clave_producto, productos.descripcion_corta, productos.descripcion_larga, existencias_sucursales.stock, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, (existencias_sucursales.nivel_maximo - existencias_sucursales.stock) as a_pedir, existencias_sucursales.precio_compra FROM existencias_sucursales INNER JOIN productos ON existencias_sucursales.id_producto = productos.id_producto WHERE descripcion_corta >= '$producto_inicial' AND descripcion_corta <= '$producto_final' AND existencias_sucursales.id_sucursal = $id_sucursal".$sql_id_marca." ORDER BY descripcion_corta ASC";


		$respuesta = ModeloResurtidos::mdlEliminarCrearVista($sqlDrop, $sqlView);

		return $respuesta;

	}










	static public function ctrCrearVistaProductosProveedor($id_proveedor){

		$id_usuario = $_SESSION['id'];

		$traerUsuario = ControladorUsuarios::ctrMostrarUsuario($id_usuario);

		$id_sucursal = $traerUsuario['id_sucursal'];

		$sqlDrop = "DROP VIEW serverside_productos_proveedor_".$id_sucursal."_".$id_usuario;

		$sqlView = "CREATE VIEW serverside_productos_proveedor_".$id_sucursal."_".$id_usuario." AS SELECT existencias_sucursales.id_producto, productos.clave_producto, productos.descripcion_corta, productos.descripcion_larga FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto INNER JOIN productos_proveedores ON existencias_sucursales.id_producto = productos_proveedores.id_producto WHERE productos_proveedores.id_proveedor = $id_proveedor AND productos.descontinuado = 0 AND existencias_sucursales.id_sucursal = $id_sucursal ORDER BY productos.descripcion_larga ASC";

		$respuesta = ModeloResurtidos::mdlEliminarCrearVista($sqlDrop, $sqlView);

		return $respuesta;

	}











	static public function ctrCrearVistaProductosInicialFinalProveedor($producto_inicial, $producto_final, $id_proveedor, $id_sucursal){

		$id_usuario = $_SESSION['id'];

		$sqlDrop = "DROP VIEW resurtido_proveedor_".$id_sucursal."_".$id_usuario;

		$sqlView = "CREATE VIEW resurtido_proveedor_".$id_sucursal."_".$id_usuario." AS SELECT existencias_sucursales.id_producto, productos.clave_producto, productos.descripcion_corta, productos.descripcion_larga, existencias_sucursales.stock, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, (existencias_sucursales.nivel_maximo - existencias_sucursales.stock) as a_pedir, existencias_sucursales.precio_compra FROM existencias_sucursales INNER JOIN productos ON existencias_sucursales.id_producto = productos.id_producto INNER JOIN productos_proveedores ON existencias_sucursales.id_producto = productos_proveedores.id_producto WHERE productos_proveedores.id_proveedor = $id_proveedor AND descripcion_corta >= '$producto_inicial' AND descripcion_corta <= '$producto_final' AND existencias_sucursales.stock <= existencias_sucursales.nivel_minimo AND existencias_sucursales.id_sucursal = $id_sucursal ORDER BY descripcion_corta ASC";

		//return $sqlView;

		$respuesta = ModeloResurtidos::mdlEliminarCrearVista($sqlDrop, $sqlView);

		return $respuesta;

	}










	/*=============================================
	CREAR COMPRA
	=============================================*/

	static public function ctrCrearResurtido(){
	    

		if(isset($_POST["listaProductosResurtido"])){
	
		$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
				
		$id_sucursal = $traerUsuario['id_sucursal'];
		
		$id_usuario = $_SESSION['id'];

			$datos = array(
				"id_proveedor"=>$_POST["seleccionaProveedorResurtido2"],
				"wiew_productos"=>$_POST["listaProductosResurtido"],
				"id_sucursal"=>$id_sucursal,
				"id_usuario_creador" => $id_usuario);

			$respuesta = ModeloResurtidos::mdlCrearResurtido($datos);

			if($respuesta !== "error"){

				$id_resurtido = $respuesta[0];

				$respuesta_agregar_productos = ControladorResurtidos::ctrAgregarProductosResurtido($id_resurtido);


				if($respuesta_agregar_productos == "ok"){

					echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'El resurtido no.".$id_resurtido." ha sido generado con exito',
					showConfirmButton: true
					}).then(function(result){
						window.location = 'index.php?ruta=editar-resurtido&id_resurtido=".$id_resurtido."';
						
					});</script>";

				}else{

					echo "<script>

				Swal.fire({
					icon: 'warning',
					title: 'El resurtido no.".$id_resurtido." ha sido generado con exito',
					text: 'Pero al parecer los productos no se han agregado al resurtido, hay que notificar a sistemas',
					showConfirmButton: true
					}).then(function(result){
						window.location = 'lista-resurtidos';
						});</script>";

				}
				



				}else{
					echo"<script>
					Swal.fire({
						icon: 'error',
						title: 'Ooh Ooh, algo salio mal',
						showConfirmButton: true
						});
						</script>";

						
					}

				}
	}//CREAR RESURTIDO











	static public function ctrAgregarProductosResurtido($id_resurtido){

		$traerResurtido = ControladorResurtidos::ctrMostrarResurtido($id_resurtido);

		$id_sucursal = $traerResurtido['id_sucursal'];

		$wiew_productos = $traerResurtido['wiew_productos'];

		/*$sql = "INSERT INTO partres (id_resurtido, id_producto, stock_actual, nivel_maximo, a_pedir) SELECT $id_resurtido, $wiew_productos.id_producto, existencias_sucursales.stock, existencias_sucursales.nivel_maximo, $wiew_productos.a_pedir FROM $wiew_productos INNER JOIN existencias_sucursales ON $wiew_productos.id_producto = existencias_sucursales.id_producto WHERE existencias_sucursales.id_sucursal = $id_sucursal";

		return $sql;*/

		$respuesta = ModeloResurtidos::mdlAgregarProductosResurtido($id_resurtido, $wiew_productos);

		return $respuesta;

	}












static public function ctrConvertirResurtidoACompra(){

		if(isset($_POST["convertirResurtidoACompra"])){

			$id_resurtido = $_POST["convertirResurtidoACompra"];

		$traerResurtido = ModeloResurtidos::mdlMostrarResurtido($id_resurtido);
		
		$id_usuario = $_SESSION['id'];

		$datos = array(
				"id_proveedor"=>$traerResurtido["id_proveedor"],
				"id_resurtido"=>$traerResurtido["id_resurtido"],
				"cambiar_precios"=>1,
				"id_sucursal"=>$traerResurtido["id_sucursal"],
				"id_usuario_creador" => $_SESSION['id']);

			$respuesta = ModeloResurtidos::mdlConvertirResurtidoACompra($datos);
			
			if($respuesta !== "error"){
			    $id_compra = intval($respuesta["identity"]);

			$columnaEstatus = "estatus";
			$valorEstatus = 1;

        $actualizarEstatus = ModeloResurtidos::mdlActualizarResurtido($columnaEstatus, $valorEstatus, $id_resurtido, $_SESSION['id']);

        $columnaIdCompra = "id_compra";

        $actualizarEstatus = ModeloResurtidos::mdlActualizarResurtido($columnaIdCompra, $id_compra, $id_resurtido, $_SESSION['id']);

        $respuesta_agregar_productos = ControladorResurtidos::ctrAgregarProductosCompraResurtido($id_resurtido, $id_compra);


				if($respuesta_agregar_productos == "ok"){

					echo "<script>

				Swal.fire({
					icon: 'success',
					title: 'El resurtido no.".$id_resurtido." se ha convertido en la compra no.".$id_compra."',
					showConfirmButton: true
					}).then(function(result){
						window.location = 'index.php?ruta=editar-compra&id_compra=".$id_compra."';
						
					});</script>";

				}else{

					echo "<script>

				Swal.fire({
					icon: 'warning',
					title: 'El resurtido no.".$id_resurtido." se ha convertido en la compra no.".$id_compra."',
					text: 'Pero al parecer los productos no se han agregado a la compra, comunícate con sistemas para dar solución',
					showConfirmButton: true
					}).then(function(result){
						window.location = 'lista-resurtidos';
						});</script>";

				}

			
			}else{


				echo "<script>

				Swal.fire({
					icon: 'error',
					title: 'El resurtido no seha podido convertir en compra',
					text: 'Comunícate con sistemas para dar solución',
					showConfirmButton: true
					}).then(function(result){
						window.location = 'lista-resurtidos';
						});</script>";
			    
			}

			

	}

}










	static public function ctrAgregarProductosCompraResurtido($id_resurtido, $id_compra){

		$respuesta = ModeloResurtidos::mdlAgregarProductosCompraResurtido($id_resurtido, $id_compra);

		return $respuesta;

	}











}



