<?php
require_once ("../../Negocio/usuarioNegocio.php");
require_once ("../../Negocio/clienteNegocio.php");
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    
    


    if (isset($_POST['borrarUsr'])) {
        $clienteReglasNegocio = new clienteReglasNegocio();
        $clienteReglasNegocio->deleteCliente($_POST['borrarUsr']);
        
        header("Location: " . $_SERVER['PHP_SELF']);

    }else {
        $UsuarioReglasNegocio = new usuarioReglasNegocio();
        $UsuarioReglasNegocio->insertarCliente($_POST['nick'],$_POST['clave']);

        $ClienteBL = new clienteReglasNegocio();
        $cliente = $ClienteBL->createCliente($_POST['nombre'],$_POST['primerApellido'],$_POST['segundoApellido'],$_POST['sexo'],$_POST['fechaNacimiento'],$_POST['altura'],$_POST['peso'],$_POST['complexion'],$_POST['objetivo']);
        
        header("Location: " . $_SERVER['PHP_SELF']);
    }



}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Gestión Usuario</title>
    <script src="../js/jquery.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bts-css/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/gestion.css">
    <script src="../js/bts-js/js/bootstrap.min.js"></script>

</head>

<body>
    <?php

   
   
        session_start(); // reanudamos la sesión
        if (!isset($_SESSION['usuario']))
        {
            header("Location: login.php");
        }
        
       
        
    ?>

    <script src="../js/datosUsuario.js"></script>
    <script src="../js/formularioUsuario.js"></script>

    <nav class="barra-navegacion">
        <ul class="nav-list">
            <li class="nav-item"><a href="gestionUsuariosVista.php">Gestión de usuarios</a></li>
            <li class="nav-item"><a href="GestionAnunciosVista.php">Gestion Anuncios</a></li>
            <li class="nav-item"><a href="AdminVista.php">Gestion Entrenamientos</a></li>
            <li class="nav-item"><a href="GestionRecetasVista.php">Gestion Recetas</a></li>


            <li class="nav-item right"><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>






    </div>

    <div class="title-div">
        <h1>Hola Admin <span class="nombreCliente"></span></h1>
        <h2>Gestión de Clientes</h2>
    </div>



    <form id = "crearUsuarios" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for=" nombre">Nick:</label>
        <input type="text" name="nick" required>

        <label for="clave">Clave:</label>
        <input class="clave" type="text" name="clave" required readonly>





       
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>

            <label for="primerApellido">Primer Apellido:</label>
            <input type="text" name="primerApellido" required>

            <label for="segundoApellido">Segundo Apellido:</label>
            <input type="text" name="segundoApellido" required>

            <label for="sexo">Sexo:</label>
            <select name="sexo" required>
                <option value="Hombre">Hombre</option>
                <option value="Mujer">Mujer</option>
            </select>

            <label for="fechaNacimiento">Fecha de Nacimiento:</label>
            <input type="date" name="fechaNacimiento" required>

            <label for="altura">Altura:</label>
            <input type="number" name="altura" step="0.01" required>

            <label for="peso">Peso:</label>
            <input type="number" name="peso" step="0.1" required>

            <label for="complexion">Complexión:</label>
            <select name="complexion" required>
                <option value="Hectomorfo">Hectomorfo</option>
                <option value="Mesoformo">Mesoformo</option>
                <option value="Endomorfo">Endomorfo</option>
            </select>

            <label for="objetivo">Objetivo:</label>
            <select name="objetivo" required>
                <option value="mantenimiento">Mantenimiento</option>
                <option value="volumen">Volumen</option>
                <option value="definicion">Definición</option>
            </select>

        <input type="submit" value="Guardar" >


        </form>





        <div class="desc">
            <p>Borrar los usuarios cliente del sistema</p>
        </div>

        <form id="formularioBorrarUser" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="select-wrapper">
                <div class="select-row">
                    <div class="select-container">
                        <select name="borrarUsr" class="usr" id="borrarUsr">
                            <option value="" selected>Usuario</option>
                        </select>
                    </div>
                </div>





            </div>
            <input type="submit" value="borrar" id="create-buton" class="create-button"></input>
            </div>
        </form>


        <!-- Toast container -->

        <div id="myToastContainer" class="toast-container top-0 end-0 p-3">

        </div>










</body>



</html>