<?php
require ("../../Negocio/entrenamientosNegocio.php");
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $EntrenamientosReglasNegocio = new entrenamientosReglasNegocio();
    $EntrenamientosReglasNegocio->createListaEntrenoDia($_POST['diaSemana'],$_POST['listaEntrenoId']);

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





    <div class="title-div">
        <h1>Rutinas de <span class = "nombreCliente"></span></h1>
        <h2>Elige tus Tablas de entrenamiento</h2>
    </div>

    <div class="desc">
        <p>Crea tu tabla de 5 ejercicios para un dia de la semana</p>
    </div>
    <form id="formularioListaEntrenosDia" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="select-wrapper">
            <div class="select-row">
               
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
                    <select name="listaEntrenoId" class="entr" id="listaEntrenoId">
                        <option value="" selected>Tabla de Ejercicios</option>
                    </select>
                </div>
                
               
            </div>
            <input type="submit" value="Añadir rutina" id="create-buton" class="create-button"></input>
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