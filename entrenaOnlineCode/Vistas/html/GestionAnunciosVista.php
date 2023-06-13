<?php
require_once ("../../Negocio/anunciosNegocio.php");
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    
    
    if (isset($_POST['anuncioBorrar'])) {
        if ($_POST['anuncioBorrar']=="") {
            header("Location: " . $_SERVER['PHP_SELF']);
        }
        $comidaReglasNegocio = new anunciosReglasNegocio();
        $comidaReglasNegocio->deleteAnuncio($_POST['anuncioBorrar']);
        
        
        header("Location: " . $_SERVER['PHP_SELF']);
        
            }else  {
                $comidaReglasNegocio = new anunciosReglasNegocio();
                $comidaReglasNegocio->createAnuncio($_POST['nombre'],$_POST['descripcion']);
            
                header("Location: " . $_SERVER['PHP_SELF']);
            }
            
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Gestion Anuncios</title>
    <script src="../js/jquery.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bts-css/css/bootstrap.min.css">
    <script src="../js/bts-js/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/gestion.css">
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
     <script src="../js/formularioAnuncios.js"></script>
   <script src="../js/datosUsuario.js"></script>
   

    <nav class="barra-navegacion">
        <ul class="nav-list">
            <li class="nav-item"><a href="gestionUsuariosVista.php">Gestión de usuarios</a></li>
            <li class="nav-item"><a href="GestionAnunciosVista.php">Gestion Anuncios</a></li>
            <li class="nav-item"><a href="AdminVista.php">Gestion Entrenamientos</a></li>
            <li class="nav-item"><a href="GestionRecetasVista.php">Gestion Recetas</a></li>


            <li class="nav-item right"><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>



   

    <div class="title-div">
        <h1>Hola Admin <span class="nombreCliente"></span></h1>
        <h2>Gestor de Anuncios</h2>
    </div>

   

    <div class="desc">
        <p>Crea los Anuncios que veran los usuarios</p>
    </div>

   
    <form id="crearAnuncio" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="nombre">Nombre:</label>
  <input type="text" id="nombre" name="nombre" required>
  <br>
  
  <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" rows="4" cols="50" required></textarea><br><br>
  
  
  
  <br>
  <br>
  
  <input type="submit" value="Enviar">
</form>

   


<div class="desc">
    <p>Borrar los Anuncios que veran los usuarios </p>
</div>

<form id="formularioBorrarReceta" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="select-wrapper">
        <div class="select-row">
          

        <div class="select-container">
                    <select name="anuncioBorrar"  class="borrarAnuncio"  id="anuncioBorrar">
                        <option value="" selected>Anuncios</option>
                    </select>
                </div>
            </div>
        </div>
        <input type="submit" value="borrar" id="create-buton" class="create-button">
    </div>
</form>


    <!-- Toast container -->

    <div id="myToastContainer" class="toast-container top-0 end-0 p-3">
  </div>









</body>


</html>