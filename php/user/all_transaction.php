<?php
  session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        All Transactions
    </title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href='../../css/materialize.min.css' rel="stylesheet" />
    <link href='../../css/styles.css' rel="stylesheet" />
    <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
    <script src='../../js/jquery-3.3.1.min.js'></script>
    <script src='../../js/materialize.min.js'></script>
    <script src="../../js/printhelper"></script>
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
            <a href="#" class="brand-logo center black-text">All Transactions</a>
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
          <img class="circle" src="../../img/XPENSE LOGO.png" width="100px" height="100px">
        </a>
        <h6>John Doe</h6>
        <h6>jdandturk@gmail.com</h6>
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
    <div class="section container" id="printable">
    <div class="row">
    <form class="col s12 l12 m12">
        <div class="input-field col m10 s10 l10">
          <input id="icon_prefix" type="text" class="">
        </div>
        <div class="input-field col m2 s2 l2">
          <a class="waves-effect purple waves-light btn large"><i class="material-icons">search</i></a>
        </div>
    </form>
  </div>
      <div class="row center">
          <div class="col s12 l12 m12">
          <table class="responsive bordered highlight">
        <thead>
          <tr>
              
              <th>ITEM NAME</th>
              <th>ITEM PRICE</th>
              <th>DATE REQUESTED</th>
              <th>STATUS</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            
            <td>Eclair</td>
            <td>$0.87</td>
            <td>May 5, 2000</td>
            <td>Approved</td>
            
          </tr>
          <tr>
            
            <td>Jellybean</td>
            <td>$3.76</td>
            <td>May 5, 2000</td>
            <td>Rejected</td>
          </tr>
          <tr>
            
            <td>Lollipop</td>
            <td>$7.00</td>
            <td>May 5, 2000</td>
            <td>Approved</td>
          </tr>
        </tbody>
      </table>
          </div>

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