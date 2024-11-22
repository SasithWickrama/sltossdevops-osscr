<?php
session_start();
require('../model/database.php');
require('../model/cr_pendingcat.php');


if ($_GET['action'] == 'addcat') {
    return  insert_pendingcat($_POST['id'], $_POST['val']);
}
if ($_GET['action'] == 'addpri') {
    return  insert_pendingcatpri($_POST['id'], $_POST['val']);
}
if ($_GET['action'] == 'addtype') {
    return  insert_pendingcattype($_POST['id'], $_POST['val']);
}
// header('Content-Type: application/json; charset=utf-8');
// return json_encode($data);


