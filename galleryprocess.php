<?php

session_start();
include 'includes/functions.inc.php';
include 'includes/connect.php';

$photoid = $_GET['pid'];
$photo = $_GET['ph'];
$me = $_SESSION['username'];

if(isset($_POST['setdp'])){ //SET PROFILE PICTURE...
	$updateQuery = "UPDATE user_profile SET photo_id = '$photoid' WHERE user_name = '$me'; ";
	$result = mysqli_query($conn, $updateQuery);
	if($result){
		header("Location: {$_SERVER['HTTP_REFERER']}");
	}
}

else{ // DELETE THE PICTURE...

	$myposts = getPostsofMine($me);
	$possible = True;
	foreach ($myposts as $post) {
		if($post['photo_id'] == $photoid)
		{
			$possible = False;
			header("Location: {$_SERVER['HTTP_REFERER']}?delete=Fail");
			exit();
		}
	}
	if($possible){
		$deleteQuery = "DELETE FROM photos WHERE photo_id = '$photoid';";
		$result = mysqli_query($conn, $deleteQuery);
		if(!unlink($photo)){
			echo "error!";
		}
		else{
			header("Location: {$_SERVER['HTTP_REFERER']}?delete=Fail");
		}
	}
	
}