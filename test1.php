<?php

  $start = time();
  echo "a: " . (time()-$start) . "<br>";
  require("lib/Pusher.php");

  echo "b: " . (time()-$start) . "<br>";
  $pusher = new Pusher("95c1ee6cc09dfd0efb14", "e92f4343dc6f2034b020", "34690");
  echo "c: " . (time()-$start) . "<br>";
  $pusher->trigger("test_channel", "my_event", array( "message" => "hello world"));
  echo "d: " . (time()-$start) . "<br>";


?>