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
        <form method="POST" action="">
          <div class="field has-text-left">
            <label class="label">
              <h1 class="is-size-4">Username</h1>
            </label>
            <div class="control has-icons-left">
              <input class="input is-medium" type="text">
              <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
              </span>
            </div>
          </div>
          <div class="field has-text-left">
            <label class="label">
              <h1 class="is-size-4">Password</h1>
            </label>
            <div class="control has-icons-left">
              <input class="input is-medium" type="password">
              <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
              </span>
            </div>
          </div>
          <br/>
          <br/>
          <button class="button no-outline is-large">  SIGN IN   </button>
        </form>
      </div>
    </div>
  </section>
</body>

</html>