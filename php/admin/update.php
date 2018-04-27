<?php
require '../actions/conn.php';
require '../actions/src/main.php';
require '../actions/server.php';

$date = date("Y:m:d");
#insert into db when picture is available
function insert_into_db($options,$post_data){
    extract($options);
    extract($post_data);
    print_r($options);
	require '../actions/conn.php';
     $query = "UPDATE `Admin` SET `full_name`='$full_name',`email`='$email',`password`='$password',`image_path`='$url' WHERE `admin_id`='$admin_id' ";
     if(mysqli_query($link,$query)){
         echo "Your Details have been updated successfully, Redirecting..";
	    header("refresh:2;url=".$server."php/admin/my_profile.php");
     }else{
         echo "Something Went Wrong, Try Again".mysqli_error($link);
	     header("refresh:2;url=".$server."php/admin/my_profile.php");
     }
}
#insert into db when picture is unavailable
function insert_into_db_plain($post_data) {
    extract($post_data);
    require '../actions/conn.php';
	$query = "UPDATE `Admin` SET `full_name`='$full_name',`email`='$email',`password`='$password', WHERE `admin_id`='$admin_id' ";
	if(mysqli_query($link,$query)){
		echo "Your Details have been updated successfully, Redirecting..";
		header("refresh:2;url=".$server."php/admin/my_profile.php");
	}else{
		echo "Something Went Wrong, Try Again";
		header("refresh:2;url=".$server."php/admin/my_profile.php");
	}
}
#upload to cloudinary
function create_photo( $file_path)
{
    # Upload the received image file to Cloudinary
    $result = \Cloudinary\Uploader::upload($file_path, array(
            "tags" => "xpense_hub",
    ));

    unlink($file_path);
    error_log("Upload result: " . \Xpensehub\ret_var_dump($result));
    
    insert_into_db($result,$_POST);
    return $result;
}
#collate Input
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $files = $_FILES["files"];
    $files = is_array($files) ? $files : array( $files );
    foreach ($files["tmp_name"] as $index => $value) {
        if($value != ""){
            create_photo($value);
        }else{
            insert_into_db_plain($_POST);
        } 
    }
}
?>
