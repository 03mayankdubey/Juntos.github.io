<?php
session_start();
if(filter_has_var(INPUT_POST, 'submitPost') ){

		if(!empty($_POST['postData']) ){
			/*provide mechaninsm to insert post into table*/
			include 'includes/connect.php';
			if(!$conn){
			echo "connection failed!";
			}
			else{
				$postBody = mysqli_real_escape_string($conn, $_POST['postData']);
				$today = date("Y-m-d");
				$userid = $_SESSION['username'];
				$likesInit = 0;
				$insertQuery = " INSERT INTO posts(body, user_name, post_date, likes) VALUES ('$postBody','$userid','$today','$likesInit'); ";
				$result = ( mysqli_query($conn, $insertQuery) );
				header('Location: ..profile.php');
			}
		}
	}
else{
	echo "post did not submit";
}