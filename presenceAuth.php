<?php

require_once('lib/Pusher.php');

session_start();

error_log("presenceAuth.php invoked");

$key = "95c1ee6cc09dfd0efb14";
$secret = "e92f4343dc6f2034b020";
$app_id = "34690";

$pusher = new Pusher($key , $secret , $app_id);
$user_id = $_SESSION["pt_userID"];
$presence_data = array('name' => $_SESSION["pt_userName"]);
echo $pusher->presence_auth($_POST['channel_name'], $_POST['socket_id'], $user_id, $presence_data);

//TODO: header("", true, 403); echo "Forbidden"; if not authenticated

?>