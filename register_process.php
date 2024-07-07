<?php
	require_once("library/database.php");

	$database = new database();

	if(isset($_POST['register_form']) && $_POST['register_form'] == "Register"){
		$first_name 	= $_POST['first_name'];
		$last_name  	= $_POST['last_name'];
		$email 			= $_POST['email'];
		$password 		= $_POST['password'];
		$tmp_name 		= $_FILES['profile_image']['tmp_name'];
	    $original_name 	= $_FILES['profile_image']['name'];
	    $file_name 		= time() . " _ " . $_FILES['profile_image']['name'];

	    // print_r($_POST);
	    // print_r($_FILES);
	    // die();

	    $directory = "profile_image";
	    if (!is_dir($directory)) {
	        if (!mkdir($directory)) {
	            echo "Directory Not Found";
	        }
	    }

	    $path = $directory . " / " . $file_name;
	    if (!move_uploaded_file($tmp_name, $path)) {
	        header("location: register.php?message=Error uploading file. Please try again later.&success=0");
	        exit();
	    }

		$query = "INSERT INTO user(first_name, last_name, email, password, profile_image) VALUES('$first_name', '$last_name', '$email', '$password', '$file_name')";
    	$result = $database->execute_query($query);

		if ($result) {
			header("location: index.php?message=Registeration Successfull Please Login Now !...&success=1");	
		}
		else{
			header("location: register.php?message=Registeration Unsuccesful Try Again Later !...&success=0");
		}
	}
?>
