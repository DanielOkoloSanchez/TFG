<!DOCTYPE html>
<html>

<head>
    <title>Estadísticas Personales</title>
    <link rel="stylesheet" href="../css/personalInfo.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <meta charset="utf-8">
</head>

<body>

<?php
//TODO (hacer que peso y edad los calcule el programa) 
    require ("../../Negocio/clienteNegocio.php");
        session_start(); // reanudamos la sesión
        if (!isset($_SESSION['usuario']))
        {
            header("Location: login.php");
        }
        
        
    ?>

    <nav class="navbar">
        <ul class="nav-list">
           
            <li class="nav-item"><a href="#info-personal">Info Personal</a></li>
            <li class="nav-item"><a href="comidasVista.html">Comidas</a></li>
            <li class="nav-item"><a href="rutinasVista.html">Entrenamientos</a></li>
            <li class="nav-item"><a href="anunciosVista.php">Tablon de anuncios</a></li>
            <li class="nav-item right"><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
        
    <?php
             $clienteBL = new clienteReglasNegocio();  
             $datos = $clienteBL->obtenerClienteInfo($_SESSION['idUsuario']); 
             
             echo( "<div class=title>");
             echo ("<h1>"."Estadísticas Personales de ".$datos["nombre"]." " .$datos["primerApellido"]."</h1>");
             echo("</div>");
             var_dump($datos);

             echo("<div class=stats-container>");
             echo("<div class=stat id=peso>");

             echo("<h2> Peso </h2>");
             echo($datos["peso"]."kg");
             echo("</div>");

            echo"<div class=stat id=altura>";
            echo"<h2>Altura</h2>";
            echo"<p>$datos[altura] cm</p>";
            echo"</div>";

            echo"<div class=stat id=imc>";
            echo"<h2>IMC</h2>";
            echo "<p></p>";
            echo "</div>";

            echo "<div class=stat id=edad>";
            echo "<h2>Edad</h2>";
            echo"<p></p>";
            echo"</div>";

            echo"<div class=stat id=Objetivo>";
            echo"<h2>Objetivo</h2>";
            echo"<p>$datos[objetivo]</p>";
            echo"</div>";


             echo("</div>");
    ?>
   
        
   

   
       
            
             
        </div>
       
        
       

        
    <a href="personalInfoVista(edicionMode).html"><div class="edit-button"> Editar valores</div></a>
</body>

</html>