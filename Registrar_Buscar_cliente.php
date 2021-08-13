<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="CSS\styles_RegistrarReserva.css">
    <title>Registrar o buscar cliente</title>
</head>
<body>
    <h1 class="text-light bg-dark">Registrar o buscar cliente</h1>

    <div class = "container">
        <div class="card" class="p-3 mb-2 bg-light text-dark">
            <br>
            <form action="Registrar_Buscar_cliente.php" method="post">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">C.C</span>
                <input type="text" name= "CedulaBuscar" class="form-control" placeholder="Ingrese la cédula del cliente" aria-label="Username" aria-describedby="basic-addon1" required>
                <input type="submit"  name= "boton" class="btn btn-info" value="Buscar">
            </div>
            </form>
            <?php
                include 'C:\XAMPP\htdocs\Alojamientos\Conexion a la base de Datos\Conexion_BDD_Alojamientos.php';
                $cedula ="";
                if (isset($_POST['boton'])) {
                    $cedula = $_POST['CedulaBuscar'];
                    //echo "La cédula ingresada es: $cedula";
                    $query = pg_query($conexion, "select id_cliente,cedula,nombres,apellidos,correo,telefono FROM bookings.cliente WHERE cedula = '".$cedula."';");
                    
                    if (pg_num_rows($query) == 1) {
                        $datos = pg_fetch_array($query);
                        /*echo $datos["cedula"]."<br>";
                        echo $datos["nombres"]."<br>";
                        echo $datos["apellidos"]."<br>";
                        echo $datos["apellidos"]."<br>";*/   
            ?>
                        <br>
                        <h4>Datos cliente</h4>
                        <br>
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>Cédula</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                            </tr>
                            <tr>
                                <td><?php echo $datos["cedula"]; ?></td>
                                <td><?php echo $datos["nombres"]; ?></td>
                                <td><?php echo $datos["apellidos"]; ?></td>
                                <td><?php echo $datos["correo"]; ?></td>
                                <td><?php echo $datos["telefono"]; ?></td>
                            </tr>
                        </table>
                        <br>
                        <form action="Recibe_Datos_Reserva.php" method="post">
                            <?php
                                //echo "Id cliente: ".$datos["id_cliente"]."<br>";
                                echo'
                                <b>Empleado:</b>
                                <select name="cedulaEmpleado"  required>
                                    <option value=""></option>';
                                    $queryEmpleados = pg_query($conexion,"select id_empleado,cedula FROM bookings.empleado;");
                                    while ($datosEmpleado = pg_fetch_array($queryEmpleados)) {
                                        echo
                                        "<option value=".$datosEmpleado['id_empleado'].">".$datosEmpleado['cedula']."</option>";
                                    }
                                echo'
                                </select>';
                                
                                echo'
                                <b>Cliente:</b>
                                <select name="idCliente" required>';
                                    echo
                                    "<option value=".$datos['id_cliente'].">".$datos['cedula']."</option>";
                                echo'
                                </select>';
                            ?>
                            <br><br>
                            <input type= "submit" name= "guarda" class="btn btn-success" value= "Guardar">
                            
                        </form> 
            <?php
                    }else {
                        //echo "Hay que registrar el cliente con cedula: $cedula";
            ?>                
                        <h4>Registro Cliente</h4>
                        <hr>
                        <form action="Recibe_Datos_Reserva.php" method="post">
                            <div class="row g-3">
                                <div class="col" >
                                    <input type="text" name= "nombresCliente" class="form-control" placeholder="Nombres" aria-label="First name" required>
                                </div>
                                <div class="col">
                                    <input type="text" name= "apellidosCliente"  class="form-control" placeholder="Apellidos" aria-label="Last name" required>
                                </div>
                            </div>
                            <br>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-heading" viewBox="0 0 16 16">
                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                    <path d="M3 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1z"/>
                                </svg>
                                </span>
                                <input type="number" name= "CedulaIngresada" class="form-control" placeholder="Ingrese la cédula del cliente" aria-label="Username" aria-describedby="basic-addon1" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                                    </svg>
                                </span>
                                <input type="email" name= "correoCliente" class="form-control" placeholder="Correo" aria-label="Username" aria-describedby="basic-addon1" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
                                        <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
                                        <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                    </svg>
                                </span>
                                <input type="tel" name= "telefonoCliente" class="form-control" placeholder="Teléfono" aria-label="Username" aria-describedby="basic-addon1" required>
                            </div>
                            <?php
                                //echo "Id cliente: ".$datos["id_cliente"]."<br>";
                                echo'
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-person" viewBox="0 0 16 16">
                                        <path d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                                        <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    </svg>
                                    </label>
                                    <select name="cedulaEmpleado" class="form-select" required>
                                        <option value="">Cédula Empleado</option>';
                                        $queryEmpleados = pg_query($conexion,"select id_empleado,cedula FROM bookings.empleado;");
                                        while ($datosEmpleado = pg_fetch_array($queryEmpleados)) {
                                            echo
                                            "<option value=".$datosEmpleado['id_empleado'].">".$datosEmpleado['cedula']."</option>";
                                        }
                                echo'
                                    </select>
                                </div>';
                            ?>
                            <br><br>
                            <input type="submit" class="btn btn-success" value="Registrar">
                            
                        </form>

            <?php        
                    }
                    
                }
            ?>
            

        </div>
    </div>

    
    
</body>
</html>