<?php
session_start();
require_once 'application/core/authentification.php';


class Controller_Main extends Controller
{

	function action_index()
	{	
		$model = new Model_Main();
		$host = $_SERVER['HTTP_HOST'];
		
		if($_GET['logout'] == 1)
		{
			$authentification = new Authentification();
			$authentification->logout();
		}
		
		if($_GET['recieve'] == 1)
		{
			if($model->try_login($_POST['email'], $_POST['password']))
			{
				$authentification = new Authentification();
				$auth_opt = $authentification->get_auth_opt();
				
				echo '<script type="text/javascript">location.href = "http://'.$host.'/Feed/feed";</script>';
			}
			else
			{
				$options['def_email'] = $_POST['email'];
				$options['result'] = 'Login error!';				
				$this->view->generate('view_main_login.php', 'view_skeleton_main.php', $data, $auth_opt, $options);
			}
		}
		else
		{
			$this->view->generate('view_main_login.php', 'view_skeleton_main.php');
		}
	}
	
	function action_registration()
	{
		$model = new Model_Main();
		$host = $_SERVER['HTTP_HOST'];
		
		if($_GET['recieve'] == 1)
		{
			$options['result'] = $model->try_registration();
			
			if($options['result'] == '')
			{
				$options['result'] = 'Вы успешно зарегистрированы, теперь вы можете войти.';
				$this->view->generate('view_main_login.php', 'view_skeleton_main.php', $data, $auth_opt, $options);
			}
			else
			{
				$this->view->generate('view_main_registration.php', 'view_skeleton_main.php', $data, $auth_opt, $options);
			}
		}
		else
		{
			$this->view->generate('view_main_registration.php', 'view_skeleton_main.php', $data, $auth_opt);
		}
	}
}