<?php

@session_start();
if ( !isset( $_SESSION["username"] ) ) {

	//$_SESSION["username"] = 'Juan Valdez';
	header("Location: ../login"); /* Redirect browser */
	exit();
}
require_once("lib/config.php");

?>