<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require("./entrenaOnlineCode/AccesoDatos/loginAccesoDatos.php");

function InicializarSuperAdmin()
{
    $u = new loginAccesoDatos();
    $u->insertar('superAdmin','superAdmin','admin123');
     $u->insertar('admin','admin','admin123');
     $u->insertar('jose','client','jose1234');
     $u->insertar('maria','client','maria123');
}




InicializarSuperAdmin();
//var_dump(test_verificar_usuario_encontrado());