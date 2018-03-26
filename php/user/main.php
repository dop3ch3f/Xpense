<?php
  require "../actions/conn.php"; 
  session_start();
  extract($_SESSION); 
  
  $q1="SELECT * FROM `user_team` WHERE `user_id` = '$user_id'";
  $result = mysqli_query($link,$q1);
  $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>
    Home
  </title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link href='../../css/materialize.min.css' rel="stylesheet" />
  <link href='../../css/styles.css' rel="stylesheet" />
  <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
  <script src='../../js/jquery-3.3.1.min.js'></script>
  <script src='../../js/materialize.min.js'></script>
  <script>
    $(document).ready(function () {
      $('.button-collapse').sideNav({
        menuWidth: 300,
        edge: 'left',
        closeOnClick: true,
        draggable: true,
      });
      $('ul.tabs').tabs('select_tab', 'tab_id');
    });
  </script>
</head>

<body>
  <nav>
    <div class="nav-wrapper white">
      <a href="#" class="brand-logo center black-text">Dashboard</a>
      <ul id="nav-mobile" class="left ">
        <li>
          <a data-activates="slide-out" class="button-collapse show-on-large">
            <i class="material-icons" style="color:purple;">menu</i>
          </a>
        </li>

      </ul>
    </div>
  </nav>
  <ul id="slide-out" class="side-nav">
    <li>
      <div class=" center-align">
        <br/>
        <a>
          <img class="circle" src="<?php echo $row['image_path']; ?>" width="100px" height="100px">
        </a>
        <h6><?php echo $row['full_name']; ?></h6>
        <h6><?php echo $row['email']; ?></h6>
        <h6><?php echo $row['team_name'];?></h6>
      </div>
    </li>
    <br/>
    <li>
      <a href="./main.php">
        <i class="material-icons waves-effect" style="color:purple;">home</i>Home</a>
    </li>
    <li>
      <div class="divider"></div>
    </li>
    <li>
      <a href="./my_profile.php">
        <i class="material-icons waves-effect" style="color:purple;">person</i>My Profile</a>
    </li>

    <li>
      <div class="divider"></div>
    </li>
    <li>
      <a href="../actions/login.php?logout=1">
        <i class="material-icons waves-effect" style="color:purple;">arrow_back</i>Log Out</a>
    </li>

    <li>
      <div class="divider"></div>
    </li>
  </ul>
  <br/>
  <br/>
  <div class="section container">
    <div class="row">
      <div class="col s12 m6 l6">
        <a href="./expenses.php">
        <div class="card hoverable">
          <div class="card-image">
            <img src="../../img/expenses.jpg" width="220" height="250">
          </div>
          <div class="card-stacked">
            <div class="card-content">
              <h5>Expenses</h5>
            </div>

          </div>
        </div>
      </a>
        
      </div>
      <div class="col s12 m6 l6">
        <a href="./receipts.php">
        <div class="card hoverable">
          <div class="card-image">
            <img src="../../img/receipts.jpg" width="220" height="250">
          </div>
          <div class="card-stacked">
            <div class="card-content">
              <h5>Receipts</h5>
            </div>

          </div>
        </div>
      </a>
        
      </div>
    </div>
    <div class="row">
      <div class="col s12 m6 l6">
        <a href="./transactions.php">
        <div class="card hoverable">
          <div class="card-image">
            <img src="../../img/transaction.jpg" width="220" height="250">
          </div>
          <div class="card-stacked">
            <div class="card-content">
              <h5>Transaction</h5>
            </div>

          </div>
        </div>
      </a>
        
      </div>
      <div class="col s12 m6 l6">
        <a href="./all_transaction.php">
        <div class="card hoverable">
          <div class="card-image">
            <img src="../../img/alltransaction.jpg" width="220" height="250">
          </div>
          <div class="card-stacked">
            <div class="card-content">
              <h5>All Transactions</h5>
            </div>

          </div>
        </div>
      </a>
        
      </div>
    </div>
  </div>
</body>
<!-- Modal Structure -->

</html>