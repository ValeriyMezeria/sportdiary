<?php
session_start();
include 'application/core/authentification.php';

class Controller_Message extends Controller
{

	function action_message_list()
	{	
		$authentification = new Authentification();
		$auth_opt = $authentification->get_auth_opt();
		
		$model = new Model_Message();
		$data = $model->get_message_list();
		
		$this->view->generate('view_message.php', 'view_skeleton.php', $data, $auth_opt);
	}
}