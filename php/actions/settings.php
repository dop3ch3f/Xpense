<?php
$servername = "localhost";
$username = "id4885341_root";
$password = "root";
$db = "id4885341_xpense_hub";

$link = mysqli_connect($servername,$username,$password,$db);

$host_address="http://localhost/";

$root_folder="xpensehub/";

$mailendpoint="php/actions/register?admin=";

\Cloudinary::config(array(
  "cloud_name" => "my_cloud_name",
  "api_key" => "123456789012345",
  "api_secret" => "abcdefghijklmnopqrstuvwxyz1"
));


if (!($link)) {
  die("Connection Failed:".mysqli_connect_error());
}
?>