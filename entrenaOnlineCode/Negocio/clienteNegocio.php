<?php

require_once("../../AccesoDatos/clienteAccesoDatos.php");

class clienteReglasNegocio
{
    private $_clientId;
    private $_nombre;
    private $_apellido;
    private $_fechaNacimiento;
    private $_altura;
    private $_peso;
    private $_complexion;
    private $_objetivo;


	function __construct()
    {
    }

    function getClientId(){
        return $this->_clientId;
    }

    function init($id,$nombre,$apellido,$fechaNacimiento,$altura,$peso,$complexion,$objetivo)
    {
        
        $this->_clientId = $id;
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_fechaNacimiento =  $fechaNacimiento;
        $this->_altura = $altura; 
        $this->_peso = $peso;
        $this->_complexion = $complexion;
        $this->_objetivo = $objetivo;
    }

   

    function obtenerClienteInfo($idUsuario)
    {
        $ClienteDAL = new ClienteAccesoDatos();
        $rs = $ClienteDAL->obtenerClienteInfo($idUsuario);
        return $rs;
        
    }


}


?>
