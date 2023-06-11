<?php

class enterenamientoAccesoDatos
{
	
	function __construct()
    {
    }

    function InsertlistaEntreno($dia,$clienteId,$listaEntreno)
    {
		
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno())
        {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($conexion, 'entrenaOnlineDB');
        
       
        $consulta = mysqli_prepare($conexion, "INSERT INTO ListaEntrenoDia (diaSemana,clienteId,listaEntrenosId)
        VALUES (?, ?, ?);");
        
        mysqli_stmt_bind_param($consulta, "sii",$dia,$clienteId,$listaEntreno);
        
		$consulta->execute();
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
		SELECT DISTINCT led.id, led.diaSemana, led.clienteId, led.listaEntrenosId, le.nombre AS nombreEntreno, le.id AS idEntreno
        FROM ListaEntrenoDia led
        JOIN ListaEntrenos le ON led.listaEntrenosId = le.id
        JOIN Entrenamientos e ON e.id IN (le.entrenamiento1, le.entrenamiento2, le.entrenamiento3, le.entrenamiento4, le.entrenamiento5)
        where clienteId =  ".$clienteId.";" );
        $consulta->execute();
        $result = $consulta->get_result();
        $entrenamientos = array();
       	while($myrow = $result->fetch_assoc())
		{
			array_push($entrenamientos,$myrow);
	   	};
		
		return $entrenamientos;
	
	}



    function getTablaEjerciciosById($id)
    {
        $conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
 		mysqli_select_db($conexion, 'entrenaOnlineDB');
		
		$consulta = mysqli_prepare($conexion, "
		SELECT le.id, le.nombre, e1.nombre AS nombreEntreno1, e1.descripcion AS descripcionEntreno1, 
                    e2.nombre AS nombreEntreno2, e2.descripcion AS descripcionEntreno2, 
                    e3.nombre AS nombreEntreno3, e3.descripcion AS descripcionEntreno3, 
                    e4.nombre AS nombreEntreno4, e4.descripcion AS descripcionEntreno4, 
                    e5.nombre AS nombreEntreno5, e5.descripcion AS descripcionEntreno5
            FROM listaentrenos le
                    JOIN entrenamientos e1 ON le.entrenamiento1 = e1.id
                    JOIN entrenamientos e2 ON le.entrenamiento2 = e2.id
                    JOIN entrenamientos e3 ON le.entrenamiento3 = e3.id
                    JOIN entrenamientos e4 ON le.entrenamiento4 = e4.id
                    JOIN entrenamientos e5 ON le.entrenamiento5 = e5.id 
                    where le.id = $id; ");
        $consulta->execute();
        $result = $consulta->get_result();
        $entrenamientos = array();
       return $result->fetch_assoc();
		
	
	}
    

    function obtenerListaEntrenos()
	{
		$conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
 		mysqli_select_db($conexion, 'entrenaOnlineDB');
		
		$consulta = mysqli_prepare($conexion, "
		SELECT id, nombre
        FROM ListaEntrenos; ");
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

    function deleteTablaEjer($id)
{
    $conexion = mysqli_connect('localhost', 'root', '1234');
    if (mysqli_connect_errno())
    {
        echo "Error al conectar a MySQL: " . mysqli_connect_error();
    }
    mysqli_select_db($conexion, 'entrenaOnlineDB');

    $consulta = "
        
        DELETE FROM listaentrenodia WHERE id = $id;
    ";

    if (mysqli_multi_query($conexion, $consulta)) {
        
        echo "Entrenamiento eliminado exitosamente.";
    } else {
        echo "Error al eliminar el entrenamiento: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);



	}

}


