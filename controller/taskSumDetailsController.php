<?php
session_start();
require('../model/database.php');
require('../model/cr_taskSumDetails.php');

if ($_GET['action'] == 'crSumDetailsOss') {
    $data = getCrSumDetailsOss();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}

?>