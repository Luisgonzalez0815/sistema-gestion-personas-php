<?php

if (!empty($_POST["btnmodificar"])) {

    if (
        !empty($_POST["nombre"]) &&
        !empty($_POST["apellido"]) &&
        !empty($_POST["dni"]) &&
        !empty($_POST["fecha_nac"]) &&
        !empty($_POST["correo"])
    ) {

        $id        = $_POST["id"];
        $nombre    = trim($_POST["nombre"]);
        $apellido  = trim($_POST["apellido"]);
        $dni       = trim($_POST["dni"]);
        $fecha_nac = $_POST["fecha_nac"];
        $correo    = trim($_POST["correo"]);

        try {

            $sql = $conexion->query("
                UPDATE persona 
                SET nombre='$nombre',
                    apellido='$apellido',
                    dni='$dni',
                    fecha_nac='$fecha_nac',
                    correo='$correo'
                WHERE id_persona=$id
            ");

            if ($sql == 1) {
                header("Location: index.php?mensaje=editado");
                exit();
            }

        } catch (mysqli_sql_exception $e) {

            echo '
            <div class="alert alert-warning alert-dismissible fade show shadow-sm">
                <strong>DNI duplicado</strong><br>
                Ese documento ya existe en otro registro.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>';
        }

    } else {

        echo '
        <div class="alert alert-info alert-dismissible fade show shadow-sm">
            <strong>Campos incompletos</strong><br>
            Por favor diligencia todos los campos.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>';
    }
}
?>