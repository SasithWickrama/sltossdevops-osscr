<?php
session_start();
require('../model/database.php');
require('../model/cr_tasks.php');

if ($_GET['action'] == 'list') {
    $data = get_cr_onetask($_POST['id'], $_POST['tname']);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}
if ($_GET['action'] == "add") {
    $data = insert_cr_task($_POST['id'], $_POST['tname'],$_POST['taskdis'],$_SESSION['$usrid'] ,$_POST['startd'] );
    echo json_encode($data);
}
if ($_GET['action'] == "update") {
   // try {
    $data = update_cr_task($_POST['id'], $_POST['tname'],$_SESSION['$usrid'] ,$_POST['endd']);
    echo json_encode($data);
//}
//catch(Exception $e) {
 // echo 'Message: ' .$e->getMessage();
//}
     
}
if ($_GET['action'] == "addnew") {
    $data = insert_newcr_task( $_POST['colour'],$_POST['tname']);
    echo json_encode($data);
}
if ($_GET['action'] == "fulladd") {
    $data = insert_cr_fulltask($_POST['id'], $_POST['tname'],$_POST['taskdis'],$_SESSION['$usrid'] ,$_POST['startd'] );
   // $data = update_cr_task($_POST['id'], $_POST['tname'],$_SESSION['$usrid'] ,$_POST['startd']);
    echo json_encode($data);
}