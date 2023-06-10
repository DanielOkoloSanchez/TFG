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


	function obtenerTablaEntrenamientos($clienteId)
	{
		$conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
 		mysqli_select_db($conexion, 'entrenaOnlineDB');
		
		$consulta = mysqli_prepare($conexion, "
		select id , nombre , diaSemana from ListaEntrenoDia where clienteId = ".$clienteId.";" );
        $consulta->execute();
        $result = $consulta->get_result();
        $entrenamientos = array();
       	while($myrow = $result->fetch_assoc())
		{
			array_push($entrenamientos,$myrow);
	   	};
		
		return $entrenamientos;
	
	}


	function createTablaEntrenamientos($nombre, $ejerUno, $ejerDos, $ejerTres, $ejerCuatro, $ejerCinco)
    {
		
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno())
        {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($conexion, 'entrenaOnlineDB');
        
        $consulta = mysqli_prepare($conexion, "INSERT INTO ListaEntrenos (nombre, entrenamiento1, entrenamiento2, entrenamiento3, entrenamiento4, entrenamiento5)
        VALUES (?, ?, ?, ?, ?, ?);");
        
        mysqli_stmt_bind_param($consulta, "siiiii", $nombre, $ejerUno, $ejerDos, $ejerTres, $ejerCuatro, $ejerCinco);
        
		$consulta->execute();
    }

	function createEntrenamiento($nombre,$parteCuerpo,$descripcion)
    {
		
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno())
        {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($conexion, 'entrenaOnlineDB');
        
        $consulta = mysqli_prepare($conexion, "INSERT INTO entrenamientos (nombre, parteCuerpo, descripcion)
        VALUES (?, ?, ?);");
        
        mysqli_stmt_bind_param($consulta, "sss", $nombre, $parteCuerpo , $descripcion);
        
		$consulta->execute();
    }
	
	function deleteEntrenamiento($id)
{
    $conexion = mysqli_connect('localhost', 'root', '1234');
    if (mysqli_connect_errno())
    {
        echo "Error al conectar a MySQL: " . mysqli_connect_error();
    }
    mysqli_select_db($conexion, 'entrenaOnlineDB');

    $consulta = "
        DELETE FROM ListaEntrenos WHERE entrenamiento1 = $id OR entrenamiento2 = $id OR entrenamiento3 = $id OR entrenamiento4 = $id OR entrenamiento5 = $id;
        DELETE FROM entrenamientos WHERE id = $id;
    ";

    if (mysqli_multi_query($conexion, $consulta)) {
        
        echo "Entrenamiento eliminado exitosamente.";
    } else {
        echo "Error al eliminar el entrenamiento: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);



	}

}
	