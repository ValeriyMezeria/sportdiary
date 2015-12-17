<?php
session_start();

$host = $_SERVER['HTTP_HOST'];



	echo '
	<script>
		function openbox(id){
		  display = document.getElementById(id).style.display;
		  if(display==\'none\'){
			 document.getElementById(id).style.display=\'block\';
		  }else{
			 document.getElementById(id).style.display=\'none\';
		  }
		}
	</script>
	
	<div id="post_body">
		<form  enctype="multipart/form-data" action="http://'.$host.'/Feed/feed?recieve_post=1" method="post">
			<textarea name="text" placeholder="What`s new?"></textarea><br>
			<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
			<input name="userfile" type="file" >
			<input type="submit" value="Send" >
		</form>
	</div>';


	for($i = 0; $i < count($data); $i++)
	{
		
		extract($data[$i], EXTR_OVERWRITE);
		
		echo '
		<div id="post_body">
		<div id="post_header">
			<div id="post_header_ava">
				<img src="http://'.$host.'/'.$avatar.'">
			</div>
			
			<div id="post_header_info">
				<div id="post_header_name">
					<a href="#">'.$first_name.' '.$last_name.'</a>
				</div>
				
				<div id="post_header_date">
					'.$date.'
				</div>
			</div>';
			
			if($_SESSION['user_first_name'] == $first_name)
			echo '<a href="http://'.$host.'/Feed/feed?delete='.$id.'">
						<div id="post_header_close">
							delete
						</div>
					</a>';
			
			echo '</div>';
			
			if($name == '')
			{
				echo '<div id="post_body_text">
					'.$text.'
				</div>
				
				<div id="post_body_img">';
				
				if($is_photos == 1)
					for($j = 0; $j < count($photos); $j++)
						echo '<img src="http://'.$host.'/'.$photos[$j].'">';
				
				echo '</div>';
			}
			else
			{
				echo '<div id="post_body_training">
						<b>Training name</b>: '.$name.'<br>
						<b>Date training:</b> '.$date.'<br>
						<b>Total time:</b> '.$total_time.'<br>
						<b>Feeling:</b> '.$feeling.'<br>
						<b>Calories:</b> '.$calories.' <br>
						<b>Description:</b> '.$description.'
					 </div>
						';
			}
			
			echo '
			<div id="post_footer">
				<div id="post_footer_icon">
					<a href="#" onclick="openbox(\'comments_box_'.$i.'\'); return false"><img src="http://'.$host.'/images/Comment.png"></a>	<text class="isDoNotPressed"> '.$comments_num.' </text>
					<a href="http://'.$host.'/Feed/feed?like_post_id='.$id.'"><img src="http://'.$host.'/images/Like.png"></a> 	<text class="isPressed">'.$likes.'</text>
				</div>
			</div>
			
			
			<div id="comments_box_'.$i.'" style="display: none;">';
			
			
			for($j = 0; $j < count($comments); $j++)
			{
				echo '
						<table class="dialogues_table">
					<tr>
						<td> 
							<div id="dialog_box_message">
								<a href="#"><img src="http://'.$host.'/'.$comments[$j]['avatar'].'"></a>
									<div id="dialog_box_message_user_name">
										<a href="#">'.$comments[$j]['first_name'].' '.$comments[$j]['last_name'].'</a>
									</div>
									<div id="dialog_box_message_text">
										'.$comments[$j]['text'].'	
									</div>
									<div id="dialog_box_message_date">
										'.$comments[$j]['date'].'
									</div>
							</div>
						</td>
					</tr>';
			}
				echo '<tr>
					<td>
						<form action="http://'.$host.'/Feed/feed?recieve_comment='.$id.'" method="post">
							<textarea value="" name="text" placeholder=""></textarea><br>
							<input type="submit" value="Send">
						</form>
					</td>
				</tr>
			</table>
				</div>
				</div>
						';
			
			
	}
		
