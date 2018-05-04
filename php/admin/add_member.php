<?php
	include "../actions/conn.php";
	ob_start();
	session_start();
	function mailUser($tid, $tn, $members = array())
	{
		$GLOBALS['tn'] = $tn;
		$GLOBALS['tid'] = $tid;
		function nextstep($receipient){
			$endpoint = "http://xpensehub.000webhostapp.com/php/actions/register_user.php?team=".$GLOBALS['tid'];
			$subject = "Registration For Xpense Hub";
			$message = "
             <html>
               <head>
                 <title>Xpense Hub Registration</title>
               </head>
             <body>
               <h2>Please Join Your Registered Team ".$GLOBALS['tn']." with Xpense Hub</h2><a href='".$endpoint."'><h3>Click here to Register</h3></a>
             </body>
             </html>
             ";
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html; charset=iso-8859-1';
			$headers[] = "To: ".$receipient;
			$headers[] = 'From: Xpense Hub';
			mail($receipient, $subject, $message,implode("\r\n", $headers));
		}
		if(array_map("nextstep",$members)){
			return true;
		}else{
			echo "Something is wrong on our end. Pls try again later";
		}
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		extract($_POST);
		if (mailUser($team_id, $team_name, $mail)) {
			header("refresh:2;url=./manage_teams.php");
				echo "Team Registered Successfully";
		}else{
		echo "Somethings Wrong Somewhere. Redirecting...";
		header("refresh:2;url=./manage_teams.php");
		}
	}
	mysqli_close($link);
?>