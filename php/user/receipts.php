<?php
  require "../actions/conn.php";
  session_start();
  extract($_SESSION); 

  $q1="SELECT * FROM `user_team` WHERE `user_id` = '$user_id'";
  $q2="SELECT * FROM `admin_receipt` WHERE `user_id` = '$user_id' AND `rpt_status` = 'Pending' AND `receipt_status` = 'Available'";
  $q4="SELECT * FROM `admin_receipt` WHERE `user_id` = '$user_id' AND `rpt_status` = 'Approved' AND `receipt_status` = 'Available'";
  $q3="SELECT * FROM `admin_receipt` WHERE `user_id` = '$user_id' AND `rpt_status` = 'Declined' AND `receipt_status` = 'Available'";
  $result = mysqli_query($link,$q1);
  $result1 = mysqli_query($link,$q2);
  $result2 = mysqli_query($link,$q4);
  $result3 = mysqli_query($link,$q3);
  $row = mysqli_fetch_assoc($result);
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
                    selectMonths: false, // Creates a dropdown to control month
                    selectYears: false, // Creates a dropdown of 15 years to control year,
                    today: 'Today',
                    clear: 'Clear',
                    close: 'Ok'
                });

            });
        </script>
        <style>
            input {
                color: #2c3e50 !important;
            }
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
            <a href="#" class="brand-logo center"><?php echo $row["team_name"]; ?></a>
            <ul id="nav-mobile" class="left">
                <li>
                    <a data-activates="slide-out" class="button-collapse show-on-large">
                        <i class="fas fa-bars" style="color:whitesmoke;font-size: 1.3em !important;" ></i>
                    </a>
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
                </ul>
            </div>
            <div id="pending" class="col s12">
                <ul class="collapsible" data-collapsible="accordion">
			        <?php
				        while($rpending = mysqli_fetch_assoc($result1)){
					        echo "<li>
<div class='collapsible-header'>
<span style='padding-left:25px;'><strong>".$rpending["name"]."</strong></span>
<span class='badge'>NGN".$rpending["price"]."</span>
</div>
<div class='collapsible-body'>
<span>".$rpending["description"].".".$rpending["date_posted"]."<br/><form method='post' action='./receipt_post.php' enctype='multipart/form-data'><div class='file-field input-field'>
      <div class='btn purple'>
        <span>Attach image</span>
        <input input type='file' name='files[]' multiple accept='image/jpg, image/jpeg, image/png'>
      </div>
      <div class='file-path-wrapper'>
        <input class='file-path validate' type='text'>
      </div>
    </div>
    <button type='submit' class='btn purple' value='".$rpending["receipt_id"]."' name='receipt' >Upload</button>
    </form>
    </span>
    </div>
    </li>";
				        }
			        ?>
                </ul>
            </div>
            <div id="accepted" class="col s12">
                <ul class="collapsible" data-collapsible="accordion">
			        <?php
				        while($raccepted = mysqli_fetch_assoc($result2)){
					        echo "<li>
                        <div class=\"collapsible-header\"><img height='50px' width='50px' alt='Image here' src='".$raccepted["image_path"]."' class=\"materialboxed\"/><span style=\"padding-left: 25px;\">    <strong>".$raccepted["name"]."</strong></span><span class=\"badge\">NGN".$raccepted["price"]."</span></div>
                        <div class=\"collapsible-body\"><span>".$raccepted["description"].".<br/>".$raccepted["date_approved"]."</span></div>
                    </li>";
				        }
			        ?>
                </ul>

            </div>
            <div id="declined" class="col s12">
                <ul class="collapsible" data-collapsible="accordion">
			        <?php
				        while($rdeclined = mysqli_fetch_assoc($result3)){
					        echo "<li>
                        <div class=\"collapsible-header\"><img height='50px' width='50px' alt='Image here' src='".$rdeclined["image_path"]."' class=\"materialboxed\"/><span style=\"padding-left: 25px;\">    <strong>".$rdeclined["name"]."</strong></span><span class=\"badge\">NGN".$rdeclined["price"]."</span></div>
                        <div class=\"collapsible-body\"><span>".$rdeclined["description"].".<br/>".$rdeclined["date_approved"]."</span></div>
                    </li>";
				        }
			        ?>
                </ul>

            </div>
        </div>
    </div>
    </html>