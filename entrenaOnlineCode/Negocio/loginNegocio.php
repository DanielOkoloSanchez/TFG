<?php

require("../../AccesoDatos/loginAccesoDatos.php");

class loginReglasNegocio
{

	function __construct()
    {
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
}