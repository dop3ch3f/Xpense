<?php
include '../actions/conn.php';
session_start();
if($_SERVER["REQUEST_METHOD"]=="GET"){
  if($_GET['logout']==1){
    session_destroy();
    $logout = "Logout Successful";
  }
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
  extract($_POST);
  if($type == "user"){
     $query="SELECT * FROM `Users` WHERE `email`=$email AND `password`=$password ";
     if(mysqli_query($link,$query)){
       if($row->mysqli_fetch_assoc($link,$query)){
         $_SESSION['user_id'] = $row['user_id'];
         header("../user/main.php");
       }
     }else{
       echo "Email/Password is incorrect";
     }
  }
  if($type == "admin"){
     $query = "SELECT * FROM `Admin` WHERE `email`=$email AND `password`=$password ";
     if(mysqli_query($link,$query)){
      if($row->mysqli_fetch_assoc($link,$query)){
        $_SESSION['admin_id'] = $row['admin_id'];
        header("../admin/main.php");
      }
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
  <script src='../../js/index.js'></script>
</head>

<body>
  <section class="hero is-fullheight">
    <div class="hero-body">
      <div class="container has-text-centered">
        <img src="../../img/XPENSE LOGO.png" style="height:100px !important;" class="is-rounded" width="160px" alt="Logo">
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
              <select class="input is-medium" name="type" id="password">
                <option value="user">User</option>
                <option value="admin">Admin</option>
              </select>
            </div>
          </div>
          <div class="field has-text-left">
            <label class="label">
              <h2 class="is-size-4">Username:</h2>
            </label>
            <div class="control has-icons-left">
              <input class="input is-medium" name="username" id="username" type="text">
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
          <button class="button no-outline is-medium" id="">Sign In</button>
          <a class="button no-outline is-medium is-right" href="../../index.php">Home Page</a>
          <br/>
          <a href="../actions/reset.php">Forgot Password</a>
        </form>
      </div>
    </div>
  </section>
</body>

</html>