<?php
session_start();

include 'includes/functions.inc.php';
include 'includes/connect.php';
$target = False;
if(isset($_POST['submit'])){
	$fileSelected = $_FILES['file'];
	$postData = $_POST['post'];


	if(!empty($fileSelected['name'][0])) { //This block will check if photo is related to a post
		//UPLOAD ONLY PICTURE
		//Picture Uploading Section..
		if(!empty($postData)){ //if postData is not empty then first image fill be the post image.
			$target = True;
		}


		foreach ($fileSelected['name'] as $position => $fileName) {

			$destination = 'uploads/'.$_SESSION['username'].'/'.$fileSelected['name'][$position];

		 	if ($fileSelected['error'][$position] == 0) {
		 		if (move_uploaded_file($fileSelected['tmp_name'][$position], $destination)) {
		 			
		 //Update database for this pictures..
		 			$user = $_SESSION['username'];
		 			$ph_name = $fileSelected['name'][$position];
		 			$photo = $destination;
		 			$today = date("Y-m-d h:i:s");
		 			$insertQuery = " INSERT INTO photos(user_name, ph_name, photo, dateofphoto) VALUES ('$user','$ph_name','$photo', '$today');";
					$result = ( mysqli_query($conn, $insertQuery) );
					//now that photo is uploaded, check if this photo is related to a post
					if($target){
						//Update Post Table and insert the photoId of this particular image.
						$postBody = mysqli_real_escape_string($conn, $postData);
						$today = date("Y-m-d h:i:s");
						$userid = $_SESSION['username'];
						$likesInit = 0;
						$photo_id = getPhotoDetailsbyName($photo);
						$insertQuery = " INSERT INTO posts(body, user_name, post_date, likes, photo_id) VALUES ('$postBody','$userid','$today','$likesInit', '$photo_id[0]'); ";
						mysqli_query($conn, $insertQuery);
						$target = False;
						}
					}
		 		}else{
		 			header("Location: profile.php?upload=failed");
		 		}
		 		
		 	}
			header("Location: profile.php?upload=sucess");
		}

		elseif (!empty($postData)) {
					$postBody = mysqli_real_escape_string($conn, $postData);
					$today = date("Y-m-d h:i:s");
					$userid = $_SESSION['username'];
					$likesInit = 0;
					$insertQuery = " INSERT INTO posts(body, user_name, post_date, likes) VALUES ('$postBody','$userid','$today','$likesInit'); ";
					$result = ( mysqli_query($conn, $insertQuery) );
					if($result){
						header("Location: profile.php?upload=sucess");
					}
					else{
						header("Location: profile.php?upload=failed");
					}

			
		}
		

	}


	/*else{
		//echo "file is absent";
		include 'includes/connect.php';
				if(!$conn){
				echo "connection failed!";
				}
				else{
					$postBody = mysqli_real_escape_string($conn, $_POST['postData']);
					$today = date("Y-m-d h:i:s");
					$userid = $_SESSION['username'];
					$likesInit = 0;
					$insertQuery = " INSERT INTO posts(body, user_name, post_date, likes) VALUES ('$postBody','$userid','$today','$likesInit'); ";
					$result = ( mysqli_query($conn, $insertQuery) );
					}
		}
	}*/

