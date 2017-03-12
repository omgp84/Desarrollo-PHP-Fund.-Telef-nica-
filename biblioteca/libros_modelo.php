<?php
  include_once("conexion.php");

  function obtenerTodosLosLibros() {
    $consulta = "SELECT * FROM libros";
    $libros = hacerListado($consulta);
    return $libros;
  }

  function obtenerLibroPorId($id) {
    $consulta = "SELECT * FROM libros WHERE id = '$id'";
    $libros = hacerListado($consulta);
    if (count($libros) > 0) {
      return $libros[0];
    } else {
      return false;
    }
  }

  function eliminarLibroPorId($id) {
    $consulta = "DELETE FROM libros WHERE id = '$id'";
    $resultado = ejecutarConsulta($consulta);
    return $resultado;
  }

  function guardarLibro($datos) {
    $consulta = consultaInsert($datos, "libros");
    $resultado = ejecutarConsulta($consulta);
    return $resultado;
  }

  function comprobarErroresLibro($datos) {
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

    if (obtenerLibroPorEmail($datos["email"]) != false) {
      return "Ese correo electrónico ya está registrado";
    }

    return false;
  }
?>
