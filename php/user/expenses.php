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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href='../../css/materialize.min.css' rel="stylesheet" />
    <link href='../../css/styles.css' rel="stylesheet" />
    <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
    <script src='../../js/jquery-3.3.1.min.js'></script>
    <script src='../../js/materialize.min.js'></script>
    <script src="../../js/printhelper.js"></script>
    <script>
        $(document).ready(function () {
            $('.button-collapse').sideNav({
                menuWidth: 300,
                edge: 'left',
                closeOnClick: true,
                draggable: true,
            });
            $('.modal').modal({
                swipeable: true,
                responsiveThreshold:Infinity,

            });
        });
    </script>
</head>

<body>
    <nav>
        <div class="nav-wrapper white">
            <a href="#" class="brand-logo center black-text">Expenses</a>
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
    <div class="section container" id="printable">
        <div class="row">
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
  </div>
    </div>

    </form>
        </div>
    </div>
</body>
</html>