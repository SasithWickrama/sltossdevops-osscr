<?php

function get_allcr()
{
    global $conn;
    $sql = "select A.* , B.PRI ,B.CRTYPE from CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
         where CR_STATUS in (2,3,4,5,6,7,8,10,11,12,15,35 )  
        and A.CR_REF not in (select x.CR_REF from CRMAN_OSS_EXCEPTIONS x) AND A.CR_REF = B.CR_REF(+)";
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
        15 - 
        35 - 
        
        */
}

function get_escr()
{
    global $conn;
    $sql = /*"select A.*   from CRMANAGE_NEW A 
        where CR_STATUS in (2,3,4,5,6,7,8,10,11,12,15 )   and upper(PRO_GROUP)  like '%ENTERPRISE%' 
        and A.CR_REF not in (select x.CR_REF from CRMAN_OSS_EXCEPTIONS x) ";*/

        "SELECT *  FROM (
            SELECT A.* , B.PRI,NVL(B.CRTYPE,'ENT') CRTYPE  FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
                    WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )   AND UPPER(PRO_GROUP)  LIKE '%ENTERPRISE%' 
                    AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF(+) )
                    WHERE CRTYPE = 'ENT'       
                            UNION       
            SELECT A.* , B.PRI,NVL(B.CRTYPE,'ENT') CRTYPE  FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
                    WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )   
                    AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF
                    AND CRTYPE = 'ENT'";
    $statment = $conn->prepare($sql);
    $statment->execute();
    $cctdetails = $statment->fetchAll();
    $statment->closeCursor();
    return $cctdetails;
}

function get_smecr()
{
    global $conn;
    $sql = "SELECT *  FROM (        
            SELECT A.* , B.PRI ,NVL(B.CRTYPE,'SME') CRTYPE FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
                     WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )   AND UPPER(PRO_GROUP)  LIKE '%SME%' 
                     AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF(+))
                    WHERE CRTYPE = 'SME'       
                            UNION       
            SELECT A.* , B.PRI,NVL(B.CRTYPE,'SME') CRTYPE  FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
                    WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )   
                    AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF
                    AND CRTYPE = 'SME'";
    $statment = $conn->prepare($sql);
    $statment->execute();
    $cctdetails = $statment->fetchAll();
    $statment->closeCursor();
    return $cctdetails;
}

function get_concr()
{
    global $conn;
    $sql = "SELECT *  FROM (  SELECT A.* , B.PRI ,NVL(B.CRTYPE,'CON') CRTYPE FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B  
        WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )  AND UPPER(PRO_GROUP)  LIKE '%CONSUMER%' 
        AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF(+))
        WHERE CRTYPE = 'CON'       
                UNION       
SELECT A.* , B.PRI,NVL(B.CRTYPE,'CON') CRTYPE  FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
        WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )   
        AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF
        AND CRTYPE = 'CON'";
    $statment = $conn->prepare($sql);
    $statment->execute();
    $cctdetails = $statment->fetchAll();
    $statment->closeCursor();
    return $cctdetails;
}

function get_swcr()
{
    global $conn;
    $sql = "SELECT *  FROM (  SELECT A.* , B.PRI ,NVL(B.CRTYPE,'SW') CRTYPE FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
        WHERE CR_STATUS IN (0,1,2,3,4,5,6,7,8,10,11,12,15 ) AND A.CR_REF  LIKE 'SW%' 
        AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF(+))
        WHERE CRTYPE = 'SW'       
                UNION       
SELECT A.* , B.PRI,NVL(B.CRTYPE,'SW') CRTYPE  FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
        WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )   
        AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF
        AND CRTYPE = 'SW'";
    $statment = $conn->prepare($sql);
    $statment->execute();
    $cctdetails = $statment->fetchAll();
    $statment->closeCursor();
    return $cctdetails;
}


function get_swcr1()
{
    global $conn;
    $sql = "SELECT *  FROM (  SELECT A.* , B.PRI ,NVL(B.CRTYPE,'SW') CRTYPE FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
        WHERE CR_STATUS IN (0,1,2,3,4,5,6,7,8,10,11,12,15 ) AND A.CR_REF  LIKE 'SW%' 
        AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF(+))
        WHERE CRTYPE = 'SW'       
                UNION       
SELECT A.* , B.PRI,NVL(B.CRTYPE,'SW') CRTYPE  FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
        WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )   
        AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF
        AND CRTYPE = 'SW'
        UNION
SELECT CR_ID , CR_ID ,NULL,NULL,NULL,NULL,TOPIC ,NULL,NULL,NULL,NULL,NULL,NULL,REMARKS,NULL, START_DATE , NULL , NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,B.PRI,NVL(B.CRTYPE,'SW') CRTYPE 
FROM CRMAN_OSS_SWCR A, CRMAN_OSS_PENDINGCAT B 
WHERE A.STATUS = 1  AND A.CR_ID = B.CR_REF(+)";
    $statment = $conn->prepare($sql);
    $statment->execute();
    $cctdetails = $statment->fetchAll();
    $statment->closeCursor();
    return $cctdetails;
}


function get_configcr()
{
    global $conn;
    $sql = "SELECT *  FROM (  SELECT A.* , B.PRI ,NVL(B.CRTYPE,'CONFIG') CRTYPE FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B  
    WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )  AND UPPER(CR_TYPE)  LIKE '%CONFIGURATIONS%' 
    AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF(+))
    WHERE CRTYPE = 'CONFIG'       
            UNION       
SELECT A.* , B.PRI,NVL(B.CRTYPE,'CON') CRTYPE  FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
    WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )   
    AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF
    AND CRTYPE = 'CONFIG'";
    $statment = $conn->prepare($sql);
    $statment->execute();
    $cctdetails = $statment->fetchAll();
    $statment->closeCursor();
    return $cctdetails;
}



function get_bprcr()
{
    global $conn;
    $sql = "SELECT 
                A.CR_REF, A.BPR_REF, A.PRO_GROUP, 
            A.PRO_OWNER, A.PRO_EMAIL, A.BPR, 
            A.CR_TOPIC, A.CR_DESC, A.CR_TYPE, 
            A.DATE_RAISE, A.DATE_REQUIRED, A.DATE_ITSI_RECEIVE, 
            A.CR_STATUS, A.REMARKS, A.EN_USER, 
            TO_CHAR(A.EN_DATE, 'mm/dd/yyyy hh:mi:ss AM'), A.FILE_NAME, A.TARRIF, 
            A.CATALOG_ID, A.DEPENDENCY, A.UAT_STAT, 
            A.PROD_STAT, A.DEPENDENCY_ST, A.TEST_BILL, 
            A.CONFIG_STAT, A.UAT_COM_DATE, A.PROD_COM_DATE, 
            A.ST_DATE, A.MINT_CONF from CRMANAGE_NEW a,CRMANAGE_SYSTEM b
            where A.CR_REF = B.CR_REF
            and B.CR_SYSTEM = 'OSS'
            and CR_STATUS IN ('2' ,'3','8')
            and a.PRO_GROUP = 'BPR'";
    $statment = $conn->prepare($sql);
    $statment->execute();
    $cctdetails = $statment->fetchAll();
    $statment->closeCursor();
    return $cctdetails;
}


function get_financecr()
{
    global $conn;
    $sql = "SELECT 
    CR_REF, BPR_REF, PRO_GROUP, 
PRO_OWNER, PRO_EMAIL, BPR, 
CR_TOPIC, CR_DESC, CR_TYPE, 
DATE_RAISE, DATE_REQUIRED, DATE_ITSI_RECEIVE, 
CR_STATUS, REMARKS, EN_USER, 
TO_CHAR(EN_DATE, 'mm/dd/yyyy hh:mi:ss AM'), FILE_NAME, TARRIF, 
CATALOG_ID, DEPENDENCY, UAT_STAT, 
PROD_STAT, DEPENDENCY_ST, TEST_BILL, 
CONFIG_STAT, UAT_COM_DATE, PROD_COM_DATE, 
ST_DATE, MINT_CONF from CRMANAGE_NEW where CR_STATUS IN ( '2','3','6','8','12','20') and PRO_GROUP IN ('FINANCE')";
    $statment = $conn->prepare($sql);
    $statment->execute();
    $cctdetails = $statment->fetchAll();
    $statment->closeCursor();
    return $cctdetails;
}

function get_othercr()
{
    global $conn;
    $sql = /*"SELECT *  FROM (  select A.* , B.PRI ,NVL(B.CRTYPE,'OTHER') CRTYPE from CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
        where CR_STATUS in (2,3,4,5,6,7,8,10,11,12,15 ) and  upper(PRO_GROUP)  not like '%SOFTWEAR%' 
        and upper(PRO_GROUP)  not like '%ENTERPRISE%'  
        and upper(PRO_GROUP) not like '%SME%' and upper(PRO_GROUP) not like '%CONSUMER%' 
        and A.CR_REF not in (select x.CR_REF from CRMAN_OSS_EXCEPTIONS x) AND A.CR_REF = B.CR_REF(+)";*/
        "SELECT *  FROM (  SELECT A.* , B.PRI ,NVL(B.CRTYPE,'OTHER') CRTYPE FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
        WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 ) AND  UPPER(PRO_GROUP)  NOT LIKE '%SOFTWEAR%' 
        AND UPPER(PRO_GROUP)  NOT LIKE '%ENTERPRISE%'  AND UPPER(CR_TYPE) NOT LIKE '%CONFIGURATIONS%' 
        AND UPPER(PRO_GROUP) NOT LIKE '%SME%' AND UPPER(PRO_GROUP) NOT LIKE '%CONSUMER%' 
        AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF(+))
        WHERE CRTYPE = 'OTHER'       
                UNION       
SELECT A.* , B.PRI,NVL(B.CRTYPE,'OTHER') CRTYPE  FROM CRMANAGE_NEW A , CRMAN_OSS_PENDINGCAT B 
        WHERE CR_STATUS IN (2,3,4,5,6,7,8,10,11,12,15 )   
        AND A.CR_REF NOT IN (SELECT X.CR_REF FROM CRMAN_OSS_EXCEPTIONS X) AND A.CR_REF = B.CR_REF
        AND CRTYPE = 'OTHER'";
    $statment = $conn->prepare($sql);
    $statment->execute();
    $cctdetails = $statment->fetchAll();
    $statment->closeCursor();
    return $cctdetails;
}


function get_cr($cr)
{
    global $conn;
    $sql = "select * from CRMANAGE_NEW where CR_REF =:cr
    union
    SELECT CR_ID , CR_ID ,NULL,NULL,NULL,NULL,TOPIC ,NULL,NULL,NULL,NULL,START_DATE,NULL,REMARKS,NULL, START_DATE , NULL , NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL 
FROM CRMAN_OSS_SWCR A where CR_ID= :cr ";
    $statment = $conn->prepare($sql);
    $statment->bindValue(':cr', $cr);
    $statment->execute();
    $cctdetails = $statment->fetchAll();
    $statment->closeCursor();
    return $cctdetails;
}


//3773