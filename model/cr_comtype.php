<?php

function get_comtypes($crid)
{
    global $conn;
    $sql = "select COM_TYPE ,COLOUR , COM_STATUS , UAT , PROD from CRMAN_OSS_COMTYPES  where CR_REF = :crid order by COM_TYPE asc ";    
    $statment = $conn->prepare($sql);
    $statment->bindValue(':crid', $crid);
    $statment->execute();
    $crcomments = $statment->fetchAll();
    $statment->closeCursor();
    return $crcomments;
}




function save_comtype($crid , $com ,$colour)
{
    global $conn;
    $sql = "INSERT INTO OSSPRG.CRMAN_OSS_COMTYPES (
        CR_REF, COM_TYPE,COLOUR) 
     VALUES ( :crid, INITCAP(:comtype) , :colour) ";    
    $statment = $conn->prepare($sql);
    $statment->bindValue(':crid', $crid);
    $statment->bindValue(':comtype', $com);
    $statment->bindValue(':colour',$colour);
    $comstatus = $statment->execute();        
    $statment->closeCursor();
    return $comstatus;
}



function update_comtypeuat($crid , $com ,$status)
{
    global $conn;
    $sql = "UPDATE OSSPRG.CRMAN_OSS_COMTYPES SET UAT = :cstatus WHERE   CR_REF =:crid AND COM_TYPE = :comtype ";    
    $statment = $conn->prepare($sql);
    $statment->bindValue(':crid', $crid);
    $statment->bindValue(':comtype', $com);
    $statment->bindValue(':cstatus',$status);
    $comstatus = $statment->execute();        
    $statment->closeCursor();
    return $comstatus;
}

function update_comtypeprod($crid , $com ,$status)
{
    global $conn;
    $sql = "UPDATE OSSPRG.CRMAN_OSS_COMTYPES SET PROD = :cstatus WHERE   CR_REF =:crid AND COM_TYPE = :comtype ";    
    $statment = $conn->prepare($sql);
    $statment->bindValue(':crid', $crid);
    $statment->bindValue(':comtype', $com);
    $statment->bindValue(':cstatus',$status);
    $comstatus = $statment->execute();        
    $statment->closeCursor();
    return $comstatus;
}
