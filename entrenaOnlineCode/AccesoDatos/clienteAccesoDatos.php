<?php

class ClienteAccesoDatos
{
	
	function __construct()
    {
    }


    function obtenerClienteInfo($idUsuario)
	{
		$conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
 		mysqli_select_db($conexion, 'entrenaOnlineDB');
		
		$consulta = mysqli_prepare($conexion, "SELECT id , nombre , primerApellido ,sexo, fechaNacimiento , altura , peso , complexion , objetivo    from cliente where usuario_id = ? ;" );
        $consulta->bind_param("i", $idUsuario);
        $consulta->execute();
        $result = $consulta->get_result();
        
        $clientes = $result->fetch_assoc();

		return $clientes;
	}

	
	function createCliente( $nombre, $primerApellido,$segundoApellido,$sexo,$fechaNacimiento, $altura, $peso, $complexion, $objetivo)
	{
		$conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
 		
        mysqli_select_db($conexion, 'entrenaOnlineDB');
		$consulta = mysqli_prepare($conexion, "insert into cliente(nombre, primerApellido,segundoApellido,sexo,fechaNacimiento, altura, peso, complexion, objetivo,usuario_id) values (?,?,?,?,?,?,?,?,?,?);");
		$sanetizedNombre = mysqli_real_escape_string($conexion, $nombre);
		$sanetizedPrimerApellido = mysqli_real_escape_string($conexion, $primerApellido);
		$sanetizedSegundoApellido = mysqli_real_escape_string($conexion, $segundoApellido);
        $consulta->bind_param("sssssddssi", $sanetizedNombre,$sanetizedPrimerApellido,$sanetizedSegundoApellido,$sexo,$fechaNacimiento, $altura, $peso, $complexion, $objetivo , $_COOKIE["IdUsuarioCookie"] );
        $res = $consulta->execute();
		unset($_COOKIE['IdUsuarioCookie']);
        
		
	}


	

	}


 

