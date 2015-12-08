<?php
session_start();

$host = $_SERVER['HTTP_HOST'];
$companion = $data[count($data) - 1];

echo '<table class="dialogues_table">
		<caption><h2>Dialog with '.$companion.'</h2></caption>';
		
		
		for($i = 0; $i < count($data) - 1; $i++)
		{
			
			extract($data[$i], EXTR_OVERWRITE);
			
			echo '<tr>
				<td> 
					<div id="dialog_box_message">
						<a href="#"><img src="http://'.$host.'/'.$avatar.'"></a>
							<div id="dialog_box_message_user_name">
								<a href="#">'.$first_name.' '.$last_name.'</a>
							</div>
							<div id="dialog_box_message_text">
								'.$text.'
							</div>
							<div id="dialog_box_message_date">
								'.$date.'
							</div>
					</div>
				</td>
			</tr>';
		}

		echo '<tr>
			<td>
				<form action="http://'.$host.'/Message/message_story?recieve=1&companion='.$options['companion'].'" method="post">
					<textarea  name="text" placeholder="type your message..."></textarea><br>
					<input type="submit" value="Send">
				</form>
			</td>
		</tr>
	</table>';