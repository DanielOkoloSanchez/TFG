
<!DOCTYPE html>
<html>

<head>
    <title>Tabla de Ejercicios</title>
    <link rel="stylesheet" href="../css/personalInfo.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <meta charset="utf-8">
    <script src="../js/jquery.js"></script>
    <link rel="stylesheet" href="../css/bts-css/css/bootstrap.min.css">
    <script src="../js/bts-js/js/bootstrap.min.js"></script>
</head>


<?php
require_once ("../../Negocio/anunciosNegocio.php");
require_once("../../Negocio/TablasEntrenamientosNegocio.php");

?>

<?php
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $TablasEntrenamientosNegocio = new tablasEntrenamientosReglasNegocio();
        $datos = $TablasEntrenamientosNegocio->deleteTablaEjer($id);
        header("Location: rutinasVista.php");
    }
    $TablaId= $_GET['EjerciciosId'];
    $Id = $_GET['Id'];

    $TablasEntrenamientosNegocio = new tablasEntrenamientosReglasNegocio();
   $datos = $TablasEntrenamientosNegocio->getTablaEjerciciosById($TablaId);
   
    ?>
    <?php
    require_once ("../../Negocio/clienteNegocio.php");
    session_start(); // reanudamos la sesión
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
    }
    ?>
<body>

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
    
    <script src="../js/datosUsuario.js"></script>
    <script src="../js/entrenos.js"></script>

<div class="container">
    <div class="title">
        <h1>Tabla <?php echo($datos['nombre']);    ?> </h1>
    </div>

   
   
    <div class="accordion" id="accordionPanelsStayOpenExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
      <?php echo($datos["nombreEntreno1"])?>
      </button>
    </h2>
    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
      <div class="accordion-body">
      <?php echo($datos["descripcionEntreno1"])?>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
      <?php echo($datos["nombreEntreno2"])?>
      </button>
    </h2>
    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
      <div class="accordion-body">
      <?php echo($datos["descripcionEntreno2"])?>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed headeArcordeon" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
      <?php echo($datos["nombreEntreno3"])?>
      </button>
    </h2>
    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
      <div class="accordion-body">
      <?php echo($datos["descripcionEntreno3"])?>
      </div>
    </div>
  </div>
</div>



<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
        <?php echo($datos["nombreEntreno4"])?>
        </button>
    </h2>
    <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
        <div class="accordion-body">
            <ul class="lista-Jueves">
            <?php echo($datos["descripcionEntreno4"])?>
            </ul>
        </div>
    </div>
</div>

<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
        <?php echo($datos["nombreEntreno5"])?>
        </button>
    </h2>
    <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
        <div class="accordion-body">
        <?php echo($datos["descripcionEntreno5"])?>
        </div>
    </div>
</div>


<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <button type="submit" class="edit-button" name="id" value="<?php echo $Id; ?>">Borrar</button>
</form>
</body>

</html>
