<?php
include "../actions/conn.php";
ob_start();
session_start();
	function mailUser($id, $t, $m = array())
	{
				$to = implode(",", $m);
				$endpoint = "http://xpensehub.000webhostapp.com/php/actions/register_user.php?admin=".$id;
				$subject = "Registration For Xpense Hub";
				$message = "
             <html>
               <head>
                 <title>Xpense Hub Registration</title>
               </head>
             <body>
               <h2>Please Join Your Registered Team ".$t." with Xpense Hub</h2><a href='".$endpoint."'><h3>Click here to Register</h3></a>
             </body>
             </html>
             ";
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html; charset=iso-8859-1';
				$headers[] = "To: '$to'  ";
				$headers[] = 'From: Xpense Hub';
				mail($to, $subject, $message,implode("\r\n", $headers));
				header("Location: http://xpensehub.000webhostapp.com/php/admin/main.php");
	}
	
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    #generate date
	$date = date("Y:m:d");
    #generate team id
	$team_id = mt_rand(0,1000).$team.mt_rand(0,1000);
    #queries
    $qq = "INSERT INTO `Teams`( `team_id`,`admin_id`,`team_name`, `date_created`) VALUES ('$team_id','$admin_id','$team_name','$date')";
   
    if (mysqli_query($link, $qq)) {
    	mailUser($admin_id, $team_name, $mail);
        echo "Team Registered Successfully";
    }
}
mysqli_close($link);
?>