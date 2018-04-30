<?php
  include '../actions/conn.php';
  session_start();
  extract($_SESSION);
  $q1="SELECT * FROM `admin_team` WHERE `admin_id` = '$admin_id' LIMIT 1";
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
       User Profile
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
                draggable: true,
            });
            $('.modal').modal({
                swipeable: true,
                responsiveThreshold:Infinity,

            });
        });
    </script>
    <style>
        input {
            color: #2c3e50 !important;
        }
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
    <script>
        function validateEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
        function genericAjax(x) {
            var postData = $(x).serializeArray();
            var formURL = $(x).attr("action");
            $.ajax({
                url: formURL,
                type: "POST",
                data: postData,
                success: function (data, textStatus, jqXHR) {
                    $(x+'_button').hide();
                    $(x+'_response').html(data);
                    $(x+'_response').focus();
                },
                error: function (jqXHR, status, error) {
                    alert('Error please try again');
                    console.log(status + ": " + error);
                }
            });
        }
        function  submitCall(div_id) {
            if (confirm("Click Cancel to Confirm Values Before Submitting and Click Ok to Submit !!") === true) {
                var form_id = "#"+div_id+"_form";
                $(form_id).submit();
            }
        }
        function validate(x){
            if($("#full_name").val() === ""){
               var issue = "Input your username <br/>";
            }
            if($("#email").val() === ""){
                issue += "Input an email address <br/>";
            }
            if(validateEmail($("#email").val()) === false){
                issue += "Input a valid email address<br/>";
            }
            if($("#pwd").val() !== $("#cpwd").val()){
                issue += "Input matching entries in password fields<br/>";
            }
            if(issue){
                $('#'+x+'_form_response').html(issue);
                alert("There are issues in your form");
            }else{
                submitCall(x);
            }
        }
    </script>
</head>
<body>
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo center">Edit Profile</a>
            <ul id="nav-mobile" class="left">
                <li>
                    <a data-activates="slide-out" class="button-collapse show-on-large">
                        <i class="fas fa-bars" style="color:whitesmoke;"></i>
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
        <div class="col s12 m6 push-m3 pull-m3 l6 push-l3 pull-l3 center-align">
          <div class="card-panel center-align">
              <div class="input-field">
                  <img class="card-image-icon circle black-text" src="<?php echo $row['image_path']; ?>" width="150px" height="150px" alt="No Profile Picture"/>
              </div>
              <div class="input-field">
                 <p class="black-text">Username: <?php echo $row['full_name']; ?></p>
              </div>
              <div class="input-field">
                 <p class="black-text">Email: <?php echo $row['email']; ?></p>
              </div>
              <div class="input-field">
                      <button class="btn purple modal-trigger" href="#modal2"><i class="far fa-edit"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
</body>
<div id="modal2" class="modal bottom-sheet">
    <div class="modal-content">
        <div class="row">
            <div class="col s12 l8 pull-l2 push-l2 m8 pull-m2 push-m2 center">
                <p style="color :#2c3e50 !important;">Profile Update</p>
	            
                <div id="update_form_response" style="color: #2c3e50 !important;"></div>
                <form id="update_form" method="POST" action="./update.php" enctype="multipart/form-data">
                    <div class="file-field input-field">
                        <div class="btn purple">
                            <span>Attach Picture</span>
                            <input type="file" name="files[]" value="<?php echo $row['image_path'];?>" multiple accept="image/jpg, image/jpeg, image/png"/>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"  type="text"/>
                        </div>
                    </div>
                    <div class="input-field" style="display:none;">
                        <input type="hidden" name="admin_id" value="<?php echo $row['admin_id']; ?>"/>
                    </div>
                    <div class="input-field">
                        <label>Username:</label>
                        <input placeholder="john doe" id="full_name" type="text" name="full_name" value="<?php echo $row['full_name']; ?>"/>
                    </div>
                    <div class="input-field">
                        <label>Email:</label>
                        <input type="email" id="email" name="email" placeholder="any@any.com" value="<?php echo $row['email']; ?>">
                    </div>
                    <div class="input-field">
                        <label>New Password:</label>
                        <input type="password" id="pwd" name="password" value="<?php echo $row['password']; ?>">
                    </div>
                    <div class="input-field">
                        <label>Confirm Password:</label>
                        <input type="password" id="cpwd" name="cpassword">
                    </div>
                    <button type="button" onclick="validate('update')" id="update_form_button" class="btn purple">Apply</button>
                </form>
            </div>
        </div>
    </div>
</div>
</html>