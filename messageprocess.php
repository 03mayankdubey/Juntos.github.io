<?php

	include 'header.php';
	include 'includes/functions.inc.php';
	include 'includes/connect.php';

	$email = $_POST['email'];
	$body = $_POST['body'];

	echo $email.$body;