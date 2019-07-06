<?php

include 'connect.php';
session_start();

if (!empty($_SESSION['username'])) {

	if(isset($_POST['submit'])) {
		$thtBody = $_POST['thtBody'];
		if(empty($thtBody)){
			header("Location: {$_SERVER['HTTP_REFERER']}");
		}else{
			$body = $_POST['thtBody'];
			$me = $_SESSION['username'];
			$query = "UPDATE thoughtstatement SET body = '$thtBody' WHERE user_name = '$me';";
			$result = mysqli_query($conn, $query);
			if(mysqli_affected_rows($conn)>0){
					header("Location: {$_SERVER['HTTP_REFERER']}");
			}else{
				$query = "INSERT INTO thoughtstatement(user_name, body, agreeCounts) VALUES('$me', '$thtBody', 0);";
				$result = mysqli_query($conn, $query);
				if(mysqli_affected_rows($conn)>0){
					header("Location: {$_SERVER['HTTP_REFERER']}");
					}else{
						echo "error..";
				}
			}
		}
	}
}
