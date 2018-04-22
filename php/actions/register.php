<?php
    session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST"){
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
             $_SESSION["email"] = $email;
             $_SESSION["full_name"] = $full_name;
             $_SESSION["password"]= $password;
             if($_SESSION["email"] AND $_SESSION["password"]){
                  header("Location:./registerteam.php");
             }
       }
   }
       
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Register</title>
	<link href='../../css/styles.css' rel="stylesheet" />
	<link href="../../css/bulma.css" rel="stylesheet" />
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
				<h3>Personal Information</h3>
				<br/>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<div class="field has-text-left">
                    <h1 class="is-size-7">Full Name:</h1>
					<div class="control">
						<input class="input is-small is-rounded" type="text" name="full_name" placeholder="John Doe"/>
					</div>
                </div>
                <div class="field has-text-left">
                    <h1 class="is-size-7">Email:</h1>
					<div class="control">
						<input class="input is-small is-rounded" type="email" name="email" placeholder="any@any.com"/>
					</div>
                </div>
                <div class="field has-text-left">
                    <h1 class="is-size-7">Password:</h1>
					<div class="control">
						<input class="input is-small is-rounded" title="test" type="password" name="password" placeholder=""/>
					</div>
                </div>
                <div class="field has-text-left">
                    <h1 class="is-size-7">Confirm Password:</h1>
					<div class="control">
						<input class="input is-small is-rounded" type="password" name="cpassword" placeholder="Confirm Password" />
					</div>
                </div>
                    <a href="../../index.php" class="button is-small is-rounded">
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