<?php
require_once("../../AccesoDatos/comidasAcessoDatos.php");
require_once("../../AccesoDatos/clienteAccesoDatos.php");
require_once ("../../Negocio/clienteNegocio.php");


class horarioReglasNegocio
{
    private $_id;
    private $_nombreHorario;
    private $_HorarioComidaLunes;
    private $_HorarioComidaMartes;
    private $_HorarioComidaMiercoles;
    private $_HorarioComidaJueves;
    private $_HorarioComidaViernes;
    private $_HorarioComidaSabado;
    private $_HorarioComidaDomingo;
    
	function __construct()
    {
    }

    function init($id,$nombreHorario,$HorarioComidaLunes,$HorarioComidaMartes,$HorarioComidaMiercoles,$HorarioComidaJueves,$HorarioComidaViernes,$HorarioComidaSabado,$HorarioComidaDomingo)
    {
        
        $this->_id = $id;
        $this->_nombreHorario = $nombreHorario;
        $this->_HorarioComidaLunes = $HorarioComidaLunes;
        $this->_HorarioComidaMartes = $HorarioComidaMartes;
        $this->_HorarioComidaMiercoles = $HorarioComidaMiercoles; 
        $this->_HorarioComidaJueves = $HorarioComidaJueves; 
        $this->_HorarioComidaViernes = $HorarioComidaViernes;
        $this->_HorarioComidaSabado = $HorarioComidaSabado;
        $this->_HorarioComidaDomingo = $HorarioComidaDomingo;

    }

 

    function getID()
    {
        return $this->_id;
    }

    function getNombreHorario()
    {
        return $this->_nombreHorario;
    }

    function getHorarioComidaLunes()
    {
        return $this->_HorarioComidaLunes;
    }

    function getHorarioComidaMartes()
    {
        return $this->_HorarioComidaMartes;
    }
    function getHorarioComidaMiercoles()
    {
        return $this->_HorarioComidaMiercoles;
    }

    function getHorarioComidaJueves()
    {
        return $this->_HorarioComidaJueves;
    }

    function getHorarioComidaViernes()
    {
        return $this->_HorarioComidaViernes;
    }
    
    function getHorarioComidaSabado()
    {
        return $this->_HorarioComidaSabado;
    }

    function getHorarioComidaDomingo()
    {
        return $this->_HorarioComidaDomingo;
    }



   
    function obtenerHorarioComidas()
    {
        $ClienteDAL = new ClienteAccesoDatos();
        $cliente = $ClienteDAL->obtenerClienteInfo($_COOKIE["IdClienteCookie"]);
        $comidasDAL = new comidasAccesoDatos();
        $rs = $comidasDAL->obtenerHorarioComidas($cliente["id"]);
        $horarios =  array();
       

        foreach ($rs as $horario)
        {
          
            $horarioReglasNegocio = new horarioReglasNegocio();
            $horarioReglasNegocio->init($horario['id'], $horario['nombreHorario'], $horario['HorioComidaLunes'], $horario['HorioComidaMartes'], $horario['HorioComidaMiercoles'], $horario['HorioComidaJueves'], $horario['HorioComidaViernes'],$horario['HorioComidaSabado'],$horario['HorioComidaDomingo']);
            array_push($horarios,$horarioReglasNegocio);
            

        }
       
        return $horarios;
        
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


