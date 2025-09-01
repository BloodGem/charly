<?php

error_reporting(0);

date_default_timezone_set('America/Mazatlan');

require_once "controladores/plantilla.controlador.php";



//A
require_once "controladores/autos.controlador.php";
require_once "modelos/autos.modelo.php";

require_once "controladores/ajustes-inventario.controlador.php";
require_once "modelos/ajustes-inventario.modelo.php";

require_once "controladores/anaqueles-inventarios.controlador.php";
require_once "modelos/anaqueles-inventarios.modelo.php";



//C
require_once "controladores/clientes.controlador.php";
require_once "modelos/clientes.modelo.php";

require_once "controladores/cajas.controlador.php";
require_once "modelos/cajas.modelo.php";

require_once "controladores/compras.controlador.php";
require_once "modelos/compras.modelo.php";

require_once "controladores/computadoras.controlador.php";
require_once "modelos/computadoras.modelo.php";

require_once "controladores/csxc.controlador.php";
require_once "modelos/csxc.modelo.php";

require_once "controladores/csxp.controlador.php";
require_once "modelos/csxp.modelo.php";

require_once "controladores/cotizaciones.controlador.php";
require_once "modelos/cotizaciones.modelo.php";



//D
require_once "controladores/devoluciones.controlador.php";
require_once "modelos/devoluciones.modelo.php";

require_once "controladores/devoluciones-compras.controlador.php";
require_once "modelos/devoluciones-compras.modelo.php";



//E
require_once "controladores/existencias-sucursales.controlador.php";
require_once "modelos/existencias-sucursales.modelo.php";


//F
require_once "controladores/familias.controlador.php";
require_once "modelos/familias.modelo.php";

require_once "controladores/facturas-globales.controlador.php";
require_once "modelos/facturas-globales.modelo.php";




//E
require_once 'extensiones/phpqrcode/qrlib.php'; 


//G
require_once "controladores/garantias.controlador.php";
require_once "modelos/garantias.modelo.php";

require_once "controladores/gastos.controlador.php";
require_once "modelos/gastos.modelo.php";

require_once "controladores/global.controlador.php";
require_once "modelos/global.modelo.php";

require_once "controladores/grupos.controlador.php";
require_once "modelos/grupos.modelo.php";



//I
require_once "controladores/inventarios.controlador.php";
require_once "modelos/inventarios.modelo.php";



//K
require_once "modelos/kardex-productos.modelo.php";



//M
require_once "controladores/marcas.controlador.php";
require_once "modelos/marcas.modelo.php";

require_once "controladores/motores.controlador.php";
require_once "modelos/motores.modelo.php";



//N
require_once "controladores/notas.controlador.php";
require_once "modelos/notas.modelo.php";



//O
require_once "controladores/otros.controlador.php";
require_once "modelos/otros.modelo.php";



//P
require_once "controladores/pedidos.controlador.php";
require_once "modelos/pedidos.modelo.php";

require_once "controladores/productos.controlador.php";
require_once "modelos/productos.modelo.php";

require_once "controladores/proveedores.controlador.php";
require_once "modelos/proveedores.modelo.php";

require_once "controladores/partidas-inventarios.controlador.php";
require_once "modelos/partidas-inventarios.modelo.php";

require_once "modelos/partvta.modelo.php";

require_once "modelos/partres.modelo.php";

require_once "modelos/partdev.modelo.php";

require_once "controladores/partcom.controlador.php";
require_once "modelos/partcom.modelo.php";

require_once "controladores/partdevcom.controlador.php";
require_once "modelos/partdevcom.modelo.php";

require_once "modelos/partidas-ajustes-inventario.modelo.php";



//R
require_once "controladores/resurtido.controlador.php";
require_once "modelos/resurtido.modelo.php";



//S
require_once "controladores/subfamilias.controlador.php";
require_once "modelos/subfamilias.modelo.php";

require_once "controladores/sucursales.controlador.php";
require_once "modelos/sucursales.modelo.php";



//T
require_once "controladores/terminales-bancarias.controlador.php";
require_once "modelos/terminales-bancarias.modelo.php";
require_once "controladores/tipos.gastos.controlador.php";
require_once "modelos/tipos.gastos.modelo.php";



//U
require_once "controladores/usuarios.controlador.php";
require_once "modelos/usuarios.modelo.php";



//V
require_once "controladores/vendedores.controlador.php";
require_once "modelos/vendedores.modelo.php";
require_once "controladores/ventas.controlador.php";
require_once "modelos/ventas.modelo.php";




require_once "extensiones/vendor/autoload.php";


// Se incluye el SDK
require_once 'SDK2/sdk2.php';



require_once 'extensiones/enviar_correos/Exception.php';
require_once 'extensiones/enviar_correos/PHPMailer.php';
require_once 'extensiones/enviar_correos/SMTP.php';



$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();