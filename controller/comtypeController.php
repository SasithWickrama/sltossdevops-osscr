<?php
session_start();
require('../model/database.php');
require('../model/cr_comtype.php');


if ($_GET['action'] == "add") {
    return  save_comtype($_POST['id'], $_POST['comtype'],$_POST['colour']);
}
if ($_GET['action'] == "updateuat") {
    return  update_comtypeuat($_POST['id'], $_POST['comtype'],$_POST['status']);
}
if ($_GET['action'] == "updateprod") {
    return  update_comtypeprod($_POST['id'], $_POST['comtype'],$_POST['status']);
}
