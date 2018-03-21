<?php
include "../actions/conn.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    extract($_GET);
    $query = "SELECT * FROM `Admin` WHERE `admin_id`='$admin'";
    if ($result = mysqli_query($link, $query)) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $admin_id = $row["admin_id"];
            $query1 = "SELECT * FROM `Teams` WHERE `team_id`='$team_id'";
            if($r = mysqli_query($link,$query1)){
                $row1 = mysqli_fetch_assoc($r);
                $team_name = $r['team_name'];
            }
        }
    }
}
mysqli_close($link);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Xpense Hub Register</title>
        <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
        <link href='../../css/bulma.css' rel="stylesheet" />
        <link href='../../css/styles.css' rel="stylesheet" />
        <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
        <script src='../../js/jquery-3.3.1.min.js'></script>
        <script src='../../js/index.js'></script>
        <script src='../../js/ajaxhelper.js'></script>
    </head>

    <body>
        <section class="hero is-fullheight">
            <div class="hero-head">
                <header class="navbar">
                    <div class="container ">
                        <div class="navbar-brand ">
                            <h5 class=" is-size-4 is-dark" style="padding-top:20px;">Xpense Hub</h5>
                        </div>
                    </div>
                </header>
            </div>
            <div class="hero-body">
                <div class="container">
                <h2 class="subtitle">You are welcome to join the <?php echo $r["team_name"]; ?> team created by <?php echo $row["full_name"]; ?> to register fill the form below</h2>
                <br/>
                    <div class="field">
                        <form method="POST" action="./reg_user.php" >
                            <div class="field">
                                <label class="label">Full Name</label>
                                <div class="control">
                                    <input class="input" type="text" placeholder="John Doe" name="full_name">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Email</label>
                                <div class="control">
                                    <input class="input" type="email" placeholder="any@any.com" name="email">
                                </div>
                            </div>
                            <div class="field" style="display:none;">
                                <div class="control">
                                    <input class="input" type="text" name="team_id" value="<?php echo $row["team_id"]; ?>" />
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Password</label>
                                <div class="control">
                                    <input class="input" type="password" name="password" >
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Confirm Password</label>
                                <div class="control">
                                    <input class="input" type="password" name="cpassword">
                                </div>
                            </div>
                            <div class="field ">
                                <div class="control">
                                    <button type="submit" class="button  is-outlined">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </section>
    </body>

    </html>
