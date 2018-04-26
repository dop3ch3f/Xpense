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
	$qreceipt = "SELECT * FROM `admin_receipt` WHERE `team_id` = '$team_id'";
	$hs = "SELECT * FROM `admin_team` WHERE `admin_id`='$admin_id' and `team_id`<>'$team_id'";
	#results
	$hss = mysqli_query($link, $hs);
	$resreceipt = mysqli_query($link, $qreceipt);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        Receipts
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
                    gutter: 0, // Spacing from edge
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
        body, .side-nav,.dropdown-content,.tabs {
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
        .collapsible-header,.collapsible-body, .prefix {
            color: #2c3e50 !important;
        }
        .prefix {
            font-size: 1.5em !important;
        }
        .collapsible-body, .dateform{
            background-color: whitesmoke;
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
                <form class="dateform col s12" action="./expense_report.php" method="POST">
                    <div class="input-field col s4 m4 l4 inline"><i class="far fa-calendar-alt prefix"></i>
                        <input id="icon_prefix" type="text" name="from" class="datepicker">
                        <label for="icon_prefix">From:</label></div>
                    <div class="input-field col s4 m4 l4 inline"><i class="far fa-calendar-alt prefix"></i>
                        <input id="icon_telephone" type="text" name="to" class="datepicker">
                        <label for="icon_telephone">To:</label></div>
                    <div class="input-field col s4 m4 l4 inline"><button class=" btn btn-small purple" type="submit" name="type" value="receipt"><i class="fas fa-search"></i></button></div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <ul class="collapsible" data-collapsible="accordion">
                    <?php
                        while($rrcpt = mysqli_fetch_assoc($resreceipt)){
                           echo "<li>
                        <div class='collapsible-header'><img height='100' width='50' src='".$rrcpt["image"]."' class='materialboxed circle'/><span style='padding-left: 25px;'>".$rrcpt["full_name"]."  <strong>  ".$rrcpt["name"]."</strong></span><span class='badge'>NGN".$rrcpt["price"]."</span></div>
                        <div class='collapsible-body'><span>".$rrcpt["description"].". ".$rrcpt["date_posted"]."<br/><form method='POST' action='./receipt_action.php'>
                            <button class='btn purple' type='submit' name='accept'  value='".$rrcpt['receipt_id']."'>Accept</button><button class='btn purple' type='submit' name='decline'  value='".$rrcpt['receipt_id']."'>Decline</button></form></span></div>
                    </li>";
                        }
                    ?>
                    
                </ul>
            </div>
        </div>
    </div>
</body>


</html>