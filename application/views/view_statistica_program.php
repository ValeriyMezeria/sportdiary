<?php
session_start();

$host = $_SERVER['HTTP_HOST'];



echo '<div id="statistica_menu">
<a href="http://'.$host.'/Statistica/sport">Sport</a> | <a href="http://'.$host.'/Statistica/exercise">Exercise</a> | <a href="http://'.$host.'/Statistica/people">People</a> | <a href="http://'.$host.'/Statistica/program">Program</a>
</div>
	<form action="http://'.$host.'/Statistica/program?recieve=1" method="post">
		<div id="search_box"> 
			
			<input style="float:right" type="submit" value="Search" id="submit_search_people">
		</div>
		<div id="search_box_with_people"> 
			
			<table class="table_search_exercise">';
			
			if(isset($data) && count($data) > 0)
			{
				for($i = 0; $i < count($data); $i++)
				{
					extract($data[$i], EXTR_OVERWRITE);
					
					echo '<tr>
						<td width="30">
							'.($i + 1).'
						</td>
						<td align="left">
							<text class="text_name">"'.$name.'"</text>'; 
							
							if(!$options['has_program'])
								echo '<a href="http://'.$host.'/Statistica/apply_program?program_id='.$t_prog_id.'"><div id="box_start_program" style="float: right;">apply program</div></a>';
							
							echo '<br><b>Author: </b> <a href="http://'.$host.'/Profile/profile?user_id='.$id.'">'.$first_name.' '.$last_name.'</a>
							<br><b>Description: </b> '.$description.'
						</td>
						
						<td width="50">
							<img src="http://'.$host.'/images/people_icon.png" class="icon_statistica">x'.$count_people.'
						</td>	
					</tr>';
				}
			}
			else
			{
				echo '<tr>
					<td>
						-
					</td>
					<td>
						<text class="text_name">there is no data</text>
						
					</td>
					
					<td>
						-
					</td>
				</tr>';
			}
				
				
				
				
				
			echo '</table>
		
		</div>
		

		<div id="filter_box"> 

			<p>Name author:<br>
				<input name="first_name" type="text" value="'.$_POST['first_name'].'" pattern="^[A-Za-zÀ-ßà-ÿ¨¸\s]+$" placeholder="first name, last name">
			</p>
			<p>
				<input '.(($_POST['only_subscribes'] == 1) ? 'checked' : '' ).' type="checkbox" name="only_subscribes" value="1">
				Only of my friends
			</p>
			
			
			<p>Gender:
				<br><input '.(($_POST['gender'] == 2) ? 'checked' : '' ).' type="radio" name="gender" value="2"> Both
				<br><input '.(($_POST['gender'] == 1) ? 'checked' : '' ).' type="radio" name="gender" value="1"> Man
				<br><input '.(($_POST['gender'] == 0) ? 'checked' : '' ).' type="radio" name="gender" value="0"> Woman  
			</p>
			<p>Age from
				<input name="age_min" type="text" value="'.$_POST['age_min'].'" id="text_age" pattern="[0-9]{2}" placeholder="16">
				 to
				<input name="age_max" a type="text" value="'.$_POST['age_max'].'" id="text_age" pattern="[0-9]{2}" placeholder="40">
			</p>


		</div>
	</form>';