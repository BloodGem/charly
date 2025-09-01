


  
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <center><h1 style="font-size: 40px; font-weight: 900;">Subir precios</h1></center>
          </div>
        </div>
      </div>
    </section>

    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">

                <form method="post" enctype="multipart/form-data" name="formularioCambiarPreciosProductos" id="formularioCambiarPreciosProductos">
<center><h2>Subir csv</h2>
                                <input type="file" accept="" class="form-control" id="archivoCSVExistenciasProductos" name="archivoCSVExistenciasProductos">
                                <br>
<button type="submit" class="btn-lg btn-primary" id="btnCambiarPreciosProductos">Cambiar Precios</button></center>

<?php 

                $subir_precios = new ControladorExistenciasSucursales();
                $subir_precios -> ctrActualizarProductosMasivamente();

                ?>
</form>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>



