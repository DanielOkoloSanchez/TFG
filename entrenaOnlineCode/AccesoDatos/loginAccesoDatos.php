<?php

class LoginAccesoDatos
{
	
	function __construct()
    {
    }



    function verificar($usuario,$clave)
    {
        $conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
        mysqli_select_db($conexion, 'entrenaOnlineDB');
        $consulta = mysqli_prepare($conexion, "select nombre,clave,rango from usuario where nombre = ?;");
        $sanitized_usuario = mysqli_real_escape_string($conexion, $usuario);       
        $consulta->bind_param("s", $sanitized_usuario);
        $consulta->execute();
        $res = $consulta->get_result();


        if ($res->num_rows==0)
        {
            return 'NOT_FOUND';
        }

        if ($res->num_rows>1) //El nombre de usuario debería ser único.
        {
            return 'NOT_FOUND';
        }

        $myrow = $res->fetch_assoc();
        $x = $myrow['clave'];
        if (password_verify($clave, $x))
        {
            return $myrow['rango'];
        } 
        else 
        {
            return 'NOT_FOUND';
        }
    }

    function obtenerUserId($usuario)
	{
		$conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
 		mysqli_select_db($conexion, 'entrenaOnlineDB');
		
		$consulta = mysqli_prepare($conexion, "SELECT id  from usuario where nombre = ? ;" );
        $sanitized_usuario = mysqli_real_escape_string($conexion, $usuario);       
        $consulta->bind_param("s", $sanitized_usuario);
        $consulta->execute();
        $result = $consulta->get_result();
        
        $myrow = $result->fetch_assoc();
        $x = $myrow['id'];
		
		return $x;
	}
	

	}

 

