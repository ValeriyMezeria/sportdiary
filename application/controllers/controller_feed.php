<?php
session_start();
include 'application/core/authentification.php';

class Controller_Feed extends Controller
{

	function action_feed()
	{	
		$authentification = new Authentification();
		$auth_opt = $authentification->get_auth_opt();
		
		$model = new Model_Feed();
		
		if(isset($_GET['delete']))
		{
			$model->delete_post($_GET['delete']);
		}
		
		if(isset($_GET['like_post_id']))
		{
			$model->like_post($_GET['like_post_id'], $_SESSION['user_id']);
		}
		
		if(isset($_GET['recieve_comment']))
		{
			$model->add_comment($_GET['recieve_comment']);
		}
		
		if($_GET['recieve_post'] == 1)
		{
			if(isset($_FILES['userfile']['tmp_name']))
			{
				$destination = 'images/'.$_FILES['userfile']['name'];
				move_uploaded_file($_FILES['userfile']['tmp_name'], $destination);
			}
			$model->add_post($destination);
		}
	
		
		$data = $model->get_posts($_SESSION['user_id']);
		
		$this->view->generate('view_feed.php', 'view_skeleton.php', $data, $auth_opt);
	}
}