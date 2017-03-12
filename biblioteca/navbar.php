<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="lista_libros.php">Libros</a></li>
        <li><a href="lista_usuarios.php">Usuarios</a></li>
      </ul>
      <div class="navbar-right">
        <?php
          if (isset($_SESSION["usuario"])) {
            echo "Bienvenido, " . $_SESSION["usuario"]["nombre"];
            echo "<a href='cerrar_sesion.php' class='btn btn-default navbar-btn'>Cerrar sesión</a>";
          } else {
            echo "<a href='index.php'class='btn btn-default navbar-btn'>Indentificarse</a>";
          }
        ?>
      </div>
    </div>
  </div>
</nav>
