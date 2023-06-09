<?php

class usuarioAccesoDatos
{
	
	function __construct()
    {
    }


	function insertar($usuario,$rango,$clave)
	{
		$conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
 		
        mysqli_select_db($conexion, 'entrenaOnlineDB');
		$consulta = mysqli_prepare($conexion, "insert into usuario(nombre,clave,rango) values (?,?,?);");
        $hash = password_hash($clave, PASSWORD_DEFAULT);
		$sanetizedNombre = mysqli_real_escape_string($conexion, $usuario);
        $consulta->bind_param("sss", $sanetizedNombre,$hash,$rango);
        $res = $consulta->execute();
        
		$idUsuario = mysqli_insert_id($conexion);

       
        setcookie("IdUsuarioCookie", $idUsuario + 1);
	}
	

	}


 

