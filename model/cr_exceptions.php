<?php


function save_exp($crid, $user )
{
    global $conn;
    $sql = "INSERT INTO OSSPRG.CRMAN_OSS_EXCEPTIONS (
        CR_REF, REMOVEDBY, REMOVEDON) 
     VALUES ( :crid, :userid, sysdate )";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':crid', $crid);
    $statment->bindValue(':userid', $user);
    $comstatus = $statment->execute();        
    $statment->closeCursor();
    return $comstatus;
}


function get_expcr(){
    global $conn;    
        $sql = "SELECT *  FROM CRMANAGE_NEW A ,CRMAN_OSS_EXCEPTIONS X WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 ) AND A.CR_REF NOT LIKE '201900%' AND A.CR_REF  = X.CR_REF ";
        $statment = $conn->prepare($sql);
        $statment->execute();
        $cctdetails = $statment->fetchAll();
        $statment->closeCursor();
        return $cctdetails;

        /*
        2,3 - configuraton inprogress
        4 - uat mdm configuration
        5 - uat soa sync
        6 - ready for uat
        7 - uat pending
        8 - production config oss
        10 - production config mdm
        11 - production soa sync
        12 - prod compleate
        */
    
}