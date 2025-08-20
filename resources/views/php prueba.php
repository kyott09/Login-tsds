<html>
    <head>
    </head>
    <body>
        <form action="" method="post">
            Nombre: <input type="text" name="Nombre"><br>
            Apellido: <input type="text" name="Apellido"><br>
            DNI: <input type="text" name="DNI"><br>
            <input type="submit" value="Enviar">
        </form>
        <?php
        // Procesar solo si se envió el formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $servidor = "sql111.infinityfree.com";
            $usuario = "if0_39701780";
            $password = "tooH2gMlMvFe";
            $base = "if0_39701780_prueba";

            mysql_connect($servidor, $usuario, $password) or die("Error de conexión");
            mysql_select_db($base) or die("Error al seleccionar la base de datos");

            $nombre = $_POST['Nombre'];
            $apellido = $_POST['Apellido'];
            $dni = $_POST['DNI'];

            if (empty($nombre) || empty($apellido) || empty($dni)) {
                die("Todos los campos son obligatorios.");
            }
            if (!is_numeric($dni)) {
                die("El DNI debe ser un número.");
            }
            $nombre = mysql_real_escape_string($nombre);
            $apellido = mysql_real_escape_string($apellido);
            $dni = mysql_real_escape_string($dni);
            if (strlen($dni) != 8) {
                die("El DNI debe tener exactamente 8 dígitos.");
            }
            if (!preg_match("/^[a-zA-Z]+$/", $nombre)) {
                die("El nombre solo debe contener letras.");
            }
            if (!preg_match("/^[a-zA-Z]+$/", $apellido)) {
                die("El apellido solo debe contener letras.");
            }
            echo "Datos recibidos:<br>";
            echo "Nombre: $nombre<br>";
            echo "Apellido: $apellido<br>";
            echo "DNI: $dni<br>";

            $consulta = "INSERT INTO datos (Nombre, Apellido, DNI) VALUES ('$nombre', '$apellido', '$dni')";
            $resultado = mysql_query($consulta) or die("Error al insertar los datos");
            if ($resultado) {
                echo "Datos insertados correctamente.";
            } else {
                echo "Error al insertar los datos.";
            }
            mysql_close();
        }
        ?>
    </body>
</html>