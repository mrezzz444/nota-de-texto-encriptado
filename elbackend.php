<html lang="es-MX">
    <head><title>Ejemplo</title></head>
    <body>
        <?php
        // ESTE DOCUMENTO TOCA PEGARLO DENTRO DEL XAMPP
        if (isset($_POST['nota'])) {
            // TO DO: Hacer el filename personalizable
            $ar = fopen("Losdatosgb.txt", "a") or die("Problemas de acceso");
            fputs($ar, $_POST['nota']);
            fputs($ar, "\n");
            echo "<br><b>SE GUARDÓ CORRECTAMENTE:</b><br><br>";
        } else {
            echo "<br><b>Error: No se recibió ninguna nota.</b><br><br>";
        }
        ?>
    </body>
</html>