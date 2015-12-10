<?php
session_start();

class Model_People extends Model
{
	
	public function search_people()
	{	
		$i = 0;
		
		$name = $_POST['name'];
		$country = $_POST['country'];
		$city = $_POST['city'];
		$gender = $_POST['gender'];
		$min_height = ((!empty($_POST['min_height'])) ? $_POST['min_height'] : 0);
		$max_height = ((!empty($_POST['max_height'])) ? $_POST['max_height'] : 300);
		$min_weight = ((!empty($_POST['min_weight'])) ? $_POST['min_weight'] : 0);
		$max_weight = ((!empty($_POST['max_weight'])) ? $_POST['max_weight'] : 300);

		
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		$query_result = $connection->query('SELECT users.id as id, first_name, last_name, country, city, avatar 
											FROM users left join addresses ON  users.id = addresses.user_id
											WHERE (first_name LIKE \'%'.$name.'%\' OR last_name LIKE \'%'.$name.'%\')
												AND (country LIKE \'%'.$country.'%\' OR country IS NULL) 
												AND (city LIKE \'%'.$city.'%\' OR city IS NULL)
												AND '.$gender.' = 1
												AND height > '.$min_height.' AND height < '.$max_height.'
												AND weight > '.$min_weight.' AND weight < '.$max_weight.';');
		
		while($row = $query_result->fetch_assoc())
		{
			$result[$i]['id'] = $row['id'];
			$result[$i]['user_first_name'] = $row['first_name'];
			$result[$i]['user_last_name'] = $row['last_name'];
			$result[$i]['user_avatar'] = $row['avatar'];
			$result[$i]['user_country'] = $row['country'];
			$result[$i++]['user_city'] = $row['city'];
		}
		
		return $result;
	}
	
	function get_subscribes()
	{
		$i = 0;
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		$query_result = $connection->query('SELECT * FROM followers WHERE follower_id = '.$_SESSION['user_id'].';');
		
		while($row = $query_result->fetch_assoc())
			$result[$i++] = $row;
		
		return $result;
	}

}