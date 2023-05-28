<?php
require ("../../Negocio/entrenamientosNegocio.php");
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $EntrenamientosReglasNegocio = new entrenamientosReglasNegocio();
    $EntrenamientosReglasNegocio->createTablaEntrenamientos($_POST['nombreTabla'], $_POST['diaSemana'],$_POST['ejercicioUno'],$_POST['ejercicioDos'],$_POST['ejercicioTres'],$_POST['ejercicioCuatro'],$_POST['ejercicioCinco']);

    header("Location: " . $_SERVER['PHP_SELF']);
    
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
            <li class="nav-item"><a href="personalInfoVista.php">Info Personal</a></li>
            <li class="nav-item"><a href="comidasVista.php">Comidas</a></li>
            <li class="nav-item"><a href="rutinasVista.php">Entrenamientos</a></li>
            <li class="nav-item"><a href="calendarioVista.php">Calendario de Dietas</a></li>
            <li class="nav-item"><a href="anunciosVista.php">Tablón de anuncios</a></li>

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
        <h1>Rutinas de <span class = "nombreCliente"></span></h1>
        <h2>Elige tus Ejercicios</h2>
    </div>

    <div class="desc">
        <p>Crea tu tabla de 5 ejercicios para un dia de la semana</p>
    </div>
    <form id="formulario" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="select-wrapper">
            <div class="select-row">
                <div class="select-container">
                    <input id="nombre" name="nombreTabla" required type="text" placeholder="Nombre">
                </div>

                <div class="select-container">
                    <select name="diaSemana" id="dias-semana">
                        <option value="">-</option>
                        <option value="lunes">Lunes</option>
                        <option value="martes">Martes</option>
                        <option value="miercoles">Miércoles</option>
                        <option value="jueves">Jueves</option>
                        <option value="viernes">Viernes</option>
                    </select>
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


    <div class="accordion" id="accordionPanelsStayOpenExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
       Lunes
      </button>
    </h2>
    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
      <div class="accordion-body">
       <ul class = "lista-lunes">
        
       </ul>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
        Martes
      </button>
    </h2>
    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
      <div class="accordion-body">
      <ul class = "lista-Martes">
        
        </ul>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed headeArcordeon" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
        Miercoles
      </button>
    </h2>
    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
      <div class="accordion-body">
      <ul class = "lista-Miercoles">
        
        </ul>
      </div>
    </div>
  </div>
</div>



<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
            Jueves
        </button>
    </h2>
    <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
        <div class="accordion-body">
            <ul class="lista-Jueves">
            
            </ul>
        </div>
    </div>
</div>

<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
            Viernes
        </button>
    </h2>
    <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
        <div class="accordion-body">
            <ul class="lista-Viernes">
            
            </ul>
        </div>
    </div>
</div>



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