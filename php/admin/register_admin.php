<?php
require "../actions/conn.php";
//ob_start() ensures the allowance of headers
ob_start(); 
session_start();
function mailUser($id, $a, $t, $r1, $r2, $r3)
{
    $receivers = array("$r1", "$r2", "$r3");
    foreach ($receivers as $recepient) {
        if ($recepient != "") {
            $to = $recepient;
            $endpoint = "http://xpensehub.000webhostapp.com/php/actions/register_user.php?admin=".$id;
            $subject = "Registration For XpenseHUB";
            $message = "
             <html>
               <head>
                 <title>XpenseHUB Registration</title>
               </head>
             <body>
               <h2>Please Join Your Registered Team ".$t." created by ".$a." with XpenseHUB</h2><a href='".$endpoint."'><h3>Click here to Register</h3></a>
             </body>
             </html>
             ";
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';
            $headers[] = "To: '$to'  ";
            $headers[] = 'From: XpenseHUB';
            mail($to, $subject, $message,implode("\r\n", $headers));
            header("Location: http://xpensehub.000webhostapp.com/php/admin/main.php");
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_POST);
    extract($_POST);
    
    #generate date
    $date = date("d:m:y");
    #generate team id
    $min = 0;
    $max = 100;
    $team_id = mt_rand($min,$max).$team.mt_rand($min,$max);
    #queries
    $qq = "INSERT INTO `Teams`( `team_id`,`team_name`, `date_created`) VALUES ('$team_id','$team','$date')";
    
    $q3 = "INSERT INTO `Admin`(`team_id`, `full_name`, `email`, `password`, `date_created`) VALUES ('$team_id','$full_name','$email','$password','$date')";
    if(mysqli_query($link,$qq)){
        if (mysqli_query($link,$q3)) {
            $q1 = "SELECT * FROM `Admin` WHERE `team_id`='$team_id'";
            $q2 = "SELECT * FROM `Teams` WHERE `team_id`='$team_id'";
            if ($result1 = mysqli_query($link, $q1) && $result2 = mysqli_query($link, $q2)) {
                $row = mysqli_fetch_assoc($result1);
                    $row1 = mysqli_fetch_assoc($result2); 
                    $row['admin_id'] = $admin_id;
                    $_SESSION['admin_id'] = $row['admin_id'];
                    $_SESSION['team_id'] = $row1['team_id'];
                    print_r($_SESSION);
                    mailUser($admin_id,$full_name, $team_name, $r1, $r2, $r3);           
            }else{
                echo "something is wrong can't upload";
            }
    
        }else{
            echo mysqli_error($link);
        }
    }else{
        echo "wahala dey";
    }
    
}


mysqli_close($link);

?>