<?php
include "../actions/conn.php";
ob_start();
session_start();
/*function mailUser($id, $a, $t, $r1, $r2, $r3)
{
    $endpoint = "http://xpensehub.000webhostapp.com/php/actions/register_user.php?admin="+$id;
    $subject = "Registration For XpenseHUB";
    $message = "Please join your registered team: "+$t+" created by "+$a+"  on XpenseHub<a href='"+$endpoint+"'>Click here to register</a>";
    $receivers = array("$r1", "$r2", "$r3");
    foreach ($receivers as $recepient) {
        echo $recepient;
        if ($recepient != "") {
            echo "not empty";
            $to = $recepient;
            mail($to, $subject, $message);
            if (mail($to, $subject, $message)) {
                echo "Mail Delivered Successfully to "+$recepient;
            } else {
                echo "Error Sending to "+$recepient;
            }
        }
    }
}*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    print_r($_POST);
    #generate date
    $date = date("Y:m:d");
    #generate team id
    $team_id = "".mt_rand(0,100).$team.mt_rand(0,100);
    #queries
    $qq = "INSERT INTO `Teams`( `team_id`,`team_name`, `date_created`) VALUES ('$team_id','$team','$date')";
    $query = "INSERT INTO `Admin`(`team_id`, `full_name`, `email`, `password`, `date_created`) VALUES ('$team_id','$full_name','$email','$password','$date')";
    #logging process
    if(mysqli_query($link, $qq)){
        if (mysqli_query($link, $query) ) {
            $q1 = "SELECT * FROM `Admin` WHERE `team_id`='$team_id'";
            $q2 = "SELECT * FROM `Teams` WHERE `team_id`='$team_id'";
            if (mysqli_query($link,$q1) && mysqli_query($link,$q2)) {
                $result2=mysqli_query($link,$q2);
                $result1=mysqli_query($link,$q1);
                echo "Admin registered successfully";
                $row = mysqli_fetch_assoc($result1); 
                $row1 = mysqli_fetch_assoc($result2);
                #mailUser($row['admin_id'], $row['full_name'], $row1['team_name'], $r1, $r2, $r3);
                $_SESSION['admin_id'] = $row['admin_id'];
                $_SESSION['team_id'] = $row1['team_id'];
                header("Location: ../admin/main.php");
            }
    
        }
    }
    
}


mysqli_close($link);
?>
