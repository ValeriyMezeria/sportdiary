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
		$data = $model->get_posts();
		
		$this->view->generate('view_feed.php', 'view_skeleton.php', $data, $auth_opt);
	}
}