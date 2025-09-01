
<?php

require_once "conexion.php"; 

$indiceReporteDeProductosSinexistencias = array_search("Reporte de productos sin existencias",$array,true);

if($indiceReporteDeProductosSinexistencias !== false){

    ?>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <center><h1 style="font-size: 40px; font-weight: 900;">Reporte de Productos sin Existencias</h1></center>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          







          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-12">

 

            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div class="row">




                    <div class="col-12">
                      <center>
                      <label>Acciones</label>
                      <div class="form-group">
                    <!--<button class="btn-sm btn-success btnExportarPDFReporteComprasGenerales">PDF</button>-->
                    
                    <button class="btn-sm btn-warning" id="btnExportarEXCELReporteProductosSinExistencias">EXCEL</button>
                  </center>
                  </div>
                </div>












                    <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <?php


//require_once "../../../modelos/conexion2.php";




    $sql = "SELECT existencias_sucursales.id_producto, productos.clave_producto, productos.descripcion_corta, productos.descripcion_larga, productos.id_marca, productos.id_proveedor1, productos.id_proveedor2, productos.id_proveedor3, existencias_sucursales.stock, existencias_sucursales.nivel_minimo, existencias_sucursales.nivel_medio, existencias_sucursales.nivel_maximo, (existencias_sucursales.nivel_maximo - existencias_sucursales.stock) as a_pedir, existencias_sucursales.precio_compra FROM productos INNER JOIN existencias_sucursales ON productos.id_producto = existencias_sucursales.id_producto WHERE existencias_sucursales.stock <= 0 AND productos.descontinuado = 0 AND existencias_sucursales.id_sucursal = ".$traerUsuario['id_sucursal']." ORDER BY productos.descripcion_larga ASC";

   

    //echo $sql;
    $rs = $conexion->query($sql);



echo '<table id="tablaReporteProductosSinExistencias" class="table table-bordered table-hover">
<thead>
<tr>
<th>Clave</th>
<th>Descripción</th>
<th>Marca</th>
<th>Precio Compra</th>
<th>A pedir</th>
<th>Proveedor 1</th>
<th>Proveedor 2</th>
<th>Proveedor 3</th>
</tr>
</thead>
<tbody>';


while($row = $rs->fetch_array(MYSQLI_BOTH)){

    $traerMarca = ControladorMarcas::ctrMostrarMarca($row['id_marca']);

    $traerProveedor1 = ControladorProveedores::ctrMostrarProveedor($row['id_proveedor1']);

    $traerProveedor2 = ControladorProveedores::ctrMostrarProveedor($row['id_proveedor2']);

    $traerProveedor3 = ControladorProveedores::ctrMostrarProveedor($row['id_proveedor3']);
    
  


    echo '<tr>
    <td>'.$row["clave_producto"].'</td>
    <td>'.$row["descripcion_corta"].'</td>
    <td>'.$traerMarca['marca'].'</td>
    <td>$'.$row["precio_compra"].'</td>
    <td>'.$row["a_pedir"].'</td>
    <td>'.$traerProveedor1["nombre"].'</td>
    <td>'.$traerProveedor2["nombre"].'</td>
    <td>'.$traerProveedor3["nombre"].'</td>
    </tr>';
}


echo '</tbody>
<tfoot>
<tr>
<th>Clave</th>
<th>Descripción</th>
<th>Marca</th>
<th>Precio Compra</th>
<th>A pedir</th>
<th>Proveedor 1</th>
<th>Proveedor 2</th>
<th>Proveedor 3</th>
</tr>
</tfoot>
</table>';



















    


?>
              </div>
              <!-- /.card-body -->
            </div>

            <!-- /.card -->
          </div>
                  </div>


              </div>
              <!-- /.card-body -->
            </div>

          </div>
















          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


<?php } ?>







