<?php

class ControladorInventarios{

  static public function ctrVerificarInventarioAbierto(){
    $respuesta = ModeloInventarios::mdlVerificarInventarioAbierto();
    return $respuesta;
  }





  static public function ctrMostrarInventarios(){
    $respuesta = ModeloInventarios::mdlMostrarInventarios();
    return $respuesta;
  }










  static public function ctrMostrarInventario($id_inventario){
    $respuesta = ModeloInventarios::mdlMostrarInventario($id_inventario);
    return $respuesta;
  }










  static public function ctrMostrarMovimientosInventario($id_inventario){
    $respuesta = ModeloInventarios::mdlMostrarMovimientosInventario($id_inventario);
    return $respuesta;
  }












  static public function ctrCrearVistaMovimientosInventario($id_inventario){

    $traerInventario = ControladorInventarios::ctrMostrarInventario($id_inventario);

    $id_sucursal = $traerInventario['id_inventario'];

    $sqlDrop = "DROP VIEW serverside_movimientos_inventario";


    $sqlView = "CREATE VIEW serverside_movimientos_inventario AS SELECT kardex_productos.id_producto, kardex_productos.mo_tipo, kardex_productos.mo_entsal, kardex_productos.mo_cant, kardex_productos.mo_existencias, productos.clave_producto, productos.descripcion_corta, existencias_sucursales.ubicacion FROM kardex_productos INNER JOIN productos ON kardex_productos.id_producto = productos.id_producto INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto WHERE kardex_productos.mo_refer = ".$id_inventario." AND kardex_productos.mo_tipo = 'INVENTARIO' AND existencias_sucursales.id_sucursal = ".$id_sucursal." ORDER BY productos.descripcion_corta ASC";

    $respuesta = ModeloGlobal::mdlEliminarCrearVista($sqlDrop, $sqlView);

    return $respuesta;

  }










	/*=============================================
	CREAR GRUPO
	=============================================*/

	static public function ctrCrearInventario(){

		if(isset($_POST["id_sucursal"])){

      $id_sucursal = $_POST["id_sucursal"];

      $responsables = json_encode($_POST["nuevosResponsablesInventario"]);

      $participantes = json_encode($_POST["nuevosParticipantes"]);

      $id_usuario = $_SESSION['id'];

      $traerUsuario = ControladorUsuarios::ctrMostrarUsuario($id_usuario);

      $traerSucursal = ControladorSucursales::ctrMostrarSucursal($id_sucursal);

      $respuestaCrearInventario = ModeloInventarios::mdlCrearInventario($id_sucursal, $responsables, $participantes, $id_usuario);

        /*var_dump($_POST["nuevosResponsablesInventario"]);

        return;*/

        $id_inventario = $respuestaCrearInventario[0];

        //var_dump($id_ajuste_inventario);

        if($id_inventario != "error"){

         $traerAnaquelesSucursal = ControladorExistenciasSucursales::ctrMostrarAnaquelesSucursal($id_sucursal);

          //var_dump($traerAnaquelesSucursal);

         foreach ($traerAnaquelesSucursal as $keyAS => $rowAS) {

          $anaquel = $rowAS['anaquel'];

          $datosAnaquelInventario = array("id_inventario" => $id_inventario,
            "anaquel" => $anaquel);

                  //var_dump($datosAnaquelInventario);

          //if ($anaquel !== "" && $anaquel !== null) {
           $respuesta_partida_anaqueles = ControladorAnaquelesInventarios::ctrIngresarPartidaAnaquelInventario($datosAnaquelInventario);

                    //var_dump($respuesta_partida_anaqueles);
         //}//Si el anaquel est en nulo o vacio no pelarlo






       }




       $traerProductosSucursal = ControladorExistenciasSucursales::ctrMostrarProductosSucursal($id_sucursal); 
       foreach ($traerProductosSucursal as $keyPS => $rowPS) {
        $id_producto = $rowPS['id_producto'];
        $existencias_actuales = $rowPS['stock'];
        $ubicacion_actual = $rowPS['ubicacion'];

        $anaquel_producto = substr($ubicacion_actual, 0, 3);


        $datosPartidaInventario = array("id_inventario" => $id_inventario,
          "id_producto" => $id_producto,
          "existencias_actuales" => $existencias_actuales,
          "anaquel_actual" => $anaquel_producto,
          "ubicacion_actual" => $ubicacion_actual);

                  //var_dump($datosPartidaInventario);

        $respuesta_partida = ControladorPartidasInventarios::ctrIngresarPartidaInventario($datosPartidaInventario);

                  //var_dump($respuesta_partida);

      }


                //var_dump($_POST['nuevosParticipantes']);

                //$listaParticipantes = json_decode($_POST['nuevosParticipantes'], true);
      $lista_participantes = "";
      $no_participante = 0;
      foreach ($_POST['nuevosParticipantes'] as $key2 => $value2) {

        $traerParticipante = ControladorUsuarios::ctrMostrarUsuario($value2);

        $no_participante = $no_participante + 1;

        $lista_participantes = $lista_participantes."
        ".$no_participante.". *".$traerParticipante['nombre']."*";




      }



//'to' => '120363195179272942@g.us',

      $params=array(
        'token' => 'w24etnjuebv6s4pm',
        'to' => '+525611118850',
        'image' => 'http://zafra.dyndns.ws:6060/imagenes/creacion-inventario.jpg',
        'caption' => 'Se ha iniciado un inventario para la sucursal *'.$traerSucursal['nombre_sucursal'].'* con los siguientes participantes:'.
        $lista_participantes
      );
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.ultramsg.com/instance57637/messages/image",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($params),
        CURLOPT_HTTPHEADER => array(
          "content-type: application/x-www-form-urlencoded"
        ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);


      echo "<script>


      Swal.fire({
        icon: 'success',
        title: 'El inventario se ha creado con éxito',
        showConfirmButton: true
        }).then(function(result){

         window.location = 'lista-inventarios';

         });


         </script>";


       }




     }

   }










   static public function ctrConfirmarInventario(){
    if(isset($_POST["confirmarInventario"])){

     $id_inventario = $_POST["confirmarInventario"];
     $id_usuario = $_SESSION['id'];

     $traerInventario = ControladorInventarios::ctrMostrarInventario($id_inventario); 

     $id_sucursal = $traerInventario['id_sucursal'];

     $traerAnaquelesInventario = ModeloAnaquelesInventarios::mdlMostrarAnaquelesInventario($id_inventario);

     foreach ($traerAnaquelesInventario as $keyAI => $rowAI) {

      if($rowAI['estatus'] == 0){

        echo "<script>


        Swal.fire({
          icon: 'warning',
          title: 'Aún hay anaqueles sin asignación',
          showConfirmButton: true
          }).then(function(result){

            window.location = 'lista-inventarios';

            });


            </script>";

            return;


          }else if($rowAI['estatus'] == 1){

            echo "<script>


            Swal.fire({
              icon: 'warning',
              title: 'Aún hay anaqueles abiertos',
              showConfirmButton: true
              }).then(function(result){

                window.location = 'lista-inventarios';

                });


                </script>";

                return;

              }

            }



            $respuestaConfirmarInventario = ModeloInventarios::mdlConfirmarInventario($id_inventario, $id_usuario); 

            var_dump($respuestaConfirmarInventario);

            if($respuestaConfirmarInventario == 1){


              $traerPartidasInventario = ControladorPartidasInventarios::ctrMostrarPartidasInventario($id_inventario); 


              foreach ($traerPartidasInventario as $keyPI => $rowPI) {

                $id_partida_inventario = $rowPI['id_partida_inventario'];
                $id_producto = $rowPI['id_producto'];

                $existencias_actuales = $rowPI['existencias_actuales'];
                $existencias_encontradas = $rowPI['existencias_encontradas'];



                $pasa = 0;

                if($existencias_actuales == $existencias_encontradas){

                 $pasa = 0;

               }elseif($existencias_actuales > $existencias_encontradas){
                 $cantidad = $existencias_actuales - $existencias_encontradas;
                 $nuevas_existencias = $existencias_actuales - $cantidad;
                 $mo_entsal = "SALIDA";
                 $pasa = 1;
               }elseif ($existencias_actuales < $existencias_encontradas) {



                if($existencias_actuales < 0 && $existencias_encontradas == 0){
                  $cantidad = 0;
                  $nuevas_existencias = $cantidad;
                  $mo_entsal = "NA";
                }elseif($existencias_actuales < 0 && $existencias_encontradas > 0){
                  $cantidad = $existencias_encontradas;
                  $nuevas_existencias = $cantidad;
                  $mo_entsal = "ENTRADA";
                }else{
                  $cantidad = $existencias_encontradas - $existencias_actuales;
                  $nuevas_existencias = $existencias_actuales + $cantidad;
                  $mo_entsal = "ENTRADA";
                }



                $pasa = 1;
              }


              if($pasa == 1){

                $columnaStock = "stock";

                  //var_dump($datos);

                $respuesta_nuevas_existencias = ControladorExistenciasSucursales::ctrActualizarProductoES2($columnaStock, $nuevas_existencias, $id_producto, $id_sucursal, $id_usuario);





                  //var_dump($respuesta_nuevas_existencias);

                if($respuesta_nuevas_existencias == 1){
                  $traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);
                  $datosKardex = array("mo_tipo"=>"INVENTARIO",
                    "mo_refer"=>$id_inventario,
                    "mo_entsal"=>$mo_entsal,
                    "id_producto"=>$id_producto,
                    "mo_cant"=>$cantidad,
                    "mo_pu"=>$traerProducto['precio_compra'],
                    "mo_existencias"=>$nuevas_existencias,
                    "id_sucursal"=>$id_sucursal);
                  $respuesta_partida_kardex = ModeloKardexProductos::mdlIngresarPartidaKarprod($datosKardex);

                  	//var_dump($respuesta_partida_kardex);
                }
              }


              $columnaEstatus = "estatus";
              $valorEstatus = 2;
              ControladorPartidasInventarios::ctrActualizarPartidaInventario($columnaEstatus, $valorEstatus, $id_partida_inventario);




            }//TERMINA EL FOREACH DE LAS PARTIDAS DEL INVENTARIO

            $traerInventario2 = ControladorInventarios::ctrMostrarInventario($id_inventario); 

            $params=array(
              'token' => 'w24etnjuebv6s4pm',
              'to' => '+525611118850',
              'image' => 'http://zafra.dyndns.ws:6060/imagenes/creacion-inventario.jpg',
              'caption' => 'Se ha *finalizado* el inventario no *'.$id_inventario.'* con fecha y hora: '.$traerInventario2['fecha_confirmacion']
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.ultramsg.com/instance57637/messages/image",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_SSL_VERIFYHOST => 0,
              CURLOPT_SSL_VERIFYPEER => 0,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => http_build_query($params),
              CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);



            echo "<script>


            Swal.fire({
              icon: 'success',
              title: 'El inventario se ha confirmado con éxito',
              showConfirmButton: true
              }).then(function(result){

                window.open('extensiones/tcpdf/examples/pdf-hoja-inventario.php?id_inventario=".$id_inventario."','_blank');


                window.location = 'lista-inventarios';

                });


                </script>";

              }else{
               echo "<script>


            Swal.fire({
              icon: 'error',
              title: 'ERROR',
              showConfirmButton: true
              });


                </script>";
             }





           }
         }










         static public function ctrVerificarInventario($id_inventario){
          if($id_inventario != null){

            $respuestaVerificarInventario = ModeloInventarios::mdlVerificarInventario($id_inventario);

            return $respuestaVerificarInventario['contador'];

          }
        }










        static public function ctrSubirArchivoInventario(){
         if(isset($_FILES["nuevoArchivoPagoInventario"])){


          if($_FILES["nuevoArchivoPagoInventario"] == null){

            echo "<script>


            Swal.fire({
              icon: 'warning',
              title: 'No has elegido un archivo',
              showConfirmButton: false,
              timer: 2500
              });


              </script>";
              return;
            }

            $id_inventario = $_POST['mostrarIdInventario'];

            $traerInventario = ControladorInventarios::ctrMostrarInventario($id_inventario);

            if($traerInventario['ruta_archivo'] !== ""){
              echo "<script>


              Swal.fire({
                icon: 'error',
                title: 'no puedes ingresar otro archivo al inventario no.".$id_inventario."',
                showConfirmButton: false,
                timer: 2500
                });


                </script>";
                return;
              }

              $archivo = $_FILES["nuevoArchivoPagoInventario"]["name"];

              $extension = pathinfo($archivo, PATHINFO_EXTENSION);

              var_dump($archivo);

              if ($archivo !== '' && $archivo !== null) {

                $tempname1 = $_FILES["nuevoArchivoPagoInventario"]["tmp_name"];    
                $folder1 = "recursos/archivos_pagos_inventarios/".$archivo;
                
                $ruta_archivo = "recursos/archivos_pagos_inventarios/".$archivo;

              }

              if(move_uploaded_file($tempname1, $folder1)){

              $respuestaSubirArchivoInventario = ModeloInventarios::mdlSubirArchivoPagoInventario($id_inventario, $ruta_archivo);

              if($respuestaSubirArchivoInventario == 1){
                echo "<script>


                Swal.fire({
                  icon: 'success',
                  title: 'Se ha subido el archivo con éxito',
                  showConfirmButton: true
                  }).then(function(result){

                    window.location = 'lista-inventarios';

                    });


                    </script>";

                  }else{
                    echo "<script>


                Swal.fire({
                  icon: 'error',
                  title: 'No se ha podido guardar la ruta del archivo',
                  showConfirmButton: true
                  });


                    </script>";
                  }


                }else{
                  echo "<script>


                Swal.fire({
                  icon: 'error',
                  title: 'No se ha podido guardar el archivo',
                  showConfirmButton: true
                  });


                    </script>";
                  }

                }
              }


            }

            ?>
