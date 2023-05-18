<!DOCTYPE html>
<html>

<head>
    <title>Tablón de Anuncios</title>
    <link rel="stylesheet" href="../css/anunciosVista.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <meta charset="utf-8">

</head>

<body>
      
    <?php
        session_start(); 
        if (!isset($_SESSION['usuario']))
        {
            header("Location: login.php");
        }
   
    ?>  

    <nav class="navbar">
        <ul class="nav-list">
            <li class="nav-item"><a href="personalInfoVista.php">Info Personal</a></li>
            <li class="nav-item"><a href="comidasVista.html">Comidas</a></li>
            <li class="nav-item"><a href="rutinasVista.html">Entrenamientos</a></li>
            <li class="nav-item"><a href="#">Tablon de anuncios</a></li>
            <li class="nav-item right"><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
    

    <div class="container">

        <?php
       
       ini_set('display_errors', 1);

       ini_set('display_startup_errors', 1);

       error_reporting(E_ALL);

       require_once("../../Negocio/anunciosNegocio.php");

        $anunciosBL = new anunciosReglasNegocio();
        $datosAnuncio = $anunciosBL->obtenerAnuncios();
        
        
        

        foreach ($datosAnuncio as $anuncio)
        {
            $fecha = date_create($anuncio-> getFechaCreacion());
            $fechaMostrar = $fecha->format('d/m/Y');
            
           
           
            echo "<div class=anuncio>";
           
            echo "<div class=titulo>".$anuncio->getNombre()."</div>";
            echo"<div class=contenido>".$anuncio->getDescripcion()."</div>";
            echo" <div class=fecha>"."Creado por: ".$anuncio->getNombreEmpleado()  ." el ".$fechaMostrar."</div>";
           
           echo "</div>";
           
           
        }
   
        
       
?>
        
    </div>
</body>

</html>
