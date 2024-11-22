<?php
session_start();
require('../model/database.php');
require('../model/cr_user_tasks.php');

if ($_GET['action'] == 'list') {
    $data = get_user_cr_alltask($_POST['id']);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}
if ($_GET['action'] == 'listusertask') {
    $data = get_cr_usertask($_POST['id'], $_POST['uname']);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}
if ($_GET['action'] == "add") {
    $data = insert_cr_usertask($_POST['id'], $_POST['uname'],$_POST['taskdis'],$_SESSION['$usrid'] ,$_POST['startd'],$_POST['ttype'], $_POST['crtopic'] );
    echo json_encode($data);
}
if ($_GET['action'] == "update") {
     $data = update_cr_usertask($_POST['id'], $_POST['tname'],$_SESSION['$usrid'] ,$_POST['endd']);
     echo json_encode($data);
 }