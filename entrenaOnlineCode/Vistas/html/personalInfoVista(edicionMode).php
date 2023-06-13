<?php
require_once ("../../Negocio/usuarioNegocio.php");
require_once ("../../Negocio/clienteNegocio.php");
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    
    if (isset($_POST['objetivo']) && isset($_POST['peso'])) {
        $clienteReglasNegocio = new clienteReglasNegocio();
        $clienteReglasNegocio->updateUsuario($_POST['objetivo'],$_POST['peso']);
       
    }elseif(isset($_POST['objetivo']))  {
        $clienteReglasNegocio = new clienteReglasNegocio();
        $clienteReglasNegocio->updateObjetivo($_POST['objetivo']);
        
    }
       
    header("Location: personalInfoVista.php");

}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Estadísticas Personales</title>
    <link rel="stylesheet" href="../css/personalInfo.css">
    <meta charset="utf-8">
    <script src="../js/jquery.js"></script>
    <link rel="stylesheet" href="../css/bts-css/css/bootstrap.min.css">
    <script src="../js/bts-js/js/bootstrap.min.js"></script>
</head>

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
    <script src="../js/comidas.js"></script>
    <script src="../js/datosUsuarioEdicion.js"></script>

    <div class="container">
        <div class="title">
            <h1>Estadísticas Personales</h1>
        </div>
        <form id = "ActualizarUsuarios" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="card-container">
            <div class="card" style="width: 18rem;">
                <div class="card-header">

                </div>
                <ul class="list-group list-group-flush">

                </ul>
            </div>
        </div>
    </div>

    
    <input class="edit-button" type="submit" value="Guardar" >
</form>

</body>
<div id="myToastContainer" class="toast-container top-0 end-0 p-3">
<div id="myToast3" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                </button>
            </div>
            <div class="toast-body">
                inserte valor valido al peso
            </div>
        </div>
</div>

</html>
