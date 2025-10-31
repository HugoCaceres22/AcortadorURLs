<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acortador de URLs</title>
</head>
<body>
    <h2>Acortador de URLs con DNS TXT</h2>

    <form method="post">
        <input type="text" name="url" placeholder="Introduce una URL" required>
        <input type="submit" value="Acortar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $url = trim($_POST["url"]);

        // Comprobación básica de URL y longitud
        if (filter_var($url, FILTER_VALIDATE_URL) && strlen($url) <= 300) {

            // Generar hash corto (primeros 6 caracteres del MD5)
            $codigo = substr(md5($url), 0, 6);

            echo "<p><b>URL válida:</b> $url</p>";
            echo "<p><b>Código generado:</b> $codigo</p>";
            echo "<p><b>Enlace corto:</b> $codigo.hugocm.es</p>";

        } else {
            echo "<p><b>Error:</b> La URL no es válida o es demasiado larga.</p>";
        }
    }
    ?>
</body>
</html>
