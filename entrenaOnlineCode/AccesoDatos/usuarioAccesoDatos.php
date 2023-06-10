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


	function obtenerUsuarios()
	{
		$conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
 		mysqli_select_db($conexion, 'entrenaOnlineDB');
		
		$consulta = mysqli_prepare($conexion, "select id,nombre,rango from usuario;" );
        $consulta->execute();
        $result = $consulta->get_result();
        $usuarios = array();
       	while($myrow = $result->fetch_assoc())
		{
			array_push($usuarios,$myrow);
	   	};

		return $usuarios;
	
	}

	function obtenerClientes()
	{
		$conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
 		mysqli_select_db($conexion, 'entrenaOnlineDB');
		
		$consulta = mysqli_prepare($conexion, "select id,nombre,rango from usuario where rango = 'client' ;" );
        $consulta->execute();
        $result = $consulta->get_result();
        $clientes = array();
       	while($myrow = $result->fetch_assoc())
		{
			array_push($clientes,$myrow);
	   	};

		return $clientes;
	
	}

	function  deleteUsuarioCliente($id)
	{
		$conexion = mysqli_connect('localhost', 'root', '1234');
		if (mysqli_connect_errno())
		{
			echo "Error al conectar a MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($conexion, 'entrenaOnlineDB');
	
		$consulta = "
			DELETE FROM usuario WHERE id = $id;
		";
	
		if (mysqli_multi_query($conexion, $consulta)) {
			
			echo "Entrenamiento eliminado exitosamente.";
		} else {
			echo "Error al eliminar el entrenamiento: " . mysqli_error($conexion);
		}
	
		mysqli_close($conexion);
	}
	


	
	}
	
	

 ?>

