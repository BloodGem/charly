<div class="content-wrapper">

    <?php

    $id_resurtido = $_GET["id_resurtido"];

    $traerResurtido = ControladorResurtidos::ctrMostrarResurtido($id_resurtido);
                    //var_dump($traerCompra);
    if ($traerResurtido["estatus"] == 0) {
        ?>

        <section class="content">
          <div class="container-fluid">
            <div class="row">






              <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="card card-primary">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <div class="row">
                          <div class="col-lg-6 col-12">
                            <div class="input-group">
                              <label>Proveedor</label>
                              <select class="form-control" style="width: 100%;" disabled>
                                <?php

                                $traerProveedor = ControladorProveedores::ctrMostrarProveedor($traerResurtido['id_proveedor']);

                                echo '<option value="">'.$traerProveedor["nombre"].'</option>';

                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="lista-resurtidos">Lista de resurtidos</a></li>
                    <li class="breadcrumb-item active">Editar resurtido <?php echo $id_resurtido; ?></li>
                </ol>
            </div>

                </div>
            </div>
        </div>          
    </div>




    <div class="col-md-12">


      <div class="card card-primary">
        <div class="card-header">
        </div>
        <div class="card-body">

            <table class="table table-bordered table-striped" id="tablaPartidasResurtido">
                 <thead>
                    <tr>
                        <th>.</th>
                        <th>Clave</th>
                        <th>Producto</th>
                        <th>Precio Compra</th>
                        <th>Existencia</th>
                        <th>Mínimo</th>
                        <th>Máximo</th>
                        <th style="width: 15%;">A pedir</th>
                    </tr>
                </thead>

                <tbody>
                <?php 

                $traerPartidasResurtido = ControladorResurtidos::ctrMostrarPartidasResurtido($id_resurtido);

                foreach ($traerPartidasResurtido as $key => $row) {

                    $id_producto = $row['id_producto'];

                    $traerProducto = ControladorProductos::ctrMostrarProducto($id_producto);

                    echo '<tr>

                    <td class="partres"><button type="button" class="btn btn-sm btn-danger quitarProducto" id_partres="'.$row['id_partres'].'" tabindex="-1"><i class="fa fa-times"></i></button></td>
                    <td>'.$traerProducto['clave_producto'].'</td>
                    <td>'.$traerProducto['descripcion_corta'].'</td>
                    <td>'.$row['precio_compra'].'</td>
                    <td>'.$row['stock_actual'].'</td>
                    <td>'.$row['nivel_minimo'].'</td>
                    <td>'.$row['nivel_maximo'].'</td>
                    <td class="ingresoAPedir"><input type="number" class="form-control form-control-sm nuevoAPedir" name="nuevoAPedir" min="1" value="'.$row['a_pedir'].'"></td>

                    </tr>';

                }

                ?>
                </tbody>

                <tfoot>
                    <tr>

                    </tr>
                </tfoot>
            </table>

        </div>
    </div>

</div>



<div class="col-12">
    <center>
        <a href="lista-resurtidos">
            <button type="button" class="btn btn-info" accesskey="1">Lista resurtidos</button>
        </a>
    </center>
</div>


<br><br>









</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>


<?php 


}else{
    echo "<script>

    Swal.fire({
      icon: 'error',
      title: 'ESTE RESURTIDO YA HA SIDO CONVERTIDA EN UNA COMPRA',
      showConfirmButton: false,
      timer: 3000
      }).then(function(result){

          window.location = 'lista-resurtidos';

          });


          </script>";
      }


  ?>