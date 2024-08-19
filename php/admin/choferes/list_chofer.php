<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("uth8mb4");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHOFERES</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/columnas.css">
    <?php head() ?>
    <script>
        function deleteProduct(cod_chofer) {
            /*  Si no le pongo nada entre los parentesis() me borra todo o sea que 
            la funcion se ejecuta siempore igual. 
            Tengo que cambiarle los parametros de entrada para que la ejecute como yo quiero. 
            Si no tiene ningun paramtero generaliza, si lo tiene se ejecuta de forma particular*/
            bootbox.confirm("Desea Eliminar?" + cod_chofer, function(result) {
                /*  si la funcion no tiene nombre es una funcion anonima function() o function = nombre()  */
                if (result) {
                    window.location = "delete_chofer.php?q=" + cod_chofer;
                }
                /*  La ?q es como si fuera el metodo $_GET */
            });
        }

        /* ahora viene la funcion update*/
        function updateProduct(cod_chofer) {
            window.location = "edit_chofer.php?q=" + cod_chofer;
        }
    </script>
</head>

<body>

    <h1 class="text-center" style="margin: 5px ; ">LISTAR CHOFERES</h1>


    <div class="row">
        <div class="btn-group d-flex w-50" role="group">
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <!-- <a href="insert_chofer.php" class="btn btn-primary btn-sm">NUEVO CHOFER</a> -->
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <a href="../../menu.php" class="btn btn-primary btn-sm">SALIR</a>
        </div>

    </div>



    <table class="table table-bordered table-sm table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Movil</th>
                <th>Nombre Dia</th>
                <th>Apellido Dia</th>
                <th>Direccion Dia</th>
                <th>DNI Dia</th>
                <th>Celular Dia</th>
                <th>Nombre Noche</th>
                <th>Apellido Noche</th>
                <th>Direccion Noche</th>
                <th>DNI Noche</th>
                <th>Celular Noche</th>
                <th>Actualizar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
            $sql = "SELECT * FROM completa WHERE 1 ORDER BY movil";
            $result = $con->query($sql);
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['movil'] ?></td>
                    <td><?php echo $row['nombre_chof_1'] ?></td>
                    <td><?php echo $row['apellido_chof_1'] ?></td>
                    <td><?php echo $row['direccion_chof_1'] ?></td>
                    <td><?php echo $row['dni_chof_1'] ?></td>
                    <td><?php echo $row['cel_chof_1'] ?></td>
                    <td><?php echo $row['nombre_chof_2'] ?></td>
                    <td><?php echo $row['apellido_chof_2'] ?></td>
                    <td><?php echo $row['direccion_chof_2'] ?></td>
                    <td><?php echo $row['dni_chof_2'] ?></td>
                    <td><?php echo $row['cel_chof_2'] ?></td>
                    <td> <a class="btn btn-primary btn-sm" href="#" onclick="updateProduct(<?php echo $row['id']; ?>)">Actualizar</td>
                    <td> <a class="btn btn-danger btn-sm" href="#" onclick="deleteProduct(<?php echo $row['id']; ?>)">Eliminar</td>
                </tr>
                <p></p>
            <?php
            }
            ?>
        </tbody>
    </table>

</body>

</html>