<div class="content-wrapper">
    <section class="content">

        <div class="row">
            <div class="col-12">
                <?php

                    $indiceCrearVentas = array_search("Crear ventas",$array,true);

                    if($indiceCrearVentas !== false){
                        echo'<center><a href="crear-venta-filtros">
                        <button class="btn btn-primary">Crear Venta</button>
                        </a></center>';

                    }                    

                ?>

            </div>
        </div>

<?php

    $indiceVerCajasMenuPrincipal = array_search("Ver cajas menu principal",$array,true);

    $indiceVerUtilidadMenuPrincipal = array_search("Ver utilidad menu principal",$array,true);

    if($indiceVerCajasMenuPrincipal !== false){

?>



        



        <h5 class="mb-2 mt-4">Día de hoy</h5>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                
                        <?php
                            $totalVentasHoy = ControladorVentas::ctrMostrarSumaVentasRangoFechas(1);

                            echo "<h3>$".number_format($totalVentasHoy["total_ventas"],2)."</h3>";

                        ?>
                
                        <p>Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            
            
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                
                        <?php
                            $noVentasHoy = ControladorVentas::ctrMostrarNoVentasRangoFechas(1);

                            echo "<h3>".number_format($noVentasHoy["no_ventas"], 0)."</h3>";
                        ?>

                        <p>No. Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <?php
                if($_SESSION['id'] == 1 || $_SESSION['id'] == 2 || $_SESSION['id'] == 3){
            ?>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                
                        <?php
                            $totalUtilidadHoy = ControladorVentas::ctrMostrarSumaUtilidadVentasRangoFechas(1);

                            echo "<h3>$".number_format($totalUtilidadHoy["total_utilidad"], 2)."</h3>";
                        ?>

                        <p>Utilidad</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <?php
                }
            ?>

            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                  
                        <h3>0</h3>

                        <p>Compras</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="lista-compras" class="small-box-footer">Lista compras...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        <h5 class="mb-2 mt-4">Día de ayer</h5>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                
                        <?php
                            $totalVentasAyer = ControladorVentas::ctrMostrarSumaVentasRangoFechas(2);

                            echo "<h3>$".number_format($totalVentasAyer["total_ventas"],2)."</h3>";

                        ?>
                
                        <p>Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                
                        <?php
                            $noVentasAyer = ControladorVentas::ctrMostrarNoVentasRangoFechas(2);

                            echo "<h3>".number_format($noVentasAyer["no_ventas"], 0)."</h3>";
                        ?>

                        <p>No. Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <?php
                if($_SESSION['id'] == 1 || $_SESSION['id'] == 2 || $_SESSION['id'] == 3){
            ?>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                
                        <?php
                            $totalUtilidadAyer = ControladorVentas::ctrMostrarSumaUtilidadVentasRangoFechas(2);

                            echo "<h3>$".number_format($totalUtilidadAyer["total_utilidad"], 2)."</h3>";
                        ?>

                        <p>Utilidad</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <?php
                }
            ?>

            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                  
                        <h3>0</h3>

                        <p>Compras</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="lista-compras" class="small-box-footer">Lista compras...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        <h5 class="mb-2 mt-4">Semana actual</h5>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                
                        <?php
                            $totalVentasSemana = ControladorVentas::ctrMostrarSumaVentasRangoFechas(3);

                            echo "<h3>$".number_format($totalVentasSemana["total_ventas"],2)."</h3>";

                        ?>
                
                        <p>Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                
                        <?php
                            $noVentasSemana = ControladorVentas::ctrMostrarNoVentasRangoFechas(3);

                            echo "<h3>".number_format($noVentasSemana["no_ventas"], 0)."</h3>";
                        ?>

                        <p>No. Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <?php
                if($_SESSION['id'] == 1 || $_SESSION['id'] == 2 || $_SESSION['id'] == 3){
            ?>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                
                        <?php
                            $totalUtilidadSemana = ControladorVentas::ctrMostrarSumaUtilidadVentasRangoFechas(3);

                            echo "<h3>$".number_format($totalUtilidadSemana["total_utilidad"], 2)."</h3>";
                        ?>

                        <p>Utilidad</p>
                    </div>
                    <div class="icon">
                       <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <?php
                }
            ?>

            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                  
                        <h3>0</h3>

                        <p>Compras</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="lista-compras" class="small-box-footer">Lista compras...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        <h5 class="mb-2 mt-4">Semana anterior</h5>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                
                        <?php
                            $totalVentasSemanaAnterior = ControladorVentas::ctrMostrarSumaVentasRangoFechas(4);

                            echo "<h3>$".number_format($totalVentasSemanaAnterior["total_ventas"],2)."</h3>";

                        ?>
                
                        <p>Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                
                        <?php
                            $noVentasSemanaAnterior = ControladorVentas::ctrMostrarNoVentasRangoFechas(4);

                            echo "<h3>".number_format($noVentasSemanaAnterior["no_ventas"], 0)."</h3>";
                        ?>

                        <p>No. Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <?php
                if($_SESSION['id'] == 1 || $_SESSION['id'] == 2 || $_SESSION['id'] == 3){
            ?>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                
                        <?php
                            $totalUtilidadSemanaAnterior = ControladorVentas::ctrMostrarSumaUtilidadVentasRangoFechas(4);

                            echo "<h3>$".number_format($totalUtilidadSemanaAnterior["total_utilidad"], 2)."</h3>";
                        ?>

                        <p>Utilidad</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <?php
                }
            ?>

            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                  
                        <h3>0</h3>

                        <p>Compras</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="lista-compras" class="small-box-footer">Lista compras...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        <h5 class="mb-2 mt-4">Últimos 7 días</h5>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                
                        <?php
                            $totalVentas7Dias = ControladorVentas::ctrMostrarSumaVentasRangoFechas(5);

                            echo "<h3>$".number_format($totalVentas7Dias["total_ventas"],2)."</h3>";

                        ?>
                
                        <p>Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                
                        <?php
                            $noVentas7Dias = ControladorVentas::ctrMostrarNoVentasRangoFechas(5);

                            echo "<h3>".number_format($noVentas7Dias["no_ventas"], 0)."</h3>";
                        ?>

                        <p>No. Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <?php
                if($_SESSION['id'] == 1 || $_SESSION['id'] == 2 || $_SESSION['id'] == 3){
            ?>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">

                        <?php
                            $totalUtilidad7Dias = ControladorVentas::ctrMostrarSumaUtilidadVentasRangoFechas(5);

                            echo "<h3>$".number_format($totalUtilidad7Dias["total_utilidad"], 2)."</h3>";
                        ?>

                        <p>Utilidad</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <?php
                }
            ?>

            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                  
                        <h3>0</h3>

                        <p>Compras</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="lista-compras" class="small-box-footer">Lista compras...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        <h5 class="mb-2 mt-4">Últimos 30 días</h5>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                
                        <?php
                            $totalVentas30Dias = ControladorVentas::ctrMostrarSumaVentasRangoFechas(6);

                            echo "<h3>$".number_format($totalVentas30Dias["total_ventas"],2)."</h3>";

                        ?>
                
                        <p>Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                
                        <?php
                            $noVentas30Dias = ControladorVentas::ctrMostrarNoVentasRangoFechas(6);

                            echo "<h3>".number_format($noVentas30Dias["no_ventas"], 0)."</h3>";
                        ?>

                        <p>No. Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <?php
                if($_SESSION['id'] == 1 || $_SESSION['id'] == 2 || $_SESSION['id'] == 3){
            ?>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                
                        <?php
                            $totalUtilidad30Dias = ControladorVentas::ctrMostrarSumaUtilidadVentasRangoFechas(6);

                            echo "<h3>$".number_format($totalUtilidad30Dias["total_utilidad"], 2)."</h3>";
                        ?>

                        <p>Utilidad</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <?php
                }
            ?>

            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                  
                        <h3>0</h3>

                        <p>Compras</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="lista-compras" class="small-box-footer">Lista compras...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        <h5 class="mb-2 mt-4">Este mes</h5>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                
                        <?php
                            $totalVentasMes = ControladorVentas::ctrMostrarSumaVentasRangoFechas(7);

                            echo "<h3>$".number_format($totalVentasMes["total_ventas"],2)."</h3>";

                        ?>
                
                        <p>Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                
                        <?php
                            $noVentasMes = ControladorVentas::ctrMostrarNoVentasRangoFechas(7);

                            echo "<h3>".number_format($noVentasMes["no_ventas"], 0)."</h3>";
                        ?>

                        <p>No. Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <?php
                if($_SESSION['id'] == 1 || $_SESSION['id'] == 2 || $_SESSION['id'] == 3){
            ?>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                
                        <?php
                            $totalUtilidadMes = ControladorVentas::ctrMostrarSumaUtilidadVentasRangoFechas(7);

                            echo "<h3>$".number_format($totalUtilidadMes["total_utilidad"], 2)."</h3>";
                        ?>

                        <p>Utilidad</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <?php
                }
            ?>

            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                  
                        <h3>0</h3>

                        <p>Compras</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="lista-compras" class="small-box-footer">Lista compras...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        <h5 class="mb-2 mt-4">El mes anterior</h5>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                
                        <?php
                            $totalVentasMesAnterior = ControladorVentas::ctrMostrarSumaVentasRangoFechas(8);

                            echo "<h3>$".number_format($totalVentasMesAnterior["total_ventas"],2)."</h3>";

                        ?>
                
                        <p>Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                
                        <?php
                            $noVentasMesAnterior = ControladorVentas::ctrMostrarNoVentasRangoFechas(8);

                            echo "<h3>".number_format($noVentasMesAnterior["no_ventas"], 0)."</h3>";
                        ?>

                        <p>No. Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <?php
                if($_SESSION['id'] == 1 || $_SESSION['id'] == 2 || $_SESSION['id'] == 3){
            ?>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                
                        <?php
                            $totalUtilidadMesAnterior = ControladorVentas::ctrMostrarSumaUtilidadVentasRangoFechas(8);

                            echo "<h3>$".number_format($totalUtilidadMesAnterior["total_utilidad"], 2)."</h3>";
                        ?>

                        <p>Utilidad</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="lista-ventas" class="small-box-footer">Lista ventas...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <?php
                }
            ?>

            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                  
                        <h3>0</h3>

                        <p>Compras</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="lista-compras" class="small-box-footer">Lista compras...<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
   
  
<?php 
}
?>


</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->