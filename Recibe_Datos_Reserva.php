<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibe Datos</title>
</head>
<body>
    <h1>Recibe Datos</h1>
    
    <?php

        include 'C:\XAMPP\htdocs\Alojamientos\Conexion a la base de Datos\Conexion_BDD_Alojamientos.php';
    
        
        //Datos Reserva- Insertamos los datos en la tabla reserva

        $idAlojamiento = $_POST['alojamiento'];
        $tipoRegimen = $_POST['tipoRegimen'];
        $cedulaEmpleado = $_POST['cedulaEmpleado'];
        $numeroPersonas = $_POST['numeroPersonas'];
        $fechaIngreso = $_POST['fechaIngreso'];
        $horaIngreso = $_POST['horaIngreso'];
        $fechaSalida = $_POST['fechaSalida'];
        $horaSalida = $_POST['horaSalida'];

        $fechaHoraIngreso = "$fechaIngreso $horaIngreso:00.59";
        $fechaHoraSalida = "$fechaSalida $horaSalida:00.59";

        
        echo "Id del aljamiento: $idAlojamiento<br>";
        echo "Tipo de Regimen: $tipoRegimen<br>";
        echo "Cedula del empleado: $cedulaEmpleado<br>";
        echo "Número total de personas: $numeroPersonas<br>";
        echo "Fecha y hora de ingreso: $fechaHoraIngreso<br>";
        echo "Fecha y hora de salida: $fechaHoraSalida<br>";
        

        
        if (isset($idAlojamiento) && isset($tipoRegimen) && isset($cedulaEmpleado) && isset($numeroPersonas) &&
            isset($fechaIngreso) && isset($horaIngreso) && isset($fechaSalida) && isset($horaSalida)) 
        {   
            //$insertReserva = insertamos los valores en la tabla bookings.reserva; 
            /*INSERT INTO bookings.reserva(numero_personas,fecha_ingreso,fecha_salida,fk_rel_alojamiento_regimen,fk_empleado) 
            VALUES(2,'2021/07/25 13:50:00.59','2021/07/26 13:50:00.59',1,1); */  

            pg_insert($conexion, "bookings.reserva", array('numero_personas'=> $numeroPersonas,'fecha_ingreso'=> $fechaHoraIngreso,
            'fecha_salida'=> $fechaHoraSalida, 'fk_rel_alojamiento_regimen'=> $tipoRegimen, 'fk_empleado'=> $cedulaEmpleado));
            header('location:index.php');
            
        }
    ?>

    <?php 

        /*Insertamos los datos en la tabla rel_cliente_empeado si el cleinte ya existe*/
    
        $idEmpleado = $_POST['cedulaEmpleado'];
        $idCliente = $_POST['idCliente'];

        if (isset($idEmpleado) && isset($idCliente)) {
            echo "El id del empleado es: $idEmpleado y el id del cliente es: $idCliente";
            pg_insert($conexion, "bookings.rel_cliente_empeado", array('fk_cliente'=> $idCliente,'fk_empleado'=> $idEmpleado ));
            header('location:Registrar_Buscar_cliente.php');
        }
    
    ?>

    <?php
        //Si el cliente no existe, insertamos los datos en la tabla cliente y en la tabla rel_cliente_empeado

        //INSERT INTO bookings.cliente(cedula,nombres,apellidos,correo,telefono) 
        //VALUES('10110100','FRANCISCO','OLMEDO CASTRO','francisco.castro@ucp.edu.co','3187497260');

        $cedulaCliente = $_POST['CedulaIngresada'];
        $nombresCliente = $_POST['nombresCliente'];
        $apellidosCliente = $_POST['apellidosCliente'];
        $correoCliente = $_POST['correoCliente'];
        $telefonoCliente= $_POST['telefonoCliente'];
        $id_atiendeCliente = $_POST['cedulaEmpleado'];

        $nombresMayuscula = strtoupper($nombresCliente);//para convertir la caden en mayuscula 
        $apellidosMayuscula = strtoupper($apellidosCliente);

        /*
        echo "Cedula ingrsada: $cedulaCliente <br>";
        echo "Nombres cliente: $nombresMayuscula <br>";
        echo "Apellidos cliente: $apellidosMayuscula <br>";
        echo "Correo cliente : $correoCliente <br>";
        echo "Telefono Cliente : $telefonoCliente <br>";
        echo "Id del empleado que atendio al cliente: $idEmpleado <br>";
        */


        if (isset($cedulaCliente) && isset($nombresCliente) && isset($apellidosCliente) && isset($correoCliente) && 
            isset($telefonoCliente) && isset($id_atiendeCliente)) {
            
            //Insertamos los datos ingresados del cliente en la tabla cliente
            pg_insert($conexion, "bookings.cliente", array('cedula'=> $cedulaCliente,'nombres'=> $nombresMayuscula,
            'apellidos'=> $apellidosMayuscula, 'correo'=> $correoCliente, 'telefono' => $telefonoCliente));

            /*Buscamos el id con el que quedo registrado el cliente y registramos el id del cliente y del empleado en la tabla
            rel_cleinte_empeado*/

            $query = pg_query($conexion, 
            "select id_cliente FROM bookings.cliente WHERE cedula = '".$cedulaCliente."';");
            
            //Convertimos la consulta en un array y ingresamos a la posicion 0 para obtener el resultado de la consulta
            $datos = pg_fetch_array($query);

            $id_clienteRegistrado = $datos["id_cliente"];

            /*Por ultimo ingresamos el id del cliente recien ingresado y del empleado que atendio el cliente a la tabla rel_cliente
            empeado. */

            pg_insert($conexion, "bookings.rel_cliente_empeado", array('fk_cliente'=> $id_clienteRegistrado,'fk_empleado'=> $id_atiendeCliente ));
            
            header('location:Registrar_Buscar_cliente.php');
            
        }


    ?>
    
</body>
</html>