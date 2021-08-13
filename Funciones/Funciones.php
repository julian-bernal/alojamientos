<?php

    /*Con esta funcion mostramos en una tabla el id,estado y la capacidad del alojamiento
    Recibe como parametro la variable que guarda el array de la consulta*/
    function listar_estados($consultaArray){

        switch ($consultaArray) {

            case ($consultaArray["estado_del_alojamiento"]=='DISPONIBLE'):

                $estiloTabla = "class= table table-success table-striped";
                $colorCelda = "class= table-success";

                echo "<table $estiloTabla>
                        <tr>
                            <th>Id</th>
                            <th>Estado</th>
                            <th>Capacidad</th>
                        </tr>
                        <tr>
                            <td>".$consultaArray["id_alojamiento"]."</td>
                            <td $colorCelda>".$consultaArray["estado_del_alojamiento"]."</td>
                            <td>".$consultaArray["capacidad"]."</td>
                        </tr>
                    </table>
                ";
                break;

            case ($consultaArray["estado_del_alojamiento"]=='RESERVADO'):

                $estiloTabla = "class= table table-success table-striped";
                $colorCelda = "class= table-warning";

                echo "<table $estiloTabla>
                        <tr>
                            <th>Id</th>
                            <th>Estado</th>
                            <th>Capacidad</th>
                        </tr>
                        <tr>
                            <td>".$consultaArray["id_alojamiento"]."</td>
                            <td $colorCelda>".$consultaArray["estado_del_alojamiento"]."</td>
                            <td>".$consultaArray["capacidad"]."</td>
                        </tr>
                    </table>
                ";    
                break;

            case ($consultaArray["estado_del_alojamiento"]=='FUERA DE SERVICIO'):

                $estiloTabla = "class= table table-success table-striped";
                $colorCelda = "class= table-danger";

                echo "<table $estiloTabla>
                        <tr>
                            <th>Id</th>
                            <th>Estado</th>
                            <th>Capacidad</th>
                        </tr>
                        <tr>
                            <td>".$consultaArray["id_alojamiento"]."</td>
                            <td $colorCelda>".$consultaArray["estado_del_alojamiento"]."</td>
                            <td>".$consultaArray["capacidad"]."</td>
                        </tr>
                    </table>
                ";
                break;
                
            default:
                echo "SIN RESULTADO";
        }

    }

?>

<?php
    /* Funcion para registrar la resereva de cualquier alojamiento*/

    function registrar_Reserva($id_alojamiento){

        include 'C:\XAMPP\htdocs\Alojamientos\Conexion a la base de Datos\Conexion_BDD_Alojamientos.php';
        
        echo
        '<form action="\Alojamientos\Recibe_Datos_Reserva.php" method="post">

        <b>Alojamiento:</b>
        <select name="alojamiento">';
            
            $quryAlojamiento = pg_query($conexion, "select id_alojamiento,nombre_alojamiento FROM bookings.alojamiento WHERE id_alojamiento= $id_alojamiento;");
            while ($datos = pg_fetch_array($quryAlojamiento)) {
                echo        
                "<option value=".$datos['id_alojamiento'].">". $datos['nombre_alojamiento'] ."</option>";
            }
        
        echo        
        '</select>

        <b>Seleccione el tipo de Regimen:</b> 
        <select name="tipoRegimen" required>
            <option value=""></option>';
            $queryRegimenes = pg_query($conexion,"select id_alojamiento_regimen,nombre_regimen FROM id_regimen_por_alojamiento WHERE id_alojamiento = $id_alojamiento;");
            while ($datos = pg_fetch_array($queryRegimenes)) {
                echo
                "<option value=".$datos['id_alojamiento_regimen'].">". $datos['nombre_regimen']."</option>";
            }
        echo
        '</select>

        <b>Empleado:</b>
        <select name="cedulaEmpleado" required>
            <option value=""></option>';
            $queryEmpleados = pg_query($conexion,"select id_empleado,cedula FROM bookings.empleado;");
            while ($datos = pg_fetch_array($queryEmpleados)) {
                echo
                "<option value=".$datos['id_empleado'].">".$datos['cedula']."</option>";
            }
        echo
        '</select>

        <div class="mb-3">
        <br>
            <label for="formGroupExampleInput" class="form-label">Número de Personas</label>
            <input type="number" class="form-control" name="numeroPersonas"  placeholder="Número total de personas" required>
            <label for="formGroupExampleInput" class="form-label">Fecha y hora de ingreso</label>
            <input type="date" class="form-control" name="fechaIngreso" required>
            <input type="time" class="form-control" name="horaIngreso" required>
            <label for="formGroupExampleInput" class="form-label">Fecha y hora de salida</label>
            <input type="date" class="form-control" name="fechaSalida" required>
            <input type="time" class="form-control" name="horaSalida" required>
        </div>
        <input type="submit" class="btn btn-success" value="Reservar">
        <a href="Registrar_Buscar_cliente.php" class="btn btn-warning" target="_blank">Registrar o buscar cliente</a>
    </form>';
    }

    /*
        <form action="Recibe_Datos_Reserva.php" method="post">
                        <b>Alojamiento:</b>
                        <select name="alojamiento">
                            <?php
                                $quryAlojamiento = pg_query($conexion, "select id_alojamiento,nombre_alojamiento FROM bookings.alojamiento WHERE id_alojamiento=1;");
                                while ($datos = pg_fetch_array($quryAlojamiento)) {
                            ?>
                            <option value="<?php echo $datos['id_alojamiento']; ?> "> <?php echo $datos['nombre_alojamiento']; ?> </option>
                            <?php
                                }
                            ?>
                        </select>
                        <b>Seleccione el tipo de Regimen:</b> 
                        <select name="tipoRegimen">
                            <?php
                                $queryRegimenes = pg_query($conexion,"select id_alojamiento_regimen,nombre_regimen FROM id_regimen_por_alojamiento WHERE id_alojamiento = 1;");
                                while ($datos = pg_fetch_array($queryRegimenes)) {
                            ?>
                            <option value="<?php echo $datos['id_alojamiento_regimen']; ?>"> <?php echo $datos['nombre_regimen']; ?> </option>
                            <?php
                                }
                            ?>
                        </select>
                        <b>Empleado:</b>
                        <select name="cedulaEmpleado">
                            <?php
                                $queryEmpleados = pg_query($conexion,"select id_empleado,cedula FROM bookings.empleado;");
                                while ($datos = pg_fetch_array($queryEmpleados)) {
                            ?>
                            <option value="<?php echo $datos['id_empleado']; ?>"><?php echo $datos['cedula']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <div class="mb-3">
                        <br>
                            <label for="formGroupExampleInput" class="form-label">Número de Personas</label>
                            <input type="number" class="form-control" name="numeroPersonas"  placeholder="Número total de personas">
                            <label for="formGroupExampleInput" class="form-label">Fecha y hora de ingreso</label>
                            <input type="date" class="form-control" name="fechaIngreso">
                            <input type="time" class="form-control" name="horaIngreso" >
                            <label for="formGroupExampleInput" class="form-label">Fecha y hora de salida</label>
                            <input type="date" class="form-control" name="fechaSalida">
                            <input type="time" class="form-control" name="horaSalida" >
                        </div>
                        <input type="submit" class="btn btn-success" value="Reservar">
                        <a href="Registrar_Buscar_cliente.php" class="btn btn-warning" target="_blank">Registrar o buscar cliente</a>
                    </form>
    
    */
?>

<?php

    function actualizarEstadoAutomaticamente($id_alojamiento){
        //Como su nombre lo indica, esta funcion actualiza los estados de cada alojamiento segun la fecha de la ultima reserva
        
        include 'C:\XAMPP\htdocs\Alojamientos\Conexion a la base de Datos\Conexion_BDD_Alojamientos.php';

        $fecha_salida = "";//Se define vacia para cuando un alojamiento no tenga reservas, no aroje una advertencia

        $fechaUltimaReserva = pg_query($conexion,"select fecha_salida FROM ultima_reserva WHERE id_alojamiento = $id_alojamiento
        LIMIT 1;");
        $f_salida_ultimaReserva = pg_fetch_array($fechaUltimaReserva);
                    
                    
        $fecha_salida= strtotime($f_salida_ultimaReserva['fecha_salida']);//Convertimos la fecha a formato UNIX para compararlas
        $fecha_actual= strtotime(date("d-m-Y H:i:00",time()));
                    
        /*
        echo "<br>Fecha Salida: ".$fecha_salida;
        echo "<br>Fecha Actual: ".$fecha_actual;
        */

        if ($fecha_salida > $fecha_actual) {
            echo "Fecha de salida: ".$f_salida_ultimaReserva['fecha_salida'];
            pg_query($conexion,"update  bookings.rel_estado_alojamiento SET fk_estado = 2
            WHERE fk_alojamiento = $id_alojamiento;");
        }else {
            pg_query($conexion,"update  bookings.rel_estado_alojamiento SET fk_estado = 1
            WHERE fk_alojamiento = $id_alojamiento;");
        }

        //pg_close($conexion);
        //Si hay version premium le doy la autorización al administrador de actualizar el alojamiento a F.S

    }


?>
