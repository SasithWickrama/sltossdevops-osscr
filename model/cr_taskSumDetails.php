<?php

function getCrSumDetailsOss()
{
    global $conn;
    
    // CONFIG=1
    $sqlBSS = "SELECT  * FROM CRMAN_OSS_PENDINGCAT";
    $stmtBSS = $conn->prepare($sqlBSS);
    $stmtBSS->execute();
    $data['result'] = $stmtBSS->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}
