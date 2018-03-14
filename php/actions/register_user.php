<?php
include "../actions/conn.php";

if($_SERVER["REQUEST_METHOD"]=="GET"){
    extract($_GET);
    $query="SELECT * FROM `Admin` WHERE `admin_id`='$admin' LIMIT 1";
    if(mysqli_query($link,$query)){
        $row->mysqli_fetch_assoc($link,$query);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Xpense Hub Register</title>
  <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
  <link href='./css/bulma.css' rel="stylesheet" />
  <link href='./css/styles.css' rel="stylesheet" />
  <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
  <script src='./js/jquery-3.3.1.min.js'></script>
  <script src='./js/index.js'></script>
</head>

<body>
  <section class="hero is-fullheight">
    <div class="hero-head">
      <header class="navbar">
        <div class="container ">
          <div class="navbar-brand ">
            <a class="navber-item">Xpense Hub</a>
          </div>
        </div>
      </header>
    </div>
    <div class="hero-body">
      <div class="container has-text-centered" id="first">
        <div class="field">
        <form method="POST" action="./php/actions/register_admin.php" id="inviteUser_form">
          <div class="control">
            <input class="input is-large" type="email" name="email" placeholder="Enter Your Email">
          </div>
          <div class="control">
            <input class="input is-large" type="password" name="password" placeholder="Enter Your Password">
          </div>
          <br/>
          <a class="button is-large is-rounded no-outline" id="first_button">
            <span class="icon">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="container has-text-centered" id="second">
        <div class="field">
          <div class="control">
            <input class="input is-large" type="text" name="team" placeholder="Create a Team Name">
          </div>
          <br/>
          <div class="buttons is-centered">
            <a class="button is-large is-rounded no-outline" id="second_button_prev">
              <span class="icon">
                <i class="fas fa-angle-left"></i>
              </span>
            </a>
            <a class="button is-large is-rounded no-outline" id="second_button_next">
              <span class="icon">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="container has-text-centered" id="third">
        <span class="icon">
          <i class="fas fa-users" style="font-size:150px;"></i>
        </span>
        <br/>
        <h1 class="title is-size-2">Add Team Members</h1>
        <h2 class="subtitle is-size-4">
          Send email invites to those you feel are the perfect fit.
        </h2>
        <div id="inviteUser_form_response"></div>
        <br/>
        
        <div class="field is-grouped" id="first_input">
          <div class="control is-expanded">
            <input class="input is-medium" id="1" type="email" placeholder="Enter Email">
          </div>
          <p class="control">
            <a class="button is-medium no-outline is-rounded" onclick="addInput()">
              <span class="icon">
                <i class="fas fa-plus"></i>
              </span>
            </a>
          </p>
        </div>
        <br/>
        <br/>
        <a href="./php/admin/main.php">Take a tour</a>
        <br/>
        <button class="button no-outline is-large" id="inviteUser_form_button" onclick="submitCall('inviteUser')" >Invite</button>
        </form>
      </div>
    </div>
  </section>
</body>

</html>