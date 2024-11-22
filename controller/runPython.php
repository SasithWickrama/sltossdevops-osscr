<?php

	$crno= $_POST['id'];
    $tag =  $_POST['tag'];
	$stat= $_POST['task'] ;  //'APCSYNC' , 'PREUATSUCC',  'UATSUCC','UATFAIL': 

 
        $result=exec("python D:\\projects\\crms_mdm\\main.py ".$crno." \"".$stat."\" ".$tag );
    

       
        
   
    echo $result;
	

	
?>