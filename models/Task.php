<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class Task
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
	public function insertar($nombre, $descripcion, $usuario, $localidad, $secretaria, $tipo, $estado, $fechavencimiento)
	{
		try {

			$sql = "INSERT INTO task(nombre,descripcion,usuario,localidad,secretaria,tipo,estado,fechavencimiento)VALUES(?, ?, ?, ?, ?, ?, ?, ?);";
			$params = array($nombre, $descripcion, $usuario, $localidad, $secretaria, $tipo, $estado, $fechavencimiento);
			$result = $this->ejecutarConsulta($sql, $params);
			$idusuarionew = $result['last_id'];
			$this->insertarBitacora($usuario, $idusuarionew, "Ingreso caso: $nombre");
			return $idusuarionew;
		} catch (Exception $e) {
			throw $e;
		}
	}

	//Implementamos un método para editar registros
	public function editar($id, $nombre, $descripcion, $localidad, $secretaria, $tipo, $fechavencimiento, $estado, $idUser)
	{
		$this->insertarBitacora($idUser, $id, "Actuailizo caso: $nombre");
		$sql = "UPDATE task SET nombre='$nombre',descripcion='$descripcion',localidad='$localidad',secretaria='$secretaria',tipo='$tipo',fechavencimiento='$fechavencimiento',estado='$estado' WHERE idtask='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id, $idUser)
	{
		$sql = "UPDATE task SET eliminado=0 WHERE idtask='$id'";
		$this->insertarBitacora($idUser, $id, "Elimino el caso no: $id");
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id)
	{
		$sql = "SELECT * FROM task WHERE eliminado = 1 and idtask='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrarSecretaria()
	{
		$sql = "SELECT * FROM usuario WHERE rol in(3) and estado = 1";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT * FROM task WHERE eliminado = 1 ORDER BY idtask DESC";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para insertar registros
	public function insertarFile($nombre, $idTask, $idUser)
	{
		$sql = "INSERT INTO files(nombre,idtask)VALUES(?, ?);";
		$params = array($nombre, $idTask);
		$result = $this->ejecutarConsulta($sql, $params);
		$idReg = $result['last_id'];
		$this->insertarBitacora($idUser, $idTask, "Subio adjunto: $nombre al caso: $idTask");
		return $idReg;
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrarCategoria($id)
	{
		$sql = "SELECT * FROM categoria WHERE id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrarUsuario($id)
	{
		$sql = "SELECT * FROM usuario WHERE idusuario='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementamos un método para insertar registros
	public function insertarBitacora($idUser, $idtask, $accion)
	{
		try {
			$sql = "INSERT INTO bitacora(idusuario,idtask,accion)VALUES(?, ?, ?);";
			$params = array($idUser, $idtask, $accion);
			$result = $this->ejecutarConsulta($sql, $params);
			$idusuarionew = $result['last_id'];
			return $idusuarionew;
		} catch (Exception $e) {
			throw $e;
		}
	}

	//Implementar un método para listar los registros
	public function bitacora($idtask)
	{
		$sql = "SELECT b.id, b.accion, b.idusuario, b.datecreated, u.idusuario as usuario, u.nombre, b.idtask
		FROM bitacora b
		INNER JOIN usuario u ON u.idusuario = b.idusuario
		WHERE b.idtask = $idtask ORDER BY b.id DESC";
		return ejecutarConsulta($sql);
	}
}
