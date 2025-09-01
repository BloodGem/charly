<?php


    $id_venta = $_GET['id_venta'];
    $rfc = $_GET['rfc'];
    $contar = strlen($id_venta);
    if($contar==2){
        $nombre_archivo = "FN-".$rfc."_0000".$id_venta.".pdf";
        
        include 'archivo.php';
    }elseif($contar==3){
        $nombre_archivo = "FN-".$rfc."_000".$id_venta.".pdf";
        
        include 'archivo.php';
    }elseif($contar==4){
        $nombre_archivo = "FN-".$rfc."_00".$id_venta.".pdf";
        
        include 'archivo.php';
    }elseif($contar==5){
        $nombre_archivo = "FN-".$rfc."_0".$id_venta.".pdf";
        
        include 'archivo.php';
    }elseif($contar==6){
        $nombre_archivo = "FN-".$rfc."_".$id_venta.".pdf";
        
        include 'archivo.php';
    }else{
        echo "<script> alert('Error: No se ha econtrado su archivo pdf'); </script>"; 
    }


?>