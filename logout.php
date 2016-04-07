<?php
	session_start();
		$_SESSION['logged_in'] = false;
		$_SESSION['usr'] = '';
	header("Location: index.php");
?>
