<?php
require './conn.php';
require './server.php';
session_start();
ob_start();
if($_SERVER["REQUEST_METHOD"] == "GET"){
  if($_GET['logout']==1){
    session_destroy();
    $logout = "<h4 class=\"is-size-4\">Logout Successful</h4>";
   header("refresh:2;url=".$server."php/actions/login.php");
  }
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
  extract($_POST);
  if($email == "" OR $password == ""){
      $logout= "Please Input Email and Password to Login";
  }else{
	  if($type == "user"){
		  $query1="SELECT * FROM `Users` WHERE `email`='$email' AND `password`='$password' AND `type`='user' LIMIT 1";
		  $query2="SELECT * FROM `Users` WHERE `email`='$email' AND `password`='$password' AND `type`='admin' LIMIT 1";
		  $ures=mysqli_query($link,$query1);
		  $ures2=mysqli_query($link,$query2);
		  if( mysqli_num_rows($ures) > 0){
			  $row = mysqli_fetch_assoc($ures);
			  $_SESSION['user_id'] = $row['user_id'];
			  header("Location:../user/main.php");
		  }
		  elseif( mysqli_num_rows($ures2) > 0) {
			  $row = mysqli_fetch_assoc($ures2);
			  $_SESSION['admin_id'] = $row['admin_id'];
			  header("Location:../admin/main.php");
          }
		  else {
			  $logout = "Email/Password is incorrect";
		  }
	  }else{
		  $query = "SELECT * FROM `Admin` WHERE `email`='$email' AND `password`='$password' LIMIT 1";
		  $ares= mysqli_query($link,$query);
		  if(mysqli_num_rows($ares)>0){
			  $row=mysqli_fetch_assoc($ares);
			  $_SESSION['admin_id'] = $row['admin_id'];
			  header("Location:../admin/main.php");
		  }else{
			  $logout = "Email/Password is incorrect";
		  }
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
  <title>Login</title>
  <link href='../../css/bulma.css' rel="stylesheet" />
  <link href='../../css/styles.css' rel="stylesheet" />
  <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
  <script src='../../js/jquery-3.3.1.min.js'></script>
    <style>
        body {
            background: linear-gradient(to right,#c33764,#1d2671);
            color: whitesmoke !important;
        }
        a {
            color:whitesmoke;
        }
        a:hover {
            color: yellow;
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
        <div class="field">
          <?php echo $logout; ?>
        </div>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="field has-text-left">
            <div class="control">
              <div class="select is-small is-rounded">
                  <select name="type" id="type">
                      <option value="user">User</option>
                      <option value="admin">Admin</option>
                  </select>
              </div>
            </div>
          </div>
          <div class="field has-text-left">
              <h1 class="is-size-7">Email:</h1>
            <div class="control has-icons-left">
              <input class="input is-small is-rounded" name="email" id="email" type="email"/>
              <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
              </span>
            </div>
          </div>
          <div class="field has-text-left">
              <h1 class="is-size-7">Password:</h1>
            <div class="control has-icons-left">
              <input class="input is-small is-rounded" name="password" id="password" type="password"/>
              <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
              </span>
            </div>
          </div>
          <br/>
            <a href="../../index.php" class="button is-small is-rounded"><span class="icon">
                  <i class="fas fa-angle-left"></i>
              </span></a>
          <button class="button is-small is-rounded" type="submit"><span class="icon">
                  <i class="fas fa-angle-right"></i>
              </span></button>
            <br/>
         <!-- <a href="../actions/reset.php">Forgot Password</a> -->
        </form>
      </div>
    </div>
  </section>
</body>

</html>