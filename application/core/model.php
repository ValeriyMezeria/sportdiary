<?php
session_start();

class Model
{
	protected $connection;
	
	function __construct()
	{
		$this->connection = new mysqli('localhost', 'root', 'valera_1996', 'sportdiary');
		//$this->connection = new mysqli('sql4.freemysqlhosting.net', 'sql497000', 'bGNjUbh2SS', 'sql497000');
	}
	
	function get_connection()
	{
		return $this->connection;
	}
	
	//methods for simply database queries
	
	protected function get_data_from_table($table_name, $list_of_fields, $conditions = null,$limit = null)
	{
		$i = 0;
		$this->connection->query('SET NAMES utf8;');
		var_dump('');
		$query_result = $this->connection->query('SELECT '.$list_of_fields.' 
													FROM '.$table_name.' 
													'.((isset($conditions)) ? 'WHERE '.$conditions.'' : '').' 
													'.((isset($limit)) ? 'LIMIT '.$limit.'' : '').';');
		
		while($row = $query_result->fetch_assoc())
			$result[$i++] = $row;
		
		
		return $result;
	}
	
	protected function update_by_id($id, $table_name, $field_name, $new_value)
	{
		$this->connection->query('SET NAMES utf8;');
		
		$query_result = $this->connection->query('UPDATE '.$table_name.' 
													SET '.$field_name.' = \''.$new_value.'\' 
													WHERE id = '.$id.'');
													
		return true;
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