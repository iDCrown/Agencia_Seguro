<?php
    //Incluimos conexión
    include '../config/conexion.php';

    if(isset($_POST['crearRegistro'])){
        $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
        $apellidos = mysqli_real_escape_string($con, $_POST['apellidos']);
        $telefono = mysqli_real_escape_string($con, $_POST['telefono']);
        $email = mysqli_real_escape_string($con, $_POST['email']);

        //Configurar tiempo zona horaria
        date_default_timezone_set('America/Bogota');
        $time = date('h:i:s a', time());

        //Validar si no están vacíos
        if(!isset($nombre) || $nombre == '' || !isset($apellidos) || $apellidos == '' || !isset($telefono) || $telefono == '' || !isset($email) || $email == ''){
            $error = "Algunos campos están vacíos";
        }else{
            $query = "INSERT INTO usuarios(nombre, apellidos, telefono, email)VALUES('$nombre', '$apellidos', '$telefono', '$email')";

            if(!mysqli_query($con, $query)){
                die('Error: ' . mysqli_error($con));
                $error = "Error, no se pudo crear el registro";
            }else{
                $mensaje = "Registro creado correctamente";
                header('Location: index.php?mensaje='.urlencode($mensaje));
                exit();
            }
        }

    }
    

?>