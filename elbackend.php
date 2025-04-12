<html lang="es-MX">
<head><title>Ejemplo</title></head>
<body>
<?php
// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Función para encriptar texto
function encriptarTexto($texto, $llave) {
    return base64_encode(openssl_encrypt($texto, 'AES-128-ECB', $llave));
}

// Función para desencriptar texto
function desencriptarTexto($textoEncriptado, $llave) {
    return openssl_decrypt(base64_decode($textoEncriptado), 'AES-128-ECB', $llave);
}

// Función para obtener la llave maestra
function obtenerLlaveMaestra() {
    return file_exists("llavemaestra.txt") ? file_get_contents("llavemaestra.txt") : "";
}

//guardar nota
if (isset($_POST['nota'])) {
    $filename = "Losdatosgb.txt";
    $llave = isset($_POST['llave_individual']) ? $_POST['llave_individual'] : obtenerLlaveMaestra();

    if (!$llave) {
        die("<b>Error:</b> No se proporcionó una llave válida.");
    }

    $textoOriginal = $_POST['nota'];
    $textoEncriptado = encriptarTexto($textoOriginal, $llave);
    file_put_contents($filename, $textoEncriptado . "\n");

    echo "<br><b>SE GUARDÓ CORRECTAMENTE:</b><br><br>";


// Leer nota y desencriptar

} elseif (isset($_POST['leer'])) {
    $filename = isset($_POST['archivo']) && !empty($_POST['archivo']) ? $_POST['archivo'] : "Losdatosgb.txt";
    $llave = isset($_POST['llave_individual']) ? $_POST['llave_individual'] : obtenerLlaveMaestra();

    if (!$llave) {
        die("<b>Error:</b> No se encontró una llave válida.");
    }

    if (file_exists($filename)) {
        $contenido = file_get_contents($filename);

        //Solo texto 
        if (isset($_POST['solo_texto']) && $_POST['solo_texto'] == "1") {
            echo $contenido;
            exit;
        }

        //mostrar desencriptado
        $lineas = explode("\n", $contenido);
        echo "<b>Nota</b><br><br>";
        foreach ($lineas as $linea) {
            if (trim($linea) != "") {
                $desencriptado = desencriptarTexto(trim($linea), $llave);
                echo nl2br(htmlspecialchars($desencriptado)) . "<br>";
            }
        }
    } else {
        echo "<br><b>Error:</b> El archivo no existe.<br><br>";
    }

//llave maestra
} elseif (isset($_POST['maestra'])) {
    $llaveMaestra = $_POST['maestra'];

    if (empty($llaveMaestra)) {
        echo "<b>Error:</b> La llave maestra no puede estar vacía.<br><br>";
    } else {
        file_put_contents("llavemaestra.txt", $llaveMaestra);
        echo "<b>Llave maestra guardada exitosamente.</b>";
    }

} else {
    echo "<br><b>Error:</b> No se recibió ninguna acción válida.<br><br>";
}
?>
</body>
</html>
