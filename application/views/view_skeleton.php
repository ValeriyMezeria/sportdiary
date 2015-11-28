<?php
session_start();

$host = $_SERVER['HTTP_HOST'];

echo 	'<html>
		<head>
			<link href="http://'.$host.'/css/style.css" rel="stylesheet">
			<meta charset = "utf-8"/>
			<title> My page </title>
		</head>
		<body>
		<div id="menu">
			<div id="nav">

				<ul>
					<li><a href = "#"> News </a></li>
					<li><a href = "#"> Training </a></li>
					<li><a href = "#"> People </a></li>
					<li><a href = "#"> Messages </a></li>
					<li><a href = "#"> Statistica </a></li>
					<li><a href = "#"> Profile </a></li>
					<li><a href = "#"> Setings </a></li>
				</ul>

			</div>
		</div>';
		
		include 'application/views/'.$content_view;
		
echo '	<div id="footer"> footer </div>
		</body>
		</html>
				';