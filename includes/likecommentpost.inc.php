<?php

include '../header.php';
include 'functions.inc.php';
include 'connect.php';

/*if(isset($_POST['commentbtn'])){
	
}*/
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form action="" method="post" style="width: 500px; position: relative;left: 400px; top: 600px;">
		<textarea class="form-control" name="post" id="exampleFormControlTextarea1" rows="3"></textarea>
		<button type="submit" name="submit" class="btn btn-primary" style="position: relative; left: 10px;top: 10px;">Post Comment</button>
	</form>
</body>
</html>