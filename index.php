<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema CRUD de Gestión de Personas</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/9f3be84a1e.js" crossorigin="anonymous"></script>

    <style>
        body {
            background: #f4f6f9;
        }

        .titulo {
            color: #0d6efd;
            font-weight: bold;
        }

        .card-box {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
        }

        .table-box {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
        }

        .table thead {
            background: #0d6efd;
            color: white;
        }

        .btn-action {
            padding: 5px 10px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }

        .alert {
            border-radius: 12px;
        }
    </style>
</head>

<body>

<script>
function eliminar() {
    return confirm("¿Estás seguro de eliminar este registro?");
}
</script>

<?php
include "modelo/conexion.php";
include "controlador/eliminar_persona.php";
?>

<div class="container py-4">

    <!-- TÍTULO -->
    <div class="text-center mb-4">
        <h1 class="titulo">Sistema CRUD de Gestión de Personas</h1>
        <p class="text-muted">Proyecto desarrollado con PHP, MySQL y Bootstrap</p>
    </div>

    <!-- ALERTAS DEL SISTEMA -->
    <?php

    if (isset($_GET["mensaje"]) && $_GET["mensaje"] == "editado") {
        echo '
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4">
            <strong>¡Actualización exitosa!</strong><br>
            La información fue modificada correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>';
    }

    if (isset($_GET["mensaje"]) && $_GET["mensaje"] == "eliminado") {
        echo '
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4">
            <strong>¡Eliminación exitosa!</strong><br>
            El registro fue eliminado correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>';
    }

    if (isset($_GET["mensaje"]) && $_GET["mensaje"] == "error_eliminar") {
        echo '
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4">
            <strong>Error al eliminar</strong><br>
            No fue posible eliminar el registro.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>';
    }

    ?>

    <div class="row g-4">

        <!-- FORMULARIO -->
        <div class="col-lg-4">
            <div class="card card-box p-4">

                <h4 class="text-center text-secondary mb-3">
                    <i class="fa-solid fa-user-plus"></i> Registrar Persona
                </h4>

                <?php include "controlador/registro_persona.php"; ?>

                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre"
                            value="<?= isset($_POST['nombre']) ? $_POST['nombre'] : '' ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="apellido"
                            value="<?= isset($_POST['apellido']) ? $_POST['apellido'] : '' ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">DNI</label>
                        <input type="text" class="form-control" name="dni"
                            value="<?= isset($_POST['dni']) ? $_POST['dni'] : '' ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" name="fecha"
                            value="<?= isset($_POST['fecha']) ? $_POST['fecha'] : '' ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="email" class="form-control" name="correo"
                            value="<?= isset($_POST['correo']) ? $_POST['correo'] : '' ?>">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">
                            <i class="fa-solid fa-floppy-disk"></i> Registrar
                        </button>
                    </div>

                </form>

            </div>
        </div>

        <!-- TABLA -->
        <div class="col-lg-8">
            <div class="table-box">

                <h4 class="text-secondary mb-3">
                    <i class="fa-solid fa-table"></i> Lista de Personas
                </h4>

                <div class="table-responsive">

                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>DNI</th>
                                <th>Fecha Nac.</th>
                                <th>Correo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $sql = $conexion->query("SELECT * FROM persona");

                            while ($datos = $sql->fetch_object()) {
                            ?>

                                <tr>
                                    <td><?= $datos->id_persona ?></td>
                                    <td><?= $datos->nombre ?></td>
                                    <td><?= $datos->apellido ?></td>
                                    <td><?= $datos->dni ?></td>
                                    <td><?= $datos->fecha_nac ?></td>
                                    <td><?= $datos->correo ?></td>
                                    <td>

                                        <a href="modificar_persona.php?id=<?= $datos->id_persona ?>"
                                            class="btn btn-warning btn-sm btn-action"
                                            title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <a href="index.php?id=<?= $datos->id_persona ?>"
                                            onclick="return eliminar()"
                                            class="btn btn-danger btn-sm btn-action"
                                            title="Eliminar">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>

                                    </td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>

                </div>

            </div>
        </div>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>