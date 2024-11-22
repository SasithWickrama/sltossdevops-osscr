<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

function get_allamcr($cr)
{
    global $conn;
    $sql = "SELECT a.* , CR_TOPIC  ,ST_DATE FROM (SELECT CONNECT_BY_ROOT PARENT_CR BASE, PARENT_CR, CHILD_CR ,ADDED_ON ,ADDUSER
    FROM CRMAN_OSS_AMENDMENT
    CONNECT BY NOCYCLE  CHILD_CR = PARENT_CR)a , CRMANAGE_NEW
    WHERE BASE = :cr
    and CR_REF = CHILD_CR
    order by ADDED_ON";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':cr', $cr);
    $statment->execute();
    $tasklist = $statment->fetchAll();
    $statment->closeCursor();
    return $tasklist;
}

function add_cr($pcr, $ccr, $user)
{
    global $conn;
    $sql = "INSERT INTO OSSPRG.CRMAN_OSS_AMENDMENT (
        PARENT_CR, CHILD_CR, ADDED_ON,  ADDUSER) 
     VALUES ( :pcr , :ccr , sysdate , :usr )";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':pcr', $pcr);
    $statment->bindValue(':ccr', $ccr);
    $statment->bindValue(':usr', $user);    
    $tasklist = $statment->execute();
    $statment->closeCursor();
    return $tasklist;
}