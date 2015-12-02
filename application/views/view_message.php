<?php
session_start();

$host = $_SERVER['HTTP_HOST'];


echo '<table class="dialogues_table">
		<caption><h2>Dialogues</h2></caption>';
		
		if(!empty($data))
		{
			for($i = 0; $i < count($data); $i++)
			{
				extract($data[$i], EXTR_OVERWRITE);
				
				echo '<tr>
					<td onclick="return location.href = \'index1.html\'" > 
						<div id="dialog_box" >
							<div id="found_people_ava">
								<img src="http://'.$host.'/'.$user_avatar.'">
							</div>
							
							<div id="found_people_info">
								<div id="found_people_name">
									<a href="#">'.$user_first_name.' '.$user_last_name.'</a>
								</div>
								
								<div id="found_people_age">
									'.$last_message_date.'
								</div>
							</div>
							
							<div id="dialog_box_last_message">
								<img src="http://'.$host.'/'.$last_message_avatar.'">
									<div id="dialog_box_last_message_text">
									'.$last_message_text.'
									</div>
							</div>
						</div>
					</td>
				</tr>';
			}
		}
		else
		{
			echo '<tr>
				<td>
					<div id="not_found_people">
						you do not have dialogues
					</div>
				</td>
				</tr>
				</table>';
		}
		

		
		

	