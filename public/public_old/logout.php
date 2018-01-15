<?php
	@session_destroy();
	@session_destroy();

	header("Location: index.php");
	exit();
?>