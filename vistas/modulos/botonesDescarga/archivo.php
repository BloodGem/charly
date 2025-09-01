<?php

$filepath = $nombre_archivo;


        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('../../../SDK2/timbrados/' . $nombre_archivo));
        readfile('../../../SDK2/timbrados/' . $nombre_archivo);

?>