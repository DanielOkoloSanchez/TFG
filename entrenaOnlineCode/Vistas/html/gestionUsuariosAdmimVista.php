<?php
require_once ("../../Negocio/usuarioNegocio.php");
require_once ("../../Negocio/clienteNegocio.php");
require_once ("../../Negocio/adminNegocio.php");
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    
    


    if (isset($_POST['borrarAdmin'])) {
        $AdminBL = new adminReglasNegocio();
        $Admin = $AdminBL->deleteAdmin($_POST['borrarAdmin']);
        
        header("Location: " . $_SERVER['PHP_SELF']);

    }else {
        $UsuarioReglasNegocio = new usuarioReglasNegocio();
        $UsuarioReglasNegocio->insertarAdmin($_POST['nick'],$_POST['clave']);

        $AdminBL = new adminReglasNegocio();
        $Admin = $AdminBL->createAdmin($_POST['nombre'],$_POST['primerApellido'],$_POST['segundoApellido'],$_POST['fechaNacimiento'],$_POST['cargo']);
        
        header("Location: " . $_SERVER['PHP_SELF']);
    }



}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Gestión Admins</title>
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
    <script src="../js/formularioAdmin.js"></script>

   
    <nav class="barra-navegacion">
        <ul class="nav-list">
            <li class="nav-item"><a href="gestionUsuariosAdminVista.php">Gestión de Admins</a></li>
            

            <li class="nav-item right"><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>





    </div>

    <div class="title-div">
        <h1>Hola SuperAdmin</h1>
        <h2>Gestión de Empleados</h2>
    </div>



    <form id = "crearAdmins" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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

           
            <label for="fechaNacimiento">Fecha de Nacimiento:</label>
            <input type="date" name="fechaNacimiento" required>
          
        
            <label for="cargo">Cargo:</label>
            <select name="cargo" required>
                <option value="Entrenador">Entrenador</option>
                <option value="Mantenimiento">Mantenimiento</option>
                <option value="Recepcion">Recepcion</option>
            </select>

        <input type="submit" value="Guardar" >


        </form>





        <div class="desc">
            <p>Borrar los Admin cliente del sistema</p>
        </div>

        <form id="formularioBorrarAdmin" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="select-wrapper">
                <div class="select-row">
                    <div class="select-container">
                        <select name="borrarAdmin" class="admin" id="borrarAdmin">
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