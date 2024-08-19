<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
$total_ventas = 0;
$deuda_anterior = 0;
$venta_1 = 0;
$venta_2 = 0;
$venta_3 = 0;
$venta_4 = 0;
$venta_5 = 0;

if (isset($_GET['movil'])) {
    $movil = $_GET['movil'];
    htmlspecialchars($movil, ENT_QUOTES, 'UTF-8');
} else {

    $movil = $_POST['movil'];
}
$amovil = "A" . $movil;

//Veridica si existe movil
$sql_comp = "SELECT * FROM completa WHERE movil = $movil";
$res_comp = $con->query($sql_comp);
$row_comp = $res_comp->fetch_assoc();

if ($row_comp['movil'] == 0) {
    echo '<script type="text/javascript">';
    echo 'alert("ESE MOVIL NO EXISTE");';
    echo 'window.location.href = "inicio_cobros.php";'; // Enlace al que quieres redirigir
    echo '</script>';
}


//---------------------------------------------------------------------
// Verifica si tiene voucher, sino salta a vista_sin_voucher.php

$sql_con_voucher = "SELECT COUNT(*) AS total_registros FROM voucher_validado WHERE movil = '$amovil'";
$result = $con->query($sql_con_voucher);

if ($result->num_rows > 0) {
    // Obtener el resultado
    $row = $result->fetch_assoc();
    $can_viajes = $row['total_registros'];
}
if ($can_viajes == 0) {
    // exit();
    echo '<script type="text/javascript">';
    echo 'alert("ESTE MOVIL NO HACE CUENTAS CORRIENTES");';
    echo 'window.location.href = "vista_sin_voucher.php";'; // Enlace al que quieres redirigir
    echo '</script>';
}

$total = 0;
$ven_1 = 0;
$ven_2 = 0;
$ven_3 = 0;
$ven_4 = 0;
$ven_5 = 0;

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

//$amovil;

## Voucher validads
$sql_voucher = "SELECT * FROM voucher_validado WHERE movil = '$amovil'";
$sql_voucher = $con->query($sql_voucher);


?>
<!DOCTYPE html>
<html lang="en-es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VISTA CUENTA</title>
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
    <h4>Estado de cuenta del movil <?php echo $movil ?>&nbsp;
        <?php echo "Titular: " . $nombre_titu . " " . $apellido_titu ?>&nbsp;<br>
        <?php echo "Chofer: " . $nombre_chof . " " . $apellido_chof_1 ?></h4>





    <table class="table table-bordered table-sm table-hover flex" style="zoom:80%">
        <thead class="table">

            <tr>

                <th>Id</th>
                <th>cc</th>
                <th>Viaje No</th>
                <th>Tot x vouch sumado</th>

        </thead>
        <tbody>

            <?php

            while ($row_voucher = $sql_voucher->fetch_assoc()) {
                if ($row_voucher['cc'] >= 0) {

            ?>
                    <tr>

                        <th class="col-sm-2"><?php echo $id = $row_voucher['id'] ?></th>
                        <th class="col-sm-2"><?php echo $cc = $row_voucher['cc'] ?></th>
                        <th class="col-sm-2"><?php echo $viaje_no = $row_voucher['viaje_no'] ?></th>
                        <?php $reloj = $row_voucher['reloj'] ?>

                        <?php $peaje = $row_voucher['peaje'] ?>
                        <?php $plus = $row_voucher['plus'] ?>
                        <?php $adicional = $row_voucher['adicional'] ?>
                        <?php $equipaje = $row_voucher['equipaje'];


                        $tot_voucher = $reloj + $peaje + $plus + $adicional + $equipaje;
                        echo $total += $tot_voucher;
                        ?>
                        <th class="col-sm-10"><?php echo $total ?></th>


                    </tr>
                <?php
                }
                ?>
        </tbody>

    <?php
            }

    ?>
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

            <h6>Compro: <?php echo $row_venta_1['nombre'] . " " . "a" . " " . "$" . $ven_1 = $row_venta_1['precio'] ?>-</h6>
            <?php
            $total_ventas = $ven_1 + $ven_2 + $ven_3 + $ven_4 + $ven_5;
            ?>

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
                    <input type="hidden" id="movil" name="movil" value="<?php echo $movil ?>">
                    <li>
                        <label class="mi-label"><?php echo $abona_x_semana ?> <?php $abono_x_semana ?></label>
                        <input type="text" id="abono_semanal" name="abono_semanal" value="<?php echo $debe_de_semana ?>" readonly>
                    </li>
                    <li>
                        <label class="mi-label">Paga x viaje <?php echo $nom_viaje ?><?php $nom_viaje ?></label>
                        <input type="text" id="paga_x_viaje" name="paga_x_viaje" value="<?php echo $paga_x_viaje ?>" readonly>
                    </li>
                    <li>
                        <label class="mi-label">Cantidad de viajes</label>
                        <input type="text" id="cant_viajes" name="cant_viajes" value="<?php echo $can_viajes ?>" readonly>
                    </li>
                    <li>
                        <label class="mi-label">Total de viajes</label>
                        <input type="text" id="" name="" value="<?php echo $total_de_viajes = $paga_x_viaje * $can_viajes ?>" readonly>
                    </li>

                    <li>
                        <label class="mi-label">Debe de semanas anteriores</label>
                        <input type="text" id="debe_ant" name="debe_ant" value="<?php echo $deuda_semanas_anteriores ?>" readonly>
                    </li>

                    <li>
                        <label class="mi-label">Productos que compro</label>
                        <input type="text" id="prod" name="prod" value="<?php echo $total_ventas ?>" readonly>
                    </li>

                </ul>
            </div>

            <div>
                <ul style="border: 2px solid black; padding: 10px; border-radius: 10px; list-style-type: none;">
                    <li>
                        <label class="mi-label">Deuda anterior</label>
                        <input type="text" id="deuda_ant" name="deuda_ant" value="<?php echo $deuda_anterior ?>" readonly>
                    </li>
                    <li>
                        <label for="mi-label">Total a pagar:</label>
                        <input type="text">
                    </li>
                    <li>
                        <label class="mi-label">Gastos administrativos</label>
                        <input type="text" id="gastos" name="gastos" value="<?php echo $tot_a_pagar = $deuda_anterior + $debe_de_semanas + $total_de_viajes + $total_ventas; ?>" readonly>
                    </li>
                    <li>
                        <label class="mi-label">RECAUDADO EN VOUCHER </label>
                        <input type="text" id="tot_voucher" name="tot_voucher" value="<?php echo $total ?>" readonly>
                    </li>
                    <li>
                        <label class="mi-label">Para el movil</label>
                        <input type="text" id="para_movil" name="para_movil" value="<?php echo $noventa = $total * .9 ?>" readonly>
                    </li>
                    <li>
                        <label class="mi-label">Comisiones</label>
                        <input type="text" id="" name="" value="<?php echo $diez = $total * .1 ?>" readonly>

                    </li>


                    <?php
                    $total_final = $noventa - $tot_a_pagar;
                    if ($total_final > 0) {
                    ?>
                        <li>
                            <label class="mi-label">Pagarle al movil</label>
                            <input type="text" id="depo_mov" name="depo_mov" value="<?php echo $total_final ?>" style="background-color: #FFFF00" readonly>
                            <input type="hidden" id="pesos" name="pesos" value="<?php echo $pesos = 0 ?>">
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <label class="mi-label">Total a abonar</label>
                            <input type="text" id="" name="" value="<?php echo $total_a_abonar = $deuda_semanas_anteriores + $deuda_anterior + $tot_a_pagar ?>" readonly style="background-color: #FF6600">
                            <input type="text" id="pesos" name="pesos" placeholder="Ingrese dinero" autofocus required>

                        </li>


                    <?php
                    }
                    ?>
                </ul>
            </div>
            <li><button type="submit" class="btn btn-danger" target="_blank">GUARDAR no hay vueta atras</button></li>
        </div>

    </form>

    <form action="resumen_cobros.php" method="post">
        <input type="hidden" id="movil" name="movil" value="<?php echo $movil ?>">
        <li><button type="submit" class="btn btn-info" target="_blank">Resumen</button></li>
    </form>



    <li><a href="inicio_cobros.php" class="btn btn-info">VOLVER</a></li>

    <br><br><br>
    <?php foot() ?>

</body>

</html>