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
    // 🔹 Configuración de IONOS
    $zoneId = "c4e26dee-b575-11f0-85e2-0a58644419f7"; // Zone ID de tu dominio
    $apiKey = "e26e8202086a4de89779dd03a42f2f94.pIfKSpLBtE8b0zSy5Ap-c5AOydTYxezjW25xSF_IOMDgNzWUv4Iprxft56mtLUdwDlMBT35AZvQm9fjCO_KA1g"; // API Key directa (para pruebas)

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $url = trim($_POST["url"]);

        // 🔹 Comprobación básica de URL y longitud
        if (filter_var($url, FILTER_VALIDATE_URL) && strlen($url) <= 300) {

            // 🔹 Generar hash corto (primeros 6 caracteres del MD5)
            $codigo = substr(md5($url), 0, 6);
            $subdominio = $codigo . ".hugocm.es";

            echo "<p><b>URL válida:</b> $url</p>";  
            echo "<p><b>Código generado:</b> $codigo</p>";
            echo "<p><b>Enlace corto:</b> https://$subdominio</p>";

            // 🔹 Comprobar si ya existe el registro TXT en el DNS
            $registro = dns_get_record($subdominio, DNS_TXT);

            if ($registro) {
                echo "<p><b>Ya existe el subdominio:</b> $subdominio</p>";
                echo "<p><b>Valor TXT actual:</b> " . $registro[0]['txt'] . "</p>";
            } else {
                // 🔹 Crear registro TXT en IONOS si no existe
                echo "<p><b>No existe en el DNS, creando el registro TXT...</b></p>";

                // Crear JSON correctamente con json_encode (más seguro)
                $payload = json_encode([[
                    "name"    => $codigo,
                    "type"    => "TXT",
                    "content" => $url,
                    "ttl"     => 60
                ]]);

                // Inicializar cURL
                $ch = curl_init("https://api.hosting.ionos.com/dns/v1/zones/$zoneId/records");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "X-API-Key: $apiKey",
                    "Content-Type: application/json"
                ]);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                // 🔹 AÑADIDO: desactivar la verificación SSL dentro del contenedor (evita error 503)
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

                // Ejecutar la solicitud
                curl_exec($ch);
                $codigo_http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                // Resultado
                if ($codigo_http == 200 || $codigo_http == 201) {
                    echo "<p><b>✅ Registro creado correctamente:</b> $subdominio</p>";
                    echo "<p><b>Enlace corto:</b> https://$subdominio</p>";
                } else {
                    echo "<p><b>❌ Error al crear el registro (código $codigo_http)</b></p>";
                }
            }

        } else {
            echo "<p><b>Error:</b> La URL no es válida o es demasiado larga.</p>";
        }
    }
    ?>
</body>
</html>
