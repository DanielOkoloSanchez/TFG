<?php

class adminAccesoDatos
{
	
	function __construct()
    {
    }


	function obtenerAdminInfo($idUsuario)
	{
		$conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
 		mysqli_select_db($conexion, 'entrenaOnlineDB');
		
		$consulta = mysqli_prepare($conexion, "SELECT id , nombre , primerApellido , cargo from empleado where usuario_id = ? ;" );
        $consulta->bind_param("i", $idUsuario);
        $consulta->execute();
        $result = $consulta->get_result();
        
        $empleado = $result->fetch_assoc();

		return $empleado;
	}
   

	
	function createAdmin( $nombre, $primerApellido,$segundoApellido,$fechaNacimiento,$cargo)
	{
		
		
		try {
			$conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
 		
        mysqli_select_db($conexion, 'entrenaOnlineDB');
		$consulta = mysqli_prepare($conexion, "insert into empleado(nombre, primerApellido,segundoApellido,fechaNacimiento,cargo,usuario_id) values (?,?,?,?,?,?);");
		$sanetizedNombre = mysqli_real_escape_string($conexion, $nombre);
		$sanetizedPrimerApellido = mysqli_real_escape_string($conexion, $primerApellido);
		$sanetizedSegundoApellido = mysqli_real_escape_string($conexion, $segundoApellido);
        $consulta->bind_param("sssssi", $sanetizedNombre,$sanetizedPrimerApellido,$sanetizedSegundoApellido,$fechaNacimiento,$cargo, $_COOKIE["IdUsuarioCookie"] );
        $res = $consulta->execute();
		
		} catch (mysqli_sql_exception $e) {
			
			throw new Exception("Error al ejecutar la consulta: " . $e->getMessage());
			
		}
        
		
	}

	


	

	}


 

