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
    <script src="../js/bts-js/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/entrenos.css">




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
    <script src="../js/entrenos.js"></script>
    <script src="../js/datosUsuario.js"></script>

    <nav class="barra-navegacion">
        <ul class="nav-list">
            <li class="nav-item"><a href="gestionUsuariosVista.php">Gestión de usuarios</a></li>
            <li class="nav-item"><a href="GestionAnunciosVista.php">Gestion Anuncios</a></li>
            <li class="nav-item"><a href="AdminVista.php">Gestion Entrenamientos</a></li>


            <li class="nav-item right"><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>



    <div class="select-partecuerpo">
        <label for="parte-cuerpo">Parte del Cuerpo:</label>
        <select id="parte-cuerpo">
            <option value="def">-</option>
            <option value="pierna">Pierna</option>
            <option value="brazo">Brazo</option>
            <option value="pecho">Pecho</option>
            <option value="espalda">Espalda</option>
        </select>

        <button disabled class="reset-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                <path
                    d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
            </svg>
        </button>
    </div>

    <div class="title-div">
        <h1>Hola Admin <span class="nombreCliente"></span></h1>
        <h2>Creador de Ejercicios</h2>
    </div>

    <div class="desc">
        <p>Crea las tablas de 5 ejercicios para los usuarios</p>
    </div>
    <form id="formulario" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="select-wrapper">
            <div class="select-row">
                <div class="select-container">
                    <input id="nombre" name="nombreTabla" required type="text" placeholder="Nombre">
                </div>


                <div class="select-container">
                    <select name="ejercicioUno" class="ejer" id="ejer1">
                        <option value="" selected>Ejercicio</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioDos" class="ejer" id="ejer2">
                        <option value="" selected>Ejercicio</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioTres" class="ejer" id="ejer3">
                        <option value="" selected>Ejercicio</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioCuatro" class="ejer" id="ejer4">
                        <option value="" selected>Ejercicio</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioCinco" class="ejer" id="ejer5">
                        <option value="" selected>Ejercicio</option>
                    </select>
                </div>
            </div>
            <input type="submit" value="Crear rutina" id="create-buton" class="create-button"></input>
        </div>
    </form>

    <br>


    <div class="desc">
        <p>Crea los Ejercicios para usuarios</p>
    </div>

    <form id="formularioEjercicios" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="select-wrapper">
            <div class="select-row">
                <div class="select-container">
                    <input id="nombre" name="nombreTabla" required type="text" placeholder="Nombre">
                </div>


      
             
                <div class="select-container">
                <select id="parte-cuerpo-Creacion" name="parte-cuerpo-Creacion">
                <option value="def">Parte del Cuerpo</option>
                <option value="pierna">Pierna</option>
                <option value="brazo">Brazo</option>
                <option value="pecho">Pecho</option>
                <option value="espalda">Espalda</option>
                </select>

                </div>

                <div class="select-container">
                    <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea>
                </div>



            </div>
            <input type="submit" value="Crear Ejercicio" id="create-buton" class="create-button"></input>
        </div>
    </form>

   


<div class="desc">
    <p>Crea los Ejercicios para usuarios</p>
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