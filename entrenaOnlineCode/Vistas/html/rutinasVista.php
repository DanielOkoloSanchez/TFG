<!DOCTYPE html>
<html>

<head>
    <title>Rutinas</title>
    <link rel="stylesheet" href="../css/entrenos.css">
    <script src="../js/jquery.js"></script>
    <meta charset="utf-8">
</head>

<body>
  <script src="../js/entrenosjs.js"></script>
  
    <nav class="navbar">
        <ul class="nav-list">
            <li class="nav-item"><a href="personalInfoVista.html">Info Personal</a></li>
            <li class="nav-item"><a href="comidasVista.html">Comidas</a></li>
            <li class="nav-item"><a href="#entrenamientos">Entrenamientos</a></li>
            <li class="nav-item"><a href="anunciosVista.html">Tablón de anuncios</a></li>
            <li class="nav-item right"><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
  
    <div class="select-partecuerpo" >
        <label for="parte-cuerpo">Parte del Cuerpo:</label>
        <select id="parte-cuerpo">
            <option value="pierna">Pierna</option>
            <option value="brazo">Brazo</option>
            <option value="pecho">Pecho</option>
            <option value="espalda">Espalda</option>
        </select>
    </div>

    <div class="title">
        <h1>Rutinas de Manolo</h1>
        <h2>Elige tus Ejercicios</h2>
        <p>Crea tu tabla de 5 ejercicios para un dia </p>
    </div>

    <?php

 ?>
    

    <form action="rutinasVista.html">
        <div class="select-wrapper">
            <div class="select-row">
                <div class="select-container">
                    <select id="ejerUno">
                        <option>Ejercicio 1</option>
                    </select>
                </div>
                <div class="select-container">
                    <select id="ejerDos">
                        <option>Ejercicio 2</option>
                    </select>
                </div>
                <div class="select-container">
                    <select id="ejerTres">
                        <option>Ejercicio 3</option>
                    </select>
                </div>
                <div class="select-container">
                    <select id="ejerCuatro">
                        <option>Ejercicio 4</option>
                    </select>
                </div>
                <div class="select-container">
                    <select id="ejerCinco">
                        <option>Ejercicio 5</option>
                    </select>
                </div>
            </div>
            <input type="submit" value="Crear rutina"  class="create-button">
        </div>
    </form>

    <br>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Día 1</th>
                <th>Día 2</th>
                <th>Día 3</th>
                <th>Día 4</th>
                <th>Día 5</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Rutina 1</td>
                <td>Ejercicio 1</td>
                <td>Ejercicio 2</td>
                <td>Ejercicio 3</td>
                <td>Ejercicio 4</td>
                <td>Ejercicio 5</td>
            </tr>
            <tr>
                <td>Rutina 2</td>
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
