<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

session_start();
require('model/database.php');
require('model/cr_db.php');
require('model/cr_comments.php');
require('model/cr_tasks.php');
require('model/cr_email.php');
require('model/cr_comtype.php');
require('model/cr_exceptions.php');
require('model/cr_pendingcat.php');
require('model/cr_user_tasks.php');
require('model/cr_ammend.php');



$action = filter_input(INPUT_POST, 'a', FILTER_SANITIZE_STRING);
if (!$action) {
    $action = filter_input(INPUT_GET, 'a', FILTER_SANITIZE_STRING);
}

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
if (!$id) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
}



switch ($action) {
    case "project":
        $allcr = get_allcr();
        $tasklist = get_alltask();
        $userlist = get_alluser();
        $allcrdetails =  get_allcr();
        if ($id) {
            $crdetails = get_cr($id);
            $comments = get_comments($id);
            $crmscomments = get_crcomments($id);
            $crtasklist = get_cr_alltask($id);
            $comtypes = get_comtypes($id);
            $crcat = get_pendingcat($id);
            $usertasks = get_user_cr_alltask($id);
            $ammend = get_allamcr($id);
        } else {
            $crdetails = "";
            $comments = "";
            $crmscomments = "";
            $crtasklist = "";
            $comtypes = "";
            $crcat = "";
            $usertasks = "";
            $userlist = "";
            $ammend = "";
        }
        include('view/projects.php');
        break;
        case "project1":
            $allcr = get_allcr();
            $tasklist = get_alltask();
            $userlist = get_alluser();
            $allcrdetails =  get_allcr();
            if ($id) {
                $crdetails = get_cr($id);
                $comments = get_comments($id);
                $crmscomments = get_crcomments($id);
                $crtasklist = get_cr_alltask($id);
                $comtypes = get_comtypes($id);
                $crcat = get_pendingcat($id);
                $usertasks = get_user_cr_alltask($id);
                $ammend = get_allamcr($id);
            } else {
                $crdetails = "";
                $comments = "";
                $crmscomments = "";
                $crtasklist = "";
                $comtypes = "";
                $crcat = "";
                $usertasks = "";
                $userlist = "";
                $ammend = "";
            }
            include('view/projects1.php');
            break;
    case "projectList":
        $allcr = get_allcr();
        $escr = get_escr();
        $smecr = get_smecr();
        $concr = get_concr();
        $swcr = get_swcr();
        $othercr = get_othercr();
        $configcr = get_configcr();
        $bprcr = get_bprcr();
        $financecr = get_financecr();
        include('view/projectList.php');
        break;

        case "projectList1":
            $allcr = get_allcr();
            $escr = get_escr();
            $smecr = get_smecr();
            $concr = get_concr();
            $swcr = get_swcr1();
            $othercr = get_othercr();
            $configcr = get_configcr();
            include('view/projectList1.php');
            break;
    case "emailList":
        $allemail = get_pendingemail();
        include('view/emailList.php');
        break;
    case "comments":
        $comments = get_comments($id);
        include('view/comments.php');
        break;
    case "exlList":
        $rmcr = get_expcr();
        include('view/removeList.php');
        break;
    case "summary":
        $rmcr = get_pendingcat_summary();
        include('view/summary.php');
        break;
    case "logout":
        unset($_SESSION['$usrid']);
        unset($_SESSION['$p_level']);
        unset($_SESSION['loggedin']);
        include('view/login.php');
        break;

        case "exprojectList":
            $allcr = get_allcr();
            $escr = get_escr();
            $smecr = get_smecr();
            $concr = get_concr();
            $othercr = get_othercr();
            $configcr = get_configcr();
            $bprcr = get_bprcr();
            $financecr = get_financecr();
            include('view/exprojectList.php');
            break;

            case "exproject":
                $allcr = get_allcr();
                $tasklist = get_alltask();
                $userlist = get_alluser();
                $allcrdetails =  get_allcr();
                if ($id) {
                    $crdetails = get_cr($id);
                    $comments = get_excomments($id);
                    $crmscomments = get_crcomments($id);
                    $crtasklist = get_cr_alltask($id);
                    $comtypes = get_comtypes($id);
                    $crcat = get_pendingcat($id);
                    $usertasks = get_user_cr_alltask($id);
                    $ammend = get_allamcr($id);
                } else {
                    $crdetails = "";
                    $comments = "";
                    $crmscomments = "";
                    $crtasklist = "";
                    $comtypes = "";
                    $crcat = "";
                    $usertasks = "";
                    $userlist = "";
                    $ammend = "";
                }
                include('view/exprojects.php');
                break;
    case "crsummaryoss":
        // $rmcr = get_expcr();
        include('view/taskSumDetails.php');
        break;
    default:
        include('view/login.php');
}
