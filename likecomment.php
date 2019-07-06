<?php
	include 'header.php';
	include 'includes/functions.inc.php';
	include 'includes/connect.php';
	if(empty($_SESSION['username'])){
		header('Location: includes/logout.inc.php');
		exit();
	}

	if(isset($_POST['commentbtn'])){
	$today = date("Y-m-d");
	$commentBody = $_POST['commentbody'];
	$me = $_SESSION['username'];
	$p_id = $_GET['postid'];
	echo $commentBody.$me.$p_id;
	$queryForcomment = "INSERT INTO comments(comment_date, user_name, body, post_id) VALUES('$today','$me','$commentBody', '$p_id')";
	$result = ( mysqli_query($conn, $queryForcomment) );
	if ($result) {
		header("Location: {$_SERVER['HTTP_REFERER']}");
	}else{
		header("Location: profile.php?comment=failed");
		}
	}

				
 ?>