<?php

function get_user($sno){
    global $conn;    
        $sql = "select * from CRMAN_OSS_USERS where SNO = :sno";
        $statment = $conn->prepare($sql);
        $statment->bindValue(':sno',$sno);
        $statment->execute();
        $cctdetails = $statment->fetchAll();
        $statment->closeCursor();
        return $cctdetails;
    
}


