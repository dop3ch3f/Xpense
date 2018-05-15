<?php
require "../actions/conn.php";
session_start();
ob_start();
extract($_SESSION);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
     if($name == ""){
         $issue = "Input a name for the Expense<br/>";
     }
     if($price == ""){
         $issue .= "Input the Price for the Expense<br/>";
     }
     if($description == ""){
         $issue.= "Please add a short description of the Expense<br/>";
     }
     if($issue){
         $output = "There are issues with your form:<br/>".$issue;
     }else{
	     $date = date("Y:m:d");
	     $query = "INSERT INTO `Expense`(`user_id`,`team_id`, `name`, `price`, `description`, `status`, `receipt_status`, `date_created`) VALUES ('$user_id','$team_id','$name','$price','$description','Pending','Absent','$date')";
	
	     if(mysqli_query($link,$query)){
		     $output = "<h6>Expense Registered successfully, Refreshing..</h6>";
		     header("refresh:2;url=./expenses.php");
	     }else {
		     $output = "<h6>Something Went Wrong, Try Again Later</h6>";
	     }
	
     }
}

$q1 = "SELECT * FROM `user_team` WHERE `user_id` = '$user_id' LIMIT 1";
$result = mysqli_query($link, $q1);
$row1 = mysqli_fetch_assoc($result);
	
	#queries
	$qpending = "SELECT * FROM `user_expense` WHERE team_id = '$team_id'  AND `user_id` = '$user_id' AND `status` = 'Pending' LIMIT 15 ";
	$qaccepted = "SELECT * FROM `admin_receipt` WHERE team_id = '$team_id' AND `user_id` = '$user_id' AND `rpt_status` = 'Pending' LIMIT 15 ";
	$qdeclined = "SELECT * FROM `user_expense` WHERE team_id = '$team_id' AND `user_id` = '$user_id' AND `status` = 'Declined' LIMIT 15";
	$qcomplete = "SELECT * FROM `admin_receipt` WHERE team_id = '$team_id' AND `user_id` = '$user_id' AND `receipt_status` = 'Available' LIMIT 15";
	#results
	$pen= mysqli_query($link,$qpending);
	$acc= mysqli_query($link, $qaccepted);
	$dec= mysqli_query($link, $qdeclined);
	$com= mysqli_query($link, $qcomplete);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expenses</title>
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
                    hover: true, // Activate on hover
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
        input,textarea {
            color: #2c3e50 !important;
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
        <a href="#" class="brand-logo center">Expenses</a>
        <ul id="nav-mobile" class="left ">
            <li>
                <a data-activates="slide-out" class="button-collapse show-on-large">
                    <i class="fas fa-bars" style="color:whitesmoke;"></i>
                </a>
            </li>

        </ul>
        <ul class="right">
            <li>
                <a href='#modal1'  class="modal-trigger"><i class="fas fa-plus" style="color:whitesmoke;font-size: 1.3em !important;"></i></a>
            </li>
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
            <form class="dateform col s12 center-align" action="./expense_report.php" method="POST">
                <div class="input-field col s6 m6 l4 ">
                    <span style="color: #2c3e50 !important;">From:</span>
                    <input  type="date" name="from" >
                </div>
                <div class="input-field" style="display: none !important;">
                    <input name="team_id" type="hidden" value="<?php echo $row1["team_id"]; ?>"/>
                </div>
                <div class="input-field" style="display: none !important;">
                    <input name="user_id" type="hidden" value="<?php echo $row1["user_id"]; ?>"/>
                </div>
                <div class="input-field col s6 m6 l4">
                    <span style="color: #2c3e50 !important;">To:</span>
                    <input  type="date" name="to" >
                </div>
                <div class="input-field col s12 m12 l4">
                    <button class="btn purple " type="submit" name="type" value="pending"><i class="fas fa-search"></i> </button>
                </div>
            </form>
            <ul class="collapsible" data-collapsible="accordion">
				<?php
					while($rpending = mysqli_fetch_assoc($pen)){
						echo "<li><div class='collapsible-header'><img height='50' width='50' src='".$rpending["image_path"]."' class='materialboxed' alt='Image here'/><span style='padding-left:25px;'>".$rpending["full_name"]."<strong>".$rpending["name"]."</strong></span><span class='badge'>NGN".$qpending["price"]."</span></div><div class='collapsible-body'><span>".$rpending["description"].".<br/>".$rpending["date_created"]."</span></div></li>";
					}
				?>
            </ul>
        </div>
        <div id="accepted" class="col s12">
            <form class="dateform col s12 center-align" action="./expense_report.php" method="POST">
                <div class="input-field col s6 m6 l4 ">
                    <span style="color: #2c3e50 !important;">From:</span>
                    <input  type="date" name="from" >
                </div>
                <div class="input-field" style="display: none !important;">
                    <input name="team_id" type="hidden" value="<?php echo $row1["team_id"]; ?>"/>
                </div>
                <div class="input-field" style="display: none !important;">
                    <input name="user_id" type="hidden" value="<?php echo $row1["user_id"]; ?>"/>
                </div>
                <div class="input-field col s6 m6 l4">
                    <span style="color: #2c3e50 !important;">To:</span>
                    <input  type="date" name="to" >
                </div>
                <div class="input-field col s12 m12 l4">
                    <button class="btn purple " type="submit" name="type" value="accepted"><i class="fas fa-search"></i> </button>
                </div>
            </form>
            <ul class="collapsible" data-collapsible="accordion">
				<?php
					while($raccepted = mysqli_fetch_assoc($acc)){
						echo "<li>
                        <div class=\"collapsible-header\"><img height='50px' width='50px'  alt='Image here' src='".$raccepted["image_path"]."' class=\"materialboxed\"/><span style=\"padding-left: 25px;\">".$raccepted["full_name"]." <strong>".$raccepted["name"]."</strong></span><span class=\"badge\">NGN".$raccepted["price"]."</span></div>
                        <div class=\"collapsible-body\"><span>".$raccepted["description"].".<br/>".$raccepted["date_approved"]."</span></div>
                    </li>";
					}
				?>
            </ul>

        </div>
        <div id="declined" class="col s12">
            <form class="dateform col s12 center-align" action="./expense_report.php" method="POST">
                <div class="input-field col s6 m6 l4 ">
                    <span style="color: #2c3e50 !important;">From:</span>
                    <input  type="date" name="from" >
                </div>
                <div class="input-field" style="display: none !important;">
                    <input name="team_id" type="hidden" value="<?php echo $row1["team_id"]; ?>"/>
                </div>
                <div class="input-field" style="display: none !important;">
                    <input name="user_id" type="hidden" value="<?php echo $row1["user_id"]; ?>"/>
                </div>
                <div class="input-field col s6 m6 l4">
                    <span style="color: #2c3e50 !important;">To:</span>
                    <input  type="date" name="to" >
                </div>
                <div class="input-field col s12 m12 l4">
                    <button class="btn purple " type="submit" name="type" value="rejected"><i class="fas fa-search"></i> </button>
                </div>
            </form>
            <ul class="collapsible" data-collapsible="accordion">
				<?php
					while($rdeclined = mysqli_fetch_assoc($dec)){
						echo "<li>
                        <div class=\"collapsible-header\"><img height='50px' width='50px' alt='Image here' src='".$rdeclined["image_path"]."' class=\"materialboxed\"/><span style=\"padding-left: 25px;\">".$rdeclined["full_name"]." <strong>".$rdeclined["name"]."</strong></span><span class=\"badge\">NGN".$rdeclined["price"]."</span></div>
                        <div class=\"collapsible-body\"><span>".$rdeclined["description"].".<br/>".$rdeclined["date_approved"]."</span></div>
                    </li>";
					}
				?>
            </ul>
        </div>
        <div id="complete" class="col s12">
            <form class="dateform col s12 center-align" action="./expense_report.php" method="POST">
                <div class="input-field col s6 m6 l4 ">
                    <span style="color: #2c3e50 !important;">From:</span>
                    <input  type="date" name="from" >
                </div>
                <div class="input-field" style="display: none !important;">
                    <input name="team_id" type="hidden" value="<?php echo $row1["team_id"]; ?>"/>
                </div>
                <div class="input-field" style="display: none !important;">
                    <input name="user_id" type="hidden" value="<?php echo $row1["user_id"]; ?>"/>
                </div>
                <div class="input-field col s6 m6 l4">
                    <span style="color: #2c3e50 !important;">To:</span>
                    <input  type="date" name="to" >
                </div>
                <div class="input-field col s12 m12 l4">
                    <button class="btn purple " type="submit" name="type" value="complete"><i class="fas fa-search"></i> </button>
                </div>
            </form>
            <ul class="collapsible" data-collapsible="accordion">
				<?php
					while($rcomplete = mysqli_fetch_assoc($com)){
						echo "<li>
                        <div class=\"collapsible-header\"><img height='50px' width='50px' alt='Image here' src='".$rcomplete["image_path"]."' class=\"materialboxed\"/><span style=\"padding-left: 25px;\">".$rcomplete["full_name"]." <strong>".$rcomplete["name"]."</strong></span><span class=\"badge\">NGN".$rcomplete["price"]."</span></div>
                        <div class=\"collapsible-body\"><span>".$rcomplete["description"].".<br/>".$rcomplete["date_approved"]."</span></div>
                    </li>";
					}
				?>
            </ul>
        </div>
    </div>
</div>
<div id="modal1" class="modal bottom-sheet">
    <div class="modal-content">
        <form class="col s12" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
           <div class="row">
               <div class="col m6 pull-m3 push-m3 l6 push-l3 pull-l3 s12">
                <p class="black-text">Create an Expense</p>
			    <?php echo $output; ?>
                <br/>
                <div class="input-field">
                    <input placeholder="Input Item Name" name="name" id="name" type="text">
                    <label for="name">Item Name:</label>
                </div>
                
                <div class="input-field">
                    <input id="price" name="price" type="number" placeholder="Input price in Naira">
                    <label for="price">Price:</label>
                </div>
                <div class="input-field">
                    <textarea name="description" class="materialize-textarea"></textarea>
                    <label for="description">Description:</label>
                </div>
                <div class="input-field">
                    <button class="purple btn" type="submit">Submit</button>
                </div>
               </div>
           </div>
        </form>
        </div>
     </div>
</body>
</html>