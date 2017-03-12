<?php
  include_once("usuario_modelo.php");
  include("login_snippet.php");

  if (!empty($_GET["libro"])) {
    $libro = $_GET["libro"];
    ejecutarConsulta("UPDATE libros SET usuario_id='NULL' WHERE id='$libro';");
  }

  $usuario = obtenerUsuarioPorId($_GET["id"]);
  $libros = obtenerLibrosPorUsuario($_GET["id"]);
?>

<?php
  ob_start();
?>

      <table class="table table-bordered table-striped">
        <tr>
          <th>Nombre:</th>
          <td><?= $usuario["nombre"] ?></td>
        </tr>
          <th>Correo electrónico:</th>
          <td><?= $usuario["email"] ?></td>
        </tr>
      </table>

      <h1>Libros prestados</h1>

      <?php if (count($libros) > 0): ?>
        <table class="table table-bordered table-striped">
          <tr>
            <th>Libro</th>
            <th>Acciones</th>
          </tr>
          <?php foreach ($libros as $libro): ?>
            <tr>
              <td><?= $libro["titulo"] ?></td>
              <td><a href="?id=<?= $usuario["id"] ?>&libro=<?= $libro["id"] ?>" class="btn btn-success"><span class="glyphicon glyphicon-log-in"></span> Devolver</a></td>
            </tr>
          <?php endforeach; ?>
        </table>
      <?php else: ?>
        <p class="alert alert-info">En estos momentos no tiene ningún libro</p>
      <?php endif; ?>

<?php
  $contenidoDeLaPagina = ob_get_contents();
  ob_end_clean();

  include("master.php");
?>
