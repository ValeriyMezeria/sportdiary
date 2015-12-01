<?php
session_start();

class Model_Feed extends Model
{
	
	public function get_posts($user_id)
	{	
		$i = 0;
		$user_id = 1;
		
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		$query_result = $connection->query('SELECT posts.id, posts.date, posts.text, posts.is_photos, users.first_name, users.last_name, users.avatar, training.name, training.total_time, training.calories, training.description, training.feeling
											FROM (posts LEFT JOIN users on users.id = posts.user_id) 
														LEFT JOIN training on posts.training_id = training.id
											WHERE posts.user_id = (SELECT follower_id
																  FROM followers
																  WHERE user_id ='.$user_id.' ) OR posts.user_id ='.$user_id.';');
		
		
		while($row = $query_result->fetch_assoc())
		{
			$count_like_result = $connection->query('SELECT count(*) as num FROM likes, posts WHERE posts.user_id = '.$user_id.' AND likes.post_id = '.$row['id'].';');
			$tmp_like = $count_like_result->fetch_assoc();
			
			$count_comment_result = $connection->query('SELECT count(*) as num FROM comments, posts WHERE posts.user_id = 1 AND comments.post_id = 1;');
			$tmp_comment = $count_comment_result->fetch_assoc();
			
			$result[$i]['comments'] = $tmp_comment['num'];
			$result[$i]['likes'] = $tmp_like['num'];
			$result[$i]['date'] = $row['date'];
			$result[$i]['text'] = $row['text'];
			$result[$i]['is_photos'] = $row['is_photos'];
			$result[$i]['user_first_name'] = $row['first_name'];
			$result[$i]['user_last_name'] = $row['last_name'];
			$result[$i]['user_avatar'] = $row['avatar'];
			$result[$i]['training_name'] = $row['name'];
			$result[$i]['training_time'] = $row['total_time'];
			$result[$i]['training_calories'] = $row['calories'];
			$result[$i]['training_description'] = $row['description'];
			$result[$i++]['training_feeling'] = $row['feeling'];
			
		}
		
		
		return $result;
	}

}