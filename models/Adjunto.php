<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class Adjunto
{
	//Implementamos nuestro constructor
	public function __construct() {}

	//Implementamos un método para desactivar categorías
	public function desactivar($id)
	{
		$sql = "UPDATE files SET estado = 0 WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id)
	{
		$sql = "SELECT * FROM files WHERE estado = 1 AND id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar($rol, $tasks)
	{
		$sql = "SELECT * FROM files WHERE estado = 1 ORDER BY id DESC";
		if ($rol) {
			$taskSeparated = implode("; ", $tasks);
			$sql = "SELECT * FROM files WHERE estado = 1 AND idtask in ($taskSeparated) ORDER BY id DESC";
		}
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listarTasks($id)
	{
		$sql = "SELECT idtask FROM task WHERE eliminado = 1 AND secretaria = $id";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrarTask($id)
	{
		$sql = "SELECT * FROM files WHERE estado = 1 AND idTask='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrarFile($id)
	{
		$sql = "SELECT * FROM files WHERE id = $id";
		return ejecutarConsultaSimpleFila($sql);
	}
}
