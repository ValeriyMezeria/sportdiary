<?php
session_start();
include 'application/core/authentification.php';

class Controller_Training extends Controller
{

	function action_training()
	{	
		$host = $_SERVER['HTTP_HOST'];
		$authentification = new Authentification();
		$auth_opt = $authentification->get_auth_opt();
		
		$model = new Model_Training();
		
		if(isset($_GET['add_training_post']))
		{
			$model->add_training_post($_GET['add_training_post']);
			echo '<script type="text/javascript">location.href = "http://'.$host.'/Feed/feed";</script>';
		}
		
		if(isset($_GET['delete_training']))
		{
			$model->delete_training($_GET['delete_training']);
		}
		
		$data = $model->get_training($auth_opt['user_id']);
		
		$this->view->generate('view_training.php', 'view_skeleton.php', $data, $auth_opt);
	}
	
	function action_add_training()
	{
		$authentification = new Authentification();
		$auth_opt = $authentification->get_auth_opt();
		$model = new Model_Training();
		$data = $model->get_all_exercises();
		
		//var_dump($data);
		if($_GET['recieve'] == 1)
		{
			
			$model->add_training();
			
			$options['result'] = 'Training sucessfully added!';
			$this->view->generate('view_add_training.php', 'view_skeleton.php', $data, $auth_opt, $options);
		}
		else
		{
			$this->view->generate('view_add_training.php', 'view_skeleton.php', $data, $auth_opt);
		}
		
	}	
}