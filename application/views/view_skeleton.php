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
					<li><a href = "http://'.$host.'/Feed/feed"> News </a></li>
					<li><a href = "http://'.$host.'/Training/training"> Training </a></li>
					<li><a href = "http://'.$host.'/People/people"> People </a></li>
					<li><a href = "#"> Messages </a></li>
					<li><a href = "#"> Statistica </a></li>
					<li><a href = "#"> Profile </a></li>
					<li><a href = "http://'.$host.'/Main/index?logout=1"> LOG OUT </a></li>
				</ul>
			</div>
			<span>'.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</span>
		</div>
		<div id="main">' ;
		
		include 'application/views/'.$content_view;
		
echo '</div>	
<div id="footer"> footer </div>
		</body>
		</html>
				';