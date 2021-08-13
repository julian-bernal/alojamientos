<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexion a la base de datos</title>
</head>
<body>
    <?php

        $host ="localhost";
        $port ="5432";
        $user ="postgres";
        $dbname ="alojamientos";
        $password ="root";

        $conexion = pg_connect("host= ".$host." port= ".$port." dbname= ".$dbname." user= ".$user." password= ".$password);

        /* Para validar que exista una conexion.
        if(isset($conexion)) {
            echo "<b>Conectado corectamente</b></br></br>";
            echo "<b>Base de datos:</b> ".$dbname."</br>";
            echo "<b>Conexion:</b> ".$conexion."</br></br>";
        }else{
            echo "No hay conexion :(";
        } */
        
    
    ?>
    
</body>
</html>