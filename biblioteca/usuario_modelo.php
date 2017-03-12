<?php
  include_once("conexion.php");

  function obtenerTodosLosUsuarios() {
    $consulta = "SELECT * FROM usuarios";
    $usuarios = hacerListado($consulta);
    return $usuarios;
  }

  function obtenerLibrosPorUsuario($id) {
    $consulta = "SELECT * FROM libros WHERE usuario_id = $id;";
    $libros = hacerListado($consulta);
    return $libros;
  }

  function obtenerTodosLosUsuariosConNumLibros() {
    $consulta = "SELECT u.id, u.nombre, u.email, COUNT(l.id) AS librosprestados FROM usuarios u LEFT JOIN libros l ON u.id = l.usuario_id GROUP BY u.id";
    $usuarios = hacerListado($consulta);
    return $usuarios;
  }

  function obtenerUsuarioPorId($id) {
    $consulta = "SELECT * FROM usuarios WHERE id = '$id'";
    $usuario = hacerListado($consulta);
    if (count($usuario) > 0) {
      return $usuario[0];
    } else {
      return false;
    }
  }

  function obtenerUsuarioPorEmail($email) {
    $consulta = "SELECT * FROM usuarios WHERE email = '$email'";
    $usuario = hacerListado($consulta);
    if (count($usuario) > 0) {
      return $usuario[0];
    } else {
      return false;
    }
  }

  function eliminarUsuarioPorId($id) {
    $consulta = "DELETE FROM usuarios WHERE id = '$id'";
    $resultado = ejecutarConsulta($consulta);
    return $resultado;
  }

  function guardarUsuario($datos) {
    $consulta = consultaInsert($datos, "usuarios");
    $resultado = ejecutarConsulta($consulta);
    return $resultado;
  }

  function obtenerUsuarioPorEmailYContrasena($email, $contrasena) {
    $consulta = "SELECT * FROM usuarios WHERE email = '$email' AND contrasena = '$contrasena'";
    $usuario = hacerListado($consulta);
    if (count($usuario) > 0) {
      return $usuario[0];
    } else {
      return false;
    }
  }

  function cifrarContrasena($contrasena) {
    return sha1($contrasena);
  }

  function comprobarErroresUsuario($datos) {
    if (empty($datos["nombre"])) {
      return "Debe completar el nombre";
    }

    if (empty($datos["email"])) {
      return "Debe completar el correo electrónico";
    }

    if (empty($datos["contrasena"])) {
      return "Debe completar la contraseña";
    }

    if ($datos["contrasena"] !=  $datos["contrasena2"]) {
      return "Las contraseñas no coinciden";
    }

    if (obtenerUsuarioPorEmail($datos["email"]) != false) {
      return "Ese correo electrónico ya está registrado";
    }

    return false;
  }
?>
