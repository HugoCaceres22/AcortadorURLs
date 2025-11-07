<?php
// resolver.php - Redirige a la URL original almacenada en un registro DNS TXT

if (!isset($_GET['code'])) {
    die("❌ Error: No se ha recibido ningún código.");
}

$code = trim($_GET['code']);
$domain = $code . ".hugocm.es";

// Buscar el registro TXT correspondiente
$registro = dns_get_record($domain, DNS_TXT);

if ($registro && isset($registro[0]['txt'])) {
    $url = $registro[0]['txt'];

    // Redirigir automáticamente
    header("Location: $url");
    exit;
} else {
    echo "<h2>❌ Código no encontrado en DNS</h2>";
    echo "<p>No existe ningún registro TXT con el nombre <b>$domain</b></p>";
    echo "<p>Comprueba que el código existe o que el registro DNS fue creado correctamente.</p>";
}
?>
