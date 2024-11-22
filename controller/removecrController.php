<?php
session_start();
require('../model/database.php');
require('../model/cr_exceptions.php');



return  save_exp($_POST['id'], $_SESSION['$usrid']);