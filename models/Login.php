<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class Login
{
	//Implementamos nuestro constructor
	public function __construct() {}


	private function ejecutarConsulta($sql, $params,)
	{
		try {
			require_once "../config/global.php";
			$conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
			$stmt = $conexion->prepare($sql);

			if (!$stmt) {
				throw new Exception("Error preparing statement: " . $conexion->error);
			}
			call_user_func_array([$stmt, 'bind_param'], array_merge([str_repeat('s', count($params))], $params));
			$stmt->execute();
			if ($stmt->error) {
				throw new Exception("Error executing query: " . $stmt->error);
			}
			return array('stmt' => $stmt, 'last_id' => $conexion->insert_id);
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
			return false;
		}
	}

	//Implementamos un método para insertar registros
	public function insertar($nombre, $telefono, $email, $cargo, $login, $clave, $imagen, $permisos, $rol)
	{
		$sql = "INSERT INTO usuario (nombre,telefono,email,cargo,login,clave,imagen,rol)VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
		$params = array($nombre, $telefono, $email, $cargo, $login, $clave, $imagen, $rol);
		$result = $this->ejecutarConsulta($sql, $params);
		$idusuarionew = $result['last_id'];
		$num_elementos = 0;
		$sw = true;
		while ($num_elementos < count($permisos)) {
			$sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES(?, ?)";
			$params = array($idusuarionew, $permisos[$num_elementos]);
			$result = $this->ejecutarConsulta($sql_detalle, $params);
			if ($result['stmt']->affected_rows == 0) {
				$sw = false;
				break;
			}
			$num_elementos = $num_elementos + 1;
		}

		return $sw;
	}

	//Implementamos un método para editar registros
	public function editar($idusuario, $nombre, $telefono, $email, $cargo, $login, $clave, $imagen, $permisos, $rol)
	{
		$sql = "UPDATE usuario SET nombre='$nombre',telefono='$telefono',email='$email',cargo='$cargo',login='$login',clave='$clave',imagen='$imagen',rol='$rol' WHERE idusuario='$idusuario'";
		ejecutarConsulta($sql);
		$sqldel = "DELETE FROM usuario_permiso WHERE idusuario='$idusuario'";
		ejecutarConsulta($sqldel);
		$num_elementos = 0;
		$sw = true;
		if (isset($permisos)) {
			while ($num_elementos < count($permisos)) {
				$sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idusuario', '$permisos[$num_elementos]')";
				ejecutarConsulta($sql_detalle) or $sw = false;
				$num_elementos = $num_elementos + 1;
			}
		}

		return $sw;
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idusuario)
	{
		$sql = "UPDATE usuario SET estado=0 WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idusuario)
	{
		$sql = "UPDATE usuario SET estado='1' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idusuario)
	{
		$sql = "SELECT * FROM usuario WHERE estado = 1 and idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT * FROM usuario WHERE estado = 1 ORDER BY idusuario DESC";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para listar los permisos marcados
	public function listarmarcados($idusuario)
	{
		$sql = "SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Función para verificar el acceso al sistema
	public function verificar($login, $clave)
	{
		$sql = "SELECT u.idusuario,u.nombre,u.telefono,u.email,u.cargo,u.imagen,u.login, u.clave, u.rol FROM usuario u
		WHERE u.login='$login' AND u.clave='$clave' AND estado = 1";
		return ejecutarConsulta($sql);
	}

	public function select()
	{
		$sql = "SELECT idusuario, concat(nombre,' ',cargo) as nombres  FROM usuario where estado=1;";
		return ejecutarConsulta($sql);
	}
}
