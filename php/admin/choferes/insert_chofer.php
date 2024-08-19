<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CREAR TITULARES</title>
    <link href="https://fonts.googleapis.com/css?family=Lato|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">

    <link rel="stylesheet" href="../../css/form.css">
    <style>
        .izquierda {
            float: left;
        }

        .derecha {
            float: right;
        }

        .centro {
            float: inline-start;
        }
    </style>
</head>

<body>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">CREACION DE TITULARES</h3>
            </div>

            <form class="form-group" accept=-"charset utf8" action="save_chofer.php" method="post" enctype="multipart/form-data">
                <div class="col-md-12">

                    <div class="centro">

                        <div class="form-group">
                            <br>
                            <label class="control-label" for="movil">MOVIL</label>
                            <select name="movil" id="movil" class="form-control" required>
                                <?php
                                include_once '../../includes/db.php';
                                $con = openCon('../../config/db_admin.ini');
                                $con->set_charset("utf8mb4");
                                $sql = "SELECT * FROM completa WHERE 1";
                                $result = $con->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['movil'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="izquierda">
                            <div class="form-group">
                                <br>
                                <label class="control-label" for="Modelo">NOMBRE CHOFER DIA</label>
                                <input type="text" class="form-control" placeholder="NOMBRE" name="nombre_chof_dia" id="nombre_chof_dia">
                            </div>
                        </div>
                        <div class="derecha">
                            <div class="form-group">
                                <br>
                                <label class="control-label" for="Precio">NOMBRE CHOFER NOCHE</label>
                                <input type="text" class="form-control" placeholder="NOMBRE" name="nombre_chof_noche" id="nombre_chof_noche">
                            </div>
                        </div>

                        <div class="izquierda">
                            <div class="form-group">
                                <br>
                                <label class="control-label" for="Precio">APELLIDO CHOFER DIA</label>
                                <input type="text" class="form-control" placeholder="APELLIDO" name="apellido_chof_dia" id="apellido_chof_dia">
                            </div>
                        </div>
                        <div class="derecha">
                            <div class="form-group">
                                <br>
                                <label class="control-label" for="Precio">APELLIDO CHOFER NOCHE</label>
                                <input type="text" class="form-control" placeholder="APELLIDO" name="apellido_chof_noche" id="apellido_chof_noche">
                            </div>
                        </div>

                        <div class="izquierda">
                            <div class="form-group">
                                <br>
                                <label class="control-label" for="Precio">DIRECCION CHOFER DIA</label>
                                <input type="text" class="form-control" placeholder="DIRECCION" name="direccion_chof_dia" id="direccion_chof_dia">
                            </div>
                        </div>
                        <div class="derecha">
                            <div class="form-group">
                                <br>
                                <label class="control-label" for="Precio">DIRECCION CHOFER NOCHE</label>
                                <input type="text" class="form-control" placeholder="DIRECION" name="direccion_chof_noche" id="direccion_chof_noche">
                            </div>
                        </div>
                        <div class="izquierda">
                            <div class="form-group">
                                <br>
                                <label class="control-label" for="Precio">DNI CHOFER DIA</label>
                                <input type="text" class="form-control" placeholder="DNI" name="dni_chof_dia" id="dni_chof_dia">
                            </div>
                        </div>
                        <div class="derecha">
                            <div class="form-group">
                                <br>
                                <label class="control-label" for="Precio">DNI CHOFER NOCHE</label>
                                <input type="text" class="form-control" placeholder="DNI" name="dni_chof_noche" id="dni_chof_noche">
                            </div>
                        </div>

                        <div class="izquierda">
                            <div class="form-group">
                                <br>
                                <label class="control-label" for="Precio">CP CHOFER DIA</label>
                                <input type="text" class="form-control" placeholder="CP" name="cp_chof_dia" id="cp_chof_fia">
                            </div>
                        </div>
                        <div class="derecha">
                            <div class="form-group">
                                <br>
                                <label class="control-label" for="Precio">CP CHOFER NOCHE</label>
                                <input type="text" class="form-control" placeholder="CP" name="cp_chof_noche" id="cp_chof_noche">
                            </div>
                        </div>

                        <div class="izquierda">
                            <div class="form-group">
                                <br>
                                <label class="control-label" for="Precio">CELULAR CHOFER DIA</label>
                                <input type="text" class="form-control" placeholder="CELULAR" name="cel_chof_dia" id="cel_chof_noche">
                            </div>
                        </div>
                        <div class="derecha">
                            <div class="form-group">
                                <br>
                                <label class="control-label" for="Precio">CELULAR CHOFER NOCHE</label>
                                <input type="text" class="form-control" placeholder="CELULAR" name="cel_chof_noche" id="cel_chof_noche">
                            </div>
                        </div>

                        <div class="centro">
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary" value="Añadir Chofer / es">
                            </div>
                        </div>
                    </div>

            </form>
        </div>
    </div>
    </div>
    <script src="..js/jquery-3.4.1.min.js"> </script>
    <script src="../js/bootstrap.min.js"> </script>
</body>

</html>