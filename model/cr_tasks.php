<?php

function get_alltask()
{
    global $conn;
    $sql = "SELECT   TASK_NAME, STATUS  FROM OSSPRG.CRMAN_OSS_TASKS WHERE STATUS = 1";
    $statment = $conn->prepare($sql);
    $statment->execute();
    $tasklist = $statment->fetchAll();
    $statment->closeCursor();
    return $tasklist;
}


function get_cr_alltask($cr)
{
    global $conn;
    $sql = "SELECT   TASKNAME , to_char(START_DATE,'YYYY-MM-DD HH24:MI:SS ') START_DATE,  to_char(nvl(END_DATE,sysdate),'YYYY-MM-DD HH24:MI:SS ') END_DATE , TASK_COMMENT,START_BY ,END_BY ,COLOUR 
    FROM OSSPRG.CRMAN_OSS_CRTASKS ,CRMAN_OSS_TASKS where CRID  = :cr  and TASK_NAME = TASKNAME order by START_DATE";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':cr',$cr);
    $statment->execute();
    $tasklist = $statment->fetchAll();
    $statment->closeCursor();
    return $tasklist;
}


function get_cr_onetask($cr,$tname)
{
    global $conn;
    $sql = "SELECT   * FROM OSSPRG.CRMAN_OSS_CRTASKS where CRID = :cr and TASKNAME = :tname and END_DATE is null";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':cr',$cr);
    $statment->bindValue(':tname',$tname);
    $statment->execute();
    $tasklist = $statment->fetchAll();
    $statment->closeCursor();
    return $tasklist;
}


function insert_cr_task($cr,$tname ,$tcomment ,$user , $start )
{
    global $conn;
    $sql = "INSERT INTO OSSPRG.CRMAN_OSS_CRTASKS (
        CRID, TASKNAME, START_DATE,
        START_BY, TASK_COMMENT, TASKID) 
     VALUES ( :cid, :tname,TO_DATE('$start 00:00:00', 'MM/DD/YYYY HH24:MI:SS ') ,:cruser , :com , CRMAN_OSS_CRTASKS_SEQ.NEXTVAL )";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':cid',$cr);
    $statment->bindValue(':tname',$tname);
    $statment->bindValue(':cruser',$user);
    $statment->bindValue(':com',$tcomment);
    //$statment->bindValue(':sdate',$start);
    $tasklist = $statment->execute();
    $statment->closeCursor();
    return $tasklist;
}

function insert_cr_fulltask($cr,$tname ,$tcomment ,$user , $start )
{
    global $conn;
    $sql = "INSERT INTO OSSPRG.CRMAN_OSS_CRTASKS (
        CRID, TASKNAME, START_DATE,END_DATE ,
        START_BY, END_BY , TASK_COMMENT, TASKID) 
     VALUES ( :cid, :tname,TO_DATE('$start 00:00:00', 'MM/DD/YYYY HH24:MI:SS '),TO_DATE('$start 23:59:59', 'MM/DD/YYYY HH24:MI:SS ') ,:cruser,:cruser , :com , CRMAN_OSS_CRTASKS_SEQ.NEXTVAL )";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':cid',$cr);
    $statment->bindValue(':tname',$tname);
    $statment->bindValue(':cruser',$user);
    $statment->bindValue(':com',$tcomment);
    //$statment->bindValue(':sdate',$start);
    $tasklist = $statment->execute();
    $statment->closeCursor();
    return $tasklist;
}


function update_cr_task($cr,$tname  ,$user, $end)
{
    global $conn;
    $sql = "UPDATE OSSPRG.CRMAN_OSS_CRTASKS    SET   
           END_DATE     = TO_DATE('$end 23:59:59', 'MM/DD/YYYY HH24:MI:SS '),
           END_BY       =  :cruser
           WHERE END_DATE IS NULL AND CRID = :cid AND TASKNAME = :tname AND END_DATE IS NULL";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':cid',$cr);
    $statment->bindValue(':tname',$tname);
    $statment->bindValue(':cruser',$user);
    $tasklist = $statment->execute();
    $statment->closeCursor();
    return $sql;
}


function insert_newcr_task($colour,$tname )
{
    global $conn;
    $sql = "INSERT INTO OSSPRG.CRMAN_OSS_TASKS (
        TASK_NAME,  COLOUR , STATUS) 
     VALUES (  :taskname, :colour , 1 ) ";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':taskname',$tname);
    $statment->bindValue(':colour',$colour);
    $tasklist = $statment->execute();
    $statment->closeCursor();
    return $tasklist;
}