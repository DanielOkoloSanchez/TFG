<?php
require_once("../../Negocio/entrenamientosNegocio.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action']; 

    if ($action === 'obtenerValoresSelect') {
        obtenerValoresSelect();
    }elseif ($action === 'obtenerValoresSelectFiltrado') {
        $parteCuerpo = $_POST['parteCuerpo'];
        obtenerValoresSelectFiltrado($parteCuerpo);
    }
}

function obtenerValoresSelect() {
    $prueba = new entrenamientosReglasNegocio();
    $listas = $prueba->obtenerEntrenamientos();

   
    $data = array();

    foreach ($listas as $lista) {
       
        $entrenamiento = array(
            "id" => $lista->getID(),
            "nombre" => $lista->getNombre(),
            "descripcion" => $lista->getDescripcion(),
            "parteCuerpo" => $lista->getParteCuerpo()
        );

        
        $data[] = $entrenamiento;
    }

   
    header('Content-Type: application/json');
    echo json_encode($data);
}

function obtenerValoresSelectFiltrado($parteCuerpo) {
    $entrenamientosBL = new entrenamientosReglasNegocio();
    $entrenamientos = $entrenamientosBL->obtenerEntrenamientosFiltrados($parteCuerpo);

   
    $data = array();

    foreach ($entrenamientos as $entreno) {
       
        $entrenamiento = array(
            "id" => $entreno->getID(),
            "nombre" => $entreno->getNombre(),
            "descripcion" => $entreno->getDescripcion(),
            "parteCuerpo" => $entreno->getParteCuerpo()
        );

        
        $data[] = $entrenamiento;
    }

   
    header('Content-Type: application/json');
    echo json_encode($data);
}



?>
