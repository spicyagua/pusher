<?php

//TODO This could be a major annoyance exploit (a "get" link
//somewhere on any page would log someone out).

	require_once("../../test/sso/slo.php");
	
	slo_logout();
	session_start();
	session_destroy();
	header("Location: index.php");	
	die();	
?>