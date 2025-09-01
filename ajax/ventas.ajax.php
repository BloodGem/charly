<?php
//error_reporting(0);
session_start();

require_once "../extensiones/vendor/autoload.php";

require_once "../controladores/computadoras.controlador.php";
require_once "../modelos/computadoras.modelo.php";
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
require_once "../controladores/existencias-sucursales.controlador.php";
require_once "../modelos/existencias-sucursales.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/muestras.controlador.php";
require_once "../modelos/muestras.modelo.php";
require_once "../modelos/kardex-productos.modelo.php";


class AjaxVentas{


  

  /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_producto;

  public $no_rango;

  public $fecha1;

  public $fecha2;

  public function ajaxMostrarProducto(){

    $valor = $this->id_producto;

    $respuesta = ControladorExistenciasSucursales::ctrMostrarProductoES($valor);

    echo json_encode($respuesta);

  }





/*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_producto_muestra;

  public function ajaxSolicitarMuestraProducto(){

    $valor = $this->id_producto_muestra;

    $respuesta = ControladorMuestras::ctrIngrearMuestra($valor);

    echo $respuesta;

  }










    /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_venta;

  public function ajaxMostrarVentaCliente(){

    $valor1 = $this->id_venta;

    $respuesta = ControladorVentas::ctrMostrarVentaCliente($valor1);

    echo json_encode($respuesta);


  }





  /*=============================================
  MOSTRAR
  =============================================*/ 

  public $id_venta2;

  public function ajaxMostrarVenta(){

    $valor1 = $this->id_venta2;
    $respuesta = ControladorVentas::ctrMostrarVentaCliente($valor1);

    echo  json_encode($respuesta);



  }
  
  
  
  
  
  
  
  
  
  /*=============================================
  CANCELAR UNA VENTA
  =============================================*/ 
    public $id_venta_cancelacion;
    
  public function ajaxCancelarVenta(){

    $valor = $this->id_venta_cancelacion;
    
    $respuesta = ControladorVentas::ctrCancelarVenta($valor);
    
    echo $respuesta;



  }
  
  
  
  
  
  
  
  
  
 
    
  public function ajaxCancelarVentas(){
      
    $respuesta = ControladorVentas::ctrCancelarVentas();
    
    echo $respuesta;

  }










  public function ajaxMostrarSumaVentasRangoFechasFacturaGlobal(){

    $valor1 = $this->fecha1;
    $valor2 = $this->fecha2;
    
    $respuesta = ControladorVentas::ctrMostrarSumaVentasRangoFechasFacturaGlobal($valor1, $valor2);
    
    echo json_encode($respuesta);



  }



}

/*=============================================

=============================================*/ 
if(isset($_POST["id_producto"])){

  $producto = new AjaxVentas();
  $producto -> id_producto = $_POST["id_producto"];
  $producto -> ajaxMostrarProducto();
}



/*=============================================
SOLICITAR UN PRODUCTO
=============================================*/ 
if(isset($_POST["id_producto2"])){

  $producto = new AjaxVentas();
  $producto -> id_producto2 = $_POST["id_producto2"];
  $producto -> ajaxSolicitarProducto();
}




/*=============================================
SOLICITAR MUESTRA DE PRODUCTO
=============================================*/ 
if(isset($_POST["id_producto_muestra"])){

  $solicitarProducto = new AjaxVentas();
  $solicitarProducto -> id_producto_muestra = $_POST["id_producto_muestra"];
  $solicitarProducto -> ajaxSolicitarMuestraProducto();
}



/*=============================================

=============================================*/ 
if(isset($_POST["id_venta"])){

  $venta = new AjaxVentas();
  $venta -> id_venta = $_POST["id_venta"];
  $venta -> ajaxMostrarVentaCliente();
}






/*=============================================
CREAR ABONO
=============================================*/ 
if(isset($_POST["id_venta2"])){

  $venta2 = new AjaxVentas();
  $venta2 -> id_venta2 = $_POST["id_venta2"];
  $venta2 -> ajaxMostrarVenta();
}





/*=============================================
CANCELAR UNA VENTA
=============================================*/ 
if(isset($_POST["id_venta_cancelacion"])){

  $cancelar_venta = new AjaxVentas();
  $cancelar_venta -> id_venta_cancelacion = $_POST["id_venta_cancelacion"];
  $cancelar_venta -> ajaxCancelarVenta();
}





/*=============================================
CANCELAR TODAS LAS VENTAS
=============================================*/ 
if(isset($_POST["cancelar_ventas"])){

  $cancelar_ventas = new AjaxVentas();
  $cancelar_ventas -> ajaxCancelarVentas();
}










if(isset($_POST["mostrarSumaVentasRangoFechasFacturaGlobal"])){

  $mostrar_suma_ventas_rango_fechas = new AjaxVentas();
  $mostrar_suma_ventas_rango_fechas -> fecha1 = $_POST["mostrarSumaVentasRangoFechasFacturaGlobal"];
  $mostrar_suma_ventas_rango_fechas -> fecha2 = $_POST["fecha2"];
  $mostrar_suma_ventas_rango_fechas -> ajaxMostrarSumaVentasRangoFechasFacturaGlobal();
}