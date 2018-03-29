<?php
	require '../actions/conn.php';
	require '../actions/src/main.php';
	
	$date = date("Y:m:d");
	#insert into db when picture is available
	function insert_into_db($options = array(),$post_data = array()){
		extract($options);
		extract($post_data);
		require '../actions/conn.php';
		$query = "UPDATE `Users` SET `full_name`='$full_name',`email`='$email',`password`='$password',`image_path`='$url' WHERE `user_id`='$user_id' ";
		if(mysqli_query($link,$query)){
			echo "Your Details have been updated successfully, Redirecting..";
			header("refresh:2;url=http://localhost/Xpense/php/user/my_profile.php");
		}else{
			echo "Something Went Wrong, Try Again";
			header("refresh:2;url=http://localhost/Xpense/php/user/my_profile.php");
		}
	}
	#insert into db when picture is unavailable
	function insert_into_db_plain($post_data = array()) {
		extract($post_data);
		require '../actions/conn.php';
		$query = "UPDATE `Users` SET `full_name`='$full_name',`email`='$email',`password`='$password' WHERE `user_id`='$user_id' ";
		if(mysqli_query($link,$query)){
			echo "Your Details have been updated successfully, Redirecting..";
			header("refresh:2;url=http://localhost/Xpense/php/user/my_profile.php");
		}else{
			echo "Something Went Wrong, Try Again";
			header("refresh:2;url=http://localhost/Xpense/php/user/my_profile.php");
		}
	}
	#upload to cloudinary
	function create_photo( $file_path)
	{
		$result = \Cloudinary\Uploader::upload($file_path, array(
			"tags" => "XpenseHub",
		));
		
		unlink($file_path);
		error_log("Upload result: " . \Xpensehub\ret_var_dump($result));
		
		insert_into_db($result,$_POST);
		return $result;
	}
	#collate submitted input
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
