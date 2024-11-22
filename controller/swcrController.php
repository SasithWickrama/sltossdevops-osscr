<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require('../model/database.php');
require('../model/sw_cr.php');


if ($_GET['action'] == 'add') {
    $data =  insert_swcr($_POST['topic'],$_POST['remarks'] ,$_POST['startdate'] ,$_POST['requestby']  );
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}