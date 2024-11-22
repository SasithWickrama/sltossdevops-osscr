<?php


function get_user_cr_alltask($cr)
{
    global $conn;
    $sql = "SELECT  UNAME,SNAME,  to_char(ASSIGN_DATE,'YYYY-MM-DD HH24:MI:SS ') START_DATE,  
    to_char(nvl(END_DATE,sysdate),'YYYY-MM-DD HH24:MI:SS ') END_DATE , TASK_COMMENT , to_char(nvl(ASSIGN_DATE,sysdate),'YYYY-MM-DD HH24:MI:SS ')  ASSIGN_DATE
    FROM OSSPRG.CRMAN_OSS_USERTASKS  , CRMAN_OSS_USERSUPERVISER x 
    where CRID  = :cr AND USERSNO=SID order by ASSIGN_DATE";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':cr', $cr);
    $statment->execute();
    $tasklist = $statment->fetchAll();
    $statment->closeCursor();
    return $tasklist;
}


function get_alluser()
{
    global $conn;
    $sql = "SELECT   SID, UNAME  FROM OSSPRG.CRMAN_OSS_USERSUPERVISER order by SID";
    $statment = $conn->prepare($sql);
    $statment->execute();
    $tasklist = $statment->fetchAll();
    $statment->closeCursor();
    return $tasklist;
}


function get_cr_usertask($cr, $tname)
{
    global $conn;
    $sql = "SELECT   * FROM OSSPRG.CRMAN_OSS_USERTASKS where CRID = :cr and USERSNO = :tname and END_DATE is null";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':cr', $cr);
    $statment->bindValue(':tname', $tname);
    $statment->execute();
    $tasklist = $statment->fetchAll();
    $statment->closeCursor();
    return $tasklist;
}


function insert_cr_usertask($cr, $tname, $tcomment, $user, $start, $system, $topic)
{
    global $conn;
    $coment = 'Task Start by ' . $user . '. ' . $tcomment;
    $sql = "INSERT INTO OSSPRG.CRMAN_OSS_USERTASKS (
        CRID, USERSNO, START_DATE, 
         TASK_COMMENT, ASSIGN_DATE)
     VALUES ( :cid, :tname,TO_DATE('$start 00:00:00', 'MM/DD/YYYY HH24:MI:SS ') ,:com , TO_DATE('$start 00:00:00', 'MM/DD/YYYY HH24:MI:SS ') )";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':cid', $cr);
    $statment->bindValue(':tname', $tname);
    $statment->bindValue(':com', $coment);
    //$statment->bindValue(':sdate',$start);
    $tasklist = $statment->execute();
    $statment->closeCursor();

    //sending email
    $sql = "select USR_MAIL , USERNAME from  CRMANAGE_LOGIN where USERID = :tname";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':tname', $tname);
    $statment->execute();
    $email = $statment->fetchAll();
    $statment->closeCursor();

    $usrmail = $email[0]['USR_MAIL'];
    $username = $email[0]['USERNAME'];
    $msg = ' Assigned CR to user ' . $cr . ' system : ' . $system;

    //$to = 'dhanushkal@slt.com.lk'; //$usrmail[0];
    //$tocc = $uemail[0];
    $subject = 'NEW CR - ' . $topic;

    $message = '<html>
                            <head>
                            </head>
                            <body>
                              <p>Dear ' . $username . ',</p>
                              </br>
                              <p>This is an automated response to notify you that Following CR Assigned to you in CRMS.</p>
                              <p>CR REF : ' . $cr . '</p>  <p>URL : http://ossportal/crms/login  </p>                                       
                            </body>
                            </html>';

    $headers  = "From: oss@slt.com.lk \r\n" .  'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // LogMsg($a, $uid, $msg);
    mail($usrmail, $subject, $message, $headers);

    $sql = "INSERT INTO CRMANAGE_LOG VALUES ('$cr',sysdate,'$user','$msg')";
    $statment = $conn->prepare($sql);
    $temp = $statment->execute();
    $statment->closeCursor();

    //sending email

    //updating praboda tables
    $sql = "INSERT INTO OSSPRG.CRMANAGE_USER VALUES (:cid,:sys, :tname,'ASSIGNED',sysdate,'$user')";

    $statment = $conn->prepare($sql);
    $statment->bindValue(':cid', $cr);
    $statment->bindValue(':sys', $system);
    $statment->bindValue(':tname', $tname);
    $temp = $statment->execute();
    $statment->closeCursor();
    if ($temp) {

        $sql = "update CRMANAGE_NEW
          set CR_STATUS = '3' , ST_DATE = sysdate
          where CR_REF = '$cr' and CR_STATUS IN( '2') ";

        $statment = $conn->prepare($sql);
        $temp = $statment->execute();
    }
    //updating praboda tables
    return $tasklist;
}


function update_cr_usertask($cr,$tname  ,$user, $end)
{
    global $conn;
    $sql = "UPDATE OSSPRG.CRMAN_OSS_USERTASKS    SET   
           END_DATE     = TO_DATE('$end 23:59:59', 'MM/DD/YYYY HH24:MI:SS '),
           END_BY       =  :cruser
           WHERE END_DATE IS NULL AND CRID = :cid AND TASKNAME = :tname AND END_DATE IS NULL";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':cid',$cr);
    $statment->bindValue(':tname',$tname);
    $statment->bindValue(':cruser',$user);
    $tasklist = $statment->execute();
    $statment->closeCursor();

   

    return $tasklist;
}


// function insert_newcr_task($colour,$tname )
// {
//     global $conn;
//     $sql = "INSERT INTO OSSPRG.CRMAN_OSS_TASKS (
//         TASK_NAME,  COLOUR , STATUS) 
//      VALUES (  :taskname, :colour , 1 ) ";
//     $statment = $conn->prepare($sql);
//     $statment->bindValue(':taskname',$tname);
//     $statment->bindValue(':colour',$colour);
//     $tasklist = $statment->execute();
//     $statment->closeCursor();
//     return $tasklist;
// }