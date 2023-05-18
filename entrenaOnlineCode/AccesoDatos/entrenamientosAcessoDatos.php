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
	

	}