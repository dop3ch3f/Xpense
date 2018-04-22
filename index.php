<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Xpense Hub</title>
  <link href='./css/styles.css' rel="stylesheet" />
  <link href="./css/bulma.css" rel="stylesheet" />
    <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
  <script src='./js/jquery-3.3.1.min.js'></script>
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
    <div class="hero-body" >
      <div class="container has-text-centered" id="intro" >
        <h1 class=" is-size-4" style="text-align: center;">
          Keep track of how money leaves your company.
        </h1><br/>
        <h2 class=" is-size-5" style="text-align: center;">
          Create a Team of those you work with and keep an eye on your team's. Be the first to see, track and authorise expenses.
        </h2>
          <br/>
        <a href="./php/actions/register.php" class="button is-small is-rounded" id="intro_button">Create Account</a>
         <br/><br/>
          <a href="./php/actions/login.php">Sign in</a>
      </div>
    </div>
  </section>
</body>

</html>