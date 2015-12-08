<?php
session_start();
include 'application/core/authentification.php';

class Controller_Profile extends Controller
{
	function action_profile()
	{
		$authentification = new Authentification();
		
		$model = new Model_Profile();
		
		if(isset($_GET['change_avatar']))
		{
			if(isset($_FILES['userfile']['tmp_name']))
			{
				$destination = 'images/'.$_FILES['userfile']['name'];
				move_uploaded_file($_FILES['userfile']['tmp_name'], $destination);
			}
			
			$model->change_avatar($destination);
		}
		
		if(isset($_GET['subscribe']))
			$model->subscribe($_GET['subscribe']);
		
		if(isset($_GET['unsubscribe']))
			$model->unsubscribe($_GET['unsubscribe']);
		
		if(isset($_GET['user_id']))
		{
			if($_GET['user_id'] != $_SESSION['user_id'])
			{
				if($model->is_friend($_GET['user_id']))
					$options['type'] = 'friend';
				
				
				$data = $model->get_user_data($_GET['user_id']);
			}
			else
			{
				$data = $model->get_user_data($_SESSION['user_id']);
				$options['type'] = 'mine';
			}
		}
		else
		{
			$data = $model->get_user_data($_SESSION['user_id']);
			$options['type'] = 'mine';
		}
		
		
		$this->view->generate('view_profile.php', 'view_skeleton.php', $data, $auth_opt, $options);
	}
}