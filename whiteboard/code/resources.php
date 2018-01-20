<?php
	$FLAG = "HackTrinity{ThisWontWorkOnBlackboardSoDontEvenThinkAboutIt}";

	function require_login() {
		$auth_cookie = $_COOKIE['auth'];
		if(!isset($auth_cookie)) {
			header("Location: login.php");
			exit();
		}

		$auth_string = explode(":", $auth_cookie);
		$username = $auth_string[0];
		$password = $auth_string[1];
		$priv = $auth_string[2];

		if($username === "student1" && $password === "password1") {
			return $priv;
		} else {
			header("Location: index.php");
			exit();
		}
	}
?>