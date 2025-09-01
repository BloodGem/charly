<?php

class ControladorAnaquelesInventarios{

  static public function ctrIngresarPartidaAnaquelInventario($datos){
    $respuesta = ModeloAnaquelesInventarios::mdlIngresarPartidaAnaquelInventario($datos);
    return $respuesta;
  }





  static public function ctrMostrarAnaquelesInventario($id_inventario){
    $respuesta = ModeloAnaquelesInventarios::mdlMostrarAnaquelesInventario($id_inventario);
    return $respuesta;
  }





  static public function ctrMostrarAnaquelInventario($id_anaquel_inventario){
    $respuesta = ModeloAnaquelesInventarios::mdlMostrarAnaquelInventario($id_anaquel_inventario);
    return $respuesta;
  }





  static public function ctrAsignarAnaquelInventario($id_anaquel_inventario){

        $id_usuario = $_SESSION['id'];

        $traerAnaquelInventario = ControladorAnaquelesInventarios::ctrMostrarAnaquelInventario($id_anaquel_inventario);

        $id_inventario = $traerAnaquelInventario['id_inventario'];
        
        $traerAnaquelesInventarioVendedor = ModeloAnaquelesInventarios::mdlMostrarAnaquelesInventarioVendedor($id_inventario, $id_usuario);

        foreach ($traerAnaquelesInventarioVendedor as $key => $row) {
        
            if($row['estatus'] == 1){

                return 3;
            }

        }


        $estatus = $traerAnaquelInventario['estatus'];

        if($estatus >= 1){
            return 0;
        }else{
        
            $respuesta = ModeloAnaquelesInventarios::mdlAsignarAnaquelInventario($id_anaquel_inventario, $id_usuario);
        
            return $respuesta;
        }

        
        
    }















    static public function ctrCerrarAnaquelInventario($id_anaquel_inventario){

        $traerAnaquelInventario = ControladorAnaquelesInventarios::ctrMostrarAnaquelInventario($id_anaquel_inventario);

        $traerProductosAnaquel = ControladorPartidasInventarios::ctrMostrarProductosAnaquelInventario($traerAnaquelInventario['id_inventario'], $traerAnaquelInventario['anaquel']);

        foreach ($traerProductosAnaquel as $key => $row) {

                  $existencias = $row['existencias_encontradas'];

                    if ($existencias == "" || $existencias == null) {

                        return 3;
                        
                    }
                  //var_dump($respuesta_partida_anaqueles);
                                      
                }



        $estatus = $traerAnaquelInventario['estatus'];

        if($estatus >= 2){
            return 2;
        }else{
            $id_usuario = $_SESSION['id'];
        
            $respuesta = ModeloAnaquelesInventarios::mdlCerrarAnaquelInventario($id_anaquel_inventario);

            if($respuesta == 1){

                foreach ($traerProductosAnaquel as $key2 => $row2) {

                  $id_partida_inventario=$row2['id_partida_inventario'];
                  $columnaEstatus = "estatus";
                  $valor = 1;
                    ControladorPartidasInventarios::ctrActualizarPartidaInventario($columnaEstatus, $valor, $id_partida_inventario);
                  //var_dump($respuesta_partida_anaqueles);
                                      
                }

                return $respuesta;
            }else{
                return $respuesta;
            }
        
            
        }

        
        
    }

}

?>