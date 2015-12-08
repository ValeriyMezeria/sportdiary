<?php
session_start();

class Model_Profile extends Model
{
	function get_user_data($user_id)
	{
		$i = 0;
		
		
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		$query_result_user = $connection->query('SELECT users.id as id, first_name, last_name, country, city, street, number_home as house, number_apartment as apartment, birthday, height, weight, about_me, avatar
											FROM users LEFT JOIN addresses ON users.id = addresses.user_id
											WHERE users.id = '.$user_id.';');
											
		$query_result_subscribes = $connection->query('SELECT users.id as id, avatar, first_name, last_name FROM followers 
														LEFT JOIN users ON users.id = followers.user_id
														WHERE followers.follower_id = '.$user_id.';');
														
		$query_result_followers = $connection->query('SELECT users.id as id, avatar, first_name, last_name FROM followers 
														LEFT JOIN users ON users.id = followers.follower_id
														WHERE followers.user_id = '.$user_id.';');
														
		$row = $query_result_user->fetch_assoc();
		$result = $row;
		
		while($row = $query_result_subscribes->fetch_assoc())
			$subscribes[$i++] = $row;
		
		$i = 0;
		while($row = $query_result_followers->fetch_assoc())
			$followers[$i++] = $row;
		
		$result['subscribes'] = $subscribes;
		$result['followers'] = $followers;
		
		return $result;
	}
	
	function is_friend($user_id)
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		$query_result = $connection->query('SELECT * FROM followers WHERE user_id = '.$user_id.' AND follower_id = '.$_SESSION['user_id'].';');
		$row = $query_result->fetch_assoc();
		
		if(!empty($row))
			return true;
		else
			return false;
	}
	
	function unsubscribe($user_id)
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		$query_result = $connection->query('DELETE FROM followers WHERE user_id = '.$user_id.' AND follower_id = '.$_SESSION['user_id'].';');
	}
	
	function subscribe($user_id)
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		$query_result = $connection->query('INSERT INTO followers (user_id, follower_id) VALUES ('.$user_id.', '.$_SESSION['user_id'].');');
	}
	
	function change_avatar($new_avatar)
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		$query_result = $connection->query('UPDATE users SET avatar = \''.$new_avatar.'\' WHERE id = '.$_SESSION['user_id'].';');
	}
}