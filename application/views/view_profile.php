<?php
session_start();

$host = $_SERVER['HTTP_HOST'];

if($options['type'] == 'mine')
{}

extract($data, EXTR_OVERWRITE);

echo '<h2 align="center">My page</h2>
	<img src="http://'.$host.'/'.$avatar.'" class="imageForMyPage">
	<div id="my_page_info">
	<text class="name_wrap">'.$first_name.' '.$last_name.'</text>
	<br>'.$country.', '.$city.', '.$street.', '.$house.', ap. '.$apartment.'
	<br><b>Bithday:</b> '.$birthday.'
	<br><b>Height:</b> '.$height.' cm.
	<br><b>Weight:</b> '.$weight.' kg.
	<br>
	<div class="description_wrap"><b>Description:</b>
	'.$about_me.'
	</div>
	
	</div>
	<div id="button_my_page">
		<form enctype="multipart/form-data" action="http://'.$host.'/Profile/profile?change_avatar=1" method="post">';
		
		if($options['type'] == 'mine')
		{
			echo '<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
					<input name="userfile" type="file" value="Choose photo" >
					<input type="submit" value="Change" >';	
		}
		else if($options['type'] == 'friend')
		{
			echo '
				<a href="http://'.$host.'/Profile/profile?unsubscribe='.$id.'"><div id="button_add_training">Remove from friends</div></a>
				<a href="http://'.$host.'/Message/message_story?companion='.$id.'"><div id="button_add_training">Write a message</div></a>';
		}
		else
		{
			echo'
				<a href="http://'.$host.'/Profile/profile?subscribe='.$id.'"><div id="button_add_training">Add to friends</div></a>
				<a href="http://'.$host.'/Message/message_story?companion='.$id.'"><div id="button_add_training">Write a message</div></a>';
		}
		echo '</form>
		
	</div>
	
	<text class="name_wrap">Subscription</text>
	<div class="wrap">

		<ul>';
		
		if(!empty($subscribes))
			for($i = 0; $i < count($subscribes); $i++)
				echo '<a href="http://'.$host.'/Profile/profile?user_id='.$subscribes[$i]['id'].'"><li><img src="http://'.$host.'/'.$subscribes[$i]['avatar'].'" alt="" /><br><text class="name_follower">'.$subscribes[$i]['first_name'].'<br>'.$subscribes[$i]['last_name'].'</text></li></a>';
			else
				echo 'No subscribes ';
				
		echo '</ul>
	</div>
	
	<text class="name_wrap">Followers</text>
	<div class="wrap">
		<ul>';
		
		if(!empty($followers))
		for($i = 0; $i < count($followers); $i++)
			echo '<a href="http://'.$host.'/Profile/profile?user_id='.$followers[$i]['id'].'"><li><img src="http://'.$host.'/'.$followers[$i]['avatar'].'" alt="" /><br><text class="name_follower">'.$followers[$i]['first_name'].'<br>'.$followers[$i]['last_name'].'</text></li></a>';
		else
			echo 'No followers';
		
		echo '</ul>
	</div>';