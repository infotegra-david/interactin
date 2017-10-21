<?php

@session_start();

if ( !isset( $_SESSION["username"] ) ) {
	$actual_url = $_SERVER['PHP_SELF'];
	$urlsValidas = array('', '/', '/interactin/', '/interactin', '/interactin/index.php', '/interactin/index.php?logout=1', '/interactin/login.php', '/index.php', '/index.php?logout=1', '/login.php');

	//print_r(array_search($actual_url, $urlsValidas));
	
	if ( !array_search($actual_url, $urlsValidas) ) {
		header("Location: login.php"); /* Redirect browser */
		exit();
	}
}

require_once("lib/config.php");

?>