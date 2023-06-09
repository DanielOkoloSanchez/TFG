<?php

require_once("../../AccesoDatos/entrenamientosAcessoDatos.php");
require_once("../../AccesoDatos/clienteAccesoDatos.php");


class entrenamientosReglasNegocio
{
    private $_id;
    private $_nombre;
    private $_descripcion;
    private $_parteCuerpo;
    private $_idCliente ;
    
	function __construct()
    {
    }

    function init($id,$nombre,$descripcion,$parteCuerpo)
    {
        
        $this->_id = $id;
        $this->_nombre = $nombre;
        $this->_descripcion = $descripcion;
        $this->_parteCuerpo = $parteCuerpo; 
       
    }

    function getID()
    {
        return $this->_id;
    }

    function getNombre()
    {
        return $this->_nombre;
    }

    function getDescripcion()
    {
        return $this->_descripcion;
    }

    function getParteCuerpo()
    {
        return $this->_parteCuerpo;
    }

   
   

    function obtenerEntrenamientos()
    {
        $EntrenamientosDAL = new enterenamientoAccesoDatos();
        $rs = $EntrenamientosDAL->obtenerEntrenamientos();
        $listaEntrenamientos =  array();
       

        foreach ($rs as $entrenamiento)
        {
          
            $EntrenamientosReglasNegocio = new entrenamientosReglasNegocio();
            $EntrenamientosReglasNegocio->Init($entrenamiento['id'],$entrenamiento['nombre'],$entrenamiento['descripcion'],$entrenamiento['parteCuerpo']);
            array_push($listaEntrenamientos,$EntrenamientosReglasNegocio);
            

        }
       
        return $listaEntrenamientos;
        
    }
        
 

    function obtenerEntrenamientosFiltrados($parteCuerpo)
    {
        $EntrenamientosDAL = new enterenamientoAccesoDatos();
        $rs = $EntrenamientosDAL->obtenerEntrenamientos();
        $listaEntrenamientos =  array();
        

        foreach ($rs as $entrenamiento)
        {
            
            if ($entrenamiento['parteCuerpo'] === $parteCuerpo) {
                $EntrenamientosReglasNegocio = new entrenamientosReglasNegocio();
                 $EntrenamientosReglasNegocio->Init($entrenamiento['id'], $entrenamiento['nombre'], $entrenamiento['descripcion'], $entrenamiento['parteCuerpo']);
                array_push($listaEntrenamientos, $EntrenamientosReglasNegocio);
            }
           
        }
       
        return $listaEntrenamientos;
        
    }

    function createTablaEntrenamientos($nombre,$ejerUno,$ejerDos, $ejerTres, $ejerCuatro, $ejerCinco)
    {   
        

    
        
        $EntrenamientosAccesoDatos = new enterenamientoAccesoDatos();
        $EntrenamientosAccesoDatos->createTablaEntrenamientos($nombre,$ejerUno,$ejerDos, $ejerTres, $ejerCuatro, $ejerCinco);
       
       
    }

    function createEntrenamiento($nombre,$descripcion,$parteCuerpo)
    {   
        
        $EntrenamientosAccesoDatos = new enterenamientoAccesoDatos();
        $EntrenamientosAccesoDatos->createEntrenamiento($nombre,$descripcion,$parteCuerpo);
       
       
    }

    function deleteEntrenamiento($id)
    {   
        
        $EntrenamientosAccesoDatos = new enterenamientoAccesoDatos();
        $EntrenamientosAccesoDatos->deleteEntrenamiento($id);
       
       
    }

    function createListaEntrenoDia($dia,$listaEntreno)
    {   
        $ClienteDAL = new ClienteAccesoDatos();
        $rs = $ClienteDAL->obtenerClienteInfo($_COOKIE["IdClienteCookie"]);
        
        $EntrenamientosAccesoDatos = new enterenamientoAccesoDatos();
        $EntrenamientosAccesoDatos->InsertlistaEntreno($dia,$rs['id'],$listaEntreno);
       
       
    }
    
}





?>


