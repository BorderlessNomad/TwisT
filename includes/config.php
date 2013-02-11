<?php
	error_reporting(E_ALL ^ E_NOTICE);
	session_start(); // Start Session
	ob_start();
	header('Cache-control: private'); // IE 6 FIX	
	header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');	// always modified	
	header('Cache-Control: no-store, no-cache, must-revalidate');	// HTTP/1.1
	header('Cache-Control: post-check=0, pre-check=0', false);	
	header('Pragma: no-cache');	// HTTP/1.0
?>