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
		
		$consulta = mysqli_prepare($conexion, "SELECT id , nombre , primerApellido , fechaNacimiento , altura , peso , complexion , objetivo    from cliente where usuario_id = ? ;" );
        $consulta->bind_param("i", $idUsuario);
        $consulta->execute();
        $result = $consulta->get_result();
        
        $clientes = $result->fetch_assoc();

        
           
        

		return $clientes;
	}
	

	}


 

