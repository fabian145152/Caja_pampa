<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
$movil = $_GET['q'];



$sql_movil = "SELECT * FROM completa WHERE id=" . $movil;
$result_semana = $con->query($sql_movil);
$row_semana = $result_semana->fetch_assoc();

echo $row_semana['movil'];

?>
<!DOCTYPE html>
<html lang="en-es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR TROPA</title>
    <?php head() ?>
</head>

<body>
    <div class="container">
        <h3 class="text-center">ACTUALIZAR NUMEROS DE MOVIL</h3>
        <div class="row">

            <div class="col-md-12">

                <form class="form-group" accept=-"charset utf8" action="update_tropa.php" method="POST">
                    <div class="from-group">
                        <input type="hidden" name="id" id="id" value="<?php echo $row_semana['id']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row_semana['id']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">TROPA</label>
                        <input type="text" class="form-control" id="tropa" name="tropa" value="<?php echo $row_semana['tropa']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">MOVIL</label>
                        <input type="text" class="form-control" id="movil" name="movil" value="<?php echo $row_semana['movil']; ?>">
                    </div>


                    <div class="text-center">
                        <br>
                        <input type="submit" class="btn btn-primary" value="GUARDAR MOVIL">
                        <br>
                        <br><br>
                        <a href="lista_tropas.php" class="btn btn-primary">SALIR</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>