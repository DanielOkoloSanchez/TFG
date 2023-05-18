<?php
require_once("../../Negocio/entrenamientosNegocio.php");

$prueba = new entrenamientosReglasNegocio();
$listas = $prueba->obtenerEntrenamientos();

// Crear un array para almacenar los datos
$data = array();

foreach ($listas as $lista) {
    // Crear un array asociativo con los datos del entrenamiento
    $entrenamiento = array(
        "id" => $lista->getID(),
        "nombre" => $lista->getNombre(),
        "descripcion" => $lista->getDescripcion(),
        "parteCuerpo" => $lista->getParteCuerpo()
    );

    // Agregar el entrenamiento al array de datos
    $data[] = $entrenamiento;
}

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data);
?>