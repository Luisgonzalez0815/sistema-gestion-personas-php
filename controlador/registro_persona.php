<?php

if (!empty($_POST["btnregistrar"])) {

    if (
        !empty($_POST["nombre"]) &&
        !empty($_POST["apellido"]) &&
        !empty($_POST["dni"]) &&
        !empty($_POST["fecha"]) &&
        !empty($_POST["correo"])
    ) {

        $nombre   = trim($_POST["nombre"]);
        $apellido = trim($_POST["apellido"]);
        $dni      = trim($_POST["dni"]);
        $fecha    = $_POST["fecha"];
        $correo   = trim($_POST["correo"]);

        try {

            $sql = $conexion->query("INSERT INTO persona(nombre, apellido, dni, fecha_nac, correo)
            VALUES('$nombre','$apellido','$dni','$fecha','$correo')");

            if ($sql == 1) {
                
                $_POST = array();

                echo '
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                    <strong>¡Registro exitoso!</strong><br>
                    La persona fue registrada correctamente en el sistema.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                ';

            } else {

                echo '
                <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                    <strong>Error inesperado</strong><br>
                    No fue posible registrar la información. Intenta nuevamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                ';
            }

        } catch (mysqli_sql_exception $e) {

            echo '
            <div class="alert alert-warning alert-dismissible fade show shadow-sm border-0" role="alert">
                <strong>DNI duplicado</strong><br>
                Ya existe una persona registrada con ese número de documento.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            ';
        }

    } else {

        echo '
        <div class="alert alert-info alert-dismissible fade show shadow-sm border-0" role="alert">
            <strong>Campos incompletos</strong><br>
            Por favor diligencia todos los campos del formulario.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        ';
    }
}

?>