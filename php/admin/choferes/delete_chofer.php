<?php

//session_start();
//if ($_SESSION['logueado']) {

include_once '../../includes/db.php';
$con = openCon('../../config/db_admin.ini');
$con->set_charset("utf8mb4");
$id_del = $_GET['q'];
$sql = "DELETE FROM choferes WHERE id=" . $id_del;
$result = $con->query($sql);
header("Location:list_chofer.php");
//}
