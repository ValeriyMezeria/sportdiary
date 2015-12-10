<?php
session_start();
require_once 'application/core/model.php';


class Authentification
{
	private $connection;
	
	private $SESSION_VALID_TIME = 6000;
	
	
	
	public function check()
	{
		if(isset($_SESSION['user_email']) && !empty($_SESSION['user_email']) && time() - $_SESSION['last_active'] < $this->SESSION_VALID_TIME)
		{
			$_SESSION['last_active'] = time();
			return true;
		}
		else
		{
			$this->logout();
			return false;
		}
	}
	
	
	
	
	function __construct()
	{
		$model = new Model();
		$this->connection = $model->get_connection();
			//$this->connection = new mysqli('sql4.freemysqlhosting.net', 'sql497000', 'bGNjUbh2SS', 'sql497000');
		$this->check();
	}
	
	function login($email, $password)
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		$result = $connection->query('SELECT * FROM users WHERE email=\''.$email.'\' and password=\''.$password.'\';');

		
		
		if(isset($result) && !empty($result))
		{
			var_dump($result);
			$result = $result->fetch_assoc();
			if($result == null)
				return false;
			$_SESSION['user_id'] = $result['id'];
			$_SESSION['user_first_name'] = $result['first_name'];
			$_SESSION['user_last_name'] = $result['last_name'];
			$_SESSION['user_email'] = $result['email'];
			$_SESSION['last_active'] = time();
			
			return true;
		}
		else
			return false;
	}
	
	function  logout()
	{
		unset($_SESSION['user_id']);
		unset($_SESSION['user_email']);
		unset($_SESSION['user_first_name']);
        unset($_SESSION['user_last_name']);
		
		session_unset();
		#session_destroy();	
	}
	

	
	function get_auth_opt()
	{
		$auth_opt['user_id'] = $_SESSION['user_id'];
		$auth_opt['user_first_name'] = $_SESSION['user_first_name'];
		$auth_opt['user_last_name'] = $_SESSION['user_last_name'];
		$auth_opt['user_email'] = $_SESSION['user_email'];
		$auth_opt['user_active'] = $_SESSION['last_active'];
		
		return $auth_opt;
	}
	

}