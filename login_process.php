<?php
	require_once("library/database.php");
	require_once("library/session.php");

	$database = new database();
	$session  = new Session();

	if(isset($_POST['login_form']) && $_POST['login_form'] == "Login"){
		$email 		= $_POST['email'];
		$password 	= $_POST['password'];

		$query 	= "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
		$result = $database->execute_query($query);

		if ($result->num_rows) {
			$user = mysqli_fetch_assoc($result);
			$session->set_session($user);
			$query = "UPDATE user SET is_online = 1 WHERE user_id = " . $_SESSION['user']['user_id'];
			$result = $database->execute_query($query);
			header("location: chat_application.php");	
		}
		else{
			header("location: index.php?message=Invalid Email/Password Try Again Later !...&success=0");
		}
	}
?>
