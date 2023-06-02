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


	 function obtenerDietasUsuario($idCliente)
	{
		$conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
 		mysqli_select_db($conexion, 'entrenaOnlineDB');
		
		$consulta = mysqli_prepare($conexion, "
		select id,nombre,desayuno,meriendaMedioDia,comida,meriendaTarde,cena from  alimentacionDelDia
		WHERE usuario_id =".$idCliente." ;" );
        $consulta->execute();
        $result = $consulta->get_result();
        $dietas = array();
       	while($myrow = $result->fetch_assoc())
		{
			array_push($dietas,$myrow);
	   	};
		
		return $dietas;
	
	}

	function createAlimentacionDelDia($nombre,$desayuno,$meriendaMedioDia,$comida,$meriendaTarde, $cena,$idCliente)
    {
		
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno())
        {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($conexion, 'entrenaOnlineDB');
		$sanetizedNombre = mysqli_real_escape_string($conexion, $nombre);
        $consulta = mysqli_prepare($conexion, "INSERT INTO  alimentacionDelDia (nombre,desayuno, meriendaMedioDia, comida, meriendaTarde, cena,usuario_id)
        VALUES (?, ?, ?, ?,?,?,?);");
       
        mysqli_stmt_bind_param($consulta, "siiiiii", $sanetizedNombre, $desayuno, $meriendaMedioDia, $comida, $meriendaTarde, $cena,$idCliente);
        
		$consulta->execute();
    }

	function createHorarioComidas($nombre,$comidaLunes,$comidaMartes,$comidaMiercoles,$comidaJueves, $comidaViernes,$comidaSabado,$comidaDomingo,$idCliente)
    {
		
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno())
        {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($conexion, 'entrenaOnlineDB');
		$sanetizedNombre = mysqli_real_escape_string($conexion, $nombre);
        $consulta = mysqli_prepare($conexion, "INSERT INTO  horarioAlimentos (nombreHorario,HorioComidaLunes, HorioComidaMartes, HorioComidaMiercoles, HorioComidaJueves, HorioComidaViernes,HorioComidaSabado,HorioComidaDomingo,clienteId)
        VALUES (?, ?, ?, ?,?,?,?,?,?);");
       
        mysqli_stmt_bind_param($consulta, "siiiiiiii", $sanetizedNombre, $comidaLunes, $comidaMartes, $comidaMiercoles, $comidaJueves, $comidaViernes ,$comidaSabado,$comidaDomingo,$idCliente);
        
		$consulta->execute();
    }


	function obtenerHorarioComidas($idCliente)
    {
		
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno())
        {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($conexion, 'entrenaOnlineDB');
		
	
		$consulta = mysqli_prepare($conexion,"
		SELECT
		HA.id,
		HA.nombreHorario,
		ADL.id AS idLunes,
		ADL.nombre AS nombreLunes,
		ADM.id AS idMartes,
		ADM.nombre AS nombreMartes,
		ADMie.id AS idMiercoles,
		ADMie.nombre AS nombreMiercoles,
		ADJ.id AS idJueves,
		ADJ.nombre AS nombreJueves,
		ADV.id AS idViernes,
		ADV.nombre AS nombreViernes,
		ADS.id AS idSabado,
		ADS.nombre AS nombreSabado,
		ADDo.id AS idDomingo,
		ADDo.nombre AS nombreDomingo
	  FROM
		horarioAlimentos HA
		JOIN alimentacionDelDia ADL ON HA.HorioComidaLunes = ADL.id
		JOIN alimentacionDelDia ADM ON HA.HorioComidaMartes = ADM.id
		JOIN alimentacionDelDia ADMie ON HA.HorioComidaMiercoles = ADMie.id
		JOIN alimentacionDelDia ADJ ON HA.HorioComidaJueves = ADJ.id
		JOIN alimentacionDelDia ADV ON HA.HorioComidaViernes = ADV.id
		JOIN alimentacionDelDia ADS ON HA.HorioComidaSabado = ADS.id
		JOIN alimentacionDelDia ADDo ON HA.HorioComidaDomingo = ADDo.id;
	   WHERE clienteId =".$idCliente." ;"

	);
		
        $consulta->execute();
        $result = $consulta->get_result();
        $horarios = array();
       	while($myrow = $result->fetch_assoc())
		{
			array_push($horarios,$myrow);
	   	};
		
		return $horarios;
	
	}



	

	

	}
	