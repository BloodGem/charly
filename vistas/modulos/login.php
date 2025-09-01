
<div id="fondo" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('vistas/img/perfil_empresa/logo.jpg');"></div>
<div class="login-box">
  <div class="login-logo">
    <img src="vistas/img/perfil_empresa/logo.jpg" width="350px">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">INICIO DE SESIÓN</p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="text" id="ingUsuario" name="ingUsuario" class="form-control" placeholder="USUARIO" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="ingPassword" name="ingPassword" class="form-control" placeholder="CONTRASEÑA">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <input type="submit" class="btn btn-primary btn-block" value="Iniciar Sesión">
          </div>
          <!-- /.col -->
        </div>

        <?php




        $login = new ControladorUsuarios();
        $login -> ctrInicioSesion();
        ?>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>