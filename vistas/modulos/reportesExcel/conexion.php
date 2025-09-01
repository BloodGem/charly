<?php
$db = getcwd() . "\\..\\..\\..\\..\\..\\..\\..\\ventas\\" . 'VENTAS.mdb';
    $dsn = "DRIVER={Microsoft Access Driver (*.mdb)};
    DBQ=$db";
    $con = odbc_connect( $dsn, '', '' );
?>