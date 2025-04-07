<html language="sp-mx">
    <head><title>  ejemplo </title></head>
    <body>
        <?php
         if(isset($_POST['grabar']))
         {
            $ar=fopen("datosgb.txt","a")or die("problemas de acceso");
            fputs($ar,$_REQUEST['nombre']);
            fputs($ar,"\n");
            fputs($ar,$_REQUEST['comentarios']);
            fputs($ar,"/n");
            fclose($ar);

            echo "<br> <b> SE GUARDO CORRECTAMENTE : </b><br><br>";
            echo "nombre : ".$_REQUEST['nombre']."<br>";
            echo "comentarios : <br>".$_REQUEST['comentarios']."<br>";
         }
        ?>
    </body>
</html> 