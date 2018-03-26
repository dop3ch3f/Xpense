<?php
include '../actions/conn.php';
session_start();
extract($_SESSION);

$q1 = "SELECT * FROM `admin_team` WHERE `admin_id` = '$admin_id' LIMIT 1";
$q2 = "SELECT * FROM `admin_transactions` WHERE `status` = 'Approved'";
$result = mysqli_query($link, $q1);
$result1 = mysqli_query($link, $q2);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        Transactions
    </title>
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
            <a href="#" class="brand-logo center black-text">Accepted Transactions</a>
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
      <a href="./manage_teams.php">
        <i class="material-icons waves-effect" style="color:purple;">edit</i>Manage Teams</a>
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
        <div class="row center">
            <div class="col s12 l12 m12 ">

            <table class="responsive bordered highlight">
        <thead>
          <tr>
              <th>TEAM MEMBER</th>
              <th>ITEM NAME</th>
              <th>ITEM DESCRIPTION</th>
              <th>ITEM PRICE</th>
              <th>DATE REQUESTED</th>
          </tr>
        </thead>

        <tbody>
        <?php

while ($row1 = mysqli_fetch_assoc($result1)) {
    echo "<tr>
   <td>" . $row1["full_name"] . "</td>
   <td>" . $row1["name"] . "</td>
   <td>" . $row1["description"] . "</td>
   <td>" . $row1["price"] . "</td>
   <td>" . $row1["date_created"] . "</td>
   </tr>";
}
?>
        </tbody>
      </table>


        </div>
    </div>
    <br/>
    <br/>
    <div class="section center">
      <div class="row">
          <div class="container">
              <div class="col m12 l12 s12">
              <button class="waves-effect waves-light btn purple" onclick="printDiv('printable');">Generate Report</button>
              </div>
          </div>
      </div>
    </div>
</body>

</html>