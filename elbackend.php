<html lang="es-MX">
<head><title>Ejemplo</title></head>
<body>
<?php
// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Guardar nota
if (isset($_POST['nota'])) {
    $archivoPersonalizado = false;
    $filename = "";

    // Verificar si el usuario proporcionó un nombre de archivo
    if (isset($_POST['archivo']) && trim($_POST['archivo']) !== "") {
        $nombreUsuario = trim($_POST['archivo']);
        $nombreUsuario = preg_replace("/[^a-zA-Z0-9_-]/", "", $nombreUsuario); // Limpieza del nombre
        if (pathinfo($nombreUsuario, PATHINFO_EXTENSION) !== "txt") {
            $nombreUsuario .= ".txt";
        }
        $filename = $nombreUsuario;
        $archivoPersonalizado = true;
    }

    // Guardar la nota original
    $textoOriginal = $_POST['nota'];
    file_put_contents($filename, $textoOriginal . "\n");

    // Guardar la nota encriptada (nota2)
    if (isset($_POST['nota2']) && !empty($_POST['nota2'])) {
        $filenameNota2 = str_replace(".txt", "_master.txt", $filename); // Crear un nombre para el archivo de nota2
        $textoEncriptado = $_POST['nota2'];
        file_put_contents($filenameNota2, $textoEncriptado . "\n");

        echo "<br><b>SE GUARDÓ CORRECTAMENTE:</b><br><br>";
        echo "Archivo guardado: <b>$filenameNota2</b><br>";
    }

    echo "<br><b>SE GUARDÓ CORRECTAMENTE:</b><br><br>";
    echo "Archivo guardado: <b>$filename</b><br>";
    if ($archivoPersonalizado) {
        echo "<b>Archivo personalizado usado:</b> $filename<br><br>";
    } else {
        echo "<b>Archivo por defecto usado:</b> $filename<br><br>";
    }
} elseif (isset($_POST['leer'])) {
    $filename = isset($_POST['archivo']) && !empty($_POST['archivo']) ? $_POST['archivo'] : "Losdatosgb";

    // Limpieza del nombre del archivo
    $filename = preg_replace("/[^a-zA-Z0-9_-]/", "", $filename);

    // Verificar si se usa la llave maestra
    if (isset($_POST['usarLlaveMaestra'])) {
        $filename .= "_master"; // Agregar sufijo _master
    }

    if (pathinfo($filename, PATHINFO_EXTENSION) !== "txt") {
        $filename .= ".txt";
    }

    // Verificar si el archivo existe
    if (file_exists($filename)) {
        $contenido = file_get_contents($filename);

        // Mostrar contenido
        $lineas = explode("\n", $contenido);
        echo "<b>Nota:</b><br><br>";
        foreach ($lineas as $linea) {
            if (trim($linea) != "") {
                echo nl2br(htmlspecialchars($linea)) . "<br>";
            }
        }
    } else {
        echo "<b>Error:</b> El archivo <b>$filename</b> no existe.";
    }
}
?>
</body>
</html>
