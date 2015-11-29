<?php
session_start();
$host = $_SERVER['HTTP_HOST'];

echo '<!DOCTYPE html>
		<html>
		<head>
			<meta charset="UTF-8">
			<title>Login</title>
			<link rel="stylesheet" href="http://'.$host.'/css/style.css" media="screen" type="text/css" />
			
		</head>
		<body style="background-color: #2c3338;">';
		
		include 'application/views/'.$content_view;
		
		echo '	</body>
			</html>
				';