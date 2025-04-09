<html lang="es-MX">
    <head><title>Ejemplo</title></head>
    <body>
        <?php
        // Mostrar errores para depuración
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        // Guardar nota
        if (isset($_POST['nota'])) {
            $filename = "Losdatosgb.txt";

            // Intentar abrir el archivo
            $ar = fopen($filename, "a");
            if (!$ar) {
                die("<b>Error:</b> No se pudo crear o abrir el archivo. Verifica los permisos.");
            }

            $TextoOriginal = $_POST['nota'];
            fputs($ar, $TextoOriginal . "\n");
            fclose($ar);

            echo "<br><b>SE GUARDÓ CORRECTAMENTE:</b><br><br>";
        } elseif (isset($_POST['leer'])) {
            $filename = "Losdatosgb.txt";

            // Verificar si el archivo existe
            if (file_exists($filename)) {
                $ar = fopen($filename, "r") or die("<b>Error:</b> No se pudo abrir el archivo.");

                // Leer y mostrar el contenido del archivo
                while (!feof($ar)) {
                    $vTexto = fgets($ar);
                    $nuevoTexto = nl2br($vTexto);
                    echo $nuevoTexto;
                }
                fclose($ar);
            } else {
                echo "<br><b>Error:</b> El archivo no existe.</b><br><br>";
            }
        } else {
            echo "<br><b>Error:</b> No se recibió ninguna acción válida.</b><br><br>";
        }
        ?>
    </body>
</html>