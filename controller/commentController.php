<?php
session_start();
require('../model/database.php');
require('../model/cr_comments.php');



return  save_comments($_POST['id'], $_POST['newcomment'],$_SESSION['$usrid'], $_POST['comtype']);
// header('Content-Type: application/json; charset=utf-8');
// return json_encode($data);
 
