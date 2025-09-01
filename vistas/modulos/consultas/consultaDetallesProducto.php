<?php 
error_reporting(0);
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
require_once "../../../controladores/marcas.controlador.php";
require_once "../../../modelos/marcas.modelo.php";
require_once "../../../controladores/autos.controlador.php";
require_once "../../../modelos/autos.modelo.php";
require_once "../../../controladores/familias.controlador.php";
require_once "../../../modelos/familias.modelo.php";
require_once "../../../controladores/subfamilias.controlador.php";
require_once "../../../modelos/subfamilias.modelo.php";
require_once "../../../controladores/motores.controlador.php";
require_once "../../../modelos/motores.modelo.php";


$id_producto = $_POST["id_producto"];

$traerProducto = ControladorProductos::ctrMostrarProducto($id_producto);

$traerMarca = ControladorMarcas::ctrMostrarMarca($traerProducto['id_marca']);

$traerFamilia = ControladorFamilias::ctrMostrarFamilia($traerProducto['id_familia']);

$traerSubfamilia = ControladorSubfamilias::ctrMostrarSubfamilia($traerProducto['id_subfamilia']);

echo'
  <div class="card">
    <div class="card-header p-2">
      <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link" href="#general" data-toggle="tab">General</a></li>
        <li class="nav-item"><a class="nav-link active" href="#autos" data-toggle="tab">Autos</a></li>
      </ul>
    </div><!-- /.card-header --> 
    <div class="card-body">
      <div class="tab-content">
        <div class="tab-pane" id="general">

          <div class="row">
            <div class=" col-6">
              <label>Marca</label>
              <p>'.$traerMarca['marca'].'</p>
            </div>
            <div class=" col-6">
              <label>Familia</label>
              <p>'.$traerFamilia['familia'].'</p>
            </div>
            <div class=" col-6">
              <label>Subfamilia</label>
              <p>'.$traerSubfamilia['subfamilia'].'</p>
            </div>

            <br><br><br>



            <div class="col-lg-3 col-6">
              <label>Motor</label>
              <p>'.$traerProducto['motor'].'</p>
            </div>
            <div class="col-lg-3 col-6">
            <label>Viscosidad</label>
            <p>'.$traerProducto['viscosidad'].'</p>
            </div>
            <div class="col-lg-3 col-6">
            <label>Apl</label>
            <p>'.$traerProducto['apl'].'</p>
            </div>
            <div class="col-lg-3 col-6">
            <label>Presentación</label>
            <p>'.$traerProducto['presentacion'].'</p>
            </div>

            <br><br><br>

            <div class="col-lg-3 col-6">
            <label>Medidas</label>
            <p>'.$traerProducto['medidas'].'</p>
            </div>
            <div class="col-lg-3 col-6">
            <label>Color</label>
            <p>'.$traerProducto['color'].'</p>
            </div>
            <div class="col-lg-3 col-6">
            <label>Canales</label>
            <p>'.$traerProducto['no_canales'].'</p>
            </div>
            <div class="col-lg-3 col-6">
            <label>Birlos</label>
            <p>'.$traerProducto['no_birlos'].'</p>
            </div>

            <br><br><br>

            <div class="col-lg-3 col-6">
            <label>dientes</label>
            <p>'.$traerProducto['dientes'].'</p>
            </div>
          </div>
        </div><!--Pestaña de los detalles del producto en general-->











        <div class="active tab-pane" id="autos">';

              if($traerProducto['autos'] !== "" && $traerProducto['autos'] !== null){

                $listaAutosProducto = json_decode($traerProducto['autos'], true);


                echo '
                <table class="table table-bordered table-hover" id="tablaAutosProducto" style="width: 100%;">
                <thead>
                <tr>
                <th>Auto</th>
                <th>Submarca</th>
                <th>Motor</th>
                <th>Años</th>
                </tr>
                </thead>
                <tbody>';

                foreach ($listaAutosProducto as $key => $value) {
                  echo '<tr>';
                  $traerAuto = ModeloAutos::mdlMostrarAuto($value['id_auto']);
                  $traerMotor = ModeloMotores::mdlMostrarMotor($traerAuto['id_motor']);


                  $anos_auto = "";

                  foreach (range($value['ano_inicial'], $value['ano_final']) as $ano) {
                    $anos_auto = $anos_auto.$ano. ', ';
                  }

                  $anos_auto = substr($anos_auto, 0, -2);

                  echo '<td>'.$traerAuto['auto'].'</td>
                  <td>'.$traerAuto['submarca'].'</td>
                  <td>'.$traerMotor['motor'].'</td>
                  <td>'.$anos_auto.'</td></tr>';


                }




                echo '
                </tbody>
                <tfoot>
                <tr>
                <th>Auto</th>
                <th>Submarca</th>
                <th>Motor</th>
                <th>Años</th>
                </tr>
                </tfoot>
                </table>
                ';

              }else{
                echo "<strong>NO HAY AUTOS</strong>";
              }     
        echo'</div><!--Pestaña de los autos-->
      </div>   
    </div>                   
  </div>
';
  
?>





