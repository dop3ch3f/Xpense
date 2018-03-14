<?php
include "../actions/conn.php";
session_start();
 print_r($_SERVER);
 if($_SERVER["REQUEST_METHOD"]=="POST"){  
     extract($_POST);
    $query= "INSERT INTO `Admin`(`full_name`,`team_name`, `email`, `password`) VALUES ('$full_name','$team_name','$email','$password')";
    if(mysqli_query($link,$query)){
        $q1="SELECT * FROM `Admin` WHERE `email`='$email' AND `password`='$password' LIMIT 1";
        if($row->mysqli_fetch_assoc($link,$q1)){
           mailUser($row['admin_id'],$row['full_name'],$row['team_name'],$r1,$r2,$r3);
        }else{
            echo 'Wahala Dey';
        }
    }
 }
 
 function mailUser($id,$a,$t,$r1,$r2,$r3) {
     $endpoint = "http://localhost/Xpense/php/actions/register?admin="+$id;
     $subject = "Registration For XpenseHUB";
     $message = "Please join your registered team: "+$t+" created by "+$a+"  on XpenseHub using this link"+$endpoint;
     $receivers = array("$r1","$r2","$r3");
     foreach ($receivers as $recepient) {
        if(mail($recepient,$subject,$message)){
         echo "Mail Delivered Successfully to "+$recepient;
        }else{
         echo "Error Sending to "+$recepient;
        }
    }
 }

?>