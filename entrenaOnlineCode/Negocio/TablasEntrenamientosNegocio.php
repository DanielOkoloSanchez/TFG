<?php
require_once("../../AccesoDatos/entrenamientosAcessoDatos.php");
require_once("../../AccesoDatos/clienteAccesoDatos.php");
require_once ("../../Negocio/clienteNegocio.php");



class tablasEntrenamientosReglasNegocio
{
    private $_id;
    private $_nombre;
    private $_listaEntrenosId;
    private $_diaSemana;
    private $_nombreEntreno1;
    private $_nombreEntreno2;
    private $_nombreEntreno3;
    private $_nombreEntreno4;
    private $_nombreEntreno5;
    private $_descripcionEntreno1;
    private $_descripcionEntreno2;
    private $_descripcionEntreno3;
    private $_descripcionEntreno4;
    private $_descripcionEntreno5;
    
    
	function __construct()
    {
    }

    function init($id,$listaEntrenosId,$nombre,$diaSemana)
    {
        $this->_id = $id;
        $this->_nombre = $nombre;
        $this->_listaEntrenosId = $listaEntrenosId;
        $this->_diaSemana = $diaSemana;
    }

    function initListaEntreno($id,$nombre)
    {
        $this->_id = $id;
        $this->_nombre = $nombre;
        
    }

   function InitTablaEntrenoUsuario($id,$nombreEntreno1,$descripcionEntreno1,$nombreEntreno2,$descripcionEntreno2,$nombreEntreno3,$descripcionEntreno3,$nombreEntreno4,$descripcionEntreno4,$nombreEntreno5,$descripcionEntreno5){
        $this->_id = $id;
        $this->_nombreEntreno1 = $nombreEntreno1;
        $this->_nombreEntreno2 = $nombreEntreno2;
        $this->_nombreEntreno3 = $nombreEntreno3;
        $this->_nombreEntreno4 = $nombreEntreno4;
        $this->_nombreEntreno5 = $nombreEntreno5;
        $this->_descripcionEntreno1 = $descripcionEntreno1;
        $this->_descripcionEntreno2 = $descripcionEntreno2;
        $this->_descripcionEntreno3 = $descripcionEntreno3;
        $this->_descripcionEntreno4 = $descripcionEntreno4;
        $this->_descripcionEntreno5 = $descripcionEntreno5;
    }

    function getID()
    {
        return $this->_id;
    }

    function getNombre()
    {
        return $this->_nombre;
    }

    function getListaEntrenosId()
    {
        return $this->_listaEntrenosId;
    }

    function getDiaSemana()
    {
        return $this->_diaSemana;
    }

    function getNombreEntreno1()
    {
        return $this->_nombreEntreno1;
    }

    function getNombreEntreno2()
    {
        return $this->_nombreEntreno2;
    }

    function getNombreEntreno3()
    {
        return $this->_nombreEntreno3;
    }

    function getNombreEntreno4()
    {
        return $this->_nombreEntreno4;
    }

    function getNombreEntreno5()
    {
        return $this->_nombreEntreno5;
    }

    function descripcionEntreno1()
    {
        return $this->_descripcionEntreno1;
    }
   
    function descripcionEntreno2()
    {
        return $this->_descripcionEntreno2;
    }

    function descripcionEntreno3()
    {
        return $this->_descripcionEntreno3;
    }

    function descripcionEntreno4()
    {
        return $this->_descripcionEntreno4;
    }

    function descripcionEntreno5()
    {
        return $this->_descripcionEntreno5;
    }
   

     function obtenerTablaEntrenamientos()
    {   
        

       
        $ClienteDAL = new ClienteAccesoDatos();
        $cliente = $ClienteDAL->obtenerClienteInfo($_COOKIE["IdClienteCookie"]);
        $comidasDAL = new comidasAccesoDatos();
        $EntrenamientosDAL = new enterenamientoAccesoDatos();
        $rs = $EntrenamientosDAL->obtenerTablaEntrenamientos($cliente["id"]);
        $listaTablaEntrenamientos =  array();

       

        foreach ($rs as $TablaEntrenamiento)
        {
          
            $TablaEntrenamientosReglasNegocio = new tablasEntrenamientosReglasNegocio();
            $TablaEntrenamientosReglasNegocio->Init($TablaEntrenamiento['id'],$TablaEntrenamiento['listaEntrenosId'],$TablaEntrenamiento['nombreEntreno'],$TablaEntrenamiento['diaSemana']);
            array_push($listaTablaEntrenamientos,$TablaEntrenamientosReglasNegocio);
            

        }
       
        return $listaTablaEntrenamientos;
        
    }




    function getTablaEjerciciosById($id)
    {   
        
        $EntrenamientosDAL = new enterenamientoAccesoDatos();
        $rs = $EntrenamientosDAL->getTablaEjerciciosById($id);
       
        return $rs;
               
    }

    function obtenerListaEntrenos()
    {   
        

       
        $id = $_COOKIE["IdClienteCookie"];


        $EntrenamientosDAL = new enterenamientoAccesoDatos();
        $rs = $EntrenamientosDAL->obtenerListaEntrenos();
        $listaTablaEntrenamientos =  array();

       

        foreach ($rs as $TablaEntrenamiento)
        {
          
            $TablaEntrenamientosReglasNegocio = new tablasEntrenamientosReglasNegocio();
            $TablaEntrenamientosReglasNegocio->initListaEntreno($TablaEntrenamiento['id'],$TablaEntrenamiento['nombre']);
            array_push($listaTablaEntrenamientos,$TablaEntrenamientosReglasNegocio);
            

        }
       
        return $listaTablaEntrenamientos;
        
    }

    function deleteTablaEjer($id)
    {   
        
        $EntrenamientosDAL = new enterenamientoAccesoDatos();
        $EntrenamientosDAL->deleteTablaEjer($id);
       
       
    }
    
}






?>


