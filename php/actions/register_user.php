<?php
require './conn.php';
session_start();
ob_start();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    extract($_GET);
    $query = "SELECT * FROM `Admin` WHERE `admin_id`='$admin'";
    if ($result = mysqli_query($link, $query)) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $admin_id = $row["admin_id"];
            $query1 = "SELECT * FROM `Teams` WHERE `team_id`='".$row["team_id"]."'";
            if($r = mysqli_query($link,$query1)){
                $row1 = mysqli_fetch_assoc($r);
                $team_name = $row1['team_name'];
            }
        }
    }else {
        echo mysqli_error($link);
    }
}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		extract($_POST);
		if($email == ""){
			$issue.= "Input an Email Address.<br/>";
		}
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$issue.= "Input a valid Email Address.<br/>";
		}
		if($full_name == ""){
			$issue.= "Input your Name.<br/>";
		}
		if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/',$password)) {
			$issue.= "Password must contain 6 characters of uppercase and lowercase letters, numbers and at least one special character.<br/>";
		}
		if($password != $cpassword){
			$issue.= "Password and Confirm password do not match.<br/>";
		}
		
		if($issue){
			$output = ' <div class="notification is-danger">There are issues with your form:<br/> ' .$issue. ' </div>';
		}else{
			$user_id = mt_rand(0,1000).$full_name.mt_rand(0,1000);
			$q = "INSERT INTO `Users`(`user_id`,`team_id`, `full_name`, `email`, `password`) VALUES ('$user_id','$team_id','$full_name','$email','$password')";
			if (mysqli_query($link, $q)) {
				$q1 = "SELECT * FROM `Users` WHERE `email`='$email' AND `password`='$password' LIMIT 1";
				if ($r = mysqli_query($link, $q1)) {
					$row1 = mysqli_fetch_assoc($r);
					$_SESSION['user_id'] = $row1["user_id"];
					$_SESSION['team_id'] = $row1["team_id"];
					echo "Registered Succesfully. Redirecting to your Page";
					header("refresh:2;url=http://xpensehub.000webhostapp.com/php/user/main.php");
					
				} else {
					$output =  "Error....";
				}
				
			} else {
				 $output =  'Error. Try Again';
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
        <title>Xpense Hub Register</title>
        <link href='../../css/bulma.css' rel="stylesheet" />
        <link href='../../css/styles.css' rel="stylesheet" />
        <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
        <script src='../../js/jquery-3.3.1.min.js'></script>
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
                <h1 class="is-size-4">Xpense Hub</h1>
            </div>
            <div class="hero-body">
                <div class="container has-text-centered">
                    <?php echo $output; ?>
                <h3>You are welcome to join the <?php echo $row1["team_name"]; ?> team created by <?php echo $row["full_name"]; ?>, to register fill the form below.</h3>
                <br/>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                            <div class="field has-text-left">
                                <h1 class="is-size-7">Full Name:</h1>
                                <div class="control">
                                    <input class="input is-rounded is-small" type="text" placeholder="John Doe" name="full_name">
                                </div>
                            </div>
                            <div class="field has-text-left">
                                <h1 class="is-size-7">Email:</h1>
                                <div class="control">
                                    <input class="input is-rounded is-small" type="email" placeholder="any@any.com" name="email">
                                </div>
                            </div>
                            <div class="field" style="display:none;">
                                <div class="control">
                                    <input class="input" type="text" name="team_id" value="<?php echo $row["team_id"]; ?>" />
                                </div>
                            </div>
                            <div class="field has-text-left">
                                <h1 class="is-size-7">Password</h1>
                                <div class="control">
                                    <input class="input is-rounded is-small" type="password" name="password" >
                                </div>
                            </div>
                            <div class="field has-text-left">
                                <h1 class="is-size-7">Confirm Password</h1>
                                <div class="control">
                                    <input class="input is-rounded is-small" type="password" name="cpassword">
                                </div>
                            </div>
                            
                                    <button type="submit" class="button  is-small is-rounded">Register</button>
                                
                        </form>
                </div>
        </section>
    </body>

    </html>
