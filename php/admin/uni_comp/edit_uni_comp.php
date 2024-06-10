<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$id_upd = $_GET['q'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR UNI COMPLETA</title>
    <?php head(); ?>
    <style>
        #columnas {
            column-count: 5;
            column-gap: 20px;
            list-style: none;
        }
    </style>
</head>

<body>

    <?php

    $sql = "SELECT * FROM completa WHERE id=" . $id_upd;
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $x_semana_paga = $row['x_semana'];

    # Paga x semana
    $sql_abonos = "SELECT * FROM abono_semanal WHERE 1";
    $abono_semana = $con->query($sql_abonos);

    # Paga x viaje
    $sql_viajes = "SELECT * FROM abono_viaje WHERE 1";
    $abono_viajes = $con->query($sql_viajes);

    //exit();

    ?>

    <div class="container">
        <h3 class="text-center">EDITAR UNIDAD COMPLETA</h3>
        <div class="row">
            <div id="contenedor"> <!-- esta linea intenta hacer 2 columnas -->
                <div class="col-md-12">
                    <form class="form-group" accept=-"charset utf8" action="guarda_uni_comp.php" method="post">
                        <div class="form-group">
                            <div class="from-group">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Movil</label>
                                <input type="text" class="form-control input-sm" readonly id="movil" name="movil" value="<?php echo  $row['movil']; ?>">
                            </div>
                        </div>

                        <div id="columnas">
                            <div class="form-group">
                                <label class="control-label">Nombre Titular</label>
                                <input type="text" class="form-control input-sm" readonly id="nom_titu" name="nom_titu" value="<?php echo  $row['nombre_titu']; ?>">
                            </div>

                            <div class="form-group">
                                <label class="control-label">Apellido Titu</label>
                                <input type="text" class="form-control" readonly id="ape_titu" name="ape_titu" value="<?php echo  $row['apellido_titu']; ?>">
                            </div>

                        </div>
                        <br>
                        <div id="columnas">

                            <div class="form-group">
                                <label class="control-label">DNI Titular</label>
                                <input type="text" class="form-control" readonly id="dni_titu" name="dni_titu" value="<?php echo  $row['dni_titu']; ?>">
                            </div>

                            <div class="form-group">
                                <label class="control-label">Direccion Titular</label>
                                <input type="text" class="form-control" id="dir_titu" readonly name="dir_titu" value="<?php echo  $row['direccion_titu']; ?>">
                            </div>
                        </div>
                        <br>
                        <div id="columnas">

                            <div class="form-group">
                                <label class="control-label">CP Titular</label>
                                <input type="text" class="form-control" readonly id="cp_titu" name="cp_titu" value="<?php echo  $row['cp_titu']; ?>">
                            </div>

                            <div class="form-group">
                                <label class="control-label">Celular Titular</label>
                                <input type="text" class="form-control" readonly id="cel_titu" name="cel_titu" value="<?php echo  $row['cel_titu']; ?>">
                            </div>

                        </div>
                        <br>
                        <div id="columnas">

                            <!-- CHOFER DIA  -->
                            <div class="form-group">
                                <label class="control-label">Nombre Chofer dia</label>
                                <input type="text" class="form-control" id="nom_chof_1" name="nom_chof_1" value="<?php echo  $row['nombre_chof_1']; ?>">
                            </div>

                            <div class="form-group">
                                <label class="control-label">apellido Chofer dia</label>
                                <input type="text" class="form-control" id="ape_chof_1" name="ape_chof_1" value="<?php echo  $row['apellido_chof_1']; ?>">
                            </div>
                        </div>
                        <br>
                        <div id="columnas">
                            <div class="form-group">
                                <label class="control-label">DNI Chofer dia</label>
                                <input type="text" class="form-control" id="dni_chof_1" name="dni_chof_1" value="<?php echo  $row['dni_chof_1']; ?>">
                            </div>

                            <div class="form-group">
                                <label class="control-label">Direccion Chofer dia</label>
                                <input type="text" class="form-control" id="dir_chof_1" name="dir_chof_1" value="<?php echo  $row['direccion_chof_1']; ?>">
                            </div>
                        </div>
                        <br>
                        <div id="columnas">
                            <div class="form-group">
                                <label class="control-label">CP chofer dia</label>
                                <input type="text" class="form-control" id="cp_chof_1" name="cp_chof_1" value="<?php echo  $row['cp_chof_1']; ?>">
                            </div>

                            <div class="form-group">
                                <label class="control-label">Celular Chofer dia</label>
                                <input type="text" class="form-control" id="cel_chof_1" name="cel_chof_1" value="<?php echo  $row['cel_chof_1']; ?>">
                            </div>

                        </div>
                        <br>
                        <div id="columnas">

                            <!--  CHOFER NOCHE  -->
                            <div class="form-group">
                                <label class="control-label">Nombre Chofer noche</label>
                                <input type="text" class="form-control" id="nom_chof_2" name="nom_chof_2" value="<?php echo  $row['nombre_chof_2']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Apellido Chofer noche</label>
                                <input type="text" class="form-control" id="ape_chof_2" name="ape_chof_2" value="<?php echo  $row['apellido_chof_2']; ?>">
                            </div>
                        </div>
                        <br>
                        <div id="columnas">
                            <div class="form-group">
                                <label class="control-label">DNI Chofer noche</label>
                                <input type="text" class="form-control" id="dni_chof_2" name="dni_chof_2" value="<?php echo  $row['dni_chof_2']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Direccion Chofer noche</label>
                                <input type="text" class="form-control" id="dir_chof_2" name="dir_chof_2" value="<?php echo  $row['direccion_chof_2']; ?>">
                            </div>
                        </div>
                        <br>
                        <div id="columnas">
                            <div class="form-group">
                                <label class="control-label">CP chofer noche</label>
                                <input type="text" class="form-control" id="cp_chof_2" name="cp_chof_2" value="<?php echo  $row['cp_chof_2']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Celular Chofer noche</label>
                                <input type="text" class="form-control" id="cel_chof_2" name="cel_chof_2" value="<?php echo  $row['cel_chof_2']; ?>">
                            </div>

                            <!-- DATOS DEL AUTO  -->

                        </div>
                        <br>
                        <div id="columnas">

                            <div class="form-group">
                                <label class="control-label">Licencia</label>
                                <input type="text" class="form-control" id="licencia" name="licencia" value="<?php echo  $row['licencia_titu']; ?>">
                            </div>

                            <div class="form-group">
                                <label class="control-label">Auto Marca</label>
                                <input type="text" class="form-control" id="marca" name="marca" value="<?php echo  $row['marca']; ?>">
                            </div>
                        </div>
                        <br>
                        <div id="columnas">
                            <div class="form-group">
                                <label class="control-label">Auto Modelo</label>
                                <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo  $row['modelo']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Dominio</label>
                                <input type="text" class="form-control" id="dominio" name="dominio" value="<?php echo  $row['dominio']; ?>">
                            </div>
                        </div>
                        <br>
                        <div id="columnas">
                            <label class="control-label">Auto Año</label>
                            <input type="text" class="form-control" id="año" name="año" value="<?php echo  $row['año']; ?>">
                        </div>
                        <br>
                        <div id="columnas">

                            <div class="form-group">
                                <label class="control-label">PAGA X SEMANA:</label>
                                <select id="<bono_semana" name="abono_semana">
                                    <?php
                                    $imp_semana = "SELECT * FROM abono_semanal WHERE id = '$x_semana_paga'";
                                    $importe_semana = $con->query($imp_semana);
                                    $row_3 = $importe_semana->fetch_assoc();
                                    //$row_3['abono'];

                                    ?>
                                    <option value="<?php echo $row['x_semana'] ?>"><?php echo $row['x_semana'] . " " . $row_3['abono'] . " " . $row_3['importe'] ?></option>
                                    <?php
                                    $opciones = [];
                                    if ($abono_semana->num_rows > 0) {
                                        while ($row_2 = $abono_semana->fetch_assoc()) {
                                            $opciones[] = $row_2;
                                        }
                                    } else {
                                        echo "0 resultados";
                                    }
                                    foreach ($opciones as $opcion) {
                                        echo "<option value=\"" . $opcion['id'] . "\" >" . $opcion['abono'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">PAGA X VIAJE:</label>
                                <select id="abono_viaje" name="abono_viaje">
                                    <?php
                                    $imp_viaje = "SELECT * FROM abono_viaje WHERE id=" . $x_semana_paga;
                                    $importe_viaje = $con->query($imp_viaje);
                                    $row_4 = $importe_viaje->fetch_assoc();
                                    ?>
                                    <option value="<?php echo $row['x_viaje'] ?>"><?php echo $row['x_viaje'] . " " . $row_4['abono'] . " " . $row_4['importe'] ?></option>
                                    <?php
                                    $op = [];
                                    if ($abono_viajes->num_rows > 0) {
                                        while ($row_1 = $abono_viajes->fetch_assoc()) {
                                            $op[] = $row_1;
                                        }
                                    } else {
                                        echo "0 resultados";
                                    }
                                    foreach ($op as $lee) {
                                        echo "<option value=\"" . $lee['id'] . "\" >" . $lee['abono']   . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>
                        <br>
                        <div id="columnas">

                            <div class="form-group">
                                <label class="control-label">FECHA DE INGRESO</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo  $row['fecha_inicio']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">INICIO DE FACTURACION</label>
                                <input type="date" class="form-control" id="fecha_fact" name="fecha_fact" value="<?php echo  $row['fecha_facturacion']; ?>">
                            </div>
                        </div>
                        <div class="text-center">
                            <br>
                            <input type="submit" class="btn btn-primary" value="GUARDAR DATOS">
                        </div>
                </div>


                </form>
            </div>
        </div>

    </div>
    <br><br>
    <?php foot(); ?>
</body>

</html>