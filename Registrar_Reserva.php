<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="CSS\styles_RegistrarReserva.css">
    <title>Registrar Reserva</title>
</head>
<body>
    <?php
        include 'C:\XAMPP\htdocs\Alojamientos\Conexion a la base de Datos\Conexion_BDD_Alojamientos.php';
        include 'C:\XAMPP\htdocs\Alojamientos\Funciones\Funciones.php';
    ?>
    <h1 class="text-light bg-dark">Registrar Reserva</h1>
    <?php
        $reservaMatrimonial = "";
        $reservaUnifamiliar = "";
        $reservaFamiliar = "";

        if (isset($_POST['aljamientoMatrimonial'])) {
            $reservaMatrimonial = $_POST['aljamientoMatrimonial'];
            $id_alojamientoMatrimonial = 1;
    ?>
            <br>
            <div class="container">
                <div class="card" class="p-3 mb-2 bg-light text-dark">
                    <h4>Matrimonial</h4>
                    <img src="Imagenes/Alojamiento_matrimonial.jpg">
                    <br><b>Proceso de reservación</b>
                    <hr>
                    <?php
                        registrar_Reserva($id_alojamientoMatrimonial);
                    ?>
                </div>
            </div>
<?php   }  ?>
    
    <?php
        
        if (isset($_POST['alojamientoUnifamiliar'])) {
            $reservaUnifamiliar = $_POST['alojamientoUnifamiliar'];
            $id_alojamientoUniFamiliar = 2;
    ?>        
            <br>
            <div class="container">
                <div class="card" class="p-3 mb-2 bg-light text-dark">
                    <h4>Unifamiliar</h4>
                    <img src="Imagenes/Alojamiento_Unifamiliar.jpg">
                    <br><b>Proceso de reservación</b>
                    <hr>
                    <?php
                        //echo "<p>Esto es lo que envian el tipo submit del alojamiento UniFamiliar: $reservaUnifamiliar </p>";
                        //echo "Id del alojamiento Unifamiliar: $id_alojamientoUniFamiliar";
                        registrar_Reserva($id_alojamientoUniFamiliar);
                    ?>      
                </div>
            </div>
    <?php
        }
   ?>       

    <?php    
        if (isset($_POST['alojamientoFamiliar'])) {
            $reservaFamiliar = $_POST['alojamientoFamiliar'];
            $id_alojamientoFamiliar = 3;
    ?>
    <br>
    <div class="container">
        <div class="card" class="p-3 mb-2 bg-light text-dark">
            <h4>Familiar</h4>
            <img src="Imagenes/Alojamiento_Familiar.jpg">
            <br><b>Proceso de reservación</b>
            <hr>
            <?php
                //echo "<p>Esto es lo que envian el tipo submit del alojamiento Familiar: $reservaFamiliar </p>";
                //echo "Id del alojamiento Familiar: $id_alojamientoFamiliar";
                registrar_Reserva($id_alojamientoFamiliar);
            ?>
        </div>
    </div>
<?php  } ?>
            
        

    
</body>
</html>