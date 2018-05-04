<?php
	include '../actions/conn.php';
	session_start();
	extract($_SESSION);
	$q1 = "SELECT * FROM `admin_team` WHERE `admin_id` = '$admin_id' LIMIT 1";
	$q2 = "SELECT * FROM `admin_team` WHERE `admin_id` = '$admin_id'";
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
        Manage Teams
    </title>
    <link href='../../css/materialize.min.css' rel="stylesheet"/>
    <link href='../../css/styles.css' rel="stylesheet"/>
    <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
    <script src='../../js/jquery-3.3.1.min.js'></script>
    <script src='../../js/materialize.min.js'></script>
    <script>
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
            var x = div_id;
            if (confirm("Click Cancel to Confirm Values Before Submitting and Click Ok to Submit !!") === true) {
                var form_id = "#" + x + "_form";
                genericAjax(form_id);
            }
        }
        function validateEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
        function validate(x){
            
            for(var i=1;i<4;i++){
               if(validateEmail($("#t"+i).val()) === true){
                  if(issue){
                    var issue = 1;
                  }else{
                    var issue = 0;
                  }
               }else{
                   var issue = 1;
               }
            }
            if(issue === 1){
                if($("#t0").val() === ""){
                    $('#'+x+'_form_response').html("Input company name and valid email address(es)");
                }else{
                    $('#'+x+'_form_response').html("Input valid email address(es)");
                }
            }else{
                submitCall(""+x);
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            $('.button-collapse').sideNav({
                menuWidth: 300,
                edge: 'left',
                closeOnClick: true,
                draggable: true
            });

            $('.modal').modal({
                    dismissible: true, // Modal can be dismissed by clicking outside of the modal
                    opacity: .2, // Opacity of modal background
                    inDuration: 300, // Transition in duration
                    outDuration: 200, // Transition out duration
                    startingTop: '4%', // Starting top style attribute
                    endingTop: '10%' // Ending top style attribute
                }
            );

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
</head>

<body>
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo center">Manage Teams</a>
        <ul id="nav-mobile" class="left ">
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
        <div class="col s12 m12 l12">
			<?php
				while ($row1 = mysqli_fetch_assoc($result1)) {
					echo "<div class='card horizontal hoverable'>
                      <div class='card-stacked'>
                         <div class='card-content'>
                             <p style='color:#2c3e50!important;'>" . $row1['team_name'] . "</p>
                             <div class='fixed-action-btn horizontal' style='position: absolute; display: inline-block; right: 24px;'>
                                 <button class='btn purple modal-trigger' href='#" . $row1['team_id'] . "' >
                                             <i class='far fa-edit'></i>
                                         </button>
                             </div>
                         </div>
                     </div>
                 </div>";
					echo "<div class='modal' id='" . $row1['team_id'] . "'>
                    <div class='modal-content'>
                        <div class='center-align'>
                                <h6 style=\"color :#2c3e50 !important;\"
>Edit Team</h6>
                        </div>
                        
                                <div class='col s12'>
                                        <br/>
                                        <form method='POST' action='./mt_change_name.php'>
                                        <div class='input-field col s12'>
                                            <input name='t_name' type='text' class='validate' placeholder='input new team name'/>
                                            <input name='t_id' type='text' value='" . $row1['team_id'] . "' style='display:none;'/>
                                            <label for='t_name'>Team Name</label>
                                            <button type='submit' class='btn purple center'>Save</button>
                                            <br/>
                                            <br/>
                                        </div>
                                        </form>
                                    </div>
                                    <br/>
                                    <br/>
                                    ";
					
					
					$q3 = "SELECT * FROM `user_team` WHERE `team_name`='" . $row1['team_name'] . "' ";
					$result2 = mysqli_query($link, $q3);
					
					
					while ($row2 = mysqli_fetch_assoc($result2)) {
						echo "         <div  class='col s12'>
                                        <br/>
                                        <h6 style=\"color :#2c3e50 !important;\">Team Members</h6>
                                        <br/>
                                        <ul class='collection'>
                                            <form method='POST' action='./mt_delete_user.php'>
                                            <li class='collection-item'>
                                                <div class='black-text'>" . $row2['full_name'] . ">
                                                   
                                                    <button type='submit' value='" . $row2['user_id'] . "' name='user_id' class='secondary-content btn purple'>
                                                        <i class='far fa-trash-alt'></i>
                                                    </button>
                                                </div>
                                            </li>
                                            </form>
                                        </ul>
                                        
                                    </div>";
					}
					echo "   <div class='center-align'>
                <button class='btn purple center modal-trigger' href='#modal3'>
                    <i class='fas fa-plus'></i>
                </button>
            </div>
            <br/><br/>        </div>
                   </div>";
				}
		       
	
	
	        ?>
            <br/>
            <div class="center-align">
                <button class="btn purple center modal-trigger" href="#modal2">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <br/>
        </div>
    </div>
</div>
</body>

<div id="modal2" class="modal bottom-sheet">
    <div class="modal-content">
        <div class="row">
            <div class="col s12 l8 pull-l2 push-l2 m8 pull-m2 push-m2 center">
                <h5 style="color :#2c3e50 !important;">Create New Team </h5>
                <div id="add_form_response" style="color: #2c3e50 !important;"></div>
                
                <form id="add_form" action="./mt_add_member.php" method="POST">
                        <div class="input-field">
                            <input name="team_name" id="t0" type="text" placeholder="any plc"/>
                            <label for="t0">Team Name</label>
                        </div>
                        <div class="input-field">
                            <input name="admin_id" type="hidden" value="<?php echo $admin_id; ?>"/>
                        </div>
                        <div class="input-field">
                            <input name="mail[]" id="t1" type="email" placeholder="any@any.com"/>
                            <label for="t1">1st Member Email</label>
                        </div>
                        <div class="input-field">
                            <input name="mail[]" id="t2" type="email" placeholder="any@any.com"/>
                            <label for="t2">2nd Member Email</label>
                        </div>
                        <div class="input-field">
                            <input name="mail[]" id="t3" type="email" placeholder="any@any.com"/>
                            <label for="t3">3rd Member Email</label>
                        </div>
                    <button class="btn purple center" id="add_form_button" type="button" onclick="validate('add')">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modal3" class="modal bottom-sheet">
    <div class="modal-content">
        <div class="row">
            <div class="col s12 l8 pull-l2 push-l2 m8 pull-m2 push-m2 center">
                <h5 style="color :#2c3e50 !important;">Add Member </h5>
                <form id="add_form" action="./add_member.php" method="POST">
                    <div class="input-field">
                        <input name="team_id" type="hidden" value="<?php echo $team_id; ?>"/>
                    </div>
                    <div class="input-field">
                        <input name="team_name" type="hidden" value="<?php echo $row1["team_name"]; ?>"/>
                    </div>
                    <div class="input-field">
                        <input name="mail[]" id="t1" type="email" placeholder="any@any.com"/>
                        <label for="t1">1st Member Email</label>
                    </div>
                    <button class="btn purple center" type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
</html>
