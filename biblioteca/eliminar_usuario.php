<?php
  include_once("usuario_modelo.php");
  include("login_snippet.php");

  if (!empty($_GET["id"])) {
    $resultado = eliminarUsuarioPorId($_GET["id"]);
    if ($resultado == true) {
      header("Location: lista_usuarios.php");
    }
  } else {
    header("Location: lista_usuarios.php");
  }
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Biblioteca</title>
    <meta charset="UTF-8">
    <meta name="description" content="Descripción para buscadores" />
    <!--
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="index, follow" />
    <meta name="google" content="nositelinkssearchbox" />
    <meta name="google" content="notranslate" />
    -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <?php if ($resultado == false): ?>
      <p class="alert alert-danger">No se ha encontrado ese usuario.</p>
    <?php endif; ?>
  </body>
</html>
