<?php
session_start();
require_once "../controladores/cajas.controlador.php";
require_once "../modelos/cajas.modelo.php";

class AjaxCajas{


  /*=============================================
  CREAR CORTE CAJA
  =============================================*/ 

  public $id_usuario2;

  public $apertura;

  public function ajaxCrearCorteCaja(){

    $valor2 = $this->apertura;

    $respuesta = ControladorCajas::ctrCrearCorteCaja($valor2);

    $_SESSION['id_corte_caja'] = $respuesta;

    echo $respuesta;

  }






  /*=============================================
  CONSULTA SI EL USUARIO TIENE ACTUALMENTE UN CORTE DE CAJA ABIERTO
  =============================================*/ 

  public $id_usuario;

  public function ajaxConsultaCorteCaja(){

    $valor = $this->id_usuario;

    $respuesta = ControladorCajas::ctrRevisarCorteCajaActivo($valor);

    echo $respuesta;

  }





    /*=============================================
  CONSULTA CORTE CAJA
  =============================================*/ 

  public $id_corte_caja;

  public function ajaxConsultaCorteCaja2(){

    $valor = $this->id_corte_caja;

    $respuesta = ControladorCajas::ctrMostrarCorteCaja($valor);

    echo json_encode($respuesta);

  }



    
    
        /*=============================================
  CONSULTA TOTALES CORTE CAJA
  =============================================*/ 

  public $id_corte_caja_totales;

  public function ajaxTotalesCorteCaja(){

    $valor = $this->id_corte_caja_totales;

    $respuesta = ControladorCajas::ctrMostrarTotalesCorteCaja($valor);

    echo json_encode($respuesta);

  }
    
    
    
    /*=============================================
  CONSULTA TOTAL RETIROS CORTE CAJA
  =============================================*/ 

  public $id_corte_caja_total_retiros;

  public function ajaxTotalRetirosCorteCaja(){

    $valor = $this->id_corte_caja_total_retiros;

    $respuesta = ControladorCajas::ctrMostrarTotalRetirosCorteCaja($valor);

    echo json_encode($respuesta);

  }





     /*=============================================
  CONSULTA TOTAL RETIROS BAUL CORTE CAJA
  =============================================*/ 

  public $id_corte_caja_total_retiros_baul;

  public function ajaxTotalRetirosBaulCorteCaja(){

    $valor = $this->id_corte_caja_total_retiros_baul;

    $respuesta = ControladorCajas::ctrMostrarTotalRetirosBaulCorteCaja($valor);

    echo json_encode($respuesta);

  }






      /*=============================================
  CONSULTA TOTAL RETIROS CORTE CAJA
  =============================================*/ 

  public $id_corte_caja_total_tarjeta_debito_retiros;

  public function ajaxTotalTarjetaDebitoRetirosCorteCaja(){

    $valor = $this->id_corte_caja_total_tarjeta_debito_retiros;

    $respuesta = ControladorCajas::ctrMostrarTotalTarjetaDebitoRetirosCorteCaja($valor);

    echo json_encode($respuesta);

  }





  /*=============================================
  CONSULTA TOTAL DEVOLUCIONES CORTE CAJA
  =============================================*/ 

  public $id_corte_caja_total_devoluciones;

  public function ajaxTotalDevolucionesCorteCaja(){

    $valor = $this->id_corte_caja_total_devoluciones;

    $respuesta = ControladorCajas::ctrMostrarTotalDevolucionesCorteCaja($valor);

    echo json_encode($respuesta);

  }





  /*=============================================
  CONSULTA TOTAL GARANTIAS CORTE CAJA
  =============================================*/ 

  public $id_corte_caja_total_garantias;

  public function ajaxTotalGarantiasCorteCaja(){

    $valor = $this->id_corte_caja_total_garantias;

    $respuesta = ControladorCajas::ctrMostrarTotalGarantiasCorteCaja($valor);

    echo json_encode($respuesta);

  }





  /*=============================================
  CONFIRMAR CORTE CAJA
  =============================================*/ 

  public $id_corte_caja2;

  public function ajaxConfirmarCorteCaja(){

    $valor = $this->id_corte_caja2;

    $respuesta = ControladorCajas::ctrConfirmarCorteCaja($valor);

    if($respuesta == "ok"){
      
      unset($_SESSION['id_corte_caja']);

      echo $respuesta;
    }else{
      echo $respuesta;
    }

    

  }










    /*=============================================
  CONFIRMAR CORTE CAJA
  =============================================*/ 

  public $id_retiro;
  public $columna1;
  public $valor1;

  public function ajaxEliminarRetiroCorteCaja(){

    $columna = $this->columna1;
    $valor = $this->valor1;
    $id_retiro = $this->id_retiro;

    $respuesta = ControladorCajas::ctrActualizarRetiroCorteCaja($columna, $valor, $id_retiro, $_SESSION['id']);

    if($respuesta == "ok"){
      

      echo 1;
    }else{
      echo 0;
    }

    

  }










  public $id_retiro_baul;
public function ajaxEliminarRetiroBaulCorteCaja(){

    $columna = $this->columna1;
    $valor = $this->valor1;
    $id_retiro_baul = $this->id_retiro_baul;

    $respuesta = ControladorCajas::ctrActualizarRetiroBaulCorteCaja($columna, $valor, $id_retiro_baul, $_SESSION['id']);

    if($respuesta == "ok"){
      

      echo 1;
    }else{
      echo 0;
    }

    

  }



}


/*=============================================
EDITAR PRODUCTO
=============================================*/ 
if(isset($_POST["id_usuario2"])){

  $crearCorteCaja = new AjaxCajas();
  $crearCorteCaja -> id_usuario2 = $_POST["id_usuario2"];
  $crearCorteCaja -> apertura = $_POST["apertura"];
  $crearCorteCaja -> ajaxCrearCorteCaja();
}




/*=============================================
CONSULTA SI YA HAY UN CORTE DE CAJA ABIERTP
=============================================*/ 
if(isset($_POST["id_usuario"])){

  $consultaCorteCaja = new AjaxCajas();
  $consultaCorteCaja -> id_usuario = $_POST["id_usuario"];
  $consultaCorteCaja -> ajaxConsultaCorteCaja();
}


/*=============================================
CONSULTA CORTE CAJA
=============================================*/ 
if(isset($_POST["id_corte_caja"])){

  $consultaCorteCaja2 = new AjaxCajas();
  $consultaCorteCaja2 -> id_corte_caja = $_POST["id_corte_caja"];
  $consultaCorteCaja2 -> ajaxConsultaCorteCaja2();
}




/*=============================================
CONFIRMAR CORTE CAJA
=============================================*/ 
if(isset($_POST["id_corte_caja2"])){

  $confirmarCorteCaja2 = new AjaxCajas();
  $confirmarCorteCaja2 -> id_corte_caja2 = $_POST["id_corte_caja2"];
  $confirmarCorteCaja2 -> ajaxConfirmarCorteCaja();
}

/*=============================================
TOTALES DE VENTA DEL CORTE CAJA
=============================================*/ 
if(isset($_POST["id_corte_caja_totales"])){

  $totalesCorte = new AjaxCajas();
  $totalesCorte -> id_corte_caja_totales = $_POST["id_corte_caja_totales"];
  $totalesCorte -> ajaxTotalesCorteCaja();
}



/*=============================================
RETIROS DEL CORTE CAJA
=============================================*/ 
if(isset($_POST["id_corte_caja_total_retiros"])){

  $totalRetirosCorte = new AjaxCajas();
  $totalRetirosCorte -> id_corte_caja_total_retiros = $_POST["id_corte_caja_total_retiros"];
  $totalRetirosCorte -> ajaxTotalRetirosCorteCaja();
}





/*=============================================
RETIROS BAUL DEL CORTE CAJA
=============================================*/ 
if(isset($_POST["id_corte_caja_total_retiros_baul"])){

  $totalRetirosBaulCorte = new AjaxCajas();
  $totalRetirosBaulCorte -> id_corte_caja_total_retiros_baul = $_POST["id_corte_caja_total_retiros_baul"];
  $totalRetirosBaulCorte -> ajaxTotalRetirosBaulCorteCaja();
}




/*=============================================
RETIROS DEL CORTE CAJA
=============================================*/ 
if(isset($_POST["id_corte_caja_total_tarjeta_debito_retiros"])){

  $totalTarjetaDebitoRetirosCorte = new AjaxCajas();
  $totalTarjetaDebitoRetirosCorte -> id_corte_caja_total_tarjeta_debito_retiros = $_POST["id_corte_caja_total_tarjeta_debito_retiros"];
  $totalTarjetaDebitoRetirosCorte -> ajaxTotalTarjetaDebitoRetirosCorteCaja();
}





/*=============================================
DEVOLUCIONES DEL CORTE CAJA
=============================================*/ 
if(isset($_POST["id_corte_caja_total_devoluciones"])){

  $total_devoluciones_corte = new AjaxCajas();
  $total_devoluciones_corte -> id_corte_caja_total_devoluciones = $_POST["id_corte_caja_total_devoluciones"];
  $total_devoluciones_corte -> ajaxTotalDevolucionesCorteCaja();
}






/*=============================================
DEVOLUCIONES DEL CORTE CAJA
=============================================*/ 
if(isset($_POST["id_corte_caja_total_garantias"])){

  $total_garantias_corte = new AjaxCajas();
  $total_garantias_corte -> id_corte_caja_total_garantias = $_POST["id_corte_caja_total_garantias"];
  $total_garantias_corte -> ajaxTotalGarantiasCorteCaja();
}














/*=============================================
ELIMINAR RETIRO
=============================================*/ 
if(isset($_POST["eliminarRetiro"])){

  $eliminarRetiro = new AjaxCajas();
  $eliminarRetiro -> id_retiro = $_POST["eliminarRetiro"];
  $eliminarRetiro -> columna1 = $_POST["columna"];
  $eliminarRetiro -> valor1 = $_POST["valor"];
  $eliminarRetiro -> ajaxEliminarRetiroCorteCaja();
}




/*=============================================
ELIMINAR RETIRO
=============================================*/ 
if(isset($_POST["eliminarRetiroBaul"])){

  $eliminarRetiroBaul = new AjaxCajas();
  $eliminarRetiroBaul -> id_retiro_baul = $_POST["eliminarRetiroBaul"];
  $eliminarRetiroBaul -> columna1 = $_POST["columna"];
  $eliminarRetiroBaul -> valor1 = $_POST["valor"];
  $eliminarRetiroBaul -> ajaxEliminarRetiroBaulCorteCaja();
}