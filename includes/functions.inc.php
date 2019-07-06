<?php

function getPosts(){
	include 'includes/connect.php';
				if(!$conn){
					echo "connection failed!";
			}
			$me = $_SESSION['username'];
				/*$PostsTableQuery = " SELECT body, post_date, likes, photo_id, post_id FROM posts WHERE user_name = '$user_namePhp' ORDER BY post_id DESC; ";*/

				$postsofMyFriends = "SELECT posts.post_id, posts.user_name, posts.body, posts.post_date, posts.likes, posts.photo_id FROM posts JOIN followers ON followers.user_name = posts.user_name WHERE followers.follower = '$me' ORDER BY posts.post_id DESC;";
				$result2 = ( mysqli_query($conn, $postsofMyFriends) ); 
				/*$result = ( mysqli_query($conn, $PostsTableQuery) );*/
				if( mysqli_num_rows($result2)>0){
					//var_dump('$result');
					return $result2; 
				}
				else{return 0;}

				}

function getPostsofMine($me){
	include 'includes/connect.php';
				if(!$conn){
					echo "connection failed!";
			}
				$PostsTableQuery = " SELECT body, post_date, likes, photo_id, post_id FROM posts WHERE user_name = '$me' ORDER BY post_id DESC; ";
				$result = ( mysqli_query($conn, $PostsTableQuery) );
				if( mysqli_num_rows($result)>0){
					//var_dump('$result');
					return $result; 
				}
				else{return 0;}

				}

function getFriendsDetails(){
	include 'includes/connect.php';
	$user = $_SESSION['username'];
	$searchWhomIFollowQuery = " SELECT user_name FROM followers WHERE follower = '$user'; ";
	$result = ( mysqli_query($conn, $searchWhomIFollowQuery) );
				if( mysqli_num_rows($result)>0){
					return $result;}
				else{return 0;}
}

function getWhoFollowMe()
{
	include 'includes/connect.php';
	$user = $_SESSION['username'];
	$searchWhomIFollowQuery = " SELECT follower FROM followers WHERE user_name = '$user'; ";
	$result = ( mysqli_query($conn, $searchWhomIFollowQuery) );
				if( mysqli_num_rows($result)>0){
					return $result;}
				else{return 0;}

}

function getUserDetails($user_namePhp){
	include 'includes/connect.php';
	$searchUserFLName = "SELECT firstName FROM user_profile WHERE user_name ='$user_namePhp'; ";
	$result = ( mysqli_query($conn, $searchUserFLName) );
	if( mysqli_num_rows($result)> 0){
					return $result;}
				else{return 0;}
}

function getThoughtStatementArea($user_namePhp){
	include 'includes/connect.php';
	$ThoughtsTable = "SELECT body, updateDate, agreeCounts FROM thoughtstatement WHERE user_name ='$user_namePhp'; ";
	$result = ( mysqli_query($conn, $ThoughtsTable) );
	if( mysqli_num_rows($result)> 0){
					return $result;}
				else{return 0;}

}

function getAllConversations(){
	include 'includes/connect.php';
	$user_namePhp = $_SESSION['username'];
	$sentMessages = "SELECT sending_date, message, reciever, sender FROM messages WHERE sender ='$user_namePhp'; ";
	$recievedMessages = "SELECT sending_date, message, sender, reciever FROM messages WHERE reciever ='$user_namePhp'; ";
	$resultSentMessages = ( mysqli_query($conn, $sentMessages) );
	$resultRecievedMessages = ( mysqli_query($conn, $recievedMessages) );
	$result = array($resultSentMessages, $resultRecievedMessages);
	if($result){
				return $result;}
				else{return 0;}
}

function searchPeople($input){
	
	include 'includes/connect.php';
	$user = $_SESSION['username'];
	$tokenCount= count($input);
	echo "$tokenCount";
	if($tokenCount>1){
		//take only first 2 tokens and search them..
		$name1 = strtolower($input[0]);
		$name2 = '%'.strtolower($input[1]).'%';
		$name1 = '%'.$name1.'%';
		$searchResult = " SELECT user_name, firstName, lastName, gender, birthday FROM user_profile WHERE  firstName LIKE '$name1' OR lastName LIKE '$name2' OR firstName LIKE '$name2' OR lastName LIKE '$name1'; ";

	}
	elseif($tokenCount==1)
	{
		$name = strtolower($input[0]);
		$name = '%'.$name.'%';
		$searchResult = " SELECT user_name, firstName, lastName, gender, birthday FROM user_profile WHERE  firstName LIKE '$name' OR lastName LIKE '$name';";

	}
	$result = ( mysqli_query($conn, $searchResult) );
				if( mysqli_num_rows($result)>0){
					return $result;}
				else{return 0;}
}

function getPhotoDetailsbyName($photo){
	include 'includes/connect.php';
	$searchResult = "SELECT photo_id FROM photos WHERE photo = '$photo' ;";
	$result = ( mysqli_query($conn, $searchResult) );
		$result1 = mysqli_fetch_array($result);
		if( mysqli_num_rows($result)>0){
					return $result1;}
				else{return 0;}

}
function getMyphotosSrc($user){
	include 'includes/connect.php';
	$searchResult = "SELECT photo FROM photos WHERE user_name = '$user' ORDER BY photo_id DESC;";
	$result = mysqli_query($conn, $searchResult);
		if( mysqli_num_rows($result)>0){
					return $result;}
				else{return 0;}

}

function checkIfIfollow($user){
	include 'includes/connect.php';
	$me = $_SESSION['username'];
	$x = "SELECT user_name FROM followers WHERE user_name = '$user' AND follower = '$me';";
	$result = mysqli_fetch_assoc( mysqli_query($conn, $x) );
	//print_r($result);
	if ($result['user_name'] == $user){
		return 1;
	}
	else{
		return 0;
	}
}

function getProfilePic($user){
	include 'includes/connect.php';
	$profpic = "SELECT photos.photo FROM photos JOIN user_profile ON photos.photo_id = user_profile.photo_id WHERE user_profile.user_name = '$user';";
	$profilepic = mysqli_fetch_array(mysqli_query($conn, $profpic));
	return($profilepic);
}


/*function updateFollowButton($subjectUser){
	include 'includes/connect.php';
	$searchResult = "SELECT follower FROM followers WHERE user_name = '$subjectUser';";
	$result = mysqli_query($conn, $searchResult);
		if( mysqli_num_rows($result)>0){

				}
				



}*/