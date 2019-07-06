<?php
	include 'header.php';
	include 'includes/functions.inc.php';
	include 'includes/connect.php';

	$pid = $_GET['postid'];
	$getcomments = "SELECT * FROM comments WHERE post_id = '$pid';";
	$p = (mysqli_query($conn, $getcomments));
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		if(!empty($p)){
			echo ' <div class="card border-success mb-3">
  <div class="card-header"></div>';
			foreach ($p as $comment) {
				echo '<div class="card-body text-success"><h5 class="card-title">'.$comment['user_name'].'</h5>
    		<p class="card-text" style = "color: black;">'.$comment['body'].'</p><br>
  			</div><hr>';
			}
		}
		else{
			echo "no comments";
		}
			
	?>	
</body>
</html>
