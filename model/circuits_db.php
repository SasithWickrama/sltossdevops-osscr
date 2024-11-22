<?php

function get_circuit($circuit){
    global $conn;
    if($circuit){
        $sql = "select * from circuits where CIRT_DISPLAYNAME=:cctname";
        $statment = $conn->prepare($sql);
        $statment->bindValue(':cctname',$circuit);
        $statment->execute();
        $cctdetails = $statment->fetchAll();
        $statment->closeCursor();
        return $cctdetails;
    }
}