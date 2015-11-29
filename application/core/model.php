<?php
session_start();

class Model
{
	protected $connection;
	
	function __construct()
	{
		$this->connection = new mysqli('sql4.freemysqlhosting.net', 'sql497000', 'bGNjUbh2SS', 'sql497000');
	}
	
	function get_connection()
	{
		return $this->connection;
	}
	
	function check_name($name)
	{
		$name_template = '/\w{3,16}/';
		
		
		if(preg_match($name_template, $name) == 1)
			return true;
		else 
			return false;
	}

	function check_email($email)
	{
		$email_template = '/[A-Za-z0-9]+?\@[A-Za-z]+?\.[A-Za-z]{2,}/';
		
		if(preg_match($email_template, $email) == 1)
			return true;
		else
			return false;
	}

	function check_date($date)
	{
		return true;
	}
	
	function check_text($text)
	{
		$email_template = '/\w{3,1000}/';
		
		if(preg_match($email_template, $text) == 1)
			return true;
		else
			return false;
	}  

	function check_password($password)
	{
		$password_template = '/\w{3,16}/';
		
		if(preg_match($password_template, $password) == 1)
			return true;
		else
			return false;
	}

	function check_header($header)
	{
		$header = utf8_decode($header);
		if(strlen($header) > 0 && strlen($header) < 256)
			return true;
		else 
			return false;
	}

	function check_long_text($text)
	{
		$text = utf8_decode($text);
		if(strlen($text) > 0 && strlen($text) < 4000000)
			return true;
		else 
			return false;
	}

	public function get_data()
	{
		// todo
	}
}