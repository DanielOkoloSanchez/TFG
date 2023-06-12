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
require_once("../../Negocio/horarioNegocio.php");
?>

<?php
   if (isset($_POST['Id'])) {
    $id = $_POST['Id'];
    $horarioReglasNegocio = new horarioReglasNegocio();
    $datos = $horarioReglasNegocio->deleteHorario($id);
    header("Location: calendarioVista.php");
}

    $id = $_GET['id'];
    $horarioReglasNegocio = new horarioReglasNegocio();
    $datos = $horarioReglasNegocio->obtenerHorarioComidaById($id);
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
      <h1>Horario <?php echo $datos["nombreHorario"] ?></h1>
    </div>

    <div class="accordion" id="accordionPanelsStayOpenExample">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
            aria-controls="panelsStayOpen-collapseOne">
            Lunes
          </button>
        </h2>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
          <div class="accordion-body">
            <a href="alimentacionDiaVista.php?id=<?php echo $datos["idAlimentacionLunes"] ?>"><?php echo $datos["nombreLunes"] ?></a>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
            aria-controls="panelsStayOpen-collapseTwo">
            Martes
          </button>
        </h2>
        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
          <div class="accordion-body">
            <a href="alimentacionDiaVista.php?id=<?php echo $datos["idAlimentacionMartes"] ?>"><?php echo $datos["nombreMartes"] ?></a>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed headeArcordeon" type="button" data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
            aria-controls="panelsStayOpen-collapseThree">
            Miércoles
          </button>
        </h2>
        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
          <div class="accordion-body">
            <a href="alimentacionDiaVista.php?id=<?php echo $datos["idAlimentacionMiercoles"] ?>"><?php echo $datos["nombreMiercoles"] ?></a>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
            aria-controls="panelsStayOpen-collapseFour">
            Jueves
          </button>
        </h2>
        <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
          <div class="accordion-body">
            <a href="alimentacionDiaVista.php?id=<?php echo $datos["idAlimentacionJueves"] ?>"><?php echo $datos["nombreJueves"] ?></a>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false"
            aria-controls="panelsStayOpen-collapseFive">
            Viernes
          </button>
        </h2>
        <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
          <div class="accordion-body">
            <a href="alimentacionDiaVista.php?id=<?php echo $datos["idAlimentacionViernes"] ?>"><?php echo $datos["nombreViernes"] ?></a>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false"
            aria-controls="panelsStayOpen-collapseSix">
            Sábado
          </button>
        </h2>
        <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse">
          <div class="accordion-body">
            <a href="alimentacionDiaVista.php?id=<?php echo $datos["idAlimentacionSabado"] ?>"><?php echo $datos["nombreSabado"] ?></a>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false"
            aria-controls="panelsStayOpen-collapseSeven">
            Domingo
          </button>
        </h2>
        <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse">
          <div class="accordion-body">
            <a href="alimentacionDiaVista.php?id=<?php echo $datos["idAlimentacionDomingo"] ?>"><?php echo $datos["nombreDomingo"] ?></a>
          </div>
        </div>
      </div>
    </div>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <button type="submit" class="edit-button" name="Id" value="<?php echo $id; ?>">Borrar</button>
    </form>
  </div>
</body>

</html>