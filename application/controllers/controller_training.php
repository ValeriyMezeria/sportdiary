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
		
		$options['status'] = $_GET['status'];
		
		if($_GET['status'] == 'done')
			$data = $model->get_training($auth_opt['user_id'], 'done');
		else if ($_GET['status'] == 'sheduled')
			$data = $model->get_training($auth_opt['user_id'], 'sheduled');
		else
		{
			$data = $model->get_training($auth_opt['user_id'], 'missed');
			$options['status'] = 'missed';
		}
		
		
		
		$this->view->generate('view_training.php', 'view_skeleton.php', $data, $auth_opt, $options);
	}
	
	function action_add_training()
	{
		$authentification = new Authentification();
		$auth_opt = $authentification->get_auth_opt();
		$model = new Model_Training();
		$data = $model->get_all_exercises();
		$options['kos'] = $model->get_all_sports();
		
		//var_dump($options);
		if($_GET['recieve'] == 1)
		{
			
			$model->add_training();
			
			$options['result'] = 'Training sucessfully added!';
			$this->view->generate('view_add_training.php', 'view_skeleton.php', $data, $auth_opt, $options);
		}
		else if($_GET['recieve'] == 2)
		{
			$model->add_exercise();
			
			$options['result'] = 'Exercise sucessfully added!';
			$this->view->generate('view_add_training.php', 'view_skeleton.php', $data, $auth_opt, $options);
		}
		else
		{
			$this->view->generate('view_add_training.php', 'view_skeleton.php', $data, $auth_opt, $options);
		}
		
	}

	function action_add_exercise()
	{
		$authentification = new Authentification();
		$model = new Model_Training();
		
		$data = $model->get_all_sports();
		
		if($_GET['recieve'] == 1)
		{
			$model->add_exercise();
			$options['result'] = 'Exercise added!';		}
		
		$this->view->generate('view_add_exercise.php', 'view_skeleton.php', $data, $auth_opt, $options);
	}
}