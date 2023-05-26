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
    <link rel="stylesheet" href="../css/comidas.css">
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

    <div class="title-div">
        <h1>Dietas de <span class="nombreCliente"></span></h1>
        <h2>Crea tus Dietas</h2>
    </div>

    <div class="desc">
        <p>Elige tus recetas favoritas para un día eligiendo desayuno,comida,merienda ... 
        Y así poder crear tus dietas :)
        </p>
    </div>
   

    <form id="formulario" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="select-wrapper">
            <div class="select-row">
              
                <div class="select-container">
                    <select name="ejercicioUno" class="ejer" id="ejer1">
                        <option value="" selected>Desayuno</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioDos" class="ejer" id="ejer2">
                        <option value="" selected>Merienda</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioTres" class="ejer" id="ejer3">
                        <option value="" selected>Comida</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioCuatro" class="ejer" id="ejer4">
                        <option value="" selected>Merienda</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioCinco" class="ejer" id="ejer5">
                        <option value="" selected>Cena</option>
                    </select>
                </div>
            </div>
            <input type="submit" value="Crear Dieta" id="create-buton" class="create-button"></input>
        </div>

        </div>
        <div class="progress">
    <div class="progress-bar" data-percentage="75%">
        <span class="progress-text">50%</span>
    </div>
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