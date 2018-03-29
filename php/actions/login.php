<?php
require './conn.php';
ob_start();
session_start();
if($_SERVER["REQUEST_METHOD"] == "GET"){
  if($_GET['logout']==1){
    session_destroy();
    $logout = "<h4 class=\"is-size-4\">Logout Successful</h4>";
    header("refresh:0;url=http://localhost/Xpense/php/actions/login.php");
  }
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
  extract($_POST);
  if($type == "user"){
     $query1="SELECT * FROM `Users` WHERE `email`='$email' AND `password`='$password'";
     $ures=mysqli_query($link,$query1);
     if(mysqli_num_rows($ures)>0){  
         $row=mysqli_fetch_assoc($ures);
         $_SESSION['user_id'] = $row['user_id'];
         $_SESSION['team_id'] = $row['team_id'];
         header("Location:../user/main.php");
     }else{
       echo "Email/Password is incorrect";
     }
  }else{
     $query = "SELECT * FROM `Admin` WHERE `email`='$email' AND `password`='$password'";
     $ares= mysqli_query($link,$query);
     if(mysqli_num_rows($ares)>0){
        $row=mysqli_fetch_assoc($ares);
        $_SESSION['admin_id'] = $row['admin_id'];
        $_SESSION['team_id'] = $row['team_id'];
        header("Location:../admin/main.php");
     }else{
       echo "Email/Password is incorrect";
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
  <title>Xpense Hub Login</title>
  <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
  <link href='../../css/bulma.css' rel="stylesheet" />
  <link href='../../css/styles.css' rel="stylesheet" />
  <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
  <script src='../../js/jquery-3.3.1.min.js'></script>
</head>

<body>
  <section class="hero is-fullheight">
    <div class="hero-body">
      <div class="container has-text-centered">
          <h1 class="is-size-1" >XpenseHub</h1>
        <br/>
        <br/>
        <div class="field">
          <?php echo $logout; ?>
        </div>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="field has-text-left">
            <label class="label">
              <h2 class="is-size-4">Role:</h2>
            </label>
            <div class="control">
              <select class="input is-medium" name="type" id="type">
                <option value="user">User</option>
                <option value="admin">Admin</option>
              </select>
            </div>
          </div>
          <div class="field has-text-left">
            <label class="label">
              <h2 class="is-size-4">Email:</h2>
            </label>
            <div class="control has-icons-left">
              <input class="input is-medium" name="email" id="email" type="email">
              <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
              </span>
            </div>
          </div>
          <div class="field has-text-left">
            <label class="label">
              <h2 class="is-size-4">Password:</h2>
            </label>
            <div class="control has-icons-left">
              <input class="input is-medium" name="password" id="password" type="password">
              <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
              </span>
            </div>
          </div>
          <br/>
          <br/>
          <button class="button no-outline is-medium" type="submit">Log In</button>
          <br/><br/>
          <a  href="../../index.php">Back to Home</a>
          <br/>
         <!-- <a href="../actions/reset.php">Forgot Password</a> -->
        </form>
      </div>
    </div>
  </section>
</body>

</html>