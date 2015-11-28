<?php
session_start();

class Controller {
	
	public $model;
	public $view;
	//public $options;//ассоциативный массив с get-параметрами
	
	function __construct()
	{
		//$this->options = $opt;
		$this->view = new View();
	}
	
	// действие (action), вызываемое по умолчанию
	function action_index()
	{
		// todo	
	}
}
