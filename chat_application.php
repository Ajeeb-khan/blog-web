<?php
	require_once("library/general.php");
	require_once("library/database.php");
	require_once("library/session.php");

	$database = new database();
	$session  = new Session();

	if (!($session->session_exists())) {
		header("location: index.php?message=Login Into Your Account !...&success=0");
	}
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
		h1{
            color: #00FF00;
            font-size: 36px;
            font-weight: 600;
            letter-spacing: 1px;
/*            margin-bottom: 20px;*/
			padding: 10px;
            text-align: center;
        }
        .h1{
        	background-color: #181818;
        }
        #table{
        	width: 90%; 
        	margin: auto; 
        	margin-top: 60px;
        	border: 2px solid black;
        	border-radius: 16px;
            box-shadow: 0 0 15px #00FF00;
        }
        #td1{
        	width: 70%; 
        	height: 450px; 
        	border: 2px solid black; 
        	position: relative; 
        	top: 0;
        	background-color: #2A2A2A;
        	border-radius: 16px;
        }
        #td2{
        	width: 30%; 
        	height: 450px; 
        	border: 2px solid black; 
        	position: relative; 
        	top: 0;
        	background-color: #2A2A2A;
        	border-radius: 16px;
        }
        #p1{
        	float: right; margin-top: -10px; margin-right: 10px;
        	color: white;
        }
        #user_img{
        	width: 50px; height: 50px; border-radius: 50px;
        }
        #status{
        	width: 5px; font-weight: bolder; height: 5px; 
        }
        .message-container {
			height: 400px;
			display: flex;
			flex-direction: column;
			justify-content: space-between;

/*			background-color: white;*/
		}
		.messages {
			overflow-y: auto; 
			height: 300px;
			display: flex;
			flex-direction: column-reverse; 
			z-index: 10;
		}
		.user-container {
			height: 400px;
/*			background-color: white;*/
			overflow-y: auto; 
		}

		.user {
			height: 100%; 
			padding: 10px; 
		}
		.input-container {
			display: flex;
			align-items: center;
			height: 70px;
			padding: 7px;
		}

		.input-container textarea {
			border: none; 
			resize: none; 
			padding: 10px; 
			border-radius: 15px; 
			flex-grow: 1; 
			margin-right: 10px; 
		}

		.input-container button {
			background-color: #181818; 
			color: #00FF00;
			border: none; 
			border-radius: 25px; 
			padding: 5px 20px; 
			cursor: pointer; 
			font-weight: bold; 
		}
		a{
        	color: #00FF00;
        	font-weight: bolder;
        	text-decoration: none;
        }
	</style>
	<script>
		window.onload = function(){
			show_user();
			show_messages();
		}

		function show_user() {
			var ajax_request = null;

			if (window.XMLHttpRequest) {
				ajax_request = new XMLHttpRequest();
			}
			else{
				ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
			}

			ajax_request.onreadystatechange = function(){
				if (ajax_request.readyState == 4 && ajax_request.status == 200 && ajax_request.statusText == "OK") {
					document.getElementById("show_user").innerHTML = ajax_request.responseText;
				}
			}

			ajax_request.open("GET","ajax_process.php?action=show_user");
			ajax_request.send();
		}

		function show_messages(){
			var ajax_request = null;

			if (window.XMLHttpRequest) {
				ajax_request = new XMLHttpRequest();
			}
			else{
				ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
			}

			ajax_request.onreadystatechange = function(){
				if (ajax_request.readyState == 4 && ajax_request.status == 200 && ajax_request.statusText == "OK") {
					document.getElementById("show_messages").innerHTML = ajax_request.responseText;
				}
			}

			ajax_request.open("GET","ajax_process.php?action=show_messages");
			ajax_request.send();
		}

		function message_sent(){
			var chat_msg = document.getElementById("chat_msg").value;
			var ajax_request = null;
			if (window.XMLHttpRequest) {
				ajax_request = new XMLHttpRequest();
			}
			else{
				ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
			}

			ajax_request.onreadystatechange = function(){
				if (ajax_request.readyState == 4 && ajax_request.status == 200 && ajax_request.statusText == "OK") {
					document.getElementById("message_sent").innerHTML = ajax_request.responseText;
				}
			}

			ajax_request.open("POST","ajax_process.php");
			ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
			ajax_request.send("action=message_sent&chat_msg="+chat_msg);
		}

		var message_interval = null;
		message_interval = setInterval(show_messages,1000);

		var user_interval = null;
		user_interval = setInterval(show_user,1000);
	</script>
</head>
<body>
	<center>
		<div><?= General::site_header();?></div>
		<p id="p1"><b>Welcome: </b><span><?= $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']?></span><a href="logout.php">&nbsp;|&nbsp;Logout</a></p>
		<table id="table">
			<tr>
				<td id="td1">
		            <h1 class="h1">Messages</h1>
		            <div class="message-container">
		                <div id="show_messages" class="messages"></div>
		                <div class="input-container">
		                    <textarea name="message_sent" id="chat_msg" cols="90" placeholder="Type a message..."></textarea>
		                    <button onclick="message_sent()">Send</button>
		                </div>
		                <div id="message_sent"></div>
		            </div>
		        </td>

				<td id="td2">
					<h1 class="h1">Users</h1>
					<div class="user-container"> 
						<div id="show_user" class="user"></div>
					</div>
				</td>
			</tr>
		</table>
	</center>
</body>
</html>