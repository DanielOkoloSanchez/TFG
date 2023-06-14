<?php

require_once("../../AccesoDatos/anunciosAccesoDatos.php");
require_once("../../AccesoDatos/adminAccesoDatos.php");

class anunciosReglasNegocio
{
    private $_anuncioId;
    private $_nombre;
    private $_descripcion;
    private $_fechaCreacion;
    private $_nombreEmpleado;
    
	function __construct()
    {
    }

    function init($id,$nombre,$descripcion,$fechaCreacion,$nombreEmpleado)
    {
        
        $this->_anuncioId = $id;
        $this->_nombre = $nombre;
        $this->_descripcion = $descripcion;
        $this->_fechaCreacion =  $fechaCreacion;
        $this->_nombreEmpleado = $nombreEmpleado; 
       
    }

    function getID()
    {
        return $this->_anuncioId;
    }

    function getNombre()
    {
        return $this->_nombre;
    }

    function getDescripcion()
    {
        return $this->_descripcion;
    }

    function getFechaCreacion()
    {
        return $this->_fechaCreacion;
    }

    function getNombreEmpleado()
    {
        return $this->_nombreEmpleado;
    }
   

    function obtenerAnuncios()
    {
        $AnunciosDAL = new anunciosAccesoDatos();
        $rs = $AnunciosDAL->obtenerAnuncios();
        $listaAnuncios =  array();
       

        foreach ($rs as $anuncio)
        {
          
            $AnunciosReglasNegocio = new AnunciosReglasNegocio();
            $AnunciosReglasNegocio->Init($anuncio['id'],$anuncio['nombre'],$anuncio['descripcion'],$anuncio['fechaCreacion'],$anuncio['nombreEmpleado']);
            array_push($listaAnuncios,$AnunciosReglasNegocio);
         
        }
        
        return $listaAnuncios;
        
    }

    function createAnuncio($nombre,$descripcion)
     {   
        
        $EmpleadoDAL = new adminAccesoDatos();
        $empleado = $EmpleadoDAL->obtenerAdminInfo($_COOKIE["IdClienteCookie"]);
        $id= $empleado["id"];

         $anunciosAccesoDatos = new anunciosAccesoDatos();
         $anunciosAccesoDatos->createAnuncio($nombre,$descripcion,date("Y-m-d"),$id);
    
     }

     function deleteAnuncio($id)
     {   
         
        $anunciosAccesoDatos = new anunciosAccesoDatos();
        $anunciosAccesoDatos->deleteAnuncio($id);
        
        
     }
        
    }

   
   


?>
