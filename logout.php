<?php
	require_once("library/database.php");
	require_once("library/session.php");

	$database = new database();
	$session  = new Session();

	$query = "UPDATE user SET is_online = 0, last_login = '".time()."' WHERE user_id = " . $_SESSION['user']['user_id'];
	$result = $database->execute_query($query);

	if ($result) {
		$session->destroy_session();
		header("location: index.php?message=Your Account Has Been Logged Out Successfully&success=1");
	}
?>