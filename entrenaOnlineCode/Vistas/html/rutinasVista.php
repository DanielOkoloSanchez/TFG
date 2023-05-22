<?php
require ("../../Negocio/entrenamientosNegocio.php");
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $EntrenamientosReglasNegocio = new entrenamientosReglasNegocio();
    $EntrenamientosReglasNegocio->createTablaEntrenamientos($_POST['nombreTabla'], $_POST['diaSemana'],$_POST['ejercicioUno'],$_POST['ejercicioDos'],$_POST['ejercicioTres'],$_POST['ejercicioCuatro'],$_POST['ejercicioCinco']);
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Rutinas</title>
    <link rel="stylesheet" href="../css/entrenos.css">
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
    <script src="../js/entrenosjs.js"></script>

    <nav class="barra-navegacion">
        <ul class="nav-list">
            <li class="nav-item"><a href="personalInfoVista.html">Info Personal</a></li>
            <li class="nav-item"><a href="comidasVista.html">Comidas</a></li>
            <li class="nav-item"><a href="#entrenamientos">Entrenamientos</a></li>
            <li class="nav-item"><a href="anunciosVista.html">Tablón de anuncios</a></li>
            <li class="nav-item right"><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>

 
 
    <div class="select-partecuerpo">
        <label for="parte-cuerpo">Parte del Cuerpo:</label>
        <select id="parte-cuerpo">
            <option value="def">-</option>
            <option value="pierna">Pierna</option>
            <option value="brazo">Brazo</option>
            <option value="pecho">Pecho</option>
            <option value="espalda">Espalda</option>
        </select>

        <button disabled class="reset-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                <path
                    d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
            </svg>
        </button>
    </div>

    <div class="title-div">
        <h1>Rutinas de Manolo</h1>
        <h2>Elige tus Ejercicios</h2>
    </div>

    <div class="desc">
        <p>Crea tu tabla de 5 ejercicios para un día</p>
    </div>
    <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="select-wrapper">
            <div class="select-row">
                <div class="select-container">
                    <input name="nombreTabla" required  type="text" placeholder="Nombre">
                </div>

                <div class="select-container">
                    <select name="diaSemana" id="dias-semana">
                        <option value="lunes">Lunes</option>
                        <option value="martes">Martes</option>
                        <option value="miercoles">Miércoles</option>
                        <option value="jueves">Jueves</option>
                        <option value="viernes">Viernes</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioUno"class="ejer" id="ejer1">
                        <option value=""  selected>Ejercicio</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioDos" class="ejer" id="ejer2">
                        <option value="" selected>Ejercicio</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioTres" class="ejer" id="ejer3">
                        <option value=""  selected>Ejercicio</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioCuatro" class="ejer" id="ejer4">
                        <option value=""  selected>Ejercicio</option>
                    </select>
                </div>
                <div class="select-container">
                    <select name="ejercicioCinco" class="ejer" id="ejer5">
                        <option value=""  selected>Ejercicio</option>
                    </select>
                </div>
            </div>
            <input type="submit"  class="create-button">Crear rutina</input>
        </div>
    </form>

    <br>
    <table>
        <thead>
            <tr>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
            </tr>
        </thead>
        <tbody>
            <tr>
               
                <td>Ejercicio 1</td>
                <td>Ejercicio 2</td>
                <td>Ejercicio 3</td>
                <td>Ejercicio 4</td>
                <td>Ejercicio 5</td>
            </tr>
            <tr>
                
                <td>Ejercicio 1</td>
                <td>Ejercicio 2</td>
                <td>Ejercicio 3</td>
                <td>Ejercicio 4</td>
                <td>Ejercicio 5</td>
            </tr>
        </tbody>
    </table>

</body>

</html>