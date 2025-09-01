<?php



$no_archivo = $_GET['no_archivo'];


switch ($no_archivo) {
    case 1:

        //DESCARGA EL XML DE LA FACTURA GLOBAL

        $id_factura_global = $_GET['id_factura_global'];

        $filepath = 'FG-'.$id_factura_global.'.xml';

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('../../SDK2/timbrados/globales/'.$filepath));
        readfile('../../SDK2/timbrados/globales/'.$filepath);


    break;


    case 2:

        $id_venta = $_GET['id_venta'];

        $filepath = 'FC-'.$id_venta.'.pdf';

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('../../SDK2/timbrados/'.$filepath));
        readfile('../../SDK2/timbrados/'.$filepath);


    break;





    case 3:

        $id_venta = $_GET['id_venta'];

        $filepath = 'FC-'.$id_venta.'.xml';

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('../../SDK2/timbrados/'.$filepath));
        readfile('../../SDK2/timbrados/'.$filepath);


    break;



    case 4:

        //DESCARGA EL XML DE LA FACTURA GLOBAL

        $id_factura_global = $_GET['id_factura_global'];

        $filepath = 'VFG-'.$id_factura_global.'.zip';

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('../../recursos/facturas_globales/'.$filepath));
        readfile('../../recursos/facturas_globales/'.$filepath);


    break;


    default:
        return;
        break;
}







        


?>