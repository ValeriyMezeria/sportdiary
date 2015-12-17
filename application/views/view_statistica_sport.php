<?php
session_start();

$host = $_SERVER['HTTP_HOST'];



echo '<div id="statistica_menu">
<a href="http://'.$host.'/Statistica/sport">Sport</a> | <a href="http://'.$host.'/Statistica/exercise">Exercise</a> | <a href="http://'.$host.'/Statistica/people">People</a> | <a href="http://'.$host.'/Statistica/program">Program</a>
</div>
	<form action="http://'.$host.'/Statistica/sport?recieve=1" method="post">
		<div id="search_box"> 
			<input name="kos_name" type="text" value="'.$_POST['kos_name'].'" id="text_search_people" placeholder="enter sport name you want to search">
			<input type="submit" value="Search" id="submit_search_people">
		</div>
		
		<div id="search_box_with_people"> 
			
			<table class="table_search_exercise">';
				
				if(isset($data))
				{
					for($i = 0; $i < count($data); $i++)
					{
						echo '<tr>
							<td width="30">
								'.($i + 1).'
							</td>
							<td align="left">
								<text class="text_name">'.$data[$i]['name'].'</text>
							</td>
							<td width="50">
								<img src="http://'.$host.'/images/people_icon.png" class="icon_statistica">x'.$data[$i]['count_users'].'
							</td>
						</tr>';
					}
				}
				else
				{
					echo '<tr>
						<td>	-	</td>
						<td>
							<text class="text_name">There is no data</text>
						</td>
						<td>	-	</td>
					</tr>';
				}
				
				
			echo '</table>
		
		</div>
		

		<div id="filter_box"> 
			<p>Top exercise for:<br>
				<select  value="" name="period" >
					<option '.(($_POST['period'] == 0) ? 'selected' : '' ).' value="0"> current month </option>
					<option '.(($_POST['period'] == 1) ? 'selected' : '' ).' value="1"> past month  </option>
					<option '.(($_POST['period'] == 6) ? 'selected' : '' ).' value="6">  past 6 months  </option>
					<option '.(($_POST['period'] == 12) ? 'selected' : '' ).' value="12"> past year  </option>
				</select>
			</p>
			<p>
				<input '.(($_POST['only_subscribes'] == 1) ? 'checked' : '' ).' type="checkbox" name="only_subscribes" value="1">
				Only of my friends
			</p>
			
			
			<p>Gender:
				<br><input '.(($_POST['gender'] == 2) ? 'checked' : '' ).' type="radio" name="gender" value="2" > Both
				<br><input '.(($_POST['gender'] == 1) ? 'checked' : '' ).' type="radio" name="gender" value="1"> Man
				<br><input '.(($_POST['gender'] == 0) ? 'checked' : '' ).' type="radio" name="gender" value="0"> Woman 
			</p>
			<p>Age from
				<input name="age_min" type="text" value="'.$_POST['age_min'].'" id="text_age" pattern="[0-9]{2}" placeholder="16">
				 to
				<input name="age_max" a type="text" value="'.$_POST['age_max'].'" id="text_age" pattern="[0-9]{2}" placeholder="40">
			</p>
			
			<p>Country:<br>
				<input name="country" type="text" value="'.$_POST['country'].'" pattern="^[A-Za-zА-Яа-яЁё\s]+$" placeholder="Ukraine">
				</p>
			<p>City:<br>
				<input name="city" type="text" value="'.$_POST['city'].'" pattern="^[A-Za-zА-Яа-яЁё\s]+$" placeholder="Kyiv">
			</p>
			
		</div>
	</form>';