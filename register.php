<?php
	require_once("library/general.php");
	require_once("library/forms.php");
	require_once("library/database.php");

	$database = new database();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= General::site_title(); ?></title>
	<style>
		*{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body{
            align-items: center;
            background-color: #181818;
            display: flex;
            justify-content: center;
            min-height: 110vh;
        }
        .container{
            background-color: #222222;
            padding: 30px;
            height: auto;
            width:  350px;
            border-radius: 16px;
            box-shadow: 0 0 15px #00FF00;
        }
        form{
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        h1{
            color: #00FF00;
            font-size: 36px;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 20px;
            text-align: center;
        }
        input[type='email'],input[type='password'], input[type='text'], input[type='file'] {
            background-color: #333333;
            width: 100%;
            height: 45px;
            border: none;
            outline:none;
            border-radius: 6px;
            font-size: 16px;
            padding-left: 12px;
            color: #D6D6D6;
        }

        input[type='submit']{
            width: 100%;
            height: 45px;
            color: #181818;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.5px;
            border: none;
            outline:none;
            background-color: #00FF00;
            border-radius: 6px;
            cursor: pointer;
            transition: all ease .5s;
        }
        input[type='submit']:hover{
            color: #00FF00;
            font-weight: 500;
            border: 2px solid #00FF00;
            box-shadow: 0 0 8px #00FF00;
            background-color: #222222;
        }

        .rememberMe{
            display: flex;
            align-items: center;
            justify-content: center;
            color: #D6D6D6;
        }
        input[type='checkbox']{
            margin-left: 10px;
            accent-color: #00FF00;
            width: 16px;
            height: 16px;
        }
        .label{
            display: flex;
            justify-content: space-between;
            color: #00FF00;
            letter-spacing: 0.5px;
        }
        .message{
            text-align: center;
            font-size: 16px;
            color: #00FF00;
            margin-top: 10px;
            letter-spacing: 0.5px;
        }
        a{
        	color: #00FF00;
        	text-decoration: none;
        }
	</style>
</head>
<body>
	<center>
	<div><?= General::site_header();?></div>
	<div>
		<?php
		$forms = new Forms("register_process.php", "POST");

		$forms->register_form();
	?>
	</div>
	</center>
</body>
</html>