
<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require ("../../Negocio/loginNegocio.php");

if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $loginBL = new loginReglasNegocio();
    $rango =  $loginBL->verificar($_POST['usuario'],$_POST['clave']);
    $idCliente = $loginBL->obtenerUserId($_POST['usuario']);
    
   
    if ($rango==="admin" || $rango==="client")
    {
       
        session_start(); //inicia o reinicia una sesión
        $_SESSION['usuario'] = $_POST['usuario'];
       
        $_SESSION['idUsuario'] = $idCliente;
        setcookie("IdClienteCookie", $idCliente);
        
        
        if($rango==="client"){
        header("Location: personalInfoVista.php");
    }else{
        header("Location: AdminVista.php");
    }
    }
    else
    {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <meta charset = "UTF-8">
</head>

<body>
    
    <div class="login-form">
        <h1>Iniciar Sesion</h1>
        <form method="POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input name="usuario" type="text" placeholder="Usuario">
            <input  name="clave" type="password" placeholder="Contraseña">
            <input type="submit" value="Iniciar sesión">
        </form>
        <!-- <a href="#">¿Olvidaste tu contraseña?</a> -->
    </div>
</body>

</html>