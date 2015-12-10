<?php
session_start();
include 'application/core/authentification.php';

class Controller_Statistica extends Controller
{
	function action_sport()
	{
		$authentification = new Authentification();
		$model = new Model_Statistica();
		
		if($_GET['recieve'] == 1)
			$data = $model->get_sport_statistic();
		
		$this->view->generate('view_statistica_sport.php', 'view_skeleton.php', $data, $auth_opt, $options);
	}
	
	function action_exercise()
	{
		$authentification = new Authentification();
		$model = new Model_Statistica();
		
		if($_GET['recieve'] == 1)
			$data = $model->get_exercise_statistic();
		else
			$data = $model->get_all_kos();
		
		$this->view->generate('view_statistica_exercise.php', 'view_skeleton.php', $data, $auth_opt, $options);
	}
	
	function action_people()
	{
		$authentification = new Authentification();
		$model = new Model_Statistica();
		
		$sort_dir = 'DESC';
		if(!isset($_GET['sort_by']))
			$sort_by = 'repetition';
		else
		{
			$sort_by = $_GET['sort_by'];
			if($_GET['sort_dir'] == 'ASC')
				$sort_dir = 'DESC';
			else
				$sort_dir = 'ASC';
		}
		
		$options['sort_dir']  = $sort_dir;
		$options['sort_by'] = $sort_by;
		
		
		if($_GET['recieve'] == 1)
			$data = $model->get_people_statistic($sort_by, $sort_dir);
		else
			$data = $model->get_all_koe(0);
		
		$this->view->generate('view_statistica_people.php', 'view_skeleton.php', $data, $auth_opt, $options);
	}
}