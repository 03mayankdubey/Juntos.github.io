<?php

session_start();
include 'connect.php';
if(isset($_POST['followBtn']) ){
	if(!$conn){
				echo "connection failed!";
			}
			else{
				$me = $_SESSION['username'];
				$pperson = $_GET['person'];
				$Query = "INSERT INTO followers (user_name, follower) VALUES ('$pperson', '$me');";
				$result = ( mysqli_query($conn, $Query) );
				if($result){
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}else{
					header("Location: ../profile.php?follow=failed");
				}
			}
}
else {
	if(!$conn){
				echo "connection failed!";
			}
			else{
				$me = $_SESSION['username'];
				$pperson = $_GET['person'];
				$Query = "DELETE FROM followers WHERE follower = '$me' AND user_name = '$pperson';";
				$result = mysqli_query($conn, $Query);
				if($result){
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}else{
					header("Location: ../profile.php?follow=failed");
				}
			}

}