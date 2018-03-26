<?php
include "../actions/conn.php";
ob_start();
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    #generate date
	$date = date("Y:m:d");
    #generate team id
    $team_id = "" .mt_rand().$team_name.mt_rand();
    #queries
    $qq = "INSERT INTO `Teams`( `team_id`,`team_name`, `date_created`) VALUES ('$team_id','$team_name','$date')";
    #logging process
    if (mysqli_query($link, $qq)) {
        $q1 = "SELECT * FROM `admin_team` WHERE `admin_id`='$admin_id'";
        if ($result1 = mysqli_query($link, $q1)) {
            echo "Admin registered successfully";
            while ($row = mysqli_fetch_assoc($result1)) {
                $q2 = "INSERT INTO `Admin`(`team_id`, `full_name`, `email`, `password`, `date_created`) VALUES ('$team_id','".$row['full_name']."','".$row['email']."','".$row['password']."','$date')";
                if(mysqli_query($link,$q2)){
                    mailUser($admin_id, $row['full_name'], $team_name, $f_email, $s_email, $t_email);
                    $_SESSION['admin_id'] = $admin_id;
                    $_SESSION['team_id'] = $team_id;
                    header("../admin/main.php");
                }  
            }
            
        }

    }
}

function mailUser($id, $a, $t, $r1, $r2, $r3)
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
}
mysqli_close($link);
?>