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
            <option value="-">-</option>
            <option value="pierna">Pierna</option>
            <option value="brazo">Brazo</option>
            <option value="pecho">Pecho</option>
            <option value="espalda">Espalda</option>
        </select>

        <button class="reset-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
</svg>
        </button>
    </div>



    <div class="title-div">
        <h1>Rutinas de Manolo</h1>
        <h2>Elige tus Ejercicios</h2>
       
    </div>

    <div class="desc"><p>Crea tu tabla de 5 ejercicios para un dia </p></div>
    <form action="rutinasVista.html">
        <div class="select-wrapper">
            <div class="select-row">

                <div class="select-container">
                    <select id="dias-semana">
                        <option value="lunes">Lunes</option>
                        <option value="martes">Martes</option>
                        <option value="miercoles">Miércoles</option>
                        <option value="jueves">Jueves</option>
                        <option value="viernes">Viernes</option>
                    </select>
                </div>

                <div class="select-container">
                    <select class="ejer" id="ejer1">
                        <option value="" disabled selected>Ejercicio 1</option>
                    </select>
                </div>
                <div class="select-container">
                    <select class="ejer" id="ejer2">
                        <option value="" disabled selected>Ejercicio 2</option>
                    </select>
                </div>
                <div class="select-container">
                    <select class="ejer" id="ejer3">
                        <option value="" disabled selected>Ejercicio 3</option>
                    </select>
                </div>
                <div class="select-container">
                    <select class="ejer" id="ejer4">
                        <option value="" disabled selected>Ejercicio 4</option>
                    </select>
                </div>
                <div class="select-container">
                    <select class="ejer" id="ejer5">
                        <option value="" disabled selected>Ejercicio 5</option>
                    </select>
                </div>
            </div>
            <input type="submit" value="Crear rutina" class="create-button">
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