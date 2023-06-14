<?php

require_once("../../AccesoDatos/adminAccesoDatos.php");
require_once("../../AccesoDatos/usuarioAccesoDatos.php");

class adminReglasNegocio
{
    private $_adminId;
    private $_nombre;
    private $_apellido;
    private $_fechaNacimiento;
    private $_cargo;


	function __construct()
    {
    }

    function getAdminId(){
        return $this->_adminId;
    }

    function getNombre()
    {
        return $this->_nombre;
    }

    function getApellido()
    {
        return $this->_apellido;
    }

    function getFechaNacimiento()
    {
        return $this->_fechaNacimiento;
    }

    function getCargo()
    {
        return $this->_cargo;
    }

    

    function init($id,$nombre, $primerApellido,$segundoApellido,$fechaNacimiento,$cargo)
    {
        
        $this->_adminId = $id;
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_fechaNacimiento =  $fechaNacimiento;
        $this->_cargo = $cargo;
    }

    function initUsuario($id,$nombre)
    {
        
        $this->_adminId = $id;
        $this->_nombre = $nombre;
        
    }
   



   
    
    function obtenerAdmins()
    {
        $usuarioDAL = new usuarioAccesoDatos();
        $rs = $usuarioDAL->obtenerAdmins();

        $admins =  array();
       
        foreach ($rs as $admin)
        {
          
            $AdminBL = new adminReglasNegocio();
            $AdminBL->initUsuario($admin['id'], $admin['nombre']);
            array_push($admins,$AdminBL);
            
        }
       
        return $admins;
        
        
        
       
    }

   


    function createAdmin($nombre, $primerApellido,$segundoApellido,$fechaNacimiento,$cargo)
    {

        try {
            $AdminDAL = new adminAccesoDatos();
            $AdminDAL->createAdmin($nombre, $primerApellido,$segundoApellido,$fechaNacimiento,$cargo);
        } catch (Exception $e) {
            throw new Exception("Error en el negocio: " . $e->getMessage());
            
        }
       
       
    }

  

    function deleteAdmin($id)
    {   
        
        $usuarioDAL = new usuarioAccesoDatos();
        $usuarioDAL->deleteUsuario($id);
       
       
    }

   
}





?>
