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

	function obtenerAdmins()
	{
		$conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
 		mysqli_select_db($conexion, 'entrenaOnlineDB');
		
		$consulta = mysqli_prepare($conexion, "select id,nombre,rango from usuario where rango = 'admin' ;" );
        $consulta->execute();
        $result = $consulta->get_result();
        $admins = array();
       	while($myrow = $result->fetch_assoc())
		{
			array_push($admins,$myrow);
	   	};

		return $admins;
	
	}


	function updateUsuarioCliente($objetivo, $peso, $idCliente)
{
    $conexion = mysqli_connect('localhost', 'root', '1234');
    if (mysqli_connect_errno()) {
        echo "Error al conectar a MySQL: " . mysqli_connect_error();
    }
    mysqli_select_db($conexion, 'entrenaOnlineDB');

    $objetivo = mysqli_real_escape_string($conexion, $objetivo);
    $peso = mysqli_real_escape_string($conexion, $peso);
    $idCliente = mysqli_real_escape_string($conexion, $idCliente);

    $consulta = "
        UPDATE cliente
        SET peso = '$peso',
            objetivo = '$objetivo'
        WHERE usuario_id = '$idCliente';
    ";

    if (mysqli_multi_query($conexion, $consulta)) {
        echo "Entrenamiento actualizado exitosamente.";
    } else {
        echo "Error al actualizar el entrenamiento: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}



function updateObjetivo($objetivo, $idCliente)
{
    $conexion = mysqli_connect('localhost', 'root', '1234');
    if (mysqli_connect_errno()) {
        echo "Error al conectar a MySQL: " . mysqli_connect_error();
    }
    mysqli_select_db($conexion, 'entrenaOnlineDB');

    $objetivo = mysqli_real_escape_string($conexion, $objetivo);
    $idCliente = mysqli_real_escape_string($conexion, $idCliente);

    $consulta = "
        UPDATE cliente
        SET objetivo = '$objetivo'
		WHERE usuario_id = '$idCliente';
    ";

    if (mysqli_multi_query($conexion, $consulta)) {
        echo "Objetivo actualizado exitosamente.";
    } else {
        echo "Error al actualizar el objetivo: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}



	function  deleteUsuario($id)
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

