<?php

function get_pendingcat($crid){
    global $conn;
    $sql = "SELECT 
    CR_REF, BSS, OSS, 
       CRM, MDM, PRE_UAT , PM_UAT, 
       UAT, PRODUCTION, PM, 
       DEPENDENCY, CONFIG, UATMAIN, WAITING
    FROM OSSPRG.CRMAN_OSS_PENDINGCAT  where CR_REF = :crid";    
    $statment = $conn->prepare($sql);
    $statment->bindValue(':crid', $crid);
    $statment->execute();
    $crcomments = $statment->fetchAll();
    $statment->closeCursor();
    return $crcomments;

}



function insert_pendingcat($crid,  $val)
{
    global $conn;

    $insertval = explode(" ", $val);
    if ($insertval[0] == 0 && $insertval[1] == 0 && $insertval[2] == 0 && $insertval[3] == 0 && $insertval[4] == 0) {
        $config = 0;
    } else {
        $config = 1;
    }

    if ($insertval[5] == 0 && $insertval[6] == 0 && $insertval[7] == 0) {
        $uatmaom = 0;
    } else {
        $uatmaom = 1;
    }

    if ($insertval[8] == 0 && $insertval[9] == 0) {
        $waiting = 0;
    } else {
        $waiting = 1;
        $uatmaom = 0;
        $config = 0;
    }

   $sql = "SELECT * 
    FROM OSSPRG.CRMAN_OSS_PENDINGCAT where CR_REF = :crid";

    $statment = $conn->prepare($sql);
    $statment->bindValue(':crid', $crid);
    $statment->execute();
    $crcomments = $statment->fetchAll();
    $statment->closeCursor();

     if ($crcomments) {
        $sql = "UPDATE OSSPRG.CRMAN_OSS_PENDINGCAT
        SET    BSS        = :bss,
               OSS        = :oss,
               CRM        = :crm,
               MDM        = :mdm,
               PRE_UAT    = :preuat,
               PM_UAT     = :pmuat,
               UAT        = :uat,
               PRODUCTION = :prod,
               PM         = :pm,
               DEPENDENCY = :dep,
               CONFIG     = :config,
               UATMAIN    = :uatmaom,
               WAITING    = :waiting
        where CR_REF = :crid";

        $statment = $conn->prepare($sql);
        $statment->bindValue(':crid', $crid);
        $statment->bindValue(':bss', $insertval[0]);
        $statment->bindValue(':oss', $insertval[1]);
        $statment->bindValue(':crm', $insertval[2]);
        $statment->bindValue(':mdm', $insertval[3]);
        $statment->bindValue(':preuat', $insertval[4]);
        $statment->bindValue(':pmuat', $insertval[5]);
        $statment->bindValue(':uat', $insertval[6]);
        $statment->bindValue(':prod', $insertval[7]);
        $statment->bindValue(':pm', $insertval[8]);
        $statment->bindValue(':dep', $insertval[9]);
        $statment->bindValue(':config', $config);
        $statment->bindValue(':uatmaom', $uatmaom);
        $statment->bindValue(':waiting', $waiting);
        $crcomments = $statment->execute();
        $statment->closeCursor();
    } else {
        $sql = "INSERT INTO OSSPRG.CRMAN_OSS_PENDINGCAT (
            CR_REF, BSS, OSS, CRM, MDM, PRE_UAT, PM_UAT,
            UAT, PRODUCTION, PM, DEPENDENCY, CONFIG, UATMAIN, WAITING ) 
         VALUES ( :crid, :bss , :oss, :crm,:mdm,:preuat, :pmuat , :uat ,:prod ,:pm,:dep,:config,:uatmaom,:waiting )";

        $statment = $conn->prepare($sql);
        $statment->bindValue(':crid', $crid);
        $statment->bindValue(':bss', $insertval[0]);
        $statment->bindValue(':oss', $insertval[1]);
        $statment->bindValue(':crm', $insertval[2]);
        $statment->bindValue(':mdm', $insertval[3]);
        $statment->bindValue(':preuat', $insertval[4]);
        $statment->bindValue(':pmuat', $insertval[5]);
        $statment->bindValue(':uat', $insertval[6]);
        $statment->bindValue(':prod', $insertval[7]);
        $statment->bindValue(':pm', $insertval[8]);
        $statment->bindValue(':dep', $insertval[9]);
        $statment->bindValue(':config', $config);
        $statment->bindValue(':uatmaom', $uatmaom);
        $statment->bindValue(':waiting', $waiting);
        $crcomments = $statment->execute();
        $statment->closeCursor();
    }

    return $crcomments;
}





function insert_pendingcatpri($crid,  $pri)
{
    global $conn;

   $sql = "SELECT * 
    FROM OSSPRG.CRMAN_OSS_PENDINGCAT where CR_REF = :crid";

    $statment = $conn->prepare($sql);
    $statment->bindValue(':crid', $crid);
    $statment->execute();
    $crcomments = $statment->fetchAll();
    $statment->closeCursor();

     if ($crcomments) {
        $sql = "UPDATE OSSPRG.CRMAN_OSS_PENDINGCAT
        SET    PRI = :pri
        where CR_REF = :crid";

        $statment = $conn->prepare($sql);
        $statment->bindValue(':crid', $crid);
        $statment->bindValue(':pri', $pri);
        $crcomments = $statment->execute();
        $statment->closeCursor();
    } else {
        $sql = "INSERT INTO OSSPRG.CRMAN_OSS_PENDINGCAT (
            CR_REF, BSS, OSS, CRM, MDM, PRE_UAT, PM_UAT,
            UAT, PRODUCTION, PM, DEPENDENCY, CONFIG, UATMAIN, WAITING , PRI  ) 
         VALUES ( :crid, 0 , 0, 0,0,0,0 , 0 ,0 ,0,0,0,0,0,:pri )";

        $statment = $conn->prepare($sql);
        $statment->bindValue(':crid', $crid);
        $statment->bindValue(':pri', $pri);
        $crcomments = $statment->execute();
        $statment->closeCursor();
    }

    return $crcomments;
}




function insert_pendingcattype($crid,  $ty)
{
    global $conn;

   $sql = "SELECT * 
    FROM OSSPRG.CRMAN_OSS_PENDINGCAT where CR_REF = :crid";

    $statment = $conn->prepare($sql);
    $statment->bindValue(':crid', $crid);
    $statment->execute();
    $crcomments = $statment->fetchAll();
    $statment->closeCursor();

     if ($crcomments) {
        $sql = "UPDATE OSSPRG.CRMAN_OSS_PENDINGCAT
        SET    CRTYPE = :ty
        where CR_REF = :crid";

        $statment = $conn->prepare($sql);
        $statment->bindValue(':crid', $crid);
        $statment->bindValue(':ty', $ty);
        $crcomments = $statment->execute();
        $statment->closeCursor();
    } else {
        $sql = "INSERT INTO OSSPRG.CRMAN_OSS_PENDINGCAT (
            CR_REF, BSS, OSS, CRM, MDM, PRE_UAT, PM_UAT,
            UAT, PRODUCTION, PM, DEPENDENCY, CONFIG, UATMAIN, WAITING , PRI ,CRTYPE  ) 
         VALUES ( :crid, 0 , 0, 0,0,0,0 , 0 ,0 ,0,0,0,0,0,0,:ty )";

        $statment = $conn->prepare($sql);
        $statment->bindValue(':crid', $crid);
        $statment->bindValue(':ty', $ty);
        $crcomments = $statment->execute();
        $statment->closeCursor();
    }

    return $crcomments;
}



function get_pendingcat_summary(){
    global $conn;
    $sql = "SELECT 
    CRTYPE , SUM(BSS) BSS, SUM(OSS) OSS, 
       SUM(CRM) CRM, SUM(MDM) MDM, SUM(PRE_UAT) PRE_UAT, 
       SUM(UAT) UAT,SUM(PRODUCTION) PRODUCTION, SUM(PM)PM, 
       SUM(DEPENDENCY) DEPENDENCY, SUM(CONFIG) CONFIG, SUM(UATMAIN) UATMAIN, 
       SUM(WAITING) WAITING, SUM(PM_UAT) PM_UAT FROM 
    (SELECT *  FROM (  SELECT B.CR_REF,  B.BSS, B.OSS, 
       B.CRM, B.MDM, B.PRE_UAT, 
       B.UAT, B.PRODUCTION, B.PM, 
       B.DEPENDENCY, B.CONFIG, B.UATMAIN, 
       B.WAITING, B.PM_UAT ,NVL(B.CRTYPE,'OTHER') CRTYPE FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
            WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 ) AND  UPPER(PRO_GROUP)  NOT LIKE '%SOFTWEAR%' 
            AND UPPER(PRO_GROUP)  NOT LIKE '%ENTERPRISE%'  
            AND UPPER(PRO_GROUP) NOT LIKE '%SME%' AND UPPER(PRO_GROUP) NOT LIKE '%CONSUMER%' 
            AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF)
            WHERE CRTYPE = 'OTHER'       
                    UNION       
    SELECT  B.CR_REF,  B.BSS, B.OSS, 
       B.CRM, B.MDM, B.PRE_UAT, 
       B.UAT, B.PRODUCTION, B.PM, 
       B.DEPENDENCY, B.CONFIG, B.UATMAIN, 
       B.WAITING, B.PM_UAT,NVL(B.CRTYPE,'OTHER') CRTYPE  FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
            WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )   
            AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF
            AND CRTYPE = 'OTHER'
            UNION
    SELECT *  FROM (  SELECT  B.CR_REF,  B.BSS, B.OSS, 
       B.CRM, B.MDM, B.PRE_UAT, 
       B.UAT, B.PRODUCTION, B.PM, 
       B.DEPENDENCY, B.CONFIG, B.UATMAIN, 
       B.WAITING, B.PM_UAT,NVL(B.CRTYPE,'SW') CRTYPE FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
            WHERE CR_STATUS IN (0,1,2,3,4,5,6,7,8,10,11,12,15 ) AND A.CR_REF  LIKE 'SW%' 
            AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF)
            WHERE CRTYPE = 'SW'       
                    UNION       
    SELECT  B.CR_REF,   B.BSS, B.OSS, 
       B.CRM, B.MDM, B.PRE_UAT, 
       B.UAT, B.PRODUCTION, B.PM, 
       B.DEPENDENCY, B.CONFIG, B.UATMAIN, 
       B.WAITING, B.PM_UAT,NVL(B.CRTYPE,'SW') CRTYPE  FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
            WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )   
            AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF
            AND CRTYPE = 'SW'
            UNION
    SELECT *  FROM (  SELECT B.CR_REF,  B.BSS, B.OSS, 
       B.CRM, B.MDM, B.PRE_UAT, 
       B.UAT, B.PRODUCTION, B.PM, 
       B.DEPENDENCY, B.CONFIG, B.UATMAIN, 
       B.WAITING, B.PM_UAT,NVL(B.CRTYPE,'CON') CRTYPE FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B  
            WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )  AND UPPER(PRO_GROUP)  LIKE '%CONSUMER%' 
            AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF(+))
            WHERE CRTYPE = 'CON'       
                    UNION       
    SELECT B.CR_REF,  B.BSS, B.OSS, 
       B.CRM, B.MDM, B.PRE_UAT, 
       B.UAT, B.PRODUCTION, B.PM, 
       B.DEPENDENCY, B.CONFIG, B.UATMAIN, 
       B.WAITING, B.PM_UAT,NVL(B.CRTYPE,'CON') CRTYPE  FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
            WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )   
            AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF
            AND CRTYPE = 'CON'
            UNION
    SELECT *  FROM (        
                SELECT B.CR_REF,  B.BSS, B.OSS, 
       B.CRM, B.MDM, B.PRE_UAT, 
       B.UAT, B.PRODUCTION, B.PM, 
       B.DEPENDENCY, B.CONFIG, B.UATMAIN, 
       B.WAITING, B.PM_UAT,NVL(B.CRTYPE,'SME') CRTYPE FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
                         WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )   AND UPPER(PRO_GROUP)  LIKE '%SME%' 
                         AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF(+))
                        WHERE CRTYPE = 'SME'       
                                UNION       
                SELECT B.CR_REF,  B.BSS, B.OSS, 
       B.CRM, B.MDM, B.PRE_UAT, 
       B.UAT, B.PRODUCTION, B.PM, 
       B.DEPENDENCY, B.CONFIG, B.UATMAIN, 
       B.WAITING, B.PM_UAT,NVL(B.CRTYPE,'SME') CRTYPE  FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
                        WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )   
                        AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF
                        AND CRTYPE = 'SME'
                        UNION
    SELECT *  FROM (
                SELECT B.CR_REF,  B.BSS, B.OSS, 
       B.CRM, B.MDM, B.PRE_UAT, 
       B.UAT, B.PRODUCTION, B.PM, 
       B.DEPENDENCY, B.CONFIG, B.UATMAIN, 
       B.WAITING, B.PM_UAT,NVL(B.CRTYPE,'ENT') CRTYPE  FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
                        WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )   AND UPPER(PRO_GROUP)  LIKE '%ENTERPRISE%' 
                        AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF(+) )
                        WHERE CRTYPE = 'ENT'       
                                UNION       
                SELECT B.CR_REF,  B.BSS, B.OSS, 
       B.CRM, B.MDM, B.PRE_UAT, 
       B.UAT, B.PRODUCTION, B.PM, 
       B.DEPENDENCY, B.CONFIG, B.UATMAIN, 
       B.WAITING, B.PM_UAT,NVL(B.CRTYPE,'ENT') CRTYPE  FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
                        WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )   
                        AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF
                        AND CRTYPE = 'ENT')
                        GROUP BY CRTYPE";    
    $statment = $conn->prepare($sql);
    $statment->execute();
    $crcomments = $statment->fetchAll();
    $statment->closeCursor();
    return $crcomments;

}