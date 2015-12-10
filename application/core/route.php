<?php
session_start();
//require_once 'application/core/authentification.php';

$host = $_SERVER['HTTP_HOST'];

class Route
{

	static function start()
	{
		
		$controller_name = 'Main';
		$action_name = 'index';
		
		$URI = $_SERVER['REQUEST_URI'];
		
		$routes = explode('/', $URI);
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
		
		//var_dump($routes[2]);
		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$routes = explode('?', $routes[2]);
			$action_name = $routes[0];
		}
		
		//echo $routes[0];
		//echo $routes[1];
		//echo $routes[2];
		
		//получаем get-параметры
		/*$options_parts = explode('&',  $URI);
		
		for($i = 1; $i < count($options_parts); $i++)
		{
			$part = explode('=', $options_parts[$i]);
			//var_dump($part);
			$options[$part[0]] = $part[1];
		}
		*/
		
		
		
		
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		
		//echo "Model: $model_name <br>";
		//echo "Controller: $controller_name <br>";
		//echo "Action: $action_name <br>";
		

	
		$model_file = strtolower($model_name).'.php';
		$model_path = "application/models/".$model_file;
		
		
		if(file_exists($model_path))
		{
			include "application/models/".$model_file;
		}
		else
		{
			Route::ErrorPage404();
		}
		
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include "application/controllers/".$controller_file;
		}
		else
		{
			
			Route::ErrorPage404();
		}
		
		
		
		$controller = new $controller_name();
		$action = $action_name;
		

		if(method_exists($controller, $action))
		{
			$authentification = new Authentification();
			
			if($authentification->check() || $controller_name == 'Controller_Main' )	
				$controller->$action();
			else
			{
				$authentification->logout();
				echo '<script type="text/javascript">location.href = "http://sportdiary/Main/index";</script>';
			}
		}
		else
		{
			
			Route::ErrorPage404();
		}
	
	}

	function ErrorPage404()
	{
        echo '<script type="text/javascript">location.href = "http://sportdiary/Feed/404";</script>';
    }
    
}
