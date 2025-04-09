<html lang="es-MX">
    <head><title>Ejemplo</title></head>
    <body>
        <?php
        // Mostrar errores para depuración
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if (isset($_POST['nota'])) {
            $filename = "Losdatosgb.txt";

            // Intentar abrir el archivo
            $ar = fopen($filename, "a");
            if (!$ar) {
                die("<b>Error:</b> No se pudo crear o abrir el archivo. Verifica los permisos.");
            }

            // Escribir la nota en el archivo
            fputs($ar, $_POST['nota'] . "\n");
            fclose($ar);

            echo "<br><b>SE GUARDÓ CORRECTAMENTE:</b><br><br>";
        } else {
            echo "<br><b>Error: No se recibió ninguna nota.</b><br><br>";
        }
        elseif (isset($_POST('leer'))){
           if(file_exists($ar));
           $ar = fopen("datosgb.txt","r")or die("Problemas, problemas");
            
         while(!feof($ar)){
            $vTexto = fgets($ar);
            $nuevoTexto = nl2br($vTexto);
            echo $nuevoTexto;
         }
         fclose($ar);
        }
        ?>
    </body>
</html>