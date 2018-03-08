<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Xpense Hub Home</title>
  <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
  <link href='./css/bulma.css' rel="stylesheet" />
  <link href='./css/styles.css' rel="stylesheet" />
  <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
  <script src='./js/jquery-3.3.1.min.js'></script>
  <script src='./js/index.js'></script>
  <script>
    $(document).ready(function () {
          $('#first').hide();
          $('#second').hide();
          $('#third').hide();
          $('#intro_button').on('click', function () {
            $('#intro').hide();
            $('#first').fadeIn(1000);
          });
          $('#first_button').on('click', function () {
            $('#first').hide();
            $('#second').fadeIn(1000);
          });
          $('#second_button_prev').on('click', function () {
            $('#second').hide();
            $('#first').fadeIn(1000);
          });
          $('#second_button_next').on('click', function () {
            $('#second').hide();
            $('#third').fadeIn(1000);
          });
          });
          let i = 1
          function addInput() {
             i += 1;
            var newInput = '<div class="field is-grouped"> <div class = "control is-expanded" ><input class = "input is-medium"id="'+i+'"type = "email"placeholder = "Enter Email" ></div></div>';
            $('#first_input').before(newInput);  
            }
  </script>
</head>

<body>
  <section class="hero is-fullheight">
    <div class="hero-head">
      <header class="navbar">
        <div class="container ">
          <div class="navbar-brand ">
            <img src="./img/XPENSE LOGO.png" style="padding-top:20px; height:100px !important;width:160px;"  alt="Logo">
          </div>
        </div>
      </header>
    </div>
    <div class="hero-body">
      <div class="container has-text-centered" id="intro">
        <h1 class="title is-size-2" style="font-weight:bolder;">
          Keep track of how money leaves your company.
        </h1>
        <h2 class="subtitle is-size-4">
          Create a Team of those you work with and keep an eye on your team's. Be the first to see, track and authorise expenses.
        </h2>
        <a class="button is-outlined is-large" id="intro_button">CREATE A TEAM</a>
      </div>
      <div class="container has-text-centered" id="first">
        <div class="field">
          <div class="control">
            <input class="input is-large" type="email" placeholder="Enter Your Email">
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
            <input class="input is-large" type="text" placeholder="Create a Team Name">
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
        <form method="POST" action="" id="inviteUser_form">
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
  <hr/>
  <section class="hero is-fullheight">
    <div class="hero-body">
      <div class="container has-text-left">
        <h1 class="title is-size-2" style="font-weight:bolder;">You have an account?</h1>
        <h2 class="subtitle is-size-4">Sign In and keep watching your team closely. Never leave a second without watching.</h2>
        <br/>
        <a class="button no-outline is-large" href="./php/actions/login.php">SIGN IN</a>
      </div>
    </div>
  </section>
</body>

</html>