<?php

require_once("../../AccesoDatos/loginAccesoDatos.php");

class loginReglasNegocio
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
