<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
$venta_1 = 0;
$venta_2 = 0;
$venta_3 = 0;
$venta_4 = 0;
$venta_5 = 0;
$movil = $_POST['movil'];
$amovil = "A00" . $movil;
$total = 0;
$ven_1 = 0;
$ven_2 = 0;
$ven_3 = 0;
$ven_4 = 0;
$ven_5 = 0;

$sql_comp = "SELECT * FROM completa WHERE movil = $movil";
$res_comp = $con->query($sql_comp);
$row_comp = $res_comp->fetch_assoc();

$nombre_titu = $row_comp['nombre_titu'];
$apellido_titu = $row_comp['apellido_titu'];
$nombre_chof = $row_comp['nombre_chof_1'];
$apellido_chof_1 = $row_comp['apellido_chof_1'];
$semana = $row_comp['x_semana'];
$imp_viaje = $row_comp['x_viaje'];
$deuda_anterior = $row_comp['deuda_anterior'];

$venta_1 = $row_comp['venta_1'];
$venta_2 = $row_comp['venta_2'];
$venta_3 = $row_comp['venta_3'];
$venta_4 = $row_comp['venta_4'];
$venta_5 = $row_comp['venta_5'];

if ($venta_2 != 0) {
    $sql_venta_2 = "SELECT * FROM productos WHERE id = $venta_2";
    $res_venta_2 = $con->query($sql_venta_2);
    $row_venta_2 = $res_venta_2->fetch_assoc();
}

if ($venta_3 != 0) {
    $sql_venta_3 = "SELECT * FROM productos WHERE id = $venta_3";
    $res_venta_3 = $con->query($sql_venta_3);
    $row_venta_3 = $res_venta_3->fetch_assoc();
}

if ($venta_4 != 0) {
    $sql_venta_4 = "SELECT * FROM productos WHERE id = $venta_4";
    $res_venta_4 = $con->query($sql_venta_4);
    $row_venta_4 = $res_venta_4->fetch_assoc();
}
if ($venta_5 != 0) {
    $sql_venta_5 = "SELECT * FROM productos WHERE id = $venta_5";
    $res_venta_5 = $con->query($sql_venta_5);
    $row_venta_5 = $res_venta_5->fetch_assoc();
}
if ($venta_1 != 0) {
    $sql_venta_1 = "SELECT * FROM productos WHERE id = $venta_1";
    $res_venta_1 = $con->query($sql_venta_1);
    $row_venta_1 = $res_venta_1->fetch_assoc();
}


## Es lo que paga por semana
$sql_semana = "SELECT * FROM abono_semanal WHERE id = $semana";
$sql_semana = $con->query($sql_semana);
$row_semana = $sql_semana->fetch_assoc();


$abona_x_semana = $row_semana['abono'] . " ";
$debe_de_semana = $row_semana['importe'];

## Es lo que paga por viaje
$sql_viaje = "SELECT * FROM abono_viaje WHERE id = $imp_viaje";
$sql_viaje = $con->query($sql_viaje);
$row_viaje = $sql_viaje->fetch_assoc();

$nom_viaje = $row_viaje['abono'] . " ";
$paga_x_viaje = $row_viaje['importe'];

## Es lo que debe de semanas
$sql_debe_semanas = "SELECT * FROM semanas WHERE movil = $movil";
$sql_debe_semanas = $con->query($sql_debe_semanas);
$row_debe_semanas = $sql_debe_semanas->fetch_assoc();
$deuda_semanas_anteriores = $row_debe_semanas['total'];
$row_debe_semanas['x_semana'];

##variables de pago semanal e importe de semanas adeudadas
$paga_x_semana = $row_debe_semanas['x_semana'];
$debe_de_semanas =  $row_debe_semanas['total'];

## Voucher validads
$sql_voucher = "SELECT * FROM voucher_validado WHERE movil = '$amovil'";
$sql_voucher = $con->query($sql_voucher);
$row_voucher = $sql_voucher->fetch_assoc();

$sql = "SELECT COUNT(*) AS total_registros FROM voucher_validado";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Obtener el resultado
    $row = $result->fetch_assoc();
    $can_viajes = $row['total_registros'];
} else {
    echo "0 resultados";
}


/*
## esto es parte del listado de los voucher
while ($row_voucher = $sql_voucher->fetch_assoc()) {
    echo $row_voucher['movil'];
    echo " " . $row_voucher['reloj'];
    echo " " . $row_voucher['cc'];
    echo "<br>";
}
*/
?>
<!DOCTYPE html>
<html lang="en-es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VAUCHIN</title>
    <?php head() ?>
    <style>
        body {
            margin: 10px;
            border: 1px solid #4CAF50;
            padding: 40px;
            padding-top: 0px;
            padding-bottom: 0px;
        }

        #contenedor {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }

        #contenedor>div {
            width: 50%;
        }
    </style>
</head>

<body>
    <h2>Estado de cuenta del movil <?php echo $movil ?>&nbsp;
        <?php echo "Titular: " . $nombre_titu . " " . $apellido_titu ?>&nbsp;<br>
        <?php echo "Chofer: " . $nombre_chof . " " . $apellido_chof_1 ?></h2>


    <!-- <h5>Voucher</h5>


    <table class="table table-bordered table-sm table-hover flex">
        <thead class="table">
            <tr>
                <th></th>
                <th>Id</th>
                <th>cc</th>
                <th>Viaje No</th>
                <th>Tot x vouch sumado</th>
            
        </thead>
        <tbody>
    -->
    <?php
    while ($row_voucher = $sql_voucher->fetch_assoc()) {
        if ($row_voucher['cc'] != 0) {

    ?>
            <tr>
                <th></th>
                <th><?php echo $id = $row_voucher['id'] ?></th>
                <th><?php echo $cc = $row_voucher['cc'] ?></th>
                <th><?php echo $viaje_no = $row_voucher['viaje_no'] ?></th>
                <?php $reloj = $row_voucher['reloj'] ?>
                <?php $peaje = $row_voucher['peaje'] ?>
                <?php $plus = $row_voucher['plus'] ?>
                <?php $adicional = $row_voucher['adicional'] ?>
                <?php $equipaje = $row_voucher['equipaje'] ?>
                <?php
                // Calcular la suma de la columna
                $tot_voucher = $reloj + $peaje + $plus + $adicional + $equipaje;

                $total += $tot_voucher;
                ?>
                <th><?php echo $total ?></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        <?php
        }
        ?>
        </tbody>

    <?php } ?>
    </table>
    <form action="guarda_cobros.php" method="post">
        <?php
        if ($venta_2 != 0) {
        ?>
            <h6>Compro: <?php echo $row_venta_2['nombre'] . " " . "a" . " " . "$" . $ven_2 = $row_venta_2['precio'] ?>-</h6>
        <?php
        }
        if ($venta_3 != 0) {
        ?>
            <h6>Compro: <?php echo $row_venta_3['nombre'] . " " . "a" . " " . "$" . $ven_3 = $row_venta_3['precio'] ?>-</h6>
        <?php
        }
        if ($venta_4 != 0) {
        ?>
            <h6>Compro: <?php echo $row_venta_4['nombre'] . " " . "a" . " " . "$" . $ven_4 = $row_venta_4['precio'] ?>-</h6>
        <?php
        }

        if ($venta_5 != 0) {
        ?>
            <h6>Compro: <?php echo $row_venta_5['nombre'] . " " . "a" . " " . "$" . $ven_5 = $row_venta_5['precio'] ?>-</h6>
        <?php
        }
        if ($venta_1 != 0) {
        ?>
            <br>
            <h6>Compro: <?php echo $row_venta_1['nombre'] . " " . "a" . " " . "$" . $ven_1 = $row_venta_1['precio'] ?>-</h6>
            <?php
            $total_ventas = $ven_1 + $ven_2 + $ven_3 + $ven_4 + $ven_5;
            ?> <h4> <?php
                    $total_ventas ?>-</h4>
        <?php
        }
        ?>
        <style>
            .mi-label {
                width: 200px;
                display: inline-block;
                /* Esto asegura que el label respete el ancho */
            }
        </style>
        <div id="contenedor">
            <div>

                <ul style="border: 2px solid black; padding: 10px; border-radius: 10px; list-style-type: none;">
                    <li>
                        <label class="mi-label">Abono de <?php echo $abona_x_semana ?> <?php $abono_x_semana ?></label>
                        <input type="text" id="" name="" value="<?php echo $debe_de_semana ?>" readonly>
                    </li>
                    <li>
                        <label class="mi-label">Paga x viaje <?php echo $nom_viaje ?><?php $nom_viaje ?></label>
                        <input type="text" id="" name="" value="<?php echo $paga_x_viaje ?>" readonly>
                    </li>
                    <li>
                        <label class="mi-label">Cantidad de viajes</label>
                        <input type="text" id="" name="" value="<?php echo $can_viajes ?>" readonly>
                    </li>
                    <li>
                        <label class="mi-label">Total de viajes</label>
                        <input type="text" id="" name="" value="<?php echo $total_de_viajes = $paga_x_viaje * $can_viajes ?>">
                    </li>

                    <li>
                        <label class="mi-label">Debe de semanas anteriores</label>
                        <input type="text" id="" name="" value="<?php echo $deuda_semanas_anteriores ?>" readonly>
                    </li>

                    <li>
                        <label class="mi-label">Productos que compro</label>
                        <input type="text" id="" name="" value="<?php echo $total_ventas ?>">
                    </li>

                </ul>
            </div>

            <div>
                <ul style="border: 2px solid black; padding: 10px; border-radius: 10px; list-style-type: none;">
                    <li>
                        <label class="mi-label">Castos administrativos</label>
                        <input type="text" id="" name="" value="<?php echo $tot_a_pagar = $deuda_anterior + $debe_de_semanas + $total_de_viajes + $total_ventas; ?>">
                    </li>
                    <li>
                        <label class="mi-label">Deuda anterior</label>
                        <input type="text" id="" name="" value="<?php echo $deuda_anterior ?>" readonly>
                    </li>
                    <li>
                        <label class="mi-label">Recaudado en Voucher</label>
                        <input type="text" id="" name="" value="<?php echo $total ?>">
                    </li>
                    <li>
                        <label class="mi-label">Para el movil</label>
                        <input type="text" id="" name="" value="<?php echo $noventa = $total * .9 ?>">
                    </li>
                    <li>
                        <label class="mi-label">Para Base</label>
                        <input type="text" id="" name="" value="<?php echo $diez = $total * .1 ?>">
                    </li>
                    <li>
                        <label class="mi-label">Pagarle al movil</label>
                        <input type="text" id="" name="" value="<?php echo $total_final = $noventa - $tot_a_pagar ?>">
                    </li>
                </ul>

            </div>
        </div>
    </form>

    <br><br>
    <a href="guarda_cobros.php">GUARDA</a>
    <br><br>
    <a href="inicio_cobros.php">VOLVER</a>

    <br><br><br>
    <?php foot() ?>
</body>

</html>