<?php

require_once("../../AccesoDatos/entrenamientosAcessoDatos.php");
require_once("../../AccesoDatos/clienteAccesoDatos.php");
require_once ("../../Negocio/clienteNegocio.php");



class tablasEntrenamientosReglasNegocio
{
    private $_id;
    private $_nombre;
    private $_diaSemana;
   
    
    
	function __construct()
    {
    }

    function init($id,$nombre,$diaSemana)
    {
        $this->_id = $id;
        $this->_nombre = $nombre;
        $this->_diaSemana = $diaSemana;
    }

    function getID()
    {
        return $this->_id;
    }

    function getNombre()
    {
        return $this->_nombre;
    }

    function getDiaSemana()
    {
        return $this->_diaSemana;
    }

   
   

     function obtenerTablaEntrenamientos()
    {   
        

        $ClienteDAL = new ClienteAccesoDatos();
        $cliente = $ClienteDAL->obtenerClienteInfo($_COOKIE["IdClienteCookie"]);
        


        $EntrenamientosDAL = new enterenamientoAccesoDatos();
        $rs = $EntrenamientosDAL->obtenerTablaEntrenamientos($cliente["id"]);
        $listaTablaEntrenamientos =  array();

       

        foreach ($rs as $TablaEntrenamiento)
        {
          
            $TablaEntrenamientosReglasNegocio = new tablasEntrenamientosReglasNegocio();
            $TablaEntrenamientosReglasNegocio->Init($TablaEntrenamiento['id'],$TablaEntrenamiento['nombre'],$TablaEntrenamiento['diaSemana']);
            array_push($listaTablaEntrenamientos,$TablaEntrenamientosReglasNegocio);
            

        }
       
        return $listaTablaEntrenamientos;
        
    }

    
}





?>


