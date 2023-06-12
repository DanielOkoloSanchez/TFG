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
require_once("../../Negocio/comidaNegocio.php");
require_once("../../Negocio/horarioNegocio.php");
?>

<?php
   
   if (isset($_POST['horarioId'])) {
    $id = $_POST['horarioId'];
    $horarioReglasNegocio = new horarioReglasNegocio();
    $datos = $horarioReglasNegocio->deleteHorario($id);
    header("Location: calendarioVista.php");
}

    $horarioId = $_GET['horarioId'];
    $id = $_GET['id'];
    $comidasReglasNegocio = new comidasReglasNegocio();
    $datos=$comidasReglasNegocio->obtenerAlimentacionDiaById($id);
?>

<?php
require_once ("../../Negocio/clienteNegocio.php");
session_start();
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
      <h1>Comida <?php echo($datos["nombre_alimentacion"]) ?></h1>
    </div>

    <div class="accordion" id="accordionPanelsStayOpenExample">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
            aria-controls="panelsStayOpen-collapseOne">
            Desayuno
          </button>
        </h2>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
          <div class="accordion-body">
           <?php echo $datos["nombre_desayuno"] ?><br><?php echo $datos["descripcion_desayuno"] ?>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
            aria-controls="panelsStayOpen-collapseTwo">
            Merienda media mañana
          </button>
        </h2>
        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
          <div class="accordion-body">
          <?php echo $datos["nombre_merienda_mediodia"] ?><br><?php echo $datos["descripcion_merienda_mediodia"] ?>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed headeArcordeon" type="button" data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
            aria-controls="panelsStayOpen-collapseThree">
            Comida
          </button>
        </h2>
        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
          <div class="accordion-body">
          <?php echo $datos["nombre_comida"] ?><br><?php echo $datos["descripcion_comida"] ?>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
            aria-controls="panelsStayOpen-collapseFour">
            Merienda (Tarde)
          </button>
        </h2>
        <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
          <div class="accordion-body">
          <?php echo $datos["nombre_merienda_tarde"] ?><br><?php echo $datos["descripcion_merienda_tarde"] ?>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false"
            aria-controls="panelsStayOpen-collapseFive">
           Cena
          </button>
        </h2>
        <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
        <?php echo $datos["nombre_cena"] ?>"><?php echo $datos["descripcion_cena"] ?>
        </div>
      </div>
    
  </div>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <button type="submit" class="edit-button" name="horarioId" value="<?php echo $horarioId; ?>">Borrar Horario</button>
    </form>
</body>

</html>