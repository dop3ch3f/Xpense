<?php
 require '../actions/conn.php';
 require '../actions/server.php';
 ob_start();
 session_start();
 $date = date("Y:m:d");
 if($_SERVER["REQUEST_METHOD"] == "POST"){
     extract($_POST);
     if(isset($accept)){
       $query = "UPDATE `Expense` SET `status`='Approved',`date_approved`='$date' WHERE `expense_id`='$accept'";
       if(mysqli_query($link,$query)){
           echo "Approved Successfully, Redirecting...";
	       header("refresh:2;url=./expenses.php");
       }else{
           echo 'Somethings Wrong';
       }
     }
     if(isset($reject)){
        $query = "UPDATE `Expense` SET `status`='Rejected',`date_approved`='$date' WHERE `expense_id`='$reject'";
        if(mysqli_query($link,$query)){
        	    echo "Declined Successfully, Redirecting..";
	        header("refresh:2;url=./expenses.php");
        }else{
            echo 'There was an Error';
        }
     }
 }
 mysqli_close($link);
?>