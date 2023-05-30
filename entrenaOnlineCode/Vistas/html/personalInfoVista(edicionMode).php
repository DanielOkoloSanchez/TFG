<!DOCTYPE html>
<html>

<head>
    <title>Estadísticas Personales</title>
    <link rel="stylesheet" href="../css/personalInfo.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <meta charset="utf-8">
    <script src="../js/jquery.js"></script>
    <link rel="stylesheet" href="../css/bts-css/css/bootstrap.min.css">
    <script src="../js/bts-js/js/bootstrap.min.js"></script>
</head>



    <?php
    //TODO (hacer que peso y edad los calcule el programa) 
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
    <script src="../js/datosUsuario.js"></script>

<div class="container">
    <div class="title">
        <h1>Estadísticas Personales</h1>
    </div>

    <div class="card-container">
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                
            </div>
            <ul class="list-group list-group-flush">
                
            </ul>
        </div>
    </div>
</div>

<a href="personalInfoVista(edicionMode).html">
    <div class="edit-button">Editar valores</div>
</a>
</body>

</html>
