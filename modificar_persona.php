<?php
include "modelo/conexion.php";
$id=$_GET["id"];

$sql=$conexion->query("select * from persona where id_persona=$id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <form class="col-4 p-3 m-auto" method="POST">
            <h3 class="text-center text-secondary">Modificar personas</h3>
            <input type="hidden" name="id" value="<?=  $_GET["id"] ?>">
            <?php
            include "controlador/modificar_persona.php";
            while($datos=$sql->fetch_object()){?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre de la persona</label>
                    <input type="text" class="form-control" name="nombre" value="<?= $datos->nombre ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Apellido de la persona</label>
                    <input type="text" class="form-control" name="apellido" value="<?= $datos->apellido ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">DNI de la persona</label>
                    <input type="text" class="form-control" name="dni" value="<?= $datos->dni ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Fecha de nacimiento</label>
                    <input type="date" class="form-control" name="fecha_nac" value="<?= $datos->fecha_nac ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">correo</label>
                    <input type="text" class="form-control" name="correo" value="<?= $datos->correo ?>">
                </div>
            <?php }
            ?>

            <button type="submit" class="btn btn-primary w-100" name="btnmodificar" value="ok">Guardar cambios</button>
        </form>
</body>
</html>