<?php

class enterenamientoAccesoDatos
{
	
	function __construct()
    {
    }


    function obtenerEntrenamientos()
	{
		$conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
 		mysqli_select_db($conexion, 'entrenaOnlineDB');
		
		$consulta = mysqli_prepare($conexion, "
		select id , nombre, descripcion, parteCuerpo from entrenamientos ;" );
        $consulta->execute();
        $result = $consulta->get_result();
        $entrenamientos = array();
       	while($myrow = $result->fetch_assoc())
		{
			array_push($entrenamientos,$myrow);
	   	};
		
		return $entrenamientos;
	
	}

	function createTablaEntrenamientos($nombre, $diaSemana, $ejerUno, $ejerDos, $ejerTres, $ejerCuatro, $ejerCinco, $idUsuario)
    {
		
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno())
        {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($conexion, 'entrenaOnlineDB');
        
        $consulta = mysqli_prepare($conexion, "INSERT INTO ListaEntrenoDia (nombre, entrenamiento1, entrenamiento2, entrenamiento3, entrenamiento4, entrenamiento5, diaSemana, clienteId)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
        
        mysqli_stmt_bind_param($consulta, "sssssssi", $nombre, $ejerUno, $ejerDos, $ejerTres, $ejerCuatro, $ejerCinco, $diaSemana, $idUsuario);
        
		$consulta->execute();
    }

	

	}
	