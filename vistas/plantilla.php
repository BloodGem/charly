<?php 

session_start();

if(isset($_SESSION['id'])){
$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($_SESSION['id']);
$traerSucursal = ControladorSucursales::ctrMostrarSucursal($traerUsuario['id_sucursal']);
$tipo_venta_permitido = $traerUsuario['tipo_venta_permitido'];
$id_grupo = $traerUsuario['id_grupo'];

$respuesta2 = ControladorGrupos::ctrMostrarGrupo($id_grupo);
$array = json_decode($respuesta2['permisos']);

}


$versionador_archivos = rand();



$cookie_name = "computadora";


if(!isset($_COOKIE["computadora"])) {
  
  setcookie($cookie_name, $versionador_archivos, time() + (86400 * 1825), "/"); // 86400 = 1 day
}


$traerComputadora = ControladorComputadoras::ctrMostrarComputadora2("codigo", $_COOKIE["computadora"]);

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="vistas/img/perfil_empresa/logo.jpg" type="image/x-icon"/>
  <title>REFACCIONARIA</title>

 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="vistas/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
      <!-- Select2 -->
    <link rel="stylesheet" href="vistas/plugins/select2/css/select2.min.css">
<!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="vistas/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.css">

    <link rel="stylesheet" href="vistas/plugins/sweetalert2/sweetalert2.css">
<script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="vistas/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- CSS DE LAS TABLAS -->
    <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="vistas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


    <!-- iCheck -->
    <link rel="stylesheet" href="vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="vistas/plugins/jqvmap/jqvmap.min.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="vistas/plugins/toastr/toastr.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="vistas/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="vistas/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="vistas/plugins/summernote/summernote-bs4.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="vistas/plugins/ekko-lightbox/ekko-lightbox.css">

    <link rel="stylesheet" href="vistas/plugins/jquery-ui/jquery-ui.min.css">

<!-- PARA SABER LOS ELEMTOS QUE YA ESTAN SELECCIONADOS EN UN SELECT -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="vistas/js/numeroALetras.js" type="text/javascript"></script> 
    <script src="vistas/js/impresora/ConectorJavaScript.js" type="text/javascript"></script>


    <script>
      function parpadeo(){
  
    $(".parpadeo").fadeTo(500, .1)
                    .fadeTo(500, 1);
}
 
          const licencia = 'MTQ4NmUzZjZfXzIwMjQtMTEtMjlfXzIwMjUtMTEtMjQjIyMxSmFDNWxVMXRaUFFCQ2N5TGRvUEJwclozRFhoZ3N3OHJGQVA2WWtXK25oSkZnYW4zWmNzM3lndFh6L3F6cTIrVEdXYWQ1TFdhNlYxSXdjTzVLQ3o3bVhwQnFlNEhIUHZPU2hoR2tYWmYvWEkrOEk2Q3Y2ZEptRzNjdlBNaTNxRzFOWEduMHF6YW9HRTM1MkZTbnd1OEJWWit1MWs0TCtzUlZZMHlDU0pVUURvMVkyTXJHZTlrcnI5aWF1VXhzNzBaWE9Ya2xZc01HYTI2MnI1V1ZhNllyT0wrakYwME04N1NuS0xMTUZBbFBBbDVteEtNTlVhSGVPQlAyYjNVeXZSMDk1L215bzNSYmkyZHZCMlFQalVJVGpnNzNCMTltZWJUVDBjcEFVTnViWDdKYnk3YnR3WlVRQ25DOUo2TEhKQkpEcEFZWlJ4OG9JblovS29KOFZxd01CM1ltVlJvMEVjdkJPZllkT0Nac0pvNnE1N2d3R2tiZjJNUGVBOE5tczEydlJzVFRERGtCdjV2cG1wV1Z1aVdoZ2JuMFNxSVhWNU13YXM1TFY4QnVsNFBlMm1aQWVSajRwc3ZZT1RjSnpaNzZLOC9WeXVmd0VSMXNPSkZBbjhDTmp6dzB0alJ5aExkMFR3MDVwNm05U2V6cjAycWlnUUkwdlcxTUdoMWJsU3lyVTFDVHZKZjhEMUVCeS9ia2Q2ZjAydm9qL3NBNC9Xc1UvU3NzS0gyUEpXdnN6M2NBczFrci9PM1NYZ2MzSkxyQ1YrdFBxOUJIdkRuUlIrajkzRGhwY3dGUVZCMUdpY2JlYks1QVM3dVVIRVhEaHhiamZybnMxdVh1VEN4enB3S3RaSUJ3OVVScFRORWNtN0RVbk1Qa1BRU1FpWmY4MmtmaU9yWDNLdWhmZz0=';

    </script>

    <!-- ICONOS-->
<script  type = "module"  src = " https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js " > </script> 
<script  nomodule  src = " https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js " > </script>
</head>



<?php

if (isset ($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok") {



echo '<body class="sidebar-mini layout-fixed sidebar-closed sidebar-collapse">
<div class="wrapper">';
/*=============================================
HEADER
=============================================*/


include "modulos/header.php";

/*=============================================
MENU DE NAVEGACIÓN
=============================================*/

include "modulos/menu.php";

/*=============================================
CONTENIDO
=============================================*/
echo '

<!-- jQuery -->
<script src="vistas/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- daterangepicker -->
<script src="vistas/plugins/moment/moment.min.js"></script>
<script src="vistas/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Select2 -->
<script src="vistas/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="vistas/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- AdminLTE App -->
<script src="vistas/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="vistas/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="vistas/plugins/toastr/toastr.min.js"></script>
<!-- SCRIPTS DE LAS TABLAS-->
<script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="vistas/plugins/jszip/jszip.min.js"></script>
<script src="vistas/plugins/pdfmake/pdfmake.min.js"></script>
<script src="vistas/plugins/pdfmake/vfs_fonts.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Ekko Lightbox -->
<script src="vistas/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

<!-- Bootstrap Switch -->
<script src="vistas/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="vistas/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="vistas/dist/js/pages/dashboard.js"></script>
<!-- Filterizr-->
<script src="vistas/plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- Filterizr-->
<script src="vistas/plugins/queryNumber/jquerynumber.min.js"></script>


<script src="vistas/plugins/jquery-ui/jquery-ui.min.js"></script>';

if(isset($_GET["ruta"])){

if($_GET["ruta"] == "inicio"
|| $_GET["ruta"] == "usuarios"
|| $_GET["ruta"] == "cerrar-sesion"){

include "modulos/".$_GET['ruta'].".php";

echo '<script src="vistas/js/usuarios.js?v='.$versionador_archivos.'"></script>';
echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}





elseif($_GET["ruta"] == "cerrar-sesion2") {
  include "modulos/".$_GET['ruta'].".php";
}




elseif($_GET["ruta"] == "grupos") {

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/grupos.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}






elseif($_GET["ruta"] == "lista-computadoras") {

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/lista-computadoras.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}






elseif($_GET["ruta"] == "vendedores") {

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/vendedores.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}




elseif($_GET["ruta"] == "reporte-ventas-devoluciones-vendedor"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-ventas-devoluciones-vendedor.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}





elseif($_GET["ruta"] == "motores"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/motores.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}




elseif($_GET["ruta"] == "autos"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/autos.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}



elseif($_GET["ruta"] == "perfil-sucursal"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/sucursales.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}




elseif($_GET["ruta"] == "familias"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/familias.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}




elseif($_GET["ruta"] == "subfamilias"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/subfamilias.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}




elseif($_GET["ruta"] == "marcas"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/marcas.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "submarcas"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/submarcas.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "lista-productos"){

  include "modulos/".$_GET['ruta'].".php";

echo '<script src="vistas/js/lista-productos.js?v='.$versionador_archivos.'"></script>';
echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "crear-producto"
|| $_GET["ruta"] == "duplicar-producto"){

  include "modulos/".$_GET['ruta'].".php";

echo '<script src="vistas/js/crear-producto.js?v='.$versionador_archivos.'"></script>';
echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "editar-producto"){

  include "modulos/".$_GET['ruta'].".php";

echo '<script src="vistas/js/editar-producto.js?v='.$versionador_archivos.'"></script>';
echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}









elseif($_GET["ruta"] == "kardex"){

  include "modulos/".$_GET['ruta'].".php";

echo '<script src="vistas/js/js-kardex.js?v='.$versionador_archivos.'"></script>';
echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}












elseif($_GET["ruta"] == "lista-terminales-bancarias"){

  include "modulos/".$_GET['ruta'].".php";

echo '<script src="vistas/js/lista-terminales-bancarias.js?v='.$versionador_archivos.'"></script>';
echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}









elseif($_GET["ruta"] == "lista-existencias-sucursales"){

  include "modulos/".$_GET['ruta'].".php";

echo '<script src="vistas/js/lista-existencias-sucursales.js?v='.$versionador_archivos.'"></script>';
echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "lista-clientes"){

  include "modulos/".$_GET['ruta'].".php";

echo '<script src="vistas/js/lista-clientes.js?v='.$versionador_archivos.'"></script>';
echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}




elseif($_GET["ruta"] == "crear-cliente"){

  include "modulos/".$_GET['ruta'].".php";

echo '<script src="vistas/js/crear-cliente.js?v='.$versionador_archivos.'"></script>';
echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}






elseif($_GET["ruta"] == "lista-proveedores"){

  include "modulos/".$_GET['ruta'].".php";

echo '<script src="vistas/js/lista-proveedores.js?v='.$versionador_archivos.'"></script>';
echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "crear-proveedor"){

  include "modulos/".$_GET['ruta'].".php";

echo '<script src="vistas/js/crear-proveedor.js?v='.$versionador_archivos.'"></script>';
echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "lista-productos-proveedores"){

  include "modulos/".$_GET['ruta'].".php";

echo '<script src="vistas/js/lista-productos-proveedores.js?v='.$versionador_archivos.'"></script>';
echo "<aside class='control-sidebar control-sidebar-dark'>
</aside><div>";

}




elseif($_GET["ruta"] == "empresas"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/empresas.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}




elseif($_GET["ruta"] == "tipos-gastos"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/tipos-gastos.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}




/*elseif($_GET["ruta"] == "gastos"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/gastos.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}*/




elseif($_GET["ruta"] == "cobro"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/cobro.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "lista-compras"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/lista-compras.js?v='.$versionador_archivos.'">';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}





elseif($_GET["ruta"] == "crear-compra"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/crear-compra.js?v='.$versionador_archivos.'">';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}





elseif($_GET["ruta"] == "editar-compra"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/crear-compra.js?v='.$versionador_archivos.'">';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}





elseif($_GET["ruta"] == "lista-devoluciones-compras"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/lista-devoluciones-compras.js?v='.$versionador_archivos.'">';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}





elseif($_GET["ruta"] == "crear-devolucion-compra"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/crear-devolucion-compra.js?v='.$versionador_archivos.'">';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}





elseif($_GET["ruta"] == "lista-csxp"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/csxp.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}










elseif($_GET["ruta"] == "lista-ajustes-inventario"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/lista-ajustes-inventario.js?v='.$versionador_archivos.'">';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}





elseif($_GET["ruta"] == "crear-ajuste-inventario"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/crear-ajuste-inventario.js?v='.$versionador_archivos.'">';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}





elseif($_GET["ruta"] == "editar-ajuste-inventario"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/crear-ajuste-inventario.js?v='.$versionador_archivos.'">';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}





elseif($_GET["ruta"] == "lista-inventarios"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/lista-inventarios.js?v='.$versionador_archivos.'">';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}















elseif($_GET["ruta"] == "lista-ventas"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/lista-ventas.js?v='.$versionador_archivos.'">';


  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
}











elseif($_GET["ruta"] == "lista-entrega-ventas"){

  include "modulos/".$_GET['ruta'].".php";

//echo '<script src="vistas/dist/js/crear-venta.js?v='.$versionador_archivos.'"></script>';

  echo '<script src="vistas/js/js-lista-entrega-ventas.js?v='.$versionador_archivos.'">';


  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";



}





elseif($_GET["ruta"] == "entrega-venta"){

  include "modulos/".$_GET['ruta'].".php";

//echo '<script src="vistas/dist/js/crear-venta.js?v='.$versionador_archivos.'"></script>';

  echo '<script src="vistas/js/js-entrega-venta.js?v='.$versionador_archivos.'">';


  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";



}










elseif($_GET["ruta"] == "lista-notas"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/lista-notas.js?v='.$versionador_archivos.'"></script> ';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";


}




elseif($_GET["ruta"] == "lista-ventas-espera"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/ventas-espera.js?v='.$versionador_archivos.'"></script>';


  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}






elseif($_GET["ruta"] == "crear-venta-filtros"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/ventas-filtros.js?v='.$versionador_archivos.'">';


  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";


//echo '<script src="vistas/dist/js/crear-venta.js?v='.$versionador_archivos.'"></script>';
}










elseif($_GET["ruta"] == "lista-cotizaciones"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/lista-cotizaciones.js?v='.$versionador_archivos.'">';


  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
}










elseif($_GET["ruta"] == "crear-cotizacion"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/crear-cotizacion.js?v='.$versionador_archivos.'">';


  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";


//echo '<script src="vistas/dist/js/crear-venta.js?v='.$versionador_archivos.'"></script>';
}










elseif($_GET["ruta"] == "lista-devoluciones"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/lista-devoluciones.js?v='.$versionador_archivos.'"></script>';

  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}





elseif($_GET["ruta"] == "crear-devolucion"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/devoluciones.js?v='.$versionador_archivos.'"></script>';

  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}






elseif($_GET["ruta"] == "timbrar-devolucion-modulo"){

include "modulos/".$_GET['ruta'].".php";

  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}









elseif($_GET["ruta"] == "lista-garantias"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/lista-garantias.js?v='.$versionador_archivos.'"></script>';

  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}





elseif($_GET["ruta"] == "crear-garantia-venta"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/crear-garantia-venta.js?v='.$versionador_archivos.'"></script>';

  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}




elseif($_GET["ruta"] == "lista-csxc"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/csxc.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}



elseif($_GET["ruta"] == "lista-facturas"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/facturas.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

  


}





elseif($_GET["ruta"] == "lista-resurtidos"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/lista-resurtidos.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}




elseif($_GET["ruta"] == "lista-facturas-globales"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-facturas-globales.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}





elseif($_GET["ruta"] == "resurtido"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/resurtido.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}










elseif($_GET["ruta"] == "editar-resurtido"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/editar-resurtido.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}



elseif($_GET["ruta"] == "caja"){

include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/cajas.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}










elseif($_GET["ruta"] == "cambiar-utilidades-productos-marca"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/cambiar-utilidades-productos-marca.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "reporte-valor-inventario"){

  include "modulos/".$_GET['ruta'].".php";

echo '<script src="vistas/js/js-reporte-valor-inventario.js?v='.$versionador_archivos.'"></script>';
echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}






elseif($_GET["ruta"] == "reporte-ventas"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/reporte-ventas.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "reporte-ventas-canceladas"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-ventas-canceladas.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "reporte-ventas-tipo"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-ventas-tipo.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}


elseif($_GET["ruta"] == "reporte-ventas-vendedor"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-ventas-vendedor.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "reporte-ventas-forma-pago"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-ventas-forma-pago.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}






elseif($_GET["ruta"] == "reporte-ventas-cajero"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-ventas-cajero.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "reporte-ventas-hora"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-ventas-hora.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "reporte-ventas-productos"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-ventas-productos.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "reporte-ventas-marca-vendedor"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-ventas-marca-vendedor.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "reporte-ventas-producto-vendedor"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-ventas-producto-vendedor.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}












elseif($_GET["ruta"] == "reporte-ventas-terminal-bancaria"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-ventas-terminal-bancaria.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}











elseif($_GET["ruta"] == "reporte-facturas-globales"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-facturas-globales.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}







elseif($_GET["ruta"] == "reporte-compras-generales"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-compras-generales.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "reporte-compras-proveedor"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-compras-proveedor.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "reporte-compras-marca"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-compras-marca.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "reporte-compras-tipo"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-compras-tipo.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}




elseif($_GET["ruta"] == "reporte-devoluciones-generales"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-devoluciones-generales.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "reporte-devoluciones-motivo"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-devoluciones-motivo.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}






elseif($_GET["ruta"] == "reporte-devoluciones-cajero"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-devoluciones-cajero.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "reporte-devoluciones-vendedor"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-devoluciones-vendedor.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}





elseif($_GET["ruta"] == "reporte-devoluciones-tipo"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-devoluciones-tipo.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}









elseif($_GET["ruta"] == "reporte-productos-sin-existencias"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-productos-sin-existencias.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}






elseif($_GET["ruta"] == "reporte-productos-anaquel"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-productos-anaquel.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}






elseif($_GET["ruta"] == "reporte-productos-linea"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/reporte-productos-linea.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}







elseif($_GET["ruta"] == "reporte-productos-sin-movimiento"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-productos-sin-movimiento.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}






elseif($_GET["ruta"] == "reporte-lista-precios"){

  include "modulos/".$_GET['ruta'].".php";

  echo '<script src="vistas/js/js-reporte-lista-precios.js?v='.$versionador_archivos.'"></script>';
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";
  
}




elseif($_GET["ruta"] == "prueba"){

include "modulos/".$_GET['ruta'].".php";

echo '<script src="vistas/js/prueba.js?v='.$versionador_archivos.'"></script>';

  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}

elseif($_GET["ruta"] == "prueba2"){

include "modulos/".$_GET['ruta'].".php";
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}





elseif($_GET["ruta"] == "prueba-tickets"){

include "modulos/".$_GET['ruta'].".php";
  echo "<aside class='control-sidebar control-sidebar-dark'>
  </aside><div>";

}




else{

  include "modulos/404.php";

}

}else{

  include "modulos/inicio.php";
  

}






}else{

  echo '<body class="hold-transition sidebar-mini layout-fixed login-page">';

  include "modulos/login.php";

}

 ?>






<script>


  
  document.querySelectorAll('input').forEach((input) => {
    input.addEventListener('focusin', (event) => {
  event.target.style.background = '#E74C3C';
  event.target.style.color = '#FFFFFF';   
  });
});

document.querySelectorAll('input').forEach((input) => {
    input.addEventListener('focusout', (event) => {
  event.target.style.background = '';
  event.target.style.color = '#000000';     
  });
});

document.querySelectorAll('select').forEach((input) => {
    input.addEventListener('focusin', (event) => {
  event.target.style.background = '#E74C3C';
  event.target.style.color = '#FFFFFF';    
  });
});

document.querySelectorAll('select').forEach((input) => {
    input.addEventListener('focusout', (event) => {
  event.target.style.background = '';
  event.target.style.color = '#000000';     
  });
});

document.querySelectorAll('button').forEach((input) => {
    input.addEventListener('focusin', (event) => {
  event.target.style.background = '#E74C3C'; 
  event.target.style.color = '#FFFFFF';    
  });
});

document.querySelectorAll('button').forEach((input) => {
    input.addEventListener('focusout', (event) => {
  event.target.style.background = '';
  event.target.style.color = '#000000';     
  });
});

document.querySelectorAll('textarea').forEach((input) => {
    input.addEventListener('focusin', (event) => {
  event.target.style.background = '#E74C3C'; 
  event.target.style.color = '#FFFFFF';    
  });
});

document.querySelectorAll('textarea').forEach((input) => {
    input.addEventListener('focusout', (event) => {
  event.target.style.background = '';
  event.target.style.color = '#000000';     
  });
});



</script>






<script>
$(document).on("click", "#btnExportarPDFListaPreciosSucursal", function(){
 
    window.open("extensiones/tcpdf/examples/pdf-lista-precios-sucursal.php", "_blank");
  
});

</script>








<script>
$(document).bind("mousemove", function() {
  var verificarSesion = new FormData();
  verificarSesion.append("verificarSesion", "si");

        $.ajax({
            url: "ajax/usuarios.ajax.php",
            method: "POST",
            data: verificarSesion,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){

              if(respuesta == 0){


                  window.location = 'cerrar-sesion2';
                

                  
              }
              }
            });
    });
</script>




<script>
$(document).on("click", "#btnExportarEXCELListaPreciosSucursal", function(){
 
    window.open("vistas/modulos/exportesExcel/excel-lista-precios-sucursal.php", "_blank");
  
});

</script>

<!-- Page specific script -->

<script>
  $(function () {


    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
</script>

  <script>
      $(function () {
    $('.select2').select2();
  })


      
</script>

<script>
      $(function () {
    $('.duallistbox').bootstrapDualListbox({
      selectorMinimalHeight: '200',
      infoText:'Tiene {0} Permisos',
      infoTextEmpty : 'No hay permisos',
      infoTextFiltered : '<span class="label label-warning">Buscar Permiso</span> {0} from {1}',
    });
  })
</script>
      
      
      <script>
      $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });

      $('.ekko-lightbox').children('.modal-dialog').children('.modal-content').children('.modal-body').append("<center><button class='btn-xs btn-info' id='btnCambiarImagenProducto'>Cambiar imagen</button><center>");
    });

  
  })
</script>




<script type="text/javascript">
       function mostrarPassword1() {
           var cambio = document.getElementById("nuevoPassword");
           if (cambio.type == "password") {
               cambio.type = "text";
               $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
           } else {
               cambio.type = "password";
               $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
           }
       }

   </script>
   <script type="text/javascript">

function getPassword1(){
  document.getElementById('nuevoPassword').value = autoCreate(12);
}
function autoCreate(plength){
  var chars = "abcdefghijklmnopqrstubwsyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
  var password = '';    
    for(i=0; i<plength; i++){
      password+=chars.charAt(Math.floor(Math.random()*chars.length));
    }
  
  return password;
}

function generadorCodigoNumeros(plength){
  var chars = "1234567890";
  var codigo = '';    
    for(i=0; i<plength; i++){
      codigo+=chars.charAt(Math.floor(Math.random()*chars.length));
    }
  
  return codigo;
}
   </script>

   <script type="text/javascript">
       function mostrarPassword() {
           var cambio = document.getElementById("editarPassword");
           if (cambio.type == "password") {
               cambio.type = "text";
               $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
           } else {
               cambio.type = "password";
               $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
           }
       }

   </script>
   <script type="text/javascript">

function getPassword(){
  document.getElementById('editarPassword').value = autoCreate(12);
}
function autoCreate(plength){
  var chars = "abcdefghijklmnopqrstubwsyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
  var password = '';    
    for(i=0; i<plength; i++){
      password+=chars.charAt(Math.floor(Math.random()*chars.length));
    }
  
  return password;
}
   </script>











   <script type="text/javascript">
     $(document).on("click", "#btnCrearCompraXML", function(){

    $("#modalCrearCompraXML").modal("show");

});










$(document).on("click", "#btnSubmitCrearCompraXML", function(){

  var xml = $("#xmlCrearCompra").val();

  if(xml == ""){
    Swal.fire({
      icon: 'error',
      title: 'Debe introducir un XML',
      showConfirmButton: true
    });
  }else{



    Swal.fire({
                  title: 'Estas segur@?',
                  text: "Quieres crear una nueva compra?",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si'
                }).then(function(result){

                    if(result.value){

                      document.forms["formularioCrearCompraXML"].submit();

                    }

                  });//SWAL.FIRE DE CONFIRMACION

              }

});











$(document).on("click", "#btnCrearCompra", function(){

    $("#modalCrearCompra").modal("show");

});








   </script>












   <div class="modal fade" id="modalCrearCompraXML">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioCrearCompraXML" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                        
                        <div class="form-group">
                                <label>Inserta tu XML
                                </label>
                                <input type="file" class="form-control" id="xmlCrearCompra" name="xmlCrearCompra" accept=".xml">
                            </div>

                    </div>

                    <br>

                        <div class="col-sm-12 text-center">
                          <button type="button" class="btn btn-primary btn-lg" id="btnSubmitCrearCompraXML">Crear compra</button>

                    </div>


        </div>


</div>



<?php 
$crear_compra_xml = new ControladorCompras();
$crear_compra_xml -> ctrCrearCompraXML();


?>
</form>

</div>
</div>
</div>












<div class="modal fade" id="modalCrearCompra">
    <!--ESTE ES DEL TICKET QUE SALE CUANDO EL VENDEDOR CREA UNA VENTA-->
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal"></div>
            <form method="post" id="formularioCrearCompra" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 text-center">
                        
                        <div class="form-group">
                                <h2>¿Estas segur@?
                                </h2>
                                <p>¿Quieres crear una nueva compra?</p>
                                <input type="hidden" id="crearCompra" name="crearCompra" value="si" readonly>
                            </div>

                    </div>

                    <br>

                        <div class="col-sm-12 text-center">
                          <button type="submit" class="btn btn-primary btn-lg" id="btnSubmitCrearCompra">Crear compra</button>

                    </div>


        </div>


</div>



<?php 
$crearCompra = new ControladorCompras();
                $crearCompra -> ctrCrearCompra();


?>
</form>

</div>
</div>
</div>


</body>







</html>
