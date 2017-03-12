<?php
  include_once("usuario_modelo.php");
  include("login_snippet.php");

  $usuarios = obtenerTodosLosUsuariosConNumLibros();
?>

<?php
  ob_start();
?>

      <div class="pull-right">
        <a href="nuevo_usuario.php" class="btn btn-primary">Nuevo usuario</a>
      </div>

      <h1>Lista de usuarios</h1>

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Préstamos</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($usuarios as $usuario): ?>
              <tr>
                <td><?= $usuario["nombre"] ?></td>
                <td><?= $usuario["email"] ?></td>
                <td><?= empty($usuario["librosprestados"]) ? "Ninguno" : $usuario["librosprestados"] ?></td>
                <td>
                  <a href="ver_usuario.php?id=<?= $usuario["id"] ?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-eye-open"></span> Ver</a>
                  <a href="#" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                  <a href="eliminar_usuario.php?id=<?= $usuario["id"] ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span> Eliminar</a>
                </td>
              </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

<?php
  $contenidoDeLaPagina = ob_get_contents();
  ob_end_clean();

  include("master.php");
?>
