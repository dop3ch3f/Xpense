<?php
 require '../actions/conn.php';
 session_start();
 if($_SERVER["REQUEST_METHOD"] == "POST"){
     extract($_POST);
     if(isset($accept)){
       $query = "UPDATE `Expense` SET `status`='Approved' WHERE `expense_id`='$accept'";
       if(mysqli_query($link,$query)){
           echo "Approved Successfully, Redirecting...";
	       header("refresh:2;url=http://localhost/Xpense/php/admin/expenses.php");
       }else{
           echo 'Somethings Wrong';
       }
     }
     if(isset($reject)){
        $query = "UPDATE `Expense` SET `status`='Rejected' WHERE `expense_id`='$reject'";
        if(mysqli_query($link,$query)){
        	    echo "Declined Successfully, Redirecting..";
	        header("refresh:2;url=http://localhost/Xpense/php/admin/expenses.php");
        }else{
            echo 'There was an Error';
        }
     }
 }
 mysqli_close($link);
?>