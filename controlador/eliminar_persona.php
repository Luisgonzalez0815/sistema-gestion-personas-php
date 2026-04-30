<?php

if (!empty($_GET["id"])) {

    $id = $_GET["id"];

    try {

        $sql = $conexion->query("DELETE FROM persona WHERE id_persona = $id");

        if ($sql == 1) {

            header("Location: index.php?mensaje=eliminado");
            exit();

        } else {

            header("Location: index.php?mensaje=error_eliminar");
            exit();
        }

    } catch (mysqli_sql_exception $e) {

        header("Location: index.php?mensaje=error_eliminar");
        exit();
    }
}

?>