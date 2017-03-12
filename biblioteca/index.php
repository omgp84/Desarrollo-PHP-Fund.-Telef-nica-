<?php
  include("usuario_modelo.php");

  session_start();
  if ($_POST) {
    $usuario = obtenerUsuarioPorEmailYContrasena($_POST["email"], cifrarContrasena($_POST["contrasena"]));
    if ($usuario == false) {
      $mensajeError = "El correo electrónico o la contraseña no coinciden";
    } else {
      $_SESSION["usuario"] = $usuario;
      header("Location: lista_usuarios.php");
    }
  }
?>

<?php
  ob_start();
?>

      <h1>Identificación de usuarios</h1>

      <?php
        if (!empty($mensajeError)) {
          echo "<p class='alert alert-danger'>$mensajeError</p>";
        }
      ?>

      <form method="POST" class="form-horizontal">

        <div class="well col-md-8 col-md-offset-2">
          <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Correo electrónico</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" id="email" placeholder="Correo electrónico" name="email">
            </div>
          </div>

          <div class="form-group">
            <label for="contrasena" class="col-sm-3 control-label">Contraseña</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="contrasena" placeholder="Contraseña" name="contrasena">
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Identifícate</button>

        </div>

      </form>

<?php
  $contenidoDeLaPagina = ob_get_contents();
  ob_end_clean();

  include("master.php");
?>
