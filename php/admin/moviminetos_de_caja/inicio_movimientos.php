<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
$sql_listado = "SELECT * FROM caja_final WHERE 1";
$sql_lis = $con->query($sql_listado);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOVIMIENTOS DE CAJA</title>
    <?php head() ?>
    <script>
        function deleteProd(cod_titular) {
            bootbox.confirm("Desea Eliminar?" + cod_titular, function(result) {
                if (result) {
                    window.location = "delete_mov.php?q=" + cod_titular;
                }
            });
        }

        function extraeProd(cod_titular) {
            window.location = "extrae_mov.php?q=" + cod_titular;
        }
        /*
                function updateProd(cod_titular) {
                    window.location = "edit_mov.php?q=" + cod_titular;
                }
                    */
    </script>
</head>

<body>
    <h1 class="text-center" style="margin: 5px ; ">MOVIMIENTOS DE CAJA</h1>
    <div class="row">
        <style>
            a {
                text-align: center;
            }
        </style>
        <div class="btn-group d-flex w-50" role="group">
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <a href="extrae_mov.php" class="btn btn-danger btn-sm">EXTRACCION</a>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <!-- <a href="ListaContacto.php" class="btn btn-primary btn-sm">LISTAR MOVILES</a>  -->
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        </div>
    </div>

    <table class=" table table-bordered table-sm table-hover">
        <div>


            <thead class="thead-dark">
                <tr>
                    <th>id</th>
                    <th>dep FT</th>
                    <th>dep ant ft</th>
                    <th>FT Actual</th>
                    <th>extraccion ft</th>
                    <th>deposito ft</th>
                    <th>dep MP</th>
                    <th>dep ant MP</th>
                    <th>ft actual</th>
                    <th>extraccion MP</th>
                    <th>deposito MP</th>
                    <th>Fecha</th>
                    <th>Operador</th>
                    <th>Obs</th>

                    <th></th>
                </tr>
            </thead>
            <br>
            <?php
            while ($sql_lista = $sql_lis->fetch_assoc()) {
            ?>
                <form action="">
                    <tr>
                        <th><?php echo $sql_lista['id'] ?></th>
                        <th><?php echo $sql_lista['dep_ft_hoy'] ?></th>
                        <th><?php echo $sql_lista['dep_ant_ft'] ?></th>
                        <th><?php echo $sql_lista['ft_actual'] ?></th>
                        <th><?php echo $sql_lista['extra_ft'] ?></th>
                        <th><?php echo $sql_lista['deposito_ft'] ?></th>
                        <th><?php echo $sql_lista['dep_mp_hoy'] ?></th>
                        <th><?php echo $sql_lista['dep_ant_mp'] ?></th>
                        <th><?php echo $sql_lista['mp_actual'] ?></th>
                        <th><?php echo $sql_lista['extra_mp'] ?></th>
                        <th><?php echo $sql_lista['deposito_mp'] ?></th>
                        <th><?php echo $sql_lista['fecha'] ?></th>
                        <th><?php echo $sql_lista['nombre'] ?></th>
                        <th><?php echo $sql_lista['observaciones'] ?></th>

                        <!-- <td> <a class="btn btn-danger btn-sm" href="#" onclick="deleteProd(<?php echo $sql_lista['id']; ?>)">Eliminar</td>  -->
                    </tr>

                </form>





            <?php
            }
            ?>

            <script>
                function cerrarPagina() {
                    window.close();
                }
            </script>
            <?php foot()    ?>
        </div>
    </table>
    <br><br>
</body>

</html>