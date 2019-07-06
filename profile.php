<?php
	include 'header.php';
	include 'includes/functions.inc.php';
	include 'includes/connect.php';
	if(empty($_SESSION['username'])){
		header('Location: includes/logout.inc.php');
		exit();
	}
	$me = $_SESSION['username'];
	$thoughtArea =mysqli_fetch_array(getThoughtStatementArea($me));
	$profpic = "SELECT photos.photo FROM photos JOIN user_profile ON photos.photo_id = user_profile.photo_id WHERE user_profile.user_name = '$me';";
	$profilepic = mysqli_fetch_array(mysqli_query($conn, $profpic));
	//var_dump($profilepic);
	if(empty($profilepic)){
		$profilepic['photo'] = "uploads/sample/car.jpg";
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>juntos profile</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body >
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<div class="container-fluid">
	<div class="row">

		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
	  		<div class="carousel-inner" style="height: 400px;">

	  			<?php 
	  				$imgSrc = getMyphotosSrc($_SESSION['username']);
	  				$val = 1;
	  				foreach ($imgSrc as $source) {

	  				if($val)
	  					{echo '<div class="carousel-item active">
	      			<img class="d-block w-100" src="'.$source['photo'].'" alt="First slide">
	    			</div>';
	    			$val = 0;
	    		}
	    		echo '<div class="carousel-item">
	      			<img class="d-block w-100" src="'.$source['photo'].'" alt="">
	    			</div>';
	    			
	    		
	  				}?>
	  				
	  		</div>
	  	<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
	    	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    	<span class="sr-only">Previous</span>
	  	</a>
	  	<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
	    	<span class="carousel-control-next-icon" aria-hidden="true"></span>
	    	<span class="sr-only">Next</span>
	  	</a>
		</div>

	    <div class="col-sm background-dark">
		    
		    <div class="card" style="width: 18rem;position: relative;bottom: 150px;">
		  		<img class='card-img-top' src= <?php echo " \" ".$profilepic['photo']." \" "; ?> >
			  	<div class="card-body">

			    	<h5 style="color: red"> <?php echo '@'.$_SESSION['username']; ?> </h5>
			    	<p class="card-text"> <?php echo $thoughtArea['body']; ?> </p>
		    		<form action="includes/processThought.inc.php" method="post" style="padding: 5px;" >
		    			<div class="form-group" style="width: 240px;">
    					<label for="exampleFormControlTextarea1">UpdateThought!</label>
    					<textarea class="form-control" name="thtBody" id="exampleFormControlTextarea1" rows="1"></textarea>
  				</div>
  				<button type="submit" name="submit" class="btn btn-primary mb-2">updateThought!</button>
		    		</form>
		    		<a href="includes/logout.inc.php" class="btn btn-outline-danger" style="float: right;">Log Out!</a>
		  		</div>
			</div>
			<?php 
			$peopleIFollow = getFriendsDetails();
			foreach ($peopleIFollow as $person) {
				$details = getThoughtStatementArea($person['user_name']);
				$friendThought =mysqli_fetch_array(getThoughtStatementArea($person['user_name']));
				$friendDP = getProfilePic($person['user_name']);
				echo'
				<div class="card" style="width: 15rem;position: relative;bottom: 120px; padding-bottom:15px;">
			  		<img class="card-img-top" src = " '.$friendDP['photo'].' " alt="Card image cap">
				  	<div class="card-body">
				    	<h5 style="color: ">';echo '@'.$person['user_name'];echo'</h5>
				    	<p class="card-text">';echo $friendThought['body']; echo'</p>
			  		</div>
				</div>';
				echo '<br>'; 
			}
			
				?>
	    
	    </div>
	    
	    <div class="col-7" style="position: relative; top: 5px;">
	      <ul class="nav nav-tabs">
			  
			  <li class="nav-item">
			    <a class="nav-link active" href="#">Post</a>
			  </li>
			  
			  <li class="nav-item">
			    <a class="nav-link" href="flwrsflwing.php">Followers</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" href="#">Following..</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" href="gallary.php">Photo gallary</a>
			  </li>
			</ul>
			<div>
				<form action="upload.php" method="post" enctype="multipart/form-data" style="position: relative;top: 5px; border-radius: 5px; border-color:grey; border-style: ridge; padding: 3px; border-width: 2px; border-color: #adad85; box-shadow: 4px 4px;">
					<div class="form-group">
						<textarea class="form-control" name="post" id="exampleFormControlTextarea1" rows="3"></textarea>
      					<input type="file" name="file[]" multiple style="position: relative; float: right; right: 300px; top: 12px;">
      					<button type="submit" name="submit" class="btn btn-primary" style="position: relative; left: 10px;top: 10px;">Post</button>
      				</div>
    			</form>				
			</div>
			<br>
			<!--**Print all the cards** -->
			<?php $postsTable = getPostsofMine($_SESSION['username']);
			error_reporting(E_ALL ^ E_WARNING); 
			foreach ($postsTable as $p ) {
				if(!empty($p[photo_id])){
				 	$pid = $p[photo_id];
				 	$getRelatedPhoto = "SELECT photo FROM photos WHERE photo_id = '$pid';";
				 	$address = mysqli_fetch_assoc(mysqli_query($conn, $getRelatedPhoto));
				 }

				$cardTypes = array("bg-primary mb-3", "bg-secondary mb-3", "bg-success mb-3", "bg-danger mb-3", "bg-warning mb-3", "bg-info mb-3", " bg-dark mb-3");
				$thisCardis = rand(0,6);
				echo'<div  style="padding:3px; position: relative; ">';
					echo '<div class="card text-white '.  $cardTypes[$thisCardis]. '"' . '>';
					echo'<a href="postDetailed.php?postid='.$p[post_id].'"><div class="card-header">'. $_SESSION['emailid'] .'<div style="position:relative; float: right;">'.date("l, jS F H:i", strtotime($p[post_date])).'</div></a></div>';
					  echo'<div class="card-body">';
					   
					    echo'<div><p class="card-text"><h4>'. $p['body'] .'</h4></p>';
					    echo '<form action = "likecomment.php?postid='.$p[post_id].'" method ="post"><div class="form-group" style="position: relative; width: 300px;float: right;">
    			<label for="exampleFormControlTextarea1">Comment</label>
    			<textarea class="form-control" name="commentbody" id="exampleFormControlTextarea1" rows="4"></textarea>
    			<button type="submit" name="commentbtn" class="btn btn-outline-light" ><strong>Comment</strong></button>
  				</div></form></div>';


					    if(empty($p['photo_id'])){ 
					    	
					    	

				}
				else{
					    	echo'<img id="myImg" src="'.$address['photo'].'" alt="Snow" style="width:100%;max-width:300px;">';
					    						
				}

					  echo'</div>';
					echo'</div>';
				echo'</div>';
			}
			
		?>
	    </div>
	    <div class="col-sm">
	    </div>


</div>
</body>
</html>
<!--

	echo '<form action = "likecomment.php" method = "post" style="position: relative; left: 470px;"><button type="submit" class="btn btn-outline-light" name="likebtn"><strong>Like</strong></button>
						<button type="submit" class="btn btn-outline-light" name="commentbtn"><strong>Comment</strong></button></form>';

	if(no photo)
	echo '<button type="submit" class="btn btn-outline-light"><strong>Like</strong></button>';
					echo '<button type="submit" class="btn btn-outline-light" ><strong>Comment</strong></button>'

	<button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>