<?php

function get_pendingemail()
{
    global $conn;
    $sql = "SELECT 
    CRNO, REQUEST_BY, UNAME ,to_char(REQUEST_ON,'YYYY/MM/DD HH24:MI:SS' ) REQUEST_ON, 
       REM, to_char(LAST_REM,'YYYY/MM/DD HH24:MI:SS' )  LAST_REM , PRO_OWNER
    FROM OSSPRG.CRMAN_OSS_EMAIL , CRMAN_OSS_USERS , CRMANAGE_NEW where COMPLEATED_ON is null and REQUEST_BY = sno and CRNO = CR_REF ";

    $statment = $conn->prepare($sql);
    $statment->execute();
    $crcomments = $statment->fetchAll();
    $statment->closeCursor();
    return $crcomments;
}


function close_pendingemail($crid,  $user)
{
    global $conn;
    $sql = "UPDATE OSSPRG.CRMAN_OSS_EMAIL
    SET    COMPLEATED_BY = :userid,
           COMPLEATED_ON = sysdate
    where CRNO= :crid and COMPLEATED_ON is null";

    $statment = $conn->prepare($sql);
    $statment->bindValue(':crid', $crid);
    $statment->bindValue(':userid', $user);
    $crcomments = $statment->execute();
    $statment->closeCursor();
    return $crcomments;
}


function insert_pendingemail($crid,  $user)
{
    global $conn;
    $sql = "SELECT 
    CRNO, REQUEST_BY, to_char(REQUEST_ON,'YYYY/MM/DD HH24:MI:SS' ) REQUEST_ON, 
       REM, to_char(LAST_REM,'YYYY/MM/DD HH24:MI:SS' )  LAST_REM
    FROM OSSPRG.CRMAN_OSS_EMAIL where COMPLEATED_ON is null and CRNO= :crid ";

    $statment = $conn->prepare($sql);
    $statment->bindValue(':crid', $crid);
    $statment->execute();
    $crcomments = $statment->fetchAll();
    $statment->closeCursor();

    if ($crcomments) {
        $sql = "UPDATE OSSPRG.CRMAN_OSS_EMAIL
        SET    REM = REM+1,
               LAST_REM = sysdate
        where CRNO= :crid and COMPLEATED_ON is null";

        $statment = $conn->prepare($sql);
        $statment->bindValue(':crid', $crid);
        $crcomments = $statment->execute();
        $statment->closeCursor();
    } else {
        $sql = "INSERT INTO OSSPRG.CRMAN_OSS_EMAIL (
            CRNO, REQUEST_BY, REQUEST_ON, 
            REM) 
         VALUES ( :crid, :userid, sysdate,0)";

        $statment = $conn->prepare($sql);
        $statment->bindValue(':crid', $crid);
        $statment->bindValue(':userid', $user);
        $crcomments = $statment->execute();
        $statment->closeCursor();
    }

    return $crcomments;
}
