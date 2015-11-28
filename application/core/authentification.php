<?php
session_start();

class Authentification
{
	private $user_id;
	private $user_name;
	private $user_email;
	private $user_type;
	private $user_active;
	
	private $SESSION_VALID_TIME = 6000;
	
	
	private function init()
	{
		$user_id = $_SESSION['user_id'];
		$user_name = $_SESSION['user_name'];
		$user_email = $_SESSION['user_email'];
		$user_type = $_SESSION['user_type'];
		$user_active = $_SESSION['last_active'];
	}
	
	private function check()
	{
		if(isset($_SESSION['user_name']) && !empty($_SESSION['user_name']) && time() - $_SESSION['last_active'] < $this->SESSION_VALID_TIME)
		{
			$_SESSION['last_active'] = time();
			$this->init();
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
		//session_start();
		$this->init();
		$this->check();
	}
	
	function login($name, $password)
	{
		$connection = new mysqli('localhost', 'root', 'valera_1996', 'web');
		$connection->query('SET NAMES utf8;');
		
		$result = $connection->query('SELECT * from users WHERE name=\''.$name.'\' and password=\''.$password.'\';');
		//echo 'SELECT * from users WHERE name=\''.$name.'\' and password=\''.$password.'\';';
		if(isset($result))
		{
			$result = $result->fetch_assoc();
			
			var_dump($result);
			
			$_SESSION['user_id'] = $result['id'];
			$_SESSION['user_name'] = $result['name'];
			$_SESSION['user_email'] = $result['email'];
			$_SESSION['user_type'] = $result['type'];
			$_SESSION['last_active'] = time();
			
			$this->init();
			
			return true;
		}
		else
			return false;
	}
	
	function  logout()
	{
		unset($_SESSION['user_id']);
		unset($_SESSION['user_name']);
		unset($_SESSION['user_email']);
		unset($_SESSION['user_type']);
		
		session_unset();
		#session_destroy();	
	}
	
	function get_user_name()
	{
		return (isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'анонимный пользователь');
	}
	
	function get_user_id()
	{
		return (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null);
	}
	
	function get_auth_opt()
	{
		$auth_opt['user_id'] = $_SESSION['user_id'];
		$auth_opt['user_name'] = (isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'анонимный пользователь');
		$auth_opt['user_email'] = $_SESSION['user_email'];
		$auth_opt['user_type']= $_SESSION['user_type'];
		$auth_opt['user_active'] = $_SESSION['last_active'];
		
		$auth_opt['is_admin'] = $this->is_admin();
		$auth_opt['is_user'] = $this->is_user();
		
		return $auth_opt;
	}
	
	function is_user()
{
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && $_SESSION['user_type'] == 0)
	{
		$connection = new mysqli('localhost', 'root', 'valera_1996', 'web');	
		$connection->query('SET NAMES utf8;');
		$result = $connection->query('SELECT * FROM users WHERE id='.$_SESSION['user_id'].';');
		$arr = $result->fetch_assoc();
		
		if($arr['name'] == $_SESSION['user_name'] && $arr['email'] == $_SESSION['user_email'] && $arr['type'] == $_SESSION['user_type'])
			return true;
		else
			return false;
	}
	else
		return false;
}

	function is_admin()
	{
		if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && $_SESSION['user_type'] == 1)
		{
			$connection = new mysqli('localhost', 'root', 'valera_1996', 'web');	
			$connection->query('SET NAMES utf8;');
			$result = $connection->query('SELECT * FROM users WHERE id='.$_SESSION['user_id'].';');
			$arr = $result->fetch_assoc();
			
			if($arr['name'] == $_SESSION['user_name'] && $arr['email'] == $_SESSION['user_email'] && $arr['type'] == $_SESSION['user_type'])
				return true;
			else
				return false;
		}
		else
			return false;
	}
}