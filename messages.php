<?php
	include 'header.php';
	include 'includes/functions.inc.php';
 ?>

 <!-- first find the friends who sent me the messeges -->
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body style="background: lightgrey;">
<?php
echo '<div style="position: relative; width: 800px; left: 200px; top: 3px;">
 	<div class="card text-center">
  <div class="card-header" style="font-style: italic; font-family: Impact Header;color: blue;"><h1>
    M e s s a g e s</h1>
  </div>
  <div class="card-body">
    <h5 class="card-title">Say Hello To a Friend!!</h5>
    <form action="messageprocess.php" method="post">
  <div class="form-group">
    <input type="text" name="email" class="form-control" id="formGroupExampleInput" placeholder="Enter friends Email">
  </div>
  <div class="form-group">
    <input type="text" name="body" class="form-control" id="formGroupExampleInput2" placeholder="Type Message..">
  </div>
  <button type="submit" class="btn btn-primary">send Message...</button>
</form>
    
  </div>
  <div class="card-footer text-muted">
  </div>
  </div>
</div>';

$messages = getAllConversations();
foreach ($messages as $message) {
		# $messages[0] is details of messages I sent.
		foreach ($message as $m) {
			# code...

			echo '<div style = "padding:5px;"><div class="card-body" style="position:relative; border-radius: 5px; border-style: ridge; padding: 3px; border-width: 2px; border-color: #adad85; box-shadow: 4px 4px; width:600px; left:260px;"><div style="font-style: bold;"><h3>';
			echo $m['reciever']."<-".$m['sender']."</h3></div><br>";
			echo $m['message']."<br>";
			echo'</div></div>';
		}
		
	}

?> 
 </body>
 </html>