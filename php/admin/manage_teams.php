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
                <div class="card horizontal hoverable">
                    <div class="card-stacked">
                        <div class="card-content">
                            <h5>Atlas CC</h5>
                            <div class="fixed-action-btn horizontal" style="position: absolute; display: inline-block; right: 24px;">
                                <a class="btn-floating btn-large purple">
                                    <i class="large material-icons">menu</i>
                                </a>
                                <ul>
                                    <li>
                                        <a class="btn-floating blue modal-trigger" href="#modal1" data-target="modal1" class="modal-trigger">
                                            <i class="material-icons">edit</i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="btn-floating red">
                                            <i class="material-icons">cancel</i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card horizontal hoverable">
                    <div class="card-stacked">
                        <div class="card-content">
                            <h5>Paystack</h5>
                            <div class="fixed-action-btn horizontal" style="position: absolute; display: inline-block; right: 24px;">
                                <a class="btn-floating btn-large purple">
                                    <i class="large material-icons">menu</i>
                                </a>
                                <ul>
                                    <li>
                                        <a class="btn-floating blue">
                                            <i class="material-icons">edit</i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="btn-floating red">
                                            <i class="material-icons">cancel</i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
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
<div id="modal1" class="modal">
    <div class="modal-content">
        <div class="center-align">
                <h5>Edit Teams</h5>
        </div>
        
        <ul id="tabs-swipe-demo" class="tabs tabs-fixed-width">
            <li class="tab col s6">
                <a href="#test-swipe-1" class=" black-text">Profile</a>
            </li>
            <li class="tab col s6">
                <a href="#test-swipe-2" class="black-text">Team Members</a>
            </li>
        </ul>
        <div class="tabs-content carousel initialized">
                <div id="test-swipe-1" class="col s12">
                        <br/>
                        <br/>
                        <div class="input-field col s12">
                            <input id="t_name" type="text" class="validate">
                            <label for="t_name">Team Name</label>
                        </div>
                    </div>
                    <div id="test-swipe-2" class="col s12">
                        <br/>
                        <br/>
            
                        <ul class="collection ">
                            <li class="collection-item">
                                <div>Alvin
                                    <a href="#!" class="secondary-content">
                                        <i class="material-icons">cancel</i>
                                    </a>
                                </div>
                            </li>
                            <li class="collection-item">
                                <div>Alvin
                                    <a href="#!" class="secondary-content">
                                        <i class="material-icons">cancel</i>
                                    </a>
                                </div>
                            </li>
                            <li class="collection-item">
                                <div>Alvin
                                    <a href="#!" class="secondary-content">
                                        <i class="material-icons">cancel</i>
                                    </a>
                                </div>
                            </li>
                            <li class="collection-item">
                                <div>Alvin
                                    <a href="#!" class="secondary-content">
                                        <i class="material-icons">cancel</i>
                                    </a>
                                </div>
                            </li>
                        </ul>
            
                    </div>
        </div>
        
    </div>
</div>
<div id="modal2" class="modal">
    <div class="modal-content">
        <div class="center-align">
                <h5>Edit Teams</h5>
        </div>
        
        <ul id="tabs-swipe-demo" class="tabs tabs-fixed-width">
            <li class="tab col s6">
                <a href="#test-swipe-1" class=" black-text">Profile</a>
            </li>
            <li class="tab col s6">
                <a href="#test-swipe-2" class="black-text">Team Members</a>
            </li>
        </ul>
        <div class="tabs-content carousel initialized">
                <div id="test-swipe-1" class="col s12">
                        <br/>
                        <br/>
                        <div class="input-field col s12">
                            <input id="t_name" type="text" class="validate">
                            <label for="t_name">Team Name</label>
                        </div>
                    </div>
                    <div id="test-swipe-2" class="col s12">
                        <br/>
                        <br/>
            
                        <ul class="collection ">
                            <li class="collection-item">
                                <div>Alvin
                                    <a href="#!" class="secondary-content">
                                        <i class="material-icons">cancel</i>
                                    </a>
                                </div>
                            </li>
                            <li class="collection-item">
                                <div>Alvin
                                    <a href="#!" class="secondary-content">
                                        <i class="material-icons">cancel</i>
                                    </a>
                                </div>
                            </li>
                            <li class="collection-item">
                                <div>Alvin
                                    <a href="#!" class="secondary-content">
                                        <i class="material-icons">cancel</i>
                                    </a>
                                </div>
                            </li>
                            <li class="collection-item">
                                <div>Alvin
                                    <a href="#!" class="secondary-content">
                                        <i class="material-icons">cancel</i>
                                    </a>
                                </div>
                            </li>
                        </ul>
            
                    </div>
        </div>
        
    </div>
</div>

</html>