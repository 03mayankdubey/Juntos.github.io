<?php

include 'includes/functions.inc.php';
include 'includes/connect.php';
include 'header.php';


$me = $_SESSION['username'];
$getMyphotos = "SELECT photo, photo_id from photos WHERE user_name='$me' ORDER BY photo_id DESC";
$result = ( mysqli_query($conn, $getMyphotos) );
$length = $result;
$val = 1;

echo '<div class="container">
  <div class="row">
    <div class="col-md">';

   foreach ($result as $photo) {
   	if($val%2)
   	echo '<p><form action="galleryprocess.php?pid='.$photo['photo_id'].'&ph='.$photo['photo'].'" method = "post"><img src="'.$photo['photo'].'" style = "width:400px; height:250px;">
   			<button type="submit" name="setdp" class="btn btn-outline-warning" style="position: relative; bottom:45px;float:right;right:147px;"><strong>set as Profile Picture</strong></button>
   			<button type="submit" name="commentbtn" class="btn btn-outline-warning" style="position: relative; bottom:45px;float:right;right:150px;"><strong>Delete</strong></button></p></form>';
   $val++;
   }
   echo'</div>
   <div class="col-md">';
   $val = 0 ;
   foreach ($result as $photo) {
   	if($val%2)
   	echo '<p><form action="galleryprocess.php?pid='.$photo['photo_id'].'&ph='.$photo['photo'].'" method = "post"><img src="'.$photo['photo'].'" style = "width:400px; height:250px;">
   			<button type="submit" name="setdp" class="btn btn-outline-warning" style="position: relative; bottom:45px;float:right;right:147px;"><strong>set as Profile Picture</strong></button>
   			<button type="submit" name="commentbtn" class="btn btn-outline-warning" style="position: relative; bottom:45px;float:right;right:150px;"><strong>Delete</strong></button></p></form>';
   	$val++;
   }
   echo'</div>
  </div>
</div>';
?>

