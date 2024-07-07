<?php
	require_once("library/database.php");
	require_once("library/session.php");

	$database = new database();
	$session  = new Session();
	date_default_timezone_set("Asia/karachi");

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "show_user") {
		$query = "SELECT * FROM user WHERE user_id != " .$_SESSION['user']['user_id'];
		$result = $database->execute_query($query);
		if ($result->num_rows) {
			while ($user = mysqli_fetch_assoc($result)) {
			?>
			<table>
				<tr>
					<td><div>&nbsp;<img src="profile_image/<?=$user['profile_image']?>" id= "user_img"></div></td>
					<td><b>&nbsp;&nbsp;<?= $user['first_name'] ." ". $user['last_name']?></b></td>&nbsp;
					<td>&nbsp;&nbsp;<span id="status" style="color:<?= $user['is_online']?"green":"red"?>"><?= $user['is_online']?"Online":"Offline"?></span></td>
				</tr>
				<tr>
								<td colspan="3">
									&nbsp;&nbsp;<span><b style="color:white;">Last Login:</b> <?php echo date("d M Y, h:i:s",$user["last_login"]); ?></span>
									<hr />
								</td>
							</tr>
			</table>
			<?php
			}
		}
	}

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "show_messages") {
    $query = "SELECT * FROM user, chat WHERE user.user_id = chat.sent_by ORDER BY chat_id DESC";
    $result = $database->execute_query($query);

    if ($result->num_rows) {
        while ($data = mysqli_fetch_assoc($result)) {
            $sender_first_name = $data['first_name'];
            $sender_last_name = $data['last_name'];
            $sender_profile_image = $data['profile_image'];

            if ($data['sent_by'] == $_SESSION['user']['user_id']) {
                ?>
                <div style="display: flex; justify-content: flex-end; margin-bottom: 10px; margin-right: 8px;">
                    <div style="background-color: lightblue; padding: 10px; border-radius: 10px;">
                        <div style="display: flex; align-items: center;">
                            <img src="profile_image/<?= $sender_profile_image ?>" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">
                            <strong><?= $sender_first_name . " " . $sender_last_name ?></strong>
                        </div>
                        <p><?= htmlspecialchars($data['chat_msg']) ?></p>
                        <small><?= date('h:i a, d F, Y', $data['sent_on']) ?></small>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div style="display: flex; justify-content: flex-start; margin-bottom: 10px; margin-left: 8px;">
                    <div style="background-color: lightgray; padding: 10px; border-radius: 10px;">
                        <div style="display: flex; align-items: center;">
                            <img src="profile_image/<?= $sender_profile_image ?>" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">
                            <strong><?= $sender_first_name . " " . $sender_last_name ?></strong>
                        </div>
                        <p><?= $data['chat_msg'] ?></p>
                        <small><?= date('h:i a, d F, Y', $data['sent_on']) ?></small>
                    </div>
                </div>
                <?php
            }
        }
    }
}


	if (isset($_POST['action']) && $_POST['action'] == "message_sent") {
		$query = "INSERT INTO chat(chat_msg, sent_by, sent_on) VALUES ('".htmlspecialchars($_POST['chat_msg'])."', '".$_SESSION['user']['user_id']."', '".time()."')";
		$result = $database->execute_query($query);
		echo "<p align = 'center' style = 'color: green;'><b>Message Sent</b></p>";
	}
	

?>