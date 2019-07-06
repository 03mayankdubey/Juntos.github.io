 <?php
 	include 'header.php';
	include 'includes/functions.inc.php';
	if(empty($_SESSION['username'])){
		header('Location: includes/logout.inc.php');
		exit();
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>

 </head>
 <body style="background-color: lightgrey;">
 	<div>
 	<?php
	if(isset($_POST['submitSearch']) || (!empty($_SESSION['searchString'])) )
		{
			if (!empty($_SESSION['searchString'])) {
				$reqText = $_SESSION['searchString'];
			}
			else{
				$reqText = $_POST['search'];
				$_SESSION['searchString'] = $reqText;
			}
			$arr = explode(' ',$reqText);

			if( (!empty($arr[0])) ) {
				$searchResult = searchPeople($arr);
			}else{
				echo "<h2>Record not found... :(</h2>";
			}

			if(!empty($searchResult)){

			
			foreach ($searchResult as $user) {
				# code...
				if($user['user_name'] == $_SESSION['username']){continue;}
				error_reporting(E_ALL ^ E_WARNING); 
				$thoughtsTable = mysqli_fetch_assoc(getThoughtStatementArea($user['user_name']));
				$isFollower = checkIfIfollow($user['user_name']);
				

				echo'<br><div class="card bg-dark text-white" style="position: relative; width: 600px; left: 300px; opacity">
  						<img class="card-img" src="uploads/earth1.jpg" alt="Card image" style="position: relative; width: 600px;opacity: 0.3">
  						<div class="card-img-overlay">
    					<h2 class="card-title"><a href="#">'. $user['firstName'].'<br>'.$user['lastName'].'</a></h2>
    					<h4><p class="card-text">'.$thoughtsTable['body'].'</p></h4>
    					<h6><p class="card-text">'.$thoughtsTable['updateDate'].'</p></h6><br>
    					<p class="card-text">Birthday: '.$user['birthday'].'</p>
    					<p class="card-text">User Name: '.$user['user_name'].'</p>
    					<p class="card-text">('.$user['gender'].')</p>
							
						<form action="includes/processFollow.inc.php?person='.$user['user_name'].'" method="post" style="position: relative;left: 380px;bottom: 60px; padding: 3px;">';

						switch($isFollower){
    					case 0: 
    							echo'<button type="submit" class="btn btn-success" name = "followBtn"><strong>Follow</strong></button>';
    							break;
    					case 1:
    							echo'<button type="submit" class="btn btn-warning name = "unfollowBtn""><strong>Unfollow</strong></button>';
    						}

						echo'<button type="submit" class="btn btn-outline-info name = "messageBtn""><strong>Message</strong></button>
						</form>

				  	</div>
					</div>';
				}
			}
			
		}

 ?>
 <br>
			
	</div>
 </body>
 </html>