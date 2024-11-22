<?php

function get_allswcr()
{
    global $conn;
    $sql = "SELECT   *  FROM OSSPRG.CRMAN_OSS_SWCR WHERE STATUS = 1";
    $statment = $conn->prepare($sql);
    $statment->execute();
    $tasklist = $statment->fetchAll();
    $statment->closeCursor();
    return $tasklist;
}


function insert_swcr($topic,$remarks ,$startdate ,$requestby  )
{
    global $conn;

    $sql = "SELECT 'SW'||LPAD(SWCR_SEQ.NEXTVAL,3,'0') SWID FROM DUAL";
    $statment = $conn->prepare($sql);
    $statment->execute();
    $data = $statment->fetchAll();

    $swid = $data[0]['SWID'];

    
    $sql = "INSERT INTO OSSPRG.CRMAN_OSS_SWCR (
        CR_ID, TOPIC, REMARKS, 
        START_DATE, REQUEST_BY, STATUS, 
        STATUS_DATE) 
     VALUES ( :swid, :topic ,:remarks ,TO_DATE('$startdate 00:00:00', 'MM/DD/YYYY HH24:MI:SS ') ,:requestby ,1 ,SYSDATE)";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':swid',$swid);
    $statment->bindValue(':topic',$topic);
    $statment->bindValue(':remarks',$remarks);
    $statment->bindValue(':requestby',$requestby);
    $tasklist = $statment->execute();
    $statment->closeCursor();
    return $swid;
    
}