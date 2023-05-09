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
	

	}


 