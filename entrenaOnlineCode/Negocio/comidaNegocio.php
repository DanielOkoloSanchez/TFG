<?php

require_once("../../AccesoDatos/comidasAcessoDatos.php");
require_once("../../AccesoDatos/clienteAccesoDatos.php");
require_once ("../../Negocio/clienteNegocio.php");


class comidasReglasNegocio
{
    private $_id;
    private $_nombre;
    private $_descripcion;
    private $_calorias;
    private $_tipo;
    private $_momentoComida;
    
	function __construct()
    {
    }

    function init($id,$nombre,$descripcion,$calorias,$tipo,$momentoComida)
    {
        
        $this->_id = $id;
        $this->_nombre = $nombre;
        $this->_descripcion = $descripcion;
        $this->_calorias = $calorias; 
        $this->_tipo = $tipo; 
        $this->_momentoComida = $momentoComida;
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

    function getCalorias()
    {
        return $this->_calorias;
    }

    function getTipo()
    {
        return $this->_tipo;
    }

    function getMomentoComida()
    {
        return $this->_momentoComida;
    }


    function obtenerAllRecetas()
    {
        
        
        $comidasDAL = new comidasAccesoDatos();
        $rs = $comidasDAL->obtenerAllRecetas();
        $listaRecetas =  array();
       

        foreach ($rs as $receta)
        {
          
            $comidasReglasNegocio = new comidasReglasNegocio();
            $comidasReglasNegocio->Init($receta['id'],$receta['nombre'],$receta['descripcion'],$receta['calorias'],$receta['tipo'],$receta['momentoComida']);
            array_push($listaRecetas,$comidasReglasNegocio);
            

        }
       
        return $listaRecetas;
        
    }
   

    function obtenerRecetas()
    {
        
        $idCliente = $_COOKIE["IdClienteCookie"];
        $comidasDAL = new comidasAccesoDatos();
        $rs = $comidasDAL->obtenerRecetas($idCliente);
        $listaRecetas =  array();
       

        foreach ($rs as $receta)
        {
          
            $comidasReglasNegocio = new comidasReglasNegocio();
            $comidasReglasNegocio->Init($receta['id'],$receta['nombre'],$receta['descripcion'],$receta['calorias'],$receta['tipo'],$receta['momentoComida']);
            array_push($listaRecetas,$comidasReglasNegocio);
            

        }
       
        return $listaRecetas;
        
    }
        
    function obtenerCaloriasComida($comidaId)
    {
        $recetas = $this->obtenerRecetas();
        
        foreach ($recetas as $receta) {
            if ($receta->getID() == $comidaId) {
                return $receta->getCalorias();
            }
        }
        
        return null;
    }

    

     function createAlimentacionDelDia($nombre,$desayuno,$merienda,$comida,$meriendaDos, $cena)
     {   
        
         $comidasAccesoDatos = new comidasAccesoDatos();
         $comidasAccesoDatos->createAlimentacionDelDia($nombre,$desayuno,$merienda,$comida,$meriendaDos, $cena,$_COOKIE["IdClienteCookie"]);
    
     }

     function createReceta($nombre,$descripcion,$calorias,$tipo,$momentoComida)
     {   
        
         $comidasAccesoDatos = new comidasAccesoDatos();
         $comidasAccesoDatos->createReceta($nombre,$descripcion,$calorias,$tipo,$momentoComida);
    
     }

     function deleteReceta($id)
     {   
         
        $comidasAccesoDatos = new comidasAccesoDatos();
        $comidasAccesoDatos->deleteReceta($id);
        
        
     }
    
}





?>


