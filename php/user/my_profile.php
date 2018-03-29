<?php
  require "../actions/conn.php";
  session_start();
  extract($_SESSION); 

  $q1="SELECT * FROM `user_team` WHERE `user_id` = '$user_id'";
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
        Profile
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
            <a href="#" class="brand-logo center black-text">Edit Profile</a>
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
        <h6><?php echo $row['email'];?></h6>
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
    <div class="section container">
      <div class="row">
        <div class="col s12 m6 l6">
          <div class="card hoverable center-align">
            <div class="card-stacked">
              <div class="card-header">
                   <br/>
                   <img class="card-header-icon circle" src="<?php echo $row['image_path'];?>" width="150px" height="150px"/>
                   <h5 class="card-header-text"><?php echo $row['team_name']; ?></h5>
              </div>
              <div class="card-content">
                <div class="input-field">
                 <p>Username</p>
                 <input value="<?php echo $row['full_name']; ?>" disabled />
                </div>
                 <br/>
                 <div class="input-field">
                 <p>Email</p>
                 <input value="<?php echo $row['email']; ?>" disabled />
                 </div>
                 
                 <br/>
              </div>
            </div>
          </div>
        </div>
        <div class="col s12 m6 l6">
           <div class="card hoverable center-align">
             <div class="card-stacked">
                <div class="card-content">
                    <p>Repeat values you wish to keep</p>
                  <br/>
                  <form method="POST" action="./update.php" enctype="multipart/form-data">
                    <div class="file-field input-field">
                      <div class="btn purple">
                         <span>Upload Logo</span>
                         <input type="file" name="files[]" multiple accept="image/jpg, image/jpeg, image/png"/>
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate" type="text"/>
                      </div>
                    </div>
                    <div class="input-field">
                      <label>New Username</label>
                      <input name="full_name"type="text"/>
                    </div>
                    <div class="input-field">
                       <label>New Email</label>
                       <input name="email" type="email">
                    </div>
                    <div class="input-field">
                      <label>New Password</label>
                      <input name="password" type="password">
                    </div>
                    <div class="input-field" style="display:none;">
                      <input name="user_id" value="<?php echo $user_id; ?>"/>
                    </div>
                    <div class="input-field">
                      <label>Confirm Password</label>
                      <input name="cpassword" type="password">
                    </div>
                    <button type="submit" class="btn purple">Submit</button>
                  </form>
                </div>
             </div>
           </div>
        </div>
      </div>
    </div>  
</body>
</html>