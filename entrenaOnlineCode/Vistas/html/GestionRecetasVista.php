<?php
require_once ("../../Negocio/comidaNegocio.php");
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    
    
    if (isset($_POST['recetaBorrar'])) {
        $comidaReglasNegocio = new comidasReglasNegocio();
        $comidaReglasNegocio->deleteReceta($_POST['recetaBorrar']);
        
        
        header("Location: " . $_SERVER['PHP_SELF']);
        
            }else  {
                var_dump("hello");
                $comidaReglasNegocio = new comidasReglasNegocio();
                $comidaReglasNegocio->createReceta($_POST['nombre'],$_POST['descripcion'],$_POST['calorias'],$_POST['tipo'],$_POST['momentoComida']);
            
                header("Location: " . $_SERVER['PHP_SELF']);
            }
            
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Gestion Recetas</title>
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
    <script src="../js/formularioComida.js"></script>
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
        <h2>Gestor de recetas</h2>
    </div>

   

    <div class="desc">
        <p>Crea las Recetas para usuarios</p>
    </div>

    <form id="crearReceta" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" rows="4" cols="50" required></textarea><br><br>


    <label for="calorias">Calorías:</label>
    <input type="number" id="calorias" name="calorias" required><br><br>

    <label for="tipo">Tipo:</label>
    <select id="tipo" name="tipo" required>
      <option value="mantenimiento">Mantenimiento</option>
      <option value="volumen">Volumen</option>
      <option value="definicion">Definición</option>
    </select><br><br>

    <label for="momentoComida">Momento de Comida:</label>
    <select id="momentoComida" name="momentoComida" required>
      <option value="desayuno">Desayuno</option>
      <option value="merienda">Merienda</option>
      <option value="comida">Comida</option>
      <option value="cena">Cena</option>
    </select><br><br>

    <input type="submit" value="Insertar Receta">
  </form>

   


<div class="desc">
    <p>Borrar  los Ejercicios para usuarios se borraran las tablas con este ejercicio</p>
</div>

<form id="formularioBorrarReceta" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="select-wrapper">
        <div class="select-row">
          

        <div class="select-container">
                    <select name="recetaBorrar"  class="borrarReceta"  id="recetaBorrar">
                        <option value="" selected>Ejercicio</option>
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