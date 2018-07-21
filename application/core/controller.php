<?php
session_start();

class Controller {
	
	public $model;
	public $view;
	
	function __construct()
	{
		//$this->options = $opt;
		$this->view = new View();
	}
	
	function action_index()
	{
		// todo	
	}
}
