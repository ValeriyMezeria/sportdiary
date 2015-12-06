<?php
session_start();
include 'application/core/authentification.php';

class Controller_Training extends Controller
{

	function action_training()
	{	
		$authentification = new Authentification();
		$auth_opt = $authentification->get_auth_opt();
		
		$model = new Model_Training();
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