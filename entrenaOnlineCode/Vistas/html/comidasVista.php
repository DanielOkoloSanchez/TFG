<?php
require_once ("../../Negocio/comidaNegocio.php");
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $comidasReglasNegocio = new comidasReglasNegocio();
    $comidasReglasNegocio->createAlimentacionDelDia($_POST['nombreDieta'],$_POST['recetaDesayuno'],$_POST['recetaMerienda'],$_POST['recetaComida'],$_POST['recetaMeriendaDos'],$_POST['recetaCena']);

    header("Location: " . $_SERVER['PHP_SELF']);
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
    
    <script src="../js/datosUsuario.js"></script>
    <script src="../js/comidas.js"></script>  
    
  
    

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

    <div class="title">
            <h2> Valor Nutritivo : <span class="caloriasConsumidas">0</span> de <span class="caloriasConsumir"></span></h2>
        </div>

    <div class="desc">
        <p>Elige tus recetas favoritas para un día eligiendo desayuno,comida,merienda ... 
        Y así poder crear tus dietas :))
        </p>
    </div>
   

    <form id="formulario" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="select-wrapper">
            <div class="select-row">
            <div class="select-container">
                    <input id="nombre" name="nombreDieta" required type="text" placeholder="Nombre">
                </div>
              
                <div class="select-container">
                    <select name="recetaDesayuno" class="receta" id="recetaDesayuno">
                        <option value="" selected>Desayuno</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="recetaMerienda" class="receta" id="recetaMerienda">
                        <option value="" selected>Merienda</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="recetaComida" class="receta" id="recetaComida">
                        <option value="" selected>Comida</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="recetaMeriendaDos" class="receta" id="recetaMeriendaDos">
                        <option value="" selected>Merienda</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="recetaCena" class="receta" id="recetaCena">
                        <option value="" selected>Cena</option>
                    </select>
                </div>
            </div>
            <input type="submit" value="Crear Dieta" id="create-buton" class="create-button"></input>
        </div>

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
                El nombre de la dieta debe contener entre 3 y 15 letras.
            </div>
        </div>


        <div id="myToast2" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Existen caracteres especiales o espacios en el nombre de la Dieta.
            </div>
        </div>



        <div id="myToast3" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                </button>
            </div>
            <div class="toast-body">
                No se pudo crear la dieta.
            </div>
        </div>

<!-- 
        <div id="myToast5" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                </button>
            </div>
            <div class="toast-body">
                La comida no esta lista , vuelva mas tarde...  .
            </div>
        </div> -->


        <div id="myToast4" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                </button>
            </div>
            <div class="toast-body">
                O paso algo inesperado... :((
            </div>
        </div>

        <div id="myToast6" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                </button>
            </div>
            <div class="toast-body">
                Error Campos sin rellenar encontrados
            </div>
        </div>

        <div id="myToast7" class="toast bg-warning text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Aviso</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                </button>
            </div>
            <div class="toast-body">
                No puedes Repetir tu comida en la cena ni tus meriendas . 
            </div>
        </div>

        <div id="myToast8" class="toast bg-warning text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Aviso</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                </button>
            </div>
            <div class="toast-body">
                Calorias Insuficientes , Recuerda que estas en volumen.
            </div>
        </div>

        <div id="myToast9" class="toast bg-warning text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Aviso</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                </button>
            </div>
            <div class="toast-body">
                Demasiadas Calorias , seguramente estes buscando el cuerpo ideal.
            </div>
        </div>

    </div>

</body>

</html>