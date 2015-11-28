<?php
session_start();

class View
{
	
	/*
	$content_file - виды отображающие контент страниц;
	$template_file - общий для всех страниц шаблон;
	$data - массив, содержащий элементы контента страницы. Обычно заполняется в модели.
	$auth_opt - параметры сессии, аутентификация
	$opt - дополнительные параметры
	*/
	function generate($content_view, $template_view, $data = null, $auth_opt = null, $options = null)
	{
		
		/*
		if(is_array($data)) {
			
			// преобразуем элементы массива в переменные
			extract($data);
		}
		*/
		
		//echo $template_view;
		include 'application/views/'.$template_view;
	}
}
