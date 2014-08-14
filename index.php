<?php

	require_once("../../test/sso/ssoInc.php");
	
	session_start();
	$_SESSION["pt_userID"] = $user_profile->identifier;
	
	$userName = $user_profile->firstName;
	
	if(!empty($user_profile->lastName)) {
		$userName = $userName . " " . $user_profile->lastName;
	}
	$_SESSION["pt_userName"] = $userName;
?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Pusher Test</title>
  <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.cookie.js"></script>
  <script type="text/javascript" src="js/pusher.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>

  <style type="text/css">
    html, body {
      margin: 0;
    }

  </style>


  <script type="text/javascript">
    // Enable pusher logging - dont include this in production
/*
    Pusher.log = function(message) {
      console.log(message);
    };

    var pusher = new Pusher("95c1ee6cc09dfd0efb14");
    var channel = pusher.subscribe("test_channel");
    channel.bind("my_event", function(data) {
      alert(data.message);
    });
*/
    jQuery(document).ready(function() {
      PT1.app.main(<?=$user_profile->identifier?>);
    });
  </script>
</head>
<body>
  Hi there
  <a href="./logout.php">Logout</a>
</body>
</html>