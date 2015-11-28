<?php
session_start();

class Model
{
	protected $connection;
	
	function __construct()
	{
		$this->connection = new mysqli('sql4.freemysqlhosting.net', 'sql497000', 'bGNjUbh2SS', 'sql497000');
		//$this->connection = new mysqli('localhost', 'root', 'valera_1996', 'web');
	}
	
	
		function checkName($name)
	{
		$name_template = '/\w{3,16}/';
		
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		if($connection->query('SELECT * from users WHERE name='.$name.';'))
			return false;
		
		if(preg_match($name_template, $name) == 1)
			return true;
		else 
			return false;
	}

	function checkEmail($email)
	{
		$email_template = '/[A-Za-z0-9]+?\@[A-Za-z]+?\.[A-Za-z]{2,}/';
		
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		if($connection->query('SELECT * from users WHERE email='.$email.';'))
			return false;
		
		if(preg_match($email_template, $email) == 1)
			return true;
		else
			return false;
	}

	function checkText($text)
	{
		$email_template = '/\w{3,1000}/';
		
		if(preg_match($email_template, $text) == 1)
			return true;
		else
			return false;
	}  

	function checkPassword($password)
	{
		$password_template = '/\w{3,16}/';
		
		if(preg_match($password_template, $password) == 1)
			return true;
		else
			return false;
	}

	function checkHeader($header)
	{
		$header = utf8_decode($header);
		if(strlen($header) > 0 && strlen($header) < 256)
			return true;
		else 
			return false;
	}

	function checkLongText($text)
	{
		$text = utf8_decode($text);
		if(strlen($text) > 0 && strlen($text) < 4000000)
			return true;
		else 
			return false;
	}

	function checkFeedbackForm()
	{
		if(isUser())
		{
			if (!checkText($_POST['text']))
				return 3;
			else
				return 0;
		}
		else
		{
			if (!checkText($_POST['text']))
				return 3;
			else if (!checkName($_POST['name']))
				return 1;
			else if (!checkEmail($_POST['email']))
				return 2;
			else 
				return 0;
		}
	}
	
	/*
		Модель обычно включает методы выборки данных, это могут быть:
			> методы нативных библиотек pgsql или mysql;
			> методы библиотек, реализующих абстракицю данных. Например, методы библиотеки PEAR MDB2;
			> методы ORM;
			> методы для работы с NoSQL;
			> и др.
	*/

	// метод выборки данных
	public function get_data()
	{
		// todo
	}
}