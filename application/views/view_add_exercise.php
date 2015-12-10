<?php
session_start();

$host = $_SERVER['HTTP_HOST'];

echo '<a href="http://'.$host.'/Training/add_training">Back</a><br>
		<form action="http://'.$host.'/Training/add_exercise?recieve=1" method="post">
					<h3>Enter new exercise info:</h3>
					<b>Kind of sport: </b>
					<td><select  name="kos" >';
					
					for($i = 0; $i < count($data); $i++)
					{
						
						echo '<option value="'.$data[$i]['id'].'"> '.$data[$i]['name'].' </option>';
					}						
								
					echo '</select><br>
					<b>Name of new exercise: </b>
					<input type="text" name="ex_name" ><br>
					<b>Description: </b>
					<textarea rows="3" value="" name="description" id="description" placeholder=""></textarea><br>
					<b>Measure of value: </b>
					<input type="text" name="mov"><br>
					<b>Name of new result: </b>
					<input type="text" name="mor" ><br>
					
					
					<input type="submit" value="Add">
			</form>';