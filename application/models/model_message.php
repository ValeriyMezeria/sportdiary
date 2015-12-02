<?php
session_start();

class Model_Message extends Model
{
	
	public function get_message_list()
	{	
		$i = 0;
		
		$user_id = $_SESSION['user_id'];
		
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		$query_result = $connection->query('SELECT id, first_name, last_name, avatar
											FROM users
											WHERE users.id IN (SELECT follower_id
																FROM messages
																WHERE user_id = '.$user_id.'
																GROUP BY follower_id);');
		
		
		while($row = $query_result->fetch_assoc())
		{
			$q_res = $connection->query('SELECT avatar, text, date
										FROM messages LEFT JOIN users ON messages.user_id = users.id
										WHERE (user_id = '.$user_id.' AND follower_id = '.$row['id'].') OR (user_id = '.$row['id'].' AND follower_id = '.$user_id.')
										ORDER BY messages.date DESC
										LIMIT 1;');
			$tmp = $q_res->fetch_assoc();
			
			$result[$i]['user_first_name'] = $row['first_name'];
			$result[$i]['user_last_name'] = $row['last_name'];
			$result[$i]['user_avatar'] = $row['avatar'];
			$result[$i]['last_message_avatar'] = $tmp['avatar'];
			$result[$i]['last_message_text'] = $tmp['text'];
			$result[$i++]['last_message_date'] = $tmp['date'];
			
			
		}
		
		
		return $result;
	}

}