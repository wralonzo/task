<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Permiso
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	
	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM permiso WHERE estado = 1 ORDER BY idpermiso ASC";
		return ejecutarConsulta($sql);		
	}

}

?>