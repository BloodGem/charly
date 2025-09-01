<?php


    $id_venta = $_GET['id_venta'];
    $rfc = $_GET['rfc'];
   
        $nombre_archivo = $id_venta.$rfc.".xml";
        
        include 'archivo.php';
    


?>