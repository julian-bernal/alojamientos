<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="CSS\styles.css">
    <title>Alojamientos</title>
</head>
<body>
    <?php 
        include 'C:\XAMPP\htdocs\Alojamientos\Conexion a la base de Datos\Conexion_BDD_Alojamientos.php';
        include 'C:\XAMPP\htdocs\Alojamientos\Funciones\Funciones.php';
        date_default_timezone_set("America/Bogota");
    ?>
    
    <br>
    <div class = "div">
        <h1 class="text-light bg-dark">
            ALOJAMIENTOS RURALES
        </h1> 
    </div>
    
    <div class= "div2">
        <a href="\Login_Alojamientos\index.html">Log Out</a>
    </div>

    <br>

    <div class="container">

        <div class="card" class="p-3 mb-2 bg-light text-dark">
            <img src="Imagenes/Alojamiento_matrimonial.jpg">
            <h4>Matrimonial</h4>
            <br>
            <p>
                <?php
                    $descripcion = pg_query($conexion,"select id_alojamiento,descripcion FROM bookings.alojamiento WHERE id_alojamiento = 1;");
                    if(isset($descripcion)){
                        $consulta = pg_fetch_array($descripcion);
                        echo $consulta["descripcion"];
                    }
                ?>
            </p>
            <hr>
            <p>
                <?php 
                    $id_alojamientoMatrimonial = $consulta["id_alojamiento"];
                    actualizarEstadoAutomaticamente($id_alojamientoMatrimonial);
                    $soloEstado = pg_query($conexion, "select * FROM estado_alojamientos WHERE id_alojamiento = 1;");
                    $estadoConsutado = pg_fetch_array($soloEstado);
                    listar_estados($estadoConsutado);
                ?>
            </p>
            <form action="Registrar_Reserva.php" method = "POST">
                <input type="submit" class="btn btn-dark" name="aljamientoMatrimonial" value="Reservar">
            </form>
        </div>  
        
        <div class="card" class="p-3 mb-2 bg-light text-dark">
            <img src="Imagenes/Alojamiento_Unifamiliar.jpg">
            <h4>Unifamiliar</h4>
            <br>
            <p>
                <?php
                    $descripcion = pg_query($conexion,"select id_alojamiento,descripcion FROM bookings.alojamiento WHERE 
                    id_alojamiento = 2;");
                    if(isset($descripcion)){
                        $consulta = pg_fetch_array($descripcion);
                        echo $consulta["descripcion"];
                    }
                ?>  
            </p>
            <hr>
            <p>
                <?php
                    $id_alojamientoUnifamiliar = $consulta["id_alojamiento"];
                    actualizarEstadoAutomaticamente($id_alojamientoUnifamiliar);
                    $soloEstado = pg_query($conexion, "select * FROM estado_alojamientos WHERE id_alojamiento = 2;");
                    $estadoConsutado = pg_fetch_array($soloEstado);
                    listar_estados($estadoConsutado);
                ?>
            </p>
            <form action="Registrar_Reserva.php" method = "POST">
                <input type="submit" class="btn btn-dark" name="alojamientoUnifamiliar" value="Reservar">
            </form>
        </div>
        
        <div class="card" class="p-3 mb-2 bg-light text-dark">
            <img src="Imagenes/Alojamiento_Familiar.jpg">
            <h4>Familiar</h4>
            <br>
            <p>
                <?php
                    $descripcion = pg_query($conexion,"select id_alojamiento,descripcion FROM bookings.alojamiento WHERE
                    id_alojamiento = 3;");
                    if(isset($descripcion)){
                        $consulta = pg_fetch_array($descripcion);
                        echo $consulta["descripcion"];
                    }
                ?>
            </p>
            <hr>
            <p>
                <?php
                    $id_alojamientoFamiliar = $consulta["id_alojamiento"];
                    actualizarEstadoAutomaticamente($id_alojamientoFamiliar);
                    $soloEstado = pg_query($conexion, "select * FROM estado_alojamientos WHERE id_alojamiento = 3;");
                    $estadoConsutado = pg_fetch_array($soloEstado);
                    listar_estados($estadoConsutado);
                ?>
            </p>
            <form action="Registrar_Reserva.php" method = "POST">
                <input type="submit" class="btn btn-dark" name="alojamientoFamiliar" value="Reservar">
            </form>
        </div>
        
    </div>


</body>
</html>