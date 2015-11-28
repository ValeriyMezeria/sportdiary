<?php
session_start();



for($i = 0; $i < count($data); $i++)
{
	echo 	'	ID: '.$data[$i]['id'].'
				<br>First name: '.$data[$i]['first_name'].'
				<br>Last name: '.$data[$i]['last_name'].'
				<hr>
			';
}