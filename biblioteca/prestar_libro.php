<?php
  include_once("libros_modelo.php");
  include_once("usuario_modelo.php");

  $libro = obtenerLibroPorId($_GET["libro"]);
  $usuarios = obtenerTodosLosUsuarios();

  if (!empty($_GET["usuario"])) {
    if ($libro["usuario_id"] == NULL) {
      ejecutarConsulta("UPDATE libros SET usuario_id=" . $_GET["usuario"] . " WHERE id='" . $_GET["libro"] . "';");
      header("Location: ver_usuario.php?id=" . $_GET["usuario"]);
    } elseif ($_GET["usuario"] == $libro["usuario_id"]) {
      $mensajeError = "<p class='alert alert-danger'>Este usuario ya tiene este libro</p>";
    } else {
      $mensajeError = "<p class='alert alert-danger'>Este libro lo tiene otro usuario</p>";
    }
  }

  ob_start();
?>

<?= empty($mensajeError) ? "" : $mensajeError ?>

<form method="get">
  <div class="form-group">
    Título: <?= $libro["titulo"] ?>
  </div>
  <div class="form-group">
    <select name="usuario">

      <?php foreach ($usuarios as $usuario): ?>
        <option value="<?= $usuario["id"] ?>"><?= $usuario["nombre"] ?></option>
      <?php endforeach; ?>

    </select>
  </div>
  <input type="hidden" name="libro" value="<?= $libro["id"] ?>">
  <input type="submit" value="Prestar">
</form>

<?php
  $tituloDeLaPagina = "Prestar Libro";
  $contenidoDeLaPagina = ob_get_contents();
  ob_end_clean();

  include("master.php");
?>
