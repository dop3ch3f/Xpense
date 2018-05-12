<?php
    ob_start();
    require "./conn.php";
    require './server.php';
    session_start();
    if(!$_SESSION["email"] AND !$_SESSION["password"]){
	    header("Location:./register.php");
    }
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
		extract($_SESSION);
		#generate date
		$date = date("Y:m:d");
		#generate team and admin id
		$admin_id = mt_rand(0,1000).$full_name.mt_rand(0,1000);
		$team_id = mt_rand(0,1000).$team_name.mt_rand(0,1000);
		#queries
		$qq = "INSERT INTO `Teams`(`team_id`,`admin_id`,`team_name`, `date_created`) VALUES ('$team_id','$admin_id','$team_name','$date')";
		
		$q3 = "INSERT INTO `Admin`(`admin_id`, `full_name`, `email`, `password`, `date_created`) VALUES ('$admin_id','$full_name','$email','$password','$date')";
		if(mailUser($team_id, $team_name, $mail)){
            if(mysqli_query($link,$q3)){
				if (mysqli_query($link,$qq)) {
						$_SESSION['admin_id'] = $admin_id;
						$_SESSION['team_id'] = $team_id;
						header("Location:../admin/main.php");
					}else{
						echo "Something Went Wrong, Try Again Later";
					}
					
				}else{
					echo "Something Went Wrong";
				}
		}
	}
	mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Xpense Hub</title>
	<link href='../../css/styles.css' rel="stylesheet" />
	<link href="../../css/bulma.css" rel="stylesheet" />
    <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
    <script src='../../js/jquery-3.3.1.min.js'></script>
	<script>
        var i = 1;
        function addInput() {
            if(i<3){
                i += 1;
                var newInput = '<div class="field"><div class="control"><input class="input is-small is-rounded" id="r'+i+'" name="mail[]" type="email" placeholder="any@any.com" /></div></div>';
                $('#first_input').after(newInput);
            }else{
                $('#adder').hide();
            }
        }
	</script>
	<style>
		body {
			background: linear-gradient(to right,#c33764,#1d2671);
			color: whitesmoke !important;
		}
	</style>
</head>
<body>
<section class="hero is-fullheight">
	<div class="container has-text-centered" style="padding-top:20px">
		<h1 class="is-size-3">Xpense Hub</h1>
	</div>
		<div class="hero-body">
			<div class="container has-text-centered">
				<h3>Team Setup</h3>
                <h3><small>Invites would be sent to Email Addresses.</small></h3>
                <br/>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<div class="field has-text-left">
                    <h1 class="is-size-7">Team Name:</h1>
					<div class="control">
						<input class="input is-small is-rounded" type="text" name="team_name" placeholder="Doe Plc">
					</div>
                </div>
                <div class="field has-text-left is-grouped" id="first_input">
                    <div class="control is-expanded">
                        <input class="input is-small is-rounded" id="r1" name="mail[]" type="email" placeholder="Enter Email">
                    </div>
                    <p class="control" id="adder">
                        <a class="button is-small is-rounded" onclick="addInput()">
                          <span class="icon">
                            <i class="fas fa-plus"></i>
                          </span>
                        </a>
                    </p>
                </div>
                    <a class="button is-small is-rounded" href="./register.php">
                      <span class="icon">
                        <i class="fas fa-angle-left"></i>
                      </span>
                    </a>
                    <button type="submit" class="button is-small is-rounded">
                      <span class="icon">
                        <i class="fas fa-angle-right"></i>
                      </span>
					</button>
                </form>
				</div>
			</div>
</section>
</body>

</html>