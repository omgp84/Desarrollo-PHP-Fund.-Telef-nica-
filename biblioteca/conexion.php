<?php
	function hacerListado($consulta) {
		// Estos son los datos necesarios para conectarse con la
		// base de datos.
		$servidor = "localhost";
		$usuario = "root";
		$contrasena = "";
		$baseDeDatos = "biblioteca";

		// Crea una conexión con la base de datos.
		$enlace = mysqli_connect($servidor, $usuario, $contrasena,      $baseDeDatos);

		// Si ha habido un error, abandona la ejecución.
		if (mysqli_connect_errno()) {
			die("Error de conexión: " . mysqli_connect_error());
		}

		// Con esta consulta se evita que aparezcan caracteres
		// extraños en los resultados.
		$query = "SET NAMES 'utf8'";
		mysqli_query($enlace, $query);

		// Ejecuta la consulta.
		$resultado = mysqli_query($enlace, $consulta);

		// Creamos un array para guardar los datos de una forma
		// más manejable.
		$listado = [];

		if ($resultado) {
			// Este bucle toma en la variable $fila uno de los registros
			// (elementos) recuperados en cada repetición.
			// Si se añadieran directamente los datos al array $listado,
			// siempre se terminaría añadiendo un elemento vacío.
			while ($fila = mysqli_fetch_array($resultado, MYSQL_ASSOC)) {
				// Esto añade al array $listado los datos de un alumno
				// que están dentro de la variable $fila.
				$listado[] = $fila;
			}
		}

		// Libera los recursos utilizados por la variable $resultado.
		mysqli_free_result($resultado);

		// Para terminar, cerramos la conexión.
		mysqli_close($enlace);

		// Devolvemos los datos de los alumnos que hemos guardado
		// en $listado.
		return $listado;
	}

	function ejecutarConsulta($consulta) {
		// Estos son los datos necesarios para conectarse con la
		// base de datos.
		$servidor = "localhost";
		$usuario = "root";
		$contrasena = "";
		$baseDeDatos = "biblioteca";

		// Crea una conexión con la base de datos.
		$enlace = mysqli_connect($servidor, $usuario, $contrasena,      $baseDeDatos);

		// Si ha habido un error, abandona la ejecución.
		if (mysqli_connect_errno()) {
			die("Error de conexión: " . mysqli_connect_error());
		}

		// Con esta función se evita que aparezcan caracteres
		// extraños en los resultados.
		mysqli_set_charset($enlace, 'utf8');

		// Ejecuta la consulta.
		$resultado = mysqli_query($enlace, $consulta);

		// Para terminar, cerramos la conexión.
		mysqli_close($enlace);

		// Devolvemos elresultado
		return $resultado;
	}

	function consultaInsert($datos, $tabla) {
		/* Esto crea un array con los indices del array $datos */
		$indice = array_keys($datos);
		/* Esto crea un array con los valores del array $datos */
		$valores = array_values($datos);
		/* Implode es una función que une los elementos de un array con la cadena que se escriba como primer parámetro. Lo que hacemos a continuación es crear una consulta con los datos extraidos en las líneas anteriores */
		$consulta = "INSERT INTO $tabla (" . implode(", ", $indice) . ") VALUES ('" . implode("', '", $valores) . "')";
		return $consulta;
	}

	function consultaUpdate($datos, $tabla, $id) {
		$consulta = "UPDATE $tabla SET ";

		$parametros = [];
		foreach ($datos as $indice => $valor) {
			$parametros[] = "$indice = '$valor'";
		}

		$consulta .= implode(", ", $parametros);
		$consulta .= " WHERE id='" . $id . "'";

		return $consulta;
	}
?>
