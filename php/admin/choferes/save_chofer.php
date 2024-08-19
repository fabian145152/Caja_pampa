<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SALVA CHOFERES</title>
</head>

<body>
    <?php

    $movil = $_POST['movil'];
    $nombre_chof_dia = $_POST['nombre_chof_dia'];
    $apellido_chof_dia = $_POST['apellido_chof_dia'];
    //$direccion_chof_dia = $_POST['direccion_chof_dia'];
    //$dni_chof_dia = $_POST['dni_chof_dia'];
    //$cp_chof_dia = $_POST['cp_chof_dia'];
    //$cel_chof_dia = $_POST['cel_chof_dia'];
    //$nombre_chof_noche = $_POST['nombre_chof_noche'];
    //$apellido_chof_noche = $_POST['apellido_chof_noche'];
    //$direccion_chof_noche = $_POST['direccion_chof_noche'];
    //$dni_chof_noche = $_POST['dni_chof_noche'];
    //$cp_chof_noche = $_POST['cp_chof_noche'];
    //$cel_chof_noche = $_POST['cel_chof_noche'];

    include_once '../../includes/db.php';
    $con = openCon('../../config/db_admin.ini');
    $con->set_charset("utf8mb4");




    $sql = "UPDATE `completa` SET 'nombre_chof_1' = $nombre_chof_dia,
                                  'apellido_chof_1' = $apellido_chof_dia 
    WHERE id = $movil";

    /* 
                apellido_chof_1->:miapellido_chof_1,
                dni_chof_1->:midni_chof_1,
                direccion_chof_1->:midireccion_chof_1,
                cp_chof_1->:micp_chof_1,
                cel_chof_1->:micel_chof_1,
                nombre_chof_2->:minombre_chof_2,
                apellido_chof_2->:miapellido_chof_2,
                dni_chof_2->:midni_chof_2,
                direccion_chof_2->:midireccion_chof_2,
                cp_chof_2->:micp_chof_2,
                cel_chof_2->:micel_chof_2
*/


    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $nombre_chof_dia, $apellido_chof_dia);


    /*
        ":miapellido_chof_1" => $apellido_chof_dia,
        ":midni_chof_1" => $dni_chof_dia,
        ":midireccion_chof_1" => $direccion_chof_dia,
        ":micp_chof_1" => $cp_chof_dia,
        ":micel_chof_1" => $cel_chof_dia,
        ":minombre_chof_2" => $nombre_chof_noche,
        ":miapellido_chof_2" => $apellido_chof_noche,
        ":midni_chof_2" => $dni_chof_noche,
        ":midireccion_chof_2" => $dni_chof_noche,
        ":micp_chof_2" => $cp_chof_noche,
        ":micel_chof_2" => $cel_chof_noche
        */

    if ($stmt->execute()) {

    ?>
        <script>
            alert("NUEVO CHOFER CREADO")
            window.location = "list_chofer.php";
        </script>
    <?php

    }
    ?>