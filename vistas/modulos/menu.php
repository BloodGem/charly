<aside class="main-sidebar sidebar-dark-primary elevation-4 nav-compact">
<!-- Brand Logo  -->
<a href="inicio" class="brand-link" tabindex="-1">
  <img src="vistas/img/perfil_empresa/logo.jpg" alt="REFA Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
  <span class="brand-text font-weight-light">INICIO</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <a href="cerrar-sesion" tabindex="-1">
          <img src="vistas/img/plantilla/rojo.jpg" class="img-circle elevation-2" alt="User Image">
      </a>
  </div>
  <div class="info">
      <a href="cerrar-sesion" class="d-block" tabindex="-1">Cerrar sesión de: <?php echo $traerUsuario['usuario'] ?></a>
  </div>
</div>

<!-- SidebarSearch Form -->
<div class="form-inline">
    <div class="input-group" data-widget="sidebar-search">
      <input class="form-control form-conp´p'´'trol-sidebar" type="search" placeholder="Buscar" aria-label="Buscar" tabindex="-1">
      <div class="input-group-append">
        <button class="btn btn-sidebar" tabindex="-1" >
          <i class="fas fa-search fa-fw"></i>
      </button>
  </div>
</div>
</div>

<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">



        <?php

        $indiceMenuGrupos = array_search("Menu grupos",$array,true);

        if($indiceMenuGrupos !== false){
            ?>

            <li class="nav-item">
                <a href="grupos" class="nav-link" tabindex="-1">
                    <ion-icon style="font-size: 22px;" name="people-circle-outline"></ion-icon>
                    <p>Administrar grupos</p>
                </a>
            </li>

            <?php

                            }//VER GRUPOS

                            $indiceMenuUsuarios = array_search("Menu usuarios",$array,true);

                            if($indiceMenuUsuarios !== false){
                                echo '<li class="nav-item">
                                <a href="usuarios" class="nav-link" tabindex="-1">
                                <ion-icon style="font-size: 22px;" name="person-circle-outline"></ion-icon>
                                <p>Lista usuarios</p>
                                </a>
                                </li>';
                            }










                            $indiceMenuVendedores = array_search("Menu de vendedores",$array,true);

                            if($indiceMenuVendedores !== false){
                                $indiceListaVendedores = array_search("Lista de vendedores",$array,true);

                                if($indiceListaVendedores !== false){
                                    echo '<li class="nav-item">
                                    <a href="vendedores" class="nav-link" tabindex="-1">
                                    <ion-icon style="font-size: 22px;" name="person-circle"></ion-icon>
                                    <p>Vendedores</p>
                                    </a>
                                    </li>';
                                }
                            }










                            $indiceMenuProveedores = array_search("Menu proveedores",$array,true);

                            if($indiceMenuProveedores !== false){

                                ?>

                                <!--PROVEEDORES-->

                                <li class="nav-item">
                                    <a href="#" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="shield-checkmark"></ion-icon>
                                        <p>
                                            Proveedores
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>

                                    <ul class="nav nav-treeview">
                                        <?php
                                        $indiceListaProveedores = array_search("Lista proveedores",$array,true);

                                        if($indiceListaProveedores !== false){
                                            ?>
                                            <li class="nav-item">
                                                <a href="lista-proveedores" class="nav-link" tabindex="-1">
                                                    <ion-icon style="font-size: 22px;" name="list"></ion-icon>
                                                    <p>Lista proveedores</p>
                                                </a>
                                            </li>
                                            <?php

                                        } 


                                        $indiceCrearProveedores = array_search("Crear proveedores",$array,true);

                                        if($indiceCrearProveedores !== false){
                                            ?>
                                            <li class="nav-item">
                                                <a href="crear-proveedor" class="nav-link" tabindex="-1">
                                                    <ion-icon style="font-size: 22px;" name="person-add"></ion-icon>
                                                    <p>Crear proveedor</p>
                                                </a>
                                            </li>
                                            <?php

                                        }

                                        $indiceListaProductosProveedores = array_search("Lista productos proveedores",$array,true);

                                        if($indiceListaProductosProveedores !== false){
                                            ?>

                                            <li class="nav-item">
                                                <a href="lista-productos-proveedores" class="nav-link" tabindex="-1">
                                                    <ion-icon style="font-size: 22px;" name="list"></ion-icon>
                                                    <p>Lista productos proveedores</p>
                                                </a>
                                            </li>

                                            <?php

                                        }
                                        ?>


                                    </ul>
                                </li>





                                <?php
}//menu proveedores










$indiceMenuClientes = array_search("Menu clientes",$array,true);

if($indiceMenuClientes !== false){
    ?>
    <!--CLIENTES-->
    <li class="nav-item">
        <a href="lista-clientes" class="nav-link" tabindex="-1">
            <ion-icon style="font-size: 22px;" name="person"></ion-icon>
            <p>Clientes</p>
        </a>
    </li>
    <?php

                            }//MENU CLIENTES 










                            $indiceMenuVentas = array_search("Menu ventas",$array,true);

                            if($indiceMenuVentas !== false){

                                ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="cash-outline"></ion-icon>
                                        <p>
                                            Ventas
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>

                                    <ul class="nav nav-treeview">

                                        <?php

                                        $indiceCrearVentas = array_search("Crear ventas",$array,true);

                                        if($indiceCrearVentas !== false){
                                            ?>



                                            <li class="nav-item">
                                                <a href="crear-venta-filtros" class="nav-link" tabindex="-1">
                                                    <ion-icon style="font-size: 22px;" name="add"></ion-icon>
                                                    <p>Crear venta</p>
                                                </a>
                                            </li>
                                            <?php

                }//CREAR VENTAS

                $indiceSubmenuVentas = array_search("Submenu ventas",$array,true);

                if($indiceSubmenuVentas !== false){
                    ?>
                    <li class="nav-item">
                        <a href="lista-ventas" class="nav-link" tabindex="-1">
                            <ion-icon style="font-size: 22px;" name="list"></ion-icon>
                            <p>Lista ventas</p>
                        </a>
                    </li>

                    <?php
                }//VER TODAS LAS VENTAS   





                $indiceListaEntregaVentas = array_search("Lista entrega ventas",$array,true);

                if($indiceListaEntregaVentas !== false){
                    ?>
                    <li class="nav-item">
                        <a href="lista-entrega-ventas" class="nav-link" tabindex="-1">

                            <ion-icon style="font-size: 22px;" name="list"></ion-icon>

                            <p>Lista Entrega Ventas</p>
                        </a>
                    </li>

                    <?php
                }//VER TODAS LAS VENTAS   





                $indiceSubmenuVentasEnEspera = array_search("Submenu ventas en espera",$array,true);

                if($indiceSubmenuVentasEnEspera !== false){
                    ?>



                    <li class="nav-item">
                        <a href="lista-ventas-espera" class="nav-link" tabindex="-1">
                            <ion-icon style="font-size: 22px;" name="list"></ion-icon>
                            <p>Ventas en espera</p>
                        </a>
                    </li>
                    <?php

                }//VER VENTAS EN ESPERA





                $indiceSubmenuVentasNota = array_search("Submenu ventas nota",$array,true);

                if($indiceSubmenuVentasNota !== false){
                    ?>

                    <li class="nav-item">
                        <a href="lista-notas" class="nav-link" tabindex="-1">
                            <ion-icon style="font-size: 22px;" name="list"></ion-icon>
                            <p>Lista ventas nota</p>
                        </a>
                    </li>
                    <?php

                }//VER VENTAS NOTAS





                $indiceSubmenuCuentasPorCobrar = array_search("Submenu cuentas por cobrar",$array,true);

                if($indiceSubmenuCuentasPorCobrar !== false){
                    ?>

                    <li class="nav-item">
                        <a href="lista-csxc" class="nav-link" tabindex="-1">
                            <ion-icon style="font-size: 22px;" name="list"></ion-icon>
                            <p>Administrar cuentas x cobrar</p>
                        </a>
                    </li>

                    <?php

                }//VER CUENTAS POR COBRAR 

                ?>



            </ul>
        </li>
        <?php

}//MENU VENTAS










$indiceMenuCotizaciones = array_search("Menu cotizaciones",$array,true);

if($indiceMenuCotizaciones == 0){

}else if($indiceMenuCotizaciones !== ""){

    ?>
    <li class="nav-item">
        <a href="#" class="nav-link" tabindex="-1">
            <ion-icon style="font-size: 22px;" name="newspaper"></ion-icon>
            <p>
                Cotizaciones
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">

            <?php
            $indiceCrearCotizaciones = array_search("Crear cotizaciones",$array,true);

            if($indiceCrearCotizaciones !== false){
                ?>



                <li class="nav-item">
                    <a href="crear-cotizacion" class="nav-link" tabindex="-1">
                        <ion-icon style="font-size: 22px;" name="add"></ion-icon>
                        <p>Crear cotización</p>
                    </a>
                </li>
                <?php

                }//CREAR VENTAS





                $indiceListaCotizaciones = array_search("Lista cotizaciones",$array,true);

                if($indiceListaCotizaciones !== false){
                    ?>
                    <li class="nav-item">
                        <a href="lista-cotizaciones" class="nav-link" tabindex="-1">
                            <ion-icon style="font-size: 22px;" name="list"></ion-icon>
                            <p>Lista cotizaciones</p>
                        </a>
                    </li>

                    <?php
                }//VER TODAS LAS VENTAS   

                


                ?>




            </ul>
        </li>
        <?php

}//MENU COTIZACIONES










$indiceMenuDevoluciones = array_search("Menu devoluciones",$array,true);

if($indiceMenuDevoluciones == 0){

}else if($indiceMenuDevoluciones !== ""){
    ?>
    <!--DEVOLUCIONES-->
    <li class="nav-item">
        <a href="#" class="nav-link" tabindex="-1">
            <ion-icon style="font-size: 22px;" name="repeat"></ion-icon>
            <p>
                Devoluciones de Venta
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">
            <?php 
            $indiceCrearVentas = array_search("Crear devoluciones",$array,true);

            if($indiceCrearDevoluciones !== false){
                ?>
                <li class="nav-item">
                    <a href="crear-devolucion" class="nav-link" tabindex="-1">
                        <ion-icon style="font-size: 22px;" name="add"></ion-icon>
                        <p>Crear devolución</p>
                    </a>
                </li>
                <?php

                            }//CREAR COMPRAS   



                            $indiceVerDevoluciones = array_search("Ver devoluciones",$array,true);

                            if($indiceVerDevoluciones !== false){
                                ?>
                                <li class="nav-item">
                                    <a href="lista-devoluciones" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="list"></ion-icon>
                                        <p>Administrar devoluciones</p>
                                    </a>
                                </li>
                                <?php

                            }//LISTA DE DEVOLUCIONES  

                            
                            
                            ?>

                        </ul>
                    </li>
                    <?php 

                    }//MENU DEVOLUCIONES










                    $indiceMenuCompras = array_search("Menu compras",$array,true);

                    if($indiceMenuCompras !== false){

                        ?>

                        <!--COMPRAS-->

                        <li class="nav-item">
                            <a href="#" class="nav-link" tabindex="-1">
                                <ion-icon style="font-size: 22px;" name="storefront"></ion-icon>
                                <p>
                                    Compras
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <?php
                                $indiceCrearCompras = array_search("Crear compras",$array,true);

                                if($indiceCrearCompras !== false){
                                    ?>

                                    <li class="nav-item">
                                        <a href="#" class="nav-link" id="btnCrearCompra" tabindex="-1">
                                            <ion-icon style="font-size: 22px;" name="cart"></ion-icon>
                                            <p>Crear compra</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#" class="nav-link" id="btnCrearCompraXML" tabindex="-1">
                                            <ion-icon style="font-size: 22px;" name="cart"></ion-icon>
                                            <p>Crear compra XML</p>
                                        </a>
                                    </li>
                                    <?php

                            }//CREAR COMPRAS   





                            $indiceMenuCompras = array_search("Administrar compras",$array,true);

                            if($indiceMenuCompras !== false){
                                ?>
                                <li class="nav-item">
                                    <a href="lista-compras" class="nav-link" tabindex="-1">
                                       <ion-icon style="font-size: 22px;" name="list"></ion-icon>
                                        <p>Administrar compras</p>
                                    </a>
                                </li>
                                <?php

                            }//ADMINISTRAR COMPRAS   

                            
                            

                            $indiceListaCuentasPorPagar = array_search("Lista cuentas por pagar",$array,true);

                            if($indiceListaCuentasPorPagar !== false){
                            ?>

                            <li class="nav-item">
                                <a href="lista-csxp" class="nav-link" tabindex="-1">
                                    <ion-icon style="font-size: 22px;" name="list"></ion-icon>
                                    <p>Cuentas por pagar</p>
                                </a>
                            </li>

                            <?php

                }//VER CUENTAS POR COBRAR 
                ?>


            </ul>
        </li>





        <?php
}//menu compras










$indiceMenuResurtidos = array_search("Menu resurtidos",$array,true);

                            if($indiceMenuResurtidos == 0){

                            }else if($indiceMenuResurtidos !== ""){
                                ?>




                                <!--RESURTIDOS-->
                                <li class="nav-item">
                                    <a href="#" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="layers"></ion-icon>
                                        <p>
                                            Resurtidos
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>

                                    <ul class="nav nav-treeview">
                                        <?php

                                        $indiceCrearResurtidos = array_search("Crear resurtidos",$array,true);

                            if($indiceCrearResurtidos !== false){
                                ?>
                                <li class="nav-item">
                                    <a href="resurtido" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="add"></ion-icon>
                                        <p>Crear resurtido</p>
                                    </a>
                                </li>
                                <?php

                            }//CREAR RESURTIDOS


                                        $indiceMenuResurtidos = array_search("Administrar resurtidos",$array,true);

                                        if($indiceMenuResurtidos !== ""){
                                            ?>
                                            <li class="nav-item">
                                                <a href="lista-resurtidos" class="nav-link" tabindex="-1">
                                                    <ion-icon style="font-size: 22px;" name="list"></ion-icon>
                                                    <p>Administrar resurtidos</p>
                                                </a>
                                            </li>
                                            <?php

                            }//ADMINISTRAR RESURTIDOS  

                            
                            
                            ?>

                        </ul>
                    </li>




                    <?php 

                }










$indiceMenuDevolucionesCompras = array_search("Menu devoluciones de compras",$array,true);

                if($indiceMenuDevolucionesCompras !== false){
                    ?>
                    <!--DEVOLUCIONES-->
                    <li class="nav-item">
                        <a href="#" class="nav-link" tabindex="-1">
                            <ion-icon style="font-size: 22px;" name="refresh"></ion-icon>
                            <p>
                                Devoluciones Compras
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <?php

                            $indiceCrearDevolucionesCompras = array_search("Crear devoluciones de compras",$array,true);

                            if($indiceCrearDevolucionesCompras !== false){
                                ?>
                                <li class="nav-item">
                                    <a href="crear-devolucion-compra" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="add"></ion-icon>
                                        <p>Crear devolución</p>
                                    </a>
                                </li>
                                <?php

                            }//CREAR COMPRAS  

                            $indiceListaDevolucionesCompras = array_search("Lista devoluciones de compras",$array,true);

                            if($indiceListaDevolucionesCompras !== false){
                                ?>
                                <li class="nav-item">
                                    <a href="lista-devoluciones-compras" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="list"></ion-icon>
                                        <p>Administrar Devoluciones</p>
                                    </a>
                                </li>
                                <?php

                            }//VER VENTAS   

                            
                             
                            ?>

                        </ul>
                    </li>
                    <?php 

                    }//MENU DEVOLUCIONES










                $indiceMenuProductos = array_search("Menu productos",$array,true);

                if($indiceMenuProductos !== false){
                    ?>
                    <!--DEVOLUCIONES-->
                    <li class="nav-item">
                        <a href="#" class="nav-link" tabindex="-1">
                            <ion-icon style="font-size: 22px;" name="create"></ion-icon>
                            <p>
                                Productos y Características
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <?php

                            $indiceListaProductos = array_search("Lista de productos",$array,true);

                            if($indiceListaProductos !== false){
                                ?>
                                <li class="nav-item">
                                    <a href="lista-productos" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="list"></ion-icon>
                                        <p>Productos</p>
                                    </a>
                                </li>
                                <?php

                            }

                            $indiceListaMotores = array_search("Lista motores",$array,true);

                            if($indiceListaMotores !== false){
                                ?>
                                <li class="nav-item">
                                    <a href="motores" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="car"></ion-icon>
                                        <p>Motores</p>
                                    </a>
                                </li>
                                <?php

                            }





                            $indiceListaAutos = array_search("Lista de autos",$array,true);

                            if($indiceListaAutos !== false){
                                ?>
                                <li class="nav-item">
                                    <a href="autos" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="car-sport"></ion-icon>
                                        <p>Autos</p>
                                    </a>
                                </li>
                                <?php

                            }





                            $indiceListaFamilias = array_search("Lista de familias",$array,true);

                            if($indiceListaFamilias !== false){
                                ?>
                                <li class="nav-item">
                                    <a href="familias" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="bookmark"></ion-icon>
                                        <p>Familias</p>
                                    </a>
                                </li>
                                <?php

                            }






                            $indiceListaSubfamilias = array_search("Lista subfamilias",$array,true);

                            if($indiceListaSubfamilias !== false){
                                ?>
                                <li class="nav-item">
                                    <a href="subfamilias" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="bookmarks"></ion-icon>
                                        <p>Subfamilias</p>
                                    </a>
                                </li>
                                <?php

                            }






                            $indiceListaMarcas = array_search("Lista de marcas",$array,true);

                            if($indiceListaMarcas !== false){
                                ?>
                                <li class="nav-item">
                                    <a href="marcas" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="logo-buffer"></ion-icon>
                                        <p>Marcas</p>
                                    </a>
                                </li>
                                <?php

                            }








                            $indiceCambiarUtilidadesProductosMarca = array_search("Cambiar utilidades de productos por marca",$array,true);

                            if($indiceCambiarUtilidadesProductosMarca !== false){
                                ?>
                                <li class="nav-item">
                                    <a href="cambiar-utilidades-productos-marca" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="swap-horizontal"></ion-icon>
                                        <p>Cambiar Utilidades<br>por Marca</p>
                                    </a>
                                </li>
                                <?php

                            }

                            
                             
                            ?>

                        </ul>
                    </li>
                    <?php 

                    }










                    $indiceMenuCajas = array_search("Menu cajas",$array,true);

                if($indiceMenuCajas !== false){
                    ?>
                    <!--DEVOLUCIONES-->
                    <li class="nav-item">
                        <a href="#" class="nav-link" tabindex="-1">
                            <ion-icon style="font-size: 22px;" name="briefcase"></ion-icon>
                            <p>
                               Caja
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <?php

                            $indiceCobro = array_search("Cobro",$array,true);

                            if($indiceCobro !== false){
                                ?>
                                <li class="nav-item">
                                    <a href="cobro" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="print"></ion-icon>
                                        <p>Cobro</p>
                                    </a>
                                </li>
                                <?php

                            }

                            $indiceCaja = array_search("Caja",$array,true);

                            if($indiceCaja !== false){
                                ?>
                                <li class="nav-item">
                                    <a href="caja" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="receipt"></ion-icon>
                                        <p>Cortes de caja</p>
                                    </a>
                                </li>
                                <?php

                            }//VER VENTAS   

                            
                             
                            ?>

                        </ul>
                    </li>
                    <?php 

                    }//MENU DEVOLUCIONES











                    $indiceMenuAlmacen = array_search("Menu almacen",$array,true);

                if($indiceMenuAlmacen !== false){
                    ?>
                    <!--DEVOLUCIONES-->
                    <li class="nav-item">
                        <a href="#" class="nav-link" tabindex="-1">
                            <ion-icon style="font-size: 22px;" name="file-tray-stacked"></ion-icon>
                            <p>
                               Almacen
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <?php

                            $indiceListaExistenciasSucursales = array_search("Lista existencias sucursales",$array,true);

                            if($indiceListaExistenciasSucursales !== false){
                                ?>
                                <li class="nav-item">
                                    <a href="lista-existencias-sucursales" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="list"></ion-icon>
                                        <p>Existencias y Ubicaciones</p>
                                    </a>
                                </li>
                                <?php

                            }


                            
                             
                            ?>

                        </ul>
                    </li>
                    <?php 

                    }










$indiceKardex = array_search("Kardex",$array,true);

                            if($indiceKardex !== false){
                                ?>
                                <!--PRODUCTOS-->
                                <li class="nav-item">
                                    <a href="kardex" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="albums"></ion-icon>
                                        <p>Kardex</p>
                                    </a>
                                </li>
                                <?php

                            }//MENU KARDEX










$indiceMenuGarantias = array_search("Menu garantias",$array,true);

                    if($indiceMenuGarantias !== false){
                        ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link" tabindex="-1">
                                <ion-icon style="font-size: 22px;" name="copy"></ion-icon>
                                <p>
                                    Garantias
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <?php 

                                $indiceListaGarantias = array_search("Lista de garantias",$array,true);

                                if($indiceListaGarantias !== false){
                                    ?>
                                    <li class="nav-item">
                                        <a href="lista-garantias" class="nav-link" tabindex="-1">
                                            <ion-icon style="font-size: 22px;" name="list"></ion-icon>
                                            <p>Lista de Garantias</p>
                                        </a>
                                    </li>
                                    <?php

                            }//LISTA DE GARANTIAS  
                            ?>

                        </ul>
                    </li>
                    <?php 

                    }//MENU GARANTIAS





                            $indiceMenuAjustesInventario = array_search("Menu inventario",$array,true);

                            if($indiceMenuAjustesInventario !== ""){

                                ?>

<!--AJUSTES DE INVENTARIO ajustes de inventario-->

<li class="nav-item">
    <a href="#" class="nav-link" tabindex="-1">
        <ion-icon style="font-size: 22px;" name="clipboard"></ion-icon>
        <p>
           Inventario
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">
        <?php

        $indiceListaDeIventarios = array_search("Lista de inventarios",$array,true);

if($indiceListaDeIventarios !== false){
                                ?>
                                <li class="nav-item">
                                    <a href="lista-inventarios" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="list"></ion-icon>
                                        <p>Inventarios</p>
                                    </a>
                                </li>
                                <?php

                            }

                            $indiceReporteValorInventario = array_search("Reporte valor de inventario",$array,true);

                  if($indiceReporteValorInventario !== false){
                    ?>
                    <li class="nav-item">
                        <a href="reporte-valor-inventario" class="nav-link">
                          <ion-icon style="font-size: 22px;" name="logo-usd"></ion-icon>
                          <p>Valor de inventario</p>
                      </a>
                  </li>

                  <?php
            }//Reporte valor de inventario

        $indiceListaAjustesInventario = array_search("Lista ajustes de inventario",$array,true);

        if($indiceListaAjustesInventario !== false){
            ?>
            <li class="nav-item">
                <a href="lista-ajustes-inventario" class="nav-link" tabindex="-1">
                    <ion-icon style="font-size: 22px;" name="list"></ion-icon>
                    <p>Ajustes de inventario</p>
                </a>
            </li>
            <?php

                            }//ADMINISTRAR COMPRAS   

                            
                            
                            ?>

                        </ul>
                    </li>





                    <?php
}//MENU AJUSTES DE INVENTARIO










$indiceListaFacturasGlobales = array_search("Lista facturas globales",$array,true);

                    if($indiceListaFacturasGlobales !== false){
                        ?>

                        <!--FACTURAS GLOBALES facturas globales-->
                        <li class="nav-item">
                            <a href="lista-facturas-globales" class="nav-link" tabindex="-1">
                                <ion-icon style="font-size: 22px;" name="globe"></ion-icon>
                                <p>Facturas Globales</p>
                            </a>
                        </li>


                        <?php

                    }













$indiceMenuAjustesSucursal = array_search("Menu ajustes sucursal",$array,true);

                    if($indiceMenuAjustesSucursal !== false){
                        ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link" tabindex="-1">
                                <ion-icon style="font-size: 22px;" name="settings"></ion-icon>
                                <p>
                                    Ajustes Sucursal
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <?php 


                            $indicePerfilSucursal = array_search("Perfil sucursal",$array,true);

                    if($indicePerfilSucursal !== false){
                                    ?>
                                    <li class="nav-item">
                                        <a href="perfil-sucursal" class="nav-link" tabindex="-1">
                                            <ion-icon style="font-size: 22px;" name="cog"></ion-icon>
                                            <p>Parámetros de sucursal</p>
                                        </a>
                                    </li>
                                    <?php

                            }





                            $indiceListaComputadoras = array_search("Lista de computadoras",$array,true);

                    if($indiceListaComputadoras !== false){
                                    ?>
                                    <li class="nav-item">
                                        <a href="lista-computadoras" class="nav-link" tabindex="-1">
                                            <ion-icon style="font-size: 22px;" name="desktop"></ion-icon>
                                            <p>Computadoras</p>
                                        </a>
                                    </li>
                                    <?php

                                }







                                $indiceListaTerminalesBancarias = array_search("Lista de terminales bancarias",$array,true);

                    if($indiceListaTerminalesBancarias !== false){
                                    ?>
                                    <li class="nav-item">
                                        <a href="lista-terminales-bancarias" class="nav-link" tabindex="-1">
                                            <ion-icon style="font-size: 22px;" name="card"></ion-icon>
                                            <p>Terminales bancarias</p>
                                        </a>
                                    </li>
                                    <?php

                                }








                                $indiceListaTiposGastos = array_search("Lista tipos gastos",$array,true);

                    if($indiceListaTiposGastos !== false){
                                    ?>
                                    <li class="nav-item">
                                        <a href="tipos-gastos" class="nav-link" tabindex="-1">
                                            <ion-icon style="font-size: 22px;" name="keypad"></ion-icon>
                                            <p>Tipos de gastos</p>
                                        </a>
                                    </li>
                                    <?php

                                }








                                $indiceExportarListaPrecios = array_search("Exportar lista de precios",$array,true);

                            if($indiceExportarListaPrecios !== false){
                                    ?>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" tabindex="-1" id="btnExportarEXCELListaPreciosSucursal">
                                        <ion-icon style="font-size: 22px;" name="download"></ion-icon>
                                        <p>Exportar Lista de Precios</p>
                                    </a>
                                    </li>
                                    <?php

                                }

                            ?>

                        </ul>
                    </li>
                    <?php 

                    }




                            
                            $indiceMenuReportes = array_search("Menu reportes",$array,true);

                            if($indiceMenuReportes !== false){

                                ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" tabindex="-1">
                                        <ion-icon style="font-size: 22px;" name="bar-chart"></ion-icon>
                                        <p>
                                            Reportes
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>

                                    <ul class="nav nav-treeview">

                                       <?php

                                       $indiceSubmenuReportesVentas = array_search("Submenu reportes de ventas",$array,true);

                                       if($indiceSubmenuReportesVentas !== false){
                                        ?>

                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>
                                                Reportes Ventas
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">

                                            <?php
                                            $indiceReporteDeVentasGenerales = array_search("Reporte de ventas generales",$array,true);

                                            if($indiceReporteDeVentasGenerales !== false){
                                                ?>
                                                <li class="nav-item">
                                                    <a href="reporte-ventas" class="nav-link">
                                                      <i class="far fa-dot-circle nav-icon"></i>
                                                      <p>Ventas Generales</p>
                                                  </a>
                                              </li>
                                              <?php
                                          }


                                          $indiceReporteDeVentasPorTipo = array_search("Reporte de ventas por tipo",$array,true);

                                          if($indiceReporteDeVentasPorTipo !== false){
                                            ?>
                                            <li class="nav-item">
                                                <a href="reporte-ventas-tipo" class="nav-link">
                                                  <i class="far fa-dot-circle nav-icon"></i>
                                                  <p>Ventas por Tipo</p>
                                              </a>
                                          </li>
                                          <?php
                                      }



                                      $indiceReporteDeVentasPorVendedor = array_search("Reporte de ventas por vendedor",$array,true);

                                      if($indiceReporteDeVentasPorVendedor !== false){
                                        ?>
                                        <li class="nav-item">
                                            <a href="reporte-ventas-vendedor" class="nav-link">
                                              <i class="far fa-dot-circle nav-icon"></i>
                                              <p>Ventas por Vendedor</p>
                                          </a>
                                      </li>
                                      <?php
                                  }





                                  $indiceReporteVentasHora = array_search("Reporte de ventas por hora",$array,true);

                                  if($indiceReporteVentasHora !== false){
                                    ?>
                                    <li class="nav-item">
                                        <a href="reporte-ventas-hora" class="nav-link">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Ventas por Hora</p>
                                      </a>
                                  </li>
                                  <?php
                              }





                              $indiceReporteDeVentasCanceladas = array_search("Reporte de ventas canceladas",$array,true);

                              if($indiceReporteDeVentasCanceladas !== false){
                                ?>
                                <li class="nav-item">
                                    <a href="reporte-ventas-canceladas" class="nav-link">
                                      <i class="far fa-dot-circle nav-icon"></i>
                                      <p>Ventas Canceladas</p>
                                  </a>
                              </li>
                              <?php
                          }





                          $indiceReporteDeVentasPorFormaDePago = array_search("Reporte de ventas por forma de pago",$array,true);

                          if($indiceReporteDeVentasPorFormaDePago !== false){
                            ?>
                            <li class="nav-item">
                                <a href="reporte-ventas-forma-pago" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Ventas Forma Pago</p>
                              </a>
                          </li>
                          <?php
                      }





                      $indiceReporteVentasCajero = array_search("Reporte de ventas por cajero",$array,true);

                      if($indiceReporteVentasCajero !== false){
                        ?>
                        <li class="nav-item">
                            <a href="reporte-ventas-cajero" class="nav-link">
                              <i class="far fa-dot-circle nav-icon"></i>
                              <p>Ventas por Cajer@</p>
                          </a>
                      </li>
                      <?php
                  }





                  $indiceReporteVentasProductos = array_search("Reporte de ventas por productos",$array,true);

                  if($indiceReporteVentasProductos !== false){
                    ?>
                    <li class="nav-item">
                        <a href="reporte-ventas-productos" class="nav-link">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Ventas por Productos</p>
                      </a>
                  </li>
                  <?php
              }





              $indiceReporteVentasMarcaVendedor = array_search("Reporte de ventas por marca por vendedor",$array,true);

              if($indiceReporteVentasMarcaVendedor !== false){
                ?>
                <li class="nav-item">
                    <a href="reporte-ventas-marca-vendedor" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Ventas por Marca por Vendedor</p>
                  </a>
              </li>
              <?php
          }





          $indiceReporteVentasProductoVendedor = array_search("Reporte de ventas por marca por vendedor",$array,true);

          if($indiceReporteVentasProductoVendedor !== false){
            ?>
            <li class="nav-item">
                <a href="reporte-ventas-producto-vendedor" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Ventas por Producto por Vendedor</p>
              </a>
          </li>
          <?php
      }





      $indiceReporteVentasDevolucionesVendedor = array_search("Reporte ventas devoluciones por vendedor",$array,true);

      if($indiceReporteVentasDevolucionesVendedor !== false){
        ?>
        <li class="nav-item">
            <a href="reporte-ventas-devoluciones-vendedor" class="nav-link">
              <i class="far fa-dot-circle nav-icon"></i>
              <p>Ventas Devol por Vendedor</p>
          </a>
      </li>
      <?php
  }











  $indiceReporteFacturasGlobales = array_search("Reporte de facturas globales",$array,true);

  if($indiceReporteFacturasGlobales !== false){
    ?>
    <li class="nav-item">
        <a href="reporte-facturas-globales" class="nav-link">
          <i class="far fa-dot-circle nav-icon"></i>
          <p>Facturas Globales</p>
      </a>
  </li>
  <?php
}





$indiceReporteVentasTerminalBancaria = array_search("Reporte de ventas por terminal bancaria",$array,true);

if($indiceReporteVentasTerminalBancaria !== false){
    ?>
    <li class="nav-item">
        <a href="reporte-ventas-terminal-bancaria" class="nav-link">
          <i class="far fa-dot-circle nav-icon"></i>
          <p>Terminales Bancarias</p>
      </a>
  </li>
  <?php
}

?>

</ul>
</li>
<?php

                }//SUBMENU REPORTE DE VENTAS









                $indiceSubmenuReportesCompras = array_search("Submenu reportes de compras",$array,true);

                if($indiceSubmenuReportesCompras !== false){
                    ?>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Reportes Compras
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <?php
                        $indiceReporteDeComprasGenerales = array_search("Reporte de compras generales",$array,true);

                        if($indiceReporteDeComprasGenerales !== false){
                            ?>
                            <li class="nav-item">
                                <a href="reporte-compras-generales" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Compras Generales</p>
                              </a>
                          </li>
                          <?php
                      }




                      $indiceReporteDeComprasPorProveedor = array_search("Reporte de compras por proveedor",$array,true);

                      if($indiceReporteDeComprasPorProveedor !== false){
                        ?>
                        <li class="nav-item">
                            <a href="reporte-compras-proveedor" class="nav-link">
                              <i class="far fa-dot-circle nav-icon"></i>
                              <p>Compras por Proveedor</p>
                          </a>
                      </li>
                      <?php
                  }





                  $indiceReporteComprasMarca = array_search("Reporte de compras por marca",$array,true);

                  if($indiceReporteComprasMarca !== false){
                    ?>
                    <li class="nav-item">
                        <a href="reporte-compras-marca" class="nav-link">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Compras por Marca</p>
                      </a>
                  </li>
                  <?php
              }





              $indiceReporteComprasTipo = array_search("Reporte de compras por tipo",$array,true);

              if($indiceReporteComprasTipo !== false){
                ?>
                <li class="nav-item">
                    <a href="reporte-compras-tipo" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Compras por Tipo</p>
                  </a>
              </li>
              <?php
          }
          ?>

      </ul>
  </li>
  <?php

                }//SUBMENU REPORTE DE COMPRAS










                $indiceSubmenuReportesDevoluciones = array_search("Submenu reportes de devoluciones",$array,true);

                if($indiceSubmenuReportesDevoluciones !== false){
                    ?>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Reportes Devoluciones
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <?php
                        $indiceReporteDeDevolucionesGenerales = array_search("Reporte de devoluciones generales",$array,true);

                        if($indiceReporteDeDevolucionesGenerales !== false){
                            ?>
                            <li class="nav-item">
                                <a href="reporte-devoluciones-generales" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Devoluciones Generales</p>
                              </a>
                          </li>
                          <?php
                      }




                      $indiceReporteDeDevolucionesPorMotivo = array_search("Reporte de devoluciones por motivo",$array,true);

                      if($indiceReporteDeDevolucionesPorMotivo !== false){
                        ?>
                        <li class="nav-item">
                            <a href="reporte-devoluciones-motivo" class="nav-link">
                              <i class="far fa-dot-circle nav-icon"></i>
                              <p>Devoluciones por Motivo</p>
                          </a>
                      </li>
                      <?php
                  }





                  $indiceReporteDeDevolucionesPorCajero = array_search("Reporte de devoluciones por cajero",$array,true);

                  if($indiceReporteDeDevolucionesPorCajero !== false){
                    ?>
                    <li class="nav-item">
                        <a href="reporte-devoluciones-cajero" class="nav-link">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Devoluciones por Cajero</p>
                      </a>
                  </li>
                  <?php
              }





              $indiceReporteDeDevolucionesPorVendedor = array_search("Reporte de devoluciones por vendedor",$array,true);

              if($indiceReporteDeDevolucionesPorVendedor !== false){
                ?>
                <li class="nav-item">
                    <a href="reporte-devoluciones-vendedor" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Devoluciones por Vendedor</p>
                  </a>
              </li>
              <?php
          }





          $indiceReporteDevolucionesTipo = array_search("Reporte de devoluciones por tipo",$array,true);

          if($indiceReporteDevolucionesTipo !== false){
            ?>
            <li class="nav-item">
                <a href="reporte-devoluciones-tipo" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Devoluciones por Tipo</p>
              </a>
          </li>
          <?php
      }
      ?>

  </ul>
</li>
<?php

                }//SUBMENU REPORTE DE COMPRAS









                $indiceSubmenuReportesProductos = array_search("Submenu reportes de productos",$array,true);

                if($indiceSubmenuReportesProductos !== false){
                    ?>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Reportes Productos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <?php
                        $indiceReporteDeComprasGenerales = array_search("Reporte de compras generales",$array,true);

                        if($indiceReporteDeComprasGenerales !== false){
                            ?>
                            <li class="nav-item">
                                <a href="reporte-productos-sin-existencias" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Productos sin Existencias</p>
                              </a>
                          </li>
                          <?php
                      }






                      $indiceReporteDeProductosPorAnaquel = array_search("Reporte de productos por anaquel",$array,true);

                      if($indiceReporteDeProductosPorAnaquel !== false){
                        ?>
                        <li class="nav-item">
                            <a href="reporte-productos-anaquel" class="nav-link">
                              <i class="far fa-dot-circle nav-icon"></i>
                              <p>Productos por Anaquel</p>
                          </a>
                      </li>
                      <?php
                  }







                  $indiceReporteDeProductosSinMovimiento = array_search("Reporte de productos sin movimiento",$array,true);

                  if($indiceReporteDeProductosSinMovimiento !== false){
                    ?>
                    <li class="nav-item">
                        <a href="reporte-productos-sin-movimiento" class="nav-link">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Productos sin movimiento</p>
                      </a>
                  </li>
                  <?php
              }





              $indiceReporteListaPrecios = array_search("Reporte lista de precios",$array,true);

              if($indiceReporteListaPrecios !== false){
                ?>
                <li class="nav-item">
                    <a href="reporte-lista-precios" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Lista de precios</p>
                  </a>
              </li>
              <?php
          }


          ?>

      </ul>
  </li>
  <?php

                }//SUBMENU REPORTE DE PRODUCTOS










                $indiceSubenuReporteInventarios = array_search("Submenu reportes de inventarios",$array,true);

                if($indiceSubenuReporteInventarios !== false){
                  ?>

                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Reportes Inventarios
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                  <?php
                  $indiceReporteValorInventario = array_search("Reporte valor de inventario",$array,true);

                  if($indiceReporteValorInventario !== false){
                    ?>
                    <li class="nav-item">
                        <a href="reporte-valor-inventario" class="nav-link">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Valor de inventario</p>
                      </a>
                  </li>

                  <?php
            }//Reporte valor de inventario


            ?>
        </ul>
    </li>

    <?php
            }//menu cortes de caja
            ?>




        </ul>
    </li>
    <?php

}//MENU REPORTES






$indiceExportarListaPrecios = array_search("Exportar lista de precios",$array,true);

                        if($indiceExportarListaPrecios !== false){
                            ?>

                        <li class="nav-item">
                            <a href="#" class="nav-link" tabindex="-1" id="btnExportarPDFListaPreciosSucursal">
                                    <i class="nav-icon fas fa-circle"></i>
                                    <p>Exportar Lista de Precios</p>
                                </a>
                            <!--<center><button type="btn" class="nav-link" id="btnExportarEXCELListaPreciosSucursal">Exportar Lista de Precios</button></center>-->
                        </li>

                        <?php

                    }
?>



                        <!--<li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-circle"></i>
          <p>
            Reportes
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Ventas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">-->


            <!--</ul>
          </li>
        </ul>
      </li>
                    </li>
                </ul>-->
                <br><br><br><br><br><br>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>



