<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("uth8mb4");

$id_upd = $_GET['q'];
echo $id_upd;



$sql = "SELECT *  FROM completa WHERE id=" . $id_upd;
$result = $con->query($sql);
$row = $result->fetch_assoc();
//}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ACTUALIZAR CHOFERES</title>
    <?php head() ?>

</head>

<body>

    <div class="container">
        <h3 class="text-center">ACTUALIZAR DATOS DEL CHOFERES</h3>
        <div class="row">

            <div class="col-md-12">

                <form class="form-group" accept=-"charset utf8" action="update_chofer.php" method="post">

                    <div class="from-group">
                        <label class="control-label"></label>
                        <input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">
                    </div>


                    <div class="form-group">
                        <label class="control-label">Movil</label>
                        <input type="text" class="form-control" id="movil" name="movil" value="<?php echo  $row['movil']; ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo  $row['nombre_chof_1']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $row['apellido_chof_1']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Direccion</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $row['direccion_chof_1']; ?>">
                    </div>


                    <div class="form-group">
                        <label class="control-label">DNI</label>
                        <input type="text" class="form-control" id="dni" name="dni" value="<?php echo $row['dni_chof_1']; ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Celular</label>
                        <input type="text" class="form-control" id="cel" name="cel" value="<?php echo $row['cel_chof_1']; ?>">
                    </div>



                    <div class="text-center">
                        <br>
                        <input type="submit" class="btn btn-primary" value="GUARDAR DATOS">
                    </div>


            </div>

        </div>
    </div>
    </div>
    <?php foot() ?>

</html>