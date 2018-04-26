<?php
  require "../actions/conn.php"; 
  session_start();
  if($_SERVER["REQUEST_METHOD"]=="POST"){
		extract($_POST);
		session_start();
		$_SESSION["team_id"] = $team_id;
  }else{
	  $q1="SELECT * FROM `admin_team` WHERE `admin_id` = '$admin_id' LIMIT 1";
	  $result = mysqli_query($link,$q1);
	  $row = mysqli_fetch_assoc($result);
	  $_SESSION['team_id'] = $row1['team_id'];
  }
  extract($_SESSION);
	if($_SESSION["team_id"]) {
		$q1="SELECT * FROM `admin_team` WHERE `admin_id` = '$admin_id' AND `team_id` = '$team_id' LIMIT 1";
		$row = mysqli_query($link,$q1);
		$row1 =  mysqli_fetch_assoc($row);
	}else{
		$q1 = "SELECT * FROM `admin_team` WHERE `admin_id` = '$admin_id' LIMIT 1";
		$row = mysqli_query($link, $q1);
		$row1 = mysqli_fetch_assoc($row);
		$team_id = $row1["team_id"];
	}
  $hs = "SELECT * FROM `admin_team` WHERE `admin_id`='$admin_id' AND `team_id`<>'$team_id'";
  $hss = mysqli_query($link, $hs);
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
  <link href='../../css/materialize.min.css' rel="stylesheet" />
  <link href='../../css/styles.css' rel="stylesheet" />
  <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
  <script src='../../js/jquery-3.3.1.min.js'></script>
  <script src='../../js/materialize.min.js'></script>
  <script>
      $(document).ready(function(){
          $(".button-collapse").sideNav({
              menuWidth: 300,
              edge: 'left',
              closeOnClick: true,
              draggable: true
          });

          $('.dropdown-button').dropdown({
                  inDuration: 300,
                  outDuration: 225,
                  constrainWidth: false, // Does not change width of dropdown to that of the activator
                  hover: false, // Activate on hover
                  gutter: 0, // Spacing from edge
                  belowOrigin: true, // Displays dropdown below the button
                  alignment: 'center', // Displays dropdown with edge aligned to the left of button
                  stopPropagation: false // Stops event propagation
              }
          );

      })
  </script>
    <style>
        body, .side-nav,.dropdown-content {
            background: linear-gradient(to right,#c33764,#1d2671);
            color: whitesmoke !important;
        }
        a {
            color:whitesmoke !important;
        }
        nav {
            background: transparent !important;
            border: none;
        }
        .card-panel a h6,.card-panel a i {
            color: #2c3e50 !important;
        }
    </style>
</head>

<body>
  <nav>
    <div class="nav-wrapper transparent">
      <a class="brand-logo center"><?php echo $row1["team_name"]; ?></a>
      <ul class="left ">
        <li>
          <a data-activates="slide-out" class="button-collapse show-on-large">
            <i class="fas fa-bars" style="color:whitesmoke;font-size: 1.3em !important;" ></i>
          </a>
        </li>
      </ul>
      <ul class="right">
          <li>
              <a href='#' data-activates='hotswitch' class="dropdown-button"><i class="fas fa-user-circle" style="color:whitesmoke;font-size: 1.3em !important;"></i></a>
          </li>
          <ul id='hotswitch' class='dropdown-content'>
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		          <?php
			          while($rhs = mysqli_fetch_assoc($hss)){
				          echo "<li><button class='btn purple' name='team_id' type='submit' value='".$rhs["team_id"]."'>".$rhs["team_name"]."</button></li>";
			          }
		          ?>
              </form>
          </ul>
      </ul>
    </div>
  </nav>
  <ul id="slide-out" class="side-nav">
    <br/>
    <br/>
    <li>
      <a href="./main.php">Home</a>
    </li>
    <li>
      <a href="./manage_teams.php">Manage Teams</a>
    </li>
    <li>
      <a href="./my_profile.php">My Profile</a>
    </li>
    <li>
      <a href="../actions/login.php?logout=1">Log Out</a>
    </li>
  </ul>
  <br/>
  <br/>
  <div class=" container">
    <div class="row">
      <div class="col s12 m6 l6">
        <a href="./expenses.php">
        <div class="card-panel small" style="color: #2c3e50 !important;">
              <i class="fas fa-money-bill-alt" style="font-size: 1.7em !important;"></i>
              <h6 style="display: inline;padding-left: 25px;">Manage Expenses</h6>
        </div>
      </a>
      </div>
      <div class="col s12 m6 l6">
        <a href="./receipts.php">
        <div class="card-panel small" style="color: #2c3e50 !important;">
              <i class="fas fa-book" style="font-size: 1.7em !important;"></i>
              <h6 style="display: inline;padding-left: 25px;">Expense History</h6>
        </div>
      </a>
      </div>
    </div>
  </div>
</body>

</html>