<?php
  /*include '../actions/conn.php';
  session_start();
  extract($_SESSION);
  
  $q1="SELECT * FROM `admin_team` WHERE `admin_id` = '$admin_id' LIMIT 1";
  $q2="SELECT * FROM `admin_team` WHERE `admin_id` = '$admin_id'";
  $result = mysqli($link,$q1);
  $result1 = mysqli($link,$q2);
  $row = mysqli_fetch_assoc($result);
  */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        Manage Teams
    </title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
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
</head>

<body>
    <nav>
        <div class="nav-wrapper white">
            <a href="#" class="brand-logo center black-text">Manage Teams</a>
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
    <div class="section container">
        <div class="row">
            <div class="col s12 m12 l12">
               <?php
                 while($row1=mysqli_fetch_assoc($result1)){
                     echo "
                     <div class='card horizontal hoverable'>
                      <div class='card-stacked'>
                         <div class='card-content'>
                             <h5>".$row1['team_name']."</h5>
                             <div class='fixed-action-btn horizontal' style='position: absolute; display: inline-block; right: 24px;'>
                                 <a class='btn-floating btn-large purple'>
                                     <i class='large material-icons'>menu</i>
                                 </a>
                                 <ul>
                                     <li>
                                         <a class='btn-floating blue modal-trigger' href='#".$row1['team_name']."' data-target='".$row1['team_name']."' class='modal-trigger'>
                                             <i class='material-icons'>edit</i>
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                 </div>";
                 $q3 = "SELECT * `user_team` WHERE `team_name`='".$row1['team_name']."'";
                 $result2 = mysqli_query($link,$q3);
                 while($row2 = mysqli_fetch_assoc($result2))
                 { echo "<div id='".$row1['team_name']."' class='modal'>
                    <div class='modal-content'>
                        <div class='center-align'>
                                <h5>Edit Teams</h5>
                        </div>
                        <ul id='tabs-swipe-demo' class='tabs tabs-fixed-width'>
                            <li class='tab col s6'>
                                <a href='#".$row1['team_name']."1' class='black-text'>Profile</a>
                            </li>
                            <li class='tab col s6'>
                                <a href='#".$row1['team_name']."2' class='black-text'>Team Members</a>
                            </li>
                        </ul>
                        <div class='tabs-content carousel initialized'>
                                <div id='".$row1['team_name']."1' class='col s12'>
                                        <br/>
                                        <br/>
                                        <form method='POST' action='./mt_change_name.php'>
                                        <div class='input-field col s12'>
                                            <input name='t_name' type='text' class='validate'/>
                                            <input name='t_id' type='text' value='".$row1['team_id']."' style='display:none;'/>
                                            <label for='t_name'>Team Name</label>
                                            <button type='submit' class='btn btn-medium waves-effect purple center'>Save</button> 
                                        </div>
                                        </form>
                                    </div>
                                    <div id='".$row1['team_name']."2' class='col s12'>
                                        <br/>
                                        <br/>
                            
                                        <ul class='collection'>
                                            <li class='collection-item'>
                                                <div>".$row2['fullname']."
                                                   <form method='POST' action='./mt_delete_user.php'>
                                                    <button type='submit' value='".$row2['user_id']."' name='user_id' class='secondary-content'>
                                                        <i class='material-icons'>cancel</i>
                                                    </button>
                                                    </form>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                        </div>   
                    </div>
                </div>";
                   } 
                 } 
                 
               ?>
                <br/>
                <div class="center-align">
                    <button class="btn btn-medium waves-effect purple center modal-trigger" href="#modal2">
                        <i class="material-icons">add</i>
                    </button>
                </div>
                <br/>
            </div>
        </div>
    </div>
</body>

<div id="modal2" class="modal">
    <div class="modal-content">
        <div class="center-align">
                <h5>Add Teams</h5>

        </div>
        <div class="row">
         <form action="./mt_add_member.php" method="POST" class="col s12">
           <div class="row">
            <div class="input-field col s12">
              <input name="team_name" id="t0" type="text"/>
              <label for="t0">Team Name</label>
            </div>
           </div>
           <div class="row">
            <div class="input-field col s12">
              <input name="admin_id" type="text" value="<?php echo $admin_id; ?>" />
            </div>
           </div>
           <div class="row">
            <div class="input-field col s12">
              <input name="f_email" id="t1" type="email" placeholder="First Member Email"/>
              <label for="t1">1st Email</label>
            </div>
           </div>
           <div class="row">
            <div class="input-field col s12">
              <input name="s_email" id="t2" type="email" placeholder="Second Member Email"/>
              <label for="t2">2nd Email</label>
            </div>
           </div>
           <div class="row">
            <div class="input-field col s12">
              <input name="t_email" id="t3" type="email" placeholder="Third Member Email"/>
              <label for="t3">3rd Email</label>
            </div>
           </div>
           <button class="btn btn-medium waves-effect purple center" type="submit">Add Team</button>
         </form>
        </div>
    </div>
</div>

</html>