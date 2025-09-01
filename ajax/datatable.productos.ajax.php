<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";



class TablaProductos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductos(){

		$columna = null;
		$valor = null;

		$productos = ControladorProductos::ctrMostrarProductos($columna, $valor);

		

		$datosJson = '{
  "data": [';

  for($i = 0; $i < count($productos); $i++){



  	$imagenes = "<a href='".$productos[$i]["imagen1"]."' data-toggle='lightbox' data-title='Imagen 1' data-gallery='gallery'><img src='".$productos[$i]["imagen1"]."' class='img-fluid mb-2' alt='black sample' width='40px'/></a><a href='".$productos[$i]["imagen2"]."' data-toggle='lightbox' data-title='Imagen 2' data-gallery='gallery'></a><a href='".$productos[$i]["imagen3"]."' data-toggle='lightbox' data-title='Imagen 3' data-gallery='gallery'></a><a href='vistas/img/productos/atras.png' data-toggle='lightbox' data-title='Regresa se acabaron las imagenes' data-gallery='gallery'></a>";

		$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' id_producto='".$productos[$i]["id_producto"]."' accesskey='2' data-toggle='modal' data-target='#modalEditarProducto'>Editar</button><button class='btn btn-danger btnEliminarProducto' id_producto='".$productos[$i]["id_producto"]."' accesskey='0'><i class='fa fa-times'></i></button></div>";



	
			/*=============================================
 	 		STOCK2
  			=============================================*/ 

  			if($productos[$i]["stock"] <= $productos[$i]["nivel_minimo"]){

  				$existencia = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";

  			}else if($productos[$i]["stock"] > $productos[$i]["nivel_minimo"] && $productos[$i]["stock"] <= $productos[$i]["nivel_medio"]){

  				$existencia = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";

  			}else{

  				$existencia = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";

  			}




  	$datosJson .='[
      "'.($i +1).'",
      "'.$imagenes.'",
      "'.$productos[$i]["clave_producto"].'",
      "'.$productos[$i]["descripcion_corta"].'",
      "'.$existencia.'",
      "'.$productos[$i]["ubicacion"].'",
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
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();

