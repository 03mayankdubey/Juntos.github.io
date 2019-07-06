<?php

if( isset($_POST['signup']) ){
	header("Location: ../signup.php");
	exit();
}
if( isset($_POST['submit']) ){
	include_once'connect.php';
	if(!$conn){
			echo "connection failed!";
		}
		else{
				$emailId = mysqli_real_escape_string($conn, $_POST['email']);
				$passwordd = mysqli_real_escape_string($conn, $_POST['password']);

				$checkUser = "SELECT * FROM users WHERE email='$emailId' AND upassword='$passwordd' ";
				$result = mysqli_query($conn, $checkUser);
				$userDetails = mysqli_fetch_all($result, MYSQLI_ASSOC);

				if( mysqli_num_rows($result) ){
						session_start();
						$_SESSION['emailid'] = $_POST['email'];
						$_SESSION['username'] = $userDetails[0]['user_name'];
						header("Location: ../profile.php");
				}
				else{
					header("Location: ../login.php?login=invalidDetails");
					exit();
				}
			}
	}
else{
	header("Location: ../login.php");
	exit();
}