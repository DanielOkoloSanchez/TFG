<?php
require_once("../../AccesoDatos/comidasAcessoDatos.php");
require_once("../../AccesoDatos/clienteAccesoDatos.php");
require_once ("../../Negocio/clienteNegocio.php");


class dietaReglasNegocio
{
    private $_id;
    private $_nombre;
    private $_desayuno;
    private $_meriendaMedioDia;
    private $_comida;
    private $_meriendaTarde;
    private $_cena;
    
	function __construct()
    {
    }

    function init($id,$nombre,$desayuno,$meriendaMedioDia,$comida,$meriendaTarde,$cena)
    {
        
        $this->_id = $id;
        $this->_nombre = $nombre;
        $this->_desayuno = $desayuno;
        $this->_meriendaMedioDia = $meriendaMedioDia;
        $this->_comida = $comida; 
        $this->_meriendaTarde = $meriendaTarde; 
        $this->_cena = $cena;
    }

 

    function getID()
    {
        return $this->_id;
    }

    function getNombre()
    {
        return $this->_nombre;
    }

    function getDesayuno()
    {
        return $this->_desayuno;
    }

    function getMeriendaMedioDia()
    {
        return $this->_meriendaMedioDia;
    }
    function getMeriendaTarde()
    {
        return $this->_meriendaTarde;
    }

    function getComida()
    {
        return $this->_comida;
    }

    function getCena()
    {
        return $this->_cena;
    }


   
    function obtenerDietasCreadasUsuario()
    {
        $ClienteDAL = new ClienteAccesoDatos();
        $cliente = $ClienteDAL->obtenerClienteInfo($_COOKIE["IdClienteCookie"]);
        $comidasDAL = new comidasAccesoDatos();
        $rs = $comidasDAL->obtenerDietasUsuario($cliente["id"]);
        $listaDietas =  array();
       

        foreach ($rs as $dieta)
        {
          
            $dietaReglasNegocio = new dietaReglasNegocio();
            $dietaReglasNegocio->init($dieta['id'], $dieta['nombre'], $dieta['desayuno'], $dieta['meriendaMedioDia'], $dieta['comida'], $dieta['meriendaTarde'], $dieta['cena']);
            array_push($listaDietas,$dietaReglasNegocio);
            

        }
       
        return $listaDietas;
        
    }
        
    function createHorarioComidas($nombre,$comidaLunes,$comidaMartes,$comidaMiercoles,$comidaJueves, $comidaViernes,$comidaSabado,$comidaDomingo)
    {   
       
        $ClienteDAL = new ClienteAccesoDatos();
        $cliente = $ClienteDAL->obtenerClienteInfo($_COOKIE["IdClienteCookie"]);
        

        $comidasAccesoDatos = new comidasAccesoDatos();
        $comidasAccesoDatos->createHorarioComidas($nombre,$comidaLunes,$comidaMartes,$comidaMiercoles,$comidaJueves, $comidaViernes,$comidaSabado,$comidaDomingo,$cliente["id"]);
   
    }

    
}





?>


