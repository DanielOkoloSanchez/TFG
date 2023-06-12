<?php

class adminAccesoDatos
{
	
	function __construct()
    {
    }


   

	
	function createAdmin( $nombre, $primerApellido,$segundoApellido,$fechaNacimiento,$cargo)
	{
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
		unset($_COOKIE['IdUsuarioCookie']);
        
		
	}

	


	

	}


 

