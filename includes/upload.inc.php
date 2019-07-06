<?php
		
		$submitPost = $_POST['submitPost'];
		//$file = $_FILE
	
		if(filter_has_var(INPUT_POST, '$submitPost') ){
			}

			header('Location: ../profile.php');

		/*<form style="position: relative;top: 5px; border-radius: 5px; border-color:grey; border-style: ridge; padding: 3px; border-width: 2px; border-color: #adad85; box-shadow: 4px 4px;" method="POST" action='<?php if(isset($_POST['submitPost'])){ updatePost($_POST['postData'], $_FILES['fileSelected']); } ?>' enctype="multipart/form-data">
					<div class="form-group">
    					<label for="exampleFormControlTextarea1">How you Doin!</label>
    					<textarea class="form-control" name="postData" id="exampleFormControlTextarea1" rows="3"></textarea>
  					</div>

  					<!-- upload file -->
  					<form method="post" action='<?php if(isset($_POST['submitPost'])){ updatePost($_POST['postData'], $_FILES['fileSelected']); } ?>' enctype="multipart/form-data"><p style="position: relative; float: right; right: 300px; bottom: 2px;"><input type="file" name="fileSelected"></p>
  						<button type="submit" name="submitPost" class="btn btn-primary" style="position: relative; left: 10px; bottom: 4px;">Post</button>
  					</form>
				</form>*/

				/*
					if(empty($postData)){

			}


				*/

			/*<div class="carousel-item">
	      			<img class="d-block w-100" src="uploads/car.jpg" alt="Second slide">
	    		</div>
	    		<div class="carousel-item">
	      			<img class="d-block w-100" src="uploads/earth1.jpg" alt="Third slide">
	    		</div>*/