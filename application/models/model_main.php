<?php
session_start();
require_once 'application/core/authentification.php';

class Model_Main extends Model
{
	
	public function try_login($email, $password)
	{		
		$authentification = new Authentification();
		
		if($authentification->login($email, $password))
			return true;
		else
			return false;
	}
	
	public function try_registration()
	{
		
		extract($_POST, EXTR_OVERWRITE);
		
		
		if ($_POST['password'] != $_POST['repeat_password'])
			$result = 'Uncorrect repeating password!';
		else
		{		
			$result = '';
			
			$connection = $this->connection;
			$connection->query('SET NAMES utf8;');
			$query_result = $connection->query('INSERT INTO users (first_name, last_name, email, password, birthday, height, weight, gender) 
												VALUES(\''.$first_name.'\',
														\''.$last_name.'\',
														\''.$email.'\',
														\''.$password.'\',
														\''.$birth.'\',
														\''.$height.'\',
														\''.$weight.'\',
														\''.$gender.'\');');
			

			
			$query_result = $connection->query('SELECT id FROM users ORDER by id DESC LIMIT 1;');	
			$row = $query_result->fetch_assoc();
			$user_id  = $row['id'];
														
			$query_result = $connection->query('INSERT INTO addresses (user_id, country, city, street, number_home, number_apartment)
												VALUES('.$user_id.', \''.$country.'\', \''.$city.'\', \''.$street.'\', \''.$house.'\', '.((isset($apartment))  ? ($apartment) : 'NULL').');');
			
			
		}
		
		
		return $result;
		
	}
}


