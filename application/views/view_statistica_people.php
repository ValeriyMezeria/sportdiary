<?php
session_start();

$host = $_SERVER['HTTP_HOST'];

echo '<div id="statistica_menu">
<a href="http://'.$host.'/Statistica/sport">Sport</a> | <a href="http://'.$host.'/Statistica/exercise">Exercise</a> | <a href="http://'.$host.'/Statistica/people">People</a>
</div>
	<form id="main_form" action="http://'.$host.'/Statistica/people?recieve=1" method="post">
		<div id="search_box"> 
			<input name="first_name" type="text" value="'.$_POST['first_name'].'" id="text_search_people" placeholder="enter person name you want to search">
			<input type="submit" value="Search" id="submit_search_people">
		</div>
		<div id="search_box_with_people"> 
			
			<script>
				function sort_param(sort_by, sort_dir="ASC")
				{
					alert(sort_by + sort_dir);
					alert(document.getElementById("main_form").action);
					document.getElementById("main_form").submit();
				}
			</script>
			
			<table class="table_search_exercise">';

			
			
			if(isset($data) && count($data) > 1)
			{
				
				echo '<tr>
					<td width="30">
						#
					</td>
					<td width="120px">
						<a href="#" >Name</a>
					</td>
					<td>
						<a href="#">Approache</a>
					</td>
					<td>
						<a href="#">Repetition</a>
					</td>
					<td>
						<a href="#">Value</a>
					</td>
					<td>
						<a href="#">Result</a>
					</td>
					<td>
						<a href="#">Intensity</a>
					</td>
				</tr>';
				
				for($i = 0; $i < count($data) - 1; $i++)
				{
					extract($data[$i], EXTR_OVERWRITE);
					echo '<tr>
						<td >
							'.$i.'
						</td>
						<td>
							'.$first_name.' 
							<br>'.$last_name.'
						</td>
						<td>
							'.$approach.'
						</td>
						<td>
							'.$repetition.'
						</td>
						<td>
							'.$value.'
						</td>
						<td>
							'.$result.'
						</td>
						<td>
							'.$intensity.'
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
			<p>Exercise:<br>
			<select name="koe_name" type="top" name="top" id="exercise_id">';
			
			extract($data[count($data) - 1], EXTR_OVERWRITE);
			
			for($i = 0; $i < count($koe); $i++)
				echo '<option  value="'.$koe[$i].'"> '.$koe[$i].'</option>';
				
			echo '</select></p>
			
			<p>Top exercise for:<br>
			<select name="period"  name="top" >
				<option '.(($_POST['period'] == 0) ? 'selected' : '' ).'  value="0"> current month </option>
				<option '.(($_POST['period'] == 1) ? 'selected' : '' ).'  value="1"> past month  </option>
				<option '.(($_POST['period'] == 6) ? 'selected' : '' ).'  value="6">  past 6 months  </option>
				<option '.(($_POST['period'] == 12) ? 'selected' : '' ).' value="12"> past year  </option>
			</select></p>
			
			<p>
				<input '.(($_POST['only_subscribes'] == 1) ? 'checked' : '' ).' type="checkbox" name="only_subscribes" value="">
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
			
			<p>Heigth from
				<input name="min_height" type="text" value="'.$_POST['min_height'].'" id="text_age" pattern="^[0-9]+$" placeholder="120">
				to
				<input name="max_height" type="text" value="'.$_POST['max_height'].'" id="text_age" pattern="^[0-9]+$" placeholder="190">
			</p>
			
			<p>Weight from
				<input name="min_weight" type="text" value="'.$_POST['min_weight'].'" id="text_age" pattern="^[0-9]+$" placeholder="60">
				to
				<input name="max_weight" type="text" value="'.$_POST['max_weight'].'" id="text_age" pattern="^[0-9]+$" placeholder="90">
			</p>
			
			<p>Country:<br>
				<input name="country" type="text" value="'.$_POST['country'].'" pattern="^[A-Za-zА-Яа-яЁё\s]+$" placeholder="Ukraine">
				</p>
			<p>City:<br>
				<input name="city" type="text" value="'.$_POST['city'].'" pattern="^[A-Za-zА-Яа-яЁё\s]+$" placeholder="Kyiv">
			</p>
			
		</div>
	</form>';