<?php

class comidasAccesoDatos
{
	
	function __construct()
    {
    }


    function obtenerRecetas($idCliente)
	{
		$conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
 		mysqli_select_db($conexion, 'entrenaOnlineDB');
		
		$consulta = mysqli_prepare($conexion, "
		SELECT recetas.id, recetas.nombre, recetas.descripcion, recetas.calorias, recetas.tipo, recetas.momentoComida
		FROM recetas
		JOIN cliente ON recetas.tipo = cliente.objetivo
		WHERE cliente.usuario_id =".$idCliente." ;" );
        $consulta->execute();
        $result = $consulta->get_result();
        $recetas = array();
       	while($myrow = $result->fetch_assoc())
		{
			array_push($recetas,$myrow);
	   	};
		
		return $recetas;
	
	}

	function createAlimentacionDelDia($desayuno,$meriendaMedioDia,$comida,$meriendaTarde, $cena)
    {
		
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno())
        {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($conexion, 'entrenaOnlineDB');
        
        $consulta = mysqli_prepare($conexion, "INSERT INTO  alimentacionDelDia (desayuno, meriendaMedioDia, comida, meriendaTarde, cena)
        VALUES (?, ?, ?, ?,?);");
        
        mysqli_stmt_bind_param($consulta, "iiiii", $desayuno, $meriendaMedioDia, $comida, $meriendaTarde, $cena);
        
		$consulta->execute();
    }

	

	}
	