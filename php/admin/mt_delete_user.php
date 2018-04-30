<?php
require '../actions/conn.php';
ob_start();
 if($_SERVER["REQUEST_METHOD"] == "POST"){
     extract($_POST);
     print_r($_POST);
     $query1 = "DELETE FROM `Expense` WHERE `user_id`='$user_id';";
     $query1 .= "DELETE FROM `Receipts` WHERE `user_id`='$user_id';";
	 $query1 .= "DELETE FROM `Users` WHERE `user_id`='$user_id';";
     if(mysqli_multi_query($link,$query1)){
     	echo  "User Deleted Successfully";
	     header("refresh:2;url=./manage_teams.php");
     }else{
         echo 'Something went wrong';
	     
     }
 }
 mysqli_close($link);
?>