<?php
include "../actions/conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    if ($password == $cpassword && ($password != '' && $cpassword != '')) {
        $q = "INSERT INTO `Users`(`team_id`, `full_name`, `email`, `password`) VALUES ('$team_id','$full_name','$email','$password')";
        if (mysqli_query($link, $q)) {
            $q1 = "SELECT * FROM `Users` WHERE `email`='$email' AND `password`='$password' LIMIT 1";
            if ($r = mysqli_query($link, $q1)) {
                $row1 = mysqli_fetch_assoc($r);
                $_SESSION['user_id'] = $row1["user_id"];
                echo "Registered Succesfully. Redirecting to your Page";
                header("refresh:3;url=http://localhost/Xpense/php/user/main.php");

            } else {
                echo "Error....";
            }

        } else {
            echo 'Error. Try Again';
        }
    }
}
