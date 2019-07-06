<?php

include 'header.php';
include 'includes/functions.inc.php';
include 'includes/connect.php';
if(empty($_SESSION['username'])){
		header('Location: includes/logout.inc.php');
		exit();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="modal.css">
</head>
<body style="background-color: lightgrey;">

	<?php $posts = getPosts();

  		foreach ($posts as $p) { //l, jS F H:i
  			# code...
  			//$userDetailsPhp = getUserDetails($f['user_name']);
  			error_reporting(E_PARSE);
  			$time = date("l, jS F H:i", strtotime($p['post_date']));
	  			echo'<div class="jumbotron" style="position: relative; width: 80%; left: 110px; top: 4px; padding-bottom: 15px;height:115%;"><h4 style = "float: right;">'.$time.'</h4>';

				  echo'<div style="position:relative; bottom:30px;"><h7 class="display-4"><a href="postDetailed.php?postid='.$p[post_id].'"><p style="font-family: Century Gothic;">'.$p['user_name'].'</p></a></h7>';
				 if(!empty($p['photo_id'])){
				 	$pid = $p['photo_id'];
				 	$getRelatedPhoto = "SELECT photo FROM photos WHERE photo_id = '$pid';";
				 	$address = mysqli_fetch_assoc(mysqli_query($conn, $getRelatedPhoto));
				  	/*echo '<img src=" '.$address['photo'].' " style="left: 800px;width: 500px; height: 300px;">';*/
				  	echo'<img id="myImg" src="'.$address['photo'].'" alt="Snow" style="width:100%;max-width:300px">
						<!-- The Modal -->
						<div id="myModal" class="modal">
						  <span class="close">&times;</span>
						  <img class="modal-content" id="img01">
						  <div id="caption"></div>
					</div>';
				}
				echo'<hr class="my-4">';

				   echo '<div style="width:300px;float:right;">
				  		<form action = "likecomment.php?postid='.$p[post_id].'" method ="post">
				  			<label for="exampleFormControlTextarea1">Comment</label>

    				<textarea class="form-control" name="commentbody" id="exampleFormControlTextarea1" rows="2"></textarea> 

    				<button type="submit" name="commentbtn" class="btn btn-outline-warning" ><strong>Comment</strong></button> </div>

    				</form>';
    				echo'<p class="lead">'.$p['body'].'</p>';
				  echo'<p class="lead">
				    <a class="btn btn-primary btn-lg" href="#" role="button">Like, '.$p['likes'].'</a>
				  </p>';
				echo'</div></div>';
		

			}
  	
	?>
	<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
</body>;

</html>