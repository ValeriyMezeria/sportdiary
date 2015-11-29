<?php
session_start();
require_once 'application/core/authentification.php';

class Model_Main extends Model
{
	
	public function try_login($email, $password)
	{	
		$i = 0;
		
		$authentification = new Authentification();
		
		if($authentification->login($email, $password))
			return true;
		else
			return false;
	}
	
	public function try_registration()
	{
		if(!$this->check_name($_POST['first_name']) || !$this->check_name($_POST['last_name']))
			$result = 'Error in name!';
		else if (!$this->check_email($_POST['email']))
			$result = 'Error in e-amil!';
		else if (!$this->check_password($_POST['password']) || !$this->check_password($_POST['repeat_password']) || $_POST['password'] != $_POST['repeat_password'])
			$result = 'Error in password!';
		else if(!$this->check_date($_POST['birth']))
			$result = 'Error in your birthday date!';
		else
		{		
			$result = '';
			
			$connection = $this->connection;
			$connection->query('SET NAMES utf8;');
			$query_result = $connection->query('INSERT INTO users (first_name, last_name, email, password, birthday, height, weight, gender) 
												VALUES(\''.$_POST['first_name'].'\',
														\''.$_POST['last_name'].'\',
														\''.$_POST['email'].'\',
														\''.$_POST['password'].'\',
														\''.$_POST['birth'].'\',
														\''.$_POST['height'].'\',
														\''.$_POST['weight'].'\',
														\''.$_POST['gender'].'\');');
			
			
		}
		
		
		return $result;
		
	}
}


