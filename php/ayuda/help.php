<?php
include_once "../../funciones/funciones.php";
?>
<!DOCTYPE html>
<html lang="en-es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HELP</title>
    <?php head(); ?>
    <style>
        nav {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<nav>

    <h2>MENU DE USUARIOS</h2>
    <a href="../menu.php">VOLVER</a>
    <ul>
        <li>En este menu se crean los usuarios</li>
        <li>nombre de usuario, contraseña, correo, </li>
        <li>la fecha de creacion es automatica</li>
        <li>tambien es automatico el registro del creador del usuario</li>
        <li>tiene diferentes niveles</li>
        <ul>
            <li>Acceso Total</li>
            <li>Cobros</li>
            <li>Moviles Nuevos</li>
            <li>Choferes nuevos</li>
            <li>Solo lectura</li>
        </ul>
    </ul>
    <h2>SESIONES</h2>
    <a href="../menu.php">VOLVER</a>
    <ul>
        <li>Este menu es para seguridad</li>
        <li>Registra</li>
        <ul>
            <li>Nombre del usuario que realizo un movimiento en la caja</li>
            <li>Hora en que lo realizo</li>
        </ul>
    </ul>
    <h2>MENU MOVILES</h2>
    <a href="../menu.php">VOLVER</a>
    <ul>
        <li>En este menu se crean las undades nuevas</li>
        <li>Se editan los numeros de movil x cambio de numero</li>
        <li>Tambien genera la semana.</li>
        <li>Cuando se crea o edita el para cambiar el numero de movil, se hace lo mismo con la semana pero en segundo plano</li>
        <li></li>
    </ul>
    <h2>MENU TITULARES</h2>
    <a href="../menu.php">VOLVER</a>
    <ul>
        <li>En este menu se crean los titulares</li>
        <li>con todos los datos</li>
        <li>Npmbre, dni, correo, telefono y direccion</li>
        <li>tambien se editan</li>
    </ul>
    <h2>MENU UNIDADES</h2>
    <a href="../menu.php">VOLVER</a>
    <ul>
        <li>En este menu se crean las unidades</li>
        <li>con todos los datos</li>
        <li>Marca, modelo, año, dominio</li>
        <li>tambien se editan</li>
    </ul>
    <h2>MENU CHOFERES</h2>
    <a href="../menu.php">VOLVER</a>
    <ul>
        <li>En este menu se crean los Choferes de dia y de noche</li>
        <li>con todos los datos</li>
        <li>Npmbre, dni, correo, telefono y direccion</li>
        <li>tambien se editan</li>
    </ul>
    <h2>UNIDAD COMPLETA</h2>
    <a href="../menu.php">VOLVER</a>
    <ul>
        <li>En este menu se ve un resumen de todo</li>
        <li>Movil</li>
        <li>Titular</li>
        <li>Unidad</li>
        <li>Chofer dia</li>
        <li>Chofer noche</li>
    </ul>
    <h2>MENU VOUCHER</h2>
    <a href="../menu.php">VOLVER</a>
    <ul>
        <li>Se exporta un excel de los viajes de la aplicacion de despacho</li>
        <li>se seleciona el archivo y se exporta, presionar el boton de IMPORTAR <strong>una sola vez y esperar a que termine</strong></li>
        <li>Si lo hace mas de una vez le va a importar todos los voucher repetidos</li>
        <li>Si se equivoca puede borrar los voucher uno x uno o el boton LIMPIAR TABLA borra todos los voucher</li>
        <li>Paso seguido: ingresar el movil en el cuadro BUSCAR x MOVIL y lista todos los voucher del movil sin los viajes de la app pasajeros</li>
        <li>En esta pagina se puede: ver los detalles validarlos y editarlos, donde los edita tambien los valida.</li>
        <li>Ingresar el numero de mofil en el boton VAUCHIN</li>
        <li>le calcula todo y le dice la cantidad de viajes que tiene que abonar y lo que se le depositara al movil</li>
        <li>Copia la imagen con recortar de windows y lo pega en el Whatsapp del movil</li>
    </ul>
    <h2> MENU BACKUP</h2>
    <a href="../menu.php">VOLVER</a>
    <ul>
        <li>Relaiza backup de la DDBB</li>
        <li>Hacerlo una vez por dia por la mañana</li>
    </ul>
    <h2>SEMANA</h2>
    <a href="../menu.php">VOLVER</a>
    <ul>
        <li>Se le carla la semana que paso a los moviles</li>
        <li>El que se logea por primera vez el lunes, lo presiona</li>
        <li>No pasa nada si lo hacen mas veces la unica vez que se activa esa subrutina es cuando cambia la semana</li>
    </ul>
    <h2>DEUDA ANTERIOR</h2>
    <a href="../menu.php">VOLVER</a>
    <ul>
        <li>Este menu se va a usar solo la primera vez para traer la deuda del otro sistema</li>
        <li>Si graba un importe el anterior se borra</li>

    </ul>
    <h2>COBRAR A MOVILES</h2>
    <h2>LISTADOS Y RESUMENES</h2>
    <h2>ABONOS</h2>

    <br><br>

</nav>

<body>

    <?php foot(); ?>
</body>

</html>