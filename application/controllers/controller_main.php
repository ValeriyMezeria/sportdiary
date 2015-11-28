<?php
session_start();
include 'application/core/authentification.php';

class Controller_Main extends Controller
{

	function action_index()
	{	
		
		
		$model = new Model_Main();
		$data = $model->get_data();
		
		$this->view->generate('view_main.php', 'view_skeleton.php', $data);
	}
}