<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require("./entrenaOnlineCode/AccesoDatos/loginAccesoDatos.php");

function test_alta_usuario()
{
    $u = new loginAccesoDatos();
     $u->insertar('admin','admin','admin123');
     $u->insertar('jose','client','jose123');
     $u->insertar('maria','client','maria123');
}

// function test_verificar_usuario_encontrado()
// {
//     $perfil_esperado = 'jugador';
//     $u = new loginAccesoDatos();
//     $perfil = $u->verificar('alex','passwordalex');
//     return $perfil === $perfil_esperado;
// }


var_dump(test_alta_usuario());
//var_dump(test_verificar_usuario_encontrado());