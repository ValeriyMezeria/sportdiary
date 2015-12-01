<?php
session_start();

$host = $_SERVER['HTTP_HOST'];






	for($i = 0; $i < count($data); $i++)
	{
		
		extract($data[$i], EXTR_OVERWRITE);
		
		echo '
		<div id="post_body">
		<div id="post_header">
			<div id="post_header_ava">
				<img src="http://'.$host.'/'.$user_avatar.'">
			</div>
			
			<div id="post_header_info">
				<div id="post_header_name">
					<a href="#">'.$user_first_name.' '.$user_last_name.'</a>
				</div>
				
				<div id="post_header_date">
					'.$date.'
				</div>
			</div>
			
			<div id="post_header_close">
					<a href="#">delete</a>
			</div>
			
			</div>';
			
			if($training_name == '')
			{
				echo '<div id="post_body_text">
					'.$text.'
				</div>
				
				<div id="post_body_img">
					<img src="images/img_01.jpg">
				</div>';
			}
			else
			{
				echo '<div id="post_body_training">
						<b>Training name</b>: '.$training_name.'<br>
						<b>Date training:</b> '.$training_date.'<br>
						<b>Total time:</b> '.$training_time.'<br>
						<b>Feeling:</b> '.$training_feeling.'<br>
						<b>Calories:</b> '.$training_calories.' <br>
						<b>Description:</b> '.$trainnig_description.'
					 </div>
						';
			}
			
			echo '
			<div id="post_footer">
				<div id="post_footer_icon">
					<a href=""><img src="http://'.$host.'/images/Comment.png"></a>	<text class="isDoNotPressed"> '.$comments.' </text>
					<a href=""><img src="http://'.$host.'/images/Like.png"></a> 	<text class="isPressed">'.$likes.'</text>
				</div>
			</div>
			</div>';
	}
		
