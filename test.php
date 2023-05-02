<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require("./entrenaOnlineCode/AccesoDatos/loginAccesoDatos.php");

function test_alta_usuario()
{
    $u = new loginAccesoDatos();
     $u->insertar('clienteDoomie','client','clienteDoomie');
     $u->insertar('adminDoomie','admin','adminDoomie');
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