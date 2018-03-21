<?php
require '../actions/conn.php';
 if($_SERVER["REQUEST_METHOD"]=="POST"){
     extract($_POST);
     $query1="UPDATE `Teams` SET `team_name`='$t_name' WHERE `team_id`='$t_id'";
     if(mysqli_query($link,$query)){
       header('./manage_teams.php');
     }else{
         echo 'Something went wrong';
     }
 }
 mysqli_close($link);
?>