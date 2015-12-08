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
	
	function action_message_story()
	{
		$authentification = new Authentification();
		$model = new Model_Message();
		
		if(isset($_GET['companion']))
		{
			if($_GET['recieve'] == 1)
			{
				$model->add_message($_GET['companion']);
			}
			
			$data = $model->get_message_story($_GET['companion']);
			$options['companion'] = $_GET['companion'];
 			$this->view->generate('view_message_story.php', 'view_skeleton.php', $data, $auth_opt, $options);
		}
		else
		{
			
		}
	}
}