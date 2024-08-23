<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$sql_contar = "SELECT COUNT(*) AS total FROM completa";
$stmt_contar = $con->query($sql_contar);

if ($stmt_contar->num_rows > 0) {
    $row_3 = $stmt_contar->fetch_assoc();
    $cant_cargas = $row_3['total'];
} else {
    echo "0 registros encontrados...";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNI COMPLETAS</title>
    <?php head(); ?>

    <script src="../../../js/jquery-3.4.1.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <script src="../../../js/bootbox.min.js"></script>
    <style>
        select,
        input.texto {
            width: 120px;
        }

        * {
            font-size: 12px;
        }
    </style>
    <script>
        function deleteProduct(cod_titular) {

            bootbox.confirm("Desea Eliminar?" + cod_titular, function(result) {

                if (result) {
                    window.location = "del_uni_comp.php?q=" + cod_uni_comp;
                }

            })
        }

        function detalleProduct(cod_uni_comp) {
            window.location = "det_uni_comp.php?q=" + cod_uni_comp;
        }



        function updateProduct(cod_uni_comp) {
            window.location = "edit_uni_comp.php?q=" + cod_uni_comp;
        }
    </script>
</head>

<body>
    <h2>Ver en la parte de edicion de la unidad, no guarda ni graba el abono ni el precio por viaje</h2>
    <h2 class="text-center" style="margin: 5px ; ">LISTADO DE UNIDADES COMPLETAS
        <?php echo $cant_cargas . " UNIDADES CARGADAS." ?>
        <a href="../../menu.php"> &nbsp;&nbsp;SALIR</a>
        &nbsp;&nbsp;<a href="../../ayuda/ayuda.html" target=" _blank">AYUDA</a>
    </h2>

    <table class=" table table-bordered table-sm table-hover">
        <thead class="thead-dark">
            <tr>

                <th>Movil</th>
                <th>Nom Titular</th>
                <th>Ape Titu</th>
                <th>Cel titu</th>
                <th>DNI titu</th>
                <th>Licencia</th>
                <th>Nom ch. dia</th>
                <th>Ape ch. dia</th>
                <th>Cel ch. dia</th>
                <th>Nom ch. noche</th>
                <th>Ape ch. noche</th>
                <th>Cel noche</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Dominio</th>
                <th>año</th>
                <th>x_Viaje</th>
                <TH>abono</TH>
                <th>Deuda_ant</th>
                <th>Detalles</th>
                <th>Actualizar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <?php

        $sql_comp = "SELECT * FROM `completa` WHERE 1 ORDER BY movil";
        $res_comp = $con->query($sql_comp);
        ?>
        <?php
        while ($row = $res_comp->fetch_assoc()) {
        ?>
            <form action="del_uni_comp.php" method="get">
                <tr>
                    <!-- <th><?php echo $id = $row['id'] ?></th> -->
                    <th><?php echo $movil = $row['movil']; ?></th>
                    <th><?php echo $row['nombre_titu'] ?></th>
                    <th><?php echo $row['apellido_titu'] ?></th>
                    <th><?php echo $row['cel_titu'] ?></th>
                    <th><?php echo $row['dni_titu'] ?></th>
                    <TH><?PHP echo $row['licencia_titu'] ?></TH>
                    <th><?php echo $row['nombre_chof_1'] ?></th>
                    <th><?php echo $row['apellido_chof_1'] ?></th>
                    <th><?php echo $row['cel_chof_1'] ?></th>
                    <th><?php echo $row['nombre_chof_2'] ?></th>
                    <th><?php echo $row['apellido_chof_2'] ?></th>
                    <th><?php echo $row['cel_chof_2'] ?></th>
                    <th><?php echo $row['marca'] ?></th>
                    <th><?php echo $row['modelo'] ?></th>
                    <th><?php echo $row['dominio'] ?></th>
                    <th><?php echo $row['año'] ?></th>
                    <th><?php echo $row['x_viaje'] ?></th>
                    <th><?php echo $row['x_semana'] ?></th>
                    <th><?php echo $row['deuda_anterior'] ?></th>

                    <td> <a class="btn btn-primary btn-sm" href="#" onclick="detalleProduct(<?php echo $row['id']; ?>)">Detalles</td>
                    <td> <a class="btn btn-primary btn-sm" href="#" onclick="updateProduct(<?php echo $row['id']; ?>)">Actualizar</td>
                    <td><button type="submit" name="q" id="q" value="<?php echo $id ?>" class=" btn btn-danger btn-sm">BORRAR</button>
                </tr>
            </form>

        <?php
        }
        ?>
        </tr>
    </table>
    <br><br>
    <?php foot() ?>
</body>

</html>