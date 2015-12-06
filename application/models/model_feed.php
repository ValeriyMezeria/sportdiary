<?php
session_start();

class Model_Feed extends Model
{
	
	public function get_posts($user_id)
	{	
		$i = 0;
		
		//$user_id = 1;
		
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		$query_result = $connection->query('SELECT posts.id as id, posts.date as date, text, is_photos, first_name, last_name, avatar, name, total_time, calories, description, feeling
											FROM posts LEFT JOIN users ON users.id = posts.user_id 
														LEFT JOIN training ON posts.training_id = training.id
											WHERE posts.user_id IN (SELECT user_id
																  FROM followers
																  WHERE follower_id ='.$user_id.' ) OR posts.user_id ='.$user_id.' ORDER BY id DESC;');
		
		

		
		while($row = $query_result->fetch_assoc())
		{
			
			$tmp_like = null;
			$count_like_result = $connection->query('SELECT count(*) as num FROM likes WHERE post_id = '.$row['id'].';');
			$tmp_like = $count_like_result->fetch_assoc();
			
			$tmp_comment_num = null;
			$count_comment_result = $connection->query('SELECT count(*) as num FROM comments WHERE comments.post_id = '.$row['id'].';');
			$tmp_comment_num = $count_comment_result->fetch_assoc();
			
			
			
			
			$j = 0;
			$photos = null;
			$tmp_photo_result = $connection->query('SELECT photo FROM photos WHERE post_id = '.$row['id'].';');
			while($tmp_photo = $tmp_photo_result->fetch_assoc())
				 $photos[$j++] = $tmp_photo['photo'];
			 
			$j = 0;
			$comments = null;
			$tmp_comment_result = $connection->query('SELECT text, date, first_name, last_name, avatar FROM comments 
													  LEFT JOIN users ON comments.user_id = users.id 
													  WHERE post_id = '.$row['id'].';');
			while($tmp_comment = $tmp_comment_result->fetch_assoc())
				 $comments[$j++] = $tmp_comment;
			
			$result[$i] = $row;
			$result[$i]['photos'] = $photos;
			$result[$i]['comments'] = $comments;
			$result[$i]['comments_num'] = $tmp_comment_num['num'];
			$result[$i++]['likes'] = $tmp_like['num'];
		}
		
		return $result;
	}
	
	function delete_post($post_id)
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		
		$connection->query('DELETE FROM photos WHERE post_id='.$post_id.';');
		$connection->query('DELETE FROM likes WHERE post_id='.$post_id.';');
		$connection->query('DELETE FROM comments WHERE post_id='.$post_id.';');
		$connection->query('DELETE FROM posts WHERE id='.$post_id.';');
	}
	
	function is_liked_post($post_id, $user_id)
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		$query_result = $connection->query('SELECT * FROM likes WHERE post_id = '.$post_id.' AND user_id = '.$user_id.';');
		$result = $query_result->fetch_assoc();
		
		if(isset($result))
		{
			return true;
		}
		else
			return false;
	}
	
	function like_post($post_id, $user_id)
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		if($this->is_liked_post($post_id, $user_id))
		{
			$connection->query('DELETE FROM likes WHERE post_id = '.$post_id.' AND user_id = '.$user_id.';');
		}
		else
		{
			$connection->query('INSERT INTO likes (post_id, user_id) VALUES(\''.$post_id.'\', \''.$user_id.'\');');
		}
		
		
	}
	
	function add_comment($post_id)
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		extract($_POST, EXTR_OVERWRITE);
		
		$connection->query('INSERT INTO comments (user_id, text, post_id) VALUES('.$_SESSION['user_id'].', \''.$text.'\', '.$post_id.')');
	}
	
	function add_post($photo_path)
	{
		$connection = $this->connection;
		$connection->query('SET NAMES utf8;');
		
		extract($_POST, EXTR_OVERWRITE);
		
		
		if(isset($photo_path) && $photo_path != 'images/')
			$is_photo = 1;
		else
			$is_photo = 0;
		
		$connection->query('INSERT INTO posts (text, is_photos, user_id) VALUES(\''.$text.'\', '.$is_photo.', '.$_SESSION['user_id'].')');
		
		$query_result = $connection->query('SELECT id FROM posts ORDER BY id DESC;');
		$row = $query_result->fetch_assoc();
		$post_id = $row['id'];
		
		if($is_photo == 1)
			$connection->query('INSERT INTO photos (post_id, photo) VALUES('.$post_id.', \''.$photo_path.'\');');
	}
}