<html language="sp-mx">
    <head><title>  ejemplo </title></head>
    <body>
        <?php
        //ESTE DOCUMENTO TOCA PEGARLO DENTRO DEL XAMPP
         if(isset($_POST['Encriptar']))
         {
            // TO DO Hacer el filename personalizable
            $ar=fopen("datosgb.txt","a")or die("problemas de acceso");
            fputs($ar,$_REQUEST['nota']);
            fputs($ar,"\n");

            echo "<br> <b> SE GUARDO CORRECTAMENTE : </b><br><br>";

         }
        ?>
    </body>
</html> 