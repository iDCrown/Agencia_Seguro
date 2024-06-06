<?php
    //Incluimos conexión
    include '../config/conexion.php';
    

    //Obtener el id enviado de index
    $idRegistro = $_GET['id'];

    //Seleccionar datos
    $query = "SELECT * FROM usuarios where id='".$idRegistro."'";
    $usuario = mysqli_query($con, $query) or die (mysqli_error());

    //Volcamos los datos de ese registro en una fila
    $fila = mysqli_fetch_assoc($usuario);



    if(isset($_POST['editarRegistro'])){
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
            $query = "UPDATE usuarios set nombre='$nombre', apellidos='$apellidos', telefono='$telefono', email='$email' where id='$idRegistro'";

            if(!mysqli_query($con, $query)){
                die('Error: ' . mysqli_error($con));
                $error = "Error, no se pudo crear el registros";
            }else{
                $mensaje = "Registro editado correctamente";
                header('Location: index.php?mensaje='.urlencode($mensaje));
                exit();
            }
        }

    }
    

?>