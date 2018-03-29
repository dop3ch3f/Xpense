<?php
  require "../actions/conn.php";
  session_start();
  extract($_SESSION); 

  $q1="SELECT * FROM `user_team` WHERE `user_id` = '$user_id'";
  $q2="SELECT * FROM `user_receipts`";
  $result = mysqli_query($link,$q1);
  $result1 = mysqli_query($link,$q2);
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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <link href='../../css/materialize.min.css' rel="stylesheet" />
        <link href='../../css/styles.css' rel="stylesheet" />
        <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
        <script src='../../js/jquery-3.3.1.min.js'></script>
        <script src='../../js/materialize.min.js'></script>
        <script src="../../js/printhelper.js"></script>
        <script>
            $(document).ready(function() {
                $('.button-collapse').sideNav({
                    menuWidth: 300,
                    edge: 'left',
                    closeOnClick: true,
                    draggable: true,
                });
                $('.modal').modal({
                    swipeable: true,
                    responsiveThreshold: Infinity,

                });
            });
        </script>
    </head>

    <body>
        <nav>
            <div class="nav-wrapper white">
                <a href="#" class="brand-logo center black-text">Receipts</a>
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
          <img class="circle" src="<?php $row['image_path']; ?>" width="100px" height="100px">
        </a>
                    <h6>
                        <?php echo $row['full_name']; ?>
                    </h6>
                    <h6>
                        <?php echo $row['email']; ?>
                    </h6>
                    <h6>
                        <?php echo $row['team_name']; ?>
                    </h6>
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
            <div class="row center">
                <div class="col s12 l12 m12 ">

                    <table class="responsive bordered highlight">
                        <thead>
                            <tr>
                                <th>RECEIPT IMAGE</th>
                                <th>ITEM NAME</th>
                                <th>ITEM PRICE</th>
                                <th>ITEM DESCRIPTION</th>
                                <th>DATE CREATED</th>
                                <th>RECEIPT DATE</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php  
             while($row1 = mysqli_fetch_assoc($result1)){
               echo "<tr>
               <td><img class='materialboxed center-align' width='100' height='100' src='".$row1['image_path']."'/></td>
               <td>".$row1['name']."</td>
               <td>".$row1['price']."</td>
               <td>".$row1['description']."</td>
               <td>".$row1['date_created']."</td>
               <td>".$row1['date_posted']."</td>
               </tr>
               ";
             }
           ?>
                        </tbody>
                    </table>


                </div>
            </div>
            <br/>
            <div class="section center">
                <div class="row">
                    <div class="container">
                        <div class="col m12 l12 s12">
                            <button class="waves-effect waves-light btn purple modal-trigger" href="#modal1"><i class="material-icons">add</i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <form class="col s12" action="./receipt_upload.php" method="POST" enctype="multipart/form-data">
                <h5>Upload Receipt</h5>
                <br/>
                <div class="row">
                    <div class="file-field input-field">
                        <div class="btn purple">
                            <span>Upload Receipt</span>
                            <input type="file" name="files[]" multiple accept="image/jpg, image/jpeg, image/png" />
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" />
                        </div>
                    </div>
                </div>
                    <?php 
                      $query2 = "SELECT * FROM `user_expenses` WHERE `user_id`='$user_id' AND `receipt_status`='Absent'";
                      $res = mysqli_query($link,$query2);
                      echo  "<div class='row'>
                      <div class='input-field col s12'>
                       <select name='expense_id' >";
                      while($row2 = mysqli_fetch_assoc($res)){
                        echo "<option value='".$row2['expense_id']."'>".$row2['name']." for ".$row2['price']." NGN</option>";
                      } 
                      echo "</select>
                      <label>Target Expense</label>
                    </div>
                   </div>";
                     ?>  
                   <script>
                       $(document).ready(function() {
                           $('select').material_select();
                        });
                   </script>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="description" class="materialize-textarea"></textarea>
                        <label for="description">Description</label>
                    </div>
                </div>
                <div class="row" style="display:none;">
                    <input name="team_id" value="<?php echo $row['team_id']; ?>"/>
                </div>
                <div class="row" style="display:none;">
                    <input name="user_id" value="<?php echo $row['user_id']; ?>"/>
                </div>
           </div>
        <div class="modal-footer">
          <button class="waves-effect purple btn btn-large" type="submit">Submit</button>
          </form>
        </div>
    </div>
    </body>

    
    </html>