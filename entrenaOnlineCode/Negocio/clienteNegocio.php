<?php

require_once("../../AccesoDatos/clienteAccesoDatos.php");
require_once("../../AccesoDatos/usuarioAccesoDatos.php");

class clienteReglasNegocio
{
    private $_clientId;
    private $_nombre;
    private $_apellido;
    private $_sexo;
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

    function getNombre()
    {
        return $this->_nombre;
    }

    function getApellido()
    {
        return $this->_apellido;
    }

    function getSexo()
    {
        return $this->_sexo;
    }

    function getFechaNacimiento()
    {
        return $this->_fechaNacimiento;
    }

    function getAltura()
    {
        return $this->_altura;
    }

    function getPeso()
    {
        return $this->_peso;
    }

    function getComplexion()
    {
        return $this->_complexion;
    }

    function getObjetivo()
    {
        return $this->_objetivo;
    }

    

    function init($id,$nombre,$apellido,$sexo,$fechaNacimiento,$altura,$peso,$complexion,$objetivo)
    {
        
        $this->_clientId = $id;
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_sexo = $sexo;
        $this->_fechaNacimiento =  $fechaNacimiento;
        $this->_altura = $altura; 
        $this->_peso = $peso;
        $this->_complexion = $complexion;
        $this->_objetivo = $objetivo;
    }

    function initUsuario($id,$nombre)
    {
        
        $this->_clientId = $id;
        $this->_nombre = $nombre;
        
    }
   

    function obtenerClienteInfo()
    {
        $ClienteDAL = new ClienteAccesoDatos();
        $rs = $ClienteDAL->obtenerClienteInfo($_COOKIE["IdClienteCookie"]);

        $ClienteBL = new clienteReglasNegocio();

         $ClienteBL->init($rs['id'], $rs['nombre'], $rs['primerApellido'],$rs['sexo'],$rs['fechaNacimiento'], $rs['altura'], $rs['peso'], $rs['complexion'], $rs['objetivo']);
        
         return $ClienteBL;
       
    }

   
    
    function obtenerUsuariosCliente()
    {
        $usuarioDAL = new usuarioAccesoDatos();
        $rs = $usuarioDAL->obtenerClientes();

        $clientes =  array();
       
        foreach ($rs as $cliente)
        {
          
            $ClienteBL = new clienteReglasNegocio();
            $ClienteBL->initUsuario($cliente['id'], $cliente['nombre']);
            array_push($clientes,$ClienteBL);
            
        }
       
        return $clientes;
        
        
        
       
    }

   


    function createCliente($nombre, $primerApellido,$segundoApellido,$sexo,$fechaNacimiento, $altura, $peso, $complexion, $objetivo)
    {
      
        try {
            $ClienteDAL = new ClienteAccesoDatos();
            $ClienteDAL->createCliente($nombre, $primerApellido,$segundoApellido,$sexo,$fechaNacimiento, $altura, $peso, $complexion, $objetivo);
        
        } catch (Exception $e) {
            
            throw new Exception("Error en el negocio: " . $e->getMessage());
            
        }
    }

  

    function deleteCliente($id)
    {   
        
        $usuarioDAL = new usuarioAccesoDatos();
        $usuarioDAL->deleteUsuario($id);
       
       
    }

    function updateObjetivo($objetivo)
    {   
        $idCliente = $_COOKIE["IdClienteCookie"];
        $usuarioDAL = new usuarioAccesoDatos();
        $usuarioDAL->updateObjetivo($objetivo,$idCliente);
       
       
    }

    function updateUsuario($objetivo,$peso)
    {   
        
        $idCliente = $_COOKIE["IdClienteCookie"];
        $usuarioDAL = new usuarioAccesoDatos();
        $usuarioDAL->updateUsuarioCliente($objetivo,$peso,$idCliente);
       
       
    }
}





?>
