<?php

require_once("../../AccesoDatos/loginAccesoDatos.php");
require_once("../../AccesoDatos/usuarioAccesoDatos.php");

class usuarioReglasNegocio
{
    private $_userId;

	function __construct()
    {
    }

    function setUserId($userId){
        $this->_userId = $userId;
    }

    function getUserId(){
        return $this->_userId;
    }

    function insertarCliente($usuario,$clave)
	{
		
        $usuarioDAL = new usuarioAccesoDatos();
        $usuario = $usuarioDAL->insertar($usuario,"client",$clave);
        
		
	}


    function verificar($usuario, $clave)
    {
        $loginDAL = new loginAccesoDatos();
        if ($clave < 8){
            throw new Exception("Pon una contraseña de almenos 8 caracteres");
            
        }
        $res = $loginDAL->verificar($usuario,$clave);
        
        return $res;
        
    }

    function obtenerUserId($usuario)
    {
        $loginDAL = new loginAccesoDatos();
        $rs = $loginDAL->obtenerUserId($usuario);
        return $rs;
        
    }
}



?>
