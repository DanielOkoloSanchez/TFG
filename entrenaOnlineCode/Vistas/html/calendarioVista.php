<?php
require ("../../Negocio/dietaNegocio.php");
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $EntrenamientosReglasNegocio = new dietaReglasNegocio();
    $EntrenamientosReglasNegocio->createHorarioComidas($_POST['nombreTabla'], $_POST['comidaLunes'],$_POST['comidaMartes'],$_POST['comidaMiercoles'],$_POST['comidaJueves'],$_POST['comidaViernes'],$_POST['comidaSabado'],$_POST['comidaDomingo']);

    header("Location: " . $_SERVER['PHP_SELF']);
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
  
    <script src="../js/comidas.js"></script>
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


    
    <form id="formularioHorario" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
                    <input id = "nombre" name="nombreTabla"  required type="text" placeholder="Nombre">
                </div>
        
                <div class="select-container">
                    <select name="comidaLunes" class="dieta" id="comidaLunes">
                        <option value="">Comida del Lunes</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="comidaMartes" class="dieta" id="comidaMartes">
                        <option value="">Comida del Martes</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="comidaMiercoles" class="dieta" id="comidaMiercoles">
                        <option value="">Comida del Miercoles</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="comidaJueves" class="dieta" id="comidaJueves">
                        <option value="">Comida del Jueves</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="comidaViernes" class="dieta" id="comidaViernes">
                        <option value="">Comida del Viernes</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="comidaSabado" class="dieta" id="comidaSabado">
                        <option value="">Comida del Sabado</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="comidaDomingo" class="dieta" id="comidaDomingo">
                        <option value="">Comida del Domingo</option>
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
    <table class = "horario">
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
                No se pudo crear el horario.
            </div>
        </div>


        <div id="myToast4" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                </button>
            </div>
            <div class="toast-body">
                No te saltes ningun dia de dieta
            </div>
        </div>

    </div>

</body>

</html>
