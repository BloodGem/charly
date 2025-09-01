<?php

require_once "conexion.php"; 

$indiceReporteValorInventario = array_search("Reporte valor de inventario",$array,true);

                    if($indiceReporteValorInventario == 0){
   
                    }else if($indiceReporteValorInventario !== ""){

?>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
            
            <!--<div class="col-md-12">
            
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Valor de inventario gráfico</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChartValorInventario" style="min-height: 500px; height: 500px; max-height: 500px; max-width: 100%;"></canvas>
                
              </div>
            </div>
            
            </div>-->

            <!--<div class="col-md-12">
<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Exportación</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-sm table-bordered table-hover">
                  <thead>
                  <tr class="head-footer-tabla">
                    <th>Sucursal</th>
                    <th>valor de inventario $</th>
                    <th>Acción</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php
 
                                    
                                    
    //Recogemos las claves enviadas
    
        
            //$sql = "SELECT * FROM sucursales";
            
        
        
    //$rs = odbc_exec( $con, $sql );




    


     


      /*$sql2 = "SELECT existencias_sucursales.id_sucursal, sucursales.nombre, Sum(existencias_sucursales.stock*existencias_sucursales.precio_compra) AS total FROM existencias_sucursales INNER JOIN sucursales ON existencias_sucursales.id_sucursal = sucursales.id_sucursal GROUP BY existencias_sucursales.id_sucursal, sucursales.nombre";

      $rs2 = $conexion->query($sql2);

      $total_inventario_general = 0;

while($row2 = $rs2->fetch_array(MYSQLI_BOTH)){
        

    $total = number_format(round($row2['total'],2),2);

    $total_inventario_general = $total_inventario_general + $row2['total'];

    $porcentaje = (($row2['total']  / $total_inventario_general2) * 100);

    $porcentajeFormateado = number_format($porcentaje,0);
        
        echo'<tr>

                                            <td>
                                                     '.$row2['nombre'].'   
                                            </td>

                                            <td>
                                                     '.$total.'   
                                            </td>

                                            
                                                                                        <td>
                                              <button class="btn-sm btn-success btnExportarPDFValorInventario" id_sucursal="'.$row2['id_sucursal'].'">PDF</button>

                                              

                                              <button class="btn-sm btn-warning btnExportarEXCELValorInventario" id_sucursal="'.$row2['id_sucursal'].'">EXCEL</button>    
                                                    
                                            </td>
                                                                                        
                                            
                
            </tr>';
    }

    $total_inventario_general_formateado = number_format(round($total_inventario_general,2),2);*/

    
        
        ?>
                 
                  </tbody>
                  <tfoot>
                  <tr class="head-footer-tabla">
                    <th>Sucursal</th>
                    <th>valor de inventario $</th>
                    <th>Acción</th>
                    
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>-->




          <?php 

          $sql = "SELECT Sum(existencias_sucursales.stock*existencias_sucursales.precio_compra) AS total FROM existencias_sucursales";

      $rs = $conexion->query($sql);
      $row = $rs->fetch_array(MYSQLI_BOTH);


    

          ?>




          <div class="col-md-12">
            
            <div class="card card-info">
              <div class="card-header">
                <h1 class="card-title">Valor de Inventario General</h1>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <center><h1><?php echo number_format($row['total'], 2);?></h1></center>
                  </div>
                  <div class="col-12">
                    <center>

                      <button class="btn-sm btn-success" id="btnExportarPDFValorInventarioGeneral">PDF</button>
                    
                      <button class="btn-sm btn-warning" id="btnExportarEXCELValorInventarioGeneral">EXCEL</button>
                    </center>
                  </div>
                </div>
                

                  
              </div>
            </div>
            
            </div>
          <!-- /.col -->
        </div>
 
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>




<?php } ?>