<?php
session_start();

class Model_Main extends Model
{
	
	public function get_data()
	{	
		$i = 0;
		
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		$query_result = $connection->query('SELECT * FROM users;');
		

		
		while($row = $query_result->fetch_assoc())
		{
			$result[$i]['id'] = $row['id'];
			$result[$i]['first_name'] = $row['first_name'];
			$result[$i++]['last_name'] = $row['last_name'];
		}
		
		
		return $result;
	}

}
