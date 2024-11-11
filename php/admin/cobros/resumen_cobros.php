<?php
session_start();
if ($_SESSION['logueado']) {

    echo "BIENVENIDO ,"  . $_SESSION['uname'] . '<br>';

    echo "Hora de conexión :" . $_SESSION['time'] . '<br>';

    include_once "../../../funciones/funciones.php";

    $con = conexion();

    $con->set_charset("utf8mb4");

?>
    <!DOCTYPE html>
    <html lang="es">


    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RESUMEN</title>
        <?php head(); ?>
    </head>

    <body>
        <?php
        $sql = "SELECT * FROM caja_movil WHERE 1";
        $listar = $con->query($sql);
        ?>
        <table class="table table-bordered table-sm table-hover">
            <thead class="thead-dark">
                <tr>

                    <th>Id</th>
                    <th>Movil</th>
                    <th>Comisiones</th>                                                  
                    <th>Calcula deuda</th>
                    <th>Dep en Voucher</th>
                    <th>Dep efectivo</th>
                    <th>Porcentaje Movil</th>
                    <th>Efectivo</th>
                    <th>MP</th>
                    <th>$ a favor</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                </tr>
            </thead>

            <div>
                <thead>
                    <?php

                    while ($ver = $listar->fetch_assoc()) {
                    ?>
                        <form action="delete_usuario.php" method="get">

                            <tr>

                                <th><?php echo $ver['id'] ?></th>
                                <th><?php echo $ver['movil'] ?></th>
                                <th><?php echo $ver['comisiones'] ?></th>                                                            
                             
                                <th><?php echo $ver['calculo_deuda'] ?></th>
                                <th><?php echo $ver['deposito_voucher'] ?></th>
                                <th><?php echo $ver['dep_ft'] ?></th>
                                <th><?php echo $ver['para_el_movil'] ?></th>
                                <th><?php echo $ver['ft_en_caja'] ?></th>
                                <th><?php echo $ver['dep_mp'] ?></th>
                                <th><?php echo $ver['pesos_a_favor'] ?></th>
                                <th><?php echo $ver['fecha'] ?></th>
                                <th><?php echo $ver['usuario'] ?></th>


                                
                            </tr>

                            </tr>

                        </form>
                    <?php
                    }
                    ?>
                    <a href="../../salir.php">SALIR</a>
                </thead>
            </div>
        </table>
        <?php foot();
        ?>
    </body>

    </html>
<?php
}
?>