<?php
require '../actions/conn.php';
 if($_SERVER["REQUEST_METHOD"]=="POST"){
     extract($_POST);
     $query1="DELETE FROM `Users` WHERE `user_id`='$user_id'";
     if(mysqli_query($link,$query)){
       header('./manage_teams.php');
     }else{
         echo 'Something went wrong';
     }
 }
 mysqli_close($link);
?>