<?php

class anunciosAccesoDatos
{
	
	function __construct()
    {
    }


    function obtenerAnuncios()
	{
		$conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
 		mysqli_select_db($conexion, 'entrenaOnlineDB');
		
		$consulta = mysqli_prepare($conexion, "
		SELECT anuncios.id, anuncios.nombre, anuncios.descripcion, anuncios.fecha as fechaCreacion, empleado.nombre as nombreEmpleado
		FROM anuncios
		INNER JOIN empleado ON anuncios.empleado_id = empleado.id;" );
        $consulta->execute();
        $result = $consulta->get_result();
        $anuncios = array();
       	while($myrow = $result->fetch_assoc())
		{
			array_push($anuncios,$myrow);
	   	};

		return $anuncios;
	
	}

	function createAnuncio($nombre,$descripcion,$fecha,$idEmpleado)
    {
		
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno())
        {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($conexion, 'entrenaOnlineDB');
		$sanetizedNombre = mysqli_real_escape_string($conexion, $nombre);
		$sanetizedDescripcion = mysqli_real_escape_string($conexion, $descripcion);
        $consulta = mysqli_prepare($conexion, "INSERT INTO anuncios (nombre, descripcion, fecha, empleado_id)
        VALUES (?, ?, ?, ?);");
       
        mysqli_stmt_bind_param($consulta, "sssi", $sanetizedNombre, $sanetizedDescripcion, $fecha,$idEmpleado);
        
		$consulta->execute();
    }

	function deleteAnuncio($id)
{
    $conexion = mysqli_connect('localhost', 'root', '1234');
    if (mysqli_connect_errno())
    {
        echo "Error al conectar a MySQL: " . mysqli_connect_error();
    }
    mysqli_select_db($conexion, 'entrenaOnlineDB');

    $consulta = "
        
        DELETE FROM anuncios WHERE id = $id;
    ";

    if (mysqli_multi_query($conexion, $consulta)) {
        
        echo "Entrenamiento eliminado exitosamente.";
    } else {
        echo "Error al eliminar el entrenamiento: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);



	}
	

	

	}


 