<?php
require '../actions/src/Cloudinary.php';
require '../actions/src/Uploader.php';
error_reporting(E_ALL | E_STRICT);

$servername = "localhost";
$username = "id4885341_root";
$password = "Primobeats1";
$db = "id4885341_xpense_hub";

$link = mysqli_connect($servername,$username,$password,$db);

$host_address="http://localhost/";

$root_folder="xpensehub/";

$mailendpoint="php/actions/register?admin=";

\Cloudinary::config(array(
  "cloud_name" => "dop3ch3f",
  "api_key" => "373565986151316",
  "api_secret" => "yfayDT1PIZIcn1aDfK776UsfHDI"
));


if (!($link)) {
  die("Connection Failed:".mysqli_connect_error());
}
?>