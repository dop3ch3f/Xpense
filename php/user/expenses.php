<?php
require "../actions/conn.php";
session_start();
extract($_SESSION);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
	$date = date("Y:m:d");
    $query = "INSERT INTO `Expense`(`user_id`,`team_id`, `name`, `price`, `description`, `status`, `receipt_status`, `date_created`) VALUES ('$user_id','$team_id','$name','$price','$description','Pending','Absent','$date')";

    if(mysqli_query($link,$query)){
      $output = "<h6>Expense Registered successfully, Refreshing..</h6>";
	    header("refresh:2;url=http://localhost/Xpense/php/user/expenses.php");
    }else {
      $output = "<h6>Something Went Wrong, Refreshing..</h6>";
    }
   
}

$q1 = "SELECT * FROM `user_team` WHERE `user_id` = '$user_id' LIMIT 1";
$result = mysqli_query($link, $q1);
$row = mysqli_fetch_assoc($result);
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

            $('.modal').modal({
                    dismissible: true, // Modal can be dismissed by clicking outside of the modal
                    opacity: .5, // Opacity of modal background
                    inDuration: 300, // Transition in duration
                    outDuration: 200, // Transition out duration
                    startingTop: '4%', // Starting top style attribute
                    endingTop: '10%' // Ending top style attribute
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
                <a href='modal1'  class="modal-trigger"><i class="fas fa-plus" style="color:whitesmoke;font-size: 1.3em !important;"></i></a>
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
        
        </div>
    </div>
<div id="modal1" class="modal bottom-sheet">
    <div class="modal-content">
        <form class="col s12" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="row">
                <h5>Create an Expense</h5>
                <br/>
			    <?php echo $output; ?>
                <br/>
                <div class="input-field col s12">
                    <input placeholder="Input item name " name="name" id="name" type="text">
                    <label for="name">Item Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="price" name="price" type="number" placeholder="Input price in naira">
                    <label for="price">Price</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea name="description" class="materialize-textarea"></textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <div class="row center-align">
                <button class=" waves-effect purple btn btn-large" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>