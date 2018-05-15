<?php
require '../actions/conn.php';
ob_start();
 if($_SERVER["REQUEST_METHOD"] == "POST"){
     extract($_POST);
     if($delete != ""){
	     $query1 = "DELETE FROM `Expense` WHERE `user_id`='$user_id';";
	     $query1 .= "DELETE FROM `Receipts` WHERE `user_id`='$user_id';";
	     $query1 .= "DELETE FROM `Users` WHERE `user_id`='$user_id';";
	     if(mysqli_multi_query($link,$query1)){
		     echo  "User Deleted Successfully. Redirecting....";
		     header("refresh:2;url=./manage_teams.php");
	     }else{
		     echo 'Something went wrong. Redirecting....';
		     header("refresh:2;url=./manage_teams.php");
	     }
     }else{
	     echo 'Something went wrong. Redirecting....';
	     header("refresh:2;url=./manage_teams.php");
     }
     if($uupdate != ""){
	     $query1 = "Update `Users` SET `type`='admin' WHERE `user_id`='$user_id';";
	     if(mysqli_query($link,$query1)){
		     echo  "User Deleted Successfully. Redirecting....";
		     header("refresh:2;url=./manage_teams.php");
	     }else{
		     echo 'Something went wrong. Redirecting....';
		     header("refresh:2;url=./manage_teams.php");
	     }
     }else{
	     echo 'Something went wrong. Redirecting....';
	     header("refresh:2;url=./manage_teams.php");
     }
     if($aupdate != "") {
	     $query1 = "Update `Users` SET `type`='admin' WHERE `user_id`='$user_id';";
	     if(mysqli_query($link,$query1)){
		     echo  "User Deleted Successfully. Redirecting....";
		     header("refresh:2;url=./manage_teams.php");
	     }else{
		     echo 'Something went wrong. Redirecting....';
		     header("refresh:2;url=./manage_teams.php");
	     }
     }else{
	     echo 'Something went wrong. Redirecting....';
	     header("refresh:2;url=./manage_teams.php");
     }
 }
 mysqli_close($link);
?>