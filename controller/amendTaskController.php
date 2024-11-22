<?php

session_start();
require('../model/database.php');
require('../model/cr_ammend.php');

if ($_GET['action'] == 'insert') {
    $data = add_cr($_POST['pcr'],$_POST['ccr'],$_SESSION['$usrid']);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}