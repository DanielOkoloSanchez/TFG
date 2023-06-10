<?php

require_once("../../AccesoDatos/loginAccesoDatos.php");
require_once("../../AccesoDatos/usuarioAccesoDatos.php");

class usuarioReglasNegocio
{
    private $_userId;
    private $_nombre;

	function __construct()
    {
    }

    function setUserId($userId){
        $this->_userId = $userId;
    }

    function getUserId(){
        return $this->_userId;
    }

    function getNombre(){
        return $this->_nombre;
    }

    function initUsuario($id,$nombre)
    {
        
        $this->_userId = $id;
        $this->_nombre = $nombre;
        
    }



    function obtenerUsuarios()
    {
        $usuarioDAL = new usuarioAccesoDatos();
        $rs = $usuarioDAL->obtenerUsuarios();

        $usuarios =  array();
       
        foreach ($rs as $usuario)
        {
          
            $UsuarioBL = new usuarioReglasNegocio();
            $UsuarioBL->initUsuario($usuario['id'], $usuario['nombre'] );
            array_push($usuarios,$UsuarioBL);
            
        }
       
        return $usuarios;
        
        
        
       
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
