<?php
require ("../../Negocio/entrenamientosNegocio.php");
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    
    
    if (isset($_POST['ejercicioUno'])) {
        // Procesar la primera sección del formulario (creación de tabla de entrenamientos)
        $EntrenamientosReglasNegocio = new entrenamientosReglasNegocio();
        $EntrenamientosReglasNegocio->createTablaEntrenamientos($_POST['nombreTabla'],$_POST['ejercicioUno'],$_POST['ejercicioDos'],$_POST['ejercicioTres'],$_POST['ejercicioCuatro'],$_POST['ejercicioCinco']);

        header("Location: " . $_SERVER['PHP_SELF']);
    } elseif (isset($_POST['parte-cuerpo-Creacion'])) {
        $EntrenamientosReglasNegocio = new entrenamientosReglasNegocio();
        $EntrenamientosReglasNegocio->createEntrenamiento($_POST['nombreTabla'], $_POST['parte-cuerpo-Creacion'], $_POST['descripcion']);
        
        
        header("Location: " . $_SERVER['PHP_SELF']);
    }elseif (isset($_POST['borrarEjer'])) {
        $EntrenamientosReglasNegocio = new entrenamientosReglasNegocio();
        $EntrenamientosReglasNegocio->deleteEntrenamiento($_POST['borrarEjer']);
        
        
        header("Location: " . $_SERVER['PHP_SELF']);
    }
    
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Rutinas</title>
    <script src="../js/jquery.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bts-css/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/gestion.css">
    <script src="../js/bts-js/js/bootstrap.min.js"></script>

</head>

<body>
    <?php

    require_once ("../../Negocio/clienteNegocio.php");
   
        session_start(); // reanudamos la sesión
        if (!isset($_SESSION['usuario']))
        {
            header("Location: login.php");
        }
        
       
        
    ?>

    <script src="../js/datosUsuario.js"></script>

    <nav class="barra-navegacion">
        <ul class="nav-list">
            <li class="nav-item"><a href="gestionUsuariosVista.php">Gestión de usuarios</a></li>
            <li class="nav-item"><a href="GestionAnunciosVista.php">Gestion Anuncios</a></li>
            <li class="nav-item"><a href="AdminVista.php">Gestion Entrenamientos</a></li>


            <li class="nav-item right"><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>






    </div>

    <div class="title-div">
        <h1>Hola Admin <span class="nombreCliente"></span></h1>
        <h2>Gestión de Clientes</h2>
    </div>



    <form action="insertar_usuario.php" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for=" nombre">Nick:</label>
        <input type="text" name="nick" required>

        <label for="clave">Clave:</label>
        <input class="clave" type="text" name="clave" required readonly>





        <form action="insertar_cliente.php" method="POST">
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
            <p>Borrar los Ejercicios para usuarios</p>
        </div>

        <form id="formularioEjercicios" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="select-wrapper">
                <div class="select-row">


                    <div class="select-container">
                        <select name="borrarEjer" class="ejer" id="borrarEjer">
                            <option value="" selected>Ejercicio</option>
                        </select>
                    </div>
                </div>





            </div>
            <input type="submit" value="borrar" id="create-buton" class="create-button"></input>
            </div>
        </form>


        <!-- Toast container -->

        <div id="myToastContainer" class="toast-container top-0 end-0 p-3">

            <div id="myToast1" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">


                <div class="toast-header">
                    <strong class="me-auto">Error</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    El nombre de la tabla debe contener entre 3 y 15 letras.
                </div>
            </div>


            <div id="myToast2" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Error</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Existen caracteres especiales o espacios en el nombre de la Tabla.
                </div>
            </div>



            <div id="myToast3" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Error</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    No se puede dejar ningún campo null.
                </div>
            </div>


            <div id="myToast4" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Error</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    No puedes repetir ejercicios en una misma tabla.
                </div>
            </div>










</body>



</html>