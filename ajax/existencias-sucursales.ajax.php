<?php
session_start();
require_once "../controladores/existencias-sucursales.controlador.php";
require_once "../modelos/existencias-sucursales.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxExistenciasSucursales{

  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $id_producto;

  public $id_sucursal;

  public function ajaxEditarProducto(){

    $valor = $this->id_producto;

    $respuesta = ControladorExistenciasSucursales::ctrMostrarProductoES($valor);

    echo json_encode($respuesta);

  }




  public function ajaxMostrarProductoES2(){

    $valor1 = $this->id_producto;

    $valor2 = $this->id_sucursal;

    $respuesta = ControladorExistenciasSucursales::ctrMostrarProductoES2($valor1, $valor2);

    echo json_encode($respuesta);

  }
  
  
  public function ajaxTraerProductoESVenta(){

    $valor = $this->id_producto;

    $respuesta = ControladorExistenciasSucursales::ctrMostrarProductoESVenta($valor);

    echo json_encode($respuesta);

  }


  public $valor;
  public $columna;

  public function ajaxActualizarProductoES(){

    $valor1 = $this->columna;

    $valor2 = $this->valor;

    $valor3 = $this->id_producto;

    $respuesta = ControladorExistenciasSucursales::ctrActualizarProductoES($valor1, $valor2, $valor3);

    echo $respuesta;

  }






   public function ajaxActualizarProductoES2(){

    $valor1 = $this->columna;

    $valor2 = $this->valor;

    $valor3 = $this->id_producto;

    $valor4 = $this->id_sucursal;

    $respuesta = ControladorExistenciasSucursales::ctrActualizarProductoES2($valor1, $valor2, $valor3, $valor4, $_SESSION['id']);

    echo $respuesta;

  }


  public $ubicacion;
  public $nivel_minimo;
  public $nivel_maximo;
  public $precio1;
  public $utilidad1;
  public $precio2;
  public $utilidad2;
  public $precio3;
  public $utilidad3;


  public function ajaxEditarExistenciasProductoModulo(){

    $id_producto = $this->id_producto;

    $ubicacion = $this->ubicacion;

    $nivel_minimo = $this->nivel_minimo;
    $nivel_medio = $this->nivel_medio;
    $nivel_maximo = $this->nivel_maximo;

    $precio1 = $this->precio1;
    $utilidad1 = $this->utilidad1;

    $precio2 = $this->precio2;
    $utilidad2 = $this->utilidad2;

    $precio3 = $this->precio3;
    $utilidad3 = $this->utilidad3;

    $traerUsuario = ControladorUsuarios::ctrMostrarUsuario($_SESSION['id']);

    $id_sucursal = $traerUsuario['id_sucursal'];

    $datos = array("id_producto" => $id_producto,
                    "id_sucursal" => $id_sucursal,
                    "ubicacion" => $ubicacion,
              "precio1" => $precio1,
            "utilidad1" => $utilidad1,
            "precio2" => $precio2,
            "utilidad2" => $utilidad2,
            "precio3" => $precio3,
            "utilidad3" => $utilidad3,
            "nivel_minimo" => $nivel_minimo,
            "nivel_medio" => $nivel_medio,
            "nivel_maximo" => $nivel_maximo,
            "id_usuario_ult_mod" => $_SESSION['id']);

    $respuesta = ControladorExistenciasSucursales::ctrEditarExistenciasProductoModulo($datos);

    echo $respuesta;

  }










  public $productos;
    
  public function ajaxVerificarExistenciasPorductosVenta(){

    $valor = $this->productos;
    
    $respuesta = ControladorExistenciasSucursales::ctrVerificarExistenciasPorductosVenta($valor);
    
    echo json_encode($respuesta);



  }










  public function ajaxVerificarExistenciasProductosCotizacion(){

    $valor = $this->productos;
    
    $respuesta = ControladorExistenciasSucursales::ctrVerificarExistenciasProductosCotizacion($valor);
    
    echo json_encode($respuesta);



  }
}

/*=============================================
EDITAR PRODUCTO
=============================================*/ 
if(isset($_POST["id_producto"])){

  $producto = new AjaxExistenciasSucursales();
  $producto -> id_producto = $_POST["id_producto"];
  $producto -> ajaxEditarProducto();
}




/*=============================================
TRAER PRODUCTO PARA LA VENTA
=============================================*/ 
if(isset($_POST["traerProductoESVenta"])){

  $producto = new AjaxExistenciasSucursales();
  $producto -> id_producto = $_POST["traerProductoESVenta"];
  $producto -> ajaxTraerProductoESVenta();
}





if(isset($_POST["actualizarProductoES"])){

  $actualizar_producto = new AjaxExistenciasSucursales();
  $actualizar_producto -> id_producto = $_POST["actualizarProductoES"];
  $actualizar_producto -> columna = $_POST["columna"];
  $actualizar_producto -> valor = $_POST["valor"];
  $actualizar_producto -> ajaxActualizarProductoES();
}





if(isset($_POST["actualizarProductoES2"])){

  $actualizar_producto = new AjaxExistenciasSucursales();
  $actualizar_producto -> id_producto = $_POST["actualizarProductoES2"];
  $actualizar_producto -> columna = $_POST["columna"];
  $actualizar_producto -> valor = $_POST["valor"];
  $actualizar_producto -> id_sucursal = $_POST["id_sucursal"];
  $actualizar_producto -> ajaxActualizarProductoES2();
}








if(isset($_POST["editarExistenciasProductoModulo"])){

  $actualizar_producto = new AjaxExistenciasSucursales();
  $actualizar_producto -> id_producto = $_POST["editarExistenciasProductoModulo"];
  $actualizar_producto -> ubicacion = $_POST["ubicacion"];
  $actualizar_producto -> nivel_minimo = $_POST["nivel_minimo"];
  $actualizar_producto -> nivel_medio = $_POST["nivel_medio"];
  $actualizar_producto -> nivel_maximo = $_POST["nivel_maximo"];
  $actualizar_producto -> precio1 = $_POST["precio1"];
  $actualizar_producto -> utilidad1 = $_POST["utilidad1"];
  $actualizar_producto -> precio2 = $_POST["precio2"];
  $actualizar_producto -> utilidad2 = $_POST["utilidad2"];
  $actualizar_producto -> precio3 = $_POST["precio3"];
  $actualizar_producto -> utilidad3 = $_POST["utilidad3"];
  $actualizar_producto -> ajaxEditarExistenciasProductoModulo();
}





if(isset($_POST["mostrarProductoES2"])){

  $traer_producto_es2 = new AjaxExistenciasSucursales();
  $traer_producto_es2 -> id_producto = $_POST["mostrarProductoES2"];
  $traer_producto_es2 -> id_sucursal = $_POST["id_sucursal"];
  $traer_producto_es2 -> ajaxMostrarProductoES2();
}










if(isset($_POST["verificarExistenciasPorductosVenta"])){

  $verificar_existencias_productos = new AjaxExistenciasSucursales();
  $verificar_existencias_productos -> productos = $_POST["verificarExistenciasPorductosVenta"];
  $verificar_existencias_productos -> ajaxVerificarExistenciasPorductosVenta();
}






if(isset($_POST["verificarExistenciasProductosCotizacion"])){

  $verificar_existencias_productos = new AjaxExistenciasSucursales();
  $verificar_existencias_productos -> productos = $_POST["verificarExistenciasProductosCotizacion"];
  $verificar_existencias_productos -> ajaxVerificarExistenciasProductosCotizacion();
}