<?php
require ("../../Negocio/entrenamientosNegocio.php");
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $EntrenamientosReglasNegocio = new entrenamientosReglasNegocio();
    $EntrenamientosReglasNegocio->createTablaEntrenamientos($_POST['nombreTabla'], $_POST['ejercicioUno'],$_POST['ejercicioDos'],$_POST['ejercicioTres'],$_POST['ejercicioCuatro'],$_POST['ejercicioCinco']);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Comidas</title>
    <link rel="stylesheet" href="../css/calendario.css">
    <script src="../js/jquery.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bts-css/css/bootstrap.min.css">
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
    <script src="../js/entrenos.js"></script>
    <script src="../js/datosUsuario.js"></script> 

    <nav class="barra-navegacion">
        <ul class="nav-list">
            <li class="nav-item"><a href="personalInfoVista.php">Info Personal</a></li>
            <li class="nav-item"><a href="comidasVista.php">Comidas</a></li>
            <li class="nav-item"><a href="rutinasVista.php">Entrenamientos</a></li>
            <li class="nav-item"><a href="calendarioVista.php">Calendario de Dietas</a></li>
            <li class="nav-item"><a href="anunciosVista.php">Tablón de anuncios</a></li>

            <li class="nav-item right"><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>


    
    <form id="formularioDeHorario" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="title-div">
        <h1>Calendario de <span class="nombreCliente"></span></h1>
        <h2>Organiza tus dietas</h2>
    </div>
    
    <div class="desc">
        <p>Aqui puedes organizar tus dietas para la semana.</p>
    </div>

    <div class="select-wrapper">
            
            <div class="select-row">
                <div class="select-container">
                    <input id="nombre" name="nombreTabla" required type="text" placeholder="Nombre">
                </div>
        
                <div class="select-container">
                    <select name="ejercicioUno" class="ejer" id="ejer1">
                        <option value="Comida">Comida del Lunes</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioDos" class="ejer" id="ejer2">
                        <option value="Comida">Comida del Martes</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioTres" class="ejer" id="ejer3">
                        <option value="Comida">Comida del Miercoles</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioCuatro" class="ejer" id="ejer4">
                        <option value="Comida">Comida del Jueves</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioCinco" class="ejer" id="ejer5">
                        <option value="Comida">Comida del Viernes</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioSeis" class="ejer" id="ejer6">
                        <option value="Comida">Comida del Sabado</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioSiete" class="ejer" id="ejer7">
                        <option value="Comida">Comida del Domingo</option>
                    </select>
                </div>

                <button type="submit" class="add-button" data-bs-toggle="tooltip" data-bs-placement="right" title="Añadir dieta al calendario">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
</svg>
            </button>

            </div>
            
        </div>
    </form>


    <br>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
                <th>Sábado</th>
                <th>Domingo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Rutina 1</td>
                <td>Ejercicio 1</td>
                <td>Ejercicio 2</td>
                <td>Ejercicio 3</td>
                <td>Ejercicio 4</td>
                <td>Ejercicio 5</td>
                <td>Ejercicio 6</td>
                <td>Ejercicio 7</td>
            </tr>
            <tr>
                <td>Rutina 2</td>
                <td>Ejercicio 1</td>
                <td>Ejercicio 2</td>
                <td>Ejercicio 3</td>
                <td>Ejercicio 4</td>
                <td>Ejercicio 5</td>
                <td>Ejercicio 6</td>
                <td>Ejercicio 7</td>
            </tr>
        </tbody>
    </table>

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
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                </button>
            </div>
            <div class="toast-body">
                No se pudo crear la tabla de entrenamientos.
            </div>
        </div>

    </div>

</body>

</html>
