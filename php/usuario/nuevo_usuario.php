<?php
session_start();
if ($_SESSION['logueado']) {
    echo "BIENVENIDO ,"  . $_SESSION['uname'] . '<br>';
    echo "Hora de conexión :" . $_SESSION['time'] . '<br>';
    include_once("../../funciones/funciones.php");
    $con = conexion();
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>USUARIOS</title>
        <?php head(); ?>
    </head>

    <body>
        <?php

        $con->set_charset("utf8mb4");
        ?>
        <div class="container">
            <h3 class="text-center">CREAR NUEVO USUARIO</h3>
            <div class="row">

                <div class="col-md-12">

                    <form class="form-group" accept=-"charset utf8" action="guarda_usuario.php" method="post" enctype="multipart/form-data">

                        <div class="from-group">
                            <label class="control-label" for="username">Nombre de Usuario</label>
                            <input type="text" class="form-control" name="username" id="username">
                        </div>

                        <div class="from-group">
                            <label class="control-label" for="pass_1">Password</label>
                            <input type="password" class="form-control" name="pass_1" id="pass_1">
                        </div>

                        <div class="from-group">
                            <label class="control-label" for="pass">Repita Password</label>
                            <input type="password" class="form-control" name="pass_2" id="pass_2">
                        </div>

                        <div class="form-group">
                            <label class="control-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="from-group">
                            <label class="control-label">Permisos</label>
                            <select name="permiso" id="permiso" class="form-control">
                                <option value="elija">Elija</option>
                                <option value="super">Acceso Total</option>
                                <option value="cobro">Cobros</option>
                                <option value="nuevo">Moviles nuevos</option>
                                <option value="chofer">Choferes nuevos</option>
                                <option value="solo">Solo lectura</option>
                            </select>
                        </div>
                        <br>
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="CREAR NUEVO USUARIO">
                            <br><br><br>
                            <a href="inicio_usuario.php" class="btn btn-primary">VOLVER</a>
                        </div>

                    </form>
                </div>
            </div>
            <?php foot(); ?>
    </body>

    </html>
<?php
}
?>