<?php 

	function makeDirectory($userName){
		//$curdir = getcwd();
		
		if(mkdir("./../uploads/".$userName, 0777)){
			echo 'directory could not be created';
		}

	}
	
	if(isset($_POST['submit'])){
		include_once'connect.php';
		date_default_timezone_set('Asia/calcutta');	
			if(!$conn){
			echo "connection failed!";
			}
			else{

				if(empty($_POST['first']) || empty($_POST['uname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['dob']) ){
							header("Location: ../signup.php?signup=empty");
							exit();
				}
				else{	
						$firstN = mysqli_real_escape_string($conn, $_POST['first']);
						$lastN = mysqli_real_escape_string($conn, $_POST['last']);
						$username = mysqli_real_escape_string($conn, $_POST['uname']);
						$emailId = mysqli_real_escape_string($conn, $_POST['email']);
						$passwordd = mysqli_real_escape_string($conn, $_POST['password']);
						$gender = $_POST['optradio'];
						$birthday = $_POST['dob'];
						$today = date("Y-m-d"); 

						//check to validate input
						if(!preg_match("/^[a-zA-Z]*$/", $firstN) || !preg_match("/^[a-zA-Z]*$/", $lastN)){
							header("Location: ../signup.php?signup=invalid");
							exit();
						}else{
							//check if email is valid
							if(!filter_var($emailId, FILTER_VALIDATE_EMAIL)){
								header("Location: ../signup.php?signup=email");
								exit();
							}else{
									//this var is used to check that this user is unique.
									$checkUniqueQuery = " SELECT user_name,email FROM users WHERE user_name='$username' OR email='emailId' ";
									$result = ( mysqli_query($conn, $checkUniqueQuery) );
									$resultCheck = mysqli_num_rows($result);
									
									if($resultCheck > 0){
										header("Location: ../signup.php?signup=undertaken");
										exit();
									}
									else{
										//check if dates are valid allowing all dates right now.
										//ready to insert data..
										$usersQuery = "INSERT INTO users(upassword, user_name, email)  VALUES ('$passwordd', '$username','$emailId');";
										$result = mysqli_query($conn, $usersQuery);
										if(	mysqli_affected_rows($conn) > 0)
										{
											$ProfileUpdateQuery = "INSERT INTO user_profile (user_name, date_create, firstName, lastName, birthday, gender) VALUES ('$username', '$today', '$firstN', '$lastN', '$birthday', '$gender');";

											$result = ( mysqli_query($conn, $ProfileUpdateQuery) );
											if( mysqli_affected_rows($conn) > 0){
												session_start();
												$_SESSION['firstName'] = $firstN;
												$_SESSION['lastName'] = $lastN;
												$_SESSION['username'] = $username;
												makeDirectory($_SESSION['username']);
												header("Location: ../profile.php?login=success");
											}
											else{
												echo "some error occured, deletion of account required!";
												header("Location: ../signup.php?signup=error");
												exit();	
											}

										}
										else{
											header("Location: ../signup.php?signup=error");
											exit();
										}
									}

								}
						}
						//check if userName and Email is unique.
						/*if(( mysqli_query($conn, $usersQuery) )){echo "query accepted! ";}
						else{echo "<br/>query didn't run.";}*/
					}
			}
	}
	else{
		mysqli_close($conn);
		header("Location: ../signup.php");
		exit();
	}
 ?>