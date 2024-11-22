<?php
session_start();
require('../model/database.php');
require('../model/cr_email.php');

if ($_GET['action'] == 'close') {
    $data = close_pendingemail($_POST['id'], $_SESSION['$usrid']);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}
if ($_GET['action'] == "add") {
    $data = insert_pendingemail($_POST['id'], $_SESSION['$usrid'] );
    echo json_encode($data);
}
