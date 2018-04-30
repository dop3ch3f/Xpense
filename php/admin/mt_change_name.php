<?php
require '../actions/conn.php';
ob_start();
 if($_SERVER["REQUEST_METHOD"]=="POST"){
     extract($_POST);
     $query1 = "UPDATE `Teams` SET `team_name`='$t_name' WHERE `team_id`='$t_id'";
     if(mysqli_query($link,$query1)){
       echo "Changes Effected. Redirecting...";
	     header("refresh:2;url=./manage_teams.php");
     }else{
         echo 'Something went wrong, Try Again';
	     header("refresh:2;url=./manage_teams.php");
     }
 }
 mysqli_close($link);
?>