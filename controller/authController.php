<?php
session_start();
require('../model/database.php');
require('../model/cr_users.php');




$uname = $_POST['sno'] . "@intranet.slt.com.lk";
$pwd = $_POST['password'];
$user_name = $_POST['sno'];

$link = ldap_connect('intranet.slt.com.lk');
if (!$link) {
    echo "Cant Connect to Server";
}
ldap_set_option($link, LDAP_OPT_REFERRALS, 0);
ldap_set_option($link, LDAP_OPT_PROTOCOL_VERSION, 3);
if (ldap_bind($link, $uname, $pwd)) {

    $userdata = get_user($user_name);
    if (!empty($userdata)) {
        $_SESSION['$usrid'] = $user_name;
        $_SESSION['$p_level'] = $userdata[0]['USERLEVEL'];
        $_SESSION['loggedin'] = true;

        if(strcmp($userdata[0]['USERLEVEL'],'1') == 0) {
            header("Location: ../?a=projectList");
        }else{
            header("Location: ../?a=exprojectList");
        }
        
        
        exit;
    } else {
        echo "<script type='text/javascript'>alert('Not Authorize for this Site');  window.location.href = \"http://ossportal/osscr/\";</script>";
        exit;
    }
} else {
    echo "<script type='text/javascript'>alert('Invalid User Name or Password'); window.location.href = \"http://ossportal/osscr/\";</script>";
    exit;
}
