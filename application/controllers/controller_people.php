<?php
session_start();
include 'application/core/authentification.php';

class Controller_People extends Controller
{

	function action_people()
	{	
		$authentification = new Authentification();
		$auth_opt = $authentification->get_auth_opt();
		
		$model = new Model_People();
		
		
		if($_GET['recieve'] == 1)
		{
						
			$data = $model->search_people();
			$options['user_id'] = $_SESSION['user_id'];
			$options['subscribes'] = $model->get_subscribes();

			$this->view->generate('view_people.php', 'view_skeleton.php', $data, $auth_opt, $options);
		}
		else
		{
			$this->view->generate('view_people.php', 'view_skeleton.php', $data, $auth_opt, $options);
		}
		
		
	}
}