<?php
error_reporting(0);

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
date_default_timezone_set('America/Mexico_City');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {




    public $id_inventario;
    //Page header
    public function Header() {

        $id_inventario = $_GET['id_inventario'];

        

        // Logo
        /*$path = dirname( __FILE__ );
        $img_file = $path.'/images/fondo_pdf.jpg';
        $this->Image($img_file, 10, 100, 190, 85, '', '', '', false, 300, '', false, false, 0);
        $logo = $path.'/images/logo.jpg';
        $this->Image($logo, 8, 2, 65, 25, '', '', '', false, 30, '', false, false, 0);*/
        
        // Set font
        $this->SetFont('helvetica', 'B', 15);
        $this->SetY(15);
        $this->SetX(50);
        // Title
        $this->Cell(0, 15, "Hoja de responsabilidad del inventario no.".$id_inventario , 0, false, 'C', 0, '', 0, false, 'M', 'M');

        $this->SetY(30);
        $this->html = '<p style="border-top:1px solid #999; text-align:center;">
                            </p>';
            $this->writeHTML($this->html, true, false, true, false, '');
    }

    // Page footer
    public function Footer() {

        $this->SetY(-15);

        $this->html = '<p style="border-top:1px solid #999; text-align:center;">
                            </p>';
            $this->writeHTML($this->html, true, false, true, false, '');
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font

        $this->Cell(50, 10, 'Consultado el: '.date('d-m-Y').' a las: '.date('h:i:s',time() - 3610), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        // Page number
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');

        
    }



    public function exportarPDFVentasSucursales(){
require_once "../../../controladores/sucursales.controlador.php";
        require_once "../../../modelos/sucursales.modelo.php";
        require_once "../../../controladores/usuarios.controlador.php";
        require_once "../../../modelos/usuarios.modelo.php";
        require_once "../../../controladores/inventarios.controlador.php";
        require_once "../../../modelos/inventarios.modelo.php";
        require_once "../../../controladores/partidas-inventarios.controlador.php";
        require_once "../../../modelos/partidas-inventarios.modelo.php";
        require_once "../../../controladores/existencias-sucursales.controlador.php";
        require_once "../../../modelos/existencias-sucursales.modelo.php";

$id_inventario = $this->id_inventario;
    
    $traerInventario = ControladorInventarios::ctrMostrarInventario($id_inventario);

    $id_sucursal = $traerInventario['id_sucursal'];

    $traerPartidasInventario = ControladorPartidasInventarios::ctrMostrarPartidasInventario($id_inventario);



// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(5, 35, 5);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------

// set font

// add a page
$pdf->AddPage();
$bloque1 = <<<EOF


    <table style=style="border: 1px solid black; font-size:12px;">
<tr>
<td style="border: 1px solid black; width:65px; text-align:left; font-weight:bold;">Clave</td>
<td style="border: 1px solid black; width:280px; text-align:left; font-weight:bold;">Producto</td>
<td style="border: 1px solid black; width:40px; text-align:left; font-weight:bold;">Ubicación</td>
<td style="border: 1px solid black; width:40px; text-align:right; font-weight:bold;">Exist act</td>
<td style="border: 1px solid black; width:40px; text-align:right; font-weight:bold;">Exist enc</td>
<td style="border: 1px solid black; width:40px; text-align:right; font-weight:bold;">act - enc</td>
<td style="border: 1px solid black; width:50px; text-align:left; font-weight:bold;">Tipo</td>
<td style="border: 1px solid black; width:75px; text-align:right; font-weight:bold;">Precio</td>
<td style="border: 1px solid black; width:85px; text-align:right; font-weight:bold;">Total</td>

</tr>
</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------
$total_sobrante = 0;
$total_faltante = 0;
 foreach ($traerPartidasInventario as $keyPI => $rowPI) {

    $id_producto = $rowPI['id_producto'];

    $traerProducto = ControladorExistenciasSucursales::ctrMostrarProductoES2($id_producto, $id_sucursal);

    $existencias_actuales = $rowPI['existencias_actuales'];

    $existencias_encontradas = $rowPI['existencias_encontradas'];

    $pasa = 0;


                if($existencias_actuales == $existencias_encontradas){

                    $pasa = 0;
                    
                }elseif($existencias_actuales > $existencias_encontradas){


                    $cantidad = $existencias_actuales - $existencias_encontradas;
                    //$nuevas_existencias = $existencias_actuales - $cantidad;
                    $mo_entsal = "Faltan";

                    


                    $precio1 = $traerProducto['precio1'];
                    $total_producto = $precio1 * $cantidad; 
                    $total_faltante = $total_faltante + $total_producto;
                    $total_producto = number_format($total_producto, 2); 
                    $pasa = 1;
                }elseif ($existencias_actuales < $existencias_encontradas) {



                    if($existencias_actuales < 0 && $existencias_encontradas == 0){
                        $cantidad = 0;
                        $mo_entsal = "N/A";
                    }elseif($existencias_actuales < 0 && $existencias_encontradas > 0){
                        $cantidad = $existencias_encontradas;
                        $mo_entsal = "Sobran";
                    }else{
                        $cantidad = $existencias_encontradas - $existencias_actuales;
                        $mo_entsal = "Sobran";
                    }



                    $precio1 = $traerProducto['precio1'];

                    if($existencias_actuales < 0 && $existencias_encontradas == 0){

                        $total_producto = 0; 
                        $total_sobrante = $total_sobrante + $total_producto;

                    }else{

                        $total_producto = $precio1 * $cantidad; 
                        $total_sobrante = $total_sobrante + $total_producto;

                    }

                    
                    $total_producto = number_format($total_producto, 2);  
                    $pasa = 1;
                }

                //var_dump("calve articulo: ".$clave_producto."<br>existencias act: ".$existencias_actuales."<br>existencias enc: ".$existencias_encontradas."<br>pasa: ".$pasa);

                if($pasa == 1){

                    


$bloque2 = <<<EOF



    <table style="border: 1px solid black; font-size:11px;">


    
        <tr>
        
            <td style="border: 1px solid black; width:65px; text-align:left;">$traerProducto[clave_producto]</td>

            <td style="border: 1px solid black; width:280px; text-align:left;">
            
                $traerProducto[descripcion_corta]

            </td>

            <td style="border: 1px solid black; width:40px; text-align:left;">$traerProducto[ubicacion]</td>

            <td style="border: 1px solid black; width:40px; text-align:right;">
            
                $rowPI[existencias_actuales] 

            </td>
            <td style="border: 1px solid black; width:40px; text-align:right;">
            
                $rowPI[existencias_encontradas] 

            </td>

            <td style="border: 1px solid black; width:40px; text-align:right;">
            
                $cantidad 

            </td>

            <td style="border: 1px solid black; width:50px; text-align:left;">
            
                $mo_entsal

            </td>

            <td style="border: 1px solid black; width:75px; text-align:right;">
            
                $$precio1 

            </td>

            <td style="border: 1px solid black; width:85px; text-align:right;">
            
            $$total_producto

            </td>
            
            

        </tr>

        

    </table>
    

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}
}


    $total_pagar =  $total_faltante - $total_sobrante;

$total_pagar = number_format($total_pagar, 2);
$total_sobrante = number_format($total_sobrante, 2);
$total_faltante = number_format($total_faltante, 2);

$bloque3 = <<<EOF

    <table style="font-size:12px;">


    
        <tr>

        <td style="border: 1px solid black; width:630px; text-align:right; font-weight:bold;">TOTAL FALTANTE:</td>

            <td style="border: 1px solid black; width:85px; text-align:right; font-weight:bold;">
            
                $$total_faltante

            </td>
        </tr>

        <tr>

        <td style="border: 1px solid black; width:630px; text-align:right; font-weight:bold;">TOTAL SOBRANTE:</td>

            <td style="border: 1px solid black; width:85px; text-align:right; font-weight:bold;">
            
                $$total_sobrante

            </td>
        </tr>

        

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');



// ---------------------------------------------------------

$bloque4 = <<<EOF

    <table style="font-size:12px;">


    
        <tr>

        <td style="border: 1px solid black; width:630px; text-align:right; font-weight:bold;">TOTAL A PAGAR:</td>

            <td style="border: 1px solid black; width:85px; text-align:right; font-weight:bold;">
            
                $$total_pagar

            </td>
        </tr>


        

    </table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');


$traerUsuarioCreador = ControladorUsuarios::ctrMostrarUsuario($traerInventario['id_usuario_creador']);
$creador = $traerUsuarioCreador['nombre'];
$bloque5 = <<<EOF

<br><br><br><br>
<table style="font-size:12px;"><tr>
<td style="width:239px;"></td>
<td style="border-top: 1px solid black; width:239px; text-align:center; font-weight:bold;">Firma del creador del inventario <br> $creador </td><td style="width:239px;"></td>
</tr></table><br><br><br><br>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');










$listaResponsables = json_decode($traerInventario['responsables'], true);

//var_dump($listaResponsables);
$tablaResponsables = '<table style="font-size:12px;"><tr>';


foreach ($listaResponsables as $key => $value) {

    //var_dump($value);

    $traerUsuarioResponsable = ControladorUsuarios::ctrMostrarUsuario($value);


$tablaResponsables = $tablaResponsables.'<td style="border-top: 1px solid black; width:150px; text-align:center; font-weight:bold;">Firma del responsable <br> '.$traerUsuarioResponsable['nombre'].'</td><td></td>';

//<br><br><br><br><br><br>

}

$tablaResponsables = $tablaResponsables.'</tr></table>';

//var_dump($tablaResponsables);
$bloque6 = <<<EOF

$tablaResponsables

<br><br><br><br>

EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');




















$listaParticipantes = json_decode($traerInventario['participantes'], true);

        $contador = 0;

        $tablaParticipantes = '<table style="font-size:12px;"><tr>';

        foreach ($listaParticipantes as $keyP => $valueP) {

            $contador = $contador + 1;

            $traerUsuarioParticipante = ControladorUsuarios::ctrMostrarUsuario($valueP);


            if($contador > 3){
                $tablaParticipantes = $tablaParticipantes.'</tr></table><br><br><br><br><br><table style="font-size:12px;"><tr><td style="border-top: 1px solid black; width:150px; text-align:center; font-weight:bold;">Firma del participante <br> '.$traerUsuarioParticipante['nombre'].'</td><td></td>';
                $contador = 1;
            }else{
                $tablaParticipantes = $tablaParticipantes.'<td style="border-top: 1px solid black; width:150px; text-align:center; font-weight:bold;">Firma del participante <br> '.$traerUsuarioParticipante['nombre'].'</td><td></td>';
            }

            //var_dump($contador);


}

$tablaParticipantes = $tablaParticipantes.'</tr></table>';

$bloque7 = <<<EOF

    $tablaParticipantes

EOF;

$pdf->writeHTML($bloque7, false, false, false, false, '');


/*while ($traerUsuarioParticipante = odbc_fetch_array($stmtParticipantes)) {

    //var_dump($traerUsuarioParticipante['NOMBRE_VENDEDOR']);

    $nombre_cliente = mb_convert_encoding($traerUsuarioParticipante['NOMBRE_VENDEDOR'], "UTF-8", "iso-8859-1");

$bloque6 = <<<EOF

<td style="border-top: 1px solid black; width:150px; text-align:center; font-weight:bold;">Firma de <br> $nombre_cliente</td></tr></table>

EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');



//<br><br><br><br><br><br>

}*/


//var_dump($tablaParticipantes);
 






// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Hoja de responsabilidad del inventario no.'.$id_inventario.' '.date('d-m-Y').'.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+



}
}






$ventas_sucursales = new MYPDF();
$ventas_sucursales -> id_inventario = $_GET["id_inventario"];
$ventas_sucursales -> exportarPDFVentasSucursales();






