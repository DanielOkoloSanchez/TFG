<?php

require_once("../../Negocio/entrenamientosNegocio.php");
require_once("../../Negocio/TablasEntrenamientosNegocio.php");
require_once("../../Negocio/comidaNegocio.php");
require_once("../../Negocio/dietaNegocio.php");
require_once("../../Negocio/horarioNegocio.php");
require_once ("../../Negocio/usuarioNegocio.php");
require_once ("../../Negocio/anunciosNegocio.php");

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
    }elseif ($action === 'obtenerValoresUsuario') {
        obtenerValoresUsuario();
    }elseif ($action === 'obtenerValoresRecetas') {
        obtenerValoresRecetas();
    }elseif ($action === 'obtenerCaloriasComida') {
        $comidaSeleccionada = $_POST['comidaSeleccionada'];
        obtenerCaloriasComida($comidaSeleccionada);
    }elseif ($action === 'obtenerValoresTabla'){
        obtenerValoresTabla();
    }elseif ($action === 'obtenerDietasUsuario') 
    {
      obtenerDietasUsuario();
    }elseif ($action === 'obtenerHorarios') 
    {
        obtenerHorarioComidas();
    }elseif ($action === 'obtenerUsuariosCliente') {
        obtenerUsuariosCliente();
    }elseif ($action === 'obtenerUsuarios') {
        obtenerUsuarios();
    }elseif ($action === 'obtenerAllRecetas') {
        obtenerAllRecetas();
    }elseif ($action === 'obtenerAnuncio') {
        obtenerAnuncios();
    }
}


function obtenerUsuarios(){
    $valor = new usuarioReglasNegocio();
    $listas = $valor->obtenerUsuarios();

    $data = array();

    foreach ($listas as $lista) {
       
        $usuario = array(
            "id" => $lista->getUserId(),
            "nombre" => $lista->getNombre()
        );

       
      
        $data[] = $usuario;
        
    }
    header('Content-Type: application/json');
    echo json_encode($data);
}



function obtenerAnuncios(){
    $valor = new anunciosReglasNegocio();
    $listas = $valor->obtenerAnuncios();

    $data = array();

    foreach ($listas as $lista) {
       
        $anuncio = array(
            "id" => $lista->getID(),
            "nombre" => $lista->getNombre()
        );

        $data[] = $anuncio;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
}


function obtenerUsuariosCliente(){
    $valor = new clienteReglasNegocio();
    $listas = $valor->obtenerUsuariosCliente();

    $data = array();

    foreach ($listas as $lista) {
       
        $cliente = array(
            "id" => $lista->getClientId(),
            "nombre" => $lista->getNombre()
        );

       
        
        $data[] = $cliente;
    }

   
    header('Content-Type: application/json');
    echo json_encode($data);
}

    

function obtenerHorarioComidas(){
    $valor = new horarioReglasNegocio();
    $listas = $valor->obtenerHorarioComidas();

    $data = array();

    foreach ($listas as $lista) {
       
        $horario = array(
            "id" => $lista->getId(),
            "nombreHorario" => $lista->getNombreHorario(),
            "HorarioLunes" => $lista->getHorarioComidaLunes(),
            "HorarioLunesId" => $lista->getHorarioComidaLunesId(),
            "HorarioMartes" => $lista->getHorarioComidaMartes(),
            "HorarioMartesId" => $lista->getHorarioComidaMartesId(),
            "HorarioMiercoles" => $lista->getHorarioComidaMiercoles(),
            "HorarioMiercolesId" => $lista->getHorarioComidaMiercolesId(), 
            "HorarioJueves" => $lista->getHorarioComidaJueves(),
            "HorarioJuevesId" => $lista->getHorarioComidaJuevesId(),
            "HorarioViernes" => $lista->getHorarioComidaViernes(),
            "HorarioViernesId" => $lista->getHorarioComidaViernesId(),
            "HorarioSabado" => $lista->getHorarioComidaSabado(),
            "HorarioSabadoId" => $lista->getHorarioComidaSabadoId(),
            "HorarioDomingo" => $lista->getHorarioComidaDomingo(),
            "HorarioDomingoId" => $lista->getHorarioComidaDomingoId() 
        );

        
        $data[] = $horario;
    }

   
    header('Content-Type: application/json');
    echo json_encode($data);
}


    function obtenerDietasUsuario(){
        $valor = new dietaReglasNegocio();
        $listas = $valor->obtenerDietasCreadasUsuario();
    
        $data = array();
    
        foreach ($listas as $lista) {
           
            $dieta = array(
                "id" => $lista->getID(),
                "nombre" => $lista->getNombre(),
                "desayuno" => $lista->getDesayuno(),
                "meriendaMedioDia"=> $lista->getMeriendaMedioDia(),
                "comida" => $lista->getComida(), 
                "meriendaTarde" => $lista->getMeriendaTarde(),
                "cena" => $lista->getCena() 
            );
    
            
            $data[] = $dieta;
        }
    
       
        header('Content-Type: application/json');
        echo json_encode($data);
    }


    function obtenerCaloriasComida($comidaSeleccionada)
    {
        $valor = new comidasReglasNegocio();
        $calorias = $valor->obtenerCaloriasComida($comidaSeleccionada);
    
        
        $data = array(
            "calorias" => $calorias
        );
    
        header('Content-Type: application/json');
        echo json_encode($data);
    }


function obtenerValoresSelect() {
    $valor = new entrenamientosReglasNegocio();
    $listas = $valor->obtenerEntrenamientos();

   
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




function obtenerValoresTabla() {
    $valor = new tablasEntrenamientosReglasNegocio();
    $listas = $valor->obtenerTablaEntrenamientos();

    $data = array();

    foreach ($listas as $lista) {
       
        $entrenamiento = array(
            "id" => $lista->getID(),
            "nombre" => $lista->getNombre(),
            "diaSemana" => $lista->getDiaSemana()
        );

        $data[] = $entrenamiento;
    }

   
    header('Content-Type: application/json');
    echo json_encode($data);
}




function obtenerValoresRecetas() {
    $valor = new comidasReglasNegocio();
    $listas = $valor->obtenerRecetas();

   
    $data = array();

    foreach ($listas as $lista) {
       
        $recetas = array(
            "id" => $lista->getID(),
            "nombre" => $lista->getNombre(),
            "descripcion" => $lista->getDescripcion(),
            "calorias" => $lista->getCalorias(),
            "tipo"=>$lista->getTipo(),
            "momentoComida"=>$lista->getMomentoComida()
        );

        
        $data[] = $recetas;
    }
    
   
    header('Content-Type: application/json');
    
    echo json_encode($data);
}

function obtenerAllRecetas() {
    $valor = new comidasReglasNegocio();
    $listas = $valor->obtenerAllRecetas();

   
    $data = array();

    foreach ($listas as $lista) {
       
        $recetas = array(
            "id" => $lista->getID(),
            "nombre" => $lista->getNombre(),
            "descripcion" => $lista->getDescripcion(),
            "calorias" => $lista->getCalorias(),
            "tipo"=>$lista->getTipo(),
            "momentoComida"=>$lista->getMomentoComida()
        );

        
        $data[] = $recetas;
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



function obtenerValoresUsuario()
{
    $usuarioBL = new clienteReglasNegocio();
    $cliente = $usuarioBL->obtenerClienteInfo();

    
    $data = array(
        "id" => $cliente->getClientId(),
        "nombre" =>  $cliente->getNombre(),
        "primerApellido" => $cliente->getApellido(),
        "fechaNacimiento" => $cliente->getFechaNacimiento(),
        "altura" => $cliente->getAltura(),
        "peso" => $cliente->getPeso(),
        "complexion" => $cliente->getComplexion(),
        "objetivo" => $cliente->getObjetivo(),
        "sexo" => $cliente->getSexo()
    );
    
    
    header('Content-Type: application/json');
    echo json_encode($data);
}



?>
