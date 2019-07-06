<?php

include 'header.php';
echo "<h1 style = 'color:red; position: relative; top:200px; left:200px;'>This page is under construction......</h1>";
if(empty($_SESSION['username'])){
		header('Location: includes/logout.inc.php');
		exit();
		}
?>
