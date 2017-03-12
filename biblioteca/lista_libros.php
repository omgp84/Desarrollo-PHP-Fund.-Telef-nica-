<?php
  include_once("libros_modelo.php");

  $libros = obtenerTodosLosLibros();

  $disponible = "<span class='glyphicon glyphicon-ok' style='color: green'></span>";
  $prestado = "<span class='glyphicon glyphicon-remove' style='color: red'></span>";

  ob_start();
?>

<div class="pull-right">
  <a href="nuevo_libro.php" class="btn btn-primary">Nuevo libro</a>
</div>

<h1>Lista de libros</h1>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Titulo</th>
      <th>Disponible</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($libros as $libro): ?>
        <tr>
          <td><?= $libro["titulo"] ?></td>
          <td><?= $libro["usuario_id"] != NULL ? $prestado : $disponible ?></td>
          <td>
            <a href="ver_libro.php?id=<?= $libro["id"] ?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-eye-open"></span> Ver</a>
            <a href="#" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
            <a href="eliminar_libro.php?id=<?= $libro["id"] ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span> Eliminar</a>
            <a href="prestar_libro.php?libro=<?= $libro["id"] ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-log-out"></span> Prestar</a>
          </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
  $tituloDeLaPagina = "Lista de libros";
  $contenidoDeLaPagina = ob_get_contents();
  ob_end_clean();

  include("master.php");
?>
