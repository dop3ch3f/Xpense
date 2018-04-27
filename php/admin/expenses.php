<?php
  require '../actions/conn.php';
  session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		extract($_POST);
		session_start();
		$_SESSION["team_id"] = $team_id;
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
  #queries
  $qpending = "SELECT * FROM `user_expense` WHERE `team_id` = '$team_id' AND `status` = 'Pending' LIMIT 15 ";
  $qaccepted = "SELECT * FROM `user_expense` WHERE `team_id` = '$team_id' AND `status` = 'Approved' LIMIT 15 ";
  $qdeclined = "SELECT * FROM `user_expense` WHERE `team_id` = '$team_id' AND `status` = 'Declined' LIMIT 15";
  $qcomplete = "SELECT * FROM `user_expense` WHERE `team_id` = '$team_id' AND `receipt_status` = 'Available' LIMIT 15";
  $hs = "SELECT * FROM `admin_team` WHERE `admin_id`='$admin_id' and `team_id`<>'$team_id'";
  #results
  $pen= mysqli_query($link,$qpending);
  $acc= mysqli_query($link, $qaccepted);
  $dec= mysqli_query($link, $qdeclined);
  $com= mysqli_query($link, $qcomplete);
  $hss = mysqli_query($link, $hs);
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        Expenses
    </title>
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
                draggable: true
            });
            $('.dropdown-button').dropdown({
                    inDuration: 300,
                    outDuration: 225,
                    constrainWidth: false, // Does not change width of dropdown to that of the activator
                    hover: false, // Activate on hover
                    gutter: 1, // Spacing from edge
                    belowOrigin: true, // Displays dropdown below the button
                    alignment: 'left', // Displays dropdown with edge aligned to the left of button
                    stopPropagation: false // Stops event propagation
                }
            );
            $('.collapsible').collapsible({
                accordion: false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
                
            });
            $('ul.tabs').tabs();
            $('.modal').modal({
                swipeable: true,
                responsiveThreshold:Infinity

            });
            $('.datepicker').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15, // Creates a dropdown of 15 years to control year,
                today: 'Today',
                clear: 'Clear',
                close: 'Ok'
            });

        });
    </script>
    <style>
        body, .side-nav,.tabs {
            background: linear-gradient(to right,#c33764,#1d2671);
            color: whitesmoke !important;
        }
        a {
            color:whitesmoke !important;
        }
        nav {
            background: transparent !important;
        }
        .card-panel a h6,.card-panel a i {
            color: #2c3e50 !important;
        }
        .collapsible-header,.collapsible-body, .prefix {
            color: #2c3e50 !important;
        }
        .prefix {
            font-size: 1.5em !important;
        }
        .collapsible-body, .dateform{
            background-color: whitesmoke;
        }
        #hotswitch ul li{
            background-color: transparent !important;
            border-radius:5px !important;
        }
        
    </style>
</head>

<body>
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo center"><?php echo $row1["team_name"]; ?></a>
            <ul id="nav-mobile" class="left">
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
    <div class="container">
        <div class="row">
            <div class="col s12">
                <ul class="tabs tabs-fixed-width">
                    <li class="tab col s3"><a class="active" href="#pending"><small>Pending</small></a></li>
                    <li class="tab col s3"><a href="#accepted"><small>Accepted</small></a></li>
                    <li class="tab col s3"><a href="#declined"><small>Declined</small></a></li>
                    <li class="tab col s3"><a href="#complete"><small>Complete</small></a></li>
                </ul>
            </div>
            <div id="pending" class="col s12">
                <form class="dateform col s12" action="./expense_report.php" method="POST">
                    <div class="row">
                        <div class="input-field col s4 inline">
                            <i class="far fa-calendar-alt prefix"></i>
                            <input id="icon_prefix" type="text" name="from" class="datepicker">
                            <label for="icon_prefix">From:</label>
                        </div>
                        <div class="input-field col s4 inline">
                            <i class="far fa-calendar-alt prefix"></i>
                            <input id="icon_telephone" type="text" name="to" class="datepicker">
                            <label for="icon_telephone">To:</label>
                        </div>
                        <div class="input-field inline col s4">
                            <button class=" btn btn-small purple" type="submit" name="type" value="pending"><i class="fas fa-search"></i></button>
                        </div>
                        
                    </div>
                </form>
                <ul class="collapsible" data-collapsible="accordion">
                    <?php
                        while($rpending = mysqli_fetch_assoc($pen)){
                            echo "<li><div class='collapsible-header'><img height='50' width='50' src='".$rpending["image_path"]."' class='circle responsive-img'/><span style='padding-left:25px;'>".$rpending["full_name"]."<strong>".$rpending["name"]."</strong></span><span class='badge'>NGN".$qpending["price"]."</span></div><div class='collapsible-body'><span>".$rpending["description"].".".$rpending["date_created"]."<br/><form method='post' action='./expense_post.php'><button class='btn purple' name='accept' value='".$rpending["expense_id"]."' type='submit'>Accept</button><button class='btn purple' name='reject' value='".$rpending["expense_id"]."' type='submit'>Decline</button></form></span></div></li>";
                        }
                    ?>
                </ul>
            </div>
            <div id="accepted" class="col s12">
                <form class="dateform col s12" method="post">
                    <div class="row">
                        <div class="input-field col s4 inline">
                            <i class="far fa-calendar-alt prefix"></i>
                            <input id="icon_prefix" type="text" name="from" class="datepicker">
                            <label for="icon_prefix">From:</label>
                        </div>
                        <div class="input-field col s4 inline">
                            <i class="far fa-calendar-alt prefix"></i>
                            <input id="icon_telephone" type="text" name="to" class="datepicker">
                            <label for="icon_telephone">To:</label>
                        </div>
                        <div class="input-field inline col s4">
                            <button class=" btn btn-small purple" type="submit" name="type" value="accepted"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <ul class="collapsible" data-collapsible="accordion">
                    <?php
                       while($raccepted = mysqli_fetch_assoc($acc)){
                         echo "<li>
                        <div class=\"collapsible-header\"><img src='".$raccepted["image_path"]."' class=\"circle responsive-img\"/><span style=\"padding-left: 25px;\">".$raccepted["full_name"]." <strong>".$raccepted["name"]."</strong></span><span class=\"badge\">NGN".$raccepted["price"]."</span></div>
                        <div class=\"collapsible-body\"><span>".$raccepted["description"].".".$raccepted["date_approved"]."</span></div>
                    </li>";
                       }
                    ?>
                </ul>

            </div>
            <div id="declined" class="col s12">
                <form class="dateform col s12" action="./expense_report.php" method="post">
                    <div class="row">
                        <div class="input-field col s4 inline">
                            <i class="far fa-calendar-alt prefix"></i>
                            <input id="icon_prefix" type="text" name="from" class="datepicker">
                            <label for="icon_prefix">From:</label>
                        </div>
                        <div class="input-field col s4 inline">
                            <i class="far fa-calendar-alt prefix"></i>
                            <input id="icon_telephone" type="text" name="to" class="datepicker">
                            <label for="icon_telephone">To:</label>
                        </div>
                        <div class="input-field inline col s4">
                            <button class=" btn btn-small purple" type="submit" name="type" value="declined"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <ul class="collapsible" data-collapsible="accordion">
	                <?php
		                while($rdeclined = mysqli_fetch_assoc($dec)){
			                echo "<li>
                        <div class=\"collapsible-header\"><img src='".$rdeclined["image_path"]."' class=\"circle responsive-img\"/><span style=\"padding-left: 25px;\">".$rdeclined["full_name"]." <strong>".$rdeclined["name"]."</strong></span><span class=\"badge\">NGN".$rdeclined["price"]."</span></div>
                        <div class=\"collapsible-body\"><span>".$rdeclined["description"].".".$rdeclined["date_approved"]."</span></div>
                    </li>";
		                }
	                ?>
                </ul>
            </div>
            <div id="complete" class="col s12">
                <form class="dateform col s12" action="./expense_report.php" method="post">
                    <div class="row">
                        <div class="input-field col s4 inline">
                            <i class="far fa-calendar-alt prefix"></i>
                            <input id="icon_prefix" type="text" name="from" class="datepicker">
                            <label for="icon_prefix">From:</label>
                        </div>
                        <div class="input-field col s4 inline">
                            <i class="far fa-calendar-alt prefix"></i>
                            <input id="icon_telephone" type="text" name="to" class="datepicker">
                            <label for="icon_telephone">To:</label>
                        </div>
                        <div class="input-field inline col s4">
                            <button class=" btn btn-small purple" type="submit" name="type" value="complete"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <ul class="collapsible" data-collapsible="accordion">
	                <?php
		                while($rcomplete = mysqli_fetch_assoc($com)){
			                echo "<li>
                        <div class=\"collapsible-header\"><img src='".$rcomplete["image_path"]."' class=\"circle responsive-img\"/><span style=\"padding-left: 25px;\">".$rcomplete["full_name"]." <strong>".$rcomplete["name"]."</strong></span><span class=\"badge\">NGN".$rcomplete["price"]."</span></div>
                        <div class=\"collapsible-body\"><span>".$rcomplete["description"].".".$rcomplete["date_approved"]."</span></div>
                    </li>";
		                }
	                ?>
                </ul>
            </div>
        </div>
    </div>
    
</body>
</html>