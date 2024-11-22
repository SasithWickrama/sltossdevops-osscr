<?php

function get_comments($crid)
{
    global $conn;
    $sql = "select USERID,  UNAME, to_char(INSERT_DATE,'YYYY/MM/DD HH24:MI:SS' ) INSERT_DATE,replace(replace(TEXT,chr(10)),'\"','''')  TEXT ,COMTYPE from CRMAN_OSS_COMMENTS ,CRMAN_OSS_USERS where CRID = :crid
    and USERID = sno order by INSERT_DATE asc ";    
    $statment = $conn->prepare($sql);
    $statment->bindValue(':crid', $crid);
    $statment->execute();
    $crcomments = $statment->fetchAll();
    $statment->closeCursor();
    return $crcomments;
}

function get_crcomments($crid)
{
    global $conn;
    $sql = "select COM_USER,USERNAME UNAME, to_char(COM_DATE,'YYYY/MM/DD HH24:MI:SS' ) INSERT_DATE, CRCOMMENT TEXT  from CRMANAGE_COMMENT  ,CRMANAGE_LOGIN 
    where CR_REF = :crid and COM_USER = USERID";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':crid', $crid);
    $statment->execute();
    $crcomments = $statment->fetchAll();
    $statment->closeCursor();
    return $crcomments;
}


function save_comments($crid, $comment , $user , $comtype)
{
    global $conn;
    $sql = "INSERT INTO OSSPRG.CRMAN_OSS_COMMENTS (
            USERID, INSERT_DATE, TEXT, 
            CRID , COMTYPE) 
         VALUES ( :userid,sysdate,trim(:com),:crid , :comtype )";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':crid', $crid);
    $statment->bindValue(':com', $comment);
    $statment->bindValue(':userid', $user);
    $statment->bindValue(':comtype', $comtype);
    $comstatus = $statment->execute();        
    $statment->closeCursor();
    return $comstatus;
}



function get_excomments($crid)
{
    global $conn;
    $sql = "select USERID,  UNAME, to_char(INSERT_DATE,'YYYY/MM/DD HH24:MI:SS' ) INSERT_DATE,replace(replace(TEXT,chr(10)),'\"','''')  TEXT ,COMTYPE from CRMAN_OSS_COMMENTS ,CRMAN_OSS_USERS where CRID = :crid
    and USERID = sno and COMTYPE = 'External' order by INSERT_DATE asc ";    
    $statment = $conn->prepare($sql);
    $statment->bindValue(':crid', $crid);
    $statment->execute();
    $crcomments = $statment->fetchAll();
    $statment->closeCursor();
    return $crcomments;
}