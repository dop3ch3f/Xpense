<?php
 require '../actions/conn.php';

 if($_SERVER["REQUEST_METHOD"] == "POST"){
     extract($_SESSION);
     if(isset($accept)){
       $query = "UPDATE `Expense` SET `status`='Approved' WHERE `employee_id`='$accept'";
       if(mysqli_query($link,$query)){
          header("./expenses.php");
       }else{
           echo 'Somethings Wrong';
       }
     }
     if(isset($reject)){
        $query = "UPDATE `Expense` SET `status`='Rejected' WHERE `employee_id`='$reject'";
        if(mysqli_query($link,$query)){
            header("./expenses.php");
        }else{
            echo 'There was an Error';
        }
     }
 }
 mysqli_close($link);
?>