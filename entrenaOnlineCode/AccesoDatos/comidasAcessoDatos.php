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


	function obtenerAllRecetas()
	{
		$conexion = mysqli_connect('localhost','root','1234');
		if (mysqli_connect_errno())
		{
				echo "Error al conectar a MySQL: ". mysqli_connect_error();
		}
 		mysqli_select_db($conexion, 'entrenaOnlineDB');
		
		$consulta = mysqli_prepare($conexion, "
		SELECT recetas.id, recetas.nombre, recetas.descripcion, recetas.calorias, recetas.tipo, recetas.momentoComida
		FROM recetas;" );
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
		WHERE cliente_id =".$idCliente." ;" );
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
		$sanetizedNombre = mysqli_real_escape_string($conexion,$nombre );
        $consulta = mysqli_prepare($conexion, "INSERT INTO  alimentacionDelDia (nombre,desayuno, meriendaMedioDia, comida, meriendaTarde, cena,cliente_id)
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

	function createReceta($nombre,$descripcion,$calorias,$tipo,$momentoComida)
    {
		
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno())
        {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($conexion, 'entrenaOnlineDB');
		$sanetizedNombre = mysqli_real_escape_string($conexion, $nombre);
		$sanetizedDescripcion = mysqli_real_escape_string($conexion, $descripcion);
        $consulta = mysqli_prepare($conexion, "INSERT INTO recetas (nombre, descripcion, calorias, tipo, momentoComida)
        VALUES (?, ?, ?, ?,?);");
       
        mysqli_stmt_bind_param($consulta, "ssiss", $sanetizedNombre, $sanetizedDescripcion, $calorias,$tipo,$momentoComida);
        
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
		JOIN alimentacionDelDia ADDo ON HA.HorioComidaDomingo = ADDo.id
	   WHERE clienteId =".$idCliente.";"

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


	function obtenerHorarioComidaById($id)
    {
		
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno())
        {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($conexion, 'entrenaOnlineDB');
		
	
		$consulta = mysqli_prepare($conexion,"SELECT ha.id, ha.nombreHorario,
		adl1.id AS idAlimentacionLunes, adl1.nombre AS nombreLunes,
		adl2.id AS idAlimentacionMartes, adl2.nombre AS nombreMartes,
		adl3.id AS idAlimentacionMiercoles, adl3.nombre AS nombreMiercoles,
		adl4.id AS idAlimentacionJueves, adl4.nombre AS nombreJueves,
		adl5.id AS idAlimentacionViernes, adl5.nombre AS nombreViernes,
		adl6.id AS idAlimentacionSabado, adl6.nombre AS nombreSabado,
		adl7.id AS idAlimentacionDomingo, adl7.nombre AS nombreDomingo
 FROM horarioAlimentos ha
 LEFT JOIN alimentacionDelDia adl1 ON ha.HorioComidaLunes = adl1.id
 LEFT JOIN alimentacionDelDia adl2 ON ha.HorioComidaMartes = adl2.id
 LEFT JOIN alimentacionDelDia adl3 ON ha.HorioComidaMiercoles = adl3.id
 LEFT JOIN alimentacionDelDia adl4 ON ha.HorioComidaJueves = adl4.id
 LEFT JOIN alimentacionDelDia adl5 ON ha.HorioComidaViernes = adl5.id
 LEFT JOIN alimentacionDelDia adl6 ON ha.HorioComidaSabado = adl6.id
 LEFT JOIN alimentacionDelDia adl7 ON ha.HorioComidaDomingo = adl7.id
 WHERE ha.id = $id;
 "
	

	);
		
        $consulta->execute();
        $result = $consulta->get_result();
        $horarios = array();
       	$myrow = $result->fetch_assoc();
		
		
		return $myrow;
	
	}

	function obtenerAlimentacionDiaById($id)
    {
		
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno())
        {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($conexion, 'entrenaOnlineDB');
		
	
		$consulta = mysqli_prepare($conexion,"SELECT ad.id, ad.nombre AS nombre_alimentacion,
		r1.nombre AS nombre_desayuno, r1.descripcion AS descripcion_desayuno,
		r2.nombre AS nombre_merienda_mediodia, r2.descripcion AS descripcion_merienda_mediodia,
		r3.nombre AS nombre_comida, r3.descripcion AS descripcion_comida,
		r4.nombre AS nombre_merienda_tarde, r4.descripcion AS descripcion_merienda_tarde,
		r5.nombre AS nombre_cena, r5.descripcion AS descripcion_cena
 FROM alimentacionDelDia ad
 INNER JOIN recetas r1 ON r1.id = ad.desayuno
 INNER JOIN recetas r2 ON r2.id = ad.meriendaMedioDia
 INNER JOIN recetas r3 ON r3.id = ad.comida
 INNER JOIN recetas r4 ON r4.id = ad.meriendaTarde
 INNER JOIN recetas r5 ON r5.id = ad.cena
 WHERE ad.id = $id;
 "
	

	);
		
        $consulta->execute();
        $result = $consulta->get_result();
        $horarios = array();
       	$myrow = $result->fetch_assoc();
		
		
		return $myrow;
	
	}



	
	function deleteReceta($id)
{
    $conexion = mysqli_connect('localhost', 'root', '1234');
    if (mysqli_connect_errno()) {
        echo "Error al conectar a MySQL: " . mysqli_connect_error();
        return;
    }
    mysqli_select_db($conexion, 'entrenaOnlineDB');

  
    $consultaHorario = "
        DELETE FROM horarioAlimentos
        WHERE
            HorioComidaLunes IN (SELECT id FROM alimentacionDelDia WHERE desayuno = $id) OR
            HorioComidaMartes IN (SELECT id FROM alimentacionDelDia WHERE meriendaMedioDia = $id) OR
            HorioComidaMiercoles IN (SELECT id FROM alimentacionDelDia WHERE comida = $id) OR
            HorioComidaJueves IN (SELECT id FROM alimentacionDelDia WHERE meriendaTarde = $id) OR
            HorioComidaViernes IN (SELECT id FROM alimentacionDelDia WHERE cena = $id)
    ";

    if (mysqli_query($conexion, $consultaHorario)) {
       
        $consultaAlimentacion = "DELETE FROM alimentacionDelDia WHERE desayuno = $id";
        if (mysqli_query($conexion, $consultaAlimentacion)) {
          
            $consultaReceta = "DELETE FROM recetas WHERE id = $id";
            if (mysqli_query($conexion, $consultaReceta)) {
                echo "Receta eliminada exitosamente.";
            } else {
                echo "Error al eliminar la receta: " . mysqli_error($conexion);
            }
        } else {
            echo "Error al eliminar la fila de alimentacionDelDia: " . mysqli_error($conexion);
        }
    } else {
        echo "Error al eliminar los registros de horarioAlimentos: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}


	function deleteHorario($id)
{
    $conexion = mysqli_connect('localhost', 'root', '1234');
    if (mysqli_connect_errno())
    {
        echo "Error al conectar a MySQL: " . mysqli_connect_error();
    }
    mysqli_select_db($conexion, 'entrenaOnlineDB');

    $consulta = "
        
        DELETE FROM horarioalimentos WHERE id = $id;
    ";

    if (mysqli_multi_query($conexion, $consulta)) {
        
        echo "Entrenamiento eliminado exitosamente.";
    } else {
        echo "Error al eliminar el entrenamiento: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);



	}
	

	}

	