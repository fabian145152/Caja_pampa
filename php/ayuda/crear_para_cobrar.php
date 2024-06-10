<?php
session_start();
include_once "../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AYUDA CREAR UNIDAD</title>
</head>

<body>

    <h1>PROCESO DE ARMADO DE UNA UNIDAD PARA COMENZAR A COBRARLE</h1>
    <ol>




        <li>
            <h2>Primer Paso</h2>
            <h2>BOTON <strong>"NUEVO / EDITA TITULAR Y MOVIL"</strong>Del menu principal.<h2>
        </li>
        <ol>
            <li>
                <p>En esta pantalla se ven los numeros de móvil y los datos de los titulares</p>
                <p>y varios botones.</p>
            </li>
            <li>BOTON <strong>"NUEVO TITULAR"</strong>
                <p>En esta pantalla se cargan los datos del titular.</p>
                <p>Por ultimo se carga el numero de móvil.</p>
                <p>Pulsando <strong>"CREAR NUEVO TITULAR Y MOVIL"</strong> se genera el nuevo titular.</p>
                <P><strong>"SALIR"</strong>Vuelve a la pantalla anterior.</P>
                <p>OBS: Todos los campos deben estar competos.</p>
                <p>Los números de movil no deben esta repetidos.</p>
            </li>
        </ol>




        <li>
            <h3>BOTON<strong>"ACTUALIZAR"</strong></h3>
        </li>
        <ol>
            <li>
                <p>Actualiza todos los datos del titular o la unidad.</p>
                <p>si el campo no se modifica lo guarda en el estado en que se encuentra.</p>
            </li>

        </ol>
        <li>BOTON<strong>"BORRAR"</strong></li>
        <ol>
            <li>
                <p>Borra el registro comleto, asegurarse de no borrar un movil con los datos cargados porque se borraran todos los datos de la facturación</p>
            </li>
        </ol>
        <li>BOTON<strong>"VOLVER"</strong></li>
        <ol>
            <li>
                <p>Vuelve al menu principal.</p>
            </li>
        </ol>
        <h2>Segundo Paso:</h2>
        <h2>BOTON<strong>"EDICION UNIDAD COMPLETA"</strong>Del menú principal.</h2>
        <li>
            <ol>
                <li>
                    <p>En esta pantala se ve un resumen todos los datos del movil:</p>
                    <p>Numero de Movil.</p>
                    <p>Titlular.</p>
                    <p>Chofer de día.</p>
                    <p>Chofer de noche.</p>
                    <p>Datos de la unidad.</p>
                </li>
            </ol>
        <li>BOTON<strong>"DETALLES"</strong></li>
        <ol>
            <li>
                <p>Se muestran los datos completos de la unidad.</p>
                <p>Datos de Titular.</p>
                <p>Datos del chofer de día.</p>
                <p>Datos del chofer de noche.</p>
                <p>Datos del auto.</p>
                <p>No dejar de completar todos los datos.</p>
            </li>

        </ol>

        <li>BOTON<strong>"ACTUALIZAR"</strong></li>
        <ol>
            <li>
                <p>En esta pantalla se actualizan los datos de:</p>
                <p>Chofer de día.</p>
                <p>Chofer de noche.</p>
                <p>Datos de la unidad.</p>
                <h2>IMPORTANTE<h3>Seleccionar los siguientes parametros:</h3>
                </h2>
                <p><strong>Fecha de ingreso</strong></p>
                <p><strong>Fecha de inicio de facturación</strong></p>
                <p><strong>Paga por semana</strong></p>
                <p><strong>Paga por semana</strong></p>
            </li>

            <li>BOTON<strong>"GUARDA DATOS"</strong></li>
            <p>
            <p>Guarda los cambios, si no se modifico el campo</p>
            <p>Lo guarda en el estado en que se encuentra.</p>
            </li>
        </ol>
        <li>BOTON<strong>"BORRAR"</strong></li>
        <ol>
            <li>
                <p>Borra todos los datos de la unidad y los registros de facturacion</p>
            </li>
        </ol>
        <li>BOTON<strong>"VOLVER"</strong>Vuelve al menu principal</li>
        <h2>Tercer Paso:</h2>
</body>

</html>